<?php
use \PhpPot\Service\StripePayment;

include("stripeconfig.php");

include("convert_currency.php");

if (!empty($_POST["token"])) {



    include("StripePayment.php");
    $stripePayment = new StripePayment();
	

	
	$AMOUNT=$_POST['amount'];
	$order_total=$AMOUNT;
	$grand_total=$AMOUNT;
	$discount_amount=0;
	$discount_code="";
	
	/*
	if($_POST["referralcode"]!="" && $_POST["referralcode"]=="ORG22TSTFREE")
	{
		//Free
		$AMOUNT2=$AMOUNT;
		$AMOUNT=0;
		
		$_POST['amount']=$AMOUNT;
		
		
		$grand_total=$AMOUNT;
		$discount_amount=$AMOUNT2;
		$discount_code=$_POST["referralcode"];
		
		
	}
	else if($_POST["referralcode"]!="" && $_POST["referralcode"]=="ORG22TSTTEN")
	{
		//$10
		$AMOUNT2=10;
		$AMOUNT-=$AMOUNT2;
		
		$_POST['amount']=$AMOUNT;
		
		
		$grand_total=$AMOUNT;
		$discount_amount=$AMOUNT2;
		$discount_code=$_POST["referralcode"];
		
		
	}
	else if($_POST["referralcode"]!="" && $_POST["referralcode"]==trim($this->session->userdata('ref_code')))
	{
		$AMOUNT2=$AMOUNT;
		$AMOUNT2*=30;
		$AMOUNT2/=100;
		$AMOUNT2=(int)$AMOUNT2;
		
		$AMOUNT=$AMOUNT-$AMOUNT2;
		
		$_POST['amount']=$AMOUNT;
		
		
		$grand_total=$AMOUNT;
		$discount_amount=$AMOUNT2;
		$discount_code=$_POST["referralcode"];
		
		
	}
	*/
	if($_POST["referralcode"]!="" && $_POST["referralcode"]==trim($this->session->userdata('ref_code')))
	{
		$AMOUNT2=$AMOUNT;
		if($this->session->userdata('ref_code_type')=='percentage')
		{
			$AMOUNT2*=$this->session->userdata('ref_code_value');
			$AMOUNT2/=100;
			$AMOUNT2=(int)$AMOUNT2;
		}
		else
		{
			$AMOUNT2=$this->session->userdata('ref_code_value');
		}
		$AMOUNT=$AMOUNT-$AMOUNT2;
		$_POST['amount']=$AMOUNT;
		
		$grand_total=$AMOUNT;
		$discount_amount=$AMOUNT2;
		$discount_code=$_POST["referralcode"];
	}
	
	
	
	//for billing
	$query_user = $this->db->query("select * from users where email = '".$this->session->userdata('site_user_name')."' limit 1");
	
	if($query_user->num_rows() > 0)
	{
		$row_user = $query_user->row();
		$city=(int)$row_user->city;
		$country=(int)$row_user->country_id;
		$line1=$row_user->address;
		$line2="";
		$postal_code="";
		$state=(int)$row_user->province;
		
		
		$_POST["city"]="";
		$_POST["country"]="";
		$_POST["line1"]=$line1;
		$_POST["line2"]="";
		$_POST["postal_code"]="";
		$_POST["state"]="";
		
		
		$query_user2 = $this->db->query("select * from Cities where id = '".$city."' limit 1");
		if($query_user2->num_rows() > 0)
		{
			$row_user2 = $query_user2->row();
			$_POST["city"]=$row_user2->description;
		}
		
		$query_user2 = $this->db->query("select * from countries where id = '".$country."' limit 1");
		if($query_user2->num_rows() > 0)
		{
			$row_user2 = $query_user2->row();
			$_POST["country"]=$row_user2->country;
		}
		
		$query_user2 = $this->db->query("select * from provinces where id = '".$state."' limit 1");
		if($query_user2->num_rows() > 0)
		{
			$row_user2 = $query_user2->row();
			$_POST["state"]=$row_user2->province_name;
		}
		
	}
	//

	//print_r($_POST);
    if($grand_total==0)
	{
		$stripeResponse=array();
		$stripeResponse['amount_refunded']=0;
		$stripeResponse['failure_code']="";
		$stripeResponse['paid']=1;
		$stripeResponse['captured']=1;
		$stripeResponse['status']='succeeded';
		$stripeResponse["currency"]="CAD";
		$stripeResponse["customer"]="";
		$stripeResponse["balance_transaction"]="Free";

	}
	else
	{
		include("invalidcardmsg.php");
		
		$stripeResponse = $stripePayment->chargeAmountFromCard($_POST);
	}
	//print_r($stripeResponse); die();
    
	/*
    require_once "DBController.php";
    $dbController = new DBController();
    
    $amount = $stripeResponse["amount"] /100;
    
    $param_type = 'ssdssss';
    $param_value_array = array(
        $_POST['email'],
        $_POST['item_number'],
        $amount,
        $stripeResponse["currency"],
        $stripeResponse["balance_transaction"],
        $stripeResponse["status"],
        json_encode($stripeResponse)
    );
    $query = "INSERT INTO tbl_payment (email, item_number, amount, currency_code, txn_id, payment_status, payment_response) values (?, ?, ?, ?, ?, ?, ?)";
    $id = $dbController->insert($query, $param_type, $param_value_array);
    */
    if ($stripeResponse['amount_refunded'] == 0 && empty($stripeResponse['failure_code']) && $stripeResponse['paid'] == 1 && $stripeResponse['captured'] == 1 && $stripeResponse['status'] == 'succeeded') {
        $successMessage = "Stripe payment is completed successfully. The TXN ID is " . $stripeResponse["balance_transaction"];
		
		//print_r($_POST);
		$PeriodStart=0;
		$PeriodEnd=0;
		
		$query = "INSERT INTO AssessmentsPayments (customerid,PeriodStart,PeriodEnd,name,cardnumber,month,year,email, item_number, item_name, discount_code, discount_amount, amount, currency_code, txn_id, payment_status, payment_response) values ('".$stripeResponse["customer"]."','".$PeriodStart."','".$PeriodEnd."','', '', '0', '0', '".$email."', '".$_POST['item_number']."', '".$order_package_name."', '".$discount_code."', '".$discount_amount."', '".$grand_total."', '".strtoupper($stripeResponse["currency"])."', '".$stripeResponse["balance_transaction"]."','".$stripeResponse["status"]."','".json_encode($stripeResponse)."')";
	
		$this->db->query($query);
		
		
		//var_dump($stripeResponse); die();
		
		?>
		<form action="#" method="post" id="strform">
		<input type='hidden' name='order_total' value='<?php echo $order_total;?>'> 
		<input type='hidden' name='grand_total' value='<?php echo $grand_total;?>'> 
		<input type='hidden' name='discount_amount' value='<?php echo $discount_amount;?>'> 
		<input type='hidden' name='discount_code' value='<?php echo $discount_code;?>'> 
		<input type='hidden' name='amount' value='<?php echo $grand_total;?>'> <input type='hidden' name='currency_code' value='<?php echo $_POST['currency_code'];?>'>
		<input type='hidden' name='item_name' value='<?php echo $order_package_name;?>'>
		<input type='hidden' name='transaction_id' value='<?php echo $stripeResponse["balance_transaction"];?>'>
		
		<input type='hidden' name='package_id' value='<?php echo $_POST['package_id'];?>'>
		
		<input type='hidden' name='stripesuccessful' id='stripesuccessful' value=1>
		</form>
		<script>
		document.getElementById("strform").submit();
		</script>
		<?php
    }
}
?>
<div class="page-banner">
<div class="container clearfix">
<h1>Payment Details</h1>
<?php

	
?>

<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>

</div>
</div>
<link href="<?php echo base_url();?>/assets/css/stripestyle.css" rel="stylesheet" type="text/css"/ >
<?php if(!empty($successMessage)) { ?>
    <div id="success-message"><?php echo $successMessage; ?></div>
    <?php  } ?>
    <div id="error-message"></div>
	
	<div class="col-md-12">
                <div class="register-form">
                            <div class="common-form">
            <form id="frmStripePayment" action=""
                method="post">
				<?php
				$onclick='';
				if(trim($this->session->userdata('ref_code'))=="ORG22TSTFREE")
				{
				?>
				<input type="hidden" name="token" value="FREE">
				<?php	
				}
				else if(trim($this->session->userdata('ref_code'))=="ORG22TSTTEN" && $assessments_array[(int)$_POST['package_id']]==10)
				{
				?>
				<input type="hidden" name="token" value="FREE">
				<?php	
				}
				else
				{
				$onclick='onClick="stripePay(event);"';
				}
				if($onclick!="")
				{
				?>
				<div style="float:left;" class="col-md-6">
                <div class="form-group">
                    <label>Card Holder Name</label> <span
                        id="card-holder-name-info" class="info"></span><br>
                    <input type="text" id="name" name="name" value="<?php echo $this->session->userdata('first_name').' '.$this->session->userdata('last_name');?>"
                        class="form-control">
                </div>
				</div>
				<div style="float:left;" class="col-md-6">
                <div class="form-group">
                    <label>Email</label> <span id="email-info"
                        class="info"></span><br> <input type="text"
                        id="email" name="email" value="<?php echo $this->session->userdata('site_user_name');?>" class="form-control">
                </div>
				</div>
				<div style="float:left;" class="col-md-6">
                <div class="form-group">
					<div style="padding-left:0px;" class="col-md-12">
                        <label>Card Number</label>
						</div>
                    <div style="clear:both;"></div>
<div style="padding-left:0px;" class="col-md-12">
<span
                        id="card-number-info" class="info"></span><br> <input
                        type="text" id="card-number" name="card-number"
                        class="form-control">
</div>						
                </div>
				</div>
				<div style="float:left;" class="col-md-6">
                <div class="form-group">
                    <div class="contact-row column-right">
						<div style="float:left;" class="col-md-4">
                        <label>Expiry Month</label>
						</div>
						<div style="float:left;" class="col-md-4">
                        <label>Expiry Year</label>
						</div>
						<div style="float:left;" class="col-md-4">
                        <label>CVC</label>
						</div>
						<div style="clear:both;"></div>	
						<span
                            id="userEmail-info" class="info"></span>
						<div style="clear:both;"></div>	
						<div style="float:left;" class="col-md-4">	
                        <select name="month" id="month"
                            class="form-control">
                            <?php
		for($i=1;$i<=12;$i++)
		{
			$j=$i;
			if($j < 10)
			{
				$j="0".$i;
			}
			
			$slct="";
			if($i==date("m"))
			{
				$slct="selected";
			}

		?>
		<option value="<?php echo $j;?>" <?php echo $slct;?>><?php echo $j;?></option>
		<?php
		}
		?>
                        </select>
						</div>
						<div style="float:left;" class="col-md-4">
						<select name="year" id="year"
                            class="form-control">
                            <?php
		for($i=date("Y");$i<=date("Y")+30;$i++)
		{
			$j=$i-2000;
			if($j < 10)
			{
				$j="0".$j;
			}
			
			$slct="";
			if($i==date("Y"))
			{
				$slct="selected";
			}

		?>
		<option value="<?php echo $j;?>" <?php echo $slct;?>><?php echo $i;?></option>
		<?php
		}
		?>
                        </select>
						</div>
						<div style="float:left;" class="col-md-4">
                    
                       <input type="text"
                            name="cvc" id="cvc"
                            class="form-control cvv-input">
						</div><span id="cvv-info"
                            class="info"></span>
                </div></div>
				</div>
				<div style="clear:both;"></div>
				<?php
				}
				?>
				<?php
				if($onclick!="")
				{
				?>
				<div style="float:left;" class="col-md-6">
				<?php
				}
				else
				{
				?>
				<center>
				<div class="col-md-6">
				<?php
				}
				?>
                <div class="form-group">
					<div style="padding-left:0px;" class="col-md-12">
                        <label>Referral Code</label>
						</div>
                    <div style="clear:both;"></div>
<div style="padding-left:0px;" class="col-md-12">
<input type="text" id="referralcode" name="referralcode" class="form-control" value="<?php echo trim($this->session->userdata('ref_code'));?>" readonly>
</div>						
                </div>
				</div>
				<?php
				if($onclick=="")
				{
				?>
				</center>
				<?php
				}
				?>
				<div style="clear:both;"></div>
                <center>
				<div>
				
                    <input type="submit" name="pay_now" value="Submit"
                        id="submit-btn"  class="btn btn-secondary btn-style-2"
                        <?php echo $onclick;?>>

                    <div id="loader">
                        <img alt="loader" src="<?php echo base_url();?>/assets/images/LoaderIcon.gif">
                    </div>
                </div>
				</center>
                <input type='hidden' name='amount' value='<?php echo $assessments_array[(int)$_POST['package_id']];?>'> <input
                    type='hidden' name='currency_code' value='<?php echo $UserCurrency;?>'>
					<input
                    type='hidden' name='item_name' value='<?php echo $order_package_name;?>'>
                <input type='hidden' name='item_number'
                    value='PHPPOTEG#1'>
					
					<input type='hidden' name='package_id' value='<?php echo $_POST['package_id'];?>'>
					
					<input type='hidden' name='stripesuccessful' id='stripesuccessful' value=0>
					
            </form>
			</div></div></div>
			
			
			<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="<?php echo base_url();?>/assets/js/myjquery.js"
        type="text/javascript"></script>
    <script>
	function cardValidation () {
    var valid = true;
    var name = $('#name').val();
    var email = $('#email').val();
    var cardNumber = $('#card-number').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var cvc = $('#cvc').val();

    $("#error-message").html("").hide();

    if (name.trim() == "") {
        valid = false;
    }
    if (email.trim() == "") {
    	   valid = false;
    }
    if (cardNumber.trim() == "") {
    	   valid = false;
    }

    if (month.trim() == "") {
    	    valid = false;
    }
    if (year.trim() == "") {
        valid = false;
    }
    if (cvc.trim() == "") {
        valid = false;
    }

    if(valid == false) {
        $("#error-message").html("All Fields are required").show();
    }

    return valid;
}
//set your publishable key
Stripe.setPublishableKey("<?php echo STRIPE_PUBLISHABLE_KEY; ?>");

//callback to handle the response from stripe
function stripeResponseHandler(status, response) {
    if (response.error) {
        //enable the submit button
        $("#submit-btn").show();
        $( "#loader" ).css("display", "none");
		
		$('#stripesuccessful').val(0);
        //display the errors on the form
        $("#error-message").html(response.error.message).show();
    } else {
        //get token id
        var token = response['id'];
        //insert the token into the form
        $("#frmStripePayment").append("<input type='hidden' name='token' value='" + token + "' />");
		
		$('#stripesuccessful').val(0);
        //submit form to the server
        $("#frmStripePayment").submit();
    }
}
function stripePay(e) {
    e.preventDefault();
    var valid = cardValidation();

    if(valid == true) {
        $("#submit-btn").hide();
        $( "#loader" ).css("display", "inline-block");
        Stripe.createToken({
            number: $('#card-number').val(),
            cvc: $('#cvc').val(),
            exp_month: $('#month').val(),
            exp_year: $('#year').val()
        }, stripeResponseHandler);

        //submit from callback
        return false;
    }
}
</script>