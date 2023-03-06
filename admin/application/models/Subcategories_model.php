<?php 
class Subcategories_model extends CI_model{
	public function check_subcategory($sub_name,$cat_id){
		return $this->db->select('sub_category_name')->from('mk_sub_categories_tbl')->where('sub_category_name',$sub_name)->where('category_id',$cat_id)->get();
	}
	public function insert_subcategory($scat_data){
		return $this->db->insert('mk_sub_categories_tbl',$scat_data);
	}
	public function get_total_records(){
		return $this->db->count_all('mk_sub_categories_tbl');
	}
	public function get_limited_records($per_page_records,$starting_index){
		$this->db->select('c.category_name,s.*');
		$this->db->from('mk_sub_categories_tbl s');
		$this->db->join('mk_categories_tbl c','s.category_id = c.category_id','inner');
		$this->db->limit($per_page_records,$starting_index);
		$this->db->where('s.trash',0);
		$this->db->order_by('s.sub_category_name','asc');
		$res = $this->db->get();
		return $res;
	}
	public function search($search_string){
		$this->db->select('c.category_name,s.*');
		$this->db->from('mk_sub_categories_tbl s');
		$this->db->join('mk_categories_tbl c','s.category_id = c.category_id','inner');
		$this->db->like('s.sub_category_name',$search_string,'both');
		$this->db->where('s.trash',0);
		$this->db->order_by('s.sub_category_name','asc');
		$res = $this->db->get();
		return $res;
	}
	public function get_subcat_status($id){
		$this->db->select('sub_category_status');
		$this->db->from('mk_sub_categories_tbl');
		$this->db->where('sub_category_id',$id);
		$res = $this->db->get();
		return $res;
	}
	public function update_subcat_status($status,$id){
		$updatedata = array('sub_category_status' => $status);
		$this->db->where('sub_category_id',$id);
		return $this->db->update('mk_sub_categories_tbl',$updatedata);
	}
	public function trash($id){
		$updatedata = array('trash'=>1);
		$this->db->where('sub_category_id',$id);
		return $this->db->update('mk_sub_categories_tbl',$updatedata);
	}
	public function manage_trash(){
		$this->db->select('c.category_name,s.*');
		$this->db->from('mk_sub_categories_tbl s');
		$this->db->join('mk_categories_tbl c','s.category_id = c.category_id','inner');
		$this->db->where('s.trash',1);
		$this->db->order_by('s.sub_category_name','asc');
		return $res = $this->db->get();	
	}
	public function trash_search($search_string){
		$this->db->select('c.category_name,s.*');
		$this->db->from('mk_sub_categories_tbl s');
		$this->db->join('mk_categories_tbl c','s.category_id = c.category_id','inner');

		$this->db->like('s.sub_category_name',$search_string,'both');
		$this->db->where('s.trash',1);
		$this->db->order_by('s.sub_category_name','asc');
		$res = $this->db->get();
		return $res;	
	}
	public function restore($id){
		$restoredata = array('trash'=>0);
		$this->db->where('sub_category_id',$id);
		return $this->db->update('mk_sub_categories_tbl',$restoredata);
	}
	public function delete($id){
		$this->db->where('sub_category_id',$id);
		return $this->db->delete('mk_sub_categories_tbl');
	}
 }
?>