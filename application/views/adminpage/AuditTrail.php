<div class="container">
	<div class="row">
		<div class="col-md-10">
			<p style="font-family: 'Century Gothic'; font-size: 3rem; vertical-align: middle;" class="animated bounceInLeft">
				Audit Trail
			</p>
			<div class="search-container animated bounceInLeft">
				<form action="<?php echo base_url(); ?>Admin/searchaudittrail.html" method="POST">
				Search by:
					<input type="text" placeholder="Username" name="Username" style="width:20%;">
					<select name="UserType" style="width:20%; height: 30px;">
						<option value="">Choose User Type</option>
						<option value="professor">Professor</option>
					  	<option value="student">Student</option>
					  	<option value="admin">Admin</option>
					</select>
					<input type="text" placeholder="Action Done" name="ActionDone" style="width:20%;">
					<input type="text" placeholder="Date or Time" name="DateTime" style="width:20%;">
					<button type="submit" class="btn btn-default btn-info"><i class="fa fa-search"></i></button>
				</form>
			</div>
        </div>
		<br>

        <div class="col-md-2">
			<p style="text-align:center; vertical-align:middle;" class="animated bounceInRight">
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/adminbody.html">
						<i class="fas fa-arrow-circle-left" style="margin-right: 5px;"></i>Go Back</a>'; ?></p>
			<p style="text-align:center; vertical-align:middle;" class="animated bounceInRight">
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/audittrail.html">
						Reset Table</a>'; ?></p>
		</div>
	</div> <!--row -->
<br><br>
    <div class="row">
		<div class="col-md-12 lg-12 xs-12 sm-12">
			<table class="table table-bordered animated flipInX" id="user_tbl">
					<tr id="user_tbl_head">
						<td id="user_tbl_data">Username</td>
						<td id="user_tbl_data">User Type</td>
						<td id="user_tbl_data">Action Done</td>
						<td id="user_tbl_data">Date &amp; Time Action Made</td>
						<td id="user_tbl_data">IP Address</td>
					</tr>
				<?php if(isset($tblaudittrail)) : foreach($tblaudittrail as $row) : ?>
					<tr id="user_tbl_content">
						<td id="user_tbl_data"><?php echo $row->Username; ?></td>
						<td id="user_tbl_data"><?php if($row->UserType == 1) {echo 'Professor';} else if($row->UserType == 2){echo 'Student';} else if($row->UserType == 3) {echo 'Admin';} ?></td>
						<td id="user_tbl_data"><?php echo $row->ActionDone; ?></td>
						<td id="user_tbl_data"><?php echo $row->DateTimeActionMade; ?></td>
						<td id="user_tbl_data"><?php echo $row->ip_address; ?></td>
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