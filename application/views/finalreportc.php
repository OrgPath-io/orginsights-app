<link href="<?php echo base_url();?>asset/reports_style.css?d=<?php echo date("His");?>" rel="stylesheet">
<?php
$user_id=(int)$this->session->userdata('user_id');

$getRecQ=$this->db->query("SELECT * FROM users where user_id = '".$user_id."' limit 0,1");
$getRecR=$getRecQ->result_array();
foreach($getRecR as $key=>$value)
{
	$user_countryid=(int)$value["country_id"];
	$user_provinceid=(int)$value["province"];
	$user_cityid=(int)$value["city"];
	$user_ageid=(int)$value["age_range"];
	$user_hleid=(int)$value["hle"];
	$user_universityid=(int)$value["university"];
	$user_studyid=(int)$value["program_study"];
	$user_designationid=(int)$value["designation"];
	$user_expid=(int)$value["MostRecentExpLevelID"];
	$user_Performanceid=(int)$value["Performance_rating"];
	$user_industryid=(int)$value["industry_employer"];
	$user_expertiseid=(int)$value["expertise_role"];
	$user_graduationid=(int)$value["graduation_year"];
	$user_salaryid=(int)$value["salary_range"];
}

$user_designationid=0;
$designationsIDs="0";
$query_desigidQ = $this->db->query("SELECT 
									DesignationID 
									FROM UsersDesignations where UserID=".(int)$this->session->userdata('user_id'));
$res_desigidR = $query_desigidQ->result_array();
foreach($res_desigidR as $result1){

	$designationsIDs.=",".(int)$result1['DesignationID'];
	$user_designationid++;
}	


$query_number_of_orders = $this->db->query("SELECT order_id,order_package_id,order_date from orders where user_id = ".$this->session->userdata('user_id')." and order_id=".(int)$order_id." order by order_id desc limit 0,1");
$query_number_of_orders1f=$query_number_of_orders->result_array();	



$order_id=(int)$query_number_of_orders1f[0]["order_id"];

$users_package1=$query_number_of_orders1f[0]["order_package_id"];
$order_date = $query_number_of_orders1f[0]["order_date"];

if($users_package1==3)
{
	$Package="OrgInsights and 360 Assessment";	
}
else if($users_package1==2)
{
	$Package="OrgInsights Assessment";	
}
else
{
	$Package="360 Assessment";	
}

$Package="Orginsights Capabilities Assessment Global Insights Report";

//<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
?>


<script type="text/javascript">
          function Getpages (n1,id1) {
             $('#'+id1).load(n1);
          };
</script>
<script type="text/javascript">
province_list=new Array();
provinceid_list=new Array();
cities_list=new Array();
</script>
<?php
$alphacheck=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0","!","@","#","$","%","^","&","*","(",")","_","-","/",".","'"," ");

//GET THE LIST OF PROVINCES
$nocountry="-1";
$chkcountry=$this->db->query("select * from countries where id=".$user_countryid." order by country");
$chkcountryQ = $chkcountry->result_array();

foreach($chkcountryQ as $chkcountryr)
{
	$chkprovinces=$this->db->query("select * from provinces where countryid=".$chkcountryr["id"]." and id=".$user_provinceid." order by province_name");
	
	$provinces="";
	$provincesids="";
	
	$chkprovincesQ = $chkprovinces->result_array();

	foreach($chkprovincesQ as $chkprovincesr)
	{
	
		$searchtext=trim($chkcitiesr["province_name"]);
			$chksearch1=strtoupper($searchtext);
			$chksearch2=$chksearch1;
			foreach($alphacheck as $key=>$value)
			{
				$chksearch2=str_replace($value,"",$chksearch2);
			}
			
			//$chksearch2="";	
			
			if(trim($chksearch2)=="")
			{
	
	
			if($provinces!="")
			{
				$provinces.=",";
				$provincesids.=",";
			}
			$provinces.=$chkprovincesr["province_name"];
			$provincesids.=$chkprovincesr["id"];
		
		}
	}
	if(trim($provinces)=="")
	{
		$nocountry.=",".$chkcountryr["id"];
	}
	else
	{
		//$provinces.=",Not Applicable";
	}
	?>
  <script type="text/javascript">
  province_list["<?=$chkcountryr["id"];?>"]="<?php echo $provinces;?>";
  provinceid_list["<?=$chkcountryr["id"];?>"]="<?php echo $provincesids;?>";
  </script>
  <?php
}
//END




?>
<?php include("report_page1.php");?>
<?php include("report_page2.php");?>
<?php include("report_page3.php");?>
<?php include("report_page4.php");?>
<?php include("calcpopulationc.php");?>
<?php include("finalreportc_page5.php");?>
<?php include("finalreportd_page6.php");?>
<?php include("finalreport_page7.php");?>
<?php include("report_page7.php");?>
<script type="text/javascript">
//CHECK PROVINCE
province1="";

//CHECK CITY
city1="";

function display_provinces1(n1,fieldname)
{
    
    
	
	myobject1=province_list[n1].split(",");
	myobject2=provinceid_list[n1].split(",");


	var select1 = document.getElementById(fieldname);



	cnt1=0;

	for(index1 in myobject1) 
	{
		select1.options[select1.options.length] = new Option(myobject1[index1], myobject2[index1]);

		cnt1++;



		if(province1==myobject1[index1] && fieldname=="province")
		{
			select1.selectedIndex=(cnt1-1);
		}
		
	}
}
function show_province(n1,fieldname)
{
    
     document.getElementById("cities").innerHTML="<option value=0>Select City</option>";
	
	document.getElementById(fieldname).options.length = 0;
	var select1 = document.getElementById(fieldname);

	select1.options[select1.options.length] = new Option("Select Province", 0);

	if(province_list[n1]!="")
	{
		display_provinces1(n1,fieldname);
	}
	
	//
	

}

function show_cities(n1,fieldname)
{
	user_cityid="<?php echo $user_cityid;?>";

	Getpages("<?php echo base_url();?>citylistc.php?p="+n1+"&c="+user_cityid,"cities");
}

show_cities(<?php echo (int) $provinceselid;?>,'fieldname')

//show_province(document.getElementById("countryid").value,'province');
</script>