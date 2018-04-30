<div class="container-fluid">
    <h1 class="moduleHead">Reset Your Password</h2>
    <h1 class="moduleSubHead">Hello <span><?php echo $firstName; ?></span>! Please enter your password 2x below to reset.</h2> 
    <div class="row">
        <div class="col-md-3 col-sm-3 col-3"></div>
        <div class="col-md-6 col-sm-6 col-6">
            <br>
<!--START ------------------------------ Backup Error --------------------------------------------------------- -->
<?php
    if ($this->session->flashdata('msg')){ //change!
        echo '<div class="backupErrorMsg">';
        echo $this->session->flashdata('msg');
        echo "</div>";
    }
?>
<!--END -------------------------------- Backup Error ----------------------------------------------------------- -->
            <?php 
            $fattr = array('class' => 'form-signin');
            echo form_open(site_url().'Main/resetPassword/token/'.$token, $fattr); ?>
            
            <div class="form-group">
                <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
                <!-- error msg -->
                <?php echo "<div class='message' style= 'color:red; font-size:0.8rem; font-family: Arial, Helvetica, sans-serif; text-align:center; margin-top:0.5rem;'>"; ?>
                <?php echo form_error('password') ?>
                <?php echo "</div>";?>
            </div>
            <br>
            
            <div class="form-group">
                <?php echo form_password(array('name'=>'passwordConfirmation', 'id'=> 'passwordConfirmation', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passwordConfirmation'))); ?>
                <!-- error msg -->
                <?php echo "<div class='message' style= 'color:red; font-size:0.8rem; font-family: Arial, Helvetica, sans-serif; text-align:center; margin-top:0.5rem;'>"; ?>
                <?php echo form_error('passwordConfirmation') ?>
                <?php echo "</div>";?>
            </div>
            <br>
            
            <?php echo form_hidden('ID', $ID);?>
            <?php echo form_submit(array('value'=>'Reset Password', 'class'=>'btn btn-primary btn-block')); ?>
            <?php echo form_close(); ?>
    

    <!-- PAGE CONTENT ENDS -->
        </div>
    </div>