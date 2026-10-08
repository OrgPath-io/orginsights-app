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
<style>
.pagination .page-link{color:#000000 !important;}
th a{color:#ffffff !important;text-decoration:none !important;}
</style>
</head>

<body class="dash-body">
<div id="page">
<header class="header clearfix d-flex">
<div class="logo"><a href="<?php echo SITEURL;?>/index.php/dashboard/"><img src="<?php echo SITEURL;?>/assets/images/logo.png" alt=""></a></div>
<h5 class="align-self-center">Administration</h5>
<div class="header-search align-self-center"><form id="searchform" method="post" action="?"><input type="text" name="searchtext" value="<?php echo $_POST["searchtext"];?>" class="form-control" placeholder="Search Anything..."></form></div>
<button type="button" class="menu-open menu-btn d-block d-xl-none align-self-center ml-auto"><span class="sr-only">MENU</span></button>
</header>
<?php
$questclass='display:none;';
$qarrow_down='display:none;';
$qarrow_up='display:block;';
if(strpos($_SERVER['REQUEST_URI'],"categor") > 0 || strpos($_SERVER['REQUEST_URI'],"capabilit") > 0 || strpos($_SERVER['REQUEST_URI'],"qtype") > 0 || strpos($_SERVER['REQUEST_URI'],"question") > 0)
{
	$questclass='display:block;';
	$qarrow_down='display:block;';
	$qarrow_up='display:none;';
}
?>
<div class="sidebar">
<div class="sidebar-menu">
<ul id="side-menu" class="main-menu">
    <li><a href="<?php echo SITEURL;?>/index.php/users/"><i class="fas fa-user-alt mr-2"></i>Users</a></li>
	<li><a href="<?php echo SITEURL;?>/index.php/referralcodes/"><i class="fas fa-chart-bar mr-2"></i>Referral Codes</a></li>
	<li><a href="<?php echo SITEURL;?>/index.php/orders/"><i class="fas fa-chart-bar mr-2"></i>Orders</a></li>
	<li><a href="<?php echo SITEURL;?>/index.php/assessments/"><i class="fas fa-chart-bar mr-2"></i>Assessments</a></li>
	<li><a href="<?php echo SITEURL;?>/index.php/assessmentcosts/"><i class="fas fa-chart-bar mr-2"></i>Assessment Costs</a></li>
	<li><a href="<?php echo SITEURL;?>/index.php/assessmentprices/"><i class="fas fa-chart-bar mr-2"></i>Assessment Prices</a></li>
	
	<li><a href="javascript:void(0)" onclick="opensubcats()" ><i class="fas fa-chart-bar mr-2"></i>Questions<i style="float:right;<?php echo $qarrow_up;?>" id="qarrow_up" class="fas fa-chevron-up"></i><i style="float:right;<?php echo $qarrow_down;?>;" id="qarrow_down" class="fas fa-chevron-down"></i></a>
	
	</li>
	</ul>
	<div style="<?php echo $questclass;?>" id="questsubcats">
	<ul id="side-menu" class="main-menu">
	<li style="padding-left:40px;"><a href="<?php echo SITEURL;?>/index.php/categories/">Categories</a></li>
	<li style="padding-left:40px;"><a href="<?php echo SITEURL;?>/index.php/capabilities/">Capabilities</a></li>
	<li style="padding-left:40px;"><a href="<?php echo SITEURL;?>/index.php/industrycapabilities/">Industry Capabilities</a></li>
	<li style="padding-left:40px;"><a href="<?php echo SITEURL;?>/index.php/qtypes/">Question Types</a></li>
	<li style="padding-left:40px;"><a href="<?php echo SITEURL;?>/index.php/questions/">Questions</a></li>
	</ul>
	</div>
	<script>
	function opensubcats()
	{
		if(document.getElementById("questsubcats").style.display=="none")
		{
			document.getElementById("questsubcats").style.display="block"
			document.getElementById("qarrow_up").style.display="none"
			document.getElementById("qarrow_down").style.display="block"
		}
		else
		{
			document.getElementById("questsubcats").style.display="none"
			document.getElementById("qarrow_down").style.display="none"
			document.getElementById("qarrow_up").style.display="block"
		}
	}
	
	</script>
	<ul id="side-menu" class="main-menu">
    <li><a href="<?php echo SITEURL;?>/index.php/logout/"><i class="fas fa-power-off mr-2"></i>Logout</a></li>

</ul>
</div>
</div>

<?php
$con=$this->db;

$yesno=array("No","Yes");

if((int)$this->session->userdata('appAdminadminlog')==0)
{
	?>
	<script>
	location.href="/appAdmin/";
	</script>
	<?php
	die();
}
?>
<script type="text/javascript">
function Getpages (n1,id1) {
             $('#'+id1).load(n1);
          };

function sortlist(n1)
{
	redirecto="?sort="+n1;
	//+"<?php echo $requeststring;?>";
	searchtext="<?php echo $_POST["searchtext"];?>";
	if(searchtext!="")
	{
		document.getElementById("searchform").action=redirecto;
		document.getElementById("searchform").submit();
	}
	else
	{
		location.href=redirecto;
	}
    
	nsortby=n1;
}
</script>
