<?php

class Casenator_model extends CI_Model
{
    const TABLE = 'casenator';

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

    public function get_by_id($id)
    {
        $row_arr = $this->db
            ->get(self::TABLE)
            ->where('id_casenat', $id)
            ->result();

        if (!$row_arr) {
            return null;
        }

        $row = $row_arr[0];

        $this->id_casenat = $row->id_casenat;
        $this->nama_casenat = $row->nama_casenat;
        $this->jumlah_vote = $row->jumlah_vote;

        return $this;
    }

    public function get_all()
    {
        $casenat_arr = array();

        $row_arr = $this->db
            ->get(self::TABLE)
            ->result();

        foreach ($row_arr as $row) {
            $c = new Casenator_model();

            $c->id_casenat = $row->id_casenat;
            $c->nama_casenat = $row->nama_casenat;
            $c->jumlah_vote = $row->jumlah_vote;

            $casenat_arr[] = $c;
        }

        return $casenat_arr;
    }

    public function increment_jumlah_vote()
    {
        $this->jumlah_vote++;

        $this->db
            ->where('id_casenat', $this->id_casenat)
            ->update(self::TABLE, array('jumlah_vote' => $this->jumlah_vote));

        return $this;
    }

    public function create($id, $nama)
    {
        $this->id_casenat = $id;
        $this->nama_casenat = $nama;

        $data = array(
            'id_casenat' => $this->id_casenat,
            'nama_casenat' => $this->nama_casenat,
            'jumlah_vote' => $this->jumlah_vote,
        );

        $this->db
            ->insert(self::TABLE, $data);

        return $this;
    }
}
