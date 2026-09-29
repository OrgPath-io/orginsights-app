<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Orginsights</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
<link href="<?php echo SITEURL;?>/assets/style.css" rel="stylesheet">
<link href="<?php echo SITEURL;?>/assets/css/all.css" rel="stylesheet">
<link href="<?php echo SITEURL;?>/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo SITEURL;?>/assets/css/responsive.bootstrap4.min.css" rel="stylesheet">
<link href="<?php echo SITEURL;?>/assets/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo SITEURL;?>/assets/css/responsive.css" rel="stylesheet">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo SITEURL;?>/assets/images/apple-touch-icon-144-precomposed.png">
<link rel="shortcut icon" href="<?php echo SITEURL;?>/assets/images/favicon.png">
</head>

<body class="dash-body">
<div id="page">
<header class="header clearfix d-flex">
<div class="logo"><a href="#"><img src="<?php echo SITEURL;?>/assets/images/logo.png" alt=""></a></div>
<h5 class="align-self-center">Administration</h5>
<div class="header-search align-self-center"><input type="text" class="form-control" placeholder="Search Anything..."></div>
<button type="button" class="menu-open menu-btn d-block d-xl-none align-self-center ml-auto"><span class="sr-only">MENU</span></button>
</header>

<div class="sidebar">
<div class="sidebar-menu">
<ul id="side-menu" class="main-menu">
    <li><a href="<?php echo SITEURL;?>/index.php/users/"><i class="fas fa-user-alt mr-2"></i>Users</a></li>
	<li><a href="<?php echo SITEURL;?>/index.php/referralcodes/"><i class="fas fa-chart-bar mr-2"></i>Referral Codes</a></li>
    <li><a href="#"><i class="fas fa-user-friends mr-2"></i>Candidates</a></li>
    <li><a href="#"><i class="fas fa-file-alt mr-2"></i>Invoices</a></li>
    <li><a href="#"><i class="fas fa-chart-bar mr-2"></i>Reports</a></li>
    <li><a href="/appAdmin/index.php/logout/"><i class="fas fa-power-off mr-2"></i>Logout</a></li>

</ul>
</div>
</div>

<div class="body-wrapper">
<div class="section-title mb-4"><h4>Send Email</h4></div>
					

                    
                        <div class="row">

                            <div class="col-lg-12">
							
								<div class="col-lg-12">
                                <?php echo $ThanksText;?>
								</div>
								<div style="clear:both;"></div>
								<!---->
					
								
							</div>	
						</div>
						
</div>


<footer class="footer footer-inner"><p>Copyright © 2022 OrgInsights. All rights reserved | Developed by <a href="#"><img src="<?php echo SITEURL;?>/assets/images/copyright-logo.png" alt=""></a></p></footer>
</div>
<!-- Bootstrap core JavaScript================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo SITEURL;?>/assets/js/jquery.min.js" ></script>
<script src="<?php echo SITEURL;?>/assets/js/popper.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/custom.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/jquery.matchHeight-min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo SITEURL;?>/assets/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
jQuery('.coleql_height').matchHeight();

jQuery(document).ready( function () {
jQuery('#dataTable')
.addClass('nowrap')
.dataTable( {
responsive: true,
searching: false,
ordering: false,
bLengthChange: false,
paging: false,
});
});

jQuery("#dataTable tbody").sortable({
helper: fixHelperModified,
stop: function(event,ui) {renumber_table('#dataTable')}
}).disableSelection();
</script>
</body>
</html>