<body>
	<div class="container-fluid">
    <h1 class="moduleHead">Create Your Password</h1><br>
    <h2 class="moduleSubHead">Almost there <span><?php echo $firstName; ?></span>! Your username is <span><?php echo $userName;?>.</span></h2>
      <div class="row">
        <div class="col-md-3 col-sm-3 col-3"></div>
        <div class="col-md-6 col-sm-6 col-6">
            <br>
            <center><p>Please enter a password to begin using the site.</p></center>
<!--START ------------------------------ Backup Error --------------------------------------------------------- -->
<?php
    if ($this->session->flashdata('msg')){ //change!
        echo '<div class="backupErrorMsg">';
        echo $this->session->flashdata('msg');
        echo "</div>";
    }
?>
<!--END -------------------------------- Backup Error ----------------------------------------------------------- -->
            <div class="form-complete">
              <?php 
                $fattr = array('class' => 'form-signin');
                echo form_open(site_url().'Main/complete/token/'.$token, $fattr); ?>

                <div class="form-group">
                  <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
                  <!-- error msg -->
                  <?php echo "<div class='message' style= 'color:red; font-size:0.8rem; font-family: Arial, Helvetica, sans-serif; text-align:center; margin-top:0.5rem;'>"; ?>
                  <?php echo form_error('password') ?>
                  <?php echo "</div>"; ?>
                </div><br>

                <div class="form-group">
                  <?php echo form_password(array('name'=>'passwordConfirmation', 'id'=> 'passwordConfirmation', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passwordConfirmation'))); ?>
                  <!-- error msg -->
                  <?php echo "<div class='message' style='color:red; font-size:0.8rem; font-family: Arial, Helvetica, sans-serif; text-align:center; margin-top:0.5rem;'>"; ?>
                  <?php echo form_error('passwordConfirmation'); ?>
                  <?php echo "</div>"; ?>
                </div> <br><br>

                  <?php echo form_submit(array('value'=>'Complete', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
                  <?php echo form_close(); ?>
                  <br>
            </div>
        </div>
</div>
