<!Doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OrgInsights</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/industryreport/style.css?v=<?php echo date("His");?>" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/industryreport/responsive.css?v=<?php echo date("His");?>" type="text/css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <header class="site-header">
        <div class="logo">
            <img src="<?php echo base_url();?>assets/industryreport/Images/Logo.png" />
        </div>
    </header>
    <div class="clear"></div>
 <!-------------------------------------------------------
	HOME SECTION
-------------------------------------------------------->	
<?php
//print_r($_SESSION); 
$IMAGEPATH=$_SERVER['DOCUMENT_ROOT']."/app/application/views/"; 

//$user_id=(int)$this->session->userdata('user_id');
//echo $order_id;
//$order_id=10000;
//$user_id=3; 

$capdesc=array();
$capdescid=array();
$capdescname=array();
$checkreponsesQ = $this->db->query("SELECT * from capabilities order by cap_id");
$checkreponsesR = $checkreponsesQ->result_array();
foreach($checkreponsesR as $key=>$value)
{
	$capdesc[$value["cap_name"]]=$value["description"];
	$capdescid[$value["cap_id"]]=$value["description"];
	$capdescidname[$value["cap_id"]]=$value["cap_name"];
}

//
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$order_dateT=$timestamp;

//calc hours
$diff=$timestamp-$order_dateT;

$hours=$diff/3600;

$hours=(int)$hours;
/*Date: <?php echo date("d");?><sup><?php echo date("S");?></sup> <?php echo date("F");?> <?php echo date("Y");?>*/
//
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

$checkreponsesQ = $this->db->query("SELECT * FROM `View_User_Responses` where order_id=".$order_id);

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	//echo (int)$value["order_id"];
	
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
	


//die();
/*
.chart-bottom  img {
    width: 50px !important;
	}
.chart-bottom .right img {
    width: 50px !important;
}
*/
?>
    <div class="page-title" style="background-image: url('<?php echo base_url();?>assets/industryreport/Images/BG-header.jpg');">
        <div class="container">
            <h1>Industry & Development Report</h1>
            <h3><?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?></h3>
            <p><?php echo date("F d, Y",$order_dateT);?></p>
        </div>
    </div>
    <div class="clear"></div>

    <div class="toparea-section">
        <div class="container">
            <div class="wrapper">
                <div class="toparea-inner lft-top" id="top-capabilities">
                    <div class="title-section">
                        <img src="<?php echo base_url();?>assets/industryreport/Images/topcapabilities-icon.png" class="icon" />
                        <div class="title-con">
                            <h3>Top Capabilities</h3>
                            <p>Capabilities above 70% score</p>
                        </div>
                    </div>
                    <div class="score-content progress-container">
                        <ul>
							<?php
							$Criticalcaps="'-1'";
							$checkcapsQ = $this->db->query("SELECT * from IndustryLevels where (Title like '%CRITICAL%' or Source like '%CRITICAL%')");
							$checkcapsR = $checkcapsQ->result_array();
							
							foreach($checkcapsR as $Lkey=>$Lvalue)
							{
							
								$checkcapsQ2 = $this->db->query("SELECT * from IndustryCapabilities where capabilityID = ".(int)$Lvalue["Capability"]."");
								
								
								
								$checkcapsR2 = $checkcapsQ2->result_array();
								foreach($checkcapsR2 as $Lkey4=>$Lvalue4)
								{
									$Criticalcaps.=",'".$Lvalue4["IndustryName"]."'";
								}
								
							}
							
							
							
							
							$Industriesmostaligned=array("");
							
							$BESTMatch=array("");
							$Critical=array("");
							$critical=array(-1);
							$BESTcap=array(-1);
							$totalcaps=0;
							$cnt=0;
							$html="";
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
								$breakdowntextid=array();
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
										$breakdowntextid[$key]=(int)$value;
										
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

							$html .= '';
							
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
									if(number_format(($orgsc*$multiplybyP),(int)$numberformat) > 70)
									{	
										$cnt++;
										
										if($cnt <= 10)
										{
										if($cnt>=9)
										{
										$html.='<li class="topid1">
														<div class="progress-circle" data-progress="'.number_format(($orgsc*$multiplybyP),(int)$numberformat).'"><span class="progress-text"></span>
														</div>
														<h3 class="topid2">'.$bvalue.'</h3>
													</li>';
													
										}
										else
										{
										?>
										<li>
														<div class="progress-circle" data-progress="<?php echo number_format(($orgsc*$multiplybyP),(int)$numberformat);?>"><span class="progress-text"></span>
														</div>
														<h3><?php echo $bvalue;?></h3>
													</li>
										<?php			
													
										}
										
										
											$checkcapsQ2 = $this->db->query("SELECT * from IndustryCapabilities where capabilityID = ".(int)$breakdowntextid[$bkey]."");
											
											
											
											$checkcapsR2 = $checkcapsQ2->result_array();
											foreach($checkcapsR2 as $Lkey4=>$Lvalue4)
											{
												
													$BESTMatch[$Lvalue4["IndustryName"]]=$Lvalue4["IndustryName"];
													
													$BESTcap[]=(int)$breakdowntextid[$bkey];
													
													if(number_format(($orgsc*$multiplybyP),(int)$numberformat) >= 80)
													{
														$Industriesmostaligned[$Lvalue4["IndustryName"]]=$Lvalue4["IndustryName"];
														
														
														$critical[]=(int)$breakdowntextid[$bkey];
													}
												
											}
											
											
											//
										
										$totalcaps++;
										//break;
										}
									}
									if($cnt >= 10)
									{
										//break;
									}
									
								}
								
							
							//break;
								if($totalcaps >= 10)
								{
									//break;
								}
							}
							
							if($cnt==0)
							{
							?>
								No Capability Found
							<?php	
							}
							//die();
							?>
                        </ul>
                    </div>
					<?php
					if($cnt > 8)
					{
					?>
                    <a class="Click-here" data-target="modal1">Show More</a>
                    <div id="modal1" class="custom-model-main">
                        <div class="custom-model-inner">        
                        <div class="close-btn">×</div>
                            <div class="custom-model-wrap">
                                <div class="pop-up-content-wrap">
								<div class="score-content progress-container">
									<ul>
                                   <?php echo $html;?>
								   </ul>
								 </div>  
                                </div>
                            </div>  
                        </div>  
                        <div class="bg-overlay"></div>
                    </div>
					<?php
					}
					?>	
                </div>
                <div class="toparea-inner rgt-area" id="area-development">
                    <div class="title-section">
                        <img src="<?php echo base_url();?>assets/industryreport/Images/areadevelop-icon.png" class="icon" />
                        <div class="title-con">
                            <h3>Areas of Development</h3>
                            <p>Capabilities 70% or below score</p>
                        </div>
                    </div>
                    <div class="score-content progress-container">
                        <ul>
							<?php
							$IndustryLevels=array(-1);
							
							//$Industriesmostaligned=array("");
							//$BESTMatch=array("");
							$totalcaps=0;
							$cnt=0;
							$html="";
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
								$breakdowntextid=array();
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
										$breakdowntextid[$key]=(int)$value;
										
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

							$html .= '';
							
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
									if(number_format(($orgsc*$multiplybyP),(int)$numberformat) <= 70)
									{	
										$cnt++;
										if($cnt <= 10)
										{
										if($cnt>=9)
										{
										$html.='<li class="topid1">
														<div class="progress-circlered" data-progress="'.number_format(($orgsc*$multiplybyP),(int)$numberformat).'"><span class="progress-text"></span>
														</div>
														<h3 class="topid2">'.str_replace("/"," / ",$bvalue).'</h3>
													</li>';
													
										}
										else
										{
										?>
										<li>
														<div class="progress-circlered" data-progress="<?php echo number_format(($orgsc*$multiplybyP),(int)$numberformat);?>"><span class="progress-text"></span>
														</div>
														<h3><?php echo $bvalue;?></h3>
													</li>
										<?php			
													
										}
										
											//
											$checkcapsQ = $this->db->query("SELECT * from IndustryCapabilities where capabilityID = ".(int)$breakdowntextid[$bkey]." and Level='Critical'");
											
											$checkcapsR = $checkcapsQ->result_array();

											
											foreach($checkcapsR as $Lkey=>$Lvalue)
											{
											
												$checkcapsQ2 = $this->db->query("SELECT * from IndustryCapabilities  where IndustryName IN (".$Criticalcaps.") AND capabilityID = ".(int)$breakdowntextid[$bkey]." and Level='Critical'");
												$checkcapsR2 = $checkcapsQ2->result_array();
												foreach($checkcapsR2 as $Lkey4=>$Lvalue4)
												{
													
														$Industriesmostaligned[$Lvalue4["IndustryName"]]=$Lvalue4["IndustryName"];
														
														
														$critical[]=(int)$breakdowntextid[$bkey];
													
												}
												
											}	
											
										
											
											
											
											//
										$totalcaps++;
										//break;
										$IndustryLevels[(int)$breakdowntextid[$bkey]]=$bvalue;
										}
									}
									if($cnt >= 10)
									{
										//break;
									}
									
								}
								
							
							//break;
								if($totalcaps >= 10)
								{
									//break;
								}
							}
							
							if($cnt==0)
							{
							?>
								No Capability Found
							<?php	
							}
							//die();
							?>
                        </ul>
                    </div>
					<?php
					if($cnt > 8)
					{
					?>
                    <a class="Click-here" data-target="modal2">Show More</a>
                    <div id="modal2" class="custom-model-main">
                        <div class="custom-model-inner">        
                        <div class="close-btn">×</div>
                            <div class="custom-model-wrap">
                                <div class="pop-up-content-wrap">
								<div class="score-content progress-container">
									<ul>
                                   <?php echo $html;?>
								   </ul>
								 </div>  
                                </div>
                            </div>  
                        </div>  
                        <div class="bg-overlay"></div>
                    </div>
					<?php
					}
					?>	
                </div>
            </div>
        </div>
    </div>

    <div class="topindustry-section">
        <div class="container">
            <div class="title-section">
                <img src="<?php echo base_url();?>assets/industryreport/Images/topindustry-icon.png" class="icon" />
                <h3>TOP INDUSTRIES</h3>
				
            </div>
            <div class="tagline">
                <a href="#top-capabilities"><img src="<?php echo base_url();?>assets/industryreport/Images/Best-match-tag.png" class="icon" /></a>
				<p>You have all the critical and recommended capabilites required to be successful in the Industry<br><span style="background:#43ad68;color:#ffffff;padding:5px;font-size:14px;">Critical Capabilities to Success in Industry</span>&nbsp;&nbsp;<span style="background:#1453a1;color:#ffffff;padding:5px;font-size:14px;">Important Capabilities that will help you get ahead of the competition</span></p>
				
            </div>
			
            <div class="tabs-container">
                
                    <?php
					$endroll=(count($BESTMatch)-(count($BESTMatch) % 5))+5;
					$bestmatchdisplay="";
					$bestmatcharray1=array("");
					$bestmatcharray2=array("");
					//echo $endroll; die();
					
					$cnt=0;	
					$checkindustry=array("");
					for($roll=1;$roll<=$endroll;$roll++)
					{
						
						
						$checkroll=0;
						$endtab=$roll*5;
						$start=$endtab-5;
						$Totaltabs2=$cnt;
						
						$roll2=$start;
						
						if($start > 0)
						{
							//$endtab--;
						}
						
						if(($roll*5) <= $endroll)
						{	
						
							$bestmatchdisplay.='<div class="tabs">';
							
							
							//echo $checkroll." > ".$start."<br>";
							
							foreach($BESTMatch as $bmkey=>$bmvalue)
							{
								if($bmvalue!="" && $checkroll > $start && $checkroll <= $endtab)
								{
									$cnt++;
									$displaylevel="";
									if($cnt >= 11)
									{
										$displaylevel='display:none;';
									}
									
									if(in_array($bmvalue,$bestmatcharray1))
									{
									}
									else
									{	
									$bestmatcharray1[$bmvalue]=$bmvalue;
									$bestmatchdisplay.='
									<div style="'.$displaylevel.'" class="tab bestmatch" id="tabbutton_'.$cnt.'" onclick=\'showTabContent("content'.$cnt.'");activatebutton('.$cnt.')\'>'.$bmvalue.'</div>
									';
									}
								
									//$html .= $bmvalue;
									$checkindustry[$bmvalue]=$bmvalue;
									
								}
								$checkroll++;
							}
							
							if($checkroll > 0)
							{
							$bestmatchdisplay.='</div><div class="tab-content">';
							}
							
							//
							$checkroll=0;
							$endtab=$roll*5;
							$start=$endtab-5;
							
							$cnt=$Totaltabs2;
							
							//echo $roll2." > ".$start;
							//die();
							
							foreach($BESTMatch as $bmkey=>$bmvalue)
							{
								if($bmvalue!="" && $checkroll > $start && $checkroll <= $endtab)
								{
									$cnt++;
									if(in_array($bmvalue,$bestmatcharray2))
									{
									}
									else
									{	
									$bestmatcharray2[$bmvalue]=$bmvalue;
									$bestmatchdisplay.='<div style="grid-template-columns: 30% 70%;" id="content'.$cnt.'" class="inner-tabcon">';
									
									$checkcapsQ2 = $this->db->query("SELECT * from IndustryCapabilities where IndustryName = '".$bmvalue."' order by  categoryID");
									$catid=0;
									$checkcapsR2 = $checkcapsQ2->result_array();
									foreach($checkcapsR2 as $Lkey4=>$Lvalue4)
									{
										$putdescription=$capdescidname[$Lvalue4["capabilityID"]];
										if($catid!=$Lvalue4["categoryID"])
										{
											if($catid > 0)
											{
												$bestmatchdisplay.='</ul></div>';
											}
											
											$catname=$catlistsname[($Lvalue4["categoryID"]-1)];
											$putcatname="<b><big>".substr($catname,0,1)."</big></b>".substr($catname,1);
											
											$bestmatchdisplay.='<div style="float:left;padding:20px;background:#273e8f;color:#ffffff;">'.$putcatname.'</div><div style="float:left;"><ul style="margin:0px;padding: 0 0 0 0;" class="lft-con">';
											
											$catid=$Lvalue4["categoryID"];
										}
										
										$bgcolor="#1453a1;";
										if($Lvalue4["Level"]=="Critical")
										{
											$bgcolor="#43ad68;";	
										}
										
										if(in_array($Lvalue4["capabilityID"],$BESTcap))
										{
											$bestmatchdisplay.='<li style="background: '.$bgcolor.';" class="tick">'.$putdescription.'</li>';
										}
										else
										{
											$bestmatchdisplay.='<li style="background: '.$bgcolor.'" class="untick">'.$putdescription.'</li>';
										}
										
										
									
									}
										if($catid > 0)
										{
											$bestmatchdisplay.='</ul></div><div style="clear:both;"></div>';
										}
									
									$bestmatchdisplay.='</div>';
									}
									
								}
								$checkroll++;
							}
								if($checkroll > 0)
								{
								$bestmatchdisplay.='</div>';
								}						
								//
						}				
							
					}
					
					if($cnt==0)
					{
						$bestmatchdisplay.='No Capability Found';
					}
					
					echo $bestmatchdisplay;
					?>
                </div>

                
            </div>
			<?php
			if($cnt >= 11)
			{
			?>
            <a href="javascript:void(0)" onclick="showbestmatch()">Show More</a>
			<?php
			}
			?>
        </div>

	
    <div class="topindustry-section explore-section">
        <div class="container">
            <div class="title-section">
                <img src="<?php echo base_url();?>assets/industryreport/Images/explore-icon.png" class="icon" />
                <h3>industries to explore</h3>
            </div>
            <div class="tagline">
                <img src="<?php echo base_url();?>assets/industryreport/Images/Good-fit-tag.png" class="icon" />
                <p>You either have all the critical capabilities required 
or most of the overall capabilities required to be successful in the Industry<br><span style="background:#43ad68;color:#ffffff;padding:5px;font-size:14px;">Critical Capabilities to Success in Industry</span>&nbsp;&nbsp;<span style="background:#1453a1;color:#ffffff;padding:5px;font-size:14px;">Important Capabilities that will help you get ahead of the competition</span></p>
            </div>
            	<?php
	$Totaltabs=$cnt;
	$Totaltabs2=$Totaltabs;
	?>
	<div class="tabs-container">
                
                    <?php
					$endroll=(count($Industriesmostaligned)-(count($Industriesmostaligned) % 5))+5;
					$Industriesmostaligneddisplay="";
					$Industriesmostalignedarray1=array("");
					$Industriesmostalignedarray2=array("");
					//echo $endroll; die();
					
					$cnt=0;	
					$checkindustry=array("");
					for($roll=1;$roll<=$endroll;$roll++)
					{
						
						
						$checkroll=0;
						$endtab=$roll*5;
						$start=$endtab-5;
						$Totaltabs2=$Totaltabs;
						
						$roll2=$start;
						
						if($start > 0)
						{
							//$endtab--;
						}
						
						if(($roll*5) <= $endroll)
						{	
						
							$Industriesmostaligneddisplay.='<div class="tabs">';
							
							
							//echo $checkroll." > ".$start."<br>";
							
							foreach($Industriesmostaligned as $bmkey=>$bmvalue)
							{
								if($bmvalue!="" && $checkroll > $start && $checkroll <= $endtab)
								{
									$cnt++;  $Totaltabs++;
									$displaylevel="";
									if($cnt >= 11)
									{
										$displaylevel='display:none;';
									}
									
									if(in_array($bmvalue,$Industriesmostalignedarray1))
									{
									}
									else
									{	
									$Industriesmostalignedarray1[$bmvalue]=$bmvalue;
									$Industriesmostaligneddisplay.='
				<div style="'.$displaylevel.'" class="ite tab" id="tabbutton_'.$Totaltabs.'" onclick=\'showTabContent("content'.$Totaltabs.'");activatebutton('.$Totaltabs.')\'>'.$bmvalue.'</div>
				';
									}
								
									//$html .= $bmvalue;
									$checkindustry[$bmvalue]=$bmvalue;
									
								}
								$checkroll++;
							}
							
							if($checkroll > 0)
							{
							$Industriesmostaligneddisplay.='</div><div class="tab-content">';
							}
							
							//
							$checkroll=0;
							$endtab=$roll*5;
							$start=$endtab-5;
							
							$cnt=$Totaltabs2;
							$Totaltabs=$Totaltabs2;
							
							//echo $roll2." > ".$start;
							//die();
							
							foreach($Industriesmostaligned as $bmkey=>$bmvalue)
							{
								if($bmvalue!="" && $checkroll > $start && $checkroll <= $endtab)
								{
									$cnt++;  $Totaltabs++;
									if(in_array($bmvalue,$Industriesmostalignedarray2))
									{
									}
									else
									{	
									$Industriesmostalignedarray2[$bmvalue]=$bmvalue;
									$Industriesmostaligneddisplay.='<div style="grid-template-columns: 30% 70%;" id="content'.$Totaltabs.'" class="inner-tabcon">
			';
									
									$checkcapsQ2 = $this->db->query("SELECT * from IndustryCapabilities where IndustryName = '".$bmvalue."' order by  categoryID");
									$catid=0;
									$checkcapsR2 = $checkcapsQ2->result_array();
									foreach($checkcapsR2 as $Lkey4=>$Lvalue4)
									{
										if($Lvalue4["Level"]=="Critical" || in_array($Lvalue4["capabilityID"],$critical))
										{
											$putdescription=$capdescidname[$Lvalue4["capabilityID"]];
											if($catid!=$Lvalue4["categoryID"])
											{
												if($catid > 0)
												{
													$Industriesmostaligneddisplay.='</ul></div>';
												}
												
												$catname=$catlistsname[($Lvalue4["categoryID"]-1)];
												$putcatname="<b><big>".substr($catname,0,1)."</big></b>".substr($catname,1);
												
												$Industriesmostaligneddisplay.='<div style="float:left;padding:20px;background:#273e8f;color:#ffffff;">'.$putcatname.'</div><div style="float:left;"><ul style="margin:0px;padding: 0 0 0 0;" class="lft-con">';
												
												$catid=$Lvalue4["categoryID"];
											}
										
											$bgcolor="#1453a1;";
											if($Lvalue4["Level"]=="Critical")
											{
												$bgcolor="#43ad68;";	
											}
											
											if(in_array($Lvalue4["capabilityID"],$critical))
											{
												$Industriesmostaligneddisplay.='<li style="background: '.$bgcolor.';" class="tick">'.$putdescription.'</li>';
											}
											else
											{
												$Industriesmostaligneddisplay.='<li style="background: '.$bgcolor.'" class="untick">'.$putdescription.'</li>';
											}
										
										}
									
									}
										if($catid > 0)
										{
											$Industriesmostaligneddisplay.='</ul></div><div style="clear:both;"></div>';
										}
									
									$Industriesmostaligneddisplay.='</div>';
									}
									
								}
								$checkroll++;
							}
								if($checkroll > 0)
								{
								$Industriesmostaligneddisplay.='</div>';
								}						
								//
						}				
							
					}
					
					if($cnt==0)
					{
						$Industriesmostaligneddisplay.='No Capability Found';
					}
					
					echo $Industriesmostaligneddisplay;
					?>
                </div>

                
            </div>
			<?php
			if($cnt >= 11)
			{
			?>
            <a href="javascript:void(0)" onclick="showitematch()">Show More</a>
			<?php
			}
			?>
        </div>
        </div>
    </div>

	</div></div>
    <div class="development-section">
        <div class="container">
            <div class="title-section">
                <img src="<?php echo base_url();?>assets/industryreport/Images/Linkedin-icon.png" class="icon" />
                <div class="title-con">
                    <h3>AREAS OF Development</h3>
                    <p><a style="color: #045497;" href="https://www.linkedin.com/learning/" target="_blank"><b>MUST HAVE A PREMIUM</b> Linkedin course to take advantage of this</a></p>
                </div>
				
            </div>
			
            <div class="tabs-container develop-tabs">
			<?php
			if(count($IndustryLevels) > 1)
	{
		
	
		for($roll=1;$roll<=4;$roll++)
		{
			echo '<div class="tabs">';
			
			$checkroll=0;
		
			$endtab=$roll*4;
			$start=$endtab-4;
			$Totaltabs2=$Totaltabs;
		
		foreach($IndustryLevels as $Lkey=>$Lvalue)
		{
			if($checkroll > $start && $checkroll <= $endtab)
			{
				if($Lkey > 0)
				{
					$Totaltabs++;
					echo '
					<div class="tab" onclick=\'openbeginner('.$Totaltabs.')\'>'.$Lvalue.'</div> 
					';
					
				}
			}
			$checkroll++;
		}
		
		echo '</div>
                <div class="tab-content">';
		
		//$cnt=0;
			$checkroll=0;
		
			$endtab=$roll*4;
			$start=$endtab-4;
			$Totaltabs=$Totaltabs2;
		foreach($IndustryLevels as $Lkey=>$Lvalue)
		{
			if($checkroll > $start && $checkroll <= $endtab)
			{
			if($Lkey > 0)
			{
			$cnt++;
			$Totaltabs++;
			
			$displaylevel="";
			if($cnt > 1)
			{
			$displaylevel='display:none;';
			}
			$displaylevel='display:none;';
		
		echo '<div id="content'.$Totaltabs.'" class="inner-tabcon">
		
                        <div class="nested-tabs">
                            <div class="nested-tab" onclick=showNestedTabContent("nestedContent'.$Totaltabs.'1")>Beginners
                            </div>
                            <div class="nested-tab" onclick=showNestedTabContent("nestedContent'.$Totaltabs.'2")>Intermediate
                            </div>
                            <div class="nested-tab" onclick=showNestedTabContent("nestedContent'.$Totaltabs.'3")>Advanced</div>
                            <button id="closeAllTabs">X</button>
                        </div><div class="nested-tab-content">';
				
				echo '<div id="nestedContent'.$Totaltabs.'1" class=" inner-nested-tabcon active">';
				
				$Courses=array("");
				$Videos=array("");
				$Others=array("");
				$Title="";
				$checkcapsQ = $this->db->query("SELECT * from IndustryLevels where Capability = ".(int)$Lkey." and Level='Beginner'");
				$checkcapsR = $checkcapsQ->result_array();
				foreach($checkcapsR as $Lkey2=>$Lvalue2)
				{
					if($Title=="")
					{
						$Title=$Lvalue2["Title"];
						//echo '<h4>'.$Title.'</h4>';
					}
					$Title=$Lvalue2["Title"];
					
					if(strtoupper($Lvalue2["Type"])=="COURSE")
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						else if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						
						
						$Courses[]='
						<li class="course">
						<Strong>Course Name: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span></li>';
					}
					else if(strtoupper($Lvalue2["Type"])=="VIDEO")
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						else if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						//$Author="";
					
						$Videos[]='
						<li class="video">
							<Strong>Title: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Type:</Strong> '.$Lvalue2["Type"].'</span><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span>
						</li>
						';

					}
					else
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						else if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						$Videos[]='
						<li class="pdf">
							<Strong>Title: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Type:</Strong> '.$Lvalue2["Type"].'</span><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span>
						</li>
						';

					}
					
					
				}
				
				echo '<h3>'.$capdescidname[(int)$Lkey].' - Beginner</h3>
                                <p>'.$capdescid[(int)$Lkey].'</p>';
				
				if(count($Videos) > 1)
				{
					echo '<h4>Videos & Other Contents</h4>
                                <ul>';
					foreach($Videos as $Skey=>$Svalue)
					{
						if($Svalue!="")
						{
							echo $Svalue;
						}
					}
					echo '</ul>';
				}
				if(count($Courses) > 1)
				{
					echo '<h4>Courses</h4>
                                <ul>';
					foreach($Courses as $Skey=>$Svalue)
					{
						if($Svalue!="")
						{
							echo $Svalue;
						}
					}
					echo '</ul>

';
				}
				
				
				echo '</div>
'; //b
				
echo '<div id="nestedContent'.$Totaltabs.'2" class="inner-nested-tabcon">';
				
				$Courses=array("");
				$Videos=array("");
				$Others=array("");
				$Title="";
				$checkcapsQ = $this->db->query("SELECT * from IndustryLevels where Capability = ".(int)$Lkey." and Level='Intermediate'");
				$checkcapsR = $checkcapsQ->result_array();
				foreach($checkcapsR as $Lkey2=>$Lvalue2)
				{
					if($Title=="")
					{
						$Title=$Lvalue2["Title"];
						//echo '<h4>'.$Title.'</h4>';
					}
					$Title=$Lvalue2["Title"];
					
					if(strtoupper($Lvalue2["Type"])=="COURSE")
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						else if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						
						
						$Courses[]='
						<li class="course">
						<Strong>Course Name: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span></li>';
					}
					else if(strtoupper($Lvalue2["Type"])=="VIDEO")
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						else if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						//$Author="";
					
						$Videos[]='
						<li class="video">
							<Strong>Title: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Type:</Strong> '.$Lvalue2["Type"].'</span><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span>
						</li>
						';

					}
					else
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						else if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						$Videos[]='
						<li class="pdf">
							<Strong>Title: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Type:</Strong> '.$Lvalue2["Type"].'</span><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span>
						</li>
						';

					}
					
					
				}
				
				echo '<h3>'.$capdescidname[(int)$Lkey].' - Intermediate</h3>
                                <p>'.$capdescid[(int)$Lkey].'</p>';
				
				if(count($Videos) > 1)
				{
					echo '<h4>Videos & Other Contents</h4>
                                <ul>';
					foreach($Videos as $Skey=>$Svalue)
					{
						if($Svalue!="")
						{
							echo $Svalue;
						}
					}
					echo '</ul>';
				}
				if(count($Courses) > 1)
				{
					echo '<h4>Courses</h4>
                                <ul>';
					foreach($Courses as $Skey=>$Svalue)
					{
						if($Svalue!="")
						{
							echo $Svalue;
						}
					}
					echo '</ul>

';
				}
				
				echo '</div>
'; //i				
				
				echo '<div id="nestedContent'.$Totaltabs.'3" class="inner-nested-tabcon">';
				
				$Courses=array("");
				$Videos=array("");
				$Others=array("");
				$Title="";
				$checkcapsQ = $this->db->query("SELECT * from IndustryLevels where Capability = ".(int)$Lkey." and Level='Advanced'");
				$checkcapsR = $checkcapsQ->result_array();
				foreach($checkcapsR as $Lkey2=>$Lvalue2)
				{
					if($Title=="")
					{
						$Title=$Lvalue2["Title"];
						//echo '<h4>'.$Title.'</h4>';
					}
					$Title=$Lvalue2["Title"];
					
					if(strtoupper($Lvalue2["Type"])=="COURSE")
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						else if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						
						
						$Courses[]='
						<li class="course">
						<Strong>Course Name: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span></li>';
					}
					else if(strtoupper($Lvalue2["Type"])=="VIDEO")
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						else if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						//$Author="";
					
						$Videos[]='
						<li class="video">
							<Strong>Title: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Type:</Strong> '.$Lvalue2["Type"].'</span><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span>
						</li>
						';

					}
					else
					{
						$Author="";
						if(strpos("*".$Lvalue2["Source"],"By: ") > 0)
						{
							$Author="Source: ".str_replace("By: ","",$Lvalue2["Source"]);
						}
						else if(strpos("*".$Lvalue2["Source"],"From the course: ") > 0)
						{
							$Author="Source: ".str_replace("From the course: ","",$Lvalue2["Source"]);
							//$Author="From the course";
						}
						$Videos[]='
						<li class="pdf">
							<Strong>Title: </Strong><a href="'.$Lvalue2["Link"].'" target="_blank" alt="'.$Author.'" title="'.$Author.'">'.$Title.'</a><span><Strong> | Type:</Strong> '.$Lvalue2["Type"].'</span><span><Strong> | Length:</Strong> '.$Lvalue2["Length"].'</span>
						</li>
						';

					}
					
					
				}
				
				echo '<h3>'.$capdescidname[(int)$Lkey].' - Advanced</h3>
                                <p>'.$capdescid[(int)$Lkey].'</p>';
				
				if(count($Videos) > 1)
				{
					echo '<h4>Videos & Other Contents</h4>
                                <ul>';
					foreach($Videos as $Skey=>$Svalue)
					{
						if($Svalue!="")
						{
							echo $Svalue;
						}
					}
					echo '</ul>';
				}
				if(count($Courses) > 1)
				{
					echo '<h4>Courses</h4>
                                <ul>';
					foreach($Courses as $Skey=>$Svalue)
					{
						if($Svalue!="")
						{
							echo $Svalue;
						}
					}
					echo '</ul>

';
				}
				
				echo '</div>
'; //a				

				
				echo '</div>
                    </div>';
				
				
			}
			
			}
			
			$checkroll++;			
		}
	echo '';		
	 }
		//echo $IndustryLevels.'';
	}
	else
	{
		echo 'No Capability Found';
	}
			?>
            </div>
        </div>
    </div>
    <!-------------------------------------------------------
	END
-------------------------------------------------------->


    <script src="<?php echo base_url();?>assets/industryreport/index.js?v=<?php echo date("His");?>"></script>
</body>

</html>
<script>
function showbestmatch()
{

	const collection = document.getElementsByClassName("bestmatch"); 
	 var totalRowCount = collection.length;
	 for(i=0;i<totalRowCount;i++)
	 {
		if(document.getElementsByClassName("bestmatch")[i])
		{
			document.getElementsByClassName("bestmatch")[i].style.display=""
		}
	 }
	 
	 
	
}
function showitematch()
{
	const collection = document.getElementsByClassName("ite"); 
	 var totalRowCount = collection.length;
	 for(i=0;i<totalRowCount;i++)
	 {
		if(document.getElementsByClassName("ite")[i])
		{
			document.getElementsByClassName("ite")[i].style.display=""
		}
	 }
}

function activatebutton(n1)
{
	if(document.getElementById("tabbutton_"+n1))
	{
		document.getElementById("tabbutton_"+n1).classList.add("active");
	}		
}

function openbeginner(n1)
{
	/*
	//alert("nestedContent"+n1+"1")
	showTabContent("content"+n1);
	showNestedTabContent("nestedContent"+n1+"1")
	*/
	//show the first one (beginner)
	contentId="content"+n1;
	nestedContentId="nestedContent"+n1+"1";
	
	
	document.querySelectorAll('.inner-tabcon').forEach(div => div.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
	document.getElementById(contentId).classList.add('active');
		
	document.getElementById("nestedContent"+n1+"1").classList.add('active');
	
}

</script>