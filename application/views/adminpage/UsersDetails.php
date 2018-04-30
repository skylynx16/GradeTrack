<div class="container">
	<div class="row">
		<div class="col-md-10">
			<p style="font-family: 'Century Gothic'; font-size: 3rem; vertical-align: middle;" class="animated bounceInLeft">
				Users' Table
			</p>
			<div class="search-container animated bounceInLeft">
				<form action="<?php echo base_url(); ?>Admin/searchuserdetails.html" method="POST">
				Search by:
					<input type="text" placeholder="First Name" name="FName" style="width:20%;">
					<input type="text" placeholder="Middle Name" name="MName" style="width:20%;">
					<input type="text" placeholder="Last Name" name="LName" style="width:20%;"> or 
					<input type="text" placeholder="Username" name="Username" style="width:15%;">
					<button type="submit" class="btn btn-default btn-info"><i class="fa fa-search"></i></button>
				</form>
			<br>
			<b>No. of Active Users:</b> <?php echo $noOfActiveUsers; ?><br>
			<b>No. of Logged In Users:</b> <?php echo $noOfLoggedInUsers; ?>
			</div>
		</div>
		<div class="col-md-2">
			<p style="text-align:center; vertical-align:middle;" class="animated bounceInRight">
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/adminbody.html">
						<i class="fas fa-arrow-circle-left" style="margin-right: 5px;"></i>Go Back</a>'; ?></p>
			<p style="text-align:center; vertical-align:middle;" class="animated bounceInRight">
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/users.html">
						Reset Table</a>'; ?></p>
		</div>
	</div>
<br>
<center>
	<div class="row">
		<div class="col-md-12 lg-12 xs-12 sm-12">
			<table class="table table-bordered animated flipInX" id="user_tbl">
					<tr id="user_tbl_head">
						<td id="user_tbl_data">Name</td>
						<td id="user_tbl_data">Username</td>
						<td id="user_tbl_data">Email</td>
						<td id="user_tbl_data">User Type</td>
						<td id="user_tbl_data">Parent Notification</td>
						<td id="user_tbl_data">Last Login</td>
						<td id="user_tbl_data">Account Status</td>
						<td id="user_tbl_data">Is Logged In</td>
					</tr>
				<?php if(isset($tblusers)) : foreach($tblusers as $row) : ?>
					<tr id="user_tbl_content">
						<td id="user_tbl_data"><?php echo $row->FName.' '.$row->MName.' '.$row->LName; ?></td>
						<td id="user_tbl_data"><?php echo $row->Username; ?></td>
						<td id="user_tbl_data"><?php echo $row->Email; ?></td>
						<td id="user_tbl_data"><?php if($row->UserTypeID == 1) {echo 'Professor';} else if($row->UserTypeID == 2){echo 'Student';} else if($row->UserTypeID == 3) {echo 'Admin';} ?></td>
						<td id="user_tbl_data"><?php if($row->parentNotif == 1) {echo 'Enabled';} else{echo 'Disabled';} ?></td>
						<td id="user_tbl_data"><?php echo $row->lastlogin; ?></td>
						<td id="user_tbl_data"><?php echo $row->status; ?></td>
						<td id="user_tbl_data"><?php if($row->isloggedin == 1) {echo 'Yes';} else {echo 'No';} ?></td>
					</tr>
				<?php endforeach; ?>
				<?php endif; ?>
			</table>			
		</div>
	</div>

<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>

<script>
	//Back to top script
	$(document).ready(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('#scroll').fadeIn();
        }else{
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});
</script>