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
	{
			$data['title'] = 'Contact';
			$this->load->view('forms/contact', $data);
	}#end index()
  public function view($slug = NULL)
  {
      $data['contact'] = $this->contact_model->get_emails($slug);

      if (empty($data['contact']))
      {
          show_404();
      }

      $data['title'] = $data['contact']['title'];
      $this->load->view('forms/contact', $data);
  }#end view()


    public function create()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Sent Email';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'text', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('templates/header', $data);
            //validation fails
            $this->load->view('forms/contact');
            $this->load->view('templates/footer', $data);

        }
        else
        {
          //get the form data
          $name = $this->input->post('name');
          $from_email = $this->input->post('email');
          $subject = $this->input->post('subject');
          $message = $this->input->post('message');

          //set to_email id to which you want to receive mails
          $to_email = 'user@gmail.com';

          //configure email settings
          $config['protocol'] = 'smtp';
          $config['smtp_host'] = 'ssl://smtp.gmail.com';
          $config['smtp_port'] = '465';
          $config['smtp_user'] = 'moiseenkovika@gmail.com';
          $config['smtp_pass'] = 'password';
          $config['mailtype'] = 'html';
          $config['charset'] = 'iso-8859-1';
          $config['wordwrap'] = TRUE;
          $config['newline'] = "\r\n"; //use double quotes
          //$this->load->library('email', $config);
          $this->email->initialize($config);

          //send mail
          $this->email->from($from_email, $name);
          $this->email->to($to_email);
          $this->email->subject($subject);
          $this->email->message($message);
          if ($this->email->send())
          {
              // mail sent
              $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Your mail has been sent successfully!</div>');
              redirect('forms/success');
          }
          else
          {
              //error
              $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">There is error in sending mail! Please try again later</div>');
              redirect('forms/contact');
          }
      }
  }


          //  $this->contact_model->set_contacts();
            //$this->load->view('forms/success');
        }
