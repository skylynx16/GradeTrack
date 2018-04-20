<body class="profReg-bg">
	<div class="container-fluid">
    <h1 class="animated bounceIn moduleHead">Professor Registration</h1>
	<div class="row">
		<div class="col-md-2 col-sm-2 col-2"></div>
		<div class="col-md-8 col-sm-8 col-8">

<!--START ------------------------------ Backup Error --------------------------------------------------------- -->
<?php
    if ($this->session->flashdata('msg')){ //change!
        echo '<div class="backupErrorMsg">';
        echo $this->session->flashdata('msg');
        echo "</div>";
    }
?>
<!--END -------------------------------- Backup Error ----------------------------------------------------------- -->

<!--START ------------------------------ registration FORM  -------------------------------------------START -->
<div class="animated fadeIn">
<?php 
   $attributes = array('method' => 'POST', 'role' => 'form', 'id' => 'addstudent' );
   echo form_open_multipart('/main/addprofessor', $attributes);

?>

<!--START-------------------------------------- Username and Email ------------------------------------------>
			<center>
				<div class="form-group firstgrp">
						<div class="input-group">
							<div class="input-group-prepend">
									<div class="input-group-text bg-transparent">
									<i class="fa fa-user" style="color: green"></i>
									</div>
							</div>
							<input name="ProfUsername" value="<?php echo $this->session->flashdata('ProfUsername'); ?>" data-validation="custom length" data-validation-regexp="^[a-zA-Z0-9_]+$"  data-validation-length="6-30" id="ProfUsername" placeholder='Username' class='form-control' data-validation-error-msg="Please enter a valid Username." data-validation-error-msg-container="#messageValidationLocationProfUsername" onBlur="checkUserAvailability()" onFocus="clearValidationMessages()">
							<span class="input-group-append">
								<i class="textBoxMessageAvailableMd" id='messageAvailable' > Username <br> Available.</i>
								<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable' > Username <br> Not Available.</i>
							</span>
						</div>
		
					<span>
					<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader"  /></i>
					<div class="jQueryFormValidationMessage" id="messageValidationLocationProfUsername"></div>
					</span>

						<div class="input-group">
							<div class="input-group-prepend">
									<div class="input-group-text bg-transparent">
									<i class="fa fa-envelope" style="color: green"></i>
									</div>
							</div>
							<input name="ProfEmail" value="<?php echo $this->session->flashdata('ProfEmail'); ?>" data-validation="email" id="ProfEmail" placeholder='Email Address' class='form-control'  data-validation-error-msg="Please enter a valid Email Address." data-validation-error-msg-container="#messageValidationLocationProfEmail" onBlur="checkEmailAvailability()" onFocus="clearValidationMessages1()" >
							<span class="input-group-append">
								<i class="textBoxMessageAvailableMd" id='messageAvailable1' > Email <br> Available.</i>
								<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable1' > Email <br> Already Used.</i>
							</span>
						</div>
					<span>
					<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader1"  /></i>
					<div class="jQueryFormValidationMessage" id="messageValidationLocationProfEmail"></div>
					</span>
			
				</div>
			
<!--END ---------------------------------- Username and Email ------------------------------------------ -->

<!--START ---------------------------------- Faculty Code ----------------------------------------------------- -->
		
		<hr width="100%">
			<div class="label-verify">
				<b>This part is for verification. Please input the information used in the records of the HR.</b>
			</div>

			<div class="input-group">
				<input name="FCode" value="<?php echo $this->session->flashdata('FCode'); ?>" data-validation="custom" data-validation-regexp="^[-0-9]+$" id="FCode" placeholder='Faculty Code' class='form-control'  data-validation-error-msg="Please enter a valid Faculty Code." data-validation-error-msg-container="#messageValidationLocationFCode" onBlur="checkFCodeValidity()" onFocus="clearValidationMessages2()" >
				<span class="input-group-append">
					<i class="textBoxMessageAvailableMd" id='messageAvailable2' > Faculty Code <br> Match.</i>
					<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable2' > Faculty Code <br> Did Not Match.</i>
				</span>
			</div>
			<span>
			<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader2"  /></i>
			<div class="jQueryFormValidationMessage" id="messageValidationLocationFCode"></div>
			</span>

<!--END ---------------------------------- Faculty Code ----------------------------------------------- -->

<!--START ---------------------------------- FULL NAME ------------------------------------------------------ -->
	<div class="form-group row">
			<div  class="col-md-4">
				<div class="input-group">
					<input name="ProfFName" value="<?php echo $this->session->flashdata('ProfFName'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z-\s]+$" id="ProfFName" placeholder='First Name' class='form-control'  data-validation-error-msg="Please enter a valid First Name." data-validation-error-msg-container="#messageValidationLocationProfFName" onBlur="checkFNameValidity()" onFocus="clearValidationMessages3()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable3' > First Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable3' > First Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader3"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationProfFName"></div>
				</span>
			</div>

			<div  class="col-md-4">
				<div class="input-group">
					<input name="ProfMName" value="<?php echo $this->session->flashdata('ProfMName'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z-\s]+$" id="ProfMName" placeholder='Middle Name' class='form-control'  data-validation-error-msg="Please enter a valid Middle Name." data-validation-error-msg-container="#messageValidationLocationProfMName" onBlur="checkMNameValidity()" onFocus="clearValidationMessages4()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable4' > Middle Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable4' > Middle Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader4"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationProfMName"></div>
				</span>
			</div>

			<div  class="col-md-4">
				<div class="input-group">
					<input name="ProfLName" value="<?php echo $this->session->flashdata('ProfLName'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z-\s]+$" id="ProfLName" placeholder='Last Name' class='form-control'  data-validation-error-msg="Please enter a valid Last Name." data-validation-error-msg-container="#messageValidationLocationProfLName" onBlur="checkLNameValidity()" onFocus="clearValidationMessages5()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable5' > Last Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable5' > Last Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader5"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationProfLName"></div>
				</span>
			</div>

	</div><!--form-group-->
<!--END---------------------------------- Full Name ------------------------------------------------------ -->

<!--START ---------------------------------- BDATE and CITY------------------------------------------------------ -->
	<div class="form-group row">
		<div  class="col-md-6">
			<div class="input-group">
				<input name="ProfBDate" type="text" value="<?php echo $this->session->flashdata('ProfBDate'); ?>" data-validation="custom length" data-validation-regexp="^[0-9-]+$" data-validation-length="10-10" id="ProfBDate" placeholder='Birth Date (yyyy-mm-dd)' class='form-control'  data-validation-error-msg="Please enter a valid Birth Date." data-validation-error-msg-container="#messageValidationLocationProfBDate" onBlur="checkBDateValidity()" onFocus="clearValidationMessages6()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable6' > Birth Date <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable6' > Birth Date <br> Did Not Match.</i>
					</span>
			</div>
			<span>
			<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader6"  /></i>
			<div class="jQueryFormValidationMessage" id="messageValidationLocationProfBDate"></div>
			</span>
		</div>

		<div  class="col-md-6">
			<div class="input-group">
				<input name="ProfCityAddr" value="<?php echo $this->session->flashdata('ProfCityAddr'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z0-9\s,.-]+$" id="ProfCityAddr" placeholder='City Address' class='form-control'  data-validation-error-msg="Please enter a valid City Address." data-validation-error-msg-container="#messageValidationLocationProfCityAddr" onBlur="checkCityAddrValidity()" onFocus="clearValidationMessages7()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable7' > City Address <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable7' > City Address <br> Did Not Match.</i>
					</span>
			</div>
			<span>
			<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader7"  /></i>
			<div class="jQueryFormValidationMessage" id="messageValidationLocationProfCityAddr"></div>
			</span>
		</div>
	</div><!--form group-->

	<div class="form-group">
		<div class="form-check">
			<label class="form-check-label" for="invalidCheck">
			<input class="form-check-input" type="checkbox" name="TermsOfUse" id="invalidCheck" required>
			I agree to the <a href="<?php echo base_url(); ?>main/termsandconditions.html" target="_blank">terms and conditions</a> of this website.
			</label>
		</div>
	</div>
	</center>
<!--END --------------------------------- Bdate and City ------------------------------------------------------ -->

<!--START ------------------------------ signUp Button  --------------------------------------------------------- -->
	<center>
		<div class="form-group col-md-12 submitBtn">
			<input type="submit" value='Sign Up'  id="formButton" class='btn btn-md btn-primary btn-block' >
		</div>
	</center>
<!--END -------------------------------- signUp Button  ----------------------------------------------------------- -->


<!-- ------------------------------------------------------------------------------------------------------------- -->
	</div><!--col-md-6-->
</div><!--row-->
  <?php echo form_close(); ?>
  </div>
<!--END ------------------------------ registration FORM  ------------------------------------------------------END -->


<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery.form-validator.min.js""></script>

<script>
  $.validate({
    language : 'es',
  });

  var error = 0; var error1 = 0; var error2 = 0; var error3 = 0;
  var error4 = 0; var error5 = 0; var error6 = 0; var error7 = 0;

  function checkUserAvailability() {
    $("#iconLoader").show();

    jQuery.ajax({
      url: "../main/checkProfUserName",
      data:'ProfUsername='+$("#ProfUsername").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable").hide();
        $("#messageAvailable").show();
        $("#iconLoader").hide();
        enabledisableSubmitBtn(error = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable").hide();
        $("#messageNotAvailable").hide();
        $("#iconLoader").hide();
	  }
	  else {
        $("#messageAvailable").hide();
        $("#messageNotAvailable").show();
        $("#iconLoader").hide();
        enabledisableSubmitBtn(error = 1);
      }
    },
        error:function (){}
    });
  }

  function checkEmailAvailability() {
    $("#iconLoader1").show();

    jQuery.ajax({
      url: "../main/checkProfEmail",
      data: 'ProfEmail='+$("#ProfEmail").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable1").hide();
        $("#messageAvailable1").show();
        $("#iconLoader1").hide();
        enabledisableSubmitBtn(error1 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable1").hide();
        $("#messageNotAvailable1").hide();
        $("#iconLoader1").hide();
	  }
	  else {
        $("#messageAvailable1").hide();
        $("#messageNotAvailable1").show();
        $("#iconLoader1").hide();
        enabledisableSubmitBtn(error1 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkFCodeValidity() {
    $("#iconLoader2").show();

    jQuery.ajax({
      url: "../main/checkFCode",
      data: 'FCode='+$("#FCode").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable2").hide();
        $("#messageAvailable2").show();
        $("#iconLoader2").hide();
        enabledisableSubmitBtn(error2 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable2").hide();
        $("#messageNotAvailable2").hide();
        $("#iconLoader2").hide();
	  }
	  else {
        $("#messageAvailable2").hide();
        $("#messageNotAvailable2").show();
        $("#iconLoader2").hide();
        enabledisableSubmitBtn(error2 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkFNameValidity() {
    $("#iconLoader3").show();

    jQuery.ajax({
      url: "../main/checkProfFName",
      data: 'FCode='+$("#FCode").val()+'&ProfFName='+$("#ProfFName").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable3").hide();
        $("#messageAvailable3").show();
        $("#iconLoader3").hide();
        enabledisableSubmitBtn(error3 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable3").hide();
        $("#messageNotAvailable3").hide();
        $("#iconLoader3").hide();
	  }
	  else {
        $("#messageAvailable3").hide();
        $("#messageNotAvailable3").show();
        $("#iconLoader3").hide();
        enabledisableSubmitBtn(error3 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkMNameValidity() {
    $("#iconLoader4").show();

    jQuery.ajax({
      url: "../main/checkProfMName",
      data: 'FCode='+$("#FCode").val()+'&ProfMName='+$("#ProfMName").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable4").hide();
        $("#messageAvailable4").show();
        $("#iconLoader4").hide();
        enabledisableSubmitBtn(error4 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable4").hide();
        $("#messageNotAvailable4").hide();
        $("#iconLoader4").hide();
	  }
	  else {
        $("#messageAvailable4").hide();
        $("#messageNotAvailable4").show();
        $("#iconLoader4").hide();
        enabledisableSubmitBtn(error4 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkLNameValidity() {
    $("#iconLoader5").show();

    jQuery.ajax({
      url: "../main/checkProfLName",
      data: 'FCode='+$("#FCode").val()+'&ProfLName='+$("#ProfLName").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable5").hide();
        $("#messageAvailable5").show();
        $("#iconLoader5").hide();
        enabledisableSubmitBtn(error5 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable5").hide();
        $("#messageNotAvailable5").hide();
        $("#iconLoader5").hide();
	  }
	  else {
        $("#messageAvailable5").hide();
        $("#messageNotAvailable5").show();
        $("#iconLoader5").hide();
        enabledisableSubmitBtn(error5 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkBDateValidity() {
    $("#iconLoader6").show();

    jQuery.ajax({
      url: "../main/checkProfBDate",
      data: 'FCode='+$("#FCode").val()+'&ProfBDate='+$("#ProfBDate").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable6").hide();
        $("#messageAvailable6").show();
        $("#iconLoader6").hide();
        enabledisableSubmitBtn(error6 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable6").hide();
        $("#messageNotAvailable6").hide();
        $("#iconLoader6").hide();
	  }
	  else {
        $("#messageAvailable6").hide();
        $("#messageNotAvailable6").show();
        $("#iconLoader6").hide();
        enabledisableSubmitBtn(error6 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkCityAddrValidity() {
    $("#iconLoader7").show();

    jQuery.ajax({
      url: "../main/checkProfCityAddr",
      data: 'FCode='+$("#FCode").val()+'&ProfCityAddr='+$("#ProfCityAddr").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable7").hide();
        $("#messageAvailable7").show();
        $("#iconLoader7").hide();
        enabledisableSubmitBtn(error7 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable7").hide();
        $("#messageNotAvailable7").hide();
        $("#iconLoader7").hide();
	  }
	  else {
        $("#messageAvailable7").hide();
        $("#messageNotAvailable7").show();
        $("#iconLoader7").hide();
        enabledisableSubmitBtn(error7 = 1);
      }
    },
        error:function (){}
    });
  }

//-------------------------------------------------------------------------------------------------------------
  function enabledisableSubmitBtn(error) {
  	if(error == 0 && error1 == 0 && error2 == 0 && error3 == 0 && error4 == 0 && error5 == 0 && error6 == 0 && error7 == 0) 	{
  		$("#formButton").removeAttr('disabled');
  	}
  	else {
  		$("#formButton").attr('disabled', 'disabled');
  	}
  }
//-------------------------------------------------------------------------------------------------------------
  function clearValidationMessages() {
    $("#messageNotAvailable").hide();
    $("#messageAvailable").hide();
  }

  function clearValidationMessages1() {
    $("#messageNotAvailable1").hide();
    $("#messageAvailable1").hide();
  }

  function clearValidationMessages2() {
    $("#messageNotAvailable2").hide();
    $("#messageAvailable2").hide();
  }

  function clearValidationMessages3() {
    $("#messageNotAvailable3").hide();
    $("#messageAvailable3").hide();
  }

  function clearValidationMessages4() {
    $("#messageNotAvailable4").hide();
    $("#messageAvailable4").hide();
  }

  function clearValidationMessages5() {
    $("#messageNotAvailable5").hide();
    $("#messageAvailable5").hide();
  }

  function clearValidationMessages6() {
    $("#messageNotAvailable6").hide();
    $("#messageAvailable6").hide();
  }

  function clearValidationMessages7() {
    $("#messageNotAvailable7").hide();
    $("#messageAvailable7").hide();
  }
</script>
