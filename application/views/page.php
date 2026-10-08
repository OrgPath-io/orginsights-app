
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            flex-direction: column; 
            gap: 20px; 
        }

        .pricing-table {
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1200px; 
        }

        .pricing-option {
            background-color: white;
            border: 1px solid #ddd;
            padding: 30px; 
            width: calc(33.33% - 20px); 
            text-align: center;
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            transition: transform 0.2s; 
        }

        .pricing-option:hover {
            transform: translateY(-5px); 
        }

        .pricing-option h2 {
            color: #007bff; 
            font-size: 1.8rem; 
            margin-bottom: 20px;
        }

        .pricing-option h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            color: #333; 
        }

        .pricing-option p {
            font-weight: bold;
            margin-bottom: 20px; 
            color: #555; 
        }

        .pricing-option ul {
            list-style: none;
            line-height: 1.8; 
            text-align: left;
            padding: 0 20px; 
        }

        .pricing-option ul li {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee; 
            padding-bottom: 10px; 
        }

        .highlight {
            background-color: #007bff; 
            color: white;
        }

        .highlight h2, .highlight h1, .highlight p, .highlight ul li {
            color: white;
        }

        .highlight ul li {
            border-bottom-color: rgba(255, 255, 255, 0.3); 
        }
		
.pricing-table button
{
	background:#ffffff;
	padding:0;
	color:#126aaf;
	text-transform: uppercase;
	font-weight: 300;
	font-size: 15.76px;
	border:0;
	line-height: 42px;
	width: 150px;
	height: 42px;
	cursor:pointer;
}
.pricing-table button:focus
{
	outline: 0;
	box-shadow: 0 0 0;
}

.pricing-option {
	background:#19877d;
	color:#ffffff;
	margin:10px;
	background: #157597 !important;background: linear-gradient(172deg,rgba(21, 117, 151, 1) 25%, rgba(19, 155, 90, 1) 50%, rgba(50, 157, 22, 1) 100%) !important;
}	

.pricing-table {
    display: flex;
    justify-content: center;
    width: 80%;
    max-width: 1200px;
}
		
    </style>
<?php
$query_number_of_orders = $this->db->query("SELECT * from orders where user_id = ".$this->session->userdata('user_id')."  and order_package_id < 7 order by order_id desc");

$query_number_of_orders1f=$query_number_of_orders->result_array();
$orderpackage=0;
if(isset($query_number_of_orders1f[0]["order_package_id"]) && is_numeric($query_number_of_orders1f[0]["order_package_id"]))
{
	$orderpackage=(int)$query_number_of_orders1f[0]["order_package_id"];
}

$dontshow1='style="background:none;border:0px;box-shadow:0 0 0;"';
$dontshow2='style="display:none;"';

?>	
<div class="page-banner">
        <div class="container clearfix">
            <a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>	
   <div class="pricing-table">
        <div <?php if($orderpackage >= 0){echo $dontshow2;}?> class="pricing-option highlight">
		<div <?php if($orderpackage >= 0){echo $dontshow2;}?>>
            <h2>LEARN ABOUT YOURSELF</h2>
            <h1>0</h1>
            <p>WHAT YOU GET:</p>
            <ul>
                <li>SELF ASSESSMENT</li>
                <li>ORINSIGHT (OR 360) ASSESSMENT</li>
                <li>ORINSIGHTS GUIDE WITH RESUME AND INTERVIEW TIPS</li>
                <li>ORINSIGHTS SUMMARY REPORT</li>
            </ul>
			<p style="line-height:90px;">&nbsp;</p>
			<form id="checkout2" action="<?php echo base_url()?>checkout" method="Post">
			<input type="hidden" name="token" value="FREE">
			<input type='hidden' name='amount' value='0'>
			<input type="hidden" id="referralcode" name="referralcode" class="form-control" value="<?php echo trim($this->session->userdata('ref_code'));?>" readonly>
			<input type='hidden' name='item_number' value='PHPPOTEG#1'>
			<input type='hidden' name='currency_code' value='CAD'>
			<input type="hidden" name="package_id" id="package_id" value="4" />
			<input type='hidden' name='ActualTicks' value='<?php echo (int)$_POST['ActualTicks'];?>'>
			<button id="orgin" data-dismiss="modal">Select</button>
			</form>
		</div>	
        </div>
        <div <?php if($orderpackage >= 5){echo $dontshow2;}?> class="pricing-option highlight">
		<div <?php if($orderpackage >= 5){echo $dontshow2;}?>>
            <h2>TAKE CONTROL OF YOUR CAREER</h2>
            <h1>49</h1>
            <p>WHAT YOU GET:</p>
            <ul>
                <li>EVERYTHING FROM THE PREVIOUS PACKAGE +</li>
                <li>DETAILED ORINSIGHTS (OR 360) ASSESSMENT</li>
                <li>SUGGESTIONS ON OTHER INDUSTRIES THAT MIGHT SUIT YOU</li>
                <li>A DEVELOPMENT PLAN WITH LINKEDIN LEARNING COURSES FOR YOUR GROWTH AREAS</li>
            </ul>
			<form id="checkout2" action="<?php echo base_url()?>checkout" method="Post">
			<input type='hidden' name='amount' value='49'>
			<input type="hidden" id="referralcode" name="referralcode" class="form-control" value="<?php echo trim($this->session->userdata('ref_code'));?>" readonly>
			<input type='hidden' name='item_number' value='PHPPOTEG#1'>
			<input type='hidden' name='currency_code' value='CAD'>
			<input type="hidden" name="package_id" id="package_id" value="5" />
			<input type='hidden' name='ActualTicks' value='<?php echo (int)$_POST['ActualTicks'];?>'>
			<button id="orgin" data-dismiss="modal">pay now</button>
			</form>
		</div>	
        </div>
        <div <?php if($orderpackage >= 6){echo $dontshow2;}?> class="pricing-option highlight">
		<div <?php if($orderpackage >= 6){echo $dontshow2;}?>>
            <h2>THE CHEAT CODE</h2>
            <h1>99</h1>
            <p>WHAT YOU GET:</p>
            <ul>
                <li>EVERYTHING FROM THE PREVIOUS PACKAGE +</li>
                <li>60 MIN COACHING SESSION WITH AN ORINSIGHTS COACH TO GO OVER YOUR SCORES IN DETAIL</li>
                <li>REVIEW YOUR RESUME, TALK ABOUT INTERVIEWING OR GET CAREER ADVICE</li>
            </ul>
			<p style="line-height:68px;">&nbsp;</p>
			<form id="checkout2" action="<?php echo base_url()?>checkout" method="Post">
			<input type='hidden' name='amount' value='99'>
			<input type="hidden" id="referralcode" name="referralcode" class="form-control" value="<?php echo trim($this->session->userdata('ref_code'));?>" readonly>
			<input type='hidden' name='item_number' value='PHPPOTEG#1'>
			<input type='hidden' name='currency_code' value='CAD'>
			<input type="hidden" name="package_id" id="package_id" value="6" />
			<input type='hidden' name='ActualTicks' value='<?php echo (int)$_POST['ActualTicks'];?>'>
			<button id="orgin" data-dismiss="modal">pay now</button>
			</form>
        </div></div>
    </div>	