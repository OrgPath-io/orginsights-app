<?php
$query_number_of_orders = $this->db->query("SELECT * from orders where user_id = ".$this->session->userdata('user_id')." and order_id=".$order_id);

$query_number_of_orders1f=$query_number_of_orders->result_array();

$PackageID=(int)$query_number_of_orders1f[0]["order_package_id"];

$formsubmit=base_url().'selfassessment/professional/'.$order_id;

//check progress
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
//
$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'professional'");
													

		
							if($query_total_q_o->num_rows() > 0)
							{
								$res_q_o = $query_total_q_o->row();
								
								$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
														FROM orders_assessment_type_responses oatr
														LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
														WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'professional' AND oatr.oa_val > -99");
								$res_a_o = $query_total_a_o->row();
								
								if($res_q_o->total_question==0)
								{
									$progress_o = 0;
								}
								else
								{
								$progress_o = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
								}
							}else{
								$progress_o = 0;
							}
//end
?>
<script>
function discontinue_click()
{
	document.getElementById("continuelater").value=1;
	document.getElementById("orginsight_assessment_form").submit();
}
</script>
<form id="orginsight_assessment_form" name="orginsight_assessment_form" method="Post" action="javascript:showamessage()" >
<input type="hidden" name="continuelater" id="continuelater" value=0>

<div class="page-banner">
<div class="container clearfix">
<h1>Orginsights Assessment</h1>
<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
</div>
</div>

<div class="section">
<div class="container">
<?php
$tabmenu2=1;
include("tabmenus.php");?>
<form id="orginsight_assessment_form" name="orginsight_assessment_form">
<div class="assessment-list">
<?php
		$div_count = 1;
		$counter = 1;
		$div_id = 1;
		//echo count($selfassessment);
		$state = false;
		$state_count = 0;
		foreach($selfassessment as $row)
		{
		
if($row['question_id']==13 || $row['question_id']==110 || $row['question_id']==128)
{	

	$imagearray=array("a","b","c","d","e");

	if($row['question_id']==13)
	{

		if(date("s") < 13)
		{
			$qas=array(5,4,3,2,1,0);
		}
		else if(date("s") < 25)
		{
			$qas=array(4,5,3,2,1,0);
		}
		else if(date("s") < 37)
		{
			$qas=array(3,4,5,2,1,0);
		}
		else if(date("s") < 49)
		{
			$qas=array(3,1,2,5,4,0);
		}
		else
		{
			$qas=array(0,1,5,4,2,3);
		}
		
		
	}
	else
	{

		if(date("s") < 13)
		{
			$qas=array(4,3,2,1,0);
		}
		else if(date("s") < 25)
		{
			$qas=array(4,3,2,1,0);
		}
		else if(date("s") < 37)
		{
			$qas=array(3,4,2,1,0);
		}
		else if(date("s") < 49)
		{
			$qas=array(3,1,2,4,0);
		}
		else
		{
			$qas=array(0,1,2,4,3);
		}
		
		/*
		$interchangeopt=array();
		$icnt=0;
		foreach($qas as $key=>$value)
		{
			$interchangeopt[$key]=$row['question_id']."-".$imagearray[$value].".png";
			$icnt++;
			
		}
		
		foreach($interchangeopt as $key=>$value)
		{
			$row['responses'][$key]['answers']=$value;
		}
		*/
	}
	
	$interchangeopt=array();
	$interchangeopt2=array();
	$icnt=0;
	foreach($qas as $key=>$value)
	{
		$interchangeopt[$key]=$row['responses'][$value]['Score'];
		$interchangeopt2[$key]=$row['responses'][$value]['answers'];
		$icnt++;
		
	}
	
	foreach($interchangeopt as $key=>$value)
	{
		$row['responses'][$key]['Score']=$value;
		$row['responses'][$key]['answers']=$interchangeopt2[$key];
		
	}
	
	
}
if($row['question_id']==128)
{
//include("tester.php");
}
		
			
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
	<div class="list-item">
		<span><?php echo $counter;?></span>
		<h4><?php echo $row['question'];?></h4>
		<?php if ($row['show_type'] == 'image'){




 ?> <div> <img src="<?php echo base_url().'asset/images/questions/'.$row['question_id'].'-1.png';?>" /></div><?php } ?>
		<div class="row customSelectMainWrap2">
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][0]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][0]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][0]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][0]['answers'];?>" /><?php }else{  echo $row['responses'][0]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][1]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][1]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][1]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][1]['answers'];?>" /><?php }else{  echo $row['responses'][1]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][2]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][2]['Score'];?>"  <?php if($row['oatr_id'].'_'.$row['responses'][2]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][2]['answers'];?>" /><?php }else{  echo $row['responses'][2]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][3]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][3]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][3]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][3]['answers'];?>" /><?php }else{  echo $row['responses'][3]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][4]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][4]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][4]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
					<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][4]['answers'];?>" /><?php }else{  echo $row['responses'][4]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<?php
			if ($row['responses'][5]['answers']!=""){
			?>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][5]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][5]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][5]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
					<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][5]['answers'];?>" /><?php }else{  echo $row['responses'][5]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<?php
			}
			?>
		</div>
	</div>
	
	<?php	
			if($div_count >= 4 || $counter >= count($selfassessment))
			{
		?>
				<?php
				if($counter >= count($selfassessment))
				{
				
					$buttontext="FINISH";
					if($PackageID==1 || $PackageID==3){
						$buttontext="FINISH AND CONTINUE TO 360 ASSESSMENT";
					}
				
				?>
<div class="text-center bottomBtns"> <?php if($div_id > 1){?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id- 1;?>);"  class="btn btn-secondary" id="<?php echo $div_id;?>">Back</a><br><br><?php } ?>   <button style="padding: 0.6rem 1.5rem !important;" type="submit" class="btn btn-secondary" ><?php echo $buttontext;?></button><?php if($PackageID==1212){?> <button type="button" class="btn btn-secondary">CONTINUE TO 360 ASSESSMENT</button> <?php }?></div>
				<?php
				}else{
				?>
				<div class="text-center bottomBtns"> <?php if($div_id > 1){?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id- 1;?>);" class="btn btn-secondary" id="<?php echo $div_id;?>">Back</a> <?php } ?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id+1;?>,1);" class="btn btn-secondary" id="<?php echo $div_id;?>">CONTINUE</a> <a href="javascript:void(0);" onclick="discontinue_click();"  class="btn btn-secondary">Save to Continue Later</a>
				
				</div>
				<div style="display:none;">
				<button type="submit" class="btn btn-secondary" >Save to Continue Later</button> </div>
				</div>
				<?php
				}
				
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
<?php		
?>
</div>

</div>
</div>
</form>
<script type="text/javascript">
var state_id = <?php echo $state_id;?>;

var progressbar = <?php echo (int)$progress_o;?>-8;

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
	
	
	if(document.getElementById("Orgprogress"))
	{
		document.getElementById("Orgprogress").innerHTML=progressbar+"%";
		document.getElementById("Orgprogress").style.width=pwidth+"%";
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
		document.getElementById("orginsight_assessment_form").action="javascript:showamessage()"
	}
	//alert("ok");
}
function submitacheck()
{
	document.getElementById("orginsight_assessment_form").action=formsubmit;
}
</script>
