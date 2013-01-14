<?php

class Feedback_model extends CI_Model
{
    private $_table = 'feedback';

    /* int, pkey */
    public $id_feedback = 0;
    /* string */
    public $komentar = null;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
}
