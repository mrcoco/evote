<?php
class Cakahim extends CI_Controller
{
    const CNAME = 'model_tests/cakahim';

    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('url');
        
        $this->load->model('cakahim_model');
        $this->cakahim = new Cakahim_model();
 
        $this->links = array(
            array('Seed/Reseed', 'seed'),
            array('Get 1', 'get/1'),
            array('Delete 2', 'delete/2'),
            array('Delete All', 'delete_all'),
            array('Increment Vote 3', 'inc/3')
        );

        for ($i = 0; $i < count($this->links); $i++) {
            $this->links[$i][1] = site_url(self::CNAME . '/' . $this->links[$i][1]);
        }
    }

    public function seed()
    {
        $this->cakahim->empty_table();

        $this->cakahim->create('1', 'Samuel Roth');
        $this->cakahim->create('2', 'James Einner');
        $this->cakahim->create('3', 'Tom Grainger');

        redirect(self::CNAME, '');
    }

    public function index()
    {
        $cakahim_arr = $this->cakahim->get_all();
        $this->load->view('test_view', array(
            'output_code' => $cakahim_arr,
            'links' => $this->links)
        );
    }

    public function get($id)
    {
        $cakahim = $this->cakahim->get_by_id($id);
        $this->load->view('test_view', array(
            'output_code' => $cakahim,
            'links' => $this->links)
        );
    }

    public function inc($id)
    {
        $cakahim = $this->cakahim->get_by_id($id);
        $cakahim->increment_jumlah_vote();
        redirect(self::CNAME, '');
    }

    public function delete($id)
    {
        $this->cakahim->delete($id);
        redirect(self::CNAME, '');
    }
    
    public function delete_all()
    {
        $this->cakahim->empty_table();
        redirect(self::CNAME, '');
    }
}
