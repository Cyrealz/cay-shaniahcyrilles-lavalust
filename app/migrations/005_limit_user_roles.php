<?php

class Limit_user_roles
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
    }

    public function up()
    {
        $this->_lava->db->raw("UPDATE users SET role = 'user' WHERE role = 'moderator'");
        $this->_lava->db->raw(
            "ALTER TABLE users MODIFY role ENUM('admin', 'user') NOT NULL DEFAULT 'user'"
        );
    }

    public function down()
    {
        $this->_lava->db->raw(
            "ALTER TABLE users MODIFY role ENUM('admin', 'moderator', 'user') NOT NULL DEFAULT 'user'"
        );
    }
}
