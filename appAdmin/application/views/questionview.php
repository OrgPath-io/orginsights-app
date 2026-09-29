<?php
$Assetpath="/asset/";
?>
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
<div class="logo"><a href="#"><img src="<?php echo SITEURL;?>/assets/images/logo.png" alt=""></a></div>
<h5 class="align-self-center">Administration</h5>
<div class="header-search align-self-center">
<a class="btn btn-primary btn-lg" href="/appAdmin/index.php/questions/">Back to Questions</a>
</div>
<button type="button" class="menu-open menu-btn d-block d-xl-none align-self-center ml-auto"><span class="sr-only">MENU</span></button>
</header>
</div>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link href="<?php echo $Assetpath;?>style.css?d=121803" rel="stylesheet">
    <link href="<?php echo $Assetpath;?>css/all.css" rel="stylesheet">
    <link href="<?php echo $Assetpath;?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $Assetpath;?>css/responsive.css" rel="stylesheet">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $Assetpath;?>images/apple-touch-icon-144-precomposed.png">
<div class="section">
<div class="container">    
<div class="list-item">
<?php
$con=$this->db;

$tablevalue="questions";
$tablevalue2="responses";
$tablevalue3="questions_responses";
$Answerpath="/asset/images/answers/";
$Questpath="/asset/images/questions/";

$id=(int)$_REQUEST['id'];
if($id!=0)
{

$con->where('q_id', $id);
$checkquestionsQ=$con->get($tablevalue);

$checkquestions=$checkquestionsQ->row_array();
	if($checkquestions!="")
	{
		
		$question=$checkquestions['question'];
		$general_instruction=$checkquestions['general_instruction'];
		$question_typeID=$checkquestions['question_typeID'];
		$cat_id=$checkquestions['cat_id'];
		$cap_id=$checkquestions['cap_id'];
		$q_type=$checkquestions['q_type'];
		$show_type=$checkquestions['show_type'];

	}
	
	$con->order_by("Score asc");
	$con->order_by("id asc");
	$con->where('q_id', $id);
	$checkanswersQ=$con->get($tablevalue3);

	$countrec=0;
	foreach ($checkanswersQ->result_array() as $checkanswers)
	{
		$con->where('oa_id', $checkanswers["oa_id"]);
		$checkanswersQ2=$con->get($tablevalue2);

		$checkanswers2=$checkanswersQ2->row_array();
		
		if($checkanswers2!="")
		{
			if((int)$question_typeID==1)
			{
				
				$ImageAnswers[$countrec]=$checkanswers2["answers"];
				$AnswersID[$countrec]=$checkanswers2["oa_id"];
				$ScoreID[$countrec]=$checkanswers["id"];
				$countrec++;
			}
			else
			{
				$Answers[$checkanswers["Score"]]=$checkanswers2["answers"];
				$AnswersID[$checkanswers["Score"]]=$checkanswers2["oa_id"];
				$ScoreID[$checkanswers["Score"]]=$checkanswers["id"];
			}
		}
	}

}
?>
		<h4><?php echo $question;?></h4>
		<?php
		if($show_type=="image")
		{
		?>
		<img src="<?php echo $Questpath.$id."-1.png";?>" />
		<?php										
		}
		?>
				<div class="row customSelectMainWrap2">
				<?php
				for($i=0;$i<=5;$i++)
				{
					$j=$i+1;
				?>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio21 ">
			  		
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label">
						<?php
						if($ImageAnswers[$i]!="")
						{
						?>
						<img src="<?php echo $Answerpath.$ImageAnswers[$i];?>" />
						<?php
						}
						else
						{
							echo $Answers[$i];
						}
						?>
						</span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
				<?php
				}
				?>
			
					</div>
	</div>
	

</div></div>	
</body>
</html>