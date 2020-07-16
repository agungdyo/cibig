<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_m extends CI_Model
{
    public function insertRegister($data)
    {
        return $this->db->insert('tbl_loginppdb',$data);
    }
}
