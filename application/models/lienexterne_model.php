<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Lienexterne_model extends CI_Model
{
	private $table = 'lienexterne';
	
	public function save_lienexterne($desccription, $url, $idarticlelienexterne)
    {
		$this->db->set('description', $desccription);
		$this->db->set('url', $url);
		$this->db->set('idarticlelienexterne', $idarticlelienexterne);
		return $this->db->insert($this->table);
    }
	
	public function get_lienexterne($nb = 50, $debut = 0)
    {
		return $this->db->select('*')
			->from($this->table)
			->limit($nb, $debut)
			->get()
			->result();
    }
	
	/*
	public function update($idargument, $titre, $categorie, $description, $titrededebatsousjacent, $descriptiondebatsousjacent){
		$data = array(
           'idargument' => $idargument,
           'titre' => $titre,
           'categorie' => $categorie,
           'description' => $description,
           'titrededebatsousjacent' => $titrededebatsousjacent,
           'descriptiondebatsousjacent' => $descriptiondebatsousjacent,
        );
		$this->db->where('idargument', $idargument);
		$this->db->update($this->table, $data); 
	}
	*/
	
	public function delete_lienexterne_by_idarticle($idarticlelienexterne){
		$this->db->delete($this->table, array('idarticlelienexterne' => $idarticlelienexterne)); 
	}
}