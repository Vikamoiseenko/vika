<?php
//views/contact/index.php
$this->load->view($this->config->item('theme') . 'header');
?>
<?php foreach ($contacts as $contact_item): ?>

        <h3><?php echo $contact_item['name'] ?></h3>
        <div class="main">
                <?php echo $contact_item['message'] ?>
        </div>
        <p><a href="<?php echo $contact_item['email'] ?>">View email</a></p>

<?php endforeach ?>

<?php
$this->load->view($this->config->item('theme') . 'footer');
?>
