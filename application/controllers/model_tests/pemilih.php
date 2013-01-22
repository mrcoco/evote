<?php
class Pemilih extends CI_Controller
{
    const CNAME = 'model_tests/pemilih';
    const VNAME = 'test_views/model_test';

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
        $this->load->model('cakahim_model');
        $this->load->model('casenator_model');
        $this->load->model('pemilih_model');

        $this->cakahim = new Cakahim_model();
        $this->casenat = new Casenator_model();
        $this->pemilih = new Pemilih_model();

        $this->links = array(
            array('Seed/Reseed', 'seed'),
            array('Get 13550002 with password 123test', 'get/13550002/123test'),
            array('13550002 vote for Cakahim 1 and Casenat 1', 'vote/13550002/123test/2/1'),
        );

        for ($i = 0; $i < count($this->links); $i++) {
            $this->links[$i][1] = site_url(self::CNAME . '/' . $this->links[$i][1]);
        }
    }

    public function seed()
    {
        $this->pemilih->empty_table();

        $this->pemilih->create('13550001', 'test123');
        $this->pemilih->create('13550002', '123test');
        $this->pemilih->create('13550003', '6543210');
        $this->pemilih->create('13550004', 'abcdefg');
        $this->pemilih->create('13550005', 'asdfghk');

        redirect(self::CNAME, '');
    }

    public function index()
    {
        $pemilih_arr = $this->pemilih->get_all();
        $this->load->view(self::VNAME, array(
            'output_code' => $pemilih_arr,
            'links' => $this->links)
        );
    }

    public function get($NIM, $password)
    {
        $pemilih = $this->pemilih->get($NIM, $password);
        $this->load->view(self::VNAME, array(
            'output_code' => $pemilih,
            'links' => $this->links)
        );
    }

    public function vote($NIM, $password, $cakahim_id, $casenat_id)
    {
        $pemilih = $this->pemilih->get($NIM, $password);
        
        if ($pemilih->has_vote > 0) {
            echo "{$NIM} has voted!";
            return;
        }

        $cakahim = $this->cakahim->get_by_id($cakahim_id);
        $casenat = $this->casenat->get_by_id($casenat_id);

        $cakahim->increment_jumlah_vote();
        $casenat->increment_jumlah_vote();
        $pemilih->set_vote(1);

        redirect(self::CNAME, '');
    }

    public function delete_all()
    {
        $this->cakahim->empty_table();
        redirect(self::CNAME, '');
    }
}
