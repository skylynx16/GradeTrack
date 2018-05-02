<div class="container">
	<div class="row">
		<div class="col-md-10">
			<p style="font-family: 'Century Gothic'; font-size: 3rem; vertical-align: middle;" class="animated bounceInLeft">
				Professor Encoding Audit Trail<br>
				School Year: <u><?php echo '20'.substr($SY,0,2).'-20'.substr($SY,2,3); ?></u><br>
				Semester: <u><?php echo $Sem; ?></u>
			</p>
			<div class="search-container animated bounceInLeft">
				<form action="<?php echo base_url(); ?>Admin/searchProfEncodeAuditTrail.html" method="POST">
				Search by:
					<input type="text" placeholder="Subject Code/Professor Name/Section" name="SearchKey" style="width:50%;" required>
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
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/profencodeaudittrail.html">
						Reset Table</a>'; ?></p>
		</div>
	</div> <!--row -->
<br><br>
    <div class="row">
		<div class="col-md-12 lg-12 xs-12 sm-12">
			<table class="table table-bordered animated flipInX" id="user_tbl">
					<tr id="user_tbl_head">
						<td id="user_tbl_data">Subject Code | Professor Name | Section</td>
						<td id="user_tbl_data">Midterm Grade Encoded</td>
						<td id="user_tbl_data">Pre-Final Grade Encode</td>
						<td id="user_tbl_data">Final Grade Encoded</td>
					</tr>
				<?php if(isset($tblaudittrail)) : foreach($tblaudittrail as $row) : ?>
					<tr id="user_tbl_content">
						<td id="user_tbl_data"><?php echo $row->SubjCode_ProfName_Section; ?></td>
						<td id="user_tbl_data" align="center"><?php if($row->MidtermGradeEncoded == 1) {echo '<label style="color:green;">OK</label>';} else {echo '<label style="color:red;">X</label>';} ?></td>
						<td id="user_tbl_data" align="center"><?php if($row->PrefinalGradeEncoded == 1) {echo '<label style="color:green;">OK</label>';} else {echo '<label style="color:red;">X</label>';} ?></td>
						<td id="user_tbl_data" align="center"><?php if($row->FinalGradeEncoded == 1) {echo '<label style="color:green;">OK</label>';} else {echo '<label style="color:red;">X</label>';} ?></td>
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