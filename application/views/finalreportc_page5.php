<?php
$user_id=(int)$this->session->userdata('user_id');

?>
<section>
		<div class="text-banner textbanner-padding">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-7">		
						<div class="bannertitle">
							OVERVIEW OF THE<br>
							POPULATION INCLUDED
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<?php include("filtersc.php");?>
</section>

<div id="seconddata">
<section class="topscore-main">
		<div class="container">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
					<div class="topscore-box1">
					<img src="<?php echo base_url();?>asset/report_images/global/country_image.png" width="100%">
					</div>
				</div>
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
					<div class="topscore-box1">
					<img src="<?php echo base_url();?>asset/report_images/global/visible_minority.png"width="100%">
					</div>
				</div>
				
				<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
					<div style="padding-top:50%;font-size:30px;font-weight:bold;" class="topscore-box1">
					<?php echo (int)$visible_minoritiesp;?>%
					</div>
				</div>
				
			</div>
		</div>
	</section>
	
	
<section class="topscore-main">
		<div class="container">
			<div class="row">	
<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">	
	<?php //*/ ?>
	<center>ACTIVITY<br><br></center>
	<div class="scorebordmainbanner">
		<div class="bannerscorebord-box">
		<span><?php echo $PopInvited;?></span>
			PEOPLE INVITED
		</div>
		<div class="bannerscorebord-box bggreenbox">
			<span><?php echo $Population;?></span>
			PEOPLE COMPLETED
		</div>
	</div>
	<?php //*/ ?>
</div>	
<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">	
	<?php //*/ ?>
	<center>GENDER<br><br></center>
	<div class="scorebordmainbanner">
		<div class="bannerscorebord-box">
		<span>47%</span>
			MALE
		</div>
		<div class="bannerscorebord-box bggreenbox">
			<span>41%</span>
			FEMALE
		</div>
	</div>
	<?php //*/ ?>
</div>
</div></div>
</section>

<section class="topscore-main">
		<div class="container">
			<div class="row">	
<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
<center>RESPONDENTS BY AREA OF EXPERTISE<br><br></center>
<table width="100%">
<?php
foreach($Expertise as $key=>$value)
{
	$perc=$value/$PeopleCompleted;
	$perc*=100;
	
?>
<tr>
<td><?php echo $key;?></td>
<td><?php echo (int)$perc;?>%</td>
</tr>
<?php	
}
?>
</table>
</div>

<div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
<center>RESPONDENTS BY INDUSTRY<br><br></center>
<table width="100%">
<?php
foreach($Industry as $key=>$value)
{
	$perc=$value/$PeopleCompleted;
	$perc*=100;
	
	
	$Thename="";
	$query_industry = $this->db->query("SELECT 
									* 
									FROM industry where id=".(int)$key."");
	$res_industry = $query_industry->result_array();
	
	$Thename=$res_industry[0]["name"];
	
	if($Thename=="")
	{
		$Thename="undefined";
	}
	
?>
<tr>
<td><?php echo $Thename;?></td>
<td><?php echo (int)$perc;?>%</td>
</tr>
<?php	
}
?>
</table>
</div>

</div></div>
</section>

<section class="topscore-main">
		<div class="container">
			<div class="row">	
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
<center>EDUCATIONAL LEVEL<br><br></center>
</div>
<?php
foreach($Education as $key=>$value)
{
	$perc=$value/$PeopleCompleted;
	$perc*=100;
	
	
	$Thename="";
	$query_study = $this->db->query("SELECT 
									* 
									FROM study where id=".(int)$key."");
	$res_study = $query_study->result_array();
	
	$Thename=$res_study[0]["major_cat"];
	
	if($Thename=="")
	{
		$Thename="undefined";
	}
	
?>
<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
<?php echo (int)$perc;?>%
<br><?php echo $Thename;?>
</div>
<?php	
}
?>
</div>
</div>
</section>
</div>