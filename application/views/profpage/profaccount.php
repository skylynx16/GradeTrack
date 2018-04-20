<body class="accountBg">
<div class="container-fluid">
    <center>
        <div class="row animated flipInX">
            <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="picContainer">
                        <img src="<?php echo base_url(); ?>resources/images/profilepic/userprofilepicmale.png" height="100%" alt="Profile Picture">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="usernameAccount">
                        <b>Name:</b> <?php echo $this->session->userdata('FName').' '.$this->session->userdata('MName').' '.$this->session->userdata('LName') ?>
                        <p style="font-size: 1.5rem";><b>ID Code:</b> <?php echo $this->session->userdata('IDCode') ?></p>
                        <a href="<?php echo base_url(); ?>main/changePassword.html" style="font-size: 1.3rem";>Change Password</a>
                    </div>
                </div>
            <div class="col-md-2"></div>
        </div>
</div>
    </center>