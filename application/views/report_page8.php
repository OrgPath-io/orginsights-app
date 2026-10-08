<?php include("additionalheader.php");?>
<script src="<?php echo base_url();?>asset/js/jquery-min.js"></script>
<script>
$(document).ready(function() {
   var delay = 2000;
   
   $('#btn-default').click(function(e){
	e.preventDefault();
	var user_id="<?php echo (int)$this->session->userdata('user_id');?>";
	var order_id="<?php echo (int)$order_id;?>";
	var countryid = $('#countryid').val();
	var province = $('#province').val();
	var cities = $('#cities').val();
	var age_range = $('#age_range').val();
	var hle = $('#hle').val();
	var university = $('#university1').val();
	var study = $('#study1').val();
	var designation = $('#designation1').val();
	var MostRecentExpLevelID = $('#MostRecentExpLevelID').val();
	var performance_rating = $('#performance_rating').val();
	var industry_employer = $('#industry_employer1').val();
	var expertise_role = $('#expertise_role1').val();
	var graduation_year = $('#graduation_year').val();
	var salary_range = $('#salary_range').val();
	
	//for pdf
	$('#countryidpdf').val(countryid);
	$('#provincepdf').val(province);
	$('#citiespdf').val(cities);
	$('#age_rangepdf').val(age_range);
	$('#hlepdf').val(hle);
	$('#university1pdf').val(university);
	$('#study1pdf').val(study);
	$('#designation1pdf').val(designation);
	$('#MostRecentExpLevelIDpdf').val(MostRecentExpLevelID);
	$('#performance_ratingpdf').val(performance_rating);
	$('#industry_employer1pdf').val(industry_employer);
	$('#expertise_role1pdf').val(expertise_role);
	$('#graduation_yearpdf').val(graduation_year);
	$('#salary_rangepdf').val(salary_range);
	//*/
//
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_graph_result.php",
   data: "reportd=1&user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range+"&hh=0&hg=0",
   success: function(data)
   {
   setTimeout(function() {
   $('#firstdata').html(data);
   }, delay);
   }
   });
   


 
});
//
$('#btn-cf').click(function(e){
		e.preventDefault();
		$('#countryid').val("<?php echo (int)$countryid;?>");
		$('#province').val(0);
		$('#cities').val(0);
		$('#age_range').val(0);
		$('#hle').val(0);
		$('#university1').val(0);
		$('#study1').val(0);
		$('#designation1').val(0);
		$('#MostRecentExpLevelID').val(0);
		$('#performance_rating').val(0);
		$('#industry_employer1').val(0);
		$('#expertise_role1').val(0);
		$('#graduation_year').val(0);
		$('#salary_range').val(0);
		
		
		var user_id="<?php echo (int)$this->session->userdata('user_id');?>";
	var order_id="<?php echo (int)$order_id;?>";
	var countryid = $('#countryid').val();
	var province = $('#province').val();
	var cities = $('#cities').val();
	var age_range = $('#age_range').val();
	var hle = $('#hle').val();
	var university = $('#university1').val();
	var study = $('#study1').val();
	var designation = $('#designation1').val();
	var MostRecentExpLevelID = $('#MostRecentExpLevelID').val();
	var performance_rating = $('#performance_rating').val();
	var industry_employer = $('#industry_employer1').val();
	var expertise_role = $('#expertise_role1').val();
	var graduation_year = $('#graduation_year').val();
	var salary_range = $('#salary_range').val();
	
	//for pdf
	$('#countryidpdf').val(countryid);
	$('#provincepdf').val(province);
	$('#citiespdf').val(cities);
	$('#age_rangepdf').val(age_range);
	$('#hlepdf').val(hle);
	$('#university1pdf').val(university);
	$('#study1pdf').val(study);
	$('#designation1pdf').val(designation);
	$('#MostRecentExpLevelIDpdf').val(MostRecentExpLevelID);
	$('#performance_ratingpdf').val(performance_rating);
	$('#industry_employer1pdf').val(industry_employer);
	$('#expertise_role1pdf').val(expertise_role);
	$('#graduation_yearpdf').val(graduation_year);
	$('#salary_rangepdf').val(salary_range);
	//*/
	
	show_province(countryid,'province');
//
$.ajax
   ({
   type: "POST",
   url: "<?php echo base_url();?>FR_graph_result.php",
   data: "reportd=1&user_id="+user_id+"&order_id="+order_id+"&countryid="+countryid+"&province="+province+"&cities="+cities+"&age_range="+age_range+"&hle="+hle+"&university="+university+"&study="+study+"&designation="+designation+"&MostRecentExpLevelID="+MostRecentExpLevelID+"&performance_rating="+performance_rating+"&industry_employer="+industry_employer+"&expertise_role="+expertise_role+"&graduation_year="+graduation_year+"&salary_range="+salary_range+"&hh=0&hg=0",
   success: function(data)
   {
   setTimeout(function() {
   $('#firstdata').html(data);
   }, delay);
   }
   });
		
		
	});
//
	$('#btn-hg').click(function(e){
		e.preventDefault();
		$('.colG').removeClass('colG').addClass('colGG');
		$('.GreenFlag').hide();
		$('.colRR').removeClass('colRR').addClass('colR');
		$('.RedFlag').show();
	});
	
	$('#btn-hh').click(function(e){
		e.preventDefault();
		$('.colR').removeClass('colR').addClass('colRR');
		$('.RedFlag').hide();
		$('.colGG').removeClass('colGG').addClass('colG');
		$('.GreenFlag').show();
	});
	
	$('#btn-pdf').click(function(e){
		e.preventDefault();
	});
	$('#MeanScore').click(function(e){
		e.preventDefault();
	});
	$('#Percentage').click(function(e){
		e.preventDefault();
	});
}); 
</script>
<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;500;600;700&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/chartcss/bootstrap.min.css">
	<!-- owl.carousel -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/chartcss/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/chartcss/owl.theme.default.min.css">
	<!-- Main Css -->
	
	
<style>
.container {
  max-width: 1600px;
}
section.banar_areac {padding: 10px 0 10px;background-image: url("<?php echo base_url();?>assets/img/banar_bg.jpg");background-repeat-x: repeat;background-size: auto 100%;}

.banar_content {text-align: center;color: #fff;margin: 0 auto;max-width: 1200px;}

.banar_content h1 {font-size: 75px;font-weight: bold;text-transform: uppercase;margin-bottom: 70px;}

.banar_content p {font-size: 36px;line-height: 1.2;}

.graphContent img {display: block;width: 100%;}

section.graph_section {padding: 70px 0 100px;}

footer.footer_area {background: #f1f0f0;text-align: center;padding: 50px 0;font-size: 24px;font-family: 'Karla';font-weight: bold;}

.banar_content p b {font-family: 'Karla';}

.select_box img {display: block;width: 14px;margin-right: 5px;position: absolute;left: 7px;}

.graph_title {display: flex;justify-content: center;margin-bottom: 30px;}

.graph_title> div {margin: 0 11px;font-size: 18px;display: flex;align-items: center;}

.self {color: #669577;}

.greenLineBox {display: block;width: 20px;height: 12px;background: #669577;margin-right: 10px;}

.blueLineBox {display: block;
    width: 20px;
    height: 12px;
    background: #7BC7FF;
    margin-right: 10px;}

.popul {color: #7BC7FF;}

.graph_colum {display: flex;}

.graph_colTitle {display: flex;align-items: center;background: #EBDCA5;justify-content: flex-start;font-size: 20px;text-transform: uppercase;font-weight: bold;padding: 30px 17px;flex-shrink: 0;min-width: 220px;line-height: 1;color: #6E6871;}

.graph_colTitle span {display: block;font-size: 55px;padding-right: 5px;}

ul.graph_line_list {padding: 0;flex-grow: 1;}

ul.graph_line_list li {display: flex;padding-right: 50px;position: relative;}

.line_title {background: #F4F2E8;width: 370px;font-size: 18px;font-weight: 700;padding: 5px 10px;text-align: right;border-bottom: 1px solid #fff;flex-shrink: 0;}

.colR {color: #C33434;}
.colG {color: #33be6e;}

.graph_lines {flex-grow: 1;display: flex;align-items: flex-start;flex-direction: column;justify-content: center;border-bottom: 1px solid #ddd;position: relative;z-index: 1;}

.greenLine, .blueLine {height: 16px;background-repeat: repeat;background-size: contain;}

/*.greenLine {background-image: url("assets/img/green.png");width: 50%;}*/

/*.blueLine {background-image: url(assets/img/blue.png);width: 75%;}*/

.border_line {position: absolute;z-index: -1;top: 0;bottom: 0;width: 1px;background: #ddd;}

span.border_line.border_line_1 {left: 20%;}

span.border_line.border_line_2 {left: 40%;}

span.border_line.border_line_3 {left: 60%;}

span.border_line.border_line_4 {left: 80%;}

span.border_line.border_line_5 {left: 100%;}



.graph_lines::after {
  position: absolute;
  z-index: -1;
  left: 100%;
  bottom: -1px;
  width: 50px;
  height: 1px;
  content: "";
  display: block;
  background: #ddd;
}

.top_btns {display: flex;justify-content: space-between;flex-wrap: wrap;padding-bottom: 15px;}

.graphForm {padding: 30px 0;}

.graphForm button {border: 2px solid #999999;background: transparent;font-size: 18px;font-weight: 500;padding: 5px 10px;line-height: 1.5;margin: 0 8px 10px 0;}

.bottom_btns {display: flex;flex-wrap: wrap;}

.select_box {display: flex;align-items: center;margin: 0 8px 10px 0;position: relative;}

.select_box select {background: transparent;border: 0;outline: none;box-shadow: none;appearance: none;font-size: 18px;
    font-weight: 500;padding: 5px 10px 5px 25px;border: 2px solid #999999;}

button.HighlightGaps {background: #F1C9C8;}

img.flag {display: block;position: absolute;right: 10px;width: 20px;top: 10px;}

.graph_colum:nth-child(even) {}

.graph_colum:nth-child(even) .graph_colTitle {background: #DDCF9A;}

.graph_colum:nth-child(even) .line_title {background: #E5E4DA;}

.blueLine img,
.greenLine img {
  display: block;width: 100%;height: 100%;
}

.line_title {
  background: #F4F2E8;
  width: 370px;
  font-size: 18px;
  font-weight: 700;
  padding: 5px 10px;
  text-align: right;
  border-bottom: 1px solid #fff;
  flex-shrink: 0;
}


</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/chartcss/responsive.css">
<?php
$catlists=array(1,2,3,4,5);
$catlistsname=array("Limits Risk","Embraces<br>Agility","Achieves<br>Excellence","Develops<br>Relationship","Sets<br>Purpose");

//
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


//view

//self categories
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$cats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cat_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$catsq[(int)$value["cat_id"]]=$value["cnt"];
}

//self capabilities
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$caps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='self' and question_typeID IN (3,5) group by cap_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$capsq[(int)$value["cap_id"]]=$value["cnt"];
}

//
//professional categories
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Orgcats[(int)$value["cat_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cat_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cat_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$Orgcatsq[(int)$value["cat_id"]]=$value["cnt"];
}

//professional capabilities
$checkreponsesQ = $this->db->query("SELECT sum(oa_val), cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id");

$checkreponsesR = $checkreponsesQ->result_array();

foreach($checkreponsesR as $key=>$value)
{
	
	$Orgcaps[(int)$value["cap_id"]]=$value["sum(oa_val)"];
}

//

$checkreponsesQ = $this->db->query("SELECT count(*) as cnt, cap_id FROM `View_User_Responses` where user_id =".$user_id." and order_id =".$order_id." and q_type='professional' and question_typeID NOT IN (3,5) group by cap_id
");

$checkreponsesR = $checkreponsesQ->result_array();


foreach($checkreponsesR as $key=>$value)
{

	$Orgcapsq[(int)$value["cap_id"]]=$value["cnt"];
}




//view
/*
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
*/


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
foreach($Totalratings as $key=>$value)
{
	if($value > $highest1)
	{
		$highest1=$value;
		$highest1ID=$TotalratingsID[$key];
	}

}



//
$highest2=0;
$highest1ID2=0;
foreach($Totalratings as $key=>$value)
{
	if($TotalratingsID[$key]!=$highest1ID)
	{
		if($value > $highest2)
		{
			$highest2=$value;
			$highest1ID2=$TotalratingsID[$key];
		}
	}

}


//
$highest3=0;
$highest1ID3=0;
foreach($Totalratings as $key=>$value)
{
	if($TotalratingsID[$key]!=$highest1ID && $TotalratingsID[$key]!=$highest1ID2)
	{
		if($value > $highest3)
		{
			$highest3=$value;
			$highest1ID3=$TotalratingsID[$key];
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



?>
<section class="banar_areac">
			<div class="container">
				<div style="max-width:1600px;" class="banar_content">
					<h1 style="margin-bottom: 10px;">Unlock Next Level Insights</h1>
					<div style="float:right;width:400px;">
					<p align="left" style="padding:5px;margin-right:100px;margin-left:20px;font-size:18px;border:1px solid yellow;"><font color="red">Note:</font> This report is in Beta mode. Please give it some time to load. We are working on fixing the issue. As well, if you see any issues please report them to info@orginsights.io</p>
					</div>
					<div style="padding-right:100px;float:right;">
					<p style="margin-top: 10px;font-size:40px;"><b>Compare yourself to your peers</b></p>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</section>
<section class="graph_section">
			<div class="container">
				<div class="graphContent">
					<div class="custom_graph">
						<div class="graph_title">
							<div class="popul">
								<span class="blueLineBox"></span>
								YOUR ORGINSIGHTS SCORE
							</div>
							<div class="self">
								<span class="greenLineBox"></span>
								POPULATION ORGINSIGHTS SCORE
							</div>
						</div>

						<div class="graphContainer" id="firstdata">
<div class="graph_colum">
<div style="background:none;padding-top:0px;padding-bottom:0px;" class="graph_colTitle"></div>
<ul class="graph_line_list">
<li>
<div style="background:none;padding-top:0px;padding-bottom:0px;" class="line_title"></div>
<div class="graph_lines">
					<span style="position:relative;"><div style="z-index:1000;position:absolute;top:0;left:-5;">0</div></span>
                    <span style="position:relative;" class="border_line border_line_1"><div style="z-index:1000;position:absolute;top:0;left:-4;">1</div></span>
                    <span style="position:relative;" class="border_line border_line_2"><div style="z-index:1000;position:absolute;top:0;left:-4;">2</div></span>
                    <span style="position:relative;" class="border_line border_line_3"><div style="z-index:1000;position:absolute;top:0;left:-4;">3</div></span>
					<span style="position:relative;" class="border_line border_line_4"><div style="z-index:1000;position:absolute;top:0;left:-4;">4</div></span>
					<span style="position:relative;" class="border_line border_line_5"><div style="z-index:1000;position:absolute;top:0;left:-4;">5</div></span>
</div>
</li>	
</ul>
</div>
<br>					
<?php
foreach($catlists as $Ckey=>$Cvalue)
{

$Maincatid=$Cvalue;
$Maincatname=$catlistsname[$Ckey];
$Maincattitle=$catlistsname[$Ckey];
$Maincatname=str_replace("<br>"," ",$Maincatname);


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
		$breakdowntext[$key]="<h2>".$checkcapsR[0]["cap_name"]."</h2><p>".$checkcapsR[0]["description"]."</p>";
		$breakdowntext[$key]=$checkcapsR[0]["cap_name"];
	}
}
?>						
							<div class="graph_colum">
								<div class="graph_colTitle">
									<span><?php echo substr($Maincattitle,0,1);?></span><?php echo substr($Maincattitle,1);?>
								</div>
								<ul class="graph_line_list">

								<?php
								$currentquestion=0;
			foreach($breakdowntext as $bkey=>$bvalue)
			{
				//echo $PopOrgcapratings[(int)$breakdownid[$bkey]]."<br>";
			
				$value=(int)$PopOrgcaps[(int)$breakdownid[$bkey]];
				
				if($PopOrgcapsq[(int)$breakdownid[$bkey]] > 0)
				{
					$OrgcapratingC=$value/$PopOrgcapsq[(int)$breakdownid[$bkey]];
					
					//$OrgcapratingC=$PopOrgcapratings[(int)$breakdownid[$bkey]]/$Population;
				}
				else
				{
					$OrgcapratingC=0;
				}
				
				//echo $value."<br>";
				//
				$value=(int)$Orgcaps[(int)$breakdownid[$bkey]];
				
				if($Orgcapsq[(int)$breakdownid[$bkey]] > 0)
				{
					//$capratingC=$value/$Orgcapsq[(int)$breakdownid[$bkey]];
					
					$capratingC=$Orgcapratings[(int)$breakdownid[$bkey]];
				}
				else
				{
					$capratingC=0;
				}
				
				
				$orgscore=$OrgcapratingC;
				$yourscore=$capratingC;
				
				$yourscore/=5;
				$yourscore*=100;
				
				$orgscore/=5;
				$orgscore*=100;
				
				//echo $capratingC; die();
				
				//don't show pop score initially
				$orgscore=0;
				
				//end check
				//$Gap=($OrgcapratingC-);
				//$Gap=($capratingC-$OrgcapratingC);
				$Gap=(number_format($OrgcapratingC,1)-number_format($capratingC,1));
				//new
				$Gap=(number_format($capratingC,1)-number_format($OrgcapratingC,1));
				$Gap=number_format($Gap,1);
				?>
									<li>
										<?php
										//*
										if($Gap >=2)
										{
										?>
										<div class="line_title colGG">
										<?php
										}
										else if($Gap <=-2)
										{
										?>
										<div class="line_title colRR">
										<?php
										}
										else
										{
										?>
										<div class="line_title">
										<?php
										}
										//*/
										
										?>
											
											<?php echo $bvalue;?>
										</div>
										<div class="graph_lines">
											<span class="border_line border_line_1"></span>
											<span class="border_line border_line_2"></span>
											<span class="border_line border_line_3"></span>
											<span class="border_line border_line_4"></span>
											<span class="border_line border_line_5"></span>
											<div class="greenLine" style="width: <?php echo (int)$orgscore;?>%"><img src="<?php echo base_url();?>assets/img/green.png" alt="blue"></div>
											<div class="blueLine" style="width: <?php echo (int)$yourscore;?>%"><img src="<?php echo base_url();?>assets/img/blue.png"></div>
											
										</div>
										<?php 
										//*
										if($Gap >=2)
											{
											?>
											<span class="GreenFlag" style="display:none">
											<img class="flag" src="<?php echo base_url();?>asset/report_images/green-flag.png" >
											</span>
											<?php
											}
											else if($Gap <=-2)
											{
											?>
											<span class="RedFlag" style="display:none">
											<img class="flag" src="<?php echo base_url();?>asset/report_images/red-flag.png" >
											</span>
											<?php
											}
											else
											{
											
											}
											//*/
										?>
									</li>
									<?php
									}
									?>
								</ul>
							</div> <!-- /.graph_colum -->
							<?php
							}
							?>
							
						</div> <!-- /.graphContainer -->
						<div class="graphForm">
							<form action="#">
								<div class="top_btns">
									<div class="topLeft">
										<button id="btn-default" class="updateAPP">Update / Apply</button>
										<button class="Clear" id="btn-cf">Clear Filters</button>
									</div>
<div class="topRight">
<div style="display:none;">
<input type="checkbox" value=1 name="perccheck" id="perccheck_<?php echo (int)$order_id;?>" checked>
</div>
<button class="" id="MeanScore" style="background:#ccdeed;" onclick="switchoption(2,<?php echo (int)$order_id;?>)">AVG</button>
<button class="" id="Percentage" style="background:#2ca453;" onclick="switchoption(1,<?php echo (int)$order_id;?>)">%</button>

<button class="" onclick="genpdfreporta(<?php echo (int)$order_id;?>)" id="btn-pdf">PDF REPORT</button>	
</div>								
									<div class="topRight">

									
										<button class="" id="btn-hh">Highlight Hidden Talents</button>
										<button class="HighlightGaps" id="btn-hg">Highlight Gaps</button>
									</div>
								</div>
								<div class="bottom_btns">
									<?php /* ?><div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<select name="Population" id="Population">
											<option value="Population">Population</option>
											<option value="Population">Population</option>
										</select>
									</div><?php */ ?>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<select name="countryid" id="countryid" onchange="show_province(this.value,'province')">
											<option value=0>Country</option>
<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.country, c.id from users a join orders ord on a.user_id = ord.user_id join countries c on a.country_id = c.id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.country_id"); 
$res_country = $query_country->result_array();
$provincewhere=" where countryid=0";
$countrywhere="";
foreach($res_country as $row)
{

	$slct="";

	if((int)$row['rows1'] > 4)
	{

	if(isset($countryid) && (int)$countryid==$row['id'])
	{

		$CountryFSel=$row['country'];

		$slct="selected";
		$tickmark="display:block;";
		$provincewhere=" where countryid='".$row['id']."'";
		
		$countrywhere=" and a.country_id=".(int)$countryid;
	}
	?>
	<option value=<?php echo $row['id'];?> <?php echo $slct;?>><?php echo $row['country'];?></option>
	<?php
	}
}
?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$provinceselid=0;

$query_country =$this->db->query("Select count(a.user_id) as rows1, c.province_name, c.id from users a join orders ord on a.user_id = ord.user_id join provinces c on a.province = c.id ".$provincewhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.province"); 
$res_province = $query_country->result_array();

$tickmark="display:none;";
?>
										<select name="province" id="province" onchange="show_cities(this.value,'cities')">
											<option value=0>Province</option>
											<?php
											foreach($res_province as $row)
											{
												$slct="";
												
												
												if((int)$row['rows1'] > 4)
												{
												
												if(isset($_POST['province']) && $_POST['province']== $row['id'] ){
												$slct="Selected";
												$tickmark="display:block;";
												$provinceselid=$row['id'];
												}
											
										?>
											<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['province_name'];?></option>
										<?php
												}
											}
										?>	
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join Cities c on a.city = c.id where ProvinceID=".(int)$provinceselid." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.city"); 
$res_city = $query_country->result_array();

$tickmark="display:none;";
?>
										<select name="city" id="cities" onchange="changefields('cities')">
											<option value=0>City</option>
											<?php
											foreach($res_city as $row)
											{
												$slct="";
												
												if((int)$row['rows1'] > 4)
												{
												
												if(isset($_POST['city']) && $_POST['city']== $row['id'] ){
												$slct="Selected";
												$tickmark="display:block;";
												
												}
											
										?>
											<option <?php echo $slct;?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
										<?php
												}
											}
										?>	
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join AgeRanges c on a.age_range = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.age_range"); 
$res_age = $query_country->result_array();

$tickmark="display:none;";
?>
										<select name="age_range" id="age_range" onchange="changefields('age_range')">
											<option <?php if($_POST['age_range']== '' ){ echo 'Selected';} ?> value=0>Age Range</option>
											<?php
				foreach($res_age as $row)
				{
				
					if((int)$row['rows1'] > 4)
					{
				
					if(isset($_POST['age_range']) && $_POST['age_range']== $row['id'] ){
					$ageFSel=$row['description'];
					}
				
			?>
				<option <?php if($_POST['age_range']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>	
			
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join HLEType c on a.hle = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.hle"); 
$res_hletypes = $query_country->result_array();

$tickmark="display:none;";
?>
										<select name="hle" id="hle">
											<option value=0>Education</option>
											<?php
				foreach($res_hletypes as $row)
				{
				
					if((int)$row['rows1'] > 4)
					{
					if(isset($_POST['hle']) && $_POST['hle']== $row['id'] ){
					$hleFSel=$row['description'];
					}
				
			?>
				<option <?php if($_POST['hle']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
	$tickmark="display:none;";
	$query_country =$this->db->query("Select count(a.user_id) as rows1, c.university, c.id from users a join orders ord on a.user_id = ord.user_id join university c on a.university = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.university"); 
$res_university = $query_country->result_array();
	?>
										<select name="university" id="university1" onchange="changefields('university1')">
											<option value=0>University</option>
											<?php
		foreach($res_university as $row)
		{
			if((int)$row['rows1'] > 4)
			{
					if(isset($_POST['university']) && $_POST['university']== $row['id'] ){
					$UniversityFSel=$row['university'];
					}
			?>
				<option <?php if(isset($_POST['university']) && $_POST['university']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['university'];?></option>
			<?php
			}
		}
	?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<select name="graduation_year" id="graduation_year" onchange="changefields('graduation_year')">
											<option value=0>Graduation Year</option>
											<?php
											$tickmark="display:none;";
											for($i=2030;$i>=1950;$i--)
											{
												$checkreponsesQ = $this->db->query("Select a.user_id from users a join orders ord on a.user_id = ord.user_id where ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 and a.graduation_year=".$i." ".$countrywhere." limit 0,5");
													$checkreponsesR = $checkreponsesQ->num_rows();
													if((int)$checkreponsesR > 4)
													{
												if(isset($_POST['graduation_year']) && $_POST['graduation_year']== $i ){
													$gradFSel=$_POST['graduation_year'];
													}
											
											?>
											<option <?php if($_POST['graduation_year']== $i ){ echo 'Selected';$tickmark="display:block;";} ?>><?php echo $i;?></option>
											<?php
													}
											}
											?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
			$tickmark="display:none;";
			$query_country =$this->db->query("Select count(a.user_id) as rows1, c.major_cat, c.id from users a join orders ord on a.user_id = ord.user_id join study c on a.program_study = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.program_study"); 
			$res_study = $query_country->result_array();
			?>
										<select name="study" id="study1" onchange="changefields('study1')">
											<option value=0>Study</option>
											<?php
				foreach($res_study as $row)
				{
				
					if((int)$row['rows1'] > 4)
					{
					if(isset($_POST['study']) && $_POST['study']== $row['id'] ){
					$studyFSel=$row['major_cat'];
					}
			?>
				<option <?php if($_POST['study']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['major_cat'];?></option>
			<?php
					}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
		$tickmark="display:none;";
		$designationsel="";
		if(isset($_POST["designation"]) && $_POST["designation"]!="")
		{
			$designationsel=$_POST["designation"];
		}
		?>
		<?php /*/ ?><input type="text" id="designations" name="designation" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" value="<?php echo $designationsel;?>"  placeholder="E.g. CPA" ><?php */ ?>
		<?php
		$query_country =$this->db->query("Select count(a.user_id) as rows1, c.CertificateDesignationName, c.id from users a join orders ord on a.user_id = ord.user_id join Designations c on a.designation = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.designation"); 
		$res_designations = $query_country->result_array();
		?>
										<select name="designation" id="designation1" onchange="changefields('designation1')">
											<option value=0>Designation</option>
											<?php
				foreach($res_designations as $row)
				{
					if((int)$row['rows1'] > 4)
					{
					if(isset($_POST['designation']) && $_POST['designation']== $row['id'] ){
					$desigFSel=$row['CertificateDesignationName'];
					}
					
			?>
				<option <?php if($_POST['designation']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['CertificateDesignationName'];?></option>
			<?php
				}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join MostRecentExperienceLevel c on a.MostRecentExpLevelID = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.MostRecentExpLevelID"); 
$res_mrels = $query_country->result_array();
$tickmark="display:none;";
?>
										<select name="MostRecentExpLevelID" id="MostRecentExpLevelID" onchange="changefields('MostRecentExpLevelID')">
										
											<option value=0>Experience</option>
											<?php
				foreach($res_mrels as $row)
				{
					if((int)$row['rows1'] > 4)
					{
				
					if(isset($_POST['MostRecentExpLevelID']) && $_POST['MostRecentExpLevelID']== $row['id'] ){
					$explevelFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['MostRecentExpLevelID']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join Performance_Rating c on a.Performance_rating = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.Performance_rating"); 
$res_performances = $query_country->result_array();
$tickmark="display:none;";
?>
										<select name="performance_rating" id="performance_rating" onchange="changefields('performance_rating')">
											<option value=0>Performance</option>
											<?php
				foreach($res_performances as $row)
				{
				
					if((int)$row['rows1'] > 4)
					{
					if(isset($_POST['performance_rating']) && $_POST['performance_rating']== $row['id'] ){
					$perfFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['performance_rating']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
		$tickmark="display:none;";
		$query_country =$this->db->query("Select count(a.user_id) as rows1, c.name, c.id from users a join orders ord on a.user_id = ord.user_id join industry c on a.industry_employer = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.industry_employer"); 
$res_industry = $query_country->result_array();
		?>
										<select name="industry_employer" id="industry_employer1" onchange="changefields('industry_employer1')">
											<option value=0>Industry</option>
											<?php
				foreach($res_industry as $row)
				{
					if((int)$row['rows1'] > 4)
					{
					if(isset($_POST['industry_employer']) && $_POST['industry_employer']== $row['id'] ){
					$industryFSel=$row['name'];
					}
			?>
				<option <?php if($_POST['industry_employer']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['name'];?></option>
			<?php
					}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
		$tickmark="display:none;";
		$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join Expertise_Role c on a.expertise_role = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.expertise_role"); 
$res_expertises = $query_country->result_array();
		?>
										<select name="expertise_role" id="expertise_role1" onchange="changefields('expertise_role1')">
											<option value=0>Expertise</option>
											<?php
				foreach($res_expertises as $row)
				{
					if((int)$row['rows1'] > 4)
					{
				
					if(isset($_POST['expertise_role']) && $_POST['expertise_role']== $row['id'] ){
					$expertiseFSel=$row['description'];
					}
			?>
				<option <?php if($_POST['expertise_role']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
			<?php
					}
				}
			?>
										</select>
									</div>
									<div class="select_box">
										<img src="<?php echo base_url();?>assets/img/chevron-down.svg" alt="chevron-down">
										<?php
$query_country =$this->db->query("Select count(a.user_id) as rows1, c.description, c.id from users a join orders ord on a.user_id = ord.user_id join SalaryRanges c on a.salary_range = c.id ".$countrywhere." and ord.SelfAssessmentStatus=1 and ord.OrgInsightsStatus=1 group by a.salary_range"); 
$res_salarys = $query_country->result_array();
$tickmark="display:none;";		
?>
										<select name="salary_range" id="salary_range" onchange="changefields('salary_range')">
											<option value=0>Salary Range</option>
											<?php
		
		foreach($res_salarys as $row)
		{
		
			if((int)$row['rows1'] > 4)
					{
			if(isset($_POST['salary_range']) && $_POST['salary_range']== $row['id'] ){
			$SalaryFSel=$row['description'];
			}
		
		?>
		<option <?php if($_POST['salary_range']== $row['id'] ){ echo 'Selected';$tickmark="display:block;";} ?> value=<?php echo $row['id'];?>><?php echo $row['description'];?></option>
		<?php
					}
		}
		?>
										</select>
									</div>
								</div>
							</form>
						</div>
					</div>
					<img src="<?php echo base_url();?>assets/img/graph.png" alt="" style="display: none;">
					
				</div>
				
			</div>
		</section>
		<footer class="footer_area">
			<div class="container">
				<p>© Copyrights 2021 Orginsights. All Rights Reserved</p>
			</div>
		</footer>
<div style="display:none">
<form id="areportpdf" action="<?php echo base_url();?>additionalreport/<?php echo (int)$order_id;?>" method="Post" target="_blank">
<input type="hidden" name="countryid" id="countryidpdf">
<input type="hidden" name="province" id="provincepdf">
<input type="hidden" name="city" id="citiespdf">
<input type="hidden" name="age_range" id="age_rangepdf">
<input type="hidden" name="hle" id="hlepdf">
<input type="hidden" name="university" id="university1pdf">
<input type="hidden" name="study" id="study1pdf">
<input type="hidden" name="designation" id="designation1pdf">
<input type="hidden" name="MostRecentExpLevelID" id="MostRecentExpLevelIDpdf">
<input type="hidden" name="performance_rating" id="performance_ratingpdf">
<input type="hidden" name="industry_employer" id="industry_employer1pdf">
<input type="hidden" name="expertise_role" id="expertise_role1pdf">
<input type="hidden" name="graduation_year" id="graduation_yearpdf">
<input type="hidden" name="salary_range" id="salary_rangepdf">
<input type="hidden" name="pdffulltype" id="pdffulltype" value=0>
<input type="submit" value="">
</form>
</div>
<script>
document.getElementById("countryidpdf").value=document.getElementById("countryid").value
function genpdfreporta(n1)
{
	document.getElementById("pdffulltype").value=1;
	if(document.getElementById('perccheck_'+n1).checked==true)
	{
		document.getElementById("areportpdf").action="<?php echo base_url();?>additionalreports/<?php echo (int)$order_id;?>/1";
		
	}
	else
	{
		document.getElementById("areportpdf").action="<?php echo base_url();?>additionalreports/<?php echo (int)$order_id;?>";
	}
	
	document.getElementById("areportpdf").submit();
}
function genpdfreportb()
{
	document.getElementById("pdffulltype").value=1;
	document.getElementById("areportpdf").submit();
}
function switchoption(n1,n2)
{
	if(n1==2)
	{
		document.getElementById("MeanScore").style.background="#2ca453";
		document.getElementById("Percentage").style.background="#ccdeed";
		document.getElementById("perccheck_"+n2).checked=false;
	}
	else if(n1==1)
	{
		document.getElementById("MeanScore").style.background="#ccdeed";
		document.getElementById("Percentage").style.background="#2ca453";
		
		document.getElementById("perccheck_"+n2).checked=true;
	}
}
</script>		