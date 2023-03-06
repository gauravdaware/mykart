<?php

class Products_controller extends CI_controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->model('Categories_model');
		$this->load->model('Products_model');
		 $this->load->helper('file');//for file upload validation
		 $this->load->library('pagination');
	}	
	public function products(){
		$result = $this->Categories_model->get_categories();
		$view_data['msg'] = "";
		$view_data['cat_result'] = $result;
		$this->load->view('add_product_view',$view_data);
	}
	public function get_ajax_subcategories(){
		$cid=$this->input->post('category_id');
		$output ='<option value="">--Select Subcategory--</option>';
		$res = $this->Products_model->ajax_subcat($cid);
		foreach($res->result() as $row){
			$output .= '<option value="'.$row->sub_category_id.'">'.$row->sub_category_name.'</option>'; 
    	}
		echo $output;
	}
	public function add_product(){
		if(!empty($this->session->userdata('admin_email'))){
			$this->form_validation->set_rules('category','category','required',array('required'=>'Please select category'));
			$this->form_validation->set_rules('scname','subcategory','required',array('required'=>'Please select subcategory'));
			$this->form_validation->set_rules('pcode','Product Code','required|trim',array('required'=>'Please enter product code'));
			$this->form_validation->set_rules('pname','Product Name','trim|required|alpha_numeric_spaces',array('required'=>'Please enter product name','alpha_numeric_spaces'=>'Enter valid product name'));
			$this->form_validation->set_rules('brand','Brand','required|trim|alpha_numeric_spaces',array('required'=>'Please enter product brand','alpha_numeric_spaces'=>'Enter valid brand name'));
			$this->form_validation->set_rules('mrp','MRP','required|trim|numeric',array('required'=>'Please enter product MRP','numeric'=>'Only number allowed'));
			$this->form_validation->set_rules('sp','Brand','required|trim|numeric',array('required'=>'Please enter product SP','numeric'=>'Only number allowed'));
			$this->form_validation->set_rules('shipping','Shipping Charge','required|trim|numeric',array('required'=>'Please enter product shipping charge','numeric'=>'Only number allowed'));
			$this->form_validation->set_rules('stock','Stock','required|trim|numeric',array('required'=>'Please enter product stock','numeric'=>'Only number allowed'));
			$this->form_validation->set_rules('features','features','required|trim',array('required'=>'Please enter product features'));
			$this->form_validation->set_rules('description','description','required|trim',array('required'=>'Please enter product description'));
			$this->form_validation->set_rules('pimage','Product Image','callback_file_check');//callback_file_check for file upload validation 
			if($this->form_validation->run()){
				extract($_POST);
				$config['upload_path'] ="uploads/";
				$config['allowed_types'] = "jpeg|jpg|png|gif";
				$config['file_name'] = rand(1000000,9999999);
				$this->upload->initialize($config);
				$response = $this->upload->do_upload('pimage');
				if($response){
					$product_data = array(
						'category_id'=>$category,
						'sub_category_id'=>$scname,
						'prod_code'=>strtoupper($pcode),
						'prod_name'=>ucwords($pname),
						'prod_brand'=>ucwords($brand),
						'prod_mrp'=>$mrp,
						'prod_sp'=>$sp,
						'prod_shipping_charge'=>$shipping,
						'prod_stock'=>$stock,
						'prod_features'=>ucwords($features),
						'prod_description'=>ucwords($description),
						'prod_image'=>$this->upload->data('file_name'),
						'prod_status'=>$pstatus,
						'added_on'=>date('Y-m-d'),
						'trash'=>0
					);
					$chk_res = $this->Products_model->chk_product($product_data['category_id'],$product_data['sub_category_id'],$product_data['prod_name']);
					$count = $chk_res->num_rows();
					if($count == 0){
						$insert_res = $this->Products_model->insert_product($product_data);	
						if($insert_res){
							$result = $this->Categories_model->get_categories();
							$view_data['msg'] = "Success";
							$view_data['msg_2'] = "Product added";
							$view_data['cat_result'] = $result;
							$this->load->view('add_product_view',$view_data);
						}
					}
					else{
						$result = $this->Categories_model->get_categories();
						$view_data['msg'] = "Failed";
						$view_data['msg_2'] = "Product not added";
						$view_data['cat_result'] = $result;
						$this->load->view('add_product_view',$view_data);
					}
				}
				else{
						$result = $this->Categories_model->get_categories();
						$view_data['msg'] = "Failed";
						$view_data['msg_2'] = "Please upload product image";
						$view_data['cat_result'] = $result;
						$this->load->view('add_product_view',$view_data);
				}
			}
			else{
				$this->form_validation->set_error_delimiters('<span style="color:red">','</span>');
				$result = $this->Categories_model->get_categories();
				$view_data['msg'] = "";
				$view_data['cat_result'] = $result;
				$this->load->view('add_product_view',$view_data);
			}
		}
		else{
			redirect('Admin_controller');
		}
	}
	/*
	 * File Upload Validation 
	 */
	public function file_check($str){
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['pimage']['name']);
        if(isset($_FILES['pimage']['name']) && $_FILES['pimage']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only jpeg/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
    /* End */
    public function manage_products(){
    	if(!empty($this->session->userdata('admin_email'))){
			$total_records = $this->Products_model->get_total_product_records();
			/*Pagination Code*/
			$config['base_url'] = base_url()."Products_controller/manage_products";
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
			$prod_data['page_links'] = $pages;
			$segment = $this->uri->segment(3);
			if(empty($segment))
				$starting_index = 0;
			else
				$starting_index = $segment;
			$result  = $this->Products_model->get_products($config['per_page'],$starting_index);
			$count = $result->num_rows();
			if($count>0){
				$prod_data['flag'] = 1;
				$prod_data['result_set'] = $result;
				$this->load->view ("manage_products_view",$prod_data);
			}
			else{
				$prod_data['flag'] = 0;
				$this->load->view ("manage_products_view",$prod_data);	
			}	
		}
		else{
			redirect('Admin_controller');
		}
	}
	public function search_product(){
		extract($_POST);
		if (isset($search)){
			$result = $this->Products_model->search($searchstr);
			$count = $result->num_rows();
			if($count>0){
				$prod_data['flag'] = 1;
				$prod_data['result_set'] = $result;
				$this->load->view ("manage_products_view",$prod_data);
			}
			else{
				$prod_data['flag'] = 0;
				$this->load->view ("manage_products_view",$prod_data);	
			}
		}
	}
	public function update_status(){
		$prod_id = $this->uri->segment(3);
		$res = $this->Products_model->get_prod_status($prod_id);
		$row = $res->row();
		if($row->prod_status == 1){
			$change_status = 0;
			$this->Products_model->update_prod_status($change_status,$prod_id);
			redirect('Products_controller/manage_products');
		}
		else{
			$change_status = 1;
			$this->Products_model->update_prod_status($change_status,$prod_id);
			redirect('Products_controller/manage_products');
		}
	}
	public function trash_product(){
		$prod_id = $this->uri->segment(3);
		$this->Products_model->trash($prod_id);
		redirect('Products_controller/manage_products');
	}

    public function trash_manage_products(){
    	$result = $this->Products_model->get_trash_products();
    	$count = $result->num_rows();
    	if($count>0){
    		$trash_data['flag'] = 1;
    		$trash_data['result_set'] = $result;
    		$this->load->view('trash_manage_products_view',$trash_data);	
    	}
    	else{
    		$trash_data['flag'] = 0;
    		$trash_data['result_set'] = $result;
    		$this->load->view('trash_manage_products_view',$trash_data);	
    	}
    	
	}
	public function delete_product(){
		$pid = $this->uri->segment(3);
		$res = $this->Products_model->delete($pid);
		redirect('Products_controller/trash_manage_products');
	}
	public function restore_product(){
		$pid = $this->uri->segment(3);
		$res = $this->Products_model->restore($pid);
		redirect('Products_controller/trash_manage_products');	
	}
	public function trash_search_products(){
		extract($_POST);
		if (isset($search)){
			$result = $this->Products_model->trash_search($searchstr);
			$count = $result->num_rows();
			if($count>0){
				$prod_data['flag'] = 1;
				$prod_data['result_set'] = $result;
				$this->load->view ("trash_manage_products_view",$prod_data);
			}
			else{
				$prod_data['flag'] = 0;
				$this->load->view ("trash_manage_products_view",$prod_data);	
			}
		}
	}
}

?>
