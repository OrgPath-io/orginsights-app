<?php
//calcpagination
if(isset($limitselected))
{
	$limit=(int)$limitselected;
}
else
{
	$limit=50;
}
$page=(int)$_REQUEST['page'];
$page++;

if($page < 0)
{
$page=1;
}

$end=$page*$limit;
$start=$end-$limit;

foreach($whereq as $key=>$value)
{
	$con->where($key, $value);
}
$con->order_by($nsortby);
$rec=$con->get($tablevalue);

//$rec=$con->query($sql);

$totalrecords=$rec->num_rows();
//echo $totalrecords;

$pages1=($totalrecords % $limit);
$pages2=$totalrecords-$pages1;
$pages=$pages2/$limit;
if($pages2 > 0)
{
	$pages++;
}

$sql.=" limit ".$start.",".$limit;

foreach($whereq as $key=>$value)
{
	$con->where($key, $value);
}
$con->order_by($nsortby);


$querystring1="?page=".($page-2); //previous
$querystring2="?page=".$page; //next
$querystring3="?page=".($page-1); //additional
?>