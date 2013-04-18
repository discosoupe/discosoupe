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
		$this->load->model('ip_model');
		$this->ip_model->save_ip();
		if(!$this->ip_model->verif_ip())
		{
			exit("Vous n'avez pas le droit de voir cette page.");
		}
		$this->load->model('action_model');
	}
	
	public function index()
    {
        $this->accueil();
    }
	
	public function load_assets(){
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_js('bootstrap/js/jquery');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
	}
	
	public function accueil()
    {
    	$this->action_model->save_action('accueil');
    	$this->load->library('form_validation');
  
	    $this->form_validation->set_rules('date', '"Format de date"', 'trim|required|min_length[5]|max_length[52]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('lieu', '"Lieu"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
    	
		if($this->form_validation->run())
	    {
	        $this->action_model->save_action('annonce disco');
	        $date = $this->input->post('date');
			$lieu = $this->input->post('lieu');
			echo "bravo !".$date." ".$lieu;
	    }
		else
	    {
			$data = array();
	        $data['user_info'] = $this->ip_model->get_info();
			
			$this->load->library('layout');
			$this->load_assets();
			$this->layout->ajouter_js('bootstrap/js/bootstrap-transition');
			$this->layout->ajouter_js('bootstrap/js/bootstrap-carousel');
			$this->layout->ajouter_js('activ_carousel');
			$this->layout->set_titre('Accueil');
			//$this->layout->set_theme('disco');
			
			$this->layout->views('header', $data)
				->views('nav')
				->view('accueil');
		}
    }
	
    public function actu()
    {
    	$this->action_model->save_action('actu');
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Toutes l\'Actualité');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('actu');
    }
	
	public function association()
    {
    	$this->action_model->save_action('association');
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Notre Association');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('association');
    }
	
	public function gaspillage()
    {
    	$this->action_model->save_action('gaspillage');
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Le Gaspillage en image');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('gaspillage');
    }
	
	public function discosoupe()
    {
    	$this->action_model->save_action('disco soupe');
        $this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Espace Discopains');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('discosoupe');
    }
	
	public function partenaire()
    {
    	$this->action_model->save_action('partenaire');
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('espace partenaires');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('partenaire');
    }
	
	public function localisation()
    {
    	$this->action_model->save_action('localisation');
		$data = array();
		
		//Geolocalisation du guest
		
		require_once(APPPATH.'../'.geo_url('geoipcity.inc'));
		require_once(APPPATH.'../'.geo_url('geoipregionvars.php'));
		
		$gi = geoip_open(realpath(APPPATH.'../'.geo_url("GeoLiteCity.dat")),GEOIP_STANDARD);
		 
		$record = geoip_record_by_addr($gi, $this->session->userdata('ip_address'));
		
		$data['record'] = $record;
		
		geoip_close($gi);
		
		//google map
		
		$this->load->library('googleMapAPI');
		//(2) On crée une nouvelle carte; Ici, notre carte sera $map.
		$map = new GoogleMapAPI('map');
		 
		//(3) On ajoute la clef de Google Maps.
		$map->setAPIKey('AIzaSyCQQRKyKL2B7In9YZNYkxvs2hdeux0j3ME');
		     
		//(4) On ajoute les caractéristiques que l'on désire à notre carte.
		$map->setWidth("800px");
		$map->setHeight("500px");
		$map->setCenterCoords ('2', '48');
		$map->setZoomLevel (5);
		
		$data['map'] = $map;
		
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('localisation');
		$this->layout->views('header', $data)
			->views('nav')
			->view('localisation');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */