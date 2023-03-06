<?php 
class Admin_controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library('form_validation');
		$this->load->helper('cookie');
	}
	public function index(){
		if(!empty($this->session->userdata('admin_email'))){
			redirect('Admin_controller/home');
		}
		else{
			$view_data['msg'] = "";
			$this->load->view("login_view",$view_data);
		}
	}
	public function page_not_found(){
		$this->load->view("404_view");
	}
	public function home(){
		if(!empty($this->session->userdata('admin_email'))){
			$this->load->view("home_view");
		}
		else{
			redirect("Admin_controller");
		}
	}
	public function logout(){
		$this->session->unset_userdata('admin_email');
		redirect('Admin_controller/index');
	}
	public function login(){
		extract($_POST);
		if (isset($login)){
			$this->form_validation->set_rules('email','Email','required|trim|valid_email',array('required'=>'Email is required','valid_email'=>'Enter Valid Email'));
			$this->form_validation->set_rules('password','Password','required|trim',array('required'=>'Password is required'));
			if($this->form_validation->run()){
				$login_info = array(
					'admin_last_login_date' => date('Y-m-d H:i:s'),
					'admin_last_login_ip' => $_SERVER['REMOTE_ADDR']
				);
				$login_data = array(
					'admin_email' => $email,
					'admin_password'=>md5($password)
				);

				$result = $this->Login_model->chk_login($login_data);
				$count = $result->num_rows();
				if($count == 1){
					$this->session->set_userdata('admin_email',$email);
					if(isset($remember)){
						set_cookie('admin_email',$email,3600);
						set_cookie('admin_password',$password,3600);
					}
					$res = $this->Login_model->update_login_data($login_info,$login_data);
					if($res){
						//redirect('Admin_controller/home');
						$this->load->view("home_view");
					}
				}
				else{
					$view_data['msg'] = "Email or Password is incorrect";
					$this->load->view('login_view',$view_data);	
				}
			}
			else{
				$view_data['msg'] = "";
				$this->form_validation->set_error_delimiters('<span style="color:red">','</span>');
				$this->load->view('login_view',$view_data);
			}
		}
	}
}
?>
