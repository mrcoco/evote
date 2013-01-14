<?php

class Kotak_model extends CI_Model
{
    private $_table = 'kotak';

    /* string */
    public $vote_name = null;
    /* int */
    public $id_cakahim = null;
    /* int */
    public $id_casenat = null;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function tambah_suara($voter, $cakahim, $casenat)
    {
        $data = array(
            'vote_name' => $voter,
            'id_cakahim' => $cakahim,
            'id_casenat' => $casenat,
        );

        $this->db
            ->insert($this->_table, $data);
    }
    
    public function ambil_suara()
    {
        /* ?? */
    }
}
