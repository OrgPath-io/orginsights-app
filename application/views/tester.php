<?php
//*
	echo $row['responses'][0]['Score'];
	echo "<br>";
	echo $row['responses'][1]['Score'];
	echo "<br>";
	echo $row['responses'][2]['Score'];
	echo "<br>";
	echo $row['responses'][3]['Score'];
	echo "<br>";
	echo $row['responses'][4]['Score'];
	echo "<br>";
	echo $row['responses'][5]['Score'];
	echo "<br>";
	//*/
	
//*
	echo $row['responses'][0]['answers'];
	echo "<br>";
	echo $row['responses'][1]['answers'];
	echo "<br>";
	echo $row['responses'][2]['answers'];
	echo "<br>";
	echo $row['responses'][3]['answers'];
	echo "<br>";
	echo $row['responses'][4]['answers'];
	echo "<br>";
	echo $row['responses'][5]['answers'];
	echo "<br>";
	//*/	
?>
<div class="row customSelectMainWrap2">
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][0]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][0]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][0]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][0]['answers'];?>" /><?php }else{  echo $row['responses'][0]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][1]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][1]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][1]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][1]['answers'];?>" /><?php }else{  echo $row['responses'][1]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][2]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][2]['Score'];?>"  <?php if($row['oatr_id'].'_'.$row['responses'][2]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][2]['answers'];?>" /><?php }else{  echo $row['responses'][2]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][3]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][3]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][3]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
			  		<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][3]['answers'];?>" /><?php }else{  echo $row['responses'][3]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][4]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][4]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][4]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
					<div class="embed-responsive embed-responsive-1by1">
						<span class="label"><?php if($row['show_type'] == 'image'){ ?> <img src="<?php echo base_url().'asset/images/answers/'.$row['responses'][4]['answers'];?>" /><?php }else{  echo $row['responses'][4]['answers']; }?></span>
					</div>
			  		<span class="checkmark"></span>
				</label>
			</div>
			<?php
			if ($row['show_type'] != 'image'){
			?>
			<div class="col-md-6">
				<label class="customSelectBox customSelectBoxradio<?php echo $counter;?> <?php if($row['oatr_id'].'_'.$row['responses'][5]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'activeChecked';}?>">
			  		<input type="radio" name="radio<?php echo $counter;?>" id="radio<?php echo $counter;?>" value="<?php echo $row['oatr_id'].'_'.$row['responses'][5]['Score'];?>" <?php if($row['oatr_id'].'_'.$row['responses'][5]['Score'] == $row['oatr_id'].'_'.$row['answer_id']){echo 'checked="checked"';}?>>
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