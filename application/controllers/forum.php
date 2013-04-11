<?php
 
class Forum extends CI_Controller
{
	public function __construct()
    {
		parent::__construct();
	}
	
	public function index()
    {
        $this->actu();
    }
	
    public function actu()
    {
        $this->load->view('actu');
    }
	
	public function discosoupe()
    {
        $this->load->view('discosoupe');
    }
	
	public function gaspillage()
    {
        $this->load->view('gaspillage');
    }
}