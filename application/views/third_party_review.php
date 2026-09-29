<div class="page-banner">
<div class="container clearfix">
<h1>360 Assessment Review</h1>

<a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>

</div>
</div>

<div class="section">
<div class="container">
<?php
$div_count = 1;
$counter = 1;
$div_id = 1;
//echo count($selfassessment);
$state = false;
$state_count = 0;


$query_oat = $this->db->query("SELECT a.*,q.general_instruction,q.question,q.cat_id,q.cap_id,q.q_type from orders_assessment_type_responses a INNER JOIN questions q on a.q_id=q.q_id where a.user_id = ".$this->session->userdata('user_id')." and a.oa_val > -99 and a.order_id=".$order_id." and q.q_type = 'other rated' order by a.order_id desc,a.q_id");	

											

foreach ($query_oat->result_array() as $row)
{						
		$Score=(int)$row["oa_val"];
					
		$checkreponsesQ3 = $this->db->query("SELECT * from questions_responses where q_id = ".$row["q_id"]." and Score=".$Score." order by id");
		$checkreponsesR3 = $checkreponsesQ3->result_array();
		
		$Answerselected="";
		foreach($checkreponsesR3 as $key3=>$value3)
		{
			$oaid=(int)$value3["oa_id"];
			
			$checkans = $this->db->query("SELECT * from responses where oa_id = ".(int)$oaid."");
			$checkansR = $checkans->result_array();
			
			$Answerselected=$checkansR[0]["answers"];
		
			if(strpos($Answerselected,"png") > 0)
			{
				$Answerselected1="<img src='".base_url()."asset/images/answers/".$Answerselected."'>";
				$Answerselected=$Answerselected1;
			}
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
					<div style="text-align: left; padding-left:40px;"><span class="general_instruction">( <?php echo $row['question'];?>  )</span></div>
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
			<div class="row justify-content-center customSelectMainWrap">
				<div class="col-12">
					<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> activeChecked">
						<span class="number"><?php echo $Score;?></span>
						<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['oa_id'];?>" checked="checked">
						<div class="embed-responsive embed-responsive-1by1">
							<span class="label"><?php echo $Answerselected;?></span>
						</div>
						<span class="checkmark"></span>
					</label>
				</div>
			</div>
			</div>	
<?php
$counter++;	
}
?>
</div>
</div>