<div class="container">
	<div class="row">
		<div class="col-md-9">
			<p style="font-family: 'Century Gothic'; font-size: 3rem; vertical-align: middle;" class="animated bounceInLeft">
				Set Deadline for Encoding of Final Grades and Toggle System Accessibility for Professors
			</p>
        </div>
        <div class="col-md-3">
			<p style="text-align:center; vertical-align:middle;" class="animated bounceInRight">
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/adminbody.html">
						<i class="fas fa-arrow-circle-left" style="margin-right: 5px;"></i>Go Back</a>'; ?>
		</div>
    </div><!-- row -->
    <br>

    <form id="setsysemgp" action="<?php echo base_url(); ?>Admin/setdeadline" method="POST" class="animated bounceInRight">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <div class="form-group">
                <b>Set Deadline of Encoding of Final Grades</b><br><br>
                Date: <input style="width: 30%;border: solid gray 1px;" type="date" id="deadlineDate" name="deadlineDate" required>&nbsp;
                Time: <input style="width: 30%;border: solid gray 1px;" type="time" id="deadlineTime" name="deadlineTime" required><br>
                <button type="submit" class="btn btn-default btn-info" style="width: 20%; margin-top: 1rem;">Set</button>
            </div>
        </div>

        <div class="col-md-5">
            <?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/enableprofaccounts">
                        Manually Unlock Professor Accounts</a>'; ?><br><br>
            <?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'Admin/disableprofaccounts">
                        Manually Lock Professor Accounts</a>'; ?>
        </div>
    </div>
    </form>  
<br><br>
    <hr class="admin-hr">
<br><br>
    <div class="row">
        <div class="col-md-2"></div>
            <div class="col-md-8">

                <table class="table table-bordered animated flipInX" id="setSySem">
                        <tr id="user_tbl_head" class="setSySem">
                            <td id="user_tbl_data">Deadline Date and Time</td>
                            <td id="user_tbl_data">Semester</td>
                            <td id="user_tbl_data">School Year</td>
                            <td id="user_tbl_data">Date and Time Set</td>
                            <td id="user_tbl_data">Professor Accounts Disabled</td>
                            <td id="user_tbl_data">Manual Override</td>
                        </tr>
                    <?php if(isset($wholetable)) : foreach($wholetable as $row) : ?>
                        <tr id="user_tbl_content" class="setSySem">
                            <td id="user_tbl_data"><?php echo $row->deadlineDateTime; ?></td>
                            <td id="user_tbl_data"><?php echo $row->Sem; ?></td>
                            <td id="user_tbl_data"><?php echo $row->SY; ?></td>
                            <td id="user_tbl_data"><?php echo $row->datetimeSet; ?></td>
                            <td id="user_tbl_data"><?php if($row->ProfAccountsDisabled == 0){echo 'No';}else{echo 'Yes';} ?></td>
                            <td id="user_tbl_data"><?php if($row->manualOverride == 0){echo 'No';}else{echo 'Yes';} ?></td>
                        </tr>
                    <?php endforeach; ?> 
                    <?php endif; ?>                   
                </table>
            </div>
    <div class="col-md-2"></div>
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