<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
    }

    public function preflight()
    {
        // The API library handles the CORS headers and exits with 204.
    }

    public function health()
    {
        $this->api->require_method('GET');
        $this->api->respond(['status' => 'ok']);
    }

    public function login()
    {
        $this->api->require_method('POST');
        $this->api->rate_limit('api-login', 10, 60);
        $input = $this->api->body();
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';
        $requested_role = $input['role'] ?? null;

        if (!is_string($email) || !is_string($password)) {
            $this->api->respond_error('Email and password are required', 422);
        }

        $email = trim($email);
        if ($email === '' || $password === '') {
            $this->api->respond_error('Email and password are required', 422);
        }

        if ($requested_role !== null && !in_array($requested_role, ['user', 'admin'], true)) {
            $this->api->respond_error('Please select a valid role', 422);
        }

        $stmt = $this->db->raw(
            'SELECT id, email, password, role, is_active FROM users WHERE email = ? LIMIT 1',
            [$email]
        );
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && !in_array($user['role'], ['user', 'admin'], true)) {
            $this->api->respond_error('This account has an unsupported role', 403);
        }

        $password_matches = $user && (int) $user['is_active'] === 1 && (
            password_verify($password, $user['password'])
            || hash_equals((string) $user['password'], $password)
        );

        if ($password_matches) {
            if ($requested_role !== null && $user['role'] !== $requested_role) {
                $this->api->respond_error('This account is not authorized for the selected role', 403);
            }

            // Upgrade legacy plain-text credentials after a successful login.
            if (!password_get_info($user['password'])['algo']) {
                $this->db->raw(
                    'UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?',
                    [password_hash($password, PASSWORD_DEFAULT), $user['id']]
                );
            }

            $tokens = $this->api->issue_tokens([
                'id'   => $user['id'],
                'role' => $user['role'],
            ]);
            $this->api->respond($tokens);
        } else {
            $this->api->respond_error('Invalid credentials', 401);
        }
    }

    public function register()
    {
        $this->api->require_method('POST');
        $input = $this->api->body();

        $username = $input['username'] ?? '';
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';

        if (!is_string($username) || !is_string($email) || !is_string($password)) {
            $this->api->respond_error('Username, email, and password are required', 422);
        }

        $username = trim($username);
        $email = trim($email);
        if ($username === '' || $email === '' || $password === '') {
            $this->api->respond_error('Username, email, and password are required', 422);
        }

        if (strlen($username) > 100 || strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->api->respond_error('A valid email is required', 422);
        }

        if (strlen($password) < 8 || strlen($password) > 72) {
            $this->api->respond_error('Password must be between 8 and 72 characters', 422);
        }

        $existing = $this->db->raw(
            'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1',
            [$username, $email]
        )->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            $this->api->respond_error('Username or email already exists', 409);
        }

        $this->db->raw(
            'INSERT INTO users (username, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())',
            [$username, $email, password_hash($password, PASSWORD_BCRYPT), 'user']
        );

        $this->api->respond(['message' => 'User registered successfully'], 201);
    }

    public function logout()
    {
        $this->api->require_method('POST');
        $this->api->require_jwt();
        $input = $this->api->body();
        $refresh_token = $input['refresh_token'] ?? '';
        if (!is_string($refresh_token) || $refresh_token === '') {
            $this->api->respond_error('Refresh token is required', 422);
        }
        $this->api->revoke_refresh_token($refresh_token);
        $this->api->respond(['message' => 'Logged out']);
    }

    public function list()
    {
        $this->require_admin();
        $this->api->rate_limit();

        $users = $this->db->table('users')
                          ->select('id, username, email, role, created_at')
                          ->get_all();
        $this->api->respond($users);
    }

    public function create()
    {
        $this->api->require_method('POST');
        $this->require_admin();
        $input = $this->api->body();

        $username = $input['username'] ?? '';
        $email = $input['email'] ?? '';
        $password = $input['password'] ?? '';
        $role = $input['role'] ?? 'user';
        if (!is_string($username) || !is_string($email) || !is_string($password)) {
            $this->api->respond_error('Username, email, and password are required', 422);
        }
        $username = trim($username);
        $email = trim($email);
        if ($username === '' || strlen($username) > 100 || $email === ''
            || strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->api->respond_error('A valid email is required', 422);
        }
        if (strlen($password) < 8 || strlen($password) > 72) {
            $this->api->respond_error('Password must be between 8 and 72 characters', 422);
        }
        if (!in_array($role, ['user', 'admin'], true)) {
            $this->api->respond_error('Please select a valid role', 422);
        }

        $existing = $this->db->raw(
            'SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1',
            [$username, $email]
        )->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            $this->api->respond_error('Username or email already exists', 409);
        }

        $this->db->raw(
            "INSERT INTO users (username, email, password, role, created_at)
             VALUES (?, ?, ?, ?, NOW())",
            [$username, $email, password_hash($password, PASSWORD_DEFAULT), $role]
        );

        $this->api->respond(['message' => 'User created'], 201);
    }

    public function update($id)
    {
        $this->api->require_method('PUT');
        $this->require_admin();
        $input = $this->api->body();

        $id = $this->require_valid_id($id);
        $username = $input['username'] ?? '';
        $email = $input['email'] ?? '';
        $role = $input['role'] ?? '';
        if (!is_string($username) || !is_string($email)) {
            $this->api->respond_error('Username and email are required', 422);
        }
        $username = trim($username);
        $email = trim($email);
        if ($username === '' || strlen($username) > 100 || $email === ''
            || strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->api->respond_error('A valid email is required', 422);
        }
        if (!in_array($role, ['user', 'admin'], true)) {
            $this->api->respond_error('Please select a valid role', 422);
        }

        $existing = $this->db->raw(
            'SELECT id FROM users WHERE (username = ? OR email = ?) AND id <> ? LIMIT 1',
            [$username, $email, $id]
        )->fetch(PDO::FETCH_ASSOC);
        if ($existing) {
            $this->api->respond_error('Username or email already exists', 409);
        }

        $this->db->raw(
            "UPDATE users SET username = ?, email = ?, role = ?, updated_at = NOW() WHERE id = ?",
            [$username, $email, $role, $id]
        );

        $this->api->respond(['message' => 'User updated']);
    }

    public function delete($id)
    {
        $this->api->require_method('DELETE');
        $auth = $this->require_admin();
        $id = $this->require_valid_id($id);
        if ((string) $auth['sub'] === (string) $id) {
            $this->api->respond_error('You cannot delete your own account', 422);
        }
        $this->db->raw('DELETE FROM users WHERE id = ?', [$id]);
        $this->api->respond(['message' => 'User deleted']);
    }

    public function profile()
    {
        $auth = $this->api->require_jwt();

        $stmt = $this->db->raw(
            "SELECT id, username, email, role, created_at FROM users WHERE id = ? AND is_active = 1",
            [$auth['sub']]
        );
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $this->api->respond_error('User not found', 404);
        }
        $this->api->respond($user);
    }

    public function refresh()
    {
        $this->api->require_method('POST');
        $this->api->rate_limit('api-refresh', 20, 60);
        $input = $this->api->body();
        $refresh_token = $input['refresh_token'] ?? '';
        if (!is_string($refresh_token) || $refresh_token === '') {
            $this->api->respond_error('Refresh token is required', 422);
        }
        $this->api->refresh_access_token($refresh_token);
    }

    public function products()
    {
        $this->api->require_jwt();
        $this->api->rate_limit();
        $products = $this->db->raw(
            'SELECT id, product_name, description, price, quantity, created_at FROM products ORDER BY id DESC'
        )->fetchAll(PDO::FETCH_ASSOC);
        $this->api->respond($products);
    }

    public function product_create()
    {
        $this->api->require_method('POST');
        $this->require_admin();
        $product = $this->validated_product($this->api->body());
        $id = $this->db->raw(
            'INSERT INTO products (product_name, description, price, quantity) VALUES (?, ?, ?, ?)',
            [$product['product_name'], $product['description'], $product['price'], $product['quantity']]
        );
        $this->api->respond([
            'message' => 'Product created',
            'id' => (int) $id,
        ], 201);
    }

    public function product_update($id)
    {
        $this->api->require_method('PUT');
        $this->require_admin();
        $id = $this->require_valid_id($id);
        $product = $this->validated_product($this->api->body());
        $existing = $this->db->raw('SELECT id FROM products WHERE id = ? LIMIT 1', [$id])
            ->fetch(PDO::FETCH_ASSOC);
        if (!$existing) {
            $this->api->respond_error('Product not found', 404);
        }
        $this->db->raw(
            'UPDATE products SET product_name = ?, description = ?, price = ?, quantity = ? WHERE id = ?',
            [$product['product_name'], $product['description'], $product['price'], $product['quantity'], $id]
        );
        $this->api->respond(['message' => 'Product updated']);
    }

    public function product_delete($id)
    {
        $this->api->require_method('DELETE');
        $this->require_admin();
        $id = $this->require_valid_id($id);
        $deleted = $this->db->raw('DELETE FROM products WHERE id = ?', [$id]);
        if ((int) $deleted === 0) {
            $this->api->respond_error('Product not found', 404);
        }
        $this->api->respond(['message' => 'Product deleted']);
    }

    private function validated_product($input)
    {
        $name = $input['product_name'] ?? '';
        $description = $input['description'] ?? '';
        $price = $input['price'] ?? null;
        $quantity = $input['quantity'] ?? null;

        if (!is_string($name) || !is_string($description) || !is_numeric($price)
            || !is_finite((float) $price) || filter_var($quantity, FILTER_VALIDATE_INT) === false) {
            $this->api->respond_error('Product name, price, and whole-number quantity are required', 422);
        }

        $name = trim($name);
        $description = trim($description);
        $price = (float) $price;
        $quantity = (int) $quantity;
        if ($name === '' || strlen($name) > 255 || strlen($description) > 65535
            || $price < 0 || $price > 99999999.99
            || $quantity < 0 || $quantity > 4294967295) {
            $this->api->respond_error('Enter a valid name, non-negative price, and non-negative quantity', 422);
        }

        return [
            'product_name' => $name,
            'description' => $description,
            'price' => $price,
            'quantity' => $quantity,
        ];
    }

    private function require_valid_id($id)
    {
        if (!is_string($id) || !ctype_digit($id) || (int) $id < 1) {
            $this->api->respond_error('A valid ID is required', 422);
        }
        return (int) $id;
    }

    private function require_admin()
    {
        $auth = $this->api->require_jwt();
        if (($auth['role'] ?? '') !== 'admin') {
            $this->api->respond_error('Administrator access is required', 403);
        }
        return $auth;
    }
}