<?php 
class Categories_controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library("form_validation");
		$this->load->model("Categories_model");
		$this->load->library("pagination");
	}
	public function add_category(){
		$cat_data['msg'] = "";
		$this->load->view("add_category_view",$cat_data);
	}
	public function add(){
		extract($_POST);
		$this->form_validation->set_rules('cname','Category Name','required|trim|alpha|min_length[3]',array('required'=>'Category name is required','alpha'=>'Enter Only Alphabets','min_length'=>'Minimum 3 charecters required'));
		$this->form_validation->set_rules('priority','Priority','required|trim|numeric',array('required'=>'Priority is required','numeric'=>'Enter Only Number'));
		if($this->form_validation->run()){
			if(isset($add)){
				$category_data = array(
					'category_name'=>ucfirst($cname),
					'category_priority'=>$priority,
					'created_on'=>date('Y-m-d'),
					'category_status'=>$cstatus,
					'trash'=>0
				);
				$response = $this->Categories_model->check_category($category_data['category_name']);
				$count = $response->num_rows();
				if($count == 0){
					$res = $this->Categories_model->insert_category($category_data);
					if ($res){
						$view_data ['msg'] = "Success";
						$view_data ['msg_2'] = "Category Added";
						$this->load->view('add_category_view',$view_data);
					}
				}
				else{
					$view_data ['msg'] = "Failed";
					$view_data ['msg_2'] = "Category Already Present";
					$this->load->view('add_category_view',$view_data);
				}
			}
		}
		else{
			$view_data['msg'] = "";
			$this->form_validation->set_error_delimiters('<span style="color:red">','</span>');
			$this->load->view('add_category_view',$view_data);
		}
	}
	public function manage_category(){
		if(!empty($this->session->userdata('admin_email'))){
			/*Pagination Code*/
			$total_records = $this->Categories_model->get_total_records();
			$config['base_url'] = base_url()."index.php/Categories_controller/manage_category";
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
			$result  = $this->Categories_model->get_limited_records($config['per_page'],$starting_index);
			/*End Pagination Code*/

			//$result  = $this->Categories_model->manage();
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("manage_category_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("manage_category_view",$cat_data);	
			}	
		}
		else{
			redirect("Admin_controller");
		}
	}
	public function search_category(){
		extract($_POST);
		if (isset($search)){
			$result = $this->Categories_model->search($searchstr);
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("manage_category_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("manage_category_view",$cat_data);	
			}
		}
	}
	public function update_status(){
		$cat_id = $this->uri->segment(3);
		$res = $this->Categories_model->get_cat_status($cat_id);
		$row = $res->row();
		if($row->category_status == 1){
			$change_status = 0;
			$this->Categories_model->update_cat_status($change_status,$cat_id);
			redirect('Categories_controller/manage_category');
		}
		else{
			$change_status = 1;
			$this->Categories_model->update_cat_status($change_status,$cat_id);
			redirect('Categories_controller/manage_category');
		}
	}
	public function trash_category(){
		$cat_id = $this->uri->segment(3);
		$this->Categories_model->trash($cat_id);
		redirect('Categories_controller/manage_category');
	}
	public function trash_manage_category(){
		if(!empty($this->session->userdata('admin_email'))){
			$result  = $this->Categories_model->manage_trash();
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("trash_manage_category_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("trash_manage_category_view",$cat_data);	
			}
		}
		else{
			redirect('Admin_controller');
		}
	}
	public function trash_search_category(){
		extract($_POST);
		if (isset($search)){
			$result = $this->Categories_model->trash_search($searchstr);
			$count = $result->num_rows();
			if($count>0){
				$cat_data['flag'] = 1;
				$cat_data['result_set'] = $result;
				$this->load->view ("trash_manage_category_view",$cat_data);
			}
			else{
				$cat_data['flag'] = 0;
				$this->load->view ("trash_manage_category_view",$cat_data);	
			}
		}
	}
	public function delete_category(){
		$cid = $this->uri->segment(3);
		$res = $this->Categories_model->delete($cid);
		if($res)
			redirect('Categories_controller/trash_manage_category');
		else
			echo "Somthing went wrong";
		
	}
	public function restore_category(){
		$cid = $this->uri->segment(3);
		$res = $this->Categories_model->restore($cid);
		if($res)
			redirect('Categories_controller/trash_manage_category');
		else
			echo "Somthing went wrong";
	}
}
?>