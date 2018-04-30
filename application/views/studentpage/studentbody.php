<body class="accountBg">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>

		<div class="col-md-8">
<!--START ------------------------------ Backup Error --------------------------------------------------------- -->
<?php
    if ($this->session->flashdata('msg')){ //change!
        echo '<div class="backupErrorMsg2">';
        echo $this->session->flashdata('msg');
        echo "</div>";
    }
?>
<!--END -------------------------------- Backup Error ----------------------------------------------------------- -->

<!--START ------------------------------ Success Messages --------------------------------------------------------- -->
<?php
    if ($this->session->flashdata('msgsuccess')){ //change!
        echo '<div class="SuccessMsg">';
        echo $this->session->flashdata('msgsuccess');
        echo "</div>";
    }
?>
<!--END -------------------------------- Success Messages ----------------------------------------------------------- -->

			<center>
				<div class="welcome-container animated fadeIn">
					Welcome <?php echo $this->session->userdata('FName'); ?>!
				</div>
                <p class="main-welcome-subtitle animated bounceInUp "> Current Semester: <?php if($Sem == 'A') {echo '1st';} else if($Sem == 'B') {echo '2nd';} else {echo 'Summer';} ?></p>
				<p class="main-welcome-subtitle animated bounceInUp "> Click a subject to view grades</p>

			<?php
			    foreach($subjects as $row) :
			    {
					echo "<a href='".base_url()."Main/studviewtable/".$row->ESubjCode."/".$row->SectCode."/".str_replace("&"," and ",str_replace("("," - ",str_replace(")","",str_replace("%20", " ",$row->Description))))."'>";
					echo '<div class="btnSubject animated bounceInUp">';
					echo $row->ESubjCode." - ".$row->Description." - ".$row->SectCode;
					echo '</div>';
					echo "</a><br>";
			    }
			    endforeach;
			?>
		</div>
		<div class="col-md-2 col-sm-2 col-2"></div>
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