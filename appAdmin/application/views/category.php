<?php
include("includes/header.php");
?>
<?php
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));

$tablevalue="categories";

$id=$_REQUEST['id'];

if($id=="")
{
$id=0;
}


$cat_name="";
$cat_description="";

$formactionqs="";
$whereq="";

if($id!=0)
{
$whereq="where cat_id=".$id;
$formactionqs="?id=".$id;



}

if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{
	
	$con->where('cat_name', $_POST['cat_name']);
	$con->where('cat_id!=', $id);
	$checkcat_namesQ=$con->get($tablevalue);
	
	$checkcat_names=$checkcat_namesQ->row_array();
	if($checkcat_names!="")
	{
		echo "<center><font color='red'>Category already exists</font></center>";

		$cat_name=$_POST['cat_name'];
		$cat_description=$_POST['cat_description'];
		
		
		

	}
	else
	{
		
		$fieldname=array();
		$fieldvalue=array();
		
		foreach($_POST as $key=>$value)
		{
			
			if($key!="submitform" && $key!="insertform")
			{
			
								
						$fieldname[]=$key;
						$fieldvalue[]=$value;
					
					
					
			}
		}
		
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
				
				$ThanksText="<p align='center' class='thankstext'>Category Added</p>";
				
				//$ThanksText.="<br>".$id;
				
				
			}
			else
			{
				//$dbupdate=dbupdate($tablevalue,$fieldname,$fieldvalue,$whereq);
				$con->where('cat_id', $id);
				$con->update($tablevalue);
				
				
				$ThanksText="<p align='center' class='thankstext'>Category Updated</p>";
					
				
			}		
			
			
		}
	
	}


}

if($id!=0)
{

$con->where('cat_id', $id);
$checkcat_namesQ=$con->get($tablevalue);

$checkcat_names=$checkcat_namesQ->row_array();
	if($checkcat_names!="")
	{
		
		$cat_name=$checkcat_names['cat_name'];
		$cat_description=$checkcat_names['cat_description'];
		

	}
	
	

}
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Edit Category</h4></div>
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
										<label>Name</label>
										<input type="text" name="cat_name" id="cat_name" value="<?=$cat_name;?>"  placeholder="Name*" class="form-control validate[required] span12" required>
										
										</div>
								</div>
								<div style="clear:both;"></div>
								<div style="float:left;" class="col-lg-12">
										<div class="form-group">
										<label>Description</label>
										<textarea name="cat_description" id="cat_description"  placeholder="Description" class="form-control validate[required] span12"><?=$cat_description;?></textarea>
										</div>
								</div>
								<div style="clear:both;"></div>
								
								
                        </div>
                            
                            

                        </div>
                        <div class="row">

                            <div class="col-lg-12">
                               
								<div class="col-lg-12">
                                <p><small>Fields with a * are required</small></p>
                                <input type="hidden" name="insertform" id="insertform" value=1>
								<input type="hidden" name="submitform" value=1>
								<input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/categories/'"> 
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