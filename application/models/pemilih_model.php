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
}
