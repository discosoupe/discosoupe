<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Theme_model extends CI_Model
{
	private $table = 'theme';
	
	public function save_theme($theme, $idtheme)
    {
		$this->db->set('nom', $theme);
		$this->db->set('idarticletheme', $idtheme);
		return $this->db->insert($this->table);
    }
	
	public function get_theme()
    {
		return $this->db->select('nom, COUNT(nom) AS count', false)
			->distinct()
			->from($this->table)
			->group_by('nom')
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
	
	public function delete_theme_by_idarticle($idarticletheme){
		$this->db->delete($this->table, array('idarticletheme' => $idarticletheme)); 
	}
}