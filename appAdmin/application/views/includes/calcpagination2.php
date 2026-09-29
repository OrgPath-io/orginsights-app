<?php
//calcpagination
$limit=50;
$page=(int)$_REQUEST['page'];
$page++;

if($page < 0)
{
$page=1;
}

$end=$page*$limit;
$start=$end-$limit;

$rec=$con->query($sql);

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


$querystring1="?page=".($page-2); //previous
$querystring2="?page=".$page; //next
$querystring3="?page=".($page-1); //additional
?>