<?php
class Contacts_model extends CI_model{

	public function __construct()
	{
		$this->load->database();
	}


	public function get_contacts($slug = FALSE)
	{
		if( $slug === FALSE)//retreiving all contacts
		{
			$query = $this->db->get('contacts');
			return $query->result_array();
		}

		$query = $this->db->get_where('contacts', array('id' => $slug));
		return $query->row_array();

	}

	public function set_contact()
	{
		$this->load->helper('url');

		$slug = url_title($this->input->post('name'), 'dash', TRUE);

		$dob = $this->input->post('dob');
		$dob = str_replace('/', '-', $dob);
		list($month, $day, $year) = explode('-', $dob);
		$dob = $year.'-'.$month.'-'.$day;

		$data = array(
			'name' => $this->input->post('name'),
			'dob' => $dob,
			'email' => $this->input->post('email'),
			'favcolor' => $this->input->post('favcolor'),
			'slug' => $slug
		);

		$result = $this->db->insert('contacts', $data);
		if( !$result)
		{
			echo "The contact was not created.";
		}
		return $result;
	}

	public function get_contact($slug = FALSE)
	{
		if($slug === FALSE)
		{
			$query = $this->db->get('contacts');
			return $query->result_array();
		}

		$query = $this->db->get_where('contacts', array('slug' => $slug));
		return $query->row_array();
	}

	public function del_contact($where)
	{
		//die(var_dump($where));
		if( isset($where))
		{
			$this->db->where($where);
			$response = $this->db->delete('contacts');
			if($response === TRUE)
			{
				return TRUE;
			}else
			{
				return FALSE;
			}
		}
	}
}