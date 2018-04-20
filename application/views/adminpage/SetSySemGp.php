<div class="container">
	<div class="row">
		<div class="col-md-9">
			<p style="font-family: 'Century Gothic'; font-size: 3rem; vertical-align: middle;" class="animated bounceInLeft">
				Set School Year, Semester, and Grading Period
			</p>
        </div>
        <div class="col-md-3">
			<p style="text-align:center; vertical-align:middle;" class="animated bounceInRight">
			<?php echo '<a class="btnGoBack2 hvr-backward" style="margin-right:5px;" href="'.base_url().'admin/adminbody.html">
						<i class="fas fa-arrow-circle-left" style="margin-right: 5px;"></i>Go Back</a>'; ?>
		</div>
    </div><!-- row -->
    <br>

    <form id="setsysemgp" action="<?php echo base_url(); ?>admin/setsysemgp" method="POST" class="animated bounceInRight">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <div class="form-group">
                <b>Set School Year</b><br>
                <input style="width: 100%;" type="text" id="schoolYear" name="schoolYear" value="<?php echo $SY; ?>">
                <?php echo "<div class='message' style= 'color:red; font-size:0.8rem; font-family: Arial, Helvetica, sans-serif; text-align:center; margin-top:0.5rem;'>"; ?>
                <?php echo form_error('schoolYear') ?>
                <?php echo "</div>";?>
            </div>
        </div>
            
        <div class="col-md-3">
            <div class="form-group">
                <b>Set Semester</b><br>
                <select style="width: 100%;" id="semester" name="semester">
                    <option value="A" <?php if($Sem == 'A') echo 'selected'; ?>>A</option>
                    <option value="B" <?php if($Sem == 'B') echo 'selected'; ?>>B</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <b>Set Grading Period</b><br>
                <select style="width: 100%;" id="gradingperiod" name="gradingperiod">
                    <option value="Midterms" <?php if($GradingPeriod == 'Midterms') echo 'selected'; ?>>Midterms</option>
                    <option value="Pre-Finals" <?php if($GradingPeriod == 'Pre-Finals') echo 'selected'; ?>>Pre-Finals</option>
                    <option value="Finals" <?php if($GradingPeriod == 'Finals') echo 'selected'; ?>>Finals</option>
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                <button type="submit" class="btn btn-default btn-info" style="width: 100%; margin-top: 1rem;">Set</button>
            </div>
        </div>
        <div class="col-md-1"></div>
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
                            <td id="user_tbl_data">School Year</td>
                            <td id="user_tbl_data">Semester</td>
                            <td id="user_tbl_data">Grading Period</td>
                            <td id="user_tbl_data">Last Updated</td>
                        </tr>
                    <?php if(isset($wholetable)) : foreach($wholetable as $row) : ?>
                        <tr id="user_tbl_content" class="setSySem">
                            <td id="user_tbl_data"><?php echo $row->SY; ?></td>
                            <td id="user_tbl_data"><?php echo $row->Sem; ?></td>
                            <td id="user_tbl_data"><?php echo $row->GradingPeriod; ?></td>
                            <td id="user_tbl_data"><?php echo $row->datetime_updated; ?></td>
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