<?php
$AMOUNT=$_REQUEST["amount"];
$refcode=$_REQUEST["referralcode"];
$this->db->where('ReferralCode', $refcode);
$checkReferralCodesQ=$this->db->get('ReferralCodes');
$checkReferralCodes=$checkReferralCodesQ->row_array();
if($checkReferralCodes!="" && $refcode!="")
{
	$AMOUNT2=$AMOUNT;
	if($checkReferralCodes['ReferralType']=='percentage')
	{
		$AMOUNT2*=$checkReferralCodes['ReferralValue'];
		$AMOUNT2/=100;
		$AMOUNT2=(int)$AMOUNT2;
		$AMOUNT3=$AMOUNT2;
	}
	else
	{
		$AMOUNT2=$checkReferralCodes['ReferralValue'];
		$AMOUNT=$AMOUNT2;
		$AMOUNT3=$AMOUNT-$AMOUNT2;
	}
	$AMOUNT=$AMOUNT-$AMOUNT3;
	$_POST['amount']=$AMOUNT;
	
	$grand_total=$AMOUNT;
	$discount_amount=$AMOUNT3;
	$discount_code=$_POST["referralcode"];
}
?>
<script>
window.parent.showupdatedprice("<?php echo $AMOUNT;?>");
</script>