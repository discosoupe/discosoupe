<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Lienutile_model extends CI_Model
{
	private $table = 'lienutile';
	
	public function save_lienutile($titre, $descriptionlienutile, $url)
    {
    	$this->db->set('titre', $titre);
		$this->db->set('descriptionlienutile', $descriptionlienutile);
		$this->db->set('url', $url);
		return $this->db->insert($this->table);
    }
	
	public function get_lienutile($nb = 50, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->limit($nb, $debut)
			->get()
			->result();
    }
	
	public function delete_lienutile($idlienutile){
		$this->db->delete($this->table, array('idlienutile' => $idlienutile)); 
	}
}