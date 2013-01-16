<?php

class Cakahim_model extends CI_Model
{
    const TABLE = 'cakahim';

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

    public function get_by_id($id)
    {
        $row_arr = $this->db
            ->where('id_cakahim', $id)
            ->get(self::TABLE)
            ->result();

        if (!$row_arr) {
            return null;
        }

        $row = $row_arr[0];

        $this->id_cakahim = $row->id_cakahim;
        $this->nama_cakahim = $row->nama_cakahim;
        $this->jumlah_vote = $row->jumlah_vote;

        return $this;
    }

    public function get_all()
    {
        $cakahim_arr = array();

        $row_arr = $this->db
            ->get(self::TABLE)
            ->result();

        foreach ($row_arr as $row) {
            $c = new Cakahim_model();

            $c->id_cakahim = $row->id_cakahim;
            $c->nama_cakahim = $row->nama_cakahim;
            $c->jumlah_vote = $row->jumlah_vote;

            $cakahim_arr[] = $c;
        }

        return $cakahim_arr;
    }

    public function increment_jumlah_vote()
    {
        $this->jumlah_vote++;

        $this->db
            ->where('id_cakahim', $this->id_cakahim)
            ->update(self::TABLE, array('jumlah_vote' => $this->jumlah_vote));

        return $this;
    }

    public function create($id, $nama)
    {
        $this->id_cakahim = $id;
        $this->nama_cakahim = $nama;

        $data = array(
            'id_cakahim' => $this->id_cakahim,
            'nama_cakahim' => $this->nama_cakahim,
            'jumlah_vote' => $this->jumlah_vote,
        );

        $this->db
            ->insert(self::TABLE, $data);

        return $this;
    }

    public function delete($id)
    {
        $this->db
            ->where('id_cakahim', $id)
            ->delete(self::TABLE);
    }

    public function empty_table()
    {
        $this->db->empty_table(self::TABLE);
    }
}
