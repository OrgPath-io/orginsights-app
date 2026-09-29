<?php
//showpagination
//echo "Showing ".($start+1)." to ".$end." of ".$totalrecords." entries";

if($page > 1)
{
//Previous link
}

if($end < $totalrecords)
{
//Next link
}

$last=$end;

if($end >= $totalrecords)
{
	$last=$totalrecords;
}

//echo $querystring;
?>
<div class="row">
	<div class="col-sm-12">
	<div class="col-sm-a12 col-md-a8" style="float:left;">
		<div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
		<?php echo "Showing ".($start+1)." to ".$last." of ".$totalrecords." entries";?>
		</div>
	</div>
	<div class="col-sm-a12 col-md-a4" style="float:right;">
		<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
			<ul class="pagination">
<?php
if($page > 1)
{
//Previous link
$navigatelink=$querystring1.$querystring;
?>
<li class="paginate_button page-item previous" id="dataTable_previous"><a href="<?php echo $navigatelink;?>" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
<?php
}

?>
				<?php
				/*if($page < 6)
				{
					for($i=1;$i<=5;$i++)
					{
						if($i < $pages)
						{
							$pageactive="";
							
							if($i==$page)
							{
								$pageactive="active";
							}
						
						$navigatelink="?page=".($i-1).$querystring;
					?>
					<li class="paginate_button page-item <?php echo $pageactive;?>"><a href="<?php echo $navigatelink;?>" aria-controls="dataTable" data-dt-idx="<?php echo $i;?>" tabindex="0" class="page-link"><?php echo $i;?></a></li>
					<?php
						}
					}
				}*/
				?>
				
<?php
if($end < $totalrecords)
{
//Next link
$navigatelink=$querystring2.$querystring;
?>
<li style="margin-left:10px;" class="paginate_button page-item next" id="dataTable_next"><a href="<?php echo $navigatelink;?>" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">Next</a></li>
<?php
}
?>				
				
			</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
	</div>
</div>