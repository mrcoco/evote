<?php

class Syslog_model extends CI_Model
{
    private $_table = 'syslog';

    /* int, pkey */
    public $id_log = 0;
    /* int */
    public $NIM = null;
    /* string */
    public $aksi = null;
    /* date */
    public $waktu = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function log_kejadian($NIM, $aksi)
    {
        $data = array(
            'NIM' => $NIM,
            'aksi' => $aksi,
        );
        
        $this->db
            ->insert($this->_table, $data);
    }
}
