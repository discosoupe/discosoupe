<?php 

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	public function index()
	{
		$this->load->view('welcome_message');
	}
	*/
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
		$this->load->library('layout');
		$this->layout->ajouter_css('discosoupe');
		//$this->layout->ajouter_js();
		$this->layout->set_titre('Actualité');
		//$this->layout->set_theme('disco');
		$this->layout->views('nav')
				->view('actu');
    }
	
	public function discosoupe()
    {
        $this->load->library('layout');
		$this->layout->set_titre('Disco Soupe');
		//$this->layout->set_theme('disco');
		$this->layout->views('nav')
				->view('discosoupe');
    }
	
	public function gaspillage()
    {
		$this->load->library('layout');
		$this->layout->set_titre('gaspillage');
		//$this->layout->set_theme('disco');
		$this->layout->views('nav')
				->view('gaspillage');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */