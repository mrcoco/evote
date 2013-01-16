<?php
class Casenat extends CI_Controller
{
    const CNAME = 'model_tests/casenat';

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
        $this->load->model('casenator_model');
        $this->casenat = new Casenator_model();
 
        $this->links = array(
            array('Seed/Reseed', 'seed'),
            array('Get 1', 'get/1'),
            array('Delete 2', 'delete/2'),
            array('Delete All', 'delete_all'),
            array('Increment Vote 1', 'inc/1')
        );

        for ($i = 0; $i < count($this->links); $i++) {
            $this->links[$i][1] = site_url(self::CNAME . '/' . $this->links[$i][1]);
        }
    }

    public function seed()
    {
        $this->casenat->empty_table();

        $this->casenat->create('1', 'Jannet Simmons');
        $this->casenat->create('2', 'Diane Morel');

        redirect(self::CNAME, '');
    }

    public function index()
    {
        $casenat_arr = $this->casenat->get_all();
        $this->load->view('test_view', array(
            'output_code' => $casenat_arr,
            'links' => $this->links)
        );
    }

    public function get($id)
    {
        $casenat = $this->casenat->get_by_id($id);
        $this->load->view('test_view', array(
            'output_code' => $casenat,
            'links' => $this->links)
        );
    }

    public function inc($id)
    {
        $casenat = $this->casenat->get_by_id($id);
        $casenat->increment_jumlah_vote();
        redirect(self::CNAME, '');
    }

    public function delete($id)
    {
        $this->casenat->delete($id);
        redirect(self::CNAME, '');
    }
    
    public function delete_all()
    {
        $this->casenat->empty_table();
        redirect(self::CNAME, '');
    }
}
