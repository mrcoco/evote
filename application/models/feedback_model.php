<?php

class Feedback_model extends CI_Model
{
    private $_table = 'feedback';

    /* int, pkey */
    public $id_feedback = 0;
    /* int */
    public $NIM = 0;
    /* string */
    public $komentar = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function tambah_feedback($NIM, $komentar)
    {
        $data = array(
            'NIM' => $NIM,
            'komentar' => $komentar,
        );
        
        $this->db
            ->insert($this->_table, $data);
    }
}
