<?php
if((int)$perccheck==1)
{
  $framesrc=base_url()."report360/".(int)$order_id."/1";
}
else
{
  $framesrc=base_url()."report360/".(int)$order_id;
}
$framesrc=base_url()."report360/".(int)$order_id."/".(int)$perccheck;
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

