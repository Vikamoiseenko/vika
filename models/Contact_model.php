<?php
class Contact_model extends CI_Model {
        public function __construct()
        {
                $this->load->database();
        }

		public function get_emails($slug = FALSE)
		{
			if ($slug === FALSE)
			{
					$query = $this->db->get('name');
					return $query->result_array();
			}
			$query = $this->db->get_where('name', array('slug' => $slug));
			return $query->row_array();
		}

    public function set_email()
    {
    $this->load->helper('url');

    $slug = url_title($this->input->post('title'), 'dash', TRUE);

    $data = array(
        'title' => $this->input->post('title'),
        'slug' => $slug,
        'text' => $this->input->post('email')
    );

    return $this->db->insert('contact', $data);
  }


}
