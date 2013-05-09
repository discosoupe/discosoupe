<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Partenaire_model extends CI_Model
{
	private $table = 'partenaire';
	
	public function save_partenaire($entreprise, $adresse, $ville, $contact, $telephone, $email, $choix, $id_ip)
    {
    	$this->db->set('entreprise', $entreprise);
		$this->db->set('ville', $ville);
		$this->db->set('contact', $contact);
		$this->db->set('choix', $choix);
		$this->db->set('adresse', $adresse);
		$this->db->set('telephone', $telephone);
		$this->db->set('email', $email);
		$this->db->set('idippartenaire',  $id_ip);
		return $this->db->insert($this->table);
    }
	
	public function get_partenaire($nb = 10, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->where('date >', 'NOW()')
			->limit($nb, $debut)
			->order_by('id', 'desc')
			->get()
			->result();
    }
}