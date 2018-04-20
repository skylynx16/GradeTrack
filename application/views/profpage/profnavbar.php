<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top">
    <div class="fixed-top">
        <div class="logout">
            <a class="btn btn-default btnLogout" href="<?php echo base_url(); ?>main/logout.html">
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
                <a class="nav-link" href="<?php echo base_url(); ?>main/professor_page.html">
                <img src="<?php echo base_url(); ?>resources/images/classlist.png"> Subjects Handled</a>
            </li>
            <li class="nav-item hvr-pulse">
                <a class="nav-link" href="<?php echo base_url(); ?>main/profaccount.html">
                <img src="<?php echo base_url(); ?>resources/images/account.png"> Account</a>
            </li>
            </ul>
</div>


</nav>
