<?php 
class Categories_model extends CI_Model{
	public function check_category($cname){
		$this->db->select('category_name');
		$this->db->from('mk_categories_tbl');
		$this->db->where('category_name',$cname);
		$res = $this->db->get();
		return $res;
	}
	public function insert_category($cdata){
		return $this->db->insert('mk_categories_tbl',$cdata);
	}
	/*Pagination Function*/
	public function get_total_records(){
		$res =  $this->db->count_all('mk_categories_tbl');
		return $res;
	}
	public function get_limited_records($per_page_records,$starting_index){
		$this->db->limit($per_page_records,$starting_index);
		$this->db->where('trash',0);
		$this->db->order_by('category_name','asc');
		$res = $this->db->get('mk_categories_tbl');
		return $res;
	}
	/*End Pagination Function*/
	public function get_categories(){
		$this->db->select('category_id,category_name');
		$this->db->where('trash',0);
		$this->db->order_by('category_name','asc');
		return $this->db->get("mk_categories_tbl");
	}
	public function search($search_string){
		//$this->db->select('mk_categories_tbl'); //this doesnt work
		//below works
		$this->db->like('category_name',$search_string,'both');
		$this->db->where('trash',0);
		$this->db->order_by('category_name','asc');
		$res = $this->db->get('mk_categories_tbl');
		// echo $this->db->last_query();
		// exit;
		return $res;
	}
	public function get_cat_status($id){
		$this->db->select('category_status');
		$this->db->from('mk_categories_tbl');
		$this->db->where('category_id',$id);
		$res = $this->db->get();
		return $res;
	}
	public function update_cat_status($status,$id){
		$updatedata = array('category_status' => $status);
		$this->db->where('category_id',$id);
		return $this->db->update('mk_categories_tbl',$updatedata);
	}
	public function trash($id){
		$updatedata = array('trash'=>1);
		$this->db->where('category_id',$id);
		return $this->db->update('mk_categories_tbl',$updatedata);
	}
	public function manage_trash(){
		$this->db->where('trash',1);
		$this->db->order_by('category_name','asc');
		return $this->db->get("mk_categories_tbl");	
	}
	public function trash_search($search_string){
		$this->db->like('category_name',$search_string,'both');
		$this->db->where('trash',1);
		$this->db->order_by('category_name','asc');
		$res = $this->db->get('mk_categories_tbl');
		return $res;	
	}
	public function restore($id){
		$restoredata = array('trash'=>0);
		$this->db->where('category_id',$id);
		return $this->db->update('mk_categories_tbl',$restoredata);
	}
	public function delete($id){
		$this->db->where('category_id',$id);
		return $this->db->delete('mk_categories_tbl');
	}
}

?>