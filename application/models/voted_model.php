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
}
