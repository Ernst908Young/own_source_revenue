<?php
   $base=Yii::app()->theme->baseUrl;
   ?>
<!DOCTYPE html>
<!--[if IE 8]> 
<html lang="en" class="ie8 no-js">
   <![endif]-->
   <!--[if IE 9]> 
   <html lang="en" class="ie9 no-js">
      <![endif]-->
      <!--[if !IE]><!-->
      <html lang="en">
         <!--<![endif]-->
         <!-- BEGIN HEAD -->
         <head>
            <meta charset="utf-8" />
            <title>Single Window Clearance System | Uttarakhand</title>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta content="width=device-width, initial-scale=1" name="viewport" />
            <meta content="Single Window Clearance System, SWCS" name="description" />
            <meta content="" name="Hemant Thakur" />
            <!-- BEGIN GLOBAL MANDATORY STYLES -->
            <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
            <!-- END GLOBAL MANDATORY STYLES -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL STYLES -->
            <link href="<?=$base?>/../swcsNewTheme/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
            <!-- END THEME GLOBAL STYLES -->
            <!-- BEGIN THEME LAYOUT STYLES -->
            <link href="<?=$base?>/../swcsNewTheme/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
            <link href="<?=$base?>/../swcsNewTheme/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
            <link href="<?=$base?>/../swcsNewTheme/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
            <!-- END THEME LAYOUT STYLES -->
            <link rel="shortcut icon" href="favicon.ico" />
            <link href="<?php echo Yii::app()->theme->baseUrl;?>/assets/morris.js-0.4.3/morris.css" rel="stylesheet" />
            <link href="css/extension-page-style.css" rel="stylesheet" type="text/css"  />
            <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
            <script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.widgets.js"></script>
            <style type="text/css">
              @media (min-width: 500px){
                 .logo{
                font-weight: 800;
                font-size: 30px;
                color: #fff;
                width: auto;
              }
               .logo :hover{
                font-weight: 800;
                font-size: 30px;
                color: #fff;
                width: auto;
                text-decoration: none;
              }
            }
            a:hover{
               color: #fff;
               text-decoration: none;
            }
            .page-header.navbar .page-logo{
               width: auto;
            }
             
            </style>
         </head>
         <!-- END HEAD -->
         <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
            <div class="page-wrapper">
               <!-- BEGIN HEADER -->
               <div class="page-header navbar navbar-fixed-top">
                  <!-- BEGIN HEADER INNER -->
                  <div class="page-header-inner ">
                     <!-- BEGIN LOGO -->
                     <div class="page-logo">
                        <a href="Yii::app()->createAbsoluteUrl('/')" class="logo"><?= APP_NAME ?></a>
                        <span></span>
                     </div>
                  </div>
                  <!-- END LOGO -->
                  <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                  <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                  <span></span>
                  </a>
                  <!-- END RESPONSIVE MENU TOGGLER -->
                  <!-- BEGIN TOP NAVIGATION MENU -->
                  <div class="top-menu">
                     <ul class="nav navbar-nav pull-right">
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                        <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                           <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                           <i class="icon-bell"></i>
                           <span class="badge badge-default"> 7 </span>
                           </a>
                           <ul class="dropdown-menu">
                              <li class="external">
                                 <h3>
                                    <span class="bold">12 pending</span> notifications
                                 </h3>
                                 <a href="page_user_profile_1.html">view all</a>
                              </li>
                              <li>
                                 <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">just now</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-success">
                                       <i class="fa fa-plus"></i>
                                       </span> New user registered. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">3 mins</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-danger">
                                       <i class="fa fa-bolt"></i>
                                       </span> Server #12 overloaded. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">10 mins</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-warning">
                                       <i class="fa fa-bell-o"></i>
                                       </span> Server #2 not responding. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">14 hrs</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-info">
                                       <i class="fa fa-bullhorn"></i>
                                       </span> Application error. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">2 days</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-danger">
                                       <i class="fa fa-bolt"></i>
                                       </span> Database overloaded 68%. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">3 days</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-danger">
                                       <i class="fa fa-bolt"></i>
                                       </span> A user IP blocked. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">4 days</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-warning">
                                       <i class="fa fa-bell-o"></i>
                                       </span> Storage Server #4 not responding dfdfdfd. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">5 days</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-info">
                                       <i class="fa fa-bullhorn"></i>
                                       </span> System Error. </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="time">9 days</span>
                                       <span class="details">
                                       <span class="label label-sm label-icon label-danger">
                                       <i class="fa fa-bolt"></i>
                                       </span> Storage server failed. </span>
                                       </a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                           <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                           <i class="icon-envelope-open"></i>
                           <span class="badge badge-default"> 4 </span>
                           </a>
                           <ul class="dropdown-menu">
                              <li class="external">
                                 <h3>You have
                                    <span class="bold">7 New</span> Messages
                                 </h3>
                                 <a href="app_inbox.html">view all</a>
                              </li>
                              <li>
                                 <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                       <a href="#">
                                       <span class="photo">
                                       <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                       <span class="subject">
                                       <span class="from"> Lisa Wong </span>
                                       <span class="time">Just Now </span>
                                       </span>
                                       <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="#">
                                       <span class="photo">
                                       <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                       <span class="subject">
                                       <span class="from"> Richard Doe </span>
                                       <span class="time">16 mins </span>
                                       </span>
                                       <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="#">
                                       <span class="photo">
                                       <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                       <span class="subject">
                                       <span class="from"> Bob Nilson </span>
                                       <span class="time">2 hrs </span>
                                       </span>
                                       <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="#">
                                       <span class="photo">
                                       <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                       <span class="subject">
                                       <span class="from"> Lisa Wong </span>
                                       <span class="time">40 mins </span>
                                       </span>
                                       <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="#">
                                       <span class="photo">
                                       <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                       <span class="subject">
                                       <span class="from"> Richard Doe </span>
                                       <span class="time">46 mins </span>
                                       </span>
                                       <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                       </a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                           <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                           <i class="icon-calendar"></i>
                           <span class="badge badge-default"> 3 </span>
                           </a>
                           <ul class="dropdown-menu extended tasks">
                              <li class="external">
                                 <h3>You have
                                    <span class="bold">12 pending</span> tasks
                                 </h3>
                                 <a href="app_todo.html">view all</a>
                              </li>
                              <li>
                                 <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">New release v1.2 </span>
                                       <span class="percent">30%</span>
                                       </span>
                                       <span class="progress">
                                       <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">40% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">Application deployment</span>
                                       <span class="percent">65%</span>
                                       </span>
                                       <span class="progress">
                                       <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">65% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">Mobile app release</span>
                                       <span class="percent">98%</span>
                                       </span>
                                       <span class="progress">
                                       <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">98% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">Database migration</span>
                                       <span class="percent">10%</span>
                                       </span>
                                       <span class="progress">
                                       <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">10% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">Web server upgrade</span>
                                       <span class="percent">58%</span>
                                       </span>
                                       <span class="progress">
                                       <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">58% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">Mobile development</span>
                                       <span class="percent">85%</span>
                                       </span>
                                       <span class="progress">
                                       <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">85% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                    <li>
                                       <a href="javascript:;">
                                       <span class="task">
                                       <span class="desc">New UI release</span>
                                       <span class="percent">38%</span>
                                       </span>
                                       <span class="progress progress-striped">
                                       <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                       <span class="sr-only">38% Complete</span>
                                       </span>
                                       </span>
                                       </a>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </li>
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                           <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                           <span class="username username-hide-on-mobile"> <?php
                                if(isset($_SESSION['RESPONSE']))
                                       echo "<span class='username'>".$_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name']."</span>";
                                else
                                      echo "<span class='username'>".$_SESSION['uname']."</span>";
                              
                           ?> </span>
                           <i class="fa fa-angle-down"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-default">
                              <li>
                                 <a href="<?=Yii::app()->createAbsoluteUrl('/Profile/ViewUpdate')?>">
                                 <i class="icon-user"></i>My Profile </a>
                              </li>
                              <li>
                                 <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/logout');?>">
                                 <i class="icon-key"></i> Log Out </a>
                              </li>
                           </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-quick-sidebar-toggler">
                           <a href="javascript:;" class="dropdown-toggle">
                           <i class="icon-logout"></i>
                           </a>
                        </li>
                        <!-- END QUICK SIDEBAR TOGGLER -->
                     </ul>
                  </div>
                  <!-- END TOP NAVIGATION MENU -->
               </div>
               <!-- END HEADER INNER -->
            </div>
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
               <div class="page-sidebar-wrapper">
                </div>

                  <div class="page-sidebar navbar-collapse collapse">
                     <!-- BEGIN SIDEBAR MENU -->
                     <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                     <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                     <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                     <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                     <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                     <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                     <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>
                        <li class="nav-item start active open">
                            <a href="<?=Yii::app()->createAbsoluteUrl('/admin');?>" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                       <li class="nav-item  ">
                           <a href="<?=$this->createUrl('/admin/adminTasks/viewAllApplicationsComments')?>" class="nav-link nav-toggle">
                               <i class="icon-diamond"></i>
                               <span class="title">Application Comments</span>
                           </a>
                        </li>
                         <li class="nav-item  ">
                           <a href="<?=$this->createUrl('/admin/adminTasks/viewAllUsers')?>" class="nav-link nav-toggle">
                               <i class="icon-puzzle"></i>
                               <span class="title">Users</span>
                           </a>
                        </li>
                         <li class="nav-item  ">
                           <a href="<?=$this->createUrl('/mis/boApplicationSubmission/growth')?>" class="nav-link nav-toggle">
                               <i class="icon-settings"></i>
                               <span class="title">Integrated Department</span>
                           </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-bulb"></i>
                                <span class="title">NIC Code</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/NICCodeReport')?>" class="nav-link ">
                                        <span class="title">Manufacturing-2 Digit</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/NICCodeServiceReport')?>" class="nav-link ">
                                        <span class="title">Service-2 Digit</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-briefcase"></i>
                                <span class="title">CAF</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/overallreport')?>" class="nav-link ">
                                        <span class="title">Overall CAF</span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/pendency-report')?>" class="nav-link ">
                                        <span class="title">Pending CAF</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                   <a href="<?=$this->createUrl('/admin/adminTasks/getDistrictApplications')?>" class="nav-link nav-toggle">
                                       <span class="title">District Wise</span>
                                   </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Land Detail</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/landDetailReport')?>" class="nav-link ">
                                        <span class="title">Land Detail No</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/landDetailReportYes')?>" class="nav-link ">
                                        <span class="title">Land Detail Yes</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                <span class="title">Category Wise</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/landDetailReport')?>" class="nav-link ">
                                        <span class="title">Established Industries</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="<?=$this->createUrl('/mis/boApplicationSubmission/landDetailReportYes')?>" class="nav-link ">
                                        <span class="title">Investment</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-paper-plane"></i>
                                <span class="title">Industries</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Established Industries</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Project Type</span>
                                    </a>
                                </li>
                                 <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Nature Of Orgranisation
                                        </span>
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="#" class="nav-link ">
                                        <span class="title">Type of Industry</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                     </ul>
                     <!-- END SIDEBAR MENU -->
                     <!-- END SIDEBAR MENU -->
                  </div>
                  <div class="page-content-wrapper">