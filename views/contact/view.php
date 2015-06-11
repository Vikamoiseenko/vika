<?php
//views/startups/view.php
$this->load->view($this->config->item('theme') . 'header');

echo '<h2>'.$contact_item['name'].'</h2>';
echo '<h2>'.$contact_item['message'].'</h2>';
?>
<p><a href="http://mykhabarovsk.com/repo/contact/create"</a>Send new email</p>
<p><a href="http://mykhabarovsk.com/repo/contact"</a>Go back to Contact </p>
<?php
$this->load->view($this->config->item('theme') . 'footer');
?>
