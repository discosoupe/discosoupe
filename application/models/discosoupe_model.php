<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Discosoupe_model extends CI_Model
{
	private $table = 'discosoupe';
	
	public function save_discosoupe($date, $ville, $contact, $evenement, $adresse, $telephone, $email, $id_ip)
    {
		$timestamp = $date;
		$this->db->set('date', $timestamp);
		$this->db->set('ville', $ville);
		$this->db->set('contact', $contact);
		$this->db->set('evenement', $evenement);
		$this->db->set('adresse', $adresse);
		$this->db->set('telephone', $telephone);
		$this->db->set('email', $email);
		$this->db->set('idipdiscosoupe',  $id_ip);
		return $this->db->insert($this->table);
    }
	
	public function get_discosoupe($nb = 50, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->where('date > NOW()')
			->limit($nb, $debut)
			->get()
			->result();
    }
}