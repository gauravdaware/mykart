<?php 
class Subcategory_controller extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('pagination');
		$this->load->model('Categories_model');
		$this->load->model('Subcategories_model');
	}
	public function subcategory(){
		$result = $this->Categories_model->get_categories();
		$view_data['msg'] = "";
		$view_data['cat_result'] = $result;
		$this->load->view('add_subcategory_view',$view_data);
	}
	public function add_subcategory(){
		if (!empty($this->session->userdata('admin_email'))){
			extract($_POST);
			if(isset($add)){	
				$this->form_validation->set_rules('category','category','required',array('required'=>'Please select a category'));
				$this->form_validation->set_rules('scname','Subcategory Name','required|alpha_numeric_spaces|min_length[3]',array('required'=>'Please enter subcategory name','alpha_numeric_spaces'=>'Enter valid subcategory name','min_length'=>'Minimum 3 charecters required'));
				$this->form_validation->set_rules('priority','Priority','required|numeric',array('required'=>'Please enter priority','numeric'=>'Only numbers please'));
				if($this->form_validation->run()){
					$subcategory_data = array(
							'category_id' => $category,
							'sub_category_name'=>ucwords($scname),
							'sub_category_priority'=>$priority,
							'created_on'=>date('Y-m-d'),
							'sub_category_status'=>$scstatus,
							'trash'=>0
						);
					$res = $this->Subcategories_model->check_subcategory($subcategory_data['sub_category_name'],$subcategory_data['category_id']);
					$count = $res->num_rows();
					if($count==0){
						$insert_result = $this->Subcategories_model->insert_subcategory($subcategory_data);
						$result = $this->Categories_model->get_categories();
						$view_data['cat_result'] = $result;
						$view_data['msg'] = "Success";
						$view_data['msg_2'] = "Subcategory added";
						$this->load->view("add_subcategory_view",$view_data); 	
					}
					else{
						$result = $this->Categories_model->get_categories();
						$view_data['cat_result'] = $result;
						$view_data['msg'] = "Failed";
						$view_data['msg_2'] = "Subcategory already exist";
						$this->load->view("add_subcategory_view",$view_data); 	
					}
				}
				else{
					$this->form_validation->set_error_delimiters('<span style="color:red">','</span>');
					//redirect('Subcategory_controller/subcategory');//this doesnt work
					$result = $this->Categories_model->get_categories();
					$view_data['msg'] = "";
					$view_data['msg_2'] = "";
					$view_data['cat_result'] = $result;
					$this->load->view("add_subcategory_view",$view_data); 
				}
			}
		}

	}
	public function  manage_subcategory(){
		if(!empty($this->session->userdata('admin_email'))){
			$total_records = $this->Subcategories_model->get_total_records();
			/*Pagination Code*/
			$config['base_url'] = base_url()."Subcategory_controller/manage_subcategory";
			$config['total_rows'] = $total_records;
			$config['per_page'] = 6;
			$config['full_tag_open'] = '<ul class="pagination justify-content-center">';
	        $config['full_tag_close'] = '</ul>';
	        $config['num_tag_open'] = '<li class="page-item">';
	        $config['num_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['next_tag_open'] = '<li class="page-item">';
	        $config['next_tagl_close'] = '</a></li>';
	        $config['prev_tag_open'] = '<li class="page-item">';
	        $config['prev_tagl_close'] = '</li>';
	        $config['first_tag_open'] = '<li class="page-item">';
	        $config['first_tagl_close'] = '</li>';
	        $config['last_tag_open'] = '<li class="page-item">';
	        $config['last_tagl_close'] = '</a></li>';
	        $config['attributes'] = array('class' => 'page-link');
			$this->pagination->initialize($config);
			$pages = $this->pagination->create_links();//this method returns string
			$cat_data['page_links'] = $pages;
			$segment = $this->uri->segment(3);
			if(empty($segment))
				$starting_index = 0;
			else
				$starting_index = $segment;
			$result  = $this->Subcategories_model->get_limited_records($config['per_page'],$starting_index);
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("manage_subcategory_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("manage_subcategory_view",$cat_data);	
			}
		}	
		else{
			redirect('Admin_controller');
		}
	}
	public function search_subcategory(){
		extract($_POST);
		if (isset($search)){
			$result = $this->Subcategories_model->search($searchstr);
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("manage_subcategory_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("manage_subcategory_view",$cat_data);	
			}
		}
	}
	public function update_status(){
		$cat_id = $this->uri->segment(3);
		$res = $this->Subcategories_model->get_subcat_status($cat_id);
		$row = $res->row();
		if($row->sub_category_status == 1){
			$change_status = 0;
			$this->Subcategories_model->update_subcat_status($change_status,$cat_id);
			redirect('Categories_controller/manage_category');
		}
		else{
			$change_status = 1;
			$this->Subcategories_model->update_subcat_status($change_status,$cat_id);
			redirect('Subcategory_controller/manage_subcategory');
		}
	}
	public function trash_manage_subcategory(){
		if(!empty($this->session->userdata('admin_email'))){
			$result  = $this->Subcategories_model->manage_trash();
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("trash_manage_sub_category_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("trash_manage_sub_category_view",$cat_data);	
			}
		}
		else{
			redirect('Admin_controller');
		}
	}
	public function trash_subcategory(){
		$cat_id = $this->uri->segment(3);
		$this->Subcategories_model->trash($cat_id);
		redirect('Subcategory_controller/manage_subcategory');
	}
	public function trash_search_subcategory(){
		extract($_POST);
		if (isset($search)){
			$result = $this->Subcategories_model->trash_search($searchstr);
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("trash_manage_sub_category_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("trash_manage_sub_category_view",$cat_data);	
			}
		}
	}
	public function delete_subcategory(){
		$cid = $this->uri->segment(3);
		$res = $this->Subcategories_model->delete($cid);
		if($res)
			redirect('Subcategory_controller/trash_manage_subcategory');
		else
			echo "Somthing went wrong";
		
	}
	public function restore_subcategory(){
		$cid = $this->uri->segment(3);
		$res = $this->Subcategories_model->restore($cid);
		if($res)
			redirect('Subcategory_controller/trash_manage_subcategory');
		else
			echo "Somthing went wrong";
	}
}
 ?>