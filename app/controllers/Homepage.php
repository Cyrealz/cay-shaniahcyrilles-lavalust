<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Homepage extends Controller
{
    public function index()
    {
        return $this->call->view('homepage');
    }
}