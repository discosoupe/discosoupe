<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Ip_model extends CI_Model
{
	private $table = 'ip';
	
    public function get_info()
    {
        //  On simule l'envoi d'une requête
        return "récupération de données";
    }
	
	public function save_ip()
    {
    	if($this->db
    	->select('ip')
    	->where('ip', $this->session->userdata('ip_address'))
		->count_all_results($this->table) == 0){
    		$this->db->set('ip',  $this->session->userdata('ip_address'));
			$this->db->set('valide', TRUE);
			return $this->db->insert($this->table);
		}
    }
	
	public function verif_ip()
    {
		return $this->db
    	->select('ip')
    	->where('ip', $this->session->userdata('ip_address'))
		->where('valide', TRUE)
		->count_all_results($this->table);
    }
	
}