	<link rel="stylesheet" type="text/css" href="css/cloud-admin.css" >
	<link rel="stylesheet" type="text/css"  href="css/themes/default.css" id="skin-switcher" >
	<link rel="stylesheet" type="text/css"  href="css/responsive.css" >
	<link rel="stylesheet" type="text/css"  href="js/jQueryFileUpload/css/jquery.fileupload.css" >
	<link href="js/validation/css/bootstrapValidator.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="js/jquerycombogrid/css/smoothness/jquery-ui-1.10.1.custom.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="js/jquerycombogrid/css/smoothness/jquery.ui.combogrid.css"/>
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- JQUERY UI-->
	<link rel="stylesheet" type="text/css" href="js/jquery-ui-1.10.3.custom/css/custom-theme/jquery-ui-1.10.3.custom.min.css" />
	<!-- ANIMATE -->
	<link rel="stylesheet" type="text/css" href="css/animatecss/animate.min.css" />
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- TODO -->
	<link rel="stylesheet" type="text/css" href="js/jquery-todo/css/styles.css" />
	<!-- FULL CALENDAR -->
	<link rel="stylesheet" type="text/css" href="js/fullcalendar/fullcalendar.min.css" />
	<!-- GRITTER -->
	<link rel="stylesheet" type="text/css" href="js/gritter/css/jquery.gritter.css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<!-- HEADER -->
	<header class="navbar clearfix" id="header">
		<div class="container">
				<div class="navbar-brand">
					<!-- COMPANY LOGO 
					<a href="index.php">
						<img src="img/logo/logo.png" alt="DutaRESTO" class="img-responsive" height="30" width="120">
					</a>
					 /COMPANY LOGO -->
					<!-- TEAM STATUS FOR MOBILE -->
					<div class="visible-xs">
						<a href="#" class="team-status-toggle switcher btn dropdown-toggle">
							<i class="fa fa-users"></i>
						</a>
					</div>
					<!-- /TEAM STATUS FOR MOBILE -->
					<!-- SIDEBAR COLLAPSE -->
					<div id="sidebar-collapse" class="sidebar-collapse btn">
						<i class="fa fa-bars" 
							data-icon1="fa fa-bars" 
							data-icon2="fa fa-bars" ></i>
					</div>
					<!-- /SIDEBAR COLLAPSE -->
				</div>
				<!-- NAVBAR LEFT -->
				<ul class="nav navbar-nav pull-left hidden-xs" id="navbar-left">
					<li class="dropdown">
						<a href="#" class="team-status-toggle dropdown-toggle tip-bottom" data-toggle="tooltip" title="Toggle Team View">
							<i class="fa fa-users"></i>
							<span class="name">Team Status</span>
							<i class="fa fa-angle-down"></i>
						</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-cog"></i>
							<span class="name">Skins</span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu skins">
							<li class="dropdown-title">
								<span><i class="fa fa-leaf"></i> Theme Skins</span>
							</li>
							<li><a href="#" data-skin="default">Subtle (default)</a></li>
							<li><a href="#" data-skin="night">Night</a></li>
							<li><a href="#" data-skin="earth">Earth</a></li>
							<li><a href="#" data-skin="utopia">Utopia</a></li>
							<li><a href="#" data-skin="nature">Nature</a></li>
							<li><a href="#" data-skin="graphite">Graphite</a></li>
						 </ul>
					</li>
				</ul>
				<!-- /NAVBAR LEFT -->
				<!-- BEGIN TOP NAVIGATION MENU -->					
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->	
					<li class="dropdown" id="header-notification">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-bell"></i>
							<span class="badge">7</span>						
						</a>
						<ul class="dropdown-menu notification">
							<li class="dropdown-title">
								<span><i class="fa fa-bell"></i> 7 Notifications</span>
							</li>
							<li>
								<a href="#">
									<span class="label label-success"><i class="fa fa-user"></i></span>
									<span class="body">
										<span class="message">5 users online. </span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>Just now</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-primary"><i class="fa fa-comment"></i></span>
									<span class="body">
										<span class="message">Martin commented.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>19 mins</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-warning"><i class="fa fa-lock"></i></span>
									<span class="body">
										<span class="message">DW1 server locked.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>32 mins</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-info"><i class="fa fa-twitter"></i></span>
									<span class="body">
										<span class="message">Twitter connected.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>55 mins</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-danger"><i class="fa fa-heart"></i></span>
									<span class="body">
										<span class="message">Jane liked. </span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>2 hrs</span>
										</span>
									</span>
								</a>
							</li>
							<li>
								<a href="#">
									<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i></span>
									<span class="body">
										<span class="message">Database overload.</span>
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>6 hrs</span>
										</span>
									</span>
								</a>
							</li>
							<li class="footer">
								<a href="#">See all notifications <i class="fa fa-arrow-circle-right"></i></a>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown" id="header-message">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-envelope"></i>
						<span class="badge">3</span>
						</a>
						<ul class="dropdown-menu inbox">
							<li class="dropdown-title">
								<span><i class="fa fa-envelope-o"></i> 3 Messages</span>
								<span class="compose pull-right tip-right" title="Compose message"><i class="fa fa-pencil-square-o"></i></span>
							</li>
							<li>
								<a href="#">
									<img src="img/avatars/avatar2.jpg" alt="" />
									<span class="body">
										<span class="from">Jane Doe</span>
										<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
										</span> 
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>Just Now</span>
										</span>
									</span>
									 
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/avatars/avatar1.jpg" alt="" />
									<span class="body">
										<span class="from">Vince Pelt</span>
										<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
										</span> 
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>15 min ago</span>
										</span>
									</span>
									 
								</a>
							</li>
							<li>
								<a href="#">
									<img src="img/avatars/avatar8.jpg" alt="" />
									<span class="body">
										<span class="from">Debby Doe</span>
										<span class="message">
										Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse mole ...
										</span> 
										<span class="time">
											<i class="fa fa-clock-o"></i>
											<span>2 hours ago</span>
										</span>
									</span>
									 
								</a>
							</li>
							<li class="footer">
								<a href="#">See all messages <i class="fa fa-arrow-circle-right"></i></a>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN TODO DROPDOWN -->
					<li class="dropdown" id="header-tasks">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-tasks"></i>
						</a>
					</li>
					<!-- END TODO DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown user" id="header-user">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img alt="" src="img/avatars/avatar3.jpg" />
							<span class="username">[var._SESSION.cLoggedName;noerr;]</span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-cog"></i> Change Password</a></li>
							<li><a href="?m=admin.auth&logout=1"><i class="fa fa-power-off"></i> Log Out</a></li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
				<!-- END TOP NAVIGATION MENU -->
		</div>
		[var.team_status;noerr]	
	</header>
	<!--/HEADER -->
	
	<!-- PAGE -->
	<section id="page">
				<!-- SIDEBAR -->
				<div id="sidebar" class="sidebar">
					<div class="sidebar-menu nav-collapse">
					
						<!-- SIDEBAR QUICK-LAUNCH -->
						<!-- <div id="quicklaunch">
						<!-- /SIDEBAR QUICK-LAUNCH -->
						
						<!-- SIDEBAR MENU -->
						<ul>
							<li class="active">
								<a href="index.php">
								<i class="fa fa-tachometer fa-fw"></i> <span class="menu-text">Dashboard</span>
								<span class="selected"></span>
								</a>					
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-desktop"></i> <span class="menu-text">System Manager</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="?m=master.entity"><span class="sub-menu-text">Branch</span></a></li>
									<li><a class="" href="?m=user.group"><span class="sub-menu-text">Group User</span></a></li>
									<li><a class="" href="?m=user.user"><span class="sub-menu-text">User</span></a></li>
									<li><a class="" href="?m=user.priv"><span class="sub-menu-text">User Privileges</span></a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-users fa-fw"></i> <span class="menu-text">Employee</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="?m=master.dept"><span class="sub-menu-text">Departemen</span></a></li>
									<li><a class="" href="?m=master.employee"><span class="sub-menu-text">Employee</span></a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-cutlery fa-fw"></i> <span class="menu-text">Restaurant</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="?m=master.satuan"><span class="sub-menu-text">Units</span></a></li>
									<li><a class="" href="?m=master.groupitem"><span class="sub-menu-text">Item Groups</span></a></li>
									<li><a class="" href="?m=master.items"><span class="sub-menu-text">Items</span></a></li>
									<li><a class="" href="?m=master.paket"><span class="sub-menu-text">Packages</span></a></li>
									<li><a class="" href="?m=master.table"><span class="sub-menu-text">Table Layout</span></a></li>
									<li><a class="" href="?m=master.recipe"><span class="sub-menu-text">Recipes</span></a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-truck fa-fw"></i> <span class="menu-text">Purc & Inv</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="?m=master.supplier"><span class="sub-menu-text">Supplier</span></a></li>
									<li><a class="" href="?m=master.gudang"><span class="sub-menu-text">Warehouse</span></a></li>
									<li><a class="" href="?m=trans.po"><span class="sub-menu-text">Purchase Order</span></a></li>
									<li><a class="" href="?m=trans.appay"><span class="sub-menu-text">AP Payment</span></a></li>
									<li><a class="" href="?m=trans.adjust"><span class="sub-menu-text">Adjustment</span></a></li>
								</ul>
							</li>
							<li class="has-sub">
								<a href="javascript:;" class="">
								<i class="fa fa-bar-chart-o fa-fw"></i> <span class="menu-text">Reports</span>
								<span class="arrow"></span>
								</a>
								<ul class="sub">
									<li><a class="" href="?m=report.salessummary"><span class="sub-menu-text">Sales Summary</span></a></li>
									<li><a class="" href="?m=report.salesdetail"><span class="sub-menu-text">Sales Detail</span></a></li>
									<li><a class="" href="?m=report.stockcard"><span class="sub-menu-text">Stock Card</span></a></li>
									<li><a class="" href="?m=report.stockcard"><span class="sub-menu-text">Stock On Hand</span></a></li>
									<li><a class="" href="?m=report.posummary"><span class="sub-menu-text">Purchase Order Summary</span></a></li>
									<li><a class="" href="?m=report.pooverdue"><span class="sub-menu-text">Purchase Order Over Due</span></a></li>
									<li><a class="" href="?m=report.topcustomer"><span class="sub-menu-text">Top Customer</span></a></li>
									<li><a class="" href="?m=report.topproduct"><span class="sub-menu-text">Top Product</span></a></li>
									<li><a class="" href="#"><span class="sub-menu-text">Others</span></a></li>
								</ul>
							</li>
						</ul>
						<!-- /SIDEBAR MENU -->
					</div>
				</div>
				<!-- /SIDEBAR -->
		<div id="main-content">
			<div class="container">
            [var.~content;noerr] 
			</div>
		</div>
	</section>
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="bootstrap-dist/js/bootstrap.min.js"></script>
	<script src="js/validation/js/bootstrapValidator.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquerycombogrid/plugin/jquery.ui.combogrid-1.6.3.js"></script>
	<script src="js/jquery-number/jquery.number.js" type="text/javascript"></script>
	<!-- DATE RANGE PICKER -->
	<script src="js/bootstrap-daterangepicker/moment.min.js"></script>
	<script src="js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- INPUT MASK -->
	<script type="text/javascript" src="js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="js/jQuery-BlockUI/jquery.blockUI.min.js"></script>
	<!-- SPARKLINES -->
	<script type="text/javascript" src="js/sparklines/jquery.sparkline.min.js"></script>
	<!-- EASY PIE CHART -->
	<script src="js/jquery-easing/jquery.easing.min.js"></script>
	<script type="text/javascript" src="js/easypiechart/jquery.easypiechart.min.js"></script>
	<!-- FLOT CHARTS -->
	<script src="js/flot/jquery.flot.min.js"></script>
	<script src="js/flot/jquery.flot.time.min.js"></script>
    <script src="js/flot/jquery.flot.selection.min.js"></script>
	<script src="js/flot/jquery.flot.resize.min.js"></script>
    <script src="js/flot/jquery.flot.pie.min.js"></script>
    <script src="js/flot/jquery.flot.stack.min.js"></script>
    <script src="js/flot/jquery.flot.crosshair.min.js"></script>
	<!-- TODO -->
	<script type="text/javascript" src="js/jquery-todo/js/paddystodolist.js"></script>
	<!-- TIMEAGO -->
	<script type="text/javascript" src="js/timeago/jquery.timeago.min.js"></script>
	<!-- FULL CALENDAR -->
	<script type="text/javascript" src="js/fullcalendar/fullcalendar.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<!-- GRITTER -->
	<script type="text/javascript" src="js/gritter/js/jquery.gritter.min.js"></script>
	<!-- CUSTOM SCRIPT -->
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="js/jQueryFileUpload/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="js/jQueryFileUpload/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="js/jQueryFileUpload/js/canvas-to-blob.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="js/jQueryFileUpload/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="js/jQueryFileUpload/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="js/jQueryFileUpload/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="js/jQueryFileUpload/js/jquery.fileupload-image.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="js/jQueryFileUpload/js/jquery.fileupload-validate.js"></script>
    <script src="js.php?src=graph.dashboard" type="text/javascript"></script>
	<script src="js/script.js"></script>
	<script src="js.php?src=[var.moduleid;noerr]" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function() {	
			App.setPage("[var.idxmodul;noerr]");  //Set current page
			App.init(); //Initialise plugins and elements
		});
	</script>
	<!-- /JAVASCRIPTS -->
