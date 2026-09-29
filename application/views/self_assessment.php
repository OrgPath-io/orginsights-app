<?php
$query_number_of_orders = $this->db->query("SELECT * from orders where user_id = ".$this->session->userdata('user_id')." and order_id=".$order_id);

$query_number_of_orders1f=$query_number_of_orders->result_array();

$PackageID=(int)$query_number_of_orders1f[0]["order_package_id"];

$formsubmit=base_url().'selfassessment/'.$order_id;


//checkprogress
$query_total_q_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'self'");
if($query_total_q_s->num_rows() > 0)
							{
								$res_q_s = $query_total_q_s->row();
								$query_total_a_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'self' AND oatr.oa_val > -99");
							$res_a_s = $query_total_a_s->row();
							
							if($res_q_s->total_question==0)
							{
								$progress_s = 0;
							}
							else
							{
								$progress_s = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
							}
							}else{
								$progress_s = 0;
							}									
//end
?>
<script>
function discontinue_click()
{
	document.getElementById("continuelater").value=1;
	document.getElementById("selfassessment_form").submit();
}
</script>
<form id="selfassessment_form" name="selfassessment_form" method="Post" action="javascript:showamessage()" >
<input type="hidden" name="continuelater" id="continuelater" value=0>
<div class="page-banner">
<div class="container clearfix">
<h1>Self Assessment</h1>

<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>

</div>
</div>

<div class="section">
<div class="container">
<?php
$tabmenu1=1;
include("tabmenus.php");?>


<?php


		$div_count = 1;
		$counter = 1;
		$div_id = 1;
		//echo count($selfassessment);
		$state = false;
		$state_count = 0;
		foreach($selfassessment as $row)
		{
			
			if( $row['answer_id']==-99 && $state_count ==0 && $state === false)
			{
				$state = true;
				$state_id =$div_id;
			}
			if($div_count == 1)
			{
				
		?>		
				<div id="div<?php echo $div_id;?>" class="unknow"  style="display:none;" >
		<?php		
			}
		?>	
			<div class="mb-5">
			<!--<h3><?php echo $row['cat_name'];?></h3>
			<h5><?php echo $row['cap_name'];?></h5>-->
			<p class="selfQuestionContentDiv">
				<span class="questionNo"><?php echo $counter;?></span>
				<?php if($row['general_instruction'] !== '')
				{
				?>
				<div style="text-align: left; padding-left:40px;"><span class="questionContent"><strong> <?php echo $row['general_instruction'];?></strong></span></div>
				<div style="text-align: left; padding-left:40px;" class="geninstruc"><span class="general_instruction">( <?php echo $row['question'];?>  )</span></div>
				<?php
				}else{
				?>
				<div style="text-align: left; padding-left:40px;"><span class="questionContent"><strong> <?php echo $row['question'];?></strong>  </span></div>
				<?php
				}
				?>
			</p>
			
			</div>
			<div class="categoy-block">
	<div class="row justify-content-center1 customSelectMainWrap">
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][0]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">0</span>
		  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][0]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][0]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][0]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][1]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">1</span>
		  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][1]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][1]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][1]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][2]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">2</span>
		  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][2]['Score'];?>"  <?php if($row['oatr_id'].'_'.$row['responses'][2]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][2]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][3]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">3</span>
		  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][3]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][3]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][3]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][4]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">4</span>
		  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][4]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][4]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][4]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][5]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">5</span>
		  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][5]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][5]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][5]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
	</div>
</div>
			
		<?php	
			if($div_count >= 4 || $counter >= count($selfassessment))
			{
		?>
				<?php
				if($counter >= count($selfassessment))
				{
				
					$buttontext="Submit";
					if($PackageID==1){
						$buttontext="FINISH AND CONTINUE TO 360 ASSESSMENT";
					}
					else if($PackageID==3){
						$buttontext="FINISH AND CONTINUE TO Orginsights ASSESSMENT";
					}
					else if($PackageID==2){
						$buttontext="FINISH AND CONTINUE TO Orginsights ASSESSMENT";
					}
				
				?>
<div class="text-center bottomBtns"> <?php if($div_id > 1){?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id- 1;?>);" class="btn btn-secondary" id="<?php echo $div_id;?>">Back</a> <?php } ?>   <button type="submit" class="btn btn-secondary" ><?php echo $buttontext;?></button> </div>
				<?php
				}else{
				
				/*style="padding-left:30px;padding-right:30px;"*/
				?>
				<div class="text-center bottomBtns"> <?php if($div_id > 1){?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id- 1;?>);" class="btn btn-secondary" id="<?php echo $div_id;?>">Back</a> <?php } ?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id+1;?>,1);"  class="btn btn-secondary" id="<?php echo $div_id;?>">CONTINUE</a> <a href="javascript:void(0);" onclick="discontinue_click();" class="btn btn-secondary">Save to Continue Later</a>
				
				<div style="display:none;">
				<button type="submit" class="btn btn-secondary" >Save to Continue Later</button> </div>
				</div>
				
				
				
				
				<?php
				/**/
				}
				?>
				</div>
		<?php
				$div_id++;
			}
			$div_count++;
			
			if($div_count >4 )
			{
				$div_count = 1;
			}
			$counter++;
		}
?>


</div>
</div>
</form>
<script type="text/javascript">
var state_id = <?php echo $state_id;?>;
var progressbar = <?php echo (int)$progress_s;?>-8;

formsubmit="<?php echo $formsubmit;?>";
function showamessage()
{
	alert("Please Select Answer for all questions");
}

function checkprogress(n1)
{

	
		progressbar+=8;
		
		if(progressbar > 100)
		{
			progressbar=100;
		}
	
	
	pwidth=progressbar;
	
	if(pwidth < 5)
	{
		pwidth=5;
	}
	
	
	if(document.getElementById("Selfprogress"))
	{
		document.getElementById("Selfprogress").innerHTML=progressbar+"%";
		document.getElementById("Selfprogress").style.width=pwidth+"%";
	}
}

function checkform(id,n1=0)
{
	if(n1==1)
	{
		idless=id-1;
		if(document.getElementById("div"+idless))
		{
			var divname=document.getElementById("div"+idless).innerHTML;
		
			
			checkradio=new Array();
			
			checkradiocnt=0;
		
			var radios = document.getElementsByTagName('input');
			for (i = 0; i < radios.length; i++) {
				if (radios[i].type == 'radio') {
					checkradioname=radios[i].name;
					checkradioid='id="'+checkradioname+'"';
						
					if(divname.indexOf(checkradioid) > 0)
					{
						var n = checkradio.includes(checkradioname);
					
						if(n > 0)
						{
						}
						else
						{
							checkradiocnt++;
							checkradio[checkradiocnt]=checkradioname;
							
						}
					}
					
				}
				
			}
			
			moveforward=1;
			for(i=1;i<=checkradiocnt;i++)
			{
				var radios = document.getElementsByName(checkradio[i]);
				
				var checkforward=0;
				
				for(var j = 0; j < radios.length; j++){
					
					if(radios[j].checked)
					{
						checkforward=1;
					}
				}
				
				if(checkforward==0)
				{
					moveforward=0;
				}
			}
		}	
	}

	//alert();
	if(n1==0)
	{
		moveforward=1;
	}
	
	if(moveforward==1)
	{
		submitacheck();
	}
	else
	{
		document.getElementById("selfassessment_form").action="javascript:showamessage()"
	}
	//alert("ok");
}
function submitacheck()
{
	document.getElementById("selfassessment_form").action=formsubmit;
}
</script>
