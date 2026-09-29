<?php
//print_r($_SESSION); 
$IMAGEPATH=$_SERVER['DOCUMENT_ROOT']."/app/application/views/"; 

$order_id=75;

//die();
/*
.chart-bottom  img {
    width: 50px !important;
	}
.chart-bottom .right img {
    width: 50px !important;
}
*/
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Industry & Development Report</title>
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
	

.summary-box {
    height: 370px !important;
	}
.creating-purpose .right {
    width: 200px;
}	
.radius-box {
font-size: 10px; !important;
height:150px !important;
}
.radius-box2 {
height:165px !important;
}
.icon-text{height:100px !important;}
.summary-box {padding-top:2px !important;}

img{border:0px !important;border-style: none !important;outline:0px !important;outline: none !important;}
</style>
    <!-- Page 1 -->
    
    <div class="text-center">
        <center><h1 class="main-title">
            Industry & Development Report
        </h1>
        <h2 class="main-title__sub">'.$this->session->userdata('first_name').' '.$this->session->userdata('last_name').'</h2><br>';
		
			
				$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
				$order_dateT=$timestamp;
				
				//calc hours
				$diff=$timestamp-$order_dateT;
				
				$hours=$diff/3600;
				
				$hours=(int)$hours;
				/*Date: <?php echo date("d");?><sup><?php echo date("S");?></sup> <?php echo date("F");?> <?php echo date("Y");?>*/
				
		
        $html .= '<span>'.date("F d, Y",$order_dateT).'</span></center>
    </div>
    <div class="page_break"></div>

    <!-- Page 2 -->';

    
    
	//

$breakdownid=array();
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
		
            
			}
		}
            
            
	
	}
	
}	
	
    
	
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
//$order_id=15;

$checkreponsesQ = $this->db->query("SELECT * FROM `View_User_Responses` where user_id =".$user_id." and order_id=".$order_id);

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
			
			
			
            
	
	$catlists=array(1,2,3,4,5);
	$catlistsname=array("LIMITS RISK","EMBRACES AGILITY","ACHIEVES EXCELLENCE","DEVELOPS RELATIONSHIPS","SETS PURPOSE");
	
		
		
		
		
        $html .= '<div class="clear-fix"></div>
    </div>';
    
           
            
    $cnt=0;   
    $html .= '<br><br><div style="float:left;border:1px solid #cccccc;padding:20px;width:45%;" class="col-md-6">
	<h4>Top Capabilities</h4>';
	
	
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
				$breakdowntext[$key]="".$checkcapsR[0]["cap_name"]."<br>";
				
				
			}
		}
		
		
		
		if((int)$perccheck==1)
		{
			$breakdowni=$IMAGEPATH.'pdf_templates/breakdown_images/percentage/'.number_format($Orgcatratings[$Maincatid],1).'.png';
		}
		else
		{
			$breakdowni=$IMAGEPATH.'pdf_templates/breakdown_images/Green-'.number_format($Orgcatratings[$Maincatid],1).'.png';
		}

    $html .= '
    
	
	';
	
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
				
				
				//echo $yoursc;
				//end check
			if(number_format(($yoursc*$multiplybyP),(int)$numberformat) > 80)
			{	
			$html .= $bvalue;
			$cnt++;
			
			//break;
			}
		}
        
    $html .= '
    ';
	//break;
	}
	
	if($cnt==0)
	{
		$html .= 'No Capability Found';
	}
	
	//60 below
	$cnt=0;
	$html .= '</div><div style="float:left;border:1px solid #cccccc;padding:20px;width:45%;margin-left:4px;" class="col-md-6">
	<h4>Areas of Development</h4>';
	
	
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
				$breakdowntext[$key]="".$checkcapsR[0]["cap_name"]."<br>";
				
				
			}
		}
		
		
		
		if((int)$perccheck==1)
		{
			$breakdowni=$IMAGEPATH.'pdf_templates/breakdown_images/percentage/'.number_format($Orgcatratings[$Maincatid],1).'.png';
		}
		else
		{
			$breakdowni=$IMAGEPATH.'pdf_templates/breakdown_images/Green-'.number_format($Orgcatratings[$Maincatid],1).'.png';
		}

    $html .= '
    
	
	';
	
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
				
				
				//echo $yoursc;
				//end check
			if(number_format(($yoursc*$multiplybyP),(int)$numberformat) <= 60)
			{	
			$html .= $bvalue;
			$cnt++;
			
			//break;
			}
		}
        
    $html .= '
    ';
	//break;
	}
	if($cnt==0)
	{
		$html .= 'No Capability Found';
	}
   
   $html .= '</div><div style="float:left;border:1px solid #cccccc;padding:20px;width:100%;margin-left:4px;" class="col-md-12">
	<center><h4>Industries most aligned to:</h4>BEST Match</center>';
	
	$html .= '</div><div style="float:left;border:1px solid #cccccc;padding:20px;width:100%;margin-left:4px;" class="col-md-12">
	<center><h4>Areas of development</h4>Advanced</center></div>';
	
    $html.='<div class="clear-fix"></div>
   
</body>
</html>';

//echo $html; die();
?>
