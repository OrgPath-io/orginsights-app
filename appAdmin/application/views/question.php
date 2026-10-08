<?php
include("includes/header.php");
?>
<?php
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));

$Image=array("-a","-b","-c","-d","-e","-f");
$Answerpath="/asset/images/answers/";
$Questpath="/asset/images/questions/";
$Filepath=$_SERVER['DOCUMENT_ROOT'].$Answerpath;
$Filepath2=$_SERVER['DOCUMENT_ROOT'].$Questpath;

$tablevalue="questions";
$tablevalue2="responses";
$tablevalue3="questions_responses";

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}


$question="";
$general_instruction="";
$question_typeID=0;
$cat_id=0;
$cap_id=0;
$q_type="self";
$show_type="regular";

$formactionqs="";
$whereq="";

if($id!=0)
{
$whereq="where q_id=".$id;
$formactionqs="?id=".$id;



}

if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{
	
	$con->where('question', $_POST['question']);
	$con->where('q_id!=', $id);
	$checkquestionsQ=$con->get($tablevalue);
	
	$checkquestions=$checkquestionsQ->row_array();
	$checkquestions="";
	if($checkquestions!="")
	{
		echo "<center><font color='red'>Question already exists</font></center>";

		$question=$_POST['question'];
		$general_instruction=$_POST['general_instruction'];
		$question_typeID=$_POST['question_typeID'];
		$cat_id=$_POST['cat_id'];
		$cap_id=$_POST['cap_id'];
		$q_type=$_POST['q_type'];
		
		
		

	}
	else
	{
		
		$fieldname=array();
		$fieldvalue=array();
		$lawyerfieldname=array();
		$lawyerfieldvalue=array();
		
		foreach($_POST as $key=>$value)
		{
			$pos1=strpos("*".$key,"answer_");
			$pos2=strpos("*".$key,"AnswersID_");
			$pos3=strpos("*".$key,"ScoreID_");
			$pos4=strpos("*".$key,"ImageAnswers_");
			$pos5=strpos("*".$key,"removeimage_");
			$pos6=strpos("*".$key,"removeQImage_");
		
			if($key!="submitform" && $key!="insertform" && $key!="ConfirmPassword" && $key!="attcimage" && $key!="removeimage" && $pos1 < 1 && $pos2 < 1 && $pos3 < 1 && $pos4 < 1 && $pos5 < 1 && $pos6 < 1)
			{
			
								
						$fieldname[]=$key;
						$fieldvalue[]=$value;
					
					
					
			}
		}
		$fieldname[]="show_type";
		$fieldvalue[]=$show_type;
		
		$fieldname[]="create_date";
		$fieldvalue[]=date("Y-m-d H:i:s",$timestamp);
		
		if(isset($_POST["insertform"]) && $_POST["insertform"]==1)
		{
		
			foreach($fieldname as $key=>$value)
			{
				$con->set($value, $fieldvalue[$key]);
			}
		
		
			if($whereq=="")
			{
		
				//$dbinsert=dbinsert($tablevalue,$fieldname,$fieldvalue);
				$dbinsert=$con->insert($tablevalue);
				$id=$con->insert_id();
				
				$ThanksText="<p align='center' class='thankstext'>Question Added</p>";
				
				//$ThanksText.="<br>".$id;
				
				if((int)$id > 0)
				{
				
								//start upload question image
								$i=99;
								$fieldname=array();
								$fieldvalue=array();
								$updatequestion=0;
								if($_FILES["QImage_".$i]["name"]!="")
								{
									
									
									$target_file = $Filepath2. basename($_FILES["QImage_".$i]["name"]);
									$uploadOk = 1;
									$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
									
									if(strtolower($FileType)!="png" && strtolower($FileType)!="jpg" && strtolower($FileType)!="gif" && strtolower($FileType)!="jpeg")
										{
											$uploadOk = 0;
										}
									
									
									
									$target_file=str_replace($target_file,$Filepath2.$id."-1.".$FileType,$target_file);
									
									//echo $target_file;
									
									// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0)
										{
											
										}
										else
										{
											move_uploaded_file($_FILES["QImage_".$i]["tmp_name"], $target_file);
											
											$fieldname[]="show_type";
											$fieldvalue[]="image";
											$updatequestion=1;
											
											

										}
								}
								else if(isset($_POST['removeQImage_'.$i]) && (int)$_POST['removeQImage_'.$i]==1)
								{
												
												$fieldname[]="show_type";
												$fieldvalue[]="regular";
												$updatequestion=1;
								}
								if($updatequestion==1)
								{
									foreach($fieldname as $key=>$value)
									{
										$con->set($value, $fieldvalue[$key]);
										
										
									}
									
									
										$con->where('q_id', (int)$id);
										$con->update($tablevalue);
										
									
								}
								//end upload
				
							for($i=0;$i<=5;$i++)
							{
								$fieldname=array();
								$fieldvalue=array();
								
								//start upload
								if($_FILES["Image_".$i]["name"]!="")
								{
									
									
									$target_file = $Filepath. basename($_FILES["Image_".$i]["name"]);
									$uploadOk = 1;
									$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
									
									if(strtolower($FileType)!="png" && strtolower($FileType)!="jpg" && strtolower($FileType)!="gif" && strtolower($FileType)!="jpeg")
										{
											$uploadOk = 0;
										}
									
									
									
									$target_file=str_replace($target_file,$Filepath.$id.$Image[$i].".".$FileType,$target_file);
									
									//echo $target_file;
									
									// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0)
										{
											
										}
										else
										{
											move_uploaded_file($_FILES["Image_".$i]["tmp_name"], $target_file);
											$fileImageLink=$id.$Image[$i].".".$FileType;
											
											$fieldname[]="answers";
											$fieldvalue[]=$fileImageLink;
											
											$j=$i;
											if($i < 5)
											{
												$j=0;
											}

										}
								}
								else if(isset($_POST['removeimage_'.$i]) && (int)$_POST['removeimage_'.$i]==1)
								{
												
												$fieldname[]="answers";
												$fieldvalue[]="";
												
												$j=$i;
												if($i < 5)
												{
													$j=0;
												}
								}
								else if(isset($_POST['ImageAnswers_'.$i]) && $_POST['ImageAnswers_'.$i]!="")
								{
												$fieldname[]="answers";
												$fieldvalue[]=$_POST["ImageAnswers_".$i];
												
												$j=$i;
												if($i < 5)
												{
													$j=0;
												}
								}
								else
								{
												$fieldname[]="answers";
												$fieldvalue[]=$_POST["answer_".$i];
												
												$j=$i;
											
								}
								//end upload
								
								$fieldname[]="created_date";
								$fieldvalue[]=date("Y-m-d H:i:s",$timestamp);
								
								foreach($fieldname as $key=>$value)
								{
									$con->set($value, $fieldvalue[$key]);
								}
								$dbinsert=$con->insert($tablevalue2);
								$Aid=$con->insert_id();
								
								
								$fieldname=array();
								$fieldvalue=array();
								
								$fieldname[]="q_id";
								$fieldvalue[]=$id;
								
								$fieldname[]="oa_id";
								$fieldvalue[]=$Aid;
								
								$fieldname[]="Score";
								$fieldvalue[]=$j;
								
								foreach($fieldname as $key=>$value)
								{
									$con->set($value, $fieldvalue[$key]);
								}
								$dbinsert=$con->insert($tablevalue3);
								
								//$ThanksText.="<br>".$Aid;
								
							}
				}
					
				
			}
			else
			{
				//$dbupdate=dbupdate($tablevalue,$fieldname,$fieldvalue,$whereq);
				$con->where('q_id', $id);
				$con->update($tablevalue);
				
							//start upload question image
								$i=99;
								$fieldname=array();
								$fieldvalue=array();
								$updatequestion=0;
								if($_FILES["QImage_".$i]["name"]!="")
								{
									
									
									$target_file = $Filepath2. basename($_FILES["QImage_".$i]["name"]);
									$uploadOk = 1;
									$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
									
									if(strtolower($FileType)!="png" && strtolower($FileType)!="jpg" && strtolower($FileType)!="gif" && strtolower($FileType)!="jpeg")
										{
											$uploadOk = 0;
										}
									
									
									
									$target_file=str_replace($target_file,$Filepath2.$id."-1.".$FileType,$target_file);
									
									//echo $target_file;
									
									// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0)
										{
											
										}
										else
										{
											move_uploaded_file($_FILES["QImage_".$i]["tmp_name"], $target_file);
											
											$fieldname[]="show_type";
											$fieldvalue[]="image";
											$updatequestion=1;
											
											

										}
								}
								else if(isset($_POST['removeQImage_'.$i]) && (int)$_POST['removeQImage_'.$i]==1)
								{
												
												$fieldname[]="show_type";
												$fieldvalue[]="regular";
												$updatequestion=1;
								}
								if($updatequestion==1)
								{
									foreach($fieldname as $key=>$value)
									{
										$con->set($value, $fieldvalue[$key]);
										
									}
									
									
										$con->where('q_id', (int)$id);
										$con->update($tablevalue);
										
									
								}
								//end upload
				
							for($i=0;$i<=5;$i++)
							{
								$fieldname=array();
								$fieldvalue=array();
								
								//start upload
								if($_FILES["Image_".$i]["name"]!="")
								{
									
									
									$target_file = $Filepath. basename($_FILES["Image_".$i]["name"]);
									$uploadOk = 1;
									$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
									
									if(strtolower($FileType)!="png" && strtolower($FileType)!="jpg" && strtolower($FileType)!="gif" && strtolower($FileType)!="jpeg")
										{
											$uploadOk = 0;
										}
									
									
									
									$target_file=str_replace($target_file,$Filepath.$id.$Image[$i].".".$FileType,$target_file);
									
									//echo $target_file;
									
									// Check if $uploadOk is set to 0 by an error
										if ($uploadOk == 0)
										{
											
										}
										else
										{
											move_uploaded_file($_FILES["Image_".$i]["tmp_name"], $target_file);
											$fileImageLink=$id.$Image[$i].".".$FileType;
											
											$fieldname[]="answers";
											$fieldvalue[]=$fileImageLink;
											
											$j=$i;
											if($i < 5)
											{
												$j=0;
											}

										}
								}
								else if(isset($_POST['removeimage_'.$i]) && (int)$_POST['removeimage_'.$i]==1)
								{
												
												$fieldname[]="answers";
												$fieldvalue[]="";
												
												$j=$i;
												if($i < 5)
												{
													$j=0;
												}
								}
								else if(isset($_POST['ImageAnswers_'.$i]) && $_POST['ImageAnswers_'.$i]!="")
								{
												$fieldname[]="answers";
												$fieldvalue[]=$_POST["ImageAnswers_".$i];
												
												$j=$i;
												if($i < 5)
												{
													$j=0;
												}
								}
								else
								{
												$fieldname[]="answers";
												$fieldvalue[]=$_POST["answer_".$i];
												
												$j=$i;
											
								}
								//end upload
								
								$fieldname[]="created_date";
								$fieldvalue[]=date("Y-m-d H:i:s",$timestamp);
								
								foreach($fieldname as $key=>$value)
								{
									$con->set($value, $fieldvalue[$key]);
								}
								
								if((int)$_POST["AnswersID_".$i] > 0)
								{
									$con->where('oa_id', (int)$_POST["AnswersID_".$i]);
									$con->update($tablevalue2);
									$Aid=(int)$_POST["AnswersID_".$i];
								}
								else
								{
									$dbinsert=$con->insert($tablevalue2);
									$Aid=$con->insert_id();
								}
								
								
								$fieldname=array();
								$fieldvalue=array();
								
								$fieldname[]="q_id";
								$fieldvalue[]=$id;
								
								$fieldname[]="oa_id";
								$fieldvalue[]=$Aid;
								
								$fieldname[]="Score";
								$fieldvalue[]=$j;
								
								foreach($fieldname as $key=>$value)
								{
									$con->set($value, $fieldvalue[$key]);
								}
								
								if((int)$_POST["ScoreID_".$i] > 0)
								{
									$con->where('id', (int)$_POST["ScoreID_".$i]);
									$con->update($tablevalue3);
									
								}
								else
								{
									$dbinsert=$con->insert($tablevalue3);
								}
								
								//$ThanksText.="<br>".$Aid;
								
							}
				
				
				$ThanksText="<p align='center' class='thankstext'>Question Updated</p>";
					
				
			}		
			
			
		}
	
	}


}

$Answers=array("","","","","","");
$AnswersID=array(0,0,0,0,0,0);
$ScoreID=array(0,0,0,0,0,0);
$ImageAnswers=array("","","","","","");
if($id!=0)
{

$con->where('q_id', $id);
$checkquestionsQ=$con->get($tablevalue);

$checkquestions=$checkquestionsQ->row_array();
	if($checkquestions!="")
	{
		
		$question=$checkquestions['question'];
		$general_instruction=$checkquestions['general_instruction'];
		$question_typeID=$checkquestions['question_typeID'];
		$cat_id=$checkquestions['cat_id'];
		$cap_id=$checkquestions['cap_id'];
		$q_type=$checkquestions['q_type'];
		$show_type=$checkquestions['show_type'];

	}
	
	$con->order_by("Score asc");
	$con->order_by("id asc");
	$con->where('q_id', $id);
	$checkanswersQ=$con->get($tablevalue3);

	$countrec=0;
	foreach ($checkanswersQ->result_array() as $checkanswers)
	{
		$con->where('oa_id', $checkanswers["oa_id"]);
		$checkanswersQ2=$con->get($tablevalue2);

		$checkanswers2=$checkanswersQ2->row_array();
		
		if($checkanswers2!="")
		{
			if((int)$question_typeID==1)
			{
				
				$ImageAnswers[$countrec]=$checkanswers2["answers"];
				$AnswersID[$countrec]=$checkanswers2["oa_id"];
				$ScoreID[$countrec]=$checkanswers["id"];
				$countrec++;
			}
			else
			{
				$Answers[$checkanswers["Score"]]=$checkanswers2["answers"];
				$AnswersID[$checkanswers["Score"]]=$checkanswers2["oa_id"];
				$ScoreID[$checkanswers["Score"]]=$checkanswers["id"];
			}
		}
	}

}
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Add Question</h4></div>
<script type="text/javascript">
// Toggle form display
function showForm(formName) 
{
	$(formName).slideDown(1000).siblings('.register').hide();
}
</script>					

                    <form action="#" method="post" name="adminform" class="register1" id="adminform" enctype="multipart/form-data">

                        <div class="row">

                            <div class="col-lg-12">
							
								<div class="col-lg-12">
                                <?php echo $ThanksText;?><br>
								</div>
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-12">
										<div class="form-group">
										<label>Question</label>
										<input type="text" name="question" id="question" value="<?=$question;?>"  placeholder="Question*" class="form-control validate[required] span12" required>
										<br>Question Image<br>
										<input type="file" name="QImage_99" id="QImage_99" class="form-control validate[required] span12">
										<?php
										if($show_type=="image")
										{
										?>
										<img src="<?php echo $Questpath.$id."-1.png";?>" />&nbsp;<a href="javascript:void(0)" onclick="rmvimg()" style="color:red;">Remove</a>
										<input type="hidden" name="removeQImage_99" id="removeimage" value=0>
										<script type="text/javascript">
										function rmvimg()
										{
											document.getElementById("removeimage").value=1;
											
											
										}
										
										</script>
										<?php										
										}
										?>
										</div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-12">
										<div class="form-group">
										<label>General instruction</label>
										<input type="text" name="general_instruction" id="general_instruction" value="<?=$general_instruction;?>"  placeholder="General instruction" class="form-control validate[required] span12">
										</div>
								</div>
								<div style="clear:both;"></div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Type</label>
										<select name="question_typeID" id="question_typeID" class="form-control validate[required] span12" required>
										<option value="">Type</option>
										<?php
										$con->order_by("typeName");
										$checkrecQ=$con->get("question_types");
										$checkrec=$checkrecQ->row_array();
										foreach ($checkrecQ->result_array() as $checkrec)
										{
											$slct="";
											if($checkrec["typeID"]==$question_typeID)
											{
												$slct="selected";
											}
										?>	
										<option value="<?php echo $checkrec["typeID"];?>" <?php echo $slct;?>><?php echo $checkrec["typeName"];?></option>
										<?php	
										}
										?>
										</select>
										</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Category</label>
										<select name="cat_id" id="cat_id" class="form-control validate[required] span12" required>
										<option value="">Category</option>
										<?php
										$con->order_by("cat_name");
										$checkrecQ=$con->get("categories");
										$checkrec=$checkrecQ->row_array();
										foreach ($checkrecQ->result_array() as $checkrec)
										{
											$slct="";
											if($checkrec["cat_id"]==$cat_id)
											{
												$slct="selected";
											}
										?>	
										<option value="<?php echo $checkrec["cat_id"];?>" <?php echo $slct;?>><?php echo $checkrec["cat_name"];?></option>
										<?php	
										}
										?>
										</select>
										</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Capability</label>
										<select name="cap_id" id="cap_id" class="form-control validate[required] span12" required>
										<option value="">Capability</option>
										<?php
										$con->order_by("cap_name");
										$checkrecQ=$con->get("capabilities");
										$checkrec=$checkrecQ->row_array();
										foreach ($checkrecQ->result_array() as $checkrec)
										{
											$slct="";
											if($checkrec["cap_id"]==$cap_id)
											{
												$slct="selected";
											}
										?>	
										<option value="<?php echo $checkrec["cap_id"];?>" <?php echo $slct;?>><?php echo $checkrec["cap_name"];?></option>
										<?php	
										}
										?>
										</select>
										</div>
								</div>
								<?php
								$Atype_array=array();
								$Atype_array["self"]="Self";
								$Atype_array["professional"]="Orginsights";
								$Atype_array["other rated"]="360";
								?>
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Assessment type</label>
										<select name="q_type" id="q_type" class="form-control validate[required] span12" required>
										<option value="">Assessment type</option>
										<?php
										foreach($Atype_array as $key=>$value)
										{
											$slct="";
											if($key==$q_type)
											{
												$slct="selected";
											}
										?>	
										<option value="<?php echo $key;?>" <?php echo $slct;?>><?php echo $value;?></option>
										<?php
										}
										?>
										</select>
										</div>
								</div>
								<p>&nbsp;</p>								
								<?php
								for($i=0;$i<=5;$i++)
								{
									$j=$i+1;
								?>
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>Answer <?php echo $j;?></label>
										<input type="text" name="answer_<?php echo $i;?>" id="answer_<?php echo $i;?>" value="<?php echo $Answers[$i];?>"  placeholder="Answer <?php echo $j;?>" class="form-control validate[required] span12">
										<input type="hidden" name="ScoreID_<?php echo $i;?>" id="ScoreID_<?php echo $i;?>" value="<?php echo $ScoreID[$i];?>">
										<input type="hidden" name="AnswersID_<?php echo $i;?>" id="AnswersID_<?php echo $i;?>" value="<?php echo $AnswersID[$i];?>">
										
										</div>
								</div>
								
								<div style="float:left;" class="col-lg-6">
										<div class="form-group">
										<label>OR Upload Image for Answer <?php echo $j;?></label>
										<input type="file" name="Image_<?php echo $i;?>" id="Image_<?php echo $i;?>" class="form-control validate[required] span12">
										<?php
										if($ImageAnswers[$i]!="")
										{
										?>
										<img src="<?php echo $Answerpath.$ImageAnswers[$i];?>" />&nbsp;<a href="javascript:void(0)" onclick="rmvaimg(<?php echo $i;?>)" style="color:red;">Remove</a>
										<input type="hidden" name="removeimage_<?php echo $i;?>" id="removeimage_<?php echo $i;?>" value=0>
										
										<input type="hidden" name="ImageAnswers_<?php echo $i;?>" id="ImageAnswers_<?php echo $i;?>" value="<?php echo $ImageAnswers[$i];?>">
										<?php	
										}
										?>
										
										</div>
								</div>
								<div style="clear:both;"></div>
								<?php
								}
								?>
								<script type="text/javascript">
										function rmvaimg(n1)
										{
											document.getElementById("removeimage_"+n1).value=1;
											
											
										}
										
										</script>
																
								
								
								
                        </div>
                            
                            

                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                               
								<div class="col-lg-12">
                                <p><small>Fields with a * are required</small></p>
                                <input type="hidden" name="insertform" id="insertform" value=1>
								<input type="hidden" name="submitform" value=1>
								<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/questions/'"> 
								</div>

                            </div>

                        </div>

                    </form>
					<div id="reg_family" class="register hide"></div>
<script type="text/javascript">
// Form validation hook
$(document).ready(function() 
{
	$("form").validationEngine('attach'); // Validation script
});


	
</div>
<?php
include("includes/footer.php");
?>