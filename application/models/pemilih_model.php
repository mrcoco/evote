<?php

class Pemilih_model extends CI_Model
{
    private $_table = 'pemilih';

    /* int, pkey */
    public $NIM = 0;
    /* string */
    public $salt = null;
    /* string */
    public $password = null;
    /* int/bool */
    public $has_vote = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get($NIM, $password)
    {
        $this->NIM = $NIM;
        $this->salt = md5($NIM);
        $this->password = $password;

        if ($this->_validate_and_get()) {
            return $this;
        } else {
            return null;
        }
    }

    public function create($NIM, $password)
    {
        $this->NIM = $NIM;
        $this->salt = md5($NIM);
        $this->password = $pass;
        $pass = substr(strrev(sha1($this->salt . $this->password)), 0, 32);

        $data = array(
            'NIM' => $this->NIM,
            'salt' => $this->salt,
            'password' => $this->password,
            'has_vote' => $this->has_vote,
        );

        $this->db->insert($this->_table, $data);

        return $this;
    }

    public function set_vote($val)
    {
        $this->has_vote = $val;

        $this->db
            ->where('NIM', $this->NIM)
            ->update($this->_table, array('has_vote' => $this->has_vote));

        return $this;
    }
    
    private function _validate_and_get()
    {
        $pass = substr(strrev(sha1($this->salt . $this->password)), 0, 32);

        $row_arr = $this->db
            ->get($this->_table)
            ->where('NIM', $this->NIM)
            ->result();

        if (!$row_arr) {
            return false;
        }

        $row = $row_arr[0];

        if ($pass == $row->password) {
            $this->has_vote = $row->has_vote;
            return true;
        } else {
            return false;
        }
    }
}
