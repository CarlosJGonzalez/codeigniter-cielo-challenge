<?php
class Contacts extends CI_Controller
{
	public function __construct()
	{
			parent::__construct();
			$this->load->model('contacts_model');
			$this->load->helper('url_helper');
	}

	public function index()
	{
			$data['contacts'] = $this->contacts_model->get_contacts();
			$data['title'] = 'Contacts List';

			$this->load->view('templates/header', $data);
			$this->load->view('contacts/index', $data);
			$this->load->view('templates/footer');
	}


	public function view($slug = NULL)
	{
			$data['contact'] = $this->contacts_model->get_contacts($slug);

			if (empty($data['contact']))
			{
				show_404();
			}

			$data['title'] = $data['contact']['name'];

			$this->load->view('templates/header', $data);
			$this->load->view('contacts/view', $data);
			$this->load->view('templates/footer');
	}




	public function create()
	{
			$this->load->helper('form');
			$this->load->library('form_validation');

			$data['title'] = 'Create a contact';
			
			$this->load->view('templates/header', $data);
			$this->load->view('contacts/create');
			$this->load->view('templates/footer');
	}

	public function inserting()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Inserting a contact';

		$this->form_validation->set_rules('name', 'Contact Name', 'required');
		$this->form_validation->set_rules('dob', 'D.O.B.', 'required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|is_unique[contacts.email]');	
		
		$response = array('response'=>'false');	

		if($this->form_validation->run() === TRUE)
		{
			$res = $this->contacts_model->set_contact();	
			if($res === TRUE){
				$response = array('response'=>'true');
			}			
		}
		echo json_encode($response);
	}

	public function delete( $id = '')
	{
			$data['title'] = "contact deleted";
			$where = array('id' => $id);
			$res = $this->contacts_model->del_contact($where);	
			
			$this->load->view('templates/header', $data);
			
			if($res === TRUE)
			{
				$data['contacts'] = $this->contacts_model->get_contacts();				
				$this->load->view('contacts/index', $data);
			}else{
				$this->load->view('home');
			}
			$this->load->view('templates/footer');			
	}
}