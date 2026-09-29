<?php
if((int)$perccheck==1)
{
  $framesrc=base_url()."additionalreport/".(int)$order_id."/1";
}
else
{
  $framesrc=base_url()."additionalreport/".(int)$order_id;
}
$framesrc=base_url()."additionalreport/".(int)$order_id."/".(int)$perccheck;
?>
<center>
<img src="<?php echo base_url();?>assets/images/loading.gif">
<br>
Loading PDF, Please wait.
</center>
<div style="display:none;">
<iframe name="pdfframe1" id="pdfframe1" width="1px" height="1px"></iframe>
<iframe id="pdfframe2" width="1px" height="1px"></iframe>
</div>
<form id="areportpdf" action="<?php echo $framesrc;?>" method="Post" target="pdfframe1">
<?php
foreach($_POST as $key=>$value)
{
	echo '<input type="hidden" name="'.$key.'" id="'.$key.'" value="'.$value.'">';
}
?>
<input type="submit" value="">
</form>
<script>
document.getElementById("areportpdf").submit();
</script>

