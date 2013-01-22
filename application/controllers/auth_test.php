<?php
class Auth_test extends CI_Controller
{
    const SIGNIN_URL = 'auth_test/signin';

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->model('pemilih_model');
        $this->pemilih = new Pemilih_model();
    }

    public function index()
    {
        return redirect(site_url(self::SIGNIN_URL));
    }

    public function signin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return $this->_signin();
        } else {
            $pemilih = null;
            $signed_in = false;
            $signin_fail = false;
            
            if ($this->session->userdata('signed_in')) {
                $signed_in = true;
                $pemilih = $this->session->userdata('data');
            } else if ($this->session->flashdata('signin_fail')) {
                $signin_fail = true;
            }

            return $this->load->view('test_views/auth_test', array(
                'pemilih' => $pemilih,
                'signed_in' => $signed_in,
                'signin_fail' => $signin_fail,
            ));
        }
    }

    public function logout()
    {
        if ($this->session->userdata('signed_in')) {
            $this->session->unset_userdata(array(
                'signed_in' => null,
                'data' => null,
            ));
        }

        return redirect(site_url(self::SIGNIN_URL));
    }

    private function _signin()
    {
        $NIM = $this->input->post('NIM');
        $password = $this->input->post('password');

        $pemilih = $this->pemilih->get($NIM, $password);
        if ($pemilih == null) {
            $this->session->set_flashdata('signin_fail', true);
            return redirect(site_url('auth_test/signin'));
        }

        $this->session->set_userdata(array(
            'signed_in' => true,
            'data' => (array) $pemilih,
        ));

        return redirect(site_url(self::SIGNIN_URL));
    }
}
