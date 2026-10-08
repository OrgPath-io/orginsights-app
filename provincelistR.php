<?php
include("connection.php"); 


//GET THE LIST OF PROVINCES
$alphacheck=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0","!","@","#","$","%","^","&","*","(",")","_","-","/",".","'"," ");

echo "<option value=0>Select Province</option>";

if(isset($_REQUEST["p"]) && $_REQUEST["p"]!="")
{

	//$chkprovinces=$con->query("select * from provinces where province_name='".$_REQUEST["p"]."'");
	$chkprovinces=$con->query("select * from provinces where countryid='".(int)$_REQUEST["p"]."'");

	while($chkprovincesr = $chkprovinces->fetch_array())
	{

			$checkreponsesR=1;
			
			if((int)$checkreponsesR > 0)
			{
		
				$searchtext=trim($chkprovincesr["province_name"]);
				$chksearch1=strtoupper($searchtext);
				$chksearch2=$chksearch1;
				foreach($alphacheck as $key=>$value)
				{
					$chksearch2=str_replace($value,"",$chksearch2);
				}
				
				$chksearch2="";
				
				if(trim($chksearch2)=="")
				{
					$description=utf8_encode($chkprovincesr["province_name"]);
					$description=$chkprovincesr["province_name"];
				
					echo "<option value=".(int)$chkprovincesr["id"].">".$description."</option>";
					
				}
			
			}
			
		
	}
}
?>