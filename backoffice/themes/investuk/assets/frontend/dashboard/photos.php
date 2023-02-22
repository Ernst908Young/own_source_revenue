<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title></title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="css/plugins/jquery-ui/jquery-ui.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">

	<!-- BEGIN:File Upload Plugin CSS files-->
	<link rel="stylesheet" href="assets/jquery-file-upload/css/jquery.fileupload-ui.css">
	<noscript>
		<link rel="stylesheet" href="assets/jquery-file-upload/css/jquery.fileupload-ui-noscript.css">
	</noscript>
	<!-- END:File Upload Plugin CSS files-->	
	
	<link rel="stylesheet" href="css/account.css">
	<link rel="stylesheet" href="css/component.css">
	<link rel="stylesheet" href="css/circle.css">
	<link rel="stylesheet" href="css/vivahsuabhagya.css">
	<link rel="stylesheet" href="css/responsive.css">
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="js/plugins/jquery-ui/jquery-ui.js"></script>
	<!-- slimScroll -->
	<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Bootbox -->
	<script src="js/plugins/form/jquery.form.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>

	<!-- Theme framework -->
	<script src="js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	
	<!-- BEGIN:File Upload Plugin JS files-->
	<script src="assets/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script src="assets/jquery-file-upload/js/vendor/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="assets/jquery-file-upload/js/vendor/load-image.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script src="assets/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="assets/jquery-file-upload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="assets/jquery-file-upload/js/jquery.fileupload.js"></script>
	<!-- The File Upload file processing plugin -->
	<script src="assets/jquery-file-upload/js/jquery.fileupload-fp.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="assets/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<script src="assets/jquery-file-upload/js/main.js"></script>
	
	<!-- Favicon -->
	<link rel="shortcut icon" href="../images/vsfavicon1.png" />

</head>

<body data-layout-topbar="fixed">
<div id="wrapper">
	<div id="navigation">
		<div class="container">
			<a href="#" id="brand">&nbsp;</a>
			<!--<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
				<i class="fa fa-bars"></i>
			</a>-->
			<ul class='main-nav'>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Profile</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Help Desk</a>
						</li>
						<li>
							<a href="#">My Request</a>
						</li>
						<li>
							<a href="#">Validation</a>
						</li>
						<li>
							<a href="#">Wizard</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#"><span>Matches <span class="label label-lightred">4</span></span></a>
				</li>
				<li>
					<a href="#"><span>Search </span></a>
				</li>
				<li>
					<a href="#"><span>Inbox <span class="label label-lightred">4</span></span></a>
				</li>
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
						<span>Help</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Help Desk</a>
						</li>
						<li>
							<a href="#">My Request</a>
						</li>
						<li>
							<a href="#">Validation</a>
						</li>
						<li>
							<a href="#">Wizard</a>
						</li>
					</ul>
				</li>
			</ul>
			<div class="user">
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown">Hi! Username
					<img src="img/demo/user-avatar.jpg" class="user-img img-circle" alt="">
					</a>
					<ul class="dropdown-menu user-d pull-right">
							<li>
								<div class="user-d-no-ph">
                                    <div class="user-d-no-ph-title"><span class="glyphicon glyphicon-info-sign"></span>Photo Upload Pending</div>
                                    <div class="pup_btn_wrap">
										<form name="" id="" method="post">
												<input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
												<label for="file-1"><svg width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Upload Photo</span></label>											
										</form>
									</div>
									<div class="small">You can keep your Photos private.</div>
								</div>
							</li>
							<li>
								<div class="navbar-profile pro-drop">
									<div class="row">
										<div class="col-lg-6">
											<ul>
												<li><a href="#"><i class="fa fa-female" aria-hidden="true"></i>My Profile</a></li>
												<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i>Account Settings</a></li>
											</ul>
										</div>
										<div class="col-lg-6">
											<ul>
												<li><a href="#"><i class="fa fa-filter" aria-hidden="true"></i>Contact Filters</a></li>
												<li><a href="#"><i class="fa fa-lock" aria-hidden="true"></i>Privacy Option</a></li>
											</ul>
										</div>
									</div>
									<div class="logout">
										<a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a>
									</div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="navbar-profile navbar-profile-session">
									<div class="row">
										<div class="col-lg-12">
											<p>
												<span>Account Type:Free</span><br>
												<button class="btn btn-satgreen" type="button">Upgrade Now</button>											</p>
										</div>
									</div>
								</div>
							</li>
						</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container" id="content">
		<!-- Sidebar -->
        <div class="navbar-fixed-top" id="sidebar-wrapper" role="navigation">
			<div class="tab-content">
				<div id="ft-chat" class="tab-pane fade in active">
					<div class="bg-white shadow panel">
						<div class="panel-heading">
							<div class="panel-control">
								<div class="btn-group chat-side"> 											
									<button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false"> Status <span class="caret"></span> </button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#">Available</a></li>
										<li><a href="#">Busy</a></li><li><a href="#">Away</a></li>
										<li class="divider"></li>
										<li><a id="demo-connect-chat" href="#" class="disabled-link" data-target="#demo-chat-body">Connect</a></li>
										<li><a id="demo-disconnect-chat" href="#" data-target="#demo-chat-body">Disconect</a></li>
									</ul>
									<button data-widget="remove" id="dev_removeClass1" class="chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
								</div>
							</div>
							<h3 class="panel-title">Chat</h3>
						</div>
						<div id="demo-chat-body" class="collapse in" aria-expanded="true">
							<div class="v-chat has-scrollbar" style="height:500px;">
								<div class="v-chat-content" tabindex="0" style="right:-10px;">
									<ul class="user-list">
										<li class="pop active bounceInDown">
											<a data-placement="left" data-toggle="popover" data-container="body" type="button" data-html="true" href="#" class="addClass clearfix">
												<img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Amit Sharma</strong></div>
												<div class="last-message text-muted small">Hello, Are you there?</div> 
												<small class="time text-muted">Just now</small> 
												<small class="chat-alert label label-success">1</small> 
											</a>
											<div id="popover-content" class="hide">
											  <div class="media">
													<a class="pull-left" href="#">
														<img class="media-object dp" src="../images/account/user/user_2.jpg" style="width: 100px;height:100px;">
													</a>
													<div class="media-body">
														<h4><span class="blue">Amit Sharma</span> <small>(VS000236)</small></h4>
														<h4 class="media-heading">23 Year / 4-0" Inch <br>Hindu <br>English <br> Lucknow, India<br>M.com</h4>																												
													</div>
												</div>
											</div>
										</li>
										<li> 
											<a data-placement="left" data-toggle="popover" data-container="body" type="button" data-html="true" href="#" class="addClass clearfix"> 
												<img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Deepak Mishra</strong></div>
												<div class="last-message text-muted small">Lorem ipsum dolor sit amet.</div> 
												<small class="time text-muted">5 mins ago</small> 
												<small class="chat-alert text-muted"><i class="fa fa-check"></i></small> 
											</a>
											<div id="popover-content" class="hide">
											  <div class="media">
													<a class="pull-left" href="#">
														<img class="media-object dp" src="../images/account/user/user_2.jpg" style="width: 100px;height:100px;">
													</a>
													<div class="media-body">
														<h4><span class="blue">Deepak Mishra</span> <small>(VS000236)</small></h4>
														<h4 class="media-heading">23 Year / 4-0" Inch <br>Hindu <br>English <br> Lucknow, India<br>M.com</h4>																												
													</div>
												</div>
											</div>
										</li>
										<li> 
											<a data-placement="left" data-toggle="popover" data-container="body" type="button" data-html="true" href="#" class="clearfix"> 
												<img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Rohit Rana</strong></div>
												<div class="last-message text-muted small">Lorem ipsum dolor sit amet.</div> 
												<small class="time text-muted">Yesterday</small> 
												<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small> 
											</a>
											<div id="popover-content" class="hide">
											  <div class="media">
													<a class="pull-left" href="#">
														<img class="media-object dp" src="../images/account/user/user_2.jpg" style="width: 100px;height:100px;">
													</a>
													<div class="media-body">
														<h4><span class="blue">Rohit Rana</span> <small>(VS000236)</small></h4>
														<h4 class="media-heading">23 Year / 4-0" Inch <br>Hindu <br>English <br> Lucknow, India<br>M.com</h4>																												
													</div>
												</div>
											</div>
										</li>
										<li> 
											<a href="#" class="clearfix"> 
												<img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Rohit Rana</strong></div>
												<div class="last-message text-muted small">Lorem ipsum dolor sit amet.</div> 
												<small class="time text-muted">Yesterday</small> 
												<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small> 
											</a>
										</li>
										<li> 
											<a href="#" class="clearfix"> 
												<img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Amitesh</strong></div>
												<div class="last-message text-muted small">Lorem ipsum dolor sit amet.</div> 
												<small class="time text-muted">Yesterday</small> 
												<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small> 
											</a>
										</li>
										<li>
											<a href="#" class="clearfix"> 
												<img src="../images/account/user/user_6.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Aryan</strong></div>
												<div class="last-message text-muted small">Lorem ipsum dolor sit amet.</div> 
												<small class="time text-muted">Yesterday</small> 
												<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small> 
											</a>
										</li>
										<li> 
											<a href="#" class="clearfix"> 
												<img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
												<div class="user-name"> <strong>Piyush</strong></div>
												<div class="last-message text-muted small">Lorem ipsum dolor sit amet.</div> 
												<small class="time text-muted">Yesterday</small> 
												<small class="chat-alert text-muted"><i class="fa fa-reply"></i></small> 
											</a>
										</li>
									</ul>
								</div>
								<div class="v-chat-pane">
									<div class="v-chat-slider"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="ft-online" class="tab-pane fade">
					<div class="bg-white shadow panel">
						<div class="panel-heading">
							<div class="panel-control">
								<div class="btn-group chat-side"> 											
									<button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false"> Status <span class="caret"></span> </button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#">Available</a></li>
										<li><a href="#">Busy</a></li><li><a href="#">Away</a></li>
										<li class="divider"></li>
										<li><a id="demo-connect-chat" href="#" class="disabled-link" data-target="#demo-chat-body">Connect</a></li>
										<li><a id="demo-disconnect-chat" href="#" data-target="#demo-chat-body">Disconect</a></li>
									</ul>
									<button data-widget="remove" id="dev_removeClass2" class="dev_removeClass1 chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
								</div>
							</div>
							<h3 class="panel-title">Online</h3>
						</div>
						<div id="demo-chat-body" class="collapse in" aria-expanded="true">
							<div class="v-chat has-scrollbar" style="height:500px;">
								<div class="v-chat-content" tabindex="0" style="right:-10px;">
									<ul class="user-list">
										<li class="active bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Rahul Pratap</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Abhishek Sharma</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Navneet Kishore</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Ram Kumar</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Pradeep Maithani</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Deepak Saini</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Deepak Saini</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_6.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Deepak Saini</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
												<div class="user-name on-lh"> <strong>Deepak Saini</strong><i class="fa fa-circle green on-lh pull-right" aria-hidden="true"></i></div>
											</a>
										</li>
									</ul>
								</div>
								<div class="v-chat-pane">
									<div class="v-chat-slider"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div id="ft-alerts" class="tab-pane fade">
					<div class="bg-white shadow panel">
						<div class="panel-heading">
							<div class="panel-control">
								<div class="btn-group chat-side"> 											
									<button type="button" class="btn btn-white dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false"> Status <span class="caret"></span> </button>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="#">Available</a></li>
										<li><a href="#">Busy</a></li><li><a href="#">Away</a></li>
										<li class="divider"></li>
										<li><a id="demo-connect-chat" href="#" class="disabled-link" data-target="#demo-chat-body">Connect</a></li>
										<li><a id="demo-disconnect-chat" href="#" data-target="#demo-chat-body">Disconect</a></li>
									</ul>
									<button data-widget="remove" id="dev_removeClass3" class="dev_removeClass1 chat-header-button pull-right" type="button"><i class="glyphicon glyphicon-off"></i></button>
								</div>
							</div>
							<h3 class="panel-title">Alerts</h3>
						</div>
						<div id="demo-chat-body" class="collapse in" aria-expanded="true">
							<div class="v-chat has-scrollbar" style="height:500px;">
								<div class="v-chat-content" tabindex="0" style="right:-10px;">
									<ul class="user-list">
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_6.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_6.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
										<li class="bounceInDown">
											<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
												<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
											</a>
										</li>
									</ul>
								</div>
								<div class="v-chat-pane">
									<div class="v-chat-slider"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!-- /#sidebar-wrapper -->
		
		<div class="footer-tab hidden-xs">
			<ul class="nav nav-tabs">
				<li class="tab-pane" id="dev_tab1"><a data-toggle="tab" href="#ft-online" class="dev_class1"><i class="fa fa-comment" aria-hidden="true"></i>Chat</a></li>
				<li class="tab-pane" id="dev_tab2"><a data-toggle="tab" href="#ft-online" class="dev_class2"><i class="fa fa-circle" aria-hidden="true"></i>Online</a></li>
				<li class="tab-pane" id="dev_tab3"><a data-toggle="tab" href="#ft-alerts" class="dev_class3"><i class="fa fa-bell" aria-hidden="true"></i>Alerts</a></li>
			</ul>
		</div>
		
		<div id="main">
			<div class="row-fluid">
				<div class="col-md-3 col-sm-3 hidden-xs page-header">
					<div class="card hovercard" style="text-align:left;">
						<div class="inner">
							<div class="nav-side-menu">
								<div class="brand">Profile</div>
								<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
								<div class="menu-list">
									<ul id="menu-content" class="menu-content collapse out">
										<li>
										  <a href="#">
										  <i class="fa fa-dashboard fa-lg"></i> Dashboard
										  </a>
										</li>
										
										<li class="active">
										  <a href="#">
										  <i class="fa fa-user fa-lg"></i> My Profile
										  </a>
										</li>
										
										<li>
										  <a href="#">
										  <i class="fa fa-camera fa-lg"></i> Photos
										  </a>
										</li>
										
										<li>
										  <a href="#">
										  <i class="fa fa-heart fa-lg"></i> My Partner Preferences
										  </a>
										</li>

										<li  data-toggle="collapse" data-target="#products" class="collapsed ">
										  <a href="#"><i class="fa fa-gift fa-lg"></i> More <span class="arrow"></span></a>
										</li>
										<ul class="sub-menu collapse" id="products">
											<li class="active"><a href="#">CSS3 Animation</a></li>
											<li><a href="#">General</a></li>
										</ul>
									</ul>
								</div>
							</div>
						</div>
					<div class="h-status"></div>
					</div>
					
					<div class="card hovercard" style="text-align:left;">
						<div class="inner">
							<h4 style="margin:22px;">Recent Updates</h4>
							<ul class="user-list user-list-side">
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_6.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_1.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_2.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_3.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_6.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
									<li class="bounceInDown">
										<a href="#" class="clearfix"><img src="../images/account/user/user_5.jpg" alt="" class="img-circle">
											<div class="alert-message text-muted small">Lorem ipsum dolor sit amet.</div> 
										</a>
									</li>
								</ul>
							<a class="btn btn-default btn-sm" href="#" style="margin:22px;">
								View All
							</a>
						</div>
					<div class="h-status"></div>
					</div>
					
					<div class="card hovercard" style="text-align:left;">
						<div class="inner" style="padding:15px; line-height: 20px;">
							<h4 style="margin:0px;">Manage Filters</h4>
							<small>You may choose to receive interests only from people who match your preferences. Setting filters restricts unwanted interests in your inbox. However, you may access them through your filtered folder</small>
							<div class="clear">&nbsp;</div>
							<a class="btn btn-default btn-sm" href="#">
								Set my Filters
							</a>
						</div>
					<div class="h-status"></div>
					</div>
					
					<div class="card hovercard" style="text-align:left;">
						<div class="inner" style="padding:15px; line-height: 20px;">
							<h4 style="margin:0px;">Privacy</h4>
							<small>Control who all can view your profile, photo or contact information. Your details are visible to all by default (recommended)</small>
							<div class="clear">&nbsp;</div>
							<a class="btn btn-default btn-sm" href="#">
								Go to Privacy Settings
							</a>
						</div>
					<div class="h-status"></div>
					</div>
				</div>
			
				<div class="col-md-9 col-sm-9">
					<h3 class="page-header">My Photos</h3>
					<hr>
					<div class="col-md-8 col-centered" align="center">
						<h3>Get more responses by uploading up to 20 photos on your profile.</h3>
					</div>
					<div class="clearfix">&nbsp;</div>
					<div class="row-fluid">
						<form id="fileupload" action="//jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
						<div class="col-sm-12 user-menu-container square" style="margin-bottom:20px;">
							<div class="user-details">
								<div class="row">
									<div class="col-md-3 col-sm-5 no-pad">
										<div class="user-image">
											<img src="img/user/bride/1.jpg" class="img-responsive thumbnail">
											<!-- use this when photo uploaded successfully-->
											<a href="#" class="chng_pic" data-toggle="modal" data-target="#upld_pho"><i class="fa fa-camera"></i> Change Photo</a>
										</div>
									</div>
									<div class="col-md-9 col-sm-7">
										<div class="s_res photo_upld">
											<h4>Upload your photos from</h4>
												<div class="row">
													<div class="col-sm-6">
														<!-- Redirect browsers with JavaScript disabled to the origin page -->
														<noscript><input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"></noscript>
														<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
														<div class="row-fluid fileupload-buttonbar">
															<!-- The fileinput-button span is used to style the file input field as button -->
															<a class="btn pink fileinput-button">
															<i class="fa fa-desktop icon-white"></i>
															<span>My Computer</span>
															<input type="file" name="files[]" multiple>
															</a>
														</div>
														<!-- The loading indicator is shown during file processing -->
														<div class="fileupload-loading"></div>
													</div>
													<div class="col-sm-6">
														<a class="btn btn-block btn-social btn-facebook">
															<span class="fa fa-facebook"></span> Facebook
														</a>
													</div>
												</div>
												<p>Strong Photo Privacy Options | No downloads allowed | Photos are Watermarked Jpeg, Jpg | Upto 6MB | 20 photos only</p>
										</div>
									</div>
								</div>
								
							</div>
						</div>
						<!-- The table listing the files available for upload/download -->
							
							<table role="presentation" class="table table-striped">
								<tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody>
							</table>
						</form>
					</div>
					
				
				<div class="row-fluid">
					<div class="col-sm-12">
						<script id="template-upload" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
							    <tr class="template-upload fade">
							        <td class="preview"><span class="fade"></span></td>
							        <td class="name"><span>{%=file.name%}</span></td>
							        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
							        {% if (file.error) { %}
							            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
							        {% } else if (o.files.valid && !i) { %}
							            <td>
							                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
							            </td>
							            <td class="start">{% if (!o.options.autoUpload) { %}
							                <button class="btn btn-success">
							                    <i class="fa fa-upload icon-white"></i>
							                    <span>Upload</span>
							                </button>
							            {% } %}</td>
							        {% } else { %}
							            <td colspan="2"></td>
							        {% } %}
							        <td class="cancel">{% if (!i) { %}
							            <button class="btn btn-danger">
							                <i class="fa fa-ban icon-white"></i>
							                <span>Cancel</span>
							            </button>
							        {% } %}</td>
							    </tr>
							{% } %}
						</script>
						<!-- The template to display files available for download -->
						<script id="template-download" type="text/x-tmpl">
							{% for (var i=0, file; file=o.files[i]; i++) { %}
							    <tr class="template-download fade">
							        {% if (file.error) { %}
							            <td></td>
							            <td class="name"><span>{%=file.name%}</span></td>
							            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
							            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
							        {% } else { %}
							            <td class="preview col-md-3">
							            {% if (file.thumbnail_url) { %}
							                <a class="fancybox-button" data-rel="fancybox-button" href="{%=file.url%}" title="{%=file.name%}">
							                	<img src="{%=file.thumbnail_url%}">
							                </a>
							            {% } %}</td>
							            <td class="name">
							                <a href="{%=file.url%}" title="{%=file.name%}" data-gallery="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
							            </td>
							            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
							            <td colspan="2"></td>
							        {% } %}
							        <td class="delete">
							            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.delete_with_credentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							                <i class="fa fa-trash icon-white"></i>
							                <span>Delete</span>
							            </button>
							            <input type="checkbox" class="fileupload-checkbox hide" name="delete" value="1">
							        </td>
							    </tr>
							{% } %}
						</script>
					</div>
				</div>
					
					<div class="row">
						<div class="col-sm-12">
							<div class="box">
								<div class="box-title pro-title">
									<h3>
									<i class="fa fa-remove"></i>What to avoid when you upload photos</h3>
								</div>
							</div>
							<div class="photo_no well">
								<h4>Do not upload photos that look like any of these</h4>
								<ul>
									<li> 
										<img src="../images/account/blur_img/33.png" class="img-responsive img-circle">
										<p class="icons"><i class="fa fa-remove"></i> Blur photos</p>
									</li>
									<li> 
										<img src="../images/account/blur_img/22.png" class="img-responsive img-circle">
										<p class="icons"><i class="fa fa-remove"></i> Side face</p>
									</li>
									<li> 
										<img src="../images/account/blur_img/44.png" class="img-responsive img-circle">
										<p class="icons"><i class="fa fa-remove"></i> Group photo</p>
									</li>
									<li> 
										<img src="../images/account/blur_img/55.png" class="img-responsive img-circle">
										<p class="icons"><i class="fa fa-remove"></i> Water-mark</p>
									</li>
								</ul>
							</div>
						</div>
						
						<div class="clearfix"></div>						
						<div class="col-sm-12">
							<div class="alert alert-info alert-dismissable" align="center">
								<h4>Other ways to upload you photos</h4>
								<p>Email your photos to <a href="mailto:photos@vivahsaubhagyabhagya.com">photos@vivahsaubhagya.com</a>. Mention your <b>Profile ID</b> and <b>Name</b> in the email</p>
								<p>Send your photos through post to our office. Mention your <b>Profile ID</b> and <b>Name</b> at the back of the photos.</p>
							</div>
						</div>
					</div>
				
					
				</div>
			</div>
		</div>
	</div>
	<div class="row p-b">
			<!-- DIRECT CHAT PRIMARY -->
			<div class="popup-box box chat-window box-primary direct-chat direct-chat-primary" id="qnimate">
				<div class="box-header with-border">
				  <h3 class="box-title">Direct Chat</h3>
			
				  <div class="box-tools pull-right">
					<span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="3 New Messages">3</span>
					<a href="#"><span id="minim_chat_window" class="glyphicon glyphicon-minus icon_minim"></span></a>
					<button type="button" class="removeClass btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
				  </div>
				</div>
				<!-- /.box-header -->
				<div class="box-body">					
				  <!-- Conversations are loaded here -->
					<div class="direct-chat-messages">
						 <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object dp img-circle" src="../images/account/user/user_2.jpg" style="width: 100px;height:100px;">
            </a>
            <div class="media-body">
                <h4 class="media-heading">23 Year / 4-0" Inch <small> Hindu,<br> Lucknow, India</small></h4>
                <h5>Software Developer at <a href="#">xyz.in</a></h5>
                
            </div>
			<div>&nbsp;</div>
			<button class="btn btn-mini btn-satgreen btn--icon">
			Upgrade membership to start chatting</button>
			<hr style="margin:8px auto">
        </div>
						<!-- Message. Default to the left -->
						<div class="direct-chat-msg">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-left">Alexander Pierce</span>
								<span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
							</div>
							<!-- /.direct-chat-info -->
							<img class="direct-chat-img" src="http://bootdey.com/img/Content/user_1.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
							<div class="direct-chat-text">
								Is this really for free? That's unbelievable!
							</div>
							<!-- /.direct-chat-text -->
						</div>
						<!-- /.direct-chat-msg -->
			
						<!-- Message to the right -->
						<div class="direct-chat-msg right">
							<div class="direct-chat-info clearfix">
								<span class="direct-chat-name pull-right">Sarah Bullock</span>
								<span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
							</div>
							<!-- /.direct-chat-info -->
							<img class="direct-chat-img" src="http://bootdey.com/img/Content/user_2.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
							<div class="direct-chat-text">
								You better believe it!
							</div>
							<!-- /.direct-chat-text -->
						</div>
						<!-- /.direct-chat-msg -->
					</div>
					<!--/.direct-chat-messages-->
			
					<!-- Contacts are loaded here -->
					<div class="direct-chat-contacts">
						<ul class="contacts-list">
							<li>
								<a href="#">
								  <img class="contacts-list-img" src="http://bootdey.com/img/Content/user_1.jpg">
					
								  <div class="contacts-list-info">
										<span class="contacts-list-name">
										  Count Dracula
										  <small class="contacts-list-date pull-right">2/28/2015</small>
										</span>
									<span class="contacts-list-msg">How have you been? I was...</span>
								  </div>
								  <!-- /.contacts-list-info -->
								</a>
							</li>
						  <!-- End Contact Item -->
						</ul>
						<!-- /.contatcts-list -->
					</div>
				  <!-- /.direct-chat-pane -->
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<div class="input-group">
						<input id="btn-input" type="text" class="form-control input-sm chat_input" placeholder="Write your message here..." />
						<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" id="btn-chat">Send</button>
						</span>
					</div>
				</div>
				<!-- /.box-footer-->
			</div>
			<!--/.direct-chat -->
		</div>
		
	
	<div class="vivah-footer-style-3">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6 vivah-footer-widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
						<div class="vivah-logo"><span class="logo"><img src="../images/vsfavicon1.png"></span> Vivah Saubhagya</div>
						<p class="vivah-copyright">&copy; 2016 Vivah Saubhagya. <br>All Rights Reserved.</p>
					</div>
					<div class="col-md-3 col-sm-6 vivah-footer-widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s">
						<h3>Help & Support</h3>
						<ul class="vivah-links">
							<li><a href="#">Contact Us</a></li>
							<li><a href="#">Faq's</a></li>
							<li><a href="#">Security Tips</a></li>
						</ul>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-3 col-sm-6 vivah-footer-widget wow fadeInUp" data-wow-duration="1s" data-wow-delay=".8s">
						<h3>Other Links</h3>
						<ul class="vivah-links">
							<li><a href="#">Services</a></li>
							<li><a href="#">Hasthrekha</a></li>
							<li><a href="#">Horoscope</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 vivah-footer-widget wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.1s">
						<h3>Connect</h3>
						<ul class="vivah-links vivah-social">
							<li><a href="#"><i class="icon icon-facebook2"></i> Facebook</a></li>
							<li><a href="#"><i class="icon icon-twitter"></i> Twitter</a></li>
							<li><a href="#"><i class="icon icon-instagram"></i> Instagram</a></li>
						</ul>
					</div>
				
					<div class="clearfix visible-sm-block"></div>
				</div>
				<div class="row vivah-made">
					<div class="col-md-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay=".5s">
						<p>You can send Photograph & Biodata on <i class="heart icon-phone"></i> +91-9044331849 </p>
					</div>
				</div>
			</div>
	</div>
		<!-- END footer -->
		
	<!------START: POPOP------->	
		<!-- start:Photo update -->
		<div class="modal fade" id="upld_pho" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-dismiss="modal" data-toggle="modal">
			<div class="modal-dialog">
				<div class="modal-header">
					<button type="button" class="close-link close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="glyphicon glyphicon-remove-circle"></span></span></button>
					<h4 class="modal-title" id="myModalLabel">Upload Photos</h4>
				</div>
				<div class="modal-content pro-edit-popup" style="min-height:auto;">
					<div class="s_res photo_upld">
						<h5>Strong Photo Privacy Options | No downloads allowed | Photos are Watermarked Jpeg, Jpg | Upto 6MB | 20 photos only</h5>
						<div class="row" style="padding:20px;">
							<div class="col-sm-6">
								<!-- Redirect browsers with JavaScript disabled to the origin page -->
								<noscript>&lt;input type="hidden" name="redirect" value="http://blueimp.github.com/jQuery-File-Upload/"&gt;</noscript>
								<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
								<div class="row-fluid fileupload-buttonbar">
									<!-- The fileinput-button span is used to style the file input field as button -->
									<a class="btn pink fileinput-button">
									<i class="fa fa-desktop icon-white"></i>
									<span>My Computer</span>
									<input type="file" name="files[]" multiple="">
									</a>
								</div>
								<!-- The loading indicator is shown during file processing -->
								<div class="fileupload-loading"></div>
							</div>
							<div class="col-sm-6">
								<a class="btn btn-block btn-social btn-facebook">
									<span class="fa fa-facebook"></span> Facebook
								</a>
							</div>
						</div>
					</div>
					
				</form>	
			</div>
		</div>
	   <!-- end: Photo update -->
	
	
	<!------END: POPOP------->
	<script src="<?php echo Configure::read('SITEPATH');?>/frontend/dashboard/js/plugins/colorbox/jquery.colorbox-min.js"></script>
   
<script>
  $(function(){
	$(".addClass").click(function () {
    $('#qnimate').addClass('popup-box-on');
    });
          
    $(".removeClass").click(function () {
    $('#qnimate').removeClass('popup-box-on');
    });
	
	//
$(document).on('click', '.box-header span.icon_minim', function (e) {
    var $this = $(this);
    if (!$this.hasClass('popup-box-collapsed')) {
        $this.parents('.popup-box').find('.box-body').slideUp();
        $this.addClass('popup-box-collapsed');
        $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
    } else {
        $this.parents('.popup-box').find('.box-body').slideDown();
        $this.removeClass('popup-box-collapsed');
        $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});
$(document).on('focus', '.box-footer input.chat_input', function (e) {
    var $this = $(this);
    if ($('#minim_chat_window').hasClass('popup-box-collapsed')) {
        $this.parents('.popup-box').find('.box-body').slideDown();
        $('#minim_chat_window').removeClass('popup-box-collapsed');
        $('#minim_chat_window').removeClass('glyphicon-plus').addClass('glyphicon-minus');
    }
});


///POPOVER		
	$("[data-toggle=popover]").popover({
  	trigger: 'manual',
  	animate: false,
  	html: true,
  	placement: 'left',
  	//template: '<div class="popover" onmouseover="$(this).mouseleave(function() {$(this).hide(); });"><div class="arrow"></div><div class="popover-inner"><h3 class="popover-title"></h3><div class="popover-content"><p></p></div></div></div>'
	content: function() {
          return $(this).next('#popover-content').html();
        }
	})
	.on("click", function(e) {
	e.preventDefault();
	})
	.on("mouseenter", function() {
	var _this = this;
	$(this).popover("show");
	$(this).siblings(".popover").on("mouseleave", function() {
    $(_this).popover('hide');
	});
	})
	.on("mouseleave", function() {
	var _this = this;
	setTimeout(function() {
    if (!$(".popover:hover").length) {
      $(_this).popover("hide")
    }
  }, 100);
});
	
	
	$(document).on('show.bs.popover', function() {
	  $('.popover').not(this).popover('hide');
	});
	
	
  })
</script>

<script>
//CHAT SIDEBAR SECTION 
	$(document).ready(function () {
  $('.dev_class1').click(function () {
		if(!$('#dev_tab1').hasClass('active') && !$('#dev_tab2').hasClass('active') && !$('#dev_tab3').hasClass('active')){
			$('#wrapper').toggleClass('toggled');
			$('#dev_tab1').addClass('active');
			//alert('nvnxv,xcnv');
		}
  }); 
$('.dev_class2').click(function () {

		if(!$('#dev_tab1').hasClass('active') && !$('#dev_tab2').hasClass('active') && !$('#dev_tab3').hasClass('active')){
			$('#wrapper').toggleClass('toggled');
			$('#dev_tab1').addClass('active');
			//alert('nvnxv,xcnv');
		}
  }); 
$('.dev_class3').click(function () {
		if(!$('#dev_tab1').hasClass('active') && !$('#dev_tab2').hasClass('active') && !$('#dev_tab3').hasClass('active')){
			$('#wrapper').toggleClass('toggled');
			$('#dev_tab1').addClass('active');
			//alert('nvnxv,xcnv');
		}
  });   
});
$('#dev_removeClass1').click(function (){
	$('#wrapper').toggleClass('toggled');
	$('#dev_tab1').removeClass('active');
	$('#dev_tab2').removeClass('active');
	$('#dev_tab3').removeClass('active');
});
$('#dev_removeClass2').click(function (){
	$('#wrapper').toggleClass('toggled');
	$('#dev_tab1').removeClass('active');
	$('#dev_tab2').removeClass('active');
	$('#dev_tab3').removeClass('active');
});
$('#dev_removeClass3').click(function (){
	$('#wrapper').toggleClass('toggled');
	$('#dev_tab1').removeClass('active');
	$('#dev_tab2').removeClass('active');
	$('#dev_tab3').removeClass('active');
});

</script>
</div>
</body>
</html>
