<?php 

class Welcome extends CI_Controller {
	private $idip;

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
		$result = $this->ip_model->verif_ip();
		if(empty($result)){
			exit("Vous n'avez pas le droit de voir cette page.");
		}
		$data = array();
		foreach ($result as $resultat) {
			$this->id_ip = $resultat->idip;
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
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
	}
	
	public function accueil()
    {
    	$this->action_model->save_action('accueil', $this->id_ip);
    	$this->load->library('form_validation');
  
	    $this->form_validation->set_rules('date', '"Format de date"', 'trim|required|exact_length[16]|xss_clean');
	    $this->form_validation->set_rules('lieu', '"Lieu"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|min_length[5]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('evenement', '"Evènement"', 'trim|required|min_length[5]|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('telephone', '"Téléphone"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('contact', '"Contact"', 'trim|required|min_length[5]|alpha_dash|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[5]|encode_php_tags|xss_clean|valid_email');
		
		if($this->form_validation->run())
	    {
	    	if($this->input->post('validation') == 'creerdisco')
			{
		        $this->action_model->save_action('annonce disco', $this->id_ip);
		        $date = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
				$lieu = $this->input->post('lieu');
				$adresse = $this->input->post('adresse');
				$evenement = $this->input->post('evenement');
				$telephone = $this->input->post('telephone');
				$contact = $this->input->post('contact');
				$email = $this->input->post('email');
				$this->load->model('discosoupe_model');
				$this->discosoupe_model->save_discosoupe($date, $lieu, $adresse, $evenement, $telephone, $contact, $email, $this->id_ip);
		    	$this->agenda();
			}
		}
		else
	    {
			$data['user_ip'] = $this->idip;
			
			$this->load->library('layout');
			$this->load_assets();
			$this->layout->ajouter_css('jquery-ui');
			$this->layout->ajouter_css('jquery-ui-timepicker-addon');
			$this->layout->ajouter_js('bootstrap/js/bootstrap-transition');
			$this->layout->ajouter_js('bootstrap/js/bootstrap-carousel');
			$this->layout->ajouter_js('jquery-ui-sliderAccess');
			$this->layout->ajouter_js('jquery-ui-timepicker-addon');
			$this->layout->ajouter_js('activ_carousel');
			$this->layout->set_titre('Accueil');
			//$this->layout->set_theme('disco');
			
			$this->layout->views('header', $data)
				->views('nav')
				->views('carousel')
				->view('accueil');
		}
    }

	public function annoncepartenaire()
    {
    	$this->action_model->save_action('annonce partenaire', $this->id_ip);
    	$this->load->library('form_validation');
  
		$this->form_validation->set_rules('entreprise_partenaire', '"Entreprise"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('adresse_partenaire', '"Adresse"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('localisation_partenaire', '"Localisation"', 'trim|required|min_length[5]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('contact_partenaire', '"Contact"', 'trim|required|min_length[5]|alpha_dash|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('telephone_partenaire', '"Téléphone"', 'trim|required|min_length[5]|max_length[52]|alpha_dash|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('email_partenaire', '"Email"', 'trim|required|min_length[5]|encode_php_tags|xss_clean|valid_email');
		$this->form_validation->set_rules('choix_partenaire', '"Choix"', 'trim|required|exact_length[1]|xss_clean');
		
		if($this->form_validation->run())
	    {
			if($this->input->post('validation') == 'creerpartenaire')
			{
				$this->action_model->save_action('annonce partenariat', $this->id_ip);
		        $entreprise_partenaire = $this->input->post('entreprise_partenaire');
				$adresse_partenaire = $this->input->post('adresse_partenaire');
				$localisation_partenaire = $this->input->post('localisation_partenaire');
				$contact_partenaire = $this->input->post('contact_partenaire');
				$telephone_partenaire = $this->input->post('telephone_partenaire');
				$email_partenaire = $this->input->post('email_partenaire');
				$choix_partenaire = $this->input->post('choix_partenaire');
				$this->load->model('partenaire_model');
				$this->partenaire_model->save_partenaire($entreprise_partenaire, $adresse_partenaire, $localisation_partenaire, $contact_partenaire, $telephone_partenaire, $email_partenaire, $choix_partenaire, $this->id_ip);
		    	$this->partenaire();
			}
		}
		else
	    {
			$data['user_ip'] = $this->idip;
			
			$this->load->library('layout');
			$this->load_assets();
			$this->layout->ajouter_js('bootstrap/js/bootstrap-transition');
			$this->layout->ajouter_js('bootstrap/js/bootstrap-carousel');
			$this->layout->ajouter_js('activ_carousel');
			$this->layout->set_titre('Annonce partenaire');
			//$this->layout->set_theme('disco');
			
			$this->layout->views('header', $data)
				->views('nav')
				->views('carousel')
				->view('annoncepartenaire');
		}
    }
	
	public function actu()
    {
    	$this->action_model->save_action('actu', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Toutes l\'Actualité');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('actu');
    }
	
    public function agenda()
    {
    	$this->action_model->save_action('agenda', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Evenement et agenda');
		
		$this->load->model('discosoupe_model');
		/*
		$discosoupe = $this->discosoupe_model->get_discosoupe();
		foreach ($discosoupe as $disco) {
			echo "<br />date : ".$disco->date;
			echo "<br />ville : ".$disco->date;
		}
		 * */
		$data['discosoupe'] = $this->discosoupe_model->get_discosoupe();
		$this->layout->views('header', $data)
			->views('nav')
			->view('agenda');
    }
	
	public function association()
    {
    	$this->action_model->save_action('association', $this->id_ip);
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
    	$this->action_model->save_action('gaspillage', $this->id_ip);
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
    	$this->action_model->save_action('disco soupe', $this->id_ip);
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
    	$this->action_model->save_action('partenaire', $this->id_ip);
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
    	$this->action_model->save_action('localisation', $this->id_ip);
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