<?php 

class Fr extends CI_Controller {
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
	
	public function connectwithfb(){
		if(ENVIRONNEMENT == 'PROD'){
			require 'src/facebook.php';
	
			$facebook = new Facebook(array(
			  'appId'  => '150299105165119',
			  'secret' => 'f880e1778ff569d43b10840ac90997f7',
			));
			
			// See if there is a user from a cookie
			$user = $facebook->getUser();
			
			$user_profile = NULL;
			
			if ($user) {
			  try {
			    // Proceed knowing you have a logged in user who's authenticated.
			    $user_profile = $facebook->api('/me');
			  } catch (FacebookApiException $e) {
			    //echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			    $user = NULL;
			  }
			}
			if($user_profile != NULL){
				$this->load->model('user_model');
				$id_user = $this->user_model->connect($user_profile['name'], $user_profile['id'].'disco');
				if($id_user){
					if($id_user[0]->valide == 2){
						$this->session->set_userdata(array('is_logged_in'=>'ok'));
						$this->session->set_userdata(array('facebook'=>'ok'));
					}
				}else{
					$this->user_model->save_user($user_profile['name'], $user_profile['id'].'disco');
					/* envoie de mail*/
					$to      = 'bertrand@viravong.fr';
				    $subject = "Une nouvelle personne vient de s'inscrire sur facebook";
				    $message = "Une nouvelle personne vient de s'inscrire sur facebook";
				    $headers = 'From: '.$this->input->post('mail').'' . "\r\n" .
				    'Reply-To: '.$this->input->post('mail').'' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
				    mail($to, $subject, $message, $headers);
					redirect('inscrit');
				}
			}else{
				if($this->session->userdata('facebook') == 'ok'){
					$this->action_model->save_action('deconnexionfb', $this->id_ip);
					$this->session->unset_userdata('is_logged_in');
					$this->session->sess_destroy();
				}
			}
			return $user_profile;
		}
		if(ENVIRONNEMENT == 'DEV'){
			return NULL;
		}
	}
	
	public function eventwithfb($listeidevent){
		if(ENVIRONNEMENT == 'PROD'){
	
			$facebook = new Facebook(array(
			  'appId'  => '150299105165119',
			  'secret' => 'f880e1778ff569d43b10840ac90997f7',
			));
			
			$user_profile = NULL;
			
			$nbidevent = count($listeidevent);
			if($nbidevent > 0)
			{
				$fql = "SELECT 
				            eid, name, pic_big, start_time, end_time, host, location, description, attending_count
				        FROM 
				            event ";
				for($i = 0; $i < $nbidevent; $i++){
					if($i == 0){
						$fql .= "WHERE  eid = ".$listeidevent[$i];
					}else{
						$fql .= "OR  eid = ".$listeidevent[$i];
					}
				}
				$fql .= " ORDER BY 
				            start_time asc";
				
				/* $fql = "SELECT 
				            name, pic, start_time, end_time, location, description 
				        FROM 
				            event 
				        WHERE 
				            eid IN ( SELECT eid FROM event_member WHERE uid = 221167777906963 ) 
				        AND 
				            start_time >= now()
				        ORDER BY 
				            start_time desc";			
				*/
				
				$param  =   array(
				    'method'    => 'fql.query',
				    'query'     => $fql,
				    'callback'  => ''
				);
				
			 	try {
			    	// Proceed knowing you have a logged in user who's authenticated.
			    	$user_profile = $facebook->api($param);
			  	} catch (FacebookApiException $e) {
			    	//echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			    	$user = NULL;
			    }
		    }
			return $user_profile;
		}
		if(ENVIRONNEMENT == 'DEV'){
			return NULL;
		}
	}
	
	
	public function index()
    {
    	redirect("https://www.facebook.com/DiscoSoupe?fref=ts");
        //$this->accueil();
    }
	
	public function load_assets(){
		$this->layout->ajouter_css('bootstrap/css/bootstrap');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-responsive');
		$this->layout->ajouter_css('discosoupe');
		$this->layout->ajouter_ext('http://code.jquery.com/jquery-1.9.1.js');
		$this->layout->ajouter_ext('http://code.jquery.com/ui/1.10.3/jquery-ui.js');
		$this->layout->ajouter_js('bootstrap/js/bootstrap.min');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tab');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-dropdown');
	}
	
	public function connexion()
    {
    	
    	if($this->input->post('mail') && $this->input->post('password'))
		{
			if($this->input->post('mail') == 'admin' && $this->input->post('password') == 'disco'){
				$this->action_model->save_action('connexion', $this->id_ip);
				$this->session->set_userdata(array('is_logged_in'=>'ok'));
			}else{
				if($this->input->post('inscription') == 'inscription'){
					$this->load->model('user_model');
					$this->user_model->save_user($this->input->post('mail'), $this->input->post('password'));
					/* envoie de mail*/
					$to      = 'bertrand@viravong.fr';
				    $subject = "Une nouvelle personne vient de s'inscrire";
				    $message = "Une nouvelle personne vient de s'inscrire";
				    $headers = 'From: '.$this->input->post('mail').'' . "\r\n" .
				    'Reply-To: '.$this->input->post('mail').'' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();
				    mail($to, $subject, $message, $headers);
					redirect('inscrit');
				}
				if($this->input->post('connexion') == 'connexion'){
					$this->load->model('user_model');
					$id_user = $this->user_model->connect($this->input->post('mail'), $this->input->post('password'));
					if($id_user && $id_user[0]->valide == 2){
						$this->session->set_userdata(array('is_logged_in'=>'ok'));
					}else{
						echo "<script>
							alert('identifiant ou mot de passe incorect');
						</script>";
					}
				}
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
		$data['user_profile'] = $this->connectwithfb();
			
		$this->load->library('layout');
		$this->load_assets();
		$this->layout->ajouter_css('jquery-ui');
		$this->layout->ajouter_css('jquery-ui-timepicker-addon');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-transition');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-carousel');
		$this->layout->ajouter_js('jquery-ui-sliderAccess');
		$this->layout->ajouter_js('jquery-ui-timepicker-addon');
		$this->layout->ajouter_js('activ_carousel');
		$this->layout->set_titre('Disco Soupe');
		//$this->layout->set_theme('disco');
		$this->load->model('carousel_model');
		
		if($this->session->userdata('is_logged_in') == 'ok'){
			if($this->input->post('ajouterphoto') == 'ajouterphoto'){
				$dossier = './assets/images/carousel/';
				$ancien_nom_ajouterphoto = $_FILES['filecarousel']['name'];
				$nom_fichier_ajouterphoto = time().'.'.end(explode(".", $ancien_nom_ajouterphoto));
				$nom_ajouterphoto = NULL;
				if(isset($_FILES['filecarousel']))
				{
					if(move_uploaded_file($_FILES['filecarousel']['tmp_name'], $dossier . $nom_fichier_ajouterphoto)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
				     {
				     	$nom_ajouterphoto = $nom_fichier_ajouterphoto;
				     	//echo 'Upload effectué avec succès !';
				     }
				}
				$this->carousel_model->save_carousel($nom_ajouterphoto, "");
			}
			if($this->input->post('supprimerphoto')){
				$this->carousel_model->delete_carousel($this->input->post('supprimerphoto'));
			}
		}
		
		$data['allcarousel'] = $this->carousel_model->get_carousel();
		
		$this->layout->views('header', $data)
			->views('nav')
			->views('carousel')
			->views('accueil')
			->view('footer');
    }
	
	public function valideuser()
    {
    	if($this->session->userdata('is_logged_in') == 'ok'){
	    	$this->action_model->save_action('valideuser', $this->id_ip);
	    	$this->load->library('form_validation');
	  
			$this->load->library('layout');
			$this->load_assets();
			$this->layout->ajouter_css('jquery-ui');
			$this->layout->ajouter_css('jquery-ui-timepicker-addon');
			$this->layout->ajouter_js('bootstrap/js/bootstrap-transition');
			$this->layout->ajouter_js('bootstrap/js/bootstrap-carousel');
			$this->layout->ajouter_js('jquery-ui-sliderAccess');
			$this->layout->ajouter_js('jquery-ui-timepicker-addon');
			$this->layout->ajouter_js('activ_carousel');
			$this->layout->set_titre('Valider Disco Copain');
			//$this->layout->set_theme('disco');
			
			$data['user_profile'] = $this->connectwithfb();
			
			$this->load->model('user_model');
			
			if($this->input->post('valideuser')){
				$this->user_model->valideuser($this->input->post('valideuser'));
			}
			
			$data['usertovalide'] = $this->user_model->getusertovalide();
			
			$this->layout->views('header', $data)
				->views('nav')
				->views('valideuser')
				->view('footer');
		}
	}
	
	public function calendar(){
		$month = isset($_GET['month']) ? $_GET['month'] : date('n');
		$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
		
		$this->load->model('discosoupe_model');
		$data['discosoupe'] = $this->discosoupe_model->get_discosoupe();
		
		$table = $data['discosoupe'];
		
		$array = array();
		
		for($i = 0; $i < count($table); $i++){
			if($table[$i]->valide == 1){
				$array_evenement = array(
					date('d/m/Y' , strtotime($table[$i]->date)),
				    $table[$i]->evenement, 
				    '#'.$table[$i]->iddiscosoupe, 
				    '#CAD91A'
				);
			}
			if($table[$i]->valide == 2){
				$array_evenement = array(
					date('d/m/Y' , strtotime($table[$i]->date)),
				    $table[$i]->contact, 
				    'https://www.facebook.com/events/'.$table[$i]->evenement, 
				    '#7A4C61',
				);
			}
			array_push($array, $array_evenement);
		}
		
		echo json_encode($array);
	}
	
	public function valideagenda()
    {
		$this->action_model->save_action('valideagenda', $this->id_ip);
		$this->load->library('form_validation');
		
		$data['user_profile'] = $this->connectwithfb();
		
    	$this->form_validation->set_rules('lat', '"Latitude"', 'xss_clean');
		$this->form_validation->set_rules('date', '"Format de date"', 'trim|required|max_length[25]|xss_clean');
	    $this->form_validation->set_rules('ville', '"ville"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
    	//$this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('evenement', '"Evènement"', 'trim|required|min_length[1]|encode_php_tags|xss_clean');
    	//$this->form_validation->set_rules('telephone', '"Téléphone"', 'trim|required|min_length[1]|max_length[52]|encode_php_tags|xss_clean');
	    $this->form_validation->set_rules('contact', '"Contact"', 'trim|required|min_length[1]|encode_php_tags|xss_clean|valid_email');
    	//$this->form_validation->set_rules('email', '"Email"', 'trim|required|min_length[1]|encode_php_tags|xss_clean|valid_email');
		
		$data['date'] = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
		$data['ville'] = $this->input->post('ville');
		//$data['adresse'] = $this->input->post('adresse');
		$data['evenement'] = $this->input->post('evenement');
		//$data['telephone'] = $this->input->post('telephone');
		$data['contact'] = $this->input->post('contact');
		//$data['email'] = $this->input->post('email');
		
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
							$ville = $this->input->post('ville');
							//$adresse = $this->input->post('adresse');
							$evenement = $this->input->post('evenement');
							//$telephone = $this->input->post('telephone');
							$contact = $this->input->post('contact');
							//$email = $this->input->post('email');
							$latitude = $this->input->post('lat');
							$this->load->model('discosoupe_model');
							$this->discosoupe_model->save_discosoupe($date, $ville, $contact, $evenement, $this->id_ip, $latitude);
							
							$this->load->library('layout');
							$this->load_assets();
							$this->layout->ajouter_ext('https://maps.googleapis.com/maps/api/js?key=AIzaSyAp0YYHWdMGFPR4donJzAZTtq33lcCOHDE&sensor=false');
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
		$this->layout->ajouter_ext('https://maps.googleapis.com/maps/api/js?key=AIzaSyAp0YYHWdMGFPR4donJzAZTtq33lcCOHDE&sensor=false');
		$this->layout->set_titre('Valide Evènement');

		$this->layout->views('header', $data)
			->views('nav')
			->views('valideagenda')
			->view('footer');
    }

	public function synchroniserfb(){
		if($this->session->userdata('is_logged_in') == 'ok'){
	    	$this->action_model->save_action('synchroniserfb', $this->id_ip);
	    	$this->load->library('form_validation');
	  
			$this->load->library('layout');
			$this->load_assets();
			$this->layout->set_titre('Synchroniser Evenement Facebook');
			//$this->layout->set_theme('disco');
			
			$data['user_profile'] = $this->connectwithfb();
			
			$this->layout->views('header', $data)
				->views('nav')
				->views('synchroniserfb')
				->view('footer');
		}
	}

	public function annoncepartenaire()
    {
    	$this->action_model->save_action('annonce partenaire', $this->id_ip);
    	$this->load->library('form_validation');
  
  		$data['user_profile'] = $this->connectwithfb();
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
			->views('annoncepartenaire')
			->view('footer');
    }
	
	public function validepartenaire()
    {
    	
		$this->action_model->save_action('valideagenda', $this->id_ip);
		$this->load->library('form_validation');
		
		$data['user_profile'] = $this->connectwithfb();
		
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
			->views('validepartenaire')
			->view('footer');
    }
	
	public function actu()
    {
    	$this->action_model->save_action('actu', $this->id_ip);
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load->model('article_model');
		$this->load->model('theme_model');
		$this->load->model('lienutile_model');
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
					$nom_fichier = NULL;
					if(isset($_FILES['userfile']))
					{
						$config['upload_path'] = './assets/images/uploads/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '1000';
						$config['max_width']  = '1024';
						$config['max_height']  = '1068';
						$ancien_nom = $_FILES['userfile']['name'];
						$nom_fichier = time().'.'.end(explode(".", $ancien_nom));
						$config['file_name'] = $nom_fichier; 
						
						$this->load->library('upload', $config);
						
						$result = array('upload_data' => $this->upload->data());
						if ( ! $this->upload->do_upload())
						{
							$error = array('error' => $this->upload->display_errors());
						 	$this->action_model->save_action('echec sauvegarde fichier', $this->id_ip);
							$nom_fichier = NULL;
						}
					}
					
					$dossier = './assets/pj/';
					$ancien_nom_pj = $_FILES['pj']['name'];
					$nom_fichier_pj = time().'.'.end(explode(".", $ancien_nom_pj));
					$nom_pj = NULL;
					if(isset($_FILES['pj']))
					{
						if(move_uploaded_file($_FILES['pj']['tmp_name'], $dossier . $nom_fichier_pj)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
					     {
					     	$nom_pj = $nom_fichier_pj;
					     	//echo 'Upload effectué avec succès !';
					     }
					}
						
					$titre = $this->input->post('titre');
					$date = date('Y-m-d H:i:s', strtotime($this->input->post('date')));
					$description = $this->input->post('description');
					$id = $this->article_model->save_article($titre, $date, $description, $nom_fichier, $nom_pj);
					if($this->input->post('dataexterne')!=NULL && $this->input->post('dataexterne')!=""){
						$this->load->model('lienexterne_model');
						$lienexternes = explode(",", $this->input->post('dataexterne'));
						//todo save_lienexterne avec $this->db->insert_batch
						foreach ($lienexternes as $lienexterne) {
							$this->lienexterne_model->save_lienexterne($lienexterne, $lienexterne, $id);
						}
					}
					if($this->input->post('datatheme')!=NULL && $this->input->post('datatheme')!=""){
						$themes = explode(",", $this->input->post('datatheme'));
						//todo save_theme avec $this->db->insert_batch
						foreach ($themes as $theme) {
							$this->theme_model->save_theme($theme, $id);
						}
					}
				}
			}	
		}
		$data['page'] = NULL;
		if($this->input->get('id')){
			$data['article'] = $this->article_model->get_article_by_id($this->input->get('id'));
		}
		elseif($this->input->get('theme')){
			$data['article'] = $this->article_model->get_article_by_theme($this->input->get('theme'));
		}
		elseif($this->input->get('search')){
			$data['article'] = $this->article_model->get_article_by_search($this->input->get('search'));
		}
		elseif($this->input->get('page')){
			$data['article'] = $this->article_model->get_article_by_page($this->input->get('page')-1);
			$data['page'] = $this->article_model->get_nb_page();
		}
		else{
			$data['article'] = $this->article_model->get_article();
			$data['page'] = $this->article_model->get_nb_page();
		}
		$data['archive'] = $this->article_model->get_archive();
		$data['allthemes'] = $this->theme_model->get_theme();
		$data['lienutile'] = $this->lienutile_model->get_lienutile();
				
		$data['convertjour'] = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
		$data['convertmois'] = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
		
		$this->load->library('layout');
		
		$this->layout->ajouter_js('bootstrap/js/bootstrap-typeahead');
		$this->load_assets();
		$this->layout->ajouter_css('jquery-ui');
		$this->layout->ajouter_css('jquery-ui-timepicker-addon');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-fileupload.min');
		$this->layout->ajouter_css('bootstrap/css/bootstrap-tagmanager');
		$this->layout->ajouter_css('bootstrap/css/bootstrap_2_1.min.css');
		
		$this->layout->ajouter_js('bootstrap/js/bootstrap-tagmanager');
		$this->layout->ajouter_js('bootstrap/js/bootstrap-fileupload.min');
		$this->layout->ajouter_js('jquery-ui-sliderAccess');
		$this->layout->ajouter_js('jquery-ui-timepicker-addon');
		
		$this->layout->set_titre('Toutes l\'Actualité');
		
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('actu', $data)
			->view('footer');
    }
    
    public function majarticle()
    {
		if ($this->session->userdata('is_logged_in') == 'ok'){
			$this->load->model('article_model');
			$this->load->model('theme_model');
			$this->load->model('lienexterne_model');
			
			if($this->input->get('id')){
				if($this->input->post('modifier'.$this->input->get('id')) == 'modifier'){
					$this->action_model->save_action('maj actu', $this->id_ip);
					
					$titre = $this->input->post('titre'.$this->input->get('id'));
					$date = date('Y-m-d H:i:s', strtotime($this->input->post('date'.$this->input->get('id'))));
					$description = $this->input->post('description'.$this->input->get('id'));
					$image = NULL;
					$piecejointe = NULL;
					
					//image
					if(isset($_FILES['userfile']))
					{
						$dossierimage = './assets/images/uploads/';
						$ancien_image = $_FILES['userfile']['name'];
						$nom_fichier_image = time().'.'.end(explode(".", $ancien_image));
						if(move_uploaded_file($_FILES['userfile']['tmp_name'], $dossierimage . $nom_fichier_image)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
					     {
					     	$image = $nom_fichier_image;
					     }
					}
					
					//piece jointe
					if(isset($_FILES['pj'.$this->input->get('id')]))
					{
						$dossier = './assets/pj/';
						$ancien_nom_pj = $_FILES['pj'.$this->input->get('id')]['name'];
						$nom_fichier_pj = time().'.'.end(explode(".", $ancien_nom_pj));
						$piecejointe = NULL;
						if(move_uploaded_file($_FILES['pj'.$this->input->get('id')]['tmp_name'], $dossier . $nom_fichier_pj)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
					     {
					     	$piecejointe = $nom_fichier_pj;
					     	//echo 'Upload effectué avec succès !';
					     }
					}
					$this->article_model->update_article($this->input->get('id'), $titre, $date, $description, $image, $piecejointe);
					
					if($this->input->post('dataexterne'.$this->input->get('id'))!=NULL && $this->input->post('dataexterne'.$this->input->get('id'))!=""){
						$this->lienexterne_model->delete_lienexterne_by_idarticle($this->input->get('id'));
						$lienexternes = explode(",", $this->input->post('dataexterne'.$this->input->get('id')));
						//todo save_lienexterne avec $this->db->insert_batch
						foreach ($lienexternes as $lienexterne) {
							$this->lienexterne_model->save_lienexterne($lienexterne, $lienexterne, $this->input->get('id'));
						}
					}
					if($this->input->post('datatheme'.$this->input->get('id'))!=NULL && $this->input->post('datatheme'.$this->input->get('id'))!=""){
						$this->theme_model->delete_theme_by_idarticle($this->input->get('id'));
						$themes = explode(",", $this->input->post('datatheme'.$this->input->get('id')));
						//todo save_theme avec $this->db->insert_batch
						foreach ($themes as $theme) {
							$this->theme_model->save_theme($theme, $this->input->get('id'));
						}
					}
				}
				if($this->input->post('supprimer'.$this->input->get('id')) == 'supprimer'){
					$this->action_model->save_action('supprimer actu', $this->id_ip);
					$this->theme_model->delete_theme_by_idarticle($this->input->get('id'));
					$this->lienexterne_model->delete_lienexterne_by_idarticle($this->input->get('id'));
					$this->article_model->delete_article($this->input->get('id'));
				}
			}
    		redirect('/actu');
		}
    }

	public function ajoutlienutile()
	{
		if ($this->session->userdata('is_logged_in') == 'ok'){
			if($this->input->post('ajoutlienutile') == 'ajoutlienutile'){
				$this->load->model('lienutile_model');
				$urllienutile = $this->input->post('urllienutile');
				$titrelienutile = $this->input->post('titrelienutile');
				$descriptionlienutile = $this->input->post('descriptionlienutile');
				$this->lienutile_model->save_lienutile($titrelienutile, $descriptionlienutile, $urllienutile);
			}
			if($this->input->get('id')){
				$this->load->model('lienutile_model');
				$this->lienutile_model->delete_lienutile($this->input->get('id'));
			}
			redirect('/actu');
		}
	}
	
    public function agenda()
    {
    	$this->action_model->save_action('agenda', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		
		$this->layout->ajouter_css('bootstrap_calendar');
		$this->layout->ajouter_js('bootstrap_calendar.min');
		
		$this->layout->ajouter_ext('https://maps.googleapis.com/maps/api/js?key=AIzaSyAp0YYHWdMGFPR4donJzAZTtq33lcCOHDE&sensor=false');
		$this->layout->set_titre('Evenement et agenda');
		
		$this->load->model('discosoupe_model');
		$data['discosoupe'] = $this->discosoupe_model->get_discosoupe();
		
		$data['convertjour'] = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
		$data['convertmois'] = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
		
		$table = $data['discosoupe'];
		$listeeventfb = array();
		$listeeventfbok = FALSE;
		$data['event_facebook'] = NULL;
		for($i=0; $i < count($table); $i++)
		{
			// Si valide = 2, ca veut dire que c'est un event facebook
			if($table[$i]->valide == 2){
				$listeeventfbok = TRUE;
				array_push($listeeventfb, $table[$i]->evenement);
			}
		}
		
		if($listeeventfbok == TRUE){
			$data['discosoupefb'] = $this->eventwithfb($listeeventfb);
		}
		
		$this->layout->views('header', $data)
			->views('nav')
			->views('agenda')
			->view('footer');
    }
	
	public function supprimerevenement()
    {
    	if($this->session->userdata('is_logged_in') == 'ok'){
    		if($this->input->post('tosuppr') !=NULL && is_numeric($this->input->post('tosuppr'))){
    			$this->load->model('discosoupe_model');
				$this->discosoupe_model->suppr_discosoupe($this->input->post('tosuppr'));
				redirect('agenda');
			}
		}
	}
	
	public function presse()
    {
    	$this->action_model->save_action('presse', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Presse');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('presse')
			->view('footer');
    }
	
	public function association()
    {
    	$this->action_model->save_action('association', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Notre Association');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('association')
			->view('footer');
    }
	
	public function concept()
    {
    	$this->action_model->save_action('concept', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Concept');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('concept')
			->view('footer');
    }
	
	public function historique()
    {
    	$this->action_model->save_action('historique', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Historique');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('historique')
			->view('footer');
    }
	
	public function valeur()
    {
    	$this->action_model->save_action('valeur', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Valeur');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('valeur')
			->view('footer');
    }
	
	public function localisation()
    {
    	$this->action_model->save_action('localisation', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('localisation');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('localisation')
			->view('footer');
    }
	
	public function gaspillage()
    {
    	$this->action_model->save_action('gaspillage', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Le Gaspillage en image');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('gaspillage')
			->view('footer');
    }
	
	public function discosoupe()
    {
    	$this->action_model->save_action('disco soupe', $this->id_ip);
        $this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('Espace Discopains');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('discosoupe')
			->view('footer');
    }
	
	public function recette()
    {
    	$this->action_model->save_action('recette', $this->id_ip);
        $this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('recette');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('recette')
			->view('footer');
    }
	
	public function tutoriel()
    {
    	$this->action_model->save_action('tutoriel', $this->id_ip);
        $this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('tutoriel');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('tutoriel')
			->view('footer');
    }

	public function toolbox()
    {
    	$this->action_model->save_action('toolbox', $this->id_ip);
        $this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('toolbox');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('toolbox')
			->view('footer');
    }
	
	public function atelier()
    {
    	$this->action_model->save_action('atelier', $this->id_ip);
        $this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('atelier');
		//$this->layout->set_theme('disco');
		$this->layout->views('header', $data)
			->views('nav')
			->views('atelier')
			->view('footer');
    }
	
	public function partenaire()
    {
    	$this->action_model->save_action('partenaire', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('espace partenaires');
		
		$this->load->model('partenaire_model');
		$data['partenaire'] = $this->partenaire_model->get_partenaire();

		$this->layout->views('header', $data)
			->views('nav')
			->views('partenaire')
			->view('footer');
    }
	
	public function aide()
    {
    	$this->action_model->save_action('aide', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('comment nous aider');
		
		$this->layout->views('header', $data)
			->views('nav')
			->views('aide')
			->view('footer');
    }
	
	public function dossier()
    {
    	$this->action_model->save_action('dossier', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		$data['event_facebook'] = $this->eventwithfb(2);
		
		$this->load->library('form_validation');
		
    	$this->form_validation->set_rules('fblinkevent', '"lien facebook"', 'xss_clean');
	    
		if($this->input->post('fblinkevent')){
			$lienfb = $this->input->post('fblinkevent');
			
			$tablefb = explode("/", $lienfb);
			
			if(is_numeric($tablefb[4])){
				echo "le lien fb : ".$tablefb[4];
			}
		}
		
		$this->load_assets();
		$this->layout->set_titre('dossier de presse');
		
		$this->layout->views('header', $data)
			->views('nav')
			->views('dossier', $data)
			->view('footer');
    }
	
	public function inscrit()
    {
    	$this->action_model->save_action('inscrit', $this->id_ip);
		$this->load->library('layout');
		
		$data['user_profile'] = $this->connectwithfb();
		
		$this->load_assets();
		$this->layout->set_titre('inscrit');
		
		$this->layout->views('header', $data)
			->views('nav')
			->views('inscrit')
			->view('footer');
    }
	
	public function footercontact(){
		$this->load->library('form_validation');
	  
	    $this->form_validation->set_rules('footerobjet', '"Objet"', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('footermessage','"Message"', 'trim|required|xss_clean');
		$this->form_validation->set_rules('footermail','"Mail"', 'trim|required|xss_clean');
		
	    $to      = 'contact@discosoupe.org';
	    $subject = $this->input->post('footerobjet');
	    $message = $this->input->post('footermessage');
	    $headers = 'From: '.$this->input->post('footermail').'' . "\r\n" .
	    'Reply-To: '.$this->input->post('footermail').'' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();
	
	    mail($to, $subject, $message, $headers);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */