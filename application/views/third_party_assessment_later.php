<?php
$formsubmit=base_url().'assessment/thirdparty_rater/'.$unique;
?>
<form id="selfassessment_form" name="selfassessment_form" method="Post" action="javascript:showamessage()" >
<div class="page-banner">
<div class="container clearfix">
<h1>Assessment - Rater for <?php echo $result_oat[0]['b_first_name']. ' '.$result_oat[0]['b_last_name'];?></h1>
<?php
if($this->session->userdata('user_id'))
{
?>
<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
<?php
}
?>
</div>
</div>

<div class="section">
<div class="container">



<?php

//die();
		$div_count = 1;
		$counter = 1;
		$div_id = 1;
		//echo count($selfassessment);
		$state = false;
		$state_count = 0;
		foreach($selfassessment as $row)
		{
		
		if($counter > 0)
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
				<span class="questionContent"><strong> <?php echo $row['general_instruction'];?></strong></span>
				<?php
				}
				
				$cname=$result_oat[0]['b_first_name']. ' '.$result_oat[0]['b_last_name'];
				$questionvalue=$row['question'];
				$questionvalue=str_replace("[candidate\'s name]",$cname,$questionvalue);
				$questionvalue=str_replace("[candidate's name]",$cname,$questionvalue);
				?>
				<span class="general_instruction">( <?php echo $questionvalue;?>  )</span>
				
			</p>
			
			</div>
			<div class="categoy-block selfQuestionNewWrap">
	<div class="row justify-content-center customSelectMainWrap">
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_'.$row['responses'][0]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">0</span>
		  		<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_'.$row['responses'][0]['Score'];?>" <?php if($row['oatrr_id'].'_'.$row['responses'][0]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][0]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_'.$row['responses'][1]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">1</span>
		  		<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_'.$row['responses'][1]['Score'];?>" <?php if($row['oatrr_id'].'_'.$row['responses'][1]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][1]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_'.$row['responses'][2]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">2</span>
		  		<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_'.$row['responses'][2]['Score'];?>"  <?php if($row['oatrr_id'].'_'.$row['responses'][2]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][2]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_'.$row['responses'][3]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">3</span>
		  		<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_'.$row['responses'][3]['Score'];?>" <?php if($row['oatrr_id'].'_'.$row['responses'][3]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][3]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_'.$row['responses'][4]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">4</span>
		  		<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_'.$row['responses'][4]['Score'];?>" <?php if($row['oatrr_id'].'_'.$row['responses'][4]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][4]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>
		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_'.$row['responses'][5]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<span class="number">5</span>
		  		<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_'.$row['responses'][5]['Score'];?>" <?php if($row['oatrr_id'].'_'.$row['responses'][5]['Score'] == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
		  		<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo $row['responses'][5]['answers'];?></span>
				</div>
		  		<span class="checkmark"></span>
			</label>
		</div>

		<div class="col-2">
			<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatrr_id'].'_-1' == $row['oatrr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
				<?php /*<span class="number">6</span>*/?>
				<input  onclick="checkform(<?php echo $div_id+1;?>,1);" type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatrr_id'].'_-1';?>" <?php if($row['oatrr_id'].'_-1' == $row['oatrr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
				<div class="embed-responsive embed-responsive-1by1">
					<span class="label"><?php echo 'N/A';?></span>
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
				?>
<div class="text-center bottomBtns"> <?php if($div_id > 1){?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id- 1;?>);" class="btn btn-secondary" id="<?php echo $div_id;?>">Back</a> <?php } ?>   <button type="submit" class="btn btn-secondary" >Submit</button> </div>
				<?php
				}else{
				?>
				<div class="text-center bottomBtns"> <?php if($div_id > 1){?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id- 1;?>);" class="btn btn-secondary" id="<?php echo $div_id;?>">Back</a> <?php } ?> <a href="javascript:void(0);" onclick="continue_click(<?php echo $div_id+1;?>,1);" style="padding-left:30px;padding-right:30px;" class="btn btn-secondary" id="<?php echo $div_id;?>">CONTINUE</a>   <button type="submit" class="btn btn-secondary" >Save to Continue Later</button> </div>
				<?php
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
		}	
			$counter++;
		}
?>


</div>
</div>
</form>
<script type="text/javascript">
var state_id = <?php echo $state_id;?>;

formsubmit="<?php echo $formsubmit;?>";
function showamessage()
{
	alert("Please Select Answer for all questions");
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
