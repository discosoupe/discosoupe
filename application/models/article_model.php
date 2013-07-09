<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Article_model extends CI_Model
{
	private $table = 'article';
	
	public function save_article($titre, $date, $description)
    {
		$this->db->set('titre', $titre);
		$this->db->set('date', $date);
		$this->db->set('description', $description);
		return $this->db->insert($this->table);
    }
	
	public function get_article($nb = 50, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->limit($nb, $debut)
			->get()
			->result();
    }
}