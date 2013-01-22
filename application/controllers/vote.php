<?php
class Vote extends CI_Controller
{
    const SIGNIN_URL = 'auth_test/signin';
    const VOTE_INDEX = 'vote';

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('pemilih_model');
        $this->load->model('cakahim_model');
        $this->load->model('casenator_model');
        $this->load->model('kotak_model');
        $this->load->model('voted_model');

        $this->pemilih = new Pemilih_model();
        $this->cakahim = new Cakahim_model();
        $this->casenat = new Casenator_model();
        $this->kotak = new Kotak_model();
        $this->voted = new Voted_model();
    }

    public function index()
    {
        if (($auth = $this->_check_auth()) != null) {
            return $auth;
        }
        
        if ($this->pemilih->has_vote != 0) {
            echo "You've voted!";
            return;
        }

        $cakahim_all = $this->cakahim->get_all();
        $casenat_all = $this->casenat->get_all();
        
        return $this->load->view('test_views/vote_test_index', array(
            'pemilih' => $this->pemilih,
            'cakahim_all' => $cakahim_all,
            'casenat_all' => $casenat_all,
        ));
    }
    
    public function vote()
    {
        if (($auth = $this->_check_auth()) != null) {
            return $auth;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->_vote();
        } else {
            redirect(site_url(self::VOTE_INDEX));
        }
    }

    private function _vote()
    {
        $cakahim_id = $this->input->post('cakahim');
        $casenat_id = $this->input->post('casenat');

        $cakahim = $this->cakahim->get_by_id($cakahim_id);
        $casenat = $this->casenat->get_by_id($casenat_id);

        $cakahim->increment_jumlah_vote();
        $casenat->increment_jumlah_vote();

        $this->pemilih->set_vote(1);
        $this->session->set_userdata('data', (array) $this->pemilih);

        $this->kotak->tambah_suara($this->pemilih->NIM, $cakahim->id_cakahim, $casenat->id_casenat);
        $this->voted->masukkan_hasil($this->pemilih->NIM, $cakahim->id_cakahim, $casenat->id_casenat);
        
        return redirect(site_url(self::VOTE_INDEX));
    }

    private function _check_auth()
    {
        if (!$this->session->userdata('signed_in')) {
            return redirect(site_url(self::SIGNIN_URL));
        }

        $pemilih_data = $this->session->userdata('data');
        $this->pemilih->NIM = $pemilih_data['NIM'];
        $this->pemilih->has_vote = intval($pemilih_data['has_vote']);

        return null;
    }
}
