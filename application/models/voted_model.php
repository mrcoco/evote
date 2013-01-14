<?php

class Voted_model extends CI_Model
{
    private $_table = 'voted';

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

    public function masukkan_hasil($voter, $cakahim, $casenator)
    {
        $data = array(
            'vote_name' => $voter,
            'id_cakahim' => $cakahim,
            'id_casenat' => $casenat,
        );

        $this->db
            ->insert($this->_table, $data);
    }
}
