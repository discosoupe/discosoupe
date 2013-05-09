<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Action_model extends CI_Model
{
	private $table = 'action';
	
	public function save_action($action, $id_ip)
    {
		$this->db->set('action', $action);
		$this->db->set('user_agent',  $this->session->userdata('user_agent'));
		$this->db->set('idipaction', $id_ip);
		return $this->db->insert($this->table);
    }
}