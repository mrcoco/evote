<?php

class Pemilih_model extends CI_Model
{
    const TABLE = 'pemilih';

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
    
    public function get_all()
    {
        $pemilih_arr = array();

        $row_arr = $this->db
            ->get(self::TABLE)
            ->result();

        foreach ($row_arr as $row) {
            $p = new Pemilih_model();

            $p->NIM = $row->NIM;
            $p->salt = $row->salt;
            $p->password = $row->password;
            $p->has_vote = $row->has_vote;

            $pemilih_arr[] = $p;
        }

        return $pemilih_arr;
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
        $this->password = $password;
        $pass = substr(strrev(sha1($this->salt . $this->password)), 0, 32);

        $data = array(
            'NIM' => $this->NIM,
            'salt' => $this->salt,
            'password' => $pass,
            'has_vote' => $this->has_vote,
        );

        $this->db->insert(self::TABLE, $data);

        return $this;
    }

    public function set_vote($val)
    {
        $this->has_vote = $val;

        $this->db
            ->where('NIM', $this->NIM)
            ->update(self::TABLE, array('has_vote' => $this->has_vote));

        return $this;
    }
    
    private function _validate_and_get()
    {
        $pass = substr(strrev(sha1($this->salt . $this->password)), 0, 32);

        $row_arr = $this->db
            ->where('NIM', $this->NIM)
            ->get(self::TABLE)        
            ->result();

        if (!$row_arr) {
            return false;
        }

        $row = $row_arr[0];

        if ($pass == $row->password) {
            $this->password = $pass;
            $this->has_vote = $row->has_vote;
            return true;
        } else {
            return false;
        }
    }

    public function empty_table()
    {
        $this->db->empty_table(self::TABLE);
    }
}
