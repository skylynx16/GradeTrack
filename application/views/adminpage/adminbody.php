<div class="container-fluid">
    <div class="row">
        <div class="col-md-1 sm-1"></div>
        <div class="col-md-4">
            <div class="admin-title">
                <img class="admin-icon" src="<?php echo base_url(); ?>resources/images/worker.png"><b>GRADETRACK ADMIN</b>
            </div>
        </div>
        <div class="col-md-6">
            <div id="timestamp" class="datetimestyle"></div>
        </div>
    </div><!--row-->

 <!-- ---------- -->  <div class="col-md-12 lg-12 sm-12"><hr class="admin-hr"></div> <!-- ------- -->

        <div class="row">
            <div class="col-md-2 sm-2"></div>
            <div class="col-md-8 sm-8">
                <div class="admin-subtitle">    
                    <a href="<?php echo base_url(); ?>Admin/users.html">Users</a>
                </div>
            </div>
            <div class="col-md-2 sm-2"></div>
        </div>
        
<!-- ---------- -->  <div class="col-md-12 lg-12 sm-12"><hr class="admin-hr"></div> <!-- ------- -->

        <div class="row">
            <div class="col-md-2 sm-2"></div>
            <div class="col-md-8 sm-8">
                <div class="admin-subtitle">    
                    <a href="<?php echo base_url(); ?>Admin/audittrail.html">Audit Trail</a>
                </div>
            </div>
            <div class="col-md-2 sm-2"></div>
        </div>

<!-- ---------- -->  <div class="col-md-12 lg-12 sm-12"><hr class="admin-hr"></div> <!-- ------- -->
        
        <div class="row">
            <div class="col-md-2 sm-2"></div>
            <div class="col-md-8 sm-8">
                <div class="admin-subtitle">    
                    <a href="<?php echo base_url(); ?>Admin/showsysemgp.html">Set School Year, Semester, and Grading Period</a>
                </div>
            </div>
            <div class="col-md-2 sm-2"></div>
        </div>

<!-- ---------- -->  <div class="col-md-12 lg-12 sm-12"><hr class="admin-hr"></div> <!-- ------- -->

        <div class="row">
            <div class="col-md-2 sm-2"></div>
            <div class="col-md-8 sm-8">
                <div class="admin-subtitle">    
                    <a href="<?php echo base_url(); ?>Admin/showdeadline.html">Set Deadline for Encoding of Final Grades and<br>Toggle System Accessibility for Professors</a>
                </div>
            </div>
            <div class="col-md-2 sm-2"></div>
        </div>

<!-- ---------- -->  <div class="col-md-12 lg-12 sm-12"><hr class="admin-hr"></div> <!-- ------- -->
        
        
<center>
    <div class="col-md-12 sm-12 lg-12">  
        <a href="<?php echo base_url(); ?>Admin/database_backup" class="btnBackup hvr-grow"><i class="fas fa-database" style="margin-right: 5px;"></i>Backup Database</a>
     </div>
</center>

<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery-3.3.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>resources/js/jquery.form-validator.min.js""></script>

<script>
    $(document).ready(function() {
        setInterval(timestamp, 1000);
    });

    function timestamp() {
        $.ajax({
            url: '<?php echo base_url(); ?>Admin/serverdateandtime',
            success: function(data) {
                $('#timestamp').html(data);
            },
        });
    }
</script>