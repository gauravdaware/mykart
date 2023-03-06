<?php 
class Login_model extends CI_Model{
	public function chk_login($data){
		$this->db->select('admin_email,admin_password');
		$this->db->from('mk_admin_tbl');
		$this->db->where('admin_email',$data['admin_email']);
		$this->db->where('admin_password',$data['admin_password']);
		$result_set = $this->db->get();
		return $result_set;
	}
	public function update_login_data($data,$ldata){
		$this->db->where('admin_email',$ldata['admin_email']);
		$res = $this->db->update('mk_admin_tbl',$data);
		
		return $res;
	}
 }
 ?>
