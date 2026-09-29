<?php
//&base=CAD

$converter=file_get_contents("http://data.fixer.io/api/latest?access_key=60614eb14a83f3dcb9c1747e943e5224");

$display = json_decode($converter, true);

//$assessments_array=array(0,49,75,99);
$assessments_array=array(0);
//
$query_user2 = $this->db->query("select * from packages order by p_id");
foreach ($query_user2->result_array() as $row_user2)
{						
	$assessments_array[$row_user2["p_id"]]=$row_user2["price"];
}
//



$UserCurrency="CAD";

$Samerate=array("CAD","USD","EUR","AUD","NZD","GBP","CHF");

$ConvertRate=(int)$this->session->userdata('ConvertRate');

//echo $ConvertRate;

if((int)$display["success"]==1)
{
	$FixedRate=$display["rates"]["CAD"];
	
	$UserCurrency=$this->session->userdata('UserCurrency');
	
	if($UserCurrency=="")
	{
		$UserCurrency="CAD";
	}
	
	$UserCountryR=$FixedRate;
	
	if($display["rates"][$UserCurrency])
	{
		$UserCountryR=$display["rates"][$UserCurrency];
	}
	
	
	if (in_array($UserCurrency, $Samerate))
	{
		$UserCountryR=$FixedRate;
	}


	if($ConvertRate==1)
	{
		foreach($assessments_array as $key=>$value)
		{
			
			$Conversion=($UserCountryR/$FixedRate);
			$newrate=$value*$Conversion;
			
			$assessments_array[$key]=(int)$newrate;
		}
	}	
	
}

//echo $UserCurrency;
foreach($assessments_array as $key=>$value)
{
	//echo $value;
	//echo "<br>";
	
}

//print_r($display["rates"]["CAD"]);
?>
<style>
.leftModalContent h2 sup, .cutOffPrice sup {
    font-size: 12px !important;
	}
	.leftModalContent h2 .actualPrice span,.cutOffPrice span {
	padding-left:5px !important;
	}
</style>