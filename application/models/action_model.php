<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Action_model extends CI_Model
{
	private $table = 'action';
	
	public function save_action($action)
    {
		$this->db->set('action', $action);
		$this->db->set('user_agent',  $this->session->userdata('user_agent'));
		$this->db->set('ip',  $this->session->userdata('ip_address'));
		return $this->db->insert($this->table);
    }
}