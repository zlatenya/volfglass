<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_model {
    public function login($login, $password) {
      $query = $this->db->get_where('vg_account', array('name' => $login, 'password' => $password));
      return $query->row_array();
    }
}
