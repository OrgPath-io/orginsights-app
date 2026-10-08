<?php
include("connection.php"); 


//GET THE LIST OF CITIES
$alphacheck=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0","!","@","#","$","%","^","&","*","(",")","_","-","/",".","'"," ");

echo "<option value=0>Select City</option>";

if(isset($_REQUEST["p"]) && $_REQUEST["p"]!="")
{

	//$chkprovinces=$con->query("select * from provinces where province_name='".$_REQUEST["p"]."'");
	$chkprovinces=$con->query("select * from provinces where id='".(int)$_REQUEST["p"]."'");

	while($chkprovincesr = $chkprovinces->fetch_array())
	{

	$chkcities=$con->query("select * from Cities where ProvinceID=".$chkprovincesr["id"]." and id=".(int)$_REQUEST["c"]." order by description");

		while($chkcitiesr = $chkcities->fetch_array())
		{
			$searchtext=trim($chkcitiesr["description"]);
			$chksearch1=strtoupper($searchtext);
			$chksearch2=$chksearch1;
			foreach($alphacheck as $key=>$value)
			{
				$chksearch2=str_replace($value,"",$chksearch2);
			}
			
			$chksearch2="";
			
			if(trim($chksearch2)=="")
			{
				$description=utf8_encode($chkcitiesr["description"]);
				
				$slct="";
					if((int)$chkcitiesr["id"]== (int)$_REQUEST["c"] ){
					$slct="Selected";
					
					}
			
				echo "<option value=".(int)$chkcitiesr["id"]." ".$slct.">".$description."</option>";
				
			}
			
		}
	}
}
?>