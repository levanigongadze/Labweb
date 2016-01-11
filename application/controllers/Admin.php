<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('Model');
		$this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="errors">', '</div>');
		$this->load->view('admin/theme/header');
    }
	
	public function index()
	{

		$this->load->view('admin/main');
		$this->load->view('admin/theme/footer');
	}
	
	public function add_event()
	{

		$this->load->view('admin/views/add_event');
		$this->load->view('admin/theme/footer');
	}

	public function check_event()
	{
        $this->form_validation->set_rules('event_name', 'ივენთის სახელის', 'required');
        $this->form_validation->set_rules('event_start_date', 'დაწყების თარიღის', 'required');
        $this->form_validation->set_rules('event_end_date', 'დასრულების თარიღის', 'required');
        $this->form_validation->set_rules('event_location', 'ლოკაციის', 'required');
        $this->form_validation->set_rules('event_overview', 'ივენთის შესახებ', 'required');

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' && !empty($_POST) ){
			redirect('/main/index');
		}
			$config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 2000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;
			$this->load->library('upload', $config);
			$image = '';

			 if ( ! $this->upload->do_upload('photo'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $image = $data['upload_data']['file_name'];
                }
		
		$this->load->model('model');
		$this->model->check_event($image);

	}
	
	public function events()
	{
		$this->load->model('model');
		$data['events'] = $this->model->select_events();

		$this->load->view('admin/events', $data);
		$this->load->view('admin/theme/footer');
	}
	
	public function add_blog()
	{
		$this->load->view('admin/views/add_blog');
		$this->load->view('admin/theme/footer');
	}

	public function login()
	{
        $this->form_validation->set_rules('username', 'ელ-ფოსტის', 'required');
        $this->form_validation->set_rules('password', 'პაროლის', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('');
		}else{
		    $result=$this->Model->login();    
		    if($result){
		    redirect('/admin/add_event');
		    }else{
		    redirect(base_url('/error'));
	    	}
		}
    }
	
	public function add_forms()
	{

		$this->load->view('admin/views/add_forms');
		$this->load->view('admin/theme/footer');
	}
	
	public function forms()
	{

		$this->load->view('admin/forms');
		$this->load->view('admin/theme/footer');
	}
	
	public function mentors()
	{
		$this->load->model('model');
		$data['mentors'] = $this->model->select_mentors();

		$this->load->view('admin/mentors', $data);
		$this->load->view('admin/theme/footer');
	}
	
	public function add_mentors()
	{

		$this->load->view('admin/views/add_mentors');
		$this->load->view('admin/theme/footer');
	}
	
	public function remove_mentors($id)
	{
		$this->load->model('model');
		$this->model->remove($id);

		echo 'mentor removed';
	}
	
	public function edit_mentors($id)
	{
		$this->load->model('model');
		$this->model->edit($id);
        $mentor = $this->db->get()->row_array();
        $data['mentors'] = $mentor;

		$this->load->view('admin/views/edit_mentors', $data);
		$this->load->view('admin/theme/footer');
	}

	public function check_mentors()
	{
        $this->form_validation->set_rules('mentor_name', 'მენტორის სახელის', 'required');
        $this->form_validation->set_rules('mentor_info', 'მენტორის ინფორმაციის', 'required');

		if ( $_SERVER['REQUEST_METHOD'] != 'POST' && !empty($_POST) ){
			redirect('/main/index');
		}
			$config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 2000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;
			$this->load->library('upload', $config);
			$image = '';

			 if ( ! $this->upload->do_upload('photo'))
                {
                        $error = array('error' => $this->upload->display_errors());
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $image = $data['upload_data']['file_name'];
                }
		
		$this->load->model('model');
		$this->model->check_mentor($image);
	}

	public function update_mentors($id)
	{
        $this->form_validation->set_rules('mentor_name', 'მენტორის სახელის', 'required');
        $this->form_validation->set_rules('mentor_info', 'მენტორის ინფორმაციის', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('admin/views/add_mentors');
		}else{

	    	$mentor_name = $this->input->POST('mentor_name');
	    	$mentor_info = $this->input->POST('mentor_info');

			$this->db->set('name', $mentor_name);
			$this->db->set('info', $mentor_info);
			$this->db->where('id', $id);
			$this->db->update('mentors');

			echo 'mentor updated';

		}
	}
	
}
 