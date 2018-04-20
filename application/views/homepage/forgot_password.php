<body>
	<div class="container-fluid">
    <h1 class="moduleHead">Forgot Password</h1><br>
    <p class="title-detail">Please enter your email address and we'll send you instructions on how to reset your password.</p>
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

            <?php $fattr = array('class' => 'form-signin'); echo form_open(site_url().'main/forgotPassword/', $fattr); ?>
                <div class="form-group">
                    <div class="input-group">
                        <input name="emailAddress" value="" data-validation="email" id="emailAddress" placeholder='Email Address' class='form-control'  data-validation-error-msg="Please enter a valid Email Address." data-validation-error-msg-container="#messageValidationLocationEmail" onBlur="" onFocus="" >
                    </div>
                    <span>
                    <div class="jQueryFormValidationMessage" id="messageValidationLocationEmail" align="center"></div>
                    </span>
                </div>
                <?php echo form_submit(array('value'=>'Submit', 'class'=>'btn btn-primary btn-block')); ?>
                <?php echo form_close(); ?>  
        </div>
      </div>
    </div>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery.form-validator.min.js""></script>
<script> $.validate({ language : 'es' }); </script>