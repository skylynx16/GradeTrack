<body class="accountBg">
<div class="container-fluid">
    <center>
        <div class="row animated flipInX">
            <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="picContainer">
                        <img src="<?php echo base_url().$this->session->userdata('profilePic'); ?>" height="100%" alt="Profile Picture">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="usernameAccount">
                        <b>Name:</b> <?php echo $this->session->userdata('FName').' '.$this->session->userdata('MName').' '.$this->session->userdata('LName') ?>
                        <p style="font-size: 1.5rem";><b>Student Number:</b> <?php echo $this->session->userdata('IDCode') ?></p>
                        <a href="<?php echo base_url(); ?>Main/changePassword.html" style="font-size: 1rem";>Change Password</a>
                        <form id="setsysemgp">
                        <p style="font-size: 1rem; ">Allow Guardian Notification for this Semester?<br>
                        <select style="width: 20%; font-size: 1rem; " id="parentnotifonoff" name="parentnotifonoff"
                            <?php if($parentNotifIsSet == 1 || $GradingPeriod != 'Midterms') { echo 'disabled'; } ?>>
                            <option value="0" <?php if($parentNotif == 0) {echo 'selected';} ?>>Off (default)</option>
                            <option value="1" <?php if($parentNotif == 1) {echo 'selected';} ?>>On</option>
                        </select>
                        <button type="submit" class="btn btn-default btn-info" onclick="setParentNotifIsSet()" style="width: 12%; height: 1.6rem; padding: 0;" <?php if($parentNotifIsSet == 1 || $GradingPeriod != 'Midterms') { echo 'disabled'; } ?>>Set</button>
                        </form>  
                        </p>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>
</div>
    </center>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>

<script>
    function setParentNotifIsSet() {
        if(confirm("When setting this feature on, you are hereby allowing your listed guardian to receive message notifications whenever your grades are updated. Leaving this feature off will not trigger guardian notification and the grades displayed on the system will not be complete.\n\nOnce set, this setting will be applied and will be disabled for the whole semester. This will be enabled again next semester. Are you sure about this setting?"))
        {
            $.ajax({
                url:"<?php echo base_url(); ?>Main/setparentnotifonoff",
                data:'parentnotifonoff='+$("#parentnotifonoff").val(),
                type:'POST',
                success:function(data){
                    location.reload();
                    alert('Parent Notification setting success!');
                },
                error:function(){
                    location.reload();
                    alert('Something went wrong.');
                }
            })
        }
        else
        {
            alert('Please set this before the end of the Midterms or else it will be set automatically in its default value and will be disabled.');
        }
    }
</script>