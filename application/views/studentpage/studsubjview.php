<div class="container">
	<div class="col-md-12 lg-12 xs-12 sm-12">
		<p style="font-family: 'Century Gothic'; font-size: 1.5rem; vertical-align: middle;" class="animated bounceInLeft">
			<u>Subject Code:</u> <?php echo $this->uri->segment(3); ?><br>
			<u>Subject Description:</u> <?php echo str_replace("%20", " ", $this->uri->segment(5)); ?><br>
			<u>Section Code:</u> <?php echo str_replace("%20", " ", $this->uri->segment(4)); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<u>School Year:</u> <?php echo '20'.substr($SY,0,2).'-20'.substr($SY,2,3); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<u>Semester:</u> <?php if($Sem == 'A') {echo '1st';} else {echo '2nd';} ?>
			<h6 class="animated bounceInLeft">Please click "Confirm" once you see your midterm grades and you don't have any complaints about it.<br>If you can't see your grades and it is already the Final Grading Period then maybe you should check your balance in the Accounting Office.</h6>
			</p>
			<br>
		<table class="table table-bordered animated flipInX" id="user_tbl">
		<tr id="user_tbl_head">
			<td id="user_tbl_data">Student No.</td>
			<td id="user_tbl_data">Student Name</td>
			<td id="user_tbl_data">Percentage Midterm Grade</td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>>Decimal Midterm Grade</td>
			<td id="user_tbl_data">Confirm Midterm Grade</td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>>Percentage Pre-final Grade</td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>>Decimal Pre-Final Grade</td>
			<td id="user_tbl_data">Percentage Final Grade</td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>>Decimal Final Grade</td>
		</tr>
	<?php if(isset($rec_from_db)) : foreach($rec_from_db as $row) : ?>
		<tr id="user_tbl_content" <?php if($GradingPeriod == 'Finals' && $Balance != 0) {echo 'hidden';} ?>>
			<td id="user_tbl_data"><?php echo $row->StudNo; ?></td>
			<td id="user_tbl_data"><?php echo $row->StudName; ?></td>
			<td id="user_tbl_data"><?php echo $row->PercMidtermGrade; ?></td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>><?php echo $row->DecMidtermGrade; ?></td>
			<td id="update_btn">
				<?php
					if($row->PercMidtermGrade != '')
					{
						if($row->MidtermGradeConfirmed == 0)
						{
							$StudNo = $row->StudNo;
							$tblName = strtolower(str_replace(".","",str_replace("_","",$this->uri->segment(3))));
							$SectCode = "_".strtolower(str_replace("-","_",str_replace("%20", "_", $this->uri->segment(4))));
							echo "<input type=\"button\" onclick=\"disablewhenclicked('".$StudNo."', '".$tblName."', '".$SectCode."')\" id=\"btnConfirm\" value='Confirm'></input>"; 
						} else { 
							echo 'Confirmed'; 
						} 
					}
					else
					{
						echo 'No grades yet.';
					} 
				?>
			</td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>><?php echo $row->PercPreFinalGrade; ?></td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>><?php echo $row->DecPreFinalGrade; ?></td>
			<td id="user_tbl_data"><?php echo $row->PercFinalGrade; ?></td>
			<td id="user_tbl_data" <?php if($parentNotif == 0) {echo 'hidden';} ?>><?php echo $row->FinalGrade; ?></td>
		</tr>
	<?php endforeach; ?>
	<?php endif; ?>
</table>
</div>

<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 animated fadeIn">
			<center>
			<?php echo '<a class="btnGoBack hvr-backward" href="'.base_url().'main/student_page.html">
						<i class="fas fa-arrow-circle-left" style="margin-right: 5px;"></i>Go Back</a>'; ?>

			<?php echo '<a class="btnPrint hvr-grow-shadow" href="'.base_url().'main/student_PrintGradesviaPDF/'.$this->uri->segment(3).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'">
						<i class="fas fa-print" style="margin-right: 5px;"></i>Print</a>'; ?>
			</center>

		</div>
		<div class="col-md-2"></div>
</div>
<a href="javascript:void(0);" id="scroll" title="Scroll to Top" style="display: none;">Top<span></span></a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>

<script>
	function disablewhenclicked(StudNo, tblName, SectCode) {
    	$("#btnConfirm").attr('disabled', 'disabled');

    	jQuery.ajax({
        url: "../../../updateMidtermGradeConfirmation",
        data: 'StudNo='+StudNo+'&tblName='+tblName+'&SectCode='+SectCode,
        type: "POST",
        success:function(data){
        	if(data == 1) {
	        	alert('Midterm Grade has been confirmed.');
	        	location.reload();
	        }
	        else {
	        	alert('Error in confirming midterm grade.');
	        }
    	},
        error:function (){}
    	});
 	}

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