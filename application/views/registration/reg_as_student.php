<body class="studentReg-bg">
	<div class="container-fluid">
    <h1 class="animated bounceIn moduleHead">Student Registration</h1>
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

<!--START ------------------------------ registration FORM  ------------------------------------------------------- -->
<div class="animated fadeIn">
<?php 
   $attributes = array('method' => 'POST', 'role' => 'form', 'id' => 'addstudent' );
   echo form_open_multipart('/Main/addstudent', $attributes);

?>

<!--START-------------------------------------- Username and Email ------------------------------------------------- -->
			<center>
				<div class="form-group firstgrp">
						<div class="input-group">
							<div class="input-group-prepend">
									<div class="input-group-text bg-transparent">
									<i class="fa fa-user" style="color: green"></i>
									</div>
							</div>
							<input name="StudUsername" value="<?php echo $this->session->flashdata('StudUsername'); ?>"  data-validation="custom length" data-validation-regexp="^[a-zA-Z0-9_]+$"  data-validation-length="6-30" id="StudUsername" placeholder='Username' class='form-control'  data-validation-error-msg="Please enter a valid Username." data-validation-error-msg-container="#messageValidationLocationStudUsername" onBlur="checkUserAvailability()" onFocus="clearValidationMessages()">
							<span class="input-group-append">
								<i class="textBoxMessageAvailableMd" id='messageAvailable' > Username <br> Available.</i>
								<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable' > Username <br> Already Used.</i>
							</span>
						</div>
				
					<span>
					<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader"  /></i>
					<div class="jQueryFormValidationMessage" id="messageValidationLocationStudUsername"></div>
					</span>

						<div class="input-group">
							<div class="input-group-prepend">
									<div class="input-group-text bg-transparent">
									<i class="fa fa-envelope" style="color: green"></i>
									</div>
							</div>
							<input name="StudEmail" value="<?php echo $this->session->flashdata('StudEmail'); ?>" data-validation="email" id="StudEmail" placeholder='Email Address' class='form-control'  data-validation-error-msg="Please enter a valid Email Address." data-validation-error-msg-container="#messageValidationLocationStudEmail" onBlur="checkEmailAvailability()" onFocus="clearValidationMessages1()" >
							<span class="input-group-append">
								<i class="textBoxMessageAvailableMd" id='messageAvailable1' > Email <br> Available.</i>
								<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable1' > Email <br> Already Used.</i>
							</span>
						</div>
					<span>
					<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader1"  /></i>
					<div class="jQueryFormValidationMessage" id="messageValidationLocationStudEmail"></div>
					</span>
			
				</div>
			
<!--END ---------------------------------- Username and Email ----------------------------------------------------- -->

<!--START ---------------------------------- Student Number ------------------------------------------------------- -->
		<hr width="100%">
			<div class="label-verify">
				<b>This part is for verification. Please input the information used in the records of the Registrar.</b>
			</div>

			<div class="input-group">
				<input name="StudNo" value="<?php echo $this->session->flashdata('StudNo'); ?>" data-validation="number" id="StudNo" placeholder='Student Number' class='form-control'  data-validation-error-msg="Please enter a valid Student Number." data-validation-error-msg-container="#messageValidationLocationStudNo" onBlur="checkStudNoValidity()" onFocus="clearValidationMessages2()" >
				<span class="input-group-append">
					<i class="textBoxMessageAvailableMd" id='messageAvailable2' > Student No. <br> Match.</i>
					<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable2' > Student No. <br> Did Not Match.</i>
				</span>
			</div>
			<span>
			<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader2"  /></i>
			<div class="jQueryFormValidationMessage" id="messageValidationLocationStudNo"></div>
			</span>

<!--END ---------------------------------- Student Number -------------------------------------------------------- -->

<!--START ---------------------------------- FULL NAME ------------------------------------------------------------ -->
	<div class="form-group row">
			<div  class="col-md-4">
				<div class="input-group">
					<input name="StudFName" value="<?php echo $this->session->flashdata('StudFName'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z-\s]+$" id="StudFName" placeholder='First Name' class='form-control'  data-validation-error-msg="Please enter a valid First Name." data-validation-error-msg-container="#messageValidationLocationStudFName" onBlur="checkFNameValidity()" onFocus="clearValidationMessages3()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable3' > First Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable3' > First Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader3"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationStudFName"></div>
				</span>
			</div>

			<div  class="col-md-4">
				<div class="input-group">
					<input name="StudMName" value="<?php echo $this->session->flashdata('StudMName'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z-\s]+$" id="StudMName" placeholder='Middle Name' class='form-control'  data-validation-error-msg="Please enter a valid Middle Name." data-validation-error-msg-container="#messageValidationLocationStudMName" onBlur="checkMNameValidity()" onFocus="clearValidationMessages4()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable4' > Middle Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable4' > Middle Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader4"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationStudMName"></div>
				</span>
			</div>

			<div  class="col-md-4">
				<div class="input-group">
					<input name="StudLName" value="<?php echo $this->session->flashdata('StudLName'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z-\s]+$" id="StudLName" placeholder='Last Name' class='form-control'  data-validation-error-msg="Please enter a valid Last Name." data-validation-error-msg-container="#messageValidationLocationStudLName" onBlur="checkLNameValidity()" onFocus="clearValidationMessages5()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable5' > Last Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable5' > Last Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader5"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationStudLName"></div>
				</span>
			</div>

	</div><!--form-group-->
<!--END--------------------------------------- Full Name ---------------------------------------------------------- -->

<!--START ---------------------------------- BDATE and Mobile------------------------------------------------------ -->
	<div class="form-group row">
		<div  class="col-md-6">
			<div class="input-group">
				<input name="StudBDate" type="text" value="<?php echo $this->session->flashdata('StudBDate'); ?>" data-validation="custom length" data-validation-regexp="^[0-9-]+$" data-validation-length="10-10" id="StudBDate" placeholder='Birth Date (yyyy-mm-dd)' class='form-control'  data-validation-error-msg="Please enter a valid Birth Date." data-validation-error-msg-container="#messageValidationLocationStudBDate" onBlur="checkBDateValidity()" onFocus="clearValidationMessages6()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable6' > Birth Date <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable6' > Birth Date <br> Did Not Match.</i>
					</span>
			</div>
			<span>
			<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader6"  /></i>
			<div class="jQueryFormValidationMessage" id="messageValidationLocationStudBDate"></div>
			</span>
		</div>

		<div  class="col-md-6">
			<div class="input-group">
				<input name="StudMobile" value="<?php echo $this->session->flashdata('StudMobile'); ?>" data-validation="number length" data-validation-length="11-11" id="StudMobile" placeholder='Mobile Number (09991234567)' class='form-control' data-validation-error-msg="Please enter a valid Mobile Number." data-validation-error-msg-container="#messageValidationLocationStudMobile" onBlur="checkMobileValidity()" onFocus="clearValidationMessages()7" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable7' > Mobile Number <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable7' > Mobile Number <br> Did Not Match.</i>
					</span>
			</div>
			<span>
			<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader7"  /></i>
			<div class="jQueryFormValidationMessage" id="messageValidationLocationStudMobile"></div>
			</span>
		</div>
	</div><!--form group-->
<!--END ------------------------------------- Bdate and Mobile ---------------------------------------------------- -->

<!--START --------------------------------------- CITY ADDRESS ---------------------------------------------------- -->

	<div class="input-group">
		<input name="StudCityAddr" value="<?php echo $this->session->flashdata('StudCityAddr'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z0-9\s,.-]+$"" id="StudCityAddr" placeholder='City Address' class='form-control'  data-validation-error-msg="Please enter a valid City Address." data-validation-error-msg-container="#messageValidationLocationStudCityAddr" onBlur="checkCityAddrValidity()" onFocus="clearValidationMessages8()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable8' > City Address <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable8' > City Address <br> Did Not Match.</i>
					</span>
	</div>
	<span>
	<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader8"  /></i>
	<div class="jQueryFormValidationMessage" id="messageValidationLocationStudCityAddr"></div>
	</span>

<!--END ----------------------------------------- CITY ADDRESS  --------------------------------------------------- -->

<!--START --------------------------------------- GUARDIAN ------------------------------------------------------ -->
	<div class="form-group row">
			<div  class="col-md-6">
				<div class="input-group">
					<input name="StudGuardian" value="<?php echo $this->session->flashdata('StudGuardian'); ?>" data-validation="custom" data-validation-regexp="^[a-zA-Z\s.-]+$" id="StudGuardian" placeholder='Guardian&apos;s Name' class='form-control'  data-validation-error-msg="Please enter a valid Guardian&apos;s Name." data-validation-error-msg-container="#messageValidationLocationStudGuardian" onBlur="checkGuardianValidity()" onFocus="clearValidationMessages9()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable9' > Guardian's Name <br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable9' > Guardian's Name <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader9"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationStudGuardian"></div>
				</span>
			</div>

			<div  class="col-md-6">
				<div class="input-group">
					<input name="StudGuardianMobile" value="<?php echo $this->session->flashdata('StudGuardianMobile'); ?>" data-validation="number length" data-validation-length="11-11" id="StudGuardianMobile" placeholder='Guardian&apos;s Mobile Number (09991234567)' class='form-control'  data-validation-error-msg="Please enter a valid Guardian&apos;s Mobile Number." data-validation-error-msg-container="#messageValidationLocationStudGuardianMobile" onBlur="checkGuardianMobileValidity()" onFocus="clearValidationMessages10()" >
					<span class="input-group-append">
						<i class="textBoxMessageAvailableMd" id='messageAvailable10' >  Guardian's Mobile Number<br> Match.</i>
						<i class="textBoxMessageNotAvailableMd" id='messageNotAvailable10' >  Guardian's Mobile Number <br> Did Not Match.</i>
					</span>
				</div>
				<span>
				<i><img src="<?php echo base_url();?>resources/images/LoaderIcon.gif" class ="progressImageRight" id="iconLoader10"  /></i>
				<div class="jQueryFormValidationMessage" id="messageValidationLocationStudGuardianMobile"></div>
				</span>
			</div>
	</div><!--form group-->

	<div class="form-group">
		<div class="form-check">
			<label class="form-check-label" for="invalidCheck">
			<input class="form-check-input" type="checkbox" name="TermsOfUse" id="invalidCheck" required>
			I agree to the <a href="<?php echo base_url(); ?>Main/termsandconditions.html" target="_blank"> terms and conditions</a> of this website.
			</label>
		</div>
	</div>
	</center>
<!--END -------------------------------- GUARDIAN  ----------------------------------------------------------- -->

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

  var error = 0; var error1 = 0; var error2 = 0; var error3 = 0; var error4 = 0; var error5 = 0;
  var error6 = 0; var error7 = 0; var error8 = 0; var error9 = 0; var error10 = 0;
//-------------------------------------------------------------------------------------------------------------
  function checkUserAvailability() {
    $("#iconLoader").show();

    jQuery.ajax({
      url: "../Main/checkStudUserName",
      data: 'StudUsername='+$("#StudUsername").val(),
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
      url: "../Main/checkStudEmail",
      data: 'StudEmail='+$("#StudEmail").val(),
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

  function checkStudNoValidity() {
    $("#iconLoader2").show();

    jQuery.ajax({
      url: "../Main/checkStudNo",
      data: 'StudNo='+$("#StudNo").val(),
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
      url: "../Main/checkStudFName",
      data: 'StudNo='+$("#StudNo").val()+'&StudFName='+$("#StudFName").val(),
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
      url: "../Main/checkStudMName",
      data: 'StudNo='+$("#StudNo").val()+'&StudMName='+$("#StudMName").val(),
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
      url: "../Main/checkStudLName",
      data: 'StudNo='+$("#StudNo").val()+'&StudLName='+$("#StudLName").val(),
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
      url: "../Main/checkStudBDate",
      data: 'StudNo='+$("#StudNo").val()+'&StudBDate='+$("#StudBDate").val(),
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

  function checkMobileValidity() {
    $("#iconLoader7").show();

    jQuery.ajax({
      url: "../Main/checkStudMobile",
      data: 'StudNo='+$("#StudNo").val()+'&StudMobile='+$("#StudMobile").val(),
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

  function checkCityAddrValidity() {
    $("#iconLoader8").show();

    jQuery.ajax({
      url: "../Main/checkStudCityAddr",
      data: 'StudNo='+$("#StudNo").val()+'&StudCityAddr='+$("#StudCityAddr").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable8").hide();
        $("#messageAvailable8").show();
        $("#iconLoader8").hide();
        enabledisableSubmitBtn(error8 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable8").hide();
        $("#messageNotAvailable8").hide();
        $("#iconLoader8").hide();
	  }
	  else {
        $("#messageAvailable8").hide();
        $("#messageNotAvailable8").show();
        $("#iconLoader8").hide();
        enabledisableSubmitBtn(error8 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkGuardianValidity() {
    $("#iconLoader9").show();

    jQuery.ajax({
      url: "../Main/checkStudGuardian",
      data: 'StudNo='+$("#StudNo").val()+'&StudGuardian='+$("#StudGuardian").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable9").hide();
        $("#messageAvailable9").show();
        $("#iconLoader9").hide();
        enabledisableSubmitBtn(error9 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable9").hide();
        $("#messageNotAvailable9").hide();
        $("#iconLoader9").hide();
	  }
	  else {
        $("#messageAvailable9").hide();
        $("#messageNotAvailable9").show();
        $("#iconLoader9").hide();
        enabledisableSubmitBtn(error9 = 1);
      }
    },
        error:function (){}
    });
  }

  function checkGuardianMobileValidity() {
    $("#iconLoader10").show();

    jQuery.ajax({
      url: "../Main/checkStudGuardianMobile",
      data: 'StudNo='+$("#StudNo").val()+'&StudGuardianMobile='+$("#StudGuardianMobile").val(),
      type: "POST",
      success:function(data){
      if(data == 2) {
        $("#messageNotAvailable10").hide();
        $("#messageAvailable10").show();
        $("#iconLoader10").hide();
        enabledisableSubmitBtn(error10 = 0);
      }
	  else if(data == 0) {
		$("#messageAvailable10").hide();
        $("#messageNotAvailable10").hide();
        $("#iconLoader10").hide();
	  }
	  else {
        $("#messageAvailable10").hide();
        $("#messageNotAvailable10").show();
        $("#iconLoader10").hide();
        enabledisableSubmitBtn(error10 = 1);
      }
    },
        error:function (){}
    });
  }
//-------------------------------------------------------------------------------------------------------------
  function enabledisableSubmitBtn(error) {
  	if(error == 0 && error1 == 0 && error2 == 0 && error3 == 0 && error4 == 0 && error5 == 0 && error6 == 0 && error7 == 0 && error8 == 0 && error9 == 0 && error10 == 0) 	{
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

  function clearValidationMessages8() {
    $("#messageNotAvailable8").hide();
    $("#messageAvailable8").hide();
  }

  function clearValidationMessages9() {
    $("#messageNotAvailable9").hide();
    $("#messageAvailable9").hide();
  }

  function clearValidationMessages10() {
    $("#messageNotAvailable10").hide();
    $("#messageAvailable10").hide();
  }
</script>
