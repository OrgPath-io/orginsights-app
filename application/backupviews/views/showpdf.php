<center>
<img src="<?php echo base_url();?>assets/images/loading.gif">
<br>
Loading PDF, Please Wait
<input type="hidden" id="pdfinput" value="test">
<div style="display:none;">
<?php
if($pdftype==3)
{
	$pdfpageshow="report360";
}
else
{
	$pdfpageshow="orgreport";
}

if($perccheck==1)
{
	$pdfperc="/1";
}
else
{
	$pdfperc="";
}
?>
<script>
location.href="<?php echo base_url();?><?php echo $pdfpageshow;?>/<?php echo (int)$order_id;?><?php echo $pdfperc;?>";
</script>
<?php
die();
?>
<iframe id="pdfframe" src="<?php echo base_url();?><?php echo $pdfpageshow;?>/<?php echo (int)$order_id;?><?php echo $pdfperc;?>" width="1px" height="1px"></iframe>
</div>
</center>
<script>
function checkIframeLoaded() {
    // Get a handle to the iframe element
    var iframe = document.getElementById('pdfframe');
    var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

    // Check if loading is complete
    if (  iframeDoc.readyState  == 'complete' ) {
        //iframe.contentWindow.alert("Hello");
        iframe.contentWindow.onload = function(){
            //document.getElementById('pdfinput').value="I am loaded";
        };
        // The loading is complete, call the function we want executed once the iframe is loaded
        afterLoading();
        return;
    } 

    // If we are here, it is not loaded. Set things up so we check   the status again in 100 milliseconds
    window.setTimeout(checkIframeLoaded, 100);
}

function afterLoading(){
    document.getElementById('pdfinput').value="I am here";
	window.open('','_self').close()
}
checkIframeLoaded();
</script>