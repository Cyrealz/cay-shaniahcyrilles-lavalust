<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ProductModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // READ - Get all products
    public function read()
    {
        return $this->db
            ->table('products')
            ->get_all();
    }

    // READ - Get one product
    public function find($id)
    {
        return $this->db
            ->table('products')
            ->where('id', $id)
            ->get();
    }

    // CREATE
    public function create($product_name, $description, $price, $quantity)
    {
        $data = [
            'product_name' => $product_name,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity
        ];

        return $this->db
            ->table('products')
            ->insert($data);
    }

    // UPDATE
    public function update($id, $product_name, $description, $price, $quantity)
    {
        $data = [
            'product_name' => $product_name,
            'description'  => $description,
            'price'        => $price,
            'quantity'     => $quantity
        ];

        return $this->db
            ->table('products')
            ->where('id', $id)
            ->update($data);
    }

    // DELETE
    public function delete($id)
    {
        return $this->db
            ->table('products')
            ->where('id', $id)
            ->delete();
    }
}