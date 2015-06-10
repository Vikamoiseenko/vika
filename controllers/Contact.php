<?php
//Contact.php controller
class Contact extends CI_Controller {

    public function __construct()
    {//everything here is global to all methods in the controller
         parent::__construct();
         $this->config->set_item('banner','Global Startup Banner');
         $this->config->set_item("banner-img", "img/Startup-logo.png");
    }#end constructor()

	public function index()
	{$this->load->helper('form');
        $this->load->library('form_validation');

        //$data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() === FALSE)
        {//no data yet, show form!
            $this->load->view('contact/index');

        }
        else
        {//process data, send email!
            $this->contact_model->send_email();
            $this->load->view('contact/success');
        }
    }
    public function view($slug = NULL)
    {
            $data['name'] = $this->news_model->get_emails($slug);
            if (empty($data['name']))
    {
            show_404();
    }

    $data['name'] = $data['name']['name'];

//    $this->load->view('templates/header', $data);
    $this->load->view('contact/view', $data);
  //  $this->load->view('templates/footer');
}#end view();

    public function create()
    {
  $this->load->helper('form');
  $this->load->library('form_validation');

  $data['title'] = 'Send an email';

  $this->form_validation->set_rules('title', 'Title', 'required');
  $this->form_validation->set_rules('text', 'text', 'required');

  if ($this->form_validation->run() === FALSE)
  {
      $this->load->view('templates/header', $data);
      $this->load->view('contact/create');
      $this->load->view('templates/footer');

  }
  else
  {
      $this->contact_model->set_email();
      $this->load->view('contact/success');
  }
}

  }
