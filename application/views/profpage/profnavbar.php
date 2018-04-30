<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <div class="fixed-top">
        <div class="logout">
            <a class="btn btn-default btnLogout" href="<?php echo base_url(); ?>Main/logout.html">
            <i class="far fa-user"></i> Logout</a>
        </div>
    </div>
    
    <div class="navbar-brand">GradeTrack</div>
    
    <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
        <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="collapse_target">
        <ul class="navbar-nav">
            <li class="nav-item hvr-pulse">
                <a class="nav-link" href="<?php echo base_url(); ?>Main/professor_page.html">
                <img src="<?php echo base_url(); ?>resources/images/classlist.png"> Subjects Handled</a>
            </li>
            <li class="nav-item hvr-pulse">
                <a class="nav-link" href="<?php echo base_url(); ?>Main/profaccount.html">
                <img src="<?php echo base_url(); ?>resources/images/account.png"> Account</a>
            </li>
            <li>
                <div style="width:30rem;"><br></div>
            </li>
            <li>
                <div id="timestamp" class="datetimestyle2"></div>
            </li>
            </ul>
</div>
</nav>

<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery.form-validator.min.js""></script>

<script>
    $(document).ready(function() {
        setInterval(timestamp, 1000);
    });

    function timestamp() {
        $.ajax({
            url: '<?php echo base_url(); ?>Main/serverdateandtime',
            success: function(data) {
                $('#timestamp').html(data);
            },
        });
    }
</script>