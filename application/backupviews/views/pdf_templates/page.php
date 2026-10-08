<?php
//print_r($_SESSION); 
$IMAGEPATH=$_SERVER['DOCUMENT_ROOT']."/app/application/views/"; 
//die();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orginsights PDF</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="'.$IMAGEPATH.'pdf_templates/css/main.css">
</head>
<body>
<style>
	
.score-graph2 {
    clear: both;
    padding-top: 13px;
}
.score-graph2 .letter{
    width: 50px;
    height: 100px;
    color: #DDDDDD;
    font-size: 60px;
    line-height: 50px;
    float: left;
}
.score-graph2 .right-section{
    width: 500px;
    height: 85px;
    float: left;
    padding-top: 10px;
}
.score-graph2 small {
    font-size: 10px;
}
.score-graph2 .graph-wrapper {
    background-color: #DDDDDD;
    width: 250px;
    height: 20px;
    position: relative;
    padding-top: 5px;
}
.score-graph2 .graph-wrapper * {
    margin: 0;
    padding: 0;
}
.score-graph2 .graph-wrapper .graph-box {
    width: 50px;
    height: 25px;
    border: 1px solid #fff;
    margin: 0;
    display: inline-block;
    margin-left: -5px;
    z-index: 1;
}
.score-graph2 .graph-wrapper .progress {
    position: absolute;
    height: 25px;
    border-left: 1px solid #fff;
    z-index: 0;
    margin-top: -5px;
}
.score-graph2 .graph-wrapper.graph-wrapper-1 .progress {
    background-color: #3397DF;
}
.score-graph2 .graph-wrapper.graph-wrapper-2 .progress {
    background-color: #1D9A40;
}
.chart-bottom  img {
    width: 50px !important;
	}
.chart-bottom .right img {
    width: 50px !important;
}	

.summary-box {
    height: 370px !important;
	}
.creating-purpose .right {
    width: 200px;
}	
.radius-box {
font-size: 10px; !important;
}
</style>
    <!-- Page 1 -->
    <div class="logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
    </div>
    <div class="banner">
        <img src="'.$IMAGEPATH.'pdf_templates/images/banner.jpg" alt="">
    </div>
    <div class="text-center">
        <h1 class="main-title">
            ORGINSIGHTS ASSESSMENT
        </h1>
        <h2 class="main-title__sub">'.$this->session->userdata('first_name').' '.$this->session->userdata('last_name').'</h2><br>';
		
			
				$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
				if("*".$order_date."*"=="**")
				{
					$order_dateT=$timestamp;
				}
				else
				{
				$Splitdate=explode(" ",$order_date);
				$Splitdate2=explode("-",$Splitdate[0]);
				$Splitdate3=explode(":",$Splitdate[1]);
				$order_dateT=mktime($Splitdate3[0], $Splitdate3[1],$Splitdate3[2], $Splitdate2[1], $Splitdate2[2], $Splitdate2[0]);
				}
				
				//calc hours
				$diff=$timestamp-$order_dateT;
				
				$hours=$diff/3600;
				
				$hours=(int)$hours;
				/*Date: <?php echo date("d");?><sup><?php echo date("S");?></sup> <?php echo date("F");?> <?php echo date("Y");?>*/
				
		
        $html .= '<span>'.date("F d, Y",$order_dateT).'</span>
    </div>
    <div class="page_break"></div>

    <!-- Page 2 -->

    <div class="page-logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
        <div class="site-name">
            orginsight.io
            <div class="green-box"></div>
        </div>
    </div>
    <div class="page-header">
        <h1 class="main-headline">ABOUT</h1>
        <h2 class="sub-headline">THIS REPORT</h2>
        <p>Thank you for completing the OrgInsights Assessment. The following pages will walk you through your results. This report will help you in the following ways:</p>
    </div>
    <div class="container">
	<p style="color:#ffffff;">-</p>
	<p style="color:#ffffff;">-</p>
	<p style="color:#ffffff;">-</p>
	<p style="color:#ffffff;">-</p>
        <ul>
            <li> <div class="icon-wrapper">
                    <img src="'.$IMAGEPATH.'pdf_templates/images/check_mark.png" alt="" class="icon">
                </div><div class="text"> It will show you the gap (positive or negative) between your perception of your capabilities, and what others see in you </div></li>
				<li><div class="icon-wrapper">
                    <img src="'.$IMAGEPATH.'pdf_templates/images/check_mark.png" alt="" class="icon">
                </div><div class="text"> The report will highlight the most important skills that you need to develop to address gaps and to improve your competitive edge</div></li>
				<li><div class="icon-wrapper">
                    <img src="'.$IMAGEPATH.'pdf_templates/images/check_mark.png" alt="" class="icon">
                </div><div class="text"> Because feedback from others is generally twice as accurate as your own assessment, this report will help increase your self awareness. The first step to great leaders, is knowing your capabilities; we want to help you on that journey.</div></li>
        </ul>
	</div>
    <div class="report-summary-wrapper">
        <div class="report-summary">
            <img src="'.$IMAGEPATH.'pdf_templates/images/hands.png" alt="" class="hands">
            <div class="container">
                <h5>Report Summary</h5>
                <ul>
                    <li>
                        <div class="icon-wrapper">
                            <div class="number-icon">
                                1
                            </div>
                        </div>
                        <div class="text">
                            First Breathe: Take all the information you see ahead in your stride. Perhaps individuals haven\'t seen you operating at your best? This doesn\'t mean that you are not capable of more. They may have higher expectations or may not have seen the extent of your true capabilities.
                        </div>
                    </li>
                    <li>
                        <div class="icon-wrapper">
                            <div class="number-icon">
                                2
                            </div>
                        </div>
                        <div class="text">
                            You will see your own self-assessment scores compared to that of the individuals you invited to respond. If you don\'t agree with the scores provided, take a step back and do your own research. Develop a holistic understanding of why you may have received these ratings.
                        </div>
                    </li>
                    <li>
                        <div class="icon-wrapper">
                            <div class="number-icon">
                                3
                            </div>
                        </div>
                        <div class="text">
                            Unused strengths are quickly lost. Like any muscle in your body, you need to constantly practice and develop your capabilities to ensure that they stay assets to you.
                        </div>
                    </li>
                    <li>
                        <div class="icon-wrapper">
                            <div class="number-icon">
                                4
                            </div>
                        </div>
                        <div class="text">
                            The information provided has been kept anonymous, and there is a reason for that. Individuals will provide more honest feedback when they know it will not be traced back to them. Do not try and find out who the individuals who answered are as this will affect the honesty of future responses.
                        </div>
                    </li>
					<li>
                        <div class="icon-wrapper">
                            <div class="number-icon">
                                5
                            </div>
                        </div>
                        <div class="text">
                            Your ratings will be displayed on a scale from 0 (needs improvement) to 5 (exceptional).
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page_break"></div>

    <!-- Page 3 -->
    <img src="'.$IMAGEPATH.'pdf_templates/images/page3_banner.png" alt="" class="page3-banner">';
	
	//


for($i=1;$i<=5;$i++)
{
	if($i > 1)
	{
		 $addmargin='style="margin-top: 20px;"';
	}
	else
	{	
		$addmargin='';
	}
	
	$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id=".$i."");
	$checkreponsesR = $checkreponsesQ->result_array();
	foreach($checkreponsesR as $key=>$value)
	{
		$cat_description=$value["cat_description"];
		$cat_name=$value["cat_name"];
		$Maincatid=$value["cat_id"];
		


//
	
	
    $html .= '<div class="capb-model" '.$addmargin.'>
        <div class="left-section">
            <div class="letter">'.strtoupper(substr($cat_name,0,1)).'</div>
            <div class="details">
                <h6>'.strtoupper($cat_name).'</h6>
                <p>
                    '.$cat_description.'
                </p>
            </div>
        </div>
        <div class="right-section">';
		
		$ccnt=0;
		$checkcapsQ = $this->db->query("SELECT cap_id from questions where cat_id = ".(int)$Maincatid."");
		$checkcapsR = $checkcapsQ->result_array();
		foreach($checkcapsR as $key=>$value)
		{
			if(in_array($value["cap_id"],$breakdownid))
			{
			}
			else
			{
				$ccnt++;
				//echo "<br>".$value["cap_id"];
				$breakdownid[$ccnt]=$value["cap_id"];
			}
		}
		
		$bkdid=0;
		foreach($breakdownid as $key=>$value)
		{
			$bkdid++;
			$checkcapsQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$value."");
			$checkcapsR = $checkcapsQ->result_array();
			
			if($checkcapsR!="" && $bkdid < 5)
			{
		
            $html .= '<div class="list-item">
                <div class="icon"></div>
                <p>
                    <b>'.$checkcapsR[0]["cap_name"].'</b> '.$checkcapsR[0]["description"].'
                </p>
            </div>';
			}
		}
            
            $html .= '<div class="separator"></div>
        </div>
    </div>
    <div class="clear-fix"></div>';
	
	}
	
}	
	
    $html .= '<!-- <div class="page_break"></div> -->

    <!-- Page 4 -->';
	
	$user_id=(int)$this->session->userdata('user_id');

//arrays
$levelstext=array();

for($i=1;$i<=5;$i++)
{
	$levelstext[$i]=array();
	
	for($j=1;$j<=4;$j++)
	{
		$levelstext[$i][$j]="";
	}
}
$checkreponsesQ = $this->db->query("SELECT * from ConditionalComments_Report order by CategoryID");
$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	$i=(int)$value["CategoryID"];
	
	$levelstext[$i][1]=$value["TopScoring"];
	$levelstext[$i][2]=$value["LowestScoring"];
	$levelstext[$i][3]=$value["HiddenTalent"];
	$levelstext[$i][4]=$value["BlindSpot"];

}

//
$desctext=array();

for($i=1;$i<=5;$i++)
{
	$desctext[$i]="";
	
	$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id=".$i."");
	$checkreponsesR = $checkreponsesQ->result_array();
	foreach($checkreponsesR as $key=>$value)
	{
		$desctext[$i]=$value["cat_description"];
		

	}
	
}
//


//end

$checkinvitedQ = $this->db->query("SELECT count(*) as PeopleInvited from invited_users where invited_by = ".$user_id." and order_id=".$order_id." order by id desc");
$checkinvitedR = $checkinvitedQ->result_array();

$PeopleInvited = $checkinvitedR[0]["PeopleInvited"];

//
$checkcompletedQ = $this->db->query("SELECT count(*) as PeopleCompleted from orders where user_id = ".$user_id." and order_status = 'Completed' and order_id=".$order_id." order by order_id desc");
$checkcompletedR = $checkcompletedQ->result_array();

$PeopleCompleted = $checkcompletedR[0]["PeopleCompleted"];


//
$cats=array();
$catsq=array();

$Orgcats=array();
$Orgcatsq=array();

$caps=array();
$Orgcaps=array();
$capsq=array();
$Orgcapsq=array();

//$checkreponsesQ = $this->db->query("SELECT a.*,q.cat_id,q.cap_id,q.q_type,q.question_typeID from orders_assessment_type_responses a INNER JOIN questions q on a.q_id=q.q_id where a.user_id = ".$user_id." and a.oa_val > -99 and a.order_id=".$order_id." order by a.order_id desc,a.q_id");

/*/direct query
$checkreponsesQ = $this->db->query("select a.oatr_id AS oatr_id,a.oat_id AS oat_id,a.order_id AS order_id,a.user_id AS user_id,a.q_id AS q_id,a.oa_id AS oa_id,a.oa_val AS oa_val,a.created_date AS created_date,a.updated AS updated,q.cat_id AS cat_id,q.cap_id AS cap_id,q.q_type AS q_type from (orders_assessment_type_responses a join questions q on((a.q_id = q.q_id))) where (a.user_id =".$user_id." and a.oa_val > -(99) and a.order_id =".$order_id.") order by a.order_id desc,a.q_id");

//*/
//view

$checkreponsesQ = $this->db->query("SELECT * FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id);


$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Score=(int)$value["oa_val"];
	
	$scoretype=0;
	
	if($value["q_type"]=='professional' && $value["question_typeID"]!=3 && $value["question_typeID"]!=5)
	{
		$scoretype=1;
	}

	
		
		if($scoretype==1)
		{
			if(!isset($Orgcaps[(int)$value["cap_id"]]))
			{
				$Orgcaps[(int)$value["cap_id"]]=0;
				$Orgcapsq[(int)$value["cap_id"]]=0;
			}
			if(!isset($Orgcats[(int)$value["cat_id"]]))
			{
				
				$Orgcats[(int)$value["cat_id"]]=0;
				$Orgcatsq[(int)$value["cat_id"]]=0;
			}
			
			$Orgcaps[(int)$value["cap_id"]]+=(int)$Score;
			$Orgcapsq[(int)$value["cap_id"]]++;
			
			$Orgcats[(int)$value["cat_id"]]+=(int)$Score;
			$Orgcatsq[(int)$value["cat_id"]]++;
			
		}
		else
		{
			if(!isset($caps[(int)$value["cap_id"]]))
			{
				$caps[(int)$value["cap_id"]]=0;
				$capsq[(int)$value["cap_id"]]=0;
			}
			if(!isset($cats[(int)$value["cat_id"]]))
			{
				$cats[(int)$value["cat_id"]]=0;
				$catsq[(int)$value["cat_id"]]=0;
			}
			$caps[(int)$value["cap_id"]]+=(int)$Score;
			$capsq[(int)$value["cap_id"]]++;
			
			$cats[(int)$value["cat_id"]]+=(int)$Score;
			$catsq[(int)$value["cat_id"]]++;
		}
	
}



$catratings=array();
$Orgcatratings=array();
foreach($cats as $key=>$value)
{
	$catratings[$key]=$value/$catsq[$key];
}
foreach($Orgcats as $key=>$value)
{
	$Orgcatratings[$key]=$value/$Orgcatsq[$key];
}

//
$capratings=array();
$Orgcapratings=array();
foreach($caps as $key=>$value)
{
	if($capsq[$key] > 0)
	{
		$capratings[$key]=$value/$capsq[$key];
	}
	else
	{
		$capratings[$key]=0;
	}
}
foreach($Orgcaps as $key=>$value)
{



	if($Orgcapsq[$key] > 0)
	{
		$Orgcapratings[$key]=$value/$Orgcapsq[$key];
	}
	else
	{
		$Orgcapratings[$key]=0;
	}
	
	
	$checkcapsQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$key);
	$checkcapsR = $checkcapsQ->result_array();
	if($checkcapsR!="")
	{
		//echo $checkcapsR[0]["cap_name"]." <b>".$value."</b> (".$Orgcapsq[$key].") = <b>".number_format($Orgcapratings[$key],1)."</b><br>";
	}
	
}

$Totalratings=array();
$OrgTotalratings=array();
$TotalratingsID=array();
$OrgTotalratingsID=array();



for($i=1;$i<=6;$i++)
{
	$Totalratings[$i]=0;
}
for($i=1;$i<=6;$i++)
{
	$OrgTotalratings[$i]=0;
}

$i=0;
foreach($capratings as $key=>$value)
{
	
	$Totalratings[$i]=$value;
	$TotalratingsID[$i]=$key;
	$i++;
}

$i=0;
foreach($Orgcapratings as $key=>$value)
{
	
	$OrgTotalratings[$i]=$value;
	$OrgTotalratingsID[$i]=$key;
	$i++;
	
}

//CALC HIGHEST

$highest1=0;
$highest1ID=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($value > $highest1)
	{
		$highest1=$value;
		$highest1ID=$OrgTotalratingsID[$key];
	}

}



//
$highest2=0;
$highest1ID2=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$highest1ID)
	{
		if($value > $highest2)
		{
			$highest2=$value;
			$highest1ID2=$OrgTotalratingsID[$key];
		}
	}

}


//
$highest3=0;
$highest1ID3=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$highest1ID && $OrgTotalratingsID[$key]!=$highest1ID2)
	{
		if($value > $highest3)
		{
			$highest3=$value;
			$highest1ID3=$OrgTotalratingsID[$key];
		}
	}

}



$highcap=array($highest1,$highest2,$highest3);
$highcapID=array($highest1ID,$highest1ID2,$highest1ID3);



//
//CALC lowEST
$lowest1=99999999;
$lowest1ID=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($value < $lowest1 && $value > 0)
	{
		$lowest1=$value;
		$lowest1ID=$OrgTotalratingsID[$key];
	}

}

if($lowest1==99999999)
{
	$lowest1=0;
}
//
$lowest2=99999999;
$lowest1ID2=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$lowest1ID)
	{
		if($value < $lowest2 && $value > 0)
		{
			$lowest2=$value;
			$lowest1ID2=$OrgTotalratingsID[$key];
		}
	}

}
if($lowest2==99999999)
{
	$lowest2=0;
}
//
$lowest3=99999999;
$lowest1ID3=0;
foreach($OrgTotalratings as $key=>$value)
{
	if($OrgTotalratingsID[$key]!=$lowest1ID && $OrgTotalratingsID[$key]!=$lowest1ID2)
	{
		if($value < $lowest3 && $value > 0)
		{
			$lowest3=$value;
			$lowest1ID3=$OrgTotalratingsID[$key];
		}
	}

}

if($lowest3==99999999)
{
	$lowest3=0;
}



$lowcap=array($lowest1,$lowest2,$lowest3);
$lowcapID=array($lowest1ID,$lowest1ID2,$lowest1ID3);
//


$yourlowest=99999999;
$yourhighest=0;
$yourlowcat=0;
$yourhighcat=0;

$ratings=array();
$Orgratings=array();

for($i=1;$i<=6;$i++)
{
	$ratings[$i]=0;
}
for($i=1;$i<=6;$i++)
{
	$Orgratings[$i]=0;
}

$i=0;
foreach($catratings as $key=>$value)
{
	$i++;
	$ratings[$i]=(int)$value;
	
	if($value < $yourlowest)
	{
		$yourlowest=$value;
		$yourlowcat=$key;
	}
	
	if($value > $yourhighest)
	{
		$yourhighest=$value;
		$yourhighcat=$key;
	}
}

if($yourlowest==99999999)
{
	$yourlowest=0;
}

//
if((int)$yourlowcat==0)
{
	$yourlowcatName="Not Assigned";
}
else
{
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$yourlowcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$yourlowcatName=$checkreponsesR[0]["cat_name"];
}
//
if((int)$yourhighcat==0)
{
	$yourhighcatName="Not Assigned";
}
else
{
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$yourhighcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$yourhighcatName=$checkreponsesR[0]["cat_name"];
}


//
$Orglowest=99999999;
$Orghighest=0;
$Orglowcat=0;
$Orghighcat=0;
$i=0;
foreach($Orgcatratings as $key=>$value)
{
	$i++;
	$Orgratings[$i]=(int)$value;
	
	if($value < $Orglowest)
	{
		$Orglowest=$value;
		$Orglowcat=$key;
	}
	
	if($value > $Orghighest)
	{
		$Orghighest=$value;
		$Orghighcat=$key;
	}
}


if($Orglowest==99999999)
{
	$Orglowest=0;
}

//
if((int)$Orglowcat==0)
{
	$OrglowcatName="Not Assigned";
}
else
{
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$Orglowcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$OrglowcatName=$checkreponsesR[0]["cat_name"];
}
//
if((int)$Orghighcat==0)
{
	$OrghighcatName="Not Assigned";
}
else
{
$checkreponsesQ = $this->db->query("SELECT * from categories where cat_id = ".(int)$Orghighcat."");
$checkreponsesR = $checkreponsesQ->result_array();

$OrghighcatName=$checkreponsesR[0]["cat_name"];
}


    $html .= '<div class="page-logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
        <div class="site-name">
            orginsight.io
            <div class="green-box"></div>
        </div>
    </div>
    <div class="page-header">
        <h1 class="page4-headline">HIGH LEVEL SUMMARY OF ASSESSMENT</h1>
    </div>
    <div class="container">
        <br><br>
        <div class="summary-boxes">
            <div class="summary-box">
                <div class="title">TOP SCORING CATEGORY</div>
                <div class="info">OrgInsights rated you highest in this category</div>
                <div class="clear-fix"></div>
                <div class="icon-text">
                    <div class="icon-wrapper">
                        <img src="'.$IMAGEPATH.'pdf_templates/images/summary_icon.png" alt="">
                    </div>
                    <div class="text">
                        '.$desctext[(int)$Orghighcat].'
                    </div>
                </div>
                <div class="radius-box-title">
                    '.$OrghighcatName.'
                </div>
                <div class="radius-box">
                    '.$levelstext[(int)$Orghighcat][1].'
                </div>
            </div>
            <div class="summary-box float-right">
                <div class="title">LOWEST SCORING CATEGORY</div>
                <div class="info">Orginsights rated you lowest in this category</div>
                <div class="clear-fix"></div>
                <div class="icon-text">
                    <div class="icon-wrapper">
                        <img src="'.$IMAGEPATH.'pdf_templates/images/lowest-rating-yield-sign.png" alt="">
                    </div>
                    <div class="text">
                        '.$desctext[(int)$Orglowcat].'
                    </div>
                </div>
                <div class="radius-box-title">
                    '.$OrglowcatName.'
                </div>
                <div class="radius-box">
                    '.$levelstext[(int)$Orglowcat][2].'
                </div>
            </div>
        </div>';
		
		$hiddenspot=0;
				$hiddenspotG=-9999999;
				$catlists=array(1,2,3,4,5);
				$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
				foreach($catlists as $key=>$value)
				{
					
					if(number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1) > $hiddenspotG)
					{
						$hiddenspot=$value;
						$hiddenspotG=number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1);
					}
				}
				$value=(int)$hiddenspot;
				
				if(isset($Orgcatratings[$value]))
				{
					$Orghidden=number_format($Orgcatratings[$value],1);
				}
				else
				{
					$Orghidden="0.0";
				}
				//
				if(isset($catratings[$value]))
				{
					$Yourhidden=number_format($catratings[$value],1);
				}
				else
				{
					$Yourhidden="0.0";
				}
        $html .= '<div class="summary-boxes">
            <div class="summary-box">
                <div class="title">HIDDEN TALENT</div>
                <div class="info">Orginsights rated you higher on the category than you did yourself</div>
                <div class="clear-fix"></div>
                <div class="icon-text">
                    <div class="icon-wrapper">
                        <img src="'.$IMAGEPATH.'pdf_templates/images/hidden-talent-flags.png" alt="">
                    </div>
                    <div class="text">
                        '.$desctext[(int)$value].'
                    </div>
                </div>
                <div class="radius-box-title">
                    '.str_replace("<br>"," ",$catlistsname[(int)$value-1]).'
                </div>
                <div class="radius-box">
                    '.$levelstext[(int)$value][3].'
                </div>
            </div>';
			
			$blindspot=0;
			$blindspotG=9999999;
			$catlists=array(1,2,3,4,5);
			$catlistsname=array("Limits<br>Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationships","Sets<br>Purpose");
			foreach($catlists as $key=>$value)
			{
				if(number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1) < $blindspotG)
				{
					$blindspot=$value;
					$blindspotG=number_format($Orgcatratings[$value],1)-number_format($catratings[$value],1);
				}
			}
			
			$OrghighestR=$Orgcatratings[$blindspot];
			$yourhighestR=$catratings[$blindspot];
			$yourhighcatR=$blindspot;
			$yourhighcatNameR=$catlistsname[$blindspot-1];
			
			$value=(int)$blindspot;
						
			if(isset($Orgcatratings[$value]))
			{
				$Orgblind=number_format($Orgcatratings[$value],1);
			}
			else
			{
				$Orgblind="0.0";
			}
			//
			if(isset($catratings[$value]))
			{
				$Yourblind=number_format($catratings[$value],1);
			}
			else
			{
				$Yourblind="0.0";
			}
			
			
			
            $html .= '<div class="summary-box float-right">
                <div class="title">BLIND SPOT</div>
                <div class="info">Orginsights rated you lower on the category than you did yourself</div>
                <div class="clear-fix"></div>
                <div class="icon-text">
                    <div class="icon-wrapper">
                        <img src="'.$IMAGEPATH.'pdf_templates/images/Blind-Spot-talents-red-flags.png" alt="">
                    </div>
                    <div class="text">
                        '.$desctext[(int)$value].'
                    </div>
                </div>
                <div class="radius-box-title">
                    '.str_replace("<br>"," ",$yourhighcatNameR).'
                </div>
                <div class="radius-box">
                    '.$levelstext[(int)$yourhighcatR][4].'
                </div>
            </div>
        </div>
    </div>

    <div class="page_break"></div>

    <!-- Page 5 -->

    <div class="page-logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
        <div class="site-name">
            orginsight.io
            <div class="green-box"></div>
        </div>
    </div>
    <div class="page-header">
        <h1 class="page4-headline">HIGH LEVEL SUMMARY OF ASSESSMENT</h1>
    </div>
    <div class="container">
	<div style="padding-top: 0px !important;" class="middle-wrapper">
	<div class="icon">
	<table width="100%">
	<tr>
	<td><img src="'.$IMAGEPATH.'pdf_templates/images/mountain-small.png" alt=""></td><td valign="top"><small>Top Scoring Category</small></td>
	<td><img src="'.$IMAGEPATH.'pdf_templates/images/yield-small.png" alt=""></td><td valign="top"><small>Lowest Scoring Category</small></td>
	
	<td><img src="'.$IMAGEPATH.'pdf_templates/images/green_flag_bg.png" alt=""></td><td valign="top"><small>Hidden Talent</small></td>
	<td><img src="'.$IMAGEPATH.'pdf_templates/images/red_flag_bg.png" alt=""></td><td valign="top"><small>Blind Spot</small></td>
	</tr>
	</table></div></div><br>';
	
	$catlists=array(1,2,3,4,5);
	$catlistsname=array("LIMITS RISK","EMBRACES AGILITY","ACHIEVES EXCELLENCE","DEVELOPS RELATIONSHIPS","SETS PURPOSE");
	foreach($catlists as $key=>$value)
	{
		$abbr=substr($catlistsname[$key],0,1);
	
		if(isset($catratings[$value]))
		{
			$yoursc=number_format($catratings[$value],1);
			$yourscp=$yoursc*100;
			$yourscp/=5;
			$yourscp=number_format($yourscp,0);
		}
		else
		{
			$yoursc="0.0";
			$yourscp=0;
		}
		//
		if(isset($Orgcatratings[$value]))
		{
			$orgsc=number_format($Orgcatratings[$value],1);
			$orgscp=$orgsc*100;
			$orgscp/=5;
			$orgscp=number_format($orgscp,0);
		}
		else
		{
			$orgsc="0.0";
			$orgscp=0;
		}
		
		$gap=$orgsc-$yoursc;
		$Gap1=$gap*$multiplybyP;
		$Gap2=number_format($Gap1,(int)$numberformat);
		
	
        $html .= '<div class="score-graph">
            <div class="letter">
                '.$abbr.'
            </div>
            <div class="right-section">
                <div class="title">'.$catlistsname[$key].'</div>
                <small>YOUR SCORE</small>
                <div class="middle-wrapper">
                    <div class="main-graphs">
                        <div class="graph-wrapper graph-wrapper-1">
                            <div class="progress" style="width: '.$yourscp.'%"></div>
                            <div class="graph-box first"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                        </div>
                        <div class="graph-wrapper graph-wrapper-2">
                            <div class="progress" style="width: '.$orgscp.'%"></div>
                            <div class="graph-box first"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                        </div>
                    </div>
                    <div class="graph-rating">
                        <div class="rate-1">';
								
								$html .=number_format(($yoursc*$multiplybyP),(int)$numberformat).$displaysign;
							
                        $html .= '</div>
                        <div class="rate-2">';
						
                            $html .=number_format(($orgsc*$multiplybyP),(int)$numberformat).$displaysign;
                        $html .= '</div>
                    </div>
                    <div class="gap">
                        <b>GAP</b> '.$Gap2.$displaysign.'
                    </div>
                    <div class="icon">';
					if($gap >=2)
						{
						$html .= '<img src="'.$IMAGEPATH.'pdf_templates/images/green_flag_bg.png" alt="">';
						
						}
						else if($gap <=-2)
						{
						$html .= '<img src="'.$IMAGEPATH.'pdf_templates/images/red_flag_bg.png" alt="">';
						
						}
						if($catlists[$key]==(int)$Orghighcat)
						{
						$html .= '<img src="'.$IMAGEPATH.'pdf_templates/images/mountain-small.png" alt="">';
						}
						if($catlists[$key]==(int)$Orglowcat)
						{
						$html .= '<img src="'.$IMAGEPATH.'pdf_templates/images/yield-small.png" alt="">';
						}
                        
                    $html .= '</div>
                </div>
                <small>ORGINSIGHTS SCORE</small>
            </div>
        </div>';
        }
		
		
		
		
        $html .= '<div class="clear-fix"></div>
    </div>
    <div class="chart-bottom">
        <div class="left">
            <h5>TOP THREE CAPABILITIES</h5>
            <p>
                These are capabilities that had the highest scores based on your assessment
            </p>';
			for($i=0;$i<=2;$i++)
			{
				
				$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$highcapID[$i]."");
				$checkreponsesR = $checkreponsesQ->result_array();

				$ratingtext=$checkreponsesR[0]["cap_name"];
				
				$leftpadding=33*$i;
				
				
				if((int)$perccheck==1)
				{
					
					$topi=$IMAGEPATH.'pdf_templates/top_images_small/percentage/'.number_format($highcap[$i],1).'.jpg';
				}
				else
				{
					$topi=$IMAGEPATH.'pdf_templates/top_images_small/'.number_format($highcap[$i],1).'.png';
				}
				
				
			$html .= '<div style="float:left;width:33%;padding-left:'.$leftpadding.'%;">
			<img src="'.$topi.'"><br><h6 style="padding-left:10px;">'.$ratingtext.'</h6>
				</div>';
			}
            
        $html .= '<div style="clear:both;"></div></div>
        <div class="right">
            <h5>BOTTOM THREE CAPABILITIES</h5>
            <p>
                These are capabilities that had the lowest scores based on OrgInsights assessment
            </p>';
			
			for($i=0;$i<=2;$i++)
			{
				
				$checkreponsesQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$lowcapID[$i]."");
				$checkreponsesR = $checkreponsesQ->result_array();

				$ratingtext=$checkreponsesR[0]["cap_name"];
				
				$leftpadding=33*$i;
				
				if((int)$perccheck==1)
				{
					$bottomi=$IMAGEPATH.'pdf_templates/bottom_images_small/percentage/'.number_format($lowcap[$i],1).'.jpg';
					
				}
				else
				{
					$bottomi=$IMAGEPATH.'pdf_templates/bottom_images_small/'.number_format($lowcap[$i],1).'.png';
				}
				
			$html .= '<div style="float:left;width:33%;padding-left:'.$leftpadding.'%;">
			<img src="'.$bottomi.'"><br><h6 style="padding-left:12px;">'.$ratingtext.'</h6>
				</div>';
			}
			
			$html .= '</div>
    </div>

    <!-- Page 6 -->';
	
	//echo $html; die();
	foreach($catlists as $Ckey=>$Cvalue)
	{

		$Maincatid=$Cvalue;
		$Maincatname=$catlistsname[$Ckey];
		$Maincatname=str_replace("<br>"," ",$Maincatname);
		
		$Maincatname_s=explode(" ",$Maincatname);
		$Maincatname2=strtoupper(substr($Maincatname_s[0],0,1)).strtolower(substr($Maincatname_s[0],1));
		
		$Maincatname2.=' ';
		
		$Maincatname2.=strtoupper(substr($Maincatname_s[1],0,1)).strtolower(substr($Maincatname_s[1],1));


		$breakdowntext=array();
		$breakdownid=array();

		//echo (int)$Orghighcat;

		$ccnt=0;
		$checkcapsQ = $this->db->query("SELECT cap_id from questions where cat_id = ".(int)$Maincatid."");
		$checkcapsR = $checkcapsQ->result_array();
		foreach($checkcapsR as $key=>$value)
		{
			if(in_array($value["cap_id"],$breakdownid))
			{
			}
			else
			{
				$ccnt++;
				//echo "<br>".$value["cap_id"];
				$breakdownid[$ccnt]=$value["cap_id"];
			}
		}

		foreach($breakdownid as $key=>$value)
		{
			$checkcapsQ = $this->db->query("SELECT * from capabilities where cap_id = ".(int)$value."");
			$checkcapsR = $checkcapsQ->result_array();
			
			if($checkcapsR!="")
			{
				//$breakdowntext[$key]="<h2>".$checkcapsR[0]["cap_name"]."</h2><p>".$checkcapsR[0]["description"]."</p>";
				$breakdowntext[$key]="<h2>".$checkcapsR[0]["cap_name"]."</h2>";
			}
		}
		
		
		
		if((int)$perccheck==1)
		{
			$breakdowni=$IMAGEPATH.'pdf_templates/breakdown_images/percentage/'.number_format($Orgcatratings[$Maincatid],1).'.jpg';
		}
		else
		{
			$breakdowni=$IMAGEPATH.'pdf_templates/breakdown_images/'.number_format($Orgcatratings[$Maincatid],1).'.png';
		}

    $html .= '<div class="page-logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
        <div class="site-name">
            orginsight.io
            <div class="green-box"></div>
        </div>
    </div>
    <div class="page-header page6-header">
        <h1 class="page6-headline">'.strtoupper($Maincatname).' DETAILED BREAKDOWN</h1>
        <p>
            The next section includes your ratings for the '.$Maincatname2.' category. Each question includes the results of your Selfassessment score compared to the average scores of the individuals you invited to respond as well as the negative or positive gap in scores
        </p>
    </div>
    <div class="clear-fix"></div>
    <div class="creating-purpose-wrapper">
        <div class="creating-purpose">
            <div class="left">
                <img src="'.$breakdowni.'" width="100">
                <span>CATEGORY SCORE</span>
            </div>
            <div class="middle">
                <div class="title">'.strtoupper($Maincatname).'</div>
                <p>
                    '.$desctext[(int)$Maincatid];
					
					if((int)$Maincatid < 4)
					{
						$html .= '<br><br>';
					}
					if((int)$Maincatid < 4 && (int)$Maincatid > 1)
					{
						$html .= '<br>';
					}
					
                $html .= '</p>
            </div>
            <div class="right">
                <h6>Pay attention to flags</h6>
                <div>
                    <img src="'.$IMAGEPATH.'pdf_templates/images/green_flag_bg.png" width="40">
                    <span>
                        Hidden Talent: You have rated<br>yourself lower than your respondents rated you. Action: Consider trying to build on this strength
                    </span>
                </div>
                <div class="second">
                    <img src="'.$IMAGEPATH.'pdf_templates/images/red_flag_bg.png" width="40">
                    <span>
                        Blind Spot: You have rated yourself higher than your respondents rated you. Action: Identify actions you can take to improve in this area
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="container page6">';
	
		$currentquestion=0;
			foreach($breakdowntext as $bkey=>$bvalue)
			{
			
				$currentquestion++;
				$first="first";
				$specialtop="score-graph";
				if((int)$Maincatid > 1 && (int)$Maincatid < 5)
				{
					$specialtop="score-graph2";
				}
				if($currentquestion > 1)
				{
					$first="";
				}
				$first="";
			
				$value=(int)$Orgcaps[(int)$breakdownid[$bkey]];
				
				if($Orgcapsq[(int)$breakdownid[$bkey]] > 0)
				{
					$OrgcapratingC=$value/$Orgcapsq[(int)$breakdownid[$bkey]];
				}
				else
				{
					$OrgcapratingC=0;
				}
				//
				$value=(int)$caps[(int)$breakdownid[$bkey]];
				
				if($capsq[(int)$breakdownid[$bkey]] > 0)
				{
					$capratingC=$value/$capsq[(int)$breakdownid[$bkey]];
				}
				else
				{
					$capratingC=0;
				}
				
				$orgsc=number_format($OrgcapratingC,1);
				$orgscp=$orgsc*100;
				$orgscp/=5;
				$orgscp=number_format($orgscp,0);
				
				$yoursc=number_format($capratingC,1);
				$yourscp=$yoursc*100;
				$yourscp/=5;
				$yourscp=number_format($yourscp,0);
				
				$gap=$OrgcapratingC-$capratingC;
				$Gap1=$gap*$multiplybyP;
				$Gap2=number_format($Gap1,(int)$numberformat);
				
				$orgscp=number_format($orgsc*20,0);
				$yourscp=number_format($yoursc*20,0);
				if($yourscp==100)
				{
					$yourscp=99;
				}
				
				$orgscp=number_format($orgsc*45,0);
				$yourscp=number_format($yoursc*45,0);
				
				if($yourscp==225)
				{
					$yourscp=247;
				}
				else if($yourscp > 180)
				{
					$yourscp+=20;
				}
				else if($yourscp > 135)
				{
					$yourscp+=15;
				}
				else if($yourscp > 90)
				{
					$yourscp+=10;
				}
				else if($yourscp > 45)
				{
					$yourscp+=5;
				}
				//
				if($orgscp==225)
				{
					$orgscp=250;
				}
				else if($orgscp > 180)
				{
					$orgscp+=20;
				}
				else if($orgscp > 135)
				{
					$orgscp+=15;
				}
				else if($orgscp > 90)
				{
					$orgscp+=10;
				}
				else if($orgscp > 45)
				{
					$orgscp+=5;
				}
				
				
				
				//end check
        $html .= '<div class="'.$specialtop.' page6-score-graph '.$first.'">
            <div class="round-wrapper">
                <div class="round">'.$bkey.'</div>
            </div>
            <div class="right-section">
                <div class="title">'.$bvalue.'</div>
                <small>YOUR SCORE</small>
                <div class="middle-wrapper">
                    <div class="main-graphs">
                        <div class="graph-wrapper graph-wrapper-1">
                            <div class="progress" style="border-left: 0px !important;width: '.$yourscp.'px"></div>
                            <div class="graph-box '.$first.'"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                        </div>
                        <div class="graph-wrapper graph-wrapper-2">
                            <div class="progress" style="border-left: 0px !important;width: '.$orgscp.'px"></div>
                            <div class="graph-box '.$first.'"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                            <div class="graph-box"></div>
                        </div>
                    </div>
                    <div class="graph-rating">
                        <div class="rate-1">
                            '.number_format(($yoursc*$multiplybyP),(int)$numberformat).$displaysign.'
                        </div>
                        <div class="rate-2">
                            '.number_format(($orgsc*$multiplybyP),(int)$numberformat).$displaysign.'
                        </div>
                    </div>
                    <div class="gap">
                        <b>GAP</b> '.$Gap2.$displaysign.'
                    </div>
                    <div class="icon">';
					if($gap >=2)
						{
						$html .= '<img src="'.$IMAGEPATH.'pdf_templates/images/green_flag_bg.png" alt="">';
						
						}
						else if($gap <=-2)
						{
						$html .= '<img src="'.$IMAGEPATH.'pdf_templates/images/red_flag_bg.png" alt="">';
						
						}
                        
                    $html .= '</div>
                </div>
                <small>ORGINSIGHTS SCORE</small>
            </div>
        </div>
        <div class="clear-fix"></div>';
		}
        
    $html .= '</div>
    ';
	}
    $html .= '<div class="page_break"></div><!-- Page 7 -->
    <div class="page-logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
        <div class="site-name">
            orginsight.io
            <div class="green-box"></div>
        </div>
    </div>
    <div class="page-header page7-header">
        <h1 class="main-headline">CONCLUSION</h1>
    </div>
    <div class="clear-fix"></div>
    <div class="container page7-container">
        <p>Hi '.$this->session->userdata('first_name').' '.$this->session->userdata('last_name').',</p>
        <p> Thank you for taking the time to complete our assessment and congratulations on taking a step towards better understanding yourself and learning what you need to do to get ahead in life and your career. Below, we have some advice on how to better leverage your Behavioural strengths as well as how to work on improving your development opportunities.</p>
        <p>
            <b>Behavioural strengths: (top scoring & hidden talent)</b> <br>
            The goal of this assessment is to help you gain a better sense of self-awareness which is known to be strongly linked to better job performance. As a next step, take some time to reflect on your results. You may discover that you are likely to perform well in tasks and responsibilities that tap into your strengths. You can also think about your natural strengths from a motivational perspective. You are likely to be more motivated to perform activities that you prefer, and your strengths are also likely to determine the environments that you enjoy. It\'s thus important to play to your strengths and figure out the type of work that you are naturally more inclined to excel in and enjoy doing, which would also lead to high level of job satisfaction in addition to superior performance.
        </p>
        <p>
            For each strength that you are now aware of, try to be as objective as you can when looking at the relationship between your performance and your strengths. We highly suggest that you build on the strengths identified in this assessment by thinking about what you can start or continue doing in order to further leverage your natural abilities. Also keep in mind that as you reflect on these strengths, be aware of when you might be relying too heavily on a certain strength that may lead to unbalanced results.
        </p>
        <p>
        <b>Development opportunities: (lowest scoring & blind spots)</b> <br>
            As a result of this report, you are now also aware of potential developmental opportunities. These are behaviours that may not play to your intrinsic inclinations but are still important for the high performance. The results of your assessment indicate that these behaviours may not come naturally to you when compared to that of your strengths as discussed above. Thus, activities that require these behaviours may not feel engaging or rewarding to you, and you may be less motivated to perform these activities and they may also take longer to do while requiring more efforts from you.
        </p>
        <p>
            The next step to take in order to improve on your development areas would be to work in conjunction with your manager/mentor/coach/create an action plan for the behavioural changes that would be the most beneficial for you to work on in order to see the greatest change in your performance. We suggest following the SMART goal setting technique so that your goals are specific, measurable, attainable, realistic, and time bound. The reason why we recommend doing this with someone else is so that they can keep you accountable and give you guidance and feedback as you embark on the journey to make these changes.
        </p>
        <div class="sig">
            <img src="'.$IMAGEPATH.'pdf_templates/images/sig.png" alt="" width="120">
            <div>
                Sean William Scott<br>
                Director, OrgInsights
            </div>
        </div>
    </div>

    <div class="page_break"></div>
    <!-- Page 8 -->
    <div class="page-logo">
        <img src="'.$IMAGEPATH.'pdf_templates/images/logo.png" alt="">
        <div class="site-name">
            orginsight.io
            <div class="green-box"></div>
        </div>
    </div>
    <div class="page-header page8-header">
        <h2 class="main-headline">UNLOCK NEXT LEVEL INSIGHTS</h2>
        <p>
            <b>Compare yourself to your peers</b> <br>
            Contact us for information on how to gain access to your Additional Responsive Report where you can compare yourself to your peers.</p>
    </div>
    <div class="clear-fix"></div>
    <div class="page8-container">
        <div class="legends">
            <div class="green">
                <p><img src="'.$IMAGEPATH.'pdf_templates/images/green.png" alt="" width="15"> Your Self-Score</p>
            </div>
            <div class="blue">
                <p><img src="'.$IMAGEPATH.'pdf_templates/images/blue.png" alt="" width="15"> Population Self-Score</p>
            </div>
        </div>
        <div class="clear-fix"></div>
        <div class="visual-graph-left">
            <div class="graph-item">
                <div class="graph-title">
                    <div class="letter">L</div>
                    <div>
                        <span>IMITS RISK</span>
                    </div>
                </div>
                <div class="progress-names">
                    <div class="name-item">Scans for Political & External impacts</div>
                    <div class="name-item">Reasons Critically & Solves Problems</div>
                    <div class="name-item red">Manages Risks</div>
                    <div class="name-item">Establishes Governance</div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div class="graph-item">
                <div class="graph-title">
                    <div class="letter">E</div>
                    <div>
                        <span>MBRACES <br> AGILITY</span>
                    </div>
                </div>
                <div class="progress-names">
                    <div class="name-item">Scans for Political & External impacts</div>
                    <div class="name-item">Reasons Critically & Solves Problems</div>
                    <div class="name-item red">Manages Risks</div>
                    <div class="name-item">Establishes Governance</div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div class="graph-item">
                <div class="graph-title">
                    <div class="letter">L</div>
                    <div>
                        <span>IMITS RISK</span>
                    </div>
                </div>
                <div class="progress-names">
                    <div class="name-item">Scans for Political & External impacts</div>
                    <div class="name-item">Reasons Critically & Solves Problems</div>
                    <div class="name-item red">Manages Risks</div>
                    <div class="name-item">Establishes Governance</div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div class="graph-item">
                <div class="graph-title">
                    <div class="letter">E</div>
                    <div>
                        <span>MBRACES <br> AGILITY</span>
                    </div>
                </div>
                <div class="progress-names">
                    <div class="name-item">Scans for Political & External impacts</div>
                    <div class="name-item">Reasons Critically & Solves Problems</div>
                    <div class="name-item red">Manages Risks</div>
                    <div class="name-item">Establishes Governance</div>
                </div>
            </div>
            <div class="clear-fix"></div>
            <div class="graph-item">
                <div class="graph-title">
                    <div class="letter">E</div>
                    <div>
                        <span>MBRACES <br> AGILITY</span>
                    </div>
                </div>
                <div class="progress-names">
                    <div class="name-item">Scans for Political & External impacts</div>
                    <div class="name-item">Reasons Critically & Solves Problems</div>
                    <div class="name-item red">Manages Risks</div>
                    <div class="name-item">Establishes Governance</div>
                </div>
            </div>
        </div>
        <div class="visual-graph-right">
            <div class="graph-item">
                <div class="draw-lines">
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                </div>
                
                <div class="row-item">
                    <div class="green-graph" style="width: 20%;"></div>
                    <div class="blue-graph" style="width: 60%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 90%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 80%;"></div>
                    <div class="blue-graph" style="width: 30%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 10%;"></div>
                </div>
                <img src="'.$IMAGEPATH.'pdf_templates/images/green_flag.png" alt="" class="flag">
            </div>
            <div class="graph-item">
                <div class="draw-lines">
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                </div>
                
                <div class="row-item">
                    <div class="green-graph" style="width: 20%;"></div>
                    <div class="blue-graph" style="width: 60%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 90%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 80%;"></div>
                    <div class="blue-graph" style="width: 30%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 13%;"></div>
                    <div class="blue-graph" style="width: 10%;"></div>
                </div>
                <img src="'.$IMAGEPATH.'pdf_templates/images/green_flag.png" alt="" class="flag">
            </div>
            <div class="graph-item">
                <div class="draw-lines">
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                </div>
                
                <div class="row-item">
                    <div class="green-graph" style="width: 20%;"></div>
                    <div class="blue-graph" style="width: 60%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 90%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 80%;"></div>
                    <div class="blue-graph" style="width: 30%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 10%;"></div>
                </div>
                <img src="'.$IMAGEPATH.'pdf_templates/images/green_flag.png" alt="" class="flag">
            </div>
            <div class="graph-item">
                <div class="draw-lines">
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                </div>
                
                <div class="row-item">
                    <div class="green-graph" style="width: 20%;"></div>
                    <div class="blue-graph" style="width: 60%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 90%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 80%;"></div>
                    <div class="blue-graph" style="width: 30%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 13%;"></div>
                    <div class="blue-graph" style="width: 10%;"></div>
                </div>
                <img src="'.$IMAGEPATH.'pdf_templates/images/green_flag.png" alt="" class="flag">
            </div>
            <div class="graph-item">
                <div class="draw-lines">
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                    <div class="box first"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box"></div>
                    <div class="box last"></div>
                </div>
                
                <div class="row-item">
                    <div class="green-graph" style="width: 20%;"></div>
                    <div class="blue-graph" style="width: 60%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 60%;"></div>
                    <div class="blue-graph" style="width: 90%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 80%;"></div>
                    <div class="blue-graph" style="width: 30%;"></div>
                </div>
                <div class="row-item">
                    <div class="green-graph" style="width: 13%;"></div>
                    <div class="blue-graph" style="width: 10%;"></div>
                </div>
                <img src="'.$IMAGEPATH.'pdf_templates/images/green_flag.png" alt="" class="flag">
            </div>
        </div>
        <div class="clear-fix"></div>
        <br><br>
        <img src="'.$IMAGEPATH.'pdf_templates/images/page8_btns.png" alt="" width="100%">
    </div>
    <div class="clear-fix"></div>
    <div class="footer">
        <p>Copyrights 2021 Orginsights. All Rights Reserved</p>
    </div>
</body>
</html>';

//echo $html; die();
?>