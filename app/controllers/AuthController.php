<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $data['error'] = '';

        if ($this->form_validation->submitted()) {
            $email = trim($this->io->post('email'));
            $role = $this->io->post('role');

            if (in_array($role, ['user', 'admin'], true)) {
                $user = $this->db->raw(
                    'SELECT id, email, password, role, is_active FROM users WHERE email = ? LIMIT 1',
                    [$email]
                )->fetch(PDO::FETCH_ASSOC);

                if (!$user || !(int) $user['is_active']) {
                    $data['error'] = 'Account not found or inactive.';
                } elseif (!$this->password_matches($this->io->post('password'), $user['password'])) {
                    $data['error'] = 'Invalid credentials.';
                } elseif ($user['role'] !== $role) {
                    $data['error'] = 'This account is not authorized for the selected role.';
                } else {
                    $this->upgrade_legacy_password($this->io->post('password'), $user);
                    $this->session->regenerate_on_login();
                    $this->session->set_userdata([
                        'user_id' => $user['id'],
                        'user_email' => $user['email'],
                        'user_role' => $user['role']
                    ]);
                    header('Location: ' . site_url('/products'));
                    exit;
                }
            } else {
                $data['error'] = 'Please select a valid role.';
            }
        }

        $this->call->view('auth/login', $data);
    }

    private function password_matches($password, $stored_password)
    {
        return password_verify($password, $stored_password)
            || hash_equals((string) $stored_password, (string) $password);
    }

    private function upgrade_legacy_password($password, $user)
    {
        if (!password_get_info($user['password'])['algo']) {
            $this->db->raw(
                'UPDATE users SET password = ?, updated_at = NOW() WHERE id = ?',
                [password_hash($password, PASSWORD_DEFAULT), $user['id']]
            );
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        header('Location: ' . site_url('/login'));
        exit;
    }

}