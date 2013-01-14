<?php

class Casenator_model extends CI_Model
{
    private $_table = 'casenator';

    /* int, pkey */
    public $id_casenat = 0;
    /* string */
    public $nama_casenat = null;
    /* int */
    public $jumlah_vote = 0;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}
