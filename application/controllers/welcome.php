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
        $this->accueil();
    }
	
	public function accueil()
    {
		$this->load->library('layout');
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
		$this->layout->set_titre('Accueil');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('accueil');
    }
	
    public function actu()
    {
		$this->load->library('layout');
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
		$this->layout->set_titre('Toutes l\'Actualité');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('actu');
    }
	
	public function association()
    {
		$this->load->library('layout');
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
		$this->layout->set_titre('Notre Association');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('association');
    }
	
	public function gaspillage()
    {
		$this->load->library('layout');
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
		$this->layout->set_titre('Le Gaspillage en image');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('gaspillage');
    }
	
	public function discosoupe()
    {
        $this->load->library('layout');
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
		$this->layout->set_titre('Espace Discopains');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('discosoupe');
    }
	
	public function partenaire()
    {
		$this->load->library('layout');
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
		$this->layout->set_titre('espace partenaires');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('partenaire');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */