<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Carousel_model extends CI_Model
{
	private $table = 'carousel';
	
	public function save_carousel($liencarousel, $descriptioncarousel)
    {
    	$this->db->set('liencarousel', $liencarousel);
		$this->db->set('descriptioncarousel', $descriptioncarousel);
		return $this->db->insert($this->table);
    }
	
	public function get_carousel($nb = 50, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->limit($nb, $debut)
			->get()
			->result();
    }
	
	public function delete_carousel($idcarousel){
		$this->db->delete($this->table, array('idcarousel' => $idcarousel)); 
	}
}