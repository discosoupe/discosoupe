<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User_model extends CI_Model
{
	private $table = 'user';
	
	public function save_user($mail, $password)
    {
    	if($this->db
    	->select('iduser')
    	->where('mail', $mail)
		->count_all_results($this->table) == 0){
    		$this->db->set('mail', $mail);
			$this->db->set('password', $password);
			$this->db->set('valide', 1);
			$this->db->insert($this->table);
			return $this->db->insert_id($this->table);
		}
    }
	
	public function connect($mail, $password){
		return $this->db->select('*')
			->from($this->table)
			->where('mail', $mail)
			->where('password', $password)
			->get()
			->result();
	}
	
	public function getusertovalide(){
		return $this->db->select('*')
			->from($this->table)
			->where('valide = 1')
			->get()
			->result();
	}
	
	public function valideuser($iduser){
		$data = array(
	           'valide' => 2
	        );
		$this->db->where('iduser', $iduser);
		$this->db->update($this->table, $data); 
	}
}