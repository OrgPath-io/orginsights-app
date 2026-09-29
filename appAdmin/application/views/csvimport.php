<?php
include("includes/header.php");
$uploadpath=$_SERVER["DOCUMENT_ROOT"]."/appAdmin/assets/upload/";
?>
<div class="body-wrapper">
<div class="section-title mb-4"><h4>Import Users</h4></div>
            <p>
			<a href="/appAdmin/assets/Sample_File.csv">Download Sample CSV file</a>
			  </p>
<?php

//echo $uploadpath;

$timestampc=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$tablevalue="users";

$id=0;

$whereq="";
$columns_total=22;

if(isset($_POST["submitform"]) && $_POST["submitform"]==1)
{

	//start upload
		$target_dir = $uploadpath;
		
		if($_FILES['img']["name"]!="")
		{
			
			
			$target_file = $target_dir.basename($_FILES['img']["name"]);
			$uploadOk = 1;
			$uploaded = "";
			$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
			
				if($FileType!="csv")
				{
					$uploadOk = 0;
				}
				
				$target_file = $target_dir.$timestampc.".".$FileType;
				
				
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0)
				{
					echo "File has to be in csv format only";
				
				}
				else
				{
					// if everything is ok, try to upload file
					if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file))
					{
					
						
						$uploaded = str_replace("../","",$target_file);
					
					}
					else
					{
						echo "Sorry, there was an error uploading";
					}
				}
			
			
		}
		
		
		
		//end upload
		$activity="";
		if($uploaded!="")
		{
			
		
			$row = 0;
			$handle = fopen($uploaded, "r");
			while (($data = fgetcsv($handle, 4000, ",")) !== FALSE) 
			{
				
				$num = count($data);
				
				
				
				if ($num <= $columns_total ) {
				
				
				
					//echo $data[2]; die();
					$con->where('email', $data[2]);
					$checkusersQ=$con->get($tablevalue);
					
					$checkusers=$checkusersQ->row_array();
					
					
					if ($row > 0 && $checkusers=="") {
									
							//echo $data[$i];
							//echo "<br>";
							
							$fieldname=array();
							$fieldname['first_name']=$data[0];
							$fieldname['last_name']=$data[1];
							$fieldname['email']=$data[2];
							$fieldname['password']=md5($data[3]);
							$fieldname['via_code']=$data[4];
							$fieldname['signup_via']='system';
							$fieldname['created_date']=date ("Y-m-d H:i:s");
							$fieldname['visible_minorities']=$data[9];
							$fieldname['graduation_year']=$data[18];
							//
							$country_id=0;
							$con->where('country', $data[5]);
							$checkRecsQ=$con->get("countries");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$country_id=$checkRecs["id"];
							}
							$fieldname['country_id']=$country_id;
							//
							//
							$province=0;
							$con->where('province_name', $data[6]);
							$checkRecsQ=$con->get("provinces");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$province=$checkRecs["id"];
							}
							$fieldname['province']=$province;
							//
							//
							$city=0;
							$con->where('description', $data[7]);
							$checkRecsQ=$con->get("Cities");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$city=$checkRecs["id"];
							}
							$fieldname['city']=$city;
							//
							//
							$age_range=0;
							$con->where('description', $data[8]);
							$checkRecsQ=$con->get("AgeRanges");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$age_range=$checkRecs["id"];
							}
							$fieldname['age_range']=$age_range;
							//
							//
							$visible_minorities_option=0;
							$con->where('description', $data[10]);
							$checkRecsQ=$con->get("VisibleMinorities");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$visible_minorities_option=$checkRecs["id"];
							}
							$fieldname['visible_minorities_option']=$visible_minorities_option;
							//
							//
							$hle=0;
							$con->where('description', $data[11]);
							$checkRecsQ=$con->get("HLEType");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$hle=$checkRecs["id"];
							}
							$fieldname['hle']=$hle;
							//
							//
							$university=0;
							$con->where('university', $data[12]);
							$checkRecsQ=$con->get("university");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$university=$checkRecs["id"];
							}
							$fieldname['university']=$university;
							//
							//
							$program_study=0;
							$con->where('major_cat', $data[13]);
							$checkRecsQ=$con->get("study");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$program_study=$checkRecs["id"];
							}
							$fieldname['program_study']=$program_study;
							//
							//
							$most_recent_employer=0;
							$con->where('description', $data[14]);
							$checkRecsQ=$con->get("Employers");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$most_recent_employer=$checkRecs["id"];
							}
							$fieldname['most_recent_employer']=$most_recent_employer;
							//
							//
							$MostRecentExpLevelID=0;
							$con->where('description', $data[15]);
							$checkRecsQ=$con->get("MostRecentExperienceLevel");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$MostRecentExpLevelID=$checkRecs["id"];
							}
							$fieldname['MostRecentExpLevelID']=$MostRecentExpLevelID;
							//
							//
							$industry_employer=0;
							$con->where('name', $data[16]);
							$checkRecsQ=$con->get("industry");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$industry_employer=$checkRecs["id"];
							}
							$fieldname['industry_employer']=$industry_employer;
							//
							//
							$salary_range=0;
							$con->where('description', $data[17]);
							$checkRecsQ=$con->get("SalaryRanges");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$salary_range=$checkRecs["id"];
							}
							$fieldname['salary_range']=$salary_range;
							//
							//
							$designation=0;
							$con->where('CertificateDesignationName', $data[19]);
							$checkRecsQ=$con->get("Designations");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$designation=$checkRecs["id"];
							}
							$fieldname['designation']=$designation;
							//
							//
							$Performance_Rating=0;
							$con->where('description', $data[20]);
							$checkRecsQ=$con->get("Performance_Rating");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$Performance_Rating=$checkRecs["id"];
							}
							$fieldname['Performance_Rating']=$Performance_Rating;
							//
							//
							$Expertise_Role=0;
							$con->where('description', $data[21]);
							$checkRecsQ=$con->get("Expertise_Role");
							$checkRecs=$checkRecsQ->row_array();
							if($checkRecs!="")
							{
								$Expertise_Role=$checkRecs["id"];
							}
							$fieldname['Expertise_Role']=$Expertise_Role;
							//
							
							
							foreach($fieldname as $key=>$value)
							{
								$con->set($key, $value);
							}
							$con->insert($tablevalue);
							
						
						
					}
					else if ($row > 0)
					{
						//echo "User already exists";
					}
				}
				$row++;
			}
			
			
			$ThanksText="<p align='center' class='thankstext'><h5>CSV Imported Successfully</h5></p>";
			?>
			<div class="row">
			<div class="col-12">
			<center>
			<?php echo $ThanksText;?>
			</center>
			</div>
					</div>
			<?php
		}
}
else
{
	
?>			<div class="row">
			<div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="#" method="post" enctype="multipart/form-data">
					
						
                      <div class="form-group">
                        <label>Choose your file</label>
                        <input type="file" name="img" id="img" class="form-control">
                        
                      </div>
					  <input type="hidden" name="submitform" value=1>
                      <input type="submit" class="btn btn-primary btn-lg" value="Submit">&nbsp;&nbsp;<input type="button" class="btn btn-primary btn-lg" value="Back" onclick="location.href='/appAdmin/index.php/users/'"> 
                    </form>
                  </div>
                </div>
				</div>
            </div>
<?php
}
?>				
</div>


<?php
include("includes/footer.php");
?>