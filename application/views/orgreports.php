<?php
if((int)$perccheck==1)
{
  $framesrc=base_url()."orgreport/".(int)$order_id."/1?full=".$_REQUEST["full"];
}
else
{
  $framesrc=base_url()."orgreport/".(int)$order_id."?full=".$_REQUEST["full"];
}

$framesrc=base_url()."orgreport/".(int)$order_id."/".(int)$perccheck."?full=".$_REQUEST["full"];
?>
<center>
<img src="<?php echo base_url();?>assets/images/loading.gif">
<br>
Loading PDF, Please wait.
</center>
<div style="display:none;">
<iframe id="pdfframe1" src="<?php echo $framesrc;?>" width="1px" height="1px"></iframe>
<iframe id="pdfframe2" width="1px" height="1px"></iframe>
</div>

