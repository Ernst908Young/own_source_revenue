<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
        <title>Zii CMS :: Back Office</title>
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css" />
        <!--link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png" type="image/png" /-->
        <script>
            var FRONTEND_THEME_URL = "<?php echo FRONTEND_THEME_URL; ?>";
			var BACKENT_THEME_URL = '<?php echo BACKENT_THEME_URL; ?>';
        </script>
        <?php
        $route = Yii::app()->controller->getRoute();
        ?>
        <?php 
        $cpage = $this->action->id;
        if($cpage != 'admin' || $this->getUniqueId() == 'filemanager') { ?>        
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <?php } else { ?>
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <?php } ?>
        
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/spinner/ui.spinner.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/spinner/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/excanvas.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.flot.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.flot.orderBars.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.flot.pie.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.flot.resize.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/charts/jquery.sparkline.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/uniform.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.cleditor.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.validationEngine-en.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.validationEngine.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.tagsinput.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/autogrowtextarea.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.maskedinput.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.dualListBox.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/jquery.inputlimiter.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/forms/chosen.jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/wizard/jquery.form.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/wizard/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/wizard/jquery.form.wizard.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/plupload.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/plupload.html5.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/plupload.html4.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/uploader/jquery.plupload.queue.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/tables/datatable.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/tables/tablesort.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/tables/resizable.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.tipsy.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.collapsible.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.progress.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.timeentry.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.colorpicker.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.jgrowl.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.breadcrumbs.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/ui/jquery.sourcerer.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/calendar.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins/elfinder.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/customvalidation.js"></script>
        <!--<script type="text/javascript" src="<?php //echo Yii::app()->theme->baseUrl; ?>/js/init.js"></script>-->
    </head>
    <body>
        <!-- Left side content -->
        <div id="leftSide">
            <div class="logo"><a href="<?php echo Yii::app()->createUrl("/ziiadmin"); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png" alt="" /></a></div>
            <div class="sidebarSep mt0"></div>
            <!-- Left navigation -->
            <ul id="menu" class="nav">
                <li class="dash"><a href="<?php echo Yii::app()->createUrl("/ziiadmin"); ?>" title="" class="active"><span>Dashboard</span></a></li>
                <?php if(Utility::isSuperAdmin() === TRUE) { ?>
					 <li class="typo"><a href="#" title="" class="exp"><span>Access Log</span><strong>1</strong></a>
						<ul class="sub">
							<li><a href="<?php echo Yii::app()->createUrl('/ziiadmin/loginAccessLog/admin'); ?>" title="">View Login Access Log</a></li>
						</ul>
					</li>
                <?php } ?>
                <li class="password"><a href="#" title="" class="exp"><span>Change Password</span><strong>1</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl('/ziiadmin/changepassword'); ?>" title="Change Password">Change Password</a></li>
                    </ul>
                </li>
                
                <li class="files"><a href="#" title="" class="exp"><span>File Manager</span><strong>1</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl('/filemanager'); ?>" title="">File Manager</a></li>
                    </ul>
                </li>
				
                 <li class="files"><a href="#" title="" class="exp"><span>Gallery Manager</span><strong>1</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl('/filemanager'); ?>" title="">Upload</a></li>
                    </ul>
                </li>
                
				
                
                <li class="home2"><a href="#" title="" class="exp"><span>Manage Homepage</span><strong>6</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin//manageContact/admin"); ?>" title="">Manage Contact</a></li>
                         <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin//manageContact/create"); ?>" title="">Create Contact</a></li>
                         <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/manageMinisterBlock/admin"); ?>" title="">Manage Ministers</a></li> 
                         <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/manageServicesBlock/admin"); ?>" title="">Manage Services</a></li>                
                         <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/manageAccordion/admin"); ?>" title="">Manage Accordion</a></li>   
                         <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/manageImportantNotes/admin"); ?>" title="">Manage Imp Notes</a></li>                

                    </ul>
                </li>
                
				<li class="mail"><a href="#" title="" class="exp"><span>Manage SMTP</span><strong>1</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/smtp/admin"); ?>" title="">Manage SMTP</a></li>
                    </ul>
                </li>
                
               
                
                
                <li class="images"><a href="#" title="" class="exp"><span>Manage Slider Images</span><strong>2</strong></a>
                    <ul class="sub">
						<li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/manageHomepageSlider/create"); ?>" title="">Add Slider Image</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/manageHomepageSlider/admin"); ?>" title="">Manage Homepage Slider</a></li>                
                    </ul>
                </li>
                
               
                
                <li class="grid"><a href="#" title="" class="exp"><span>Manage Pages</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/page/create"); ?>" title="">Create Page</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/page/admin"); ?>" title="">Manage Pages</a></li>                
                    </ul>
                </li>
                
                <li class="category"><a href="#" title="" class="exp"><span>Manage Menus</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/pageCategoryRelation/create"); ?>" title="">Add New Menu</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/pageCategoryRelation/admin"); ?>" title="">Manage Menus</a></li>                
                    </ul>
                </li>

                <li class="modules"><a href="#" title="" class="exp"><span>Manage Categories</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/pagecategories/create"); ?>" title="">Create Category</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/pagecategories/admin"); ?>" title="">Manage Categories</a></li>                
                    </ul>
                </li>

               

                <li class="users"><a href="#" title="" class="exp"><span>Manage Users</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/user/create"); ?>" title="">Create User</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/user/admin"); ?>" title="">Manage Users</a></li>                
                    </ul>
                </li>

                <li class="roles"><a href="#" title="" class="exp"><span>Manage Roles</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/role/create"); ?>" title="">Create Role</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/role/admin"); ?>" title="">Manage Roles</a></li>                
                    </ul>
                </li>
                
                <li class="roles"><a href="#" title="" class="exp"><span>Map Pages With Roles</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/mappageswithroles/create"); ?>" title="">Map Page With Role</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/mappageswithroles/admin"); ?>" title="">Manage Page Mapping</a></li>                
                    </ul>
                </li>

               
                
				
				<li class="news"><a href="#" title="" class="exp"><span>Manage News</span><strong>2</strong></a>
                    <ul class="sub">
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/news/create"); ?>" title="">Add News</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/ziiadmin/news/admin"); ?>" title="">Manage News</a></li>                
                    </ul>
                </li>
				


            </ul>
        </div>


        <!-- Right side -->
        <div id="rightSide">
			
			
            <!-- Top fixed navigation -->
            <div class="topNav">
                <div class="wrapper">
                	<div class="welcome"><a href="#" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/userPic.png" alt="" /></a><span>Welcome <?php echo Yii::app()->user->name; ?> !</span></div>
                    <div class="userNav">
                        <ul>
                            <li><a href="<?php echo Yii::app()->createUrl('//home') ?>" target="_blank" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/topnav/profile.png" alt="" /><span>View Site</span></a></li>
                            <li><a href="<?php echo Yii::app()->createUrl('//site/logout'); ?>" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/topnav/logout.png" alt="" /><span>Logout</span></a></li>
                        </ul>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

            <!-- Responsive header -->
            <div class="resp">
                <div class="respHead">
                    <a href="index.html" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/loginLogo.png" alt="" /></a>
                </div>

                <div class="cLine"></div>
                <div class="smalldd">
                    <span class="goTo"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/home.png" alt="" />Dashboard</span>
                    <ul class="smallDropdown">
                        <li><a href="index.html" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/home.png" alt="" />Dashboard</a></li>
                        <li><a href="charts.html" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/stats.png" alt="" />Statistics and charts</a></li>
                        <li><a href="#" title="" class="exp"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/pencil.png" alt="" />Forms stuff<strong>4</strong></a>
                            <ul>
                                <li><a href="forms.html" title="">Form elements</a></li>
                                <li><a href="form_validation.html" title="">Validation</a></li>
                                <li><a href="form_editor.html" title="">WYSIWYG and file uploader</a></li>
                                <li class="last"><a href="form_wizards.html" title="">Wizards</a></li>
                            </ul>
                        </li>
                        <li><a href="ui_elements.html" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/users.png" alt="" />Interface elements</a></li>
                        <li><a href="tables.html" title="" class="exp"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/frames.png" alt="" />Tables<strong>3</strong></a>
                            <ul>
                                <li><a href="table_static.html" title="">Static tables</a></li>
                                <li><a href="table_dynamic.html" title="">Dynamic table</a></li>
                                <li class="last"><a href="table_sortable_resizable.html" title="">Sortable &amp; resizable tables</a></li>
                            </ul>
                        </li>
                        <li><a href="#" title="" class="exp"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/fullscreen.png" alt="" />Widgets and grid<strong>2</strong></a>
                            <ul>
                                <li><a href="widgets.html" title="">Widgets</a></li>
                                <li class="last"><a href="grid.html" title="">Grid</a></li>
                            </ul>
                        </li>
                        <li><a href="#" title="" class="exp"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/alert.png" alt="" />Error pages<strong>6</strong></a>
                            <ul class="sub">
                                <li><a href="403.html" title="">403 page</a></li>
                                <li><a href="404.html" title="">404 page</a></li>
                                <li><a href="405.html" title="">405 page</a></li>
                                <li><a href="500.html" title="">500 page</a></li>
                                <li><a href="503.html" title="">503 page</a></li>
                                <li class="last"><a href="offline.html" title="">Website is offline</a></li>
                            </ul>
                        </li>
                        <li><a href="file_manager.html" title=""><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/files.png" alt="" />File manager</a></li>
                        <li><a href="#" title="" class="exp"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/icons/light/create.png" alt="" />Other pages<strong>3</strong></a>
                            <ul>
                                <li><a href="typography.html" title="">Typography</a></li>
                                <li><a href="calendar.html" title="">Calendar</a></li>
                                <li class="last"><a href="gallery.html" title="">Gallery</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="cLine"></div>
            </div>

	        	
            <!-- Title area -->
            <div class="titleArea">
                <div class="wrapper">
                    <div class="pageTitle">
                        <h5>Dashboard</h5>
                        <br />
                        <span><strong>Uttarakhand :: Single Window Clearance System</strong>.</span>
                    </div>           
                    <div class="clear"></div>
                </div>
            </div>

            <!-- Main content wrapper -->
            <div class="wrapper">
                <!-- Note -->
                <div class="nNote nInformation hideit">
                    <p><strong>INFORMATION: </strong>beta Version of the Dashboard</a></p>
                </div>

                <br />
                <?php echo $content; ?>
                <br />
            </div>
            
            <!-- Footer line -->
            <div id="footer">
                <div class="wrapper">Copyright &copy; 2015</div>
            </div>

        </div>

        <div class="clear"></div>
        
        <?php if($cpage != 'admin' || $this->getUniqueId() == 'filemanager') { ?> 
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/_custom.js"></script>
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/charts/chart.js"></script>
        <?php } else { ?>
            <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/init.js"></script>
        <?php } ?>
       
    </body>
</html>
