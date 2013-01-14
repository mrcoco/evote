<?php

class Cakahim_model extends CI_Model
{
    private $_table = 'cakahim';

    /* int, pkey */
    public $id_cakahim = 0;
    /* string */
    public $nama_cakahim = null;
    /* int */
    public $jumlah_vote = 0;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}
