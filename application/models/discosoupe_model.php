<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Discosoupe_model extends CI_Model
{
	private $table = 'discosoupe';
	
	public function save_discosoupe($date, $ville, $contact, $evenement, $id_ip, $latitude)
    {
    	$idvilledisco = NULL;
    	$existville = $this->db
    	->select('idville, ville')
		->from('ville')
    	->where('ville', $ville)
		->get()
		->result();
		if($existville == NULL){
			$this->db->set('ville', $ville);
			$this->db->set('latitude',  $latitude);
			$this->db->insert('ville');
			$idvilledisco = $this->db->insert_id('ville');
		}
		else{
			$idvilledisco = $existville[0]->idville;
		}
		
		$timestamp = $date;
		$this->db->set('idvilledisco', $idvilledisco);
		$this->db->set('date', $timestamp);
		$this->db->set('contact', $contact);
		$this->db->set('evenement', $evenement);
		$this->db->set('idipdiscosoupe',  $id_ip);
		$this->db->set('valide', 1);
		return $this->db->insert($this->table);
    }
	
	public function get_discosoupe($nb = 50, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->join('ville', 'ville.idville = '.$this->table.'.idvilledisco')
			->where('date > NOW() - INTERVAL 1 DAY')
			->where('valide !=', 3)
			->limit($nb, $debut)
			->get()
			->result();
    }
	
	public function suppr_discosoupe($iddiscosoupe)
	{
		$data = array(
	           'valide' => 3,
	        );
		$this->db->where('iddiscosoupe', $iddiscosoupe);
		$this->db->update($this->table, $data); 
	}
}