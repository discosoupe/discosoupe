<?php 

class Welcome extends CI_Controller {
	private $id_ip;

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
		setlocale (LC_ALL, 'fr_FR.utf8'); 
		$data = array();
		foreach ($result as $resultat) {
			$this->id_ip = $resultat->idip;
		}
		$this->load->model('action_model');
		$this->connexion();
	}
	
	public function index()
    {
        $this->accueil();
    }
	
	public function load_assets(){
		$this->layout->ajouter_css('bootstrap/css/bootstrap.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive.min');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_ext('http://code.jquery.com/jquery-1.9.1.js');
		$this->layout->ajouter_ext('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
	}
	
	public function connexion()
    {
    	if($this->input->post('login') && $this->input->post('password'))
		{
			if($this->input->post('login') == 'admin' && $this->input->post('password') == 'disco'){
				$this->action_model->save_action('connexion', $this->id_ip);
				$this->session->set_userdata(array('is_logged_in'=>'ok'));
			}else{
				$this->action_model->save_action('tentative de connexion', $this->id_ip);
			}
		}
		if($this->input->post('deconnexion')){
			$this->action_model->save_action('deconnexion', $this->id_ip);
			$this->session->unset_userdata('is_logged_in');
			$this->session->sess_destroy();
		}
	}
		
	public function accueil()
    {
    	$this->action_model->save_action('accueil', $this->id_ip);
    	$this->load->library('form_validation');
  
		$data['user_ip'] = $this->id_ip;
			
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
	
	public function valideagenda()
    {
    	
		$this->action_model->save_action('valideagenda', $this->id_ip);
		$this->load->library('form_validation');
		
    	$this->form_validation->set_rules('lat', '"Latitude"', 'xss_clean');
		$this->form_validation->set_rules('date', '"Format de date"', 'trim|required|max_length[25]|xss_clean');
	    $this->form_validation->set_rules('lieu', '"Lieu"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('evenement', '"Evènement"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('telephone', '"Téléphone"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('contact', '"Contact"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[1]|encode_php_tags|xss_clean|valid_email');
		
		$data['date'] = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
		$data['lieu'] = $this->input->post('lieu');
		$data['adresse'] = $this->input->post('adresse');
		$data['evenement'] = $this->input->post('evenement');
		$data['telephone'] = $this->input->post('telephone');
		$data['contact'] = $this->input->post('contact');
		$data['email'] = $this->input->post('email');
		
		require_once('recaptchalib.php');
				
		// Get a key from https://www.google.com/recaptcha/admin/create
		$publickey = "6Lc6vs0SAAAAAC9hHEbNlNG8bzxP65eqMxqh3WO3";
		$privatekey = "6Lc6vs0SAAAAAEFsAQjkNKrFqqCZZwYkoc_YKbzJ";
		
		# the response from reCAPTCHA
		$resp = null;
		# the error code from reCAPTCHA, if any
		$error = null;
		
		# was there a reCAPTCHA response?
		if (isset($_POST["recaptcha_response_field"])) {
		        $resp = recaptcha_check_answer ($privatekey,
		                                        $_SERVER["REMOTE_ADDR"],
		                                        $_POST["recaptcha_challenge_field"],
		                                        $_POST["recaptcha_response_field"]);
		
		        if ($resp->is_valid) {
		        	if($this->form_validation->run()){
						if($this->input->post('validation') == 'creedisco')
					    {
					        $this->action_model->save_action('annonce disco', $this->id_ip);
					        $date = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
							$lieu = $this->input->post('lieu');
							$adresse = $this->input->post('adresse');
							$evenement = $this->input->post('evenement');
							$telephone = $this->input->post('telephone');
							$contact = $this->input->post('contact');
							$email = $this->input->post('email');
							$latitude = $this->input->post('lat');
							$this->load->model('discosoupe_model');
							$this->discosoupe_model->save_discosoupe($date, $lieu, $contact, $evenement, $adresse, $telephone, $email, $this->id_ip, $latitude);
							
							$this->load->library('layout');
							$this->load_assets();
							$this->layout->ajouter_ext('https://maps.googleapis.com/maps/api/js?key=AIzaSyByHqIM6t2XjMg6PMCTT11-4IGAT43Angc&sensor=false');
							$this->layout->set_titre('Agenda');
					
							redirect('/agenda');
						}
					} 
		        } else {
		                # set the error code so that we can display it
		                $error = $resp->error;
		        }
		}
		$data['recaptcha'] = recaptcha_get_html($publickey, $error);
		
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->ajouter_ext('https://maps.googleapis.com/maps/api/js?key=AIzaSyByHqIM6t2XjMg6PMCTT11-4IGAT43Angc&sensor=false');
		$this->layout->set_titre('Valide Evènement');

		$this->layout->views('header', $data)
			->views('nav')
			->view('valideagenda');
    }

	public function annoncepartenaire()
    {
    	$this->action_model->save_action('annonce partenaire', $this->id_ip);
    	$this->load->library('form_validation');
  
		$data['user_ip'] = $this->id_ip;
		
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
	
	public function validepartenaire()
    {
    	
		$this->action_model->save_action('valideagenda', $this->id_ip);
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('entreprise_partenaire', '"Entreprise"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('adresse_partenaire', '"Adresse"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('localisation_partenaire', '"Localisation"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('contact_partenaire', '"Contact"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
    	$this->form_validation->set_rules('telephone_partenaire', '"Téléphone"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('email_partenaire', '"Email"', 'trim|required|min_length[1]|encode_php_tags|xss_clean|valid_email');
		$this->form_validation->set_rules('choix_partenaire', '"Choix"', 'trim|required|exact_length[1]|xss_clean');
		
		$data['entreprise_partenaire'] = $this->input->post('entreprise_partenaire');
		$data['adresse_partenaire'] = $this->input->post('adresse_partenaire');
		$data['localisation_partenaire'] = $this->input->post('localisation_partenaire');
		$data['contact_partenaire'] = $this->input->post('contact_partenaire');
		$data['telephone_partenaire'] = $this->input->post('telephone_partenaire');
		$data['email_partenaire'] = $this->input->post('email_partenaire');
		$data['choix_partenaire'] = $this->input->post('choix_partenaire');
		
		require_once('recaptchalib.php');
				
		// Get a key from https://www.google.com/recaptcha/admin/create
		$publickey = "6Lc6vs0SAAAAAC9hHEbNlNG8bzxP65eqMxqh3WO3";
		$privatekey = "6Lc6vs0SAAAAAEFsAQjkNKrFqqCZZwYkoc_YKbzJ";
		
		# the response from reCAPTCHA
		$resp = null;
		# the error code from reCAPTCHA, if any
		$error = null;
		
		# was there a reCAPTCHA response?
		if (isset($_POST["recaptcha_response_field"])) {
		        $resp = recaptcha_check_answer ($privatekey,
		                                        $_SERVER["REMOTE_ADDR"],
		                                        $_POST["recaptcha_challenge_field"],
		                                        $_POST["recaptcha_response_field"]);
		
		        if ($resp->is_valid) {
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
					    	redirect('/partenaire');
						}
					}
		        } else {
		                # set the error code so that we can display it
		                $error = $resp->error;
		        }
		}
		$data['recaptcha'] = recaptcha_get_html($publickey, $error);
		
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Valide Partenaire');

		$this->layout->views('header', $data)
			->views('nav')
			->view('validepartenaire');
    }
	
	public function actu()
    {
    	$this->action_model->save_action('actu', $this->id_ip);
		
		$this->load->model('article_model');
		if ($this->session->userdata('is_logged_in') == 'ok'){
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('titre', '"Titre"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
		    $this->form_validation->set_rules('date', '"Format de date"', 'trim|required|max_length[25]|xss_clean');
		    $this->form_validation->set_rules('description', '"Description"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
			
			if($this->form_validation->run())
		    {
		    	if($this->input->post('creerarticle') == 'ajouter')
				{
		    		$this->action_model->save_action('creer article', $this->id_ip);
					
					$config['upload_path'] = './assets/images/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']	= '1000';
					$config['max_width']  = '1024';
					$config['max_height']  = '1068';
					$config['file_name'] = 'testeur'; 
					
					$this->load->library('upload', $config);
					
					$result = array('upload_data' => $this->upload->data());
					
					if ( ! $this->upload->do_upload())
					{
						$error = array('error' => $this->upload->display_errors());
						echo 'echec de l\'enregistrement du fichier';
					 	var_dump($error);
					}	

					$titre = $this->input->post('titre');
					$date = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
					$description = $this->input->post('description');
					$this->article_model->save_article($titre, $date, $description);
				}
			}	
		}
		$data['article'] = $this->article_model->get_article();
						
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->ajouter_css('jquery-ui');
		$this->layout->ajouter_css('jquery-ui-timepicker-addon');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-fileupload.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-fileupload.min');
		$this->layout->ajouter_js('jquery-ui-sliderAccess');
		$this->layout->ajouter_js('jquery-ui-timepicker-addon');
		$this->layout->set_titre('Toutes l\'Actualité');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('actu', $data);
    }
	
    public function agenda()
    {
    	$this->action_model->save_action('agenda', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->ajouter_ext('https://maps.googleapis.com/maps/api/js?key=AIzaSyByHqIM6t2XjMg6PMCTT11-4IGAT43Angc&sensor=false');
		$this->layout->set_titre('Evenement et agenda');
		
		$this->load->model('discosoupe_model');
		$data['discosoupe'] = $this->discosoupe_model->get_discosoupe();
		
		$this->layout->views('header', $data)
			->views('nav')
			->view('agenda');
    }
	
	public function presse()
    {
    	$this->action_model->save_action('presse', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Presse');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('presse');
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
	
	public function concept()
    {
    	$this->action_model->save_action('concept', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Concept');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('concept');
    }
	
	public function historique()
    {
    	$this->action_model->save_action('historique', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Historique');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('historique');
    }
	
	public function valeur()
    {
    	$this->action_model->save_action('valeur', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('Valeur');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('valeur');
    }
	
	public function localisation()
    {
    	$this->action_model->save_action('localisation', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('localisation');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('localisation');
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
	
	public function recette()
    {
    	$this->action_model->save_action('recette', $this->id_ip);
        $this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('recette');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('recette');
    }
	
	public function tutoriel()
    {
    	$this->action_model->save_action('tutoriel', $this->id_ip);
        $this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('tutoriel');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('tutoriel');
    }

	public function toolbox()
    {
    	$this->action_model->save_action('toolbox', $this->id_ip);
        $this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('toolbox');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('toolbox');
    }
	
	public function atelier()
    {
    	$this->action_model->save_action('atelier', $this->id_ip);
        $this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('atelier');
		//$this->layout->set_theme('disco');
		$this->layout->views('header')
			->views('nav')
			->view('atelier');
    }
	
	public function partenaire()
    {
    	$this->action_model->save_action('partenaire', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('espace partenaires');
		
		$this->load->model('partenaire_model');
		$data['partenaire'] = $this->partenaire_model->get_partenaire();

		$this->layout->views('header', $data)
			->views('nav')
			->view('partenaire');
    }
	
	public function aide()
    {
    	$this->action_model->save_action('aide', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('comment nous aider');
		
		$this->layout->views('header')
			->views('nav')
			->view('aide');
    }
	
	public function dossier()
    {
    	$this->action_model->save_action('dossier', $this->id_ip);
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->set_titre('dossier de presse');
		
		$this->layout->views('header')
			->views('nav')
			->view('dossier');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */