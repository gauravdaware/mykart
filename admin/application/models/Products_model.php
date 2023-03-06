<?php 
class Products_model extends CI_Model{
	public function ajax_subcat($cid){
		$this->db->where('category_id',$cid);
		$this->db->select('sub_category_id,sub_category_name');
		$this->db->order_by('sub_category_name','asc');
		return $this->db->get('mk_sub_categories_tbl');
	}
	public function chk_product($cat_id,$subcat_id,$prod_name){
		$condition = array(
			'category_id'=>$cat_id,
			'sub_category_id'=>$subcat_id,
			'prod_name'=>$prod_name
		);
		return $this->db->select('prod_name')->from('mk_products_tbl')->where($condition)->get();
	}
	public function insert_product($pdata){
		return $this->db->insert('mk_products_tbl',$pdata);	
	}
	public function get_total_product_records(){
		return $this->db->count_all('mk_products_tbl');
	}
	public function get_products($per_page_records,$starting_index){
		$this->db->select('p.*, c.category_name, s.sub_category_name');
		$this->db->from('mk_products_tbl p');
		$this->db->join('mk_categories_tbl c','p.category_id = c.category_id','inner');
		$this->db->join('mk_sub_categories_tbl s','p.sub_category_id = s.sub_category_id','inner');
		$this->db->limit($per_page_records,$starting_index);
		$this->db->where('p.trash',0);
		$this->db->order_by('p.prod_name','asc');
		$res = $this->db->get();
		return $res;

	}
	public function get_prod_status($id){
		$this->db->select('prod_status');
		$this->db->from('mk_products_tbl');
		$this->db->where('prod_id',$id);
		$res = $this->db->get();
		return $res;
	}
	public function update_prod_status($status,$id){		
		$updatedata = array('prod_status' => $status);
		$this->db->where('prod_id',$id);
		return $this->db->update('mk_products_tbl',$updatedata);
	}
	public function trash($id){
		$updatedata = array('trash'=>1);
		$this->db->where('prod_id',$id);
		return $this->db->update('mk_products_tbl',$updatedata);
	}
	public function search($search_string){
		$this->db->select('c.category_name,s.sub_category_name,p.*');
		$this->db->from('mk_products_tbl p');
		$this->db->join('mk_categories_tbl c','p.category_id = c.category_id','inner');
		$this->db->join('mk_sub_categories_tbl s','p.sub_category_id = s.sub_category_id','inner');
		$this->db->like('p.prod_name',$search_string,'both');
		$this->db->where('p.trash',0);
		$this->db->order_by('p.prod_name','asc');
		$res = $this->db->get();
		return $res;
	}
	public function get_trash_products(){
		$this->db->select('s.sub_category_name, c.category_name, p.*');
		$this->db->from('mk_products_tbl p');
		$this->db->where('p.trash',1);
		$this->db->join('mk_categories_tbl c','p.category_id = c.category_id');
		$this->db->join('mk_sub_categories_tbl s','p.category_id = s.sub_category_id');
		$this->db->order_by('p.prod_name','asc');
		$res = $this->db->get();
		return $res;
	}
	public function delete($pid){
		$this->db->where('prod_id',$pid);
		return $this->db->delete('mk_products_tbl');
	}
	public function restore($pid){
		$restoredata = array('trash'=>0);
		$this->db->where('prod_id',$pid);
		return $this->db->update('mk_products_tbl',$restoredata);
	}
		public function trash_search($search_string){
		$this->db->select('c.category_name,s.sub_category_name,p.*');
		$this->db->from('mk_products_tbl p');
		$this->db->join('mk_categories_tbl c','p.category_id = c.category_id','inner');
		$this->db->join('mk_sub_categories_tbl s','p.sub_category_id = s.sub_category_id','inner');
		$this->db->like('p.prod_name',$search_string,'both');
		$this->db->where('p.trash',1);
		$this->db->order_by('p.prod_name','asc');
		$res = $this->db->get();
		return $res;	
	}
}
 ?>
