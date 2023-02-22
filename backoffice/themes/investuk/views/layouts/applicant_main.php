<!DOCTYPE html>
<?php  $basePath="/themes/investuk"; ?> 
<html dir="ltr" lang="en-US">

<head>
    <title>Dashboard</title>
    <meta charset="UTF-8" />
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="<?php echo $basePath; ?>/assets/applicant/css/all.css" rel="stylesheet" type="text/css">  
   <link href="<?php echo $basePath; ?>/assets/applicant/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $basePath; ?>/assets/applicant/css/main-style.css" rel="stylesheet" type="text/css">
   <link href="<?php echo $basePath; ?>/assets/applicant/css/responsive.css" rel="stylesheet" type="text/css">
  
</head>

    
<body>

    <div class="Dashboard-wrapper">
        <div class="dashborad-inner">
            <div class="row m-0">
                <div class="col-lg-3 p-0 col-left position-relative">
                    <?php  require_once('applicant/leftmenu.php'); ?>
                </div>
                <div class="col-lg-7 p-0 col-right">
                    <div class="dashboard-conetnt">
                        <?php  require_once('applicant/header.php'); ?>
                         <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>    

<script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/all.js"></script>
    <script type="text/javascript" src="<?php echo $basePath; ?>/assets/applicant/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function(){
            $('.toggle-click').click(function(){

                $(this).parent().toggleClass('active');
                $(this).parent().next().slideToggle(300);

            });

            $('.toggle-icon').click(function(){
                $('body').addClass('open-sidebar');
                $('.col-left').addClass('active-sidebar');
                $(this).addClass('active');
            });

            $('.close-toggle').click(function(){
                $('body').removeClass('open-sidebar');
                $('.col-left').removeClass('active-sidebar');
                $(this).removeClass('active');
            });


        });

    </script>


</html>