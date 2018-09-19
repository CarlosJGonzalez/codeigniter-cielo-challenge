<?php 
Class Pages extends CI_Controller{
	public function view($page = 'home')
	{
		if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php'))
		{
			//this page don't exist
			show_404();
		}

		$data['title'] = ucfirst($page);//capitalize the first letter

		$this->load->view('templates/header', $data);
		$this->load->view('pages/'.$page, $data);
		$this->load->view('templates/footer', $data);
	}
}
?>