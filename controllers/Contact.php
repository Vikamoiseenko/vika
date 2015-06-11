<?php
//Contact.php controller
class Contact extends CI_Controller {

    public function __construct()
    {//everything here is global to all methods in the controller
         parent::__construct();
         $this->load->model('contact_model');
         $this->config->set_item('banner','Global Startup Banner');
         $this->config->set_item("banner-img", "img/Startup-logo.png");
    }#end constructor()

	public function index()
	{     $this->load->helper('form');
        $this->load->library('form_validation');

        $data['name'] = 'Create a new contact';
        $data['contact'] = $this->contact_model->get_emails();;

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() === FALSE)
        {//no data yet, show form!
            $this->load->view('contact/index', $data);

        }
        else
        {//process data, send email!
          //  $this->contact_model->send_email();
            //$this->load->view('contact/success');
        }
    }
    public function view($email = NULL)
    {
            $data['contact_item'] = $this->contact_model->get_emails($email);
            if (empty($data['contact_item']))
    {
            show_404();
    }

    $data['name'] = $data['contact_item']['name'];

    $this->load->view('templates/header', $data);
    $this->load->view('contact/view', $data);
    $this->load->view('templates/footer', $data);
}#end view();

    public function create()
    {
  $this->load->helper('form');
  $this->load->library('form_validation');

  $data['name'] = 'Create new email';

  $this->form_validation->set_rules('name', 'Name', 'required');
  $this->form_validation->set_rules('email', 'email', 'required');
  $this->form_validation->set_rules('message', 'message', 'required');

  if ($this->form_validation->run() === FALSE)
  {
      $this->load->view('templates/header', $data);
      $this->load->view('contact/create', $data);
      $this->load->view('templates/footer', $data);

  }
  else
  {
      $this->contact_model->set_email();
      $this->load->view('contact/success');
  }
}

  }
