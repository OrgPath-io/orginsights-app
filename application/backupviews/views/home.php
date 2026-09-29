<?php
$user_id=(int)$this->session->userdata('user_id');

//check optional reg entries
$ActualTicks=0;

$query_user = $this->db->query("SELECT 
									province, city 
									, age_range
									, visible_minorities
									, visible_minorities_option
									, hle
									, university
									, graduation_year
									, program_study
									, designation
									, most_recent_employer
									, performance_rating									
									, industry_employer
									, expertise_role
									, salary_range
									, local_amazon_web
									, MostRecentExpLevelID
									FROM users
									where user_id = '".$this->session->userdata('user_id')."'
									limit 1");
		$res_user = $query_user->result_array();
		$user = $res_user[0];
		
if((int)$user['province'] > 0)
{
	$ActualTicks++;
}	
if((int)$user['city'] > 0)
{
	$ActualTicks++;
}
if((int)$user['age_range'] > 0)
{
	$ActualTicks++;
}
if($user['visible_minorities']!="")
{
	$ActualTicks++;
}
if((int)$user['hle'] > 0)
{
	$ActualTicks++;
}
if((int)$user['university'] > 0)
{
	$ActualTicks++;
}
if((int)$user['graduation_year'] > 0)
{
	$ActualTicks++;
}
if((int)$user['program_study'] > 0)
{
	$ActualTicks++;
}
if((int)$user['most_recent_employer'] > 0)
{
	$ActualTicks++;
}
if((int)$user['MostRecentExpLevelID'] > 0)
{
	$ActualTicks++;
}
if((int)$user['performance_rating'] > 0)
{
	$ActualTicks++;
}
if((int)$user['industry_employer'] > 0)
{
	$ActualTicks++;
}
if((int)$user['expertise_role'] > 0)
{
	$ActualTicks++;
}
if((int)$user['salary_range'] > 0)
{
	$ActualTicks++;
}

//echo $ActualTicks;

$Showadditionalrep=0;

if($ActualTicks >=10)
{
	$Showadditionalrep=1;
}

//end 

//assessments_array
$assessments_array=array(0,125,225,275);
$assessments_arrayd=array('<sup>&nbsp;</sup><span>&nbsp;</span>','<sup>&nbsp;</sup><span>&nbsp;</span>','<sup>&nbsp;</sup><span>&nbsp;</span>','<sup>&nbsp;</sup><span>&nbsp;</span>');

$assessments_total=array(0,29,29,34);

include("convert_currency.php");

//echo "*".$this->session->userdata('ref_code')."*";

if($this->session->userdata('ref_code')!="")
{
	for($i=1;$i<=3;$i++)
	{
		$grand_total=$assessments_array[$i];

		
		/*
		$discount_amountp=(int)(($grand_total*30)/100);
		if($this->session->userdata('ref_code')=="ORG22TSTFREE")
		{
			$discount_amount=0;
		}
		else if($this->session->userdata('ref_code')=="ORG22TSTTEN")
		{
			$discount_amount=($grand_total-10);
		}
		*/
		if($this->session->userdata('ref_code_type')=='percentage')
		{
			$discount_amountp=(int)(($grand_total*$this->session->userdata('ref_code_value'))/100);
		}
		else
		{
			$discount_amountp=$this->session->userdata('ref_code_value');
		}
		
		
		$discount_amount=($grand_total-$discount_amountp);
		
		
		
		
	
		$assessments_arrayd[$i]='<sup>'.$UserCurrency.'</sup><span>'.$grand_total.'</span>';
		
		$assessments_array[$i]=$discount_amount;
	}

}
else
{
?>
<style>
.leftModalContent h2 .cutOffPrice, .leftModalContent h2 .cutOffPrice sup, .leftModalContent h2 .cutOffPrice span{
    color: #ffffff !important;
	}
.leftModalContent h2 .cutOffPrice2, .leftModalContent h2 .cutOffPrice2 sup, .leftModalContent h2 .cutOffPrice2 span{
    color: #307ac3 !important;
	}	
</style>
<?php
}



if(!isset($order_id))
{
	$order_id=0;
}

//echo (int)$users_package1;

$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));
$orderstamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));

if(isset($order_date) && $order_date!="")
{
	$Splitdate=explode(" ",$order_date);
	$Splitdate2=explode("-",$Splitdate[0]);
	
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	
	$order_date=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
	
	$orderstamp=mktime(0, 0, 0, $Splitdate2[1], $Splitdate2[2], $Splitdate2[0]);
	
	
}
else
{
	$order_date="";
}

$askonselection=1;
if($timestamp-$orderstamp >= 15552000)
{	
	//echo "Don't ask on new assessment selection";
	$askonselection=0;
}
else
{	
	//echo "Ask on new assessment selection";
	$askonselection=1;
}



//check dates
$checkdate = $this->db->query("SELECT oatr.updated AS date_started
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val > -99 and oat.q_type = 'self' order by oatr.oatr_id limit 0,1");
									
								
$checkdateR=$checkdate->result_array();	



if(isset($checkdateR[0]["date_started"]) && $checkdateR[0]["date_started"]!="")
{	
	$Splitdate=explode(" ",$checkdateR[0]["date_started"]);
	$Splitdate2=explode("-",$Splitdate[0]);
	
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	
	$StartDate1=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
}
else
{
	$StartDate1="";
}
//
$checkdate = $this->db->query("SELECT oatr.updated AS date_started
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val > -99 and oat.q_type = 'professional' order by oatr.oatr_id limit 0,1");
$checkdateR=$checkdate->result_array();	


if(isset($checkdateR[0]["date_started"]) && $checkdateR[0]["date_started"]!="")
{	
	$Splitdate=explode(" ",$checkdateR[0]["date_started"]);
	$Splitdate2=explode("-",$Splitdate[0]);
	
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	
	$StartDate2=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
}
else
{
	$StartDate2="";
}
//
$checkdate = $this->db->query("SELECT oatr.updated AS date_started
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oatr.oa_val > -99 and oat.q_type = 'other rated' order by oatr.oatr_id limit 0,1");
$checkdateR=$checkdate->result_array();	
if(isset($checkdateR[0]["date_started"]) && $checkdateR[0]["date_started"]!="")
{	
	$Splitdate=explode(" ",$checkdateR[0]["date_started"]);
	$Splitdate2=explode("-",$Splitdate[0]);
	
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	
	$StartDate3=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
}
else
{
	$StartDate3="";
}
//

//
$is360=0;
$check360Q = $this->db->query("SELECT order_package_id from orders where user_id = ".$user_id."");
$check360R = $check360Q->result_array();

foreach ($check360Q->result_array() as $check360R)
{	

	if($check360R["order_package_id"]==1 || $check360R["order_package_id"]==3)
	{
		$is360=1;
	}
}	
$is360=0;
//

$checkprofileQ = $this->db->query("SELECT graduation_year from users where user_id = ".$user_id."");
$checkprofileR = $checkprofileQ->result_array();

if($checkprofileR[0]["graduation_year"]!="")
{
	$gotodemographic=0;
}
else
{
	$gotodemographic=1;
}

//
$PeopleInvited=0;
$PeopleCompleted=0;

$Invitestart="";
$Inviteend="";

$checkinvitedQ = $this->db->query("SELECT * from invited_users where invited_by = ".$user_id." and order_id=".$order_id." and invite_sent=1 order by id desc");
$checkinvitedR = $checkinvitedQ->result_array();

foreach($checkinvitedR as $key=>$value)
{
	$PeopleInvited++;
	
	
	$Invitestart=$value["created_date"];
	
	$Splitdate=explode(" ",$Invitestart);
	$Splitdate2=explode("-",$Splitdate[0]);
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	$Invitestart=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
	
	
	$Inviteend=$value["LengthofAssessment"]." 00:00:00";
	
	$Splitdate=explode(" ",$Inviteend);
	$Splitdate2=explode("-",$Splitdate[0]);
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	$Inviteend=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
	
	
	$checkcompletedQ = $this->db->query("SELECT * from orders_assessment_type_rater_responses where r_user_id = ".$value["id"]." and  order_id = ".$value["order_id"]." and oa_val=-99 order by order_id desc");
	
	$checkcompletedR = $checkcompletedQ->result_array();
	
	if($checkcompletedR[0]=="")
	{
		$PeopleCompleted++;
	}
	
}

//echo $PeopleInvited;
//

$Completed_1=0;
$Completed_2=0;
$Completed_3=0;

$Displayalertmsg=1;
?>
<div class="page-banner welcome-page-banner">
        <div class="container clearfix">
            <div class="row">
                <div class="col-md-6">
                    <h1>Welcome <strong><?php echo $this->session->userdata('first_name');?>,</strong></h1>
					<h6>You are about to embark on a journey of self-discovery.</h6>
                    <p>The OrgInsights Homepage is where you will be able to create a new session, continue and manage existing session, as well as access all your reports and historical assessments.</p>
                </div>
                <div class="col-md-6">
                    <div class="referral-code-area">
                        <span>Referral Code</span>
                        <p><?php echo $this->session->userdata('display_code');
						?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <div class="section">
        <div class="container">
            <div class="register-column">
                <div class="row">
                    <div class="col-md-8 progress-title border-bottom-text">
                        <h4>In progress</h4>
                    </div>
					<div class="col-md-4 progress-title border-bottom-text">
						<p align="right">
						<?php
						if((int)$users_package1 > 0)
						{
						?>
                        <a href="<?php echo base_url();?>register/optional/" class="btn btn-secondary" style="color:#ffffff;" >Update Profile</a>
						<?php
						}
						?>
						</p>
                    </div>
                </div>
                <div class="row rounded-column-row">
				<div class="col-lg-3 offset-lg-0 col-md-3 offset-md-0 rounded-block">
                        <?php
						if($users_package1 > 0)
						{
							$actibebox="";
							if((int)$users_no_of_orders1==0 || (int)$Completed1 > 0)
							{
								$actibebox=" style='background:#cccccc !important;'";
							}
							
							$query_total_q_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment'");
									
									
							$query_total_q_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'self'");		
									
							if($query_total_q_s->num_rows() > 0)
							{
								$res_q_s = $query_total_q_s->row();
								$query_total_a_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment' AND oatr.oa_val <> -99");
									
								$query_total_a_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'self' AND oatr.oa_val <> -99");	
									
							$res_a_s = $query_total_a_s->row();
							
							if($res_q_s->total_question==0)
							{
								$progress_s1 = 0;
							}
							else
							{
								$progress_s1 = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
							}
							}else{
								$progress_s1 = 0;
							}	
						
							$Completed_1=0;
							if($progress_s1 > 99)
							{
								$Completed_1=1;
							}
							
						$actibebox2="";	
						if($Completed_1==1)
						{
							$actibebox2=" style='background:#cccccc !important;'";
						?>
						<div style='background:#cccccc !important;cursor:pointer;' onclick="reviewpage(1,<?php echo $order_id;?>)" class="rounded-column">
						<?php	
						}
						else
						{
						?>
						<div class="rounded-column">
						<?php	
						}	             
						?>
                            <div <?php echo $actibebox;?> class="rounded-column-text">
                                <p>Self Assessment</p>
                            </div>
						
                            <div <?php echo $actibebox;?> class="rounded-column-table">
                                <table class="table table-bordered">
                                    <tbody>
									<?php
									if((int)$users_no_of_orders1==0)
									{
									?>
									<tr>
                                            <td>&nbsp;<br>&nbsp;</td><td>
											&nbsp;
											</td>
									</tr>
									<tr>
                                            <td>&nbsp;<br>&nbsp;</td>
                                            <td>&nbsp;<br>&nbsp;</td>
                                        </tr>									
									<?php
									}
									else
									{
									?>
                                        <tr>
                                            <td><strong>Start date</strong><br><?php echo $StartDate1;?></td>
                                            <td>
                                                <div class="complete-text text-left">
                                                    <p><strong>Status (<?php echo $progress_s1;?>%)</strong></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_s1;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
                                                </div>

                                            </td>
                                        </tr>
										<tr>
                                            <td>&nbsp;<br>&nbsp;</td>
                                            <td>&nbsp;<br>&nbsp;</td>
                                        </tr>
									<?php
									}
									?>	
                                         
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="text-center btn-area">
                                <button type="submit" class="btn btn-secondary">view report</button>
                            </div>-->
                            <div <?php echo $actibebox2;?> class="rounded-column-footer text-center">
                                <ul>
                                    <li>
									<?php
									if($Completed_1==1)
									{
									?>
									<br><a href="javascript:void(0)" onclick="reviewpage(1,<?php echo $order_id;?>)">Review</a>
									<?php
									}
									else
									{
									?>
									<br><?php
									if($progress_s1==0)
									{
										if($gotodemographic==1)
										{
										?>
										<a href="<?php echo base_url();?>register/optional">Start session</a>
										<?php
										}
										else
										{
									?>
									<a href="<?php echo base_url();?>register/self/<?php echo (int)$users_ordersnumber1;?>">Start session</a>
									<?php
										}
									}
									else
									{
									?>
									<a href="<?php echo base_url();?>selfassessment/<?php echo (int)$users_ordersnumber1;?>">Continue session</a>
									<?php
									}
									?>
									<br><a href="<?php echo base_url();?>register/self/<?php echo (int)$users_ordersnumber1;?>">Assessment Instructions</a>
									<?php
									}
									?>
									</li>
                                </ul>
                            </div>
						<?php
						}
						?>
                        </div>
                    </div>
                    <?php
						if($users_package1==2 || $users_package1==3)
						{
						?>
						<div class="col-lg-3 offset-lg-0 col-md-3 offset-md-0 rounded-block">
						<?php
							$actibebox="";
							if((int)$users_no_of_orders1==0 || (int)$Completed1 > 0)
							{
								$actibebox=" style='background:#cccccc !important;'";
							}
							
							$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment'");
									
							$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
									WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'professional'");		
													

		
							if($query_total_q_o->num_rows() > 0)
							{
								$res_q_o = $query_total_q_o->row();
								
								$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
														FROM orders_assessment_type_responses oatr
														LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
														WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'OrgInsights Assessment' AND oatr.oa_val <> -99");
														
$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
														FROM orders_assessment_type_responses oatr
														LEFT JOIN questions AS oat ON oat.q_id = oatr.q_id
														WHERE oatr.order_id = '".$order_id."' AND oat.q_type = 'professional' AND oatr.oa_val <> -99");														
								$res_a_o = $query_total_a_o->row();
								
								if($res_q_o->total_question==0)
								{
									$progress_s2 = 0;
								}
								else
								{
								$progress_s2 = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
								}
							}else{
								$progress_s2 = 0;
							}
							
						
							$Completed_2=0;
							if($progress_s2 > 99)
							{
								$Completed_2=1;
							}
							if($Completed_1==0)
							{
								$Completed_2=1;
							}
							
						$actibebox2="";	
						if($Completed_2==1)
						{
							$actibebox2=" style='background:#cccccc !important;'";
						?>
						<div style='background:#cccccc !important;cursor:pointer;' onclick="reviewpage(2,<?php echo $order_id;?>)" class="rounded-column">
						<?php	
						}
						else
						{
						?>
						<div class="rounded-column">
						<?php	
						}	             
						?>
                            <div <?php echo $actibebox;?> class="rounded-column-text">
                               <p>OrgInsights Assessment</p>
                            </div>
						
                            <div <?php echo $actibebox;?> class="rounded-column-table">
                                <table class="table table-bordered">
                                    <tbody>
									<?php
									if((int)$users_no_of_orders1==0)
									{
									?>
									<tr>
                                            <td>&nbsp;<br>&nbsp;</td><td>
											&nbsp;
											</td>
									</tr>
									<tr>
                                            <td>&nbsp;<br>&nbsp;</td>
                                            <td>&nbsp;<br>&nbsp;</td>
                                        </tr>									
									<?php
									}
									else
									{
									?>
                                        <tr>
                                            <td><strong>Start date</strong><br><?php echo $StartDate2;?></td>
                                            <td>
                                                <div class="complete-text text-left">
                                                    <p><strong>Status (<?php echo $progress_s2;?>%)</strong></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_s2;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
                                                </div>

                                            </td>
                                        </tr>
										<tr>
                                            <td>&nbsp;<br>&nbsp;</td>
                                            <td>&nbsp;<br>&nbsp;</td>
                                        </tr>
									<?php
									}
									?>	
                                         
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="text-center btn-area">
                                <button type="submit" class="btn btn-secondary">view report</button>
                            </div>-->
                            <div <?php echo $actibebox2;?> class="rounded-column-footer text-center">
                                <ul>
                                    <li>
									<?php
									if($progress_s2 >= 100)
									{
									?>
									<br><a href="javascript:void(0)" onclick="reviewpage(2,<?php echo $order_id;?>)">Review</a>
									<?php
									}
									else if($Completed_2==1)
									{
									?>
									<br><a href="javascript:void(0)">&nbsp;</a>
									<?php
									}
									else
									{
									?>
									<br><?php
									if($progress_s2==0)
									{
									?>
									<a href="<?php echo base_url();?>register/professional/<?php echo (int)$users_ordersnumber1;?>">Start session</a>
									<?php
									}
									else
									{
									?>
									<a href="<?php echo base_url();?>selfassessment/professional/<?php echo (int)$users_ordersnumber1;?>">Continue session</a>
									<?php
									}
									?>
									<br><a href="<?php echo base_url();?>register/professional/<?php echo (int)$users_ordersnumber1;?>">Assessment Instructions</a>
									<?php
									}
									?>
									</li>
                                </ul>
                            </div>
						</div>
						</div> 						
						<?php
						}
						else
						{
							$Completed_2=-1;
						
						/*
							$actibebox2=" style='background:#cccccc !important;'";
							$Completed_2=1;
						?>
						<div style='background:#cccccc !important;' class="rounded-column">
							<div <?php echo $actibebox;?> class="rounded-column-text">
                               <p>OrgInsights Assessment</p>
                            </div>
							<table class="table table-bordered">
							<tbody>

							<tr>
									<td><strong>Start date</strong><br>&nbsp;</td><td>
									<div class="complete-text text-left">
                                                    <p><strong>Status </strong></p>
                                                </div>
									</td>
							</tr>
							<tr>
									<td>&nbsp;<br>&nbsp;</td>
									<td>&nbsp;<br>&nbsp;</td>
							</tr>
							</tbody>
							</table>
						<?php
						*/
						}
						?>
                        
                    
                    <?php
						if($users_package1==1 || $users_package1==3)
						{
						?>
						<div class="col-lg-3 offset-lg-0 col-md-3 offset-md-0 rounded-block">
						<?php
							$actibebox="";
							if((int)$users_no_of_orders1==0 || (int)$Completed1 > 0)
							{
								$actibebox=" style='background:#cccccc !important;'";
							}
			/*				
							$query_total_q_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_question
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = '360 Assessment'");
													

		
		if($query_total_q_o->num_rows() > 0)
		{
			$res_q_o = $query_total_q_o->row();
			
			$query_total_a_o = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = '360 Assessment' AND oatr.oa_val <> -99");
			$res_a_o = $query_total_a_o->row();
			
			if($res_q_o->total_question==0)
			{
				$progress_s3 = 0;
			}
			else
			{
			$progress_s3 = (integer)(($res_a_o->total_answer/$res_q_o->total_question) * 100);
			}
		}else{
			$progress_s3 = 0;
		}
		*/
		
		$progress_s3 = 0;
		if($PeopleInvited > 0 && $PeopleCompleted > 0)
		{
			$progress_s3=number_format((($PeopleCompleted/$PeopleInvited)*100),2);
		}
		
						
							$Completed_3=0;
							if($progress_s3 > 99)
							{
								$Completed_3=1;
							}
							
							if($Completed_1==0 || $Completed_2==0)
							{
								$Completed_3=1;
							}
							
							
						$actibebox2="";	
						if($Completed_3==1)
						{
							$actibebox2=" style='background:#cccccc !important;'";
						?>
						<div style='background:#cccccc !important;cursor:pointer;' onclick="reviewpage(3,<?php echo $order_id;?>)" class="rounded-column">
						<?php	
						}
						else
						{
						?>
						<div class="rounded-column">
						<?php	
						}	             
						?>
                            <div <?php echo $actibebox;?> class="rounded-column-text">
                                <p>360 Assessment</p>
								
                            </div>
						
                            <div <?php echo $actibebox;?> class="rounded-column-table">
                                <table class="table table-bordered">
                                    <tbody>
									<?php
									if((int)$users_no_of_orders1==0)
									{
									?>
									<tr>
                                            <td>&nbsp;<br>&nbsp;</td><td>
											&nbsp;
											</td>
									</tr>
									<tr>
                                            <td>&nbsp;<br>&nbsp;</td>
                                            <td>&nbsp;<br>&nbsp;</td>
                                        </tr>									
									<?php
									}
									else
									{
									?>
                                        <tr>
                                            <td><strong>Start date</strong><br><?php echo $Invitestart;?></td>
                                            <td>
                                                <div class="complete-text text-left">
                                                    <p><strong>Status (<?php echo $progress_s3;?>%)</strong></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress_s3;?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
                                                </div>

                                            </td>
                                        </tr>
										<tr>
                                            <td><strong>End Date</strong><br><?php echo $Inviteend." (".$PeopleInvited.")";?></td>
                                            <td><strong>Respondants</strong><br><?php echo $PeopleCompleted;?></td>
                                        </tr>
									<?php
									}
									?>	
                                         
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="text-center btn-area">
                                <button type="submit" class="btn btn-secondary">view report</button>
                            </div>-->
                            <div <?php echo $actibebox2;?> class="rounded-column-footer text-center">
                                <ul>
                                    <li>
									<?php
									if($progress_s3 >= 100)
									{
									?>
									<br><a href="javascript:void(0)" onclick="reviewpage(3,<?php echo $order_id;?>)">Review</a>
									<?php
									}
									else if($Completed_3==1)
									{
									?>
									<br><a href="javascript:void(0)">&nbsp;</a>
									<?php
									}
									else
									{
									?>
									<br><?php
									if($progress_s3==0)
									{
									?>
									<a href="<?php echo base_url();?>register/orginsights/<?php echo (int)$users_ordersnumber1;?>">Start session</a>
									<?php
									}
									else
									{
									?>
									<a href="<?php echo base_url();?>selfassessment/thirdparty/<?php echo (int)$users_ordersnumber1;?>">Continue session</a>
									<?php
									}
									?>
									<br><a href="<?php echo base_url();?>register/orginsights/<?php echo (int)$users_ordersnumber1;?>">Assessment Instructions</a>
									<?php
									}
									?>
									</li>
                                </ul>
                            </div>
						</div>
                    </div>	
						<?php
						}
						else
						{
						/*
							$actibebox2=" style='background:#cccccc !important;'";
						?>
						<div style='background:#cccccc !important;' class="rounded-column">
							<div <?php echo $actibebox;?> class="rounded-column-text">
                               <p>360 Assessment</p>
                            </div>
							<table class="table table-bordered">
							<tbody>

							<tr>
									<td><strong>Start date</strong><br>&nbsp;</td><td>
									<div class="complete-text text-left">
                                                    <p><strong>Status </strong></p>
                                                </div>
									</td>
							</tr>
							<tr>
                                            <td><strong>Invited</strong><br>&nbsp;</td>
                                            <td><strong>Respondants</strong><br>&nbsp;</td>
                                        </tr>
							</tbody>
							</table>
						<?php
						*/
						}
						?>
                        
					<?php
					$checksessionb=0;
					$checksession1="";
					$checksession2="";

					if($users_no_of_orders > 0)
					{
					
						foreach($incomplete_orders as $row)
						{
							if($checksessionb==0)
							{
								$checksessionb=(int)$row['order_package_id'];
							}
						}
					}
									
					if($checksessionb==3)
					{
						$checksession1='onclick="checks()"';
						$checksession2='onclick="checks()"';
					}
					else if($checksessionb==2)
					{
						$checksession1='onclick="checks()"';
					}	

					$checksession1='onclick="checks()"';
					$checksession2='onclick="checks()"';	
					?>
                    <div class="col-lg-3 col-md-3 rounded-block">
                        <div class="rounded-column rounded-column2">
                            <div class="create">
                                <a href="#" data-toggle="modal" data-target="#createNewSession"><br><span>Create New Session</span><img src="<?php echo base_url();?>asset/images/plus-icon-big.png" class="img-fluid"></a>
                                <!-- Modal -->
                                <div class="modal fade createSessionModal" id="createNewSession" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="row">
											<div class="col-md-4 leftModalContent blueColor">
                                                <h4>ORGINSIGHTS ASSESSMENT</h4>
                                                <h2>
                                                    <span class="cutOffPrice2 cutOffPrice">
                                                     <?php echo $assessments_arrayd[2];?>   
                                                    </span>
                                                    <span class="actualPrice">
                                                        <sup><?php echo $UserCurrency;?></sup>
                                                        <span><?php echo $assessments_array[2];?></span>
                                                    </span>
                                                </h2>
                                                <!--<h6>per month</h6>-->
                                                <ul>
                                                    <li>Self Assessment</li>
                                                    <li>OrgInsights Assessment </li>
													<li>OrgInsights Report</li>
													<li>Additional Insights Report</li>
                                                    
													
                                                </ul>
												<p style="line-height:68px;">&nbsp;</p>
												<form id="checkout2" action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="2" />
                                                <button <?php echo $checksession2;?> id="orgin" data-dismiss="modal">pay now</button>
												</form>
                                            </div>
                                            <div class="col-md-4 leftModalContent">
                                                <h4>360 ASSESSMENT
												<p>&nbsp;</p>
												</h4>
                                                <h2>
                                                    <span style="line-height:50px;" class="cutOffPrice">
                                                     <?php echo $assessments_arrayd[1];?>
													</span>
                                                    <span class="actualPrice">
                                                        <sup><?php echo $UserCurrency;?></sup>
                                                        <span><?php echo $assessments_array[1];?></span>
                                                    </span>
                                                </h2>
                                                <!--<h6>per month</h6>-->
												<ul>
                                                    <li>Self Assessment</li>
                                                    <li>360 Assessment</li>
													<li>360 Insights Report</li>
                                                    
                                                </ul>
												<p style="line-height:110px;">&nbsp;</p>
												<form id="checkout1" action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="1" />
												
												
                                                <button <?php echo $checksession1;?> data-dismiss="modal" id="self" >pay now</button>
												</form>
                                            </div>
                                            
											<div class="col-md-4 leftModalContent">
                                                <h4>ORGINSIGHTS AND 360 ASSESSMENT
</h4>
                                                <h2>
                                                    <span class="cutOffPrice">
                                                     <?php echo $assessments_arrayd[3];?>   
                                                    </span>
                                                    <span class="actualPrice">
                                                        <sup><?php echo $UserCurrency;?></sup>
                                                        <span><?php echo $assessments_array[3];?></span>
                                                    </span>
                                                </h2>
                                                <!--<h6>per month</h6>-->
                                                <ul>
                                                    <li>Self Assessment</li>
                                                    <li>OrgInsights Assessment</li>
                                                    <li>360 Assessment </li>
													<li>OrgInsights Report</li>
													<li>Additional Insights Report</li>
													<li>360 Insights Report</li>
                                                </ul>
												<form id="checkout3" action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="3" />
                                                <button <?php echo $checksession2;?> id="orgin360" data-dismiss="modal">pay now</button>
												</form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
                    </div>
                </div>
				<!--<div class="text-center btn-area">
                                <button type="submit" class="btn btn-secondary">view report</button>
                            </div>-->
<?php
if($users_package1==1 && $progress_s1 >= 100 && $progress_s3 >= 100)
{
	$Displayalertmsg=0;
}
if($users_package1==2 && $progress_s1 >= 100 && $progress_s2 >= 100)
{
	$Displayalertmsg=0;
}
if($users_package1==3 && $progress_s1 >= 100 && $progress_s2 >= 100 && $progress_s3 >= 100)
{
	$Displayalertmsg=0;
}

if((int)$users_package1==0)
{
	$Displayalertmsg=0;
}
?>							
                <div class="row">
				<?php
				if($users_no_of_orders > 0)
				{
				?>
                    <!--<div class="col-md-12 progress-title">
                        <h4>In-Completed Sessions</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="sessions-table">
                            <table class="table responsive-table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="380">Details</th>
                                        <th scope="col" width="180">Date started</th>
                                        <th scope="col" width="180">Respondants</th>
                                        <th scope="col" width="180">Date Completed</th>
                                        <th scope="col" width="210">View Report</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									foreach($incomplete_orders as $row)
									{
									?>
		
                                    <tr>
                                        <td colspan="5">
                                            <table class="table">
                                                <tr>
                                                    <td data-label="Details" width="380"><?php echo $row['order_package_name'];?></td>
                                                    <td data-label="Date started" width="180">31 July 2020</td>
                                                    <td data-label="Respondants" width="180">1233</td>
                                                    <td data-label="Date Completed" width="180">01 January 2021</td>
                                                    <td data-label="View Report" width="210">
													<?php
													if($row['order_package_id'] == 1)
													{
														if($row['order_status'] == 'Ordered')
														{
															$url = base_url().'register/self/'.$row['order_id'];
														}else{
															$url = base_url().'selfassessment/'.$row['order_id'];
														}
													}elseif($row['order_package_id'] == 2)
													{
														if($row['order_status'] == 'Ordered')
														{
															$url = base_url().'register/selfassessment/'.$row['order_id'];
														}else{
															$url = base_url().'selfassessment/'.$row['order_id'];
														}
													}else{
														if($row['order_status'] == 'Ordered')
														{
															$url = base_url().'register/selfassessment/'.$row['order_id'];
														}else{
															$url = base_url().'selfassessment/'.$row['order_id'];
														}
													}
													?>
													<a href="<?php echo $url;?>" class="btn btn-secondary" >More details</a>
													</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="footer-td">
                                                        <div class="session-footer session-footer2">
                                                            <ul>
                                                                <li><a data-toggle="collapse" href="#gr-1" role="button" aria-expanded="false" aria-controls="gr-1"><img src="<?php echo base_url();?>asset/images/session-icon-1.png"> Generate report</a>
                                                                <div class="gr-links">
                                                                <div class="collapse" id="gr-1">
                                                                <div class="card card-body">
                                                                <ol>
                                                                <li><a href="#">Self Assessment </a></li>                                     
																<li><a href="#">Orginsights Assessment </a></li>                                   
																<li><a href="#">360 Assessment</a></li>
                                                                </ol>
                                                                </div>
                                                                </div>
                                                                </div>
                                                                </li>
                                                                <li><a href="#"><img src="<?php echo base_url();?>asset/images/session-icon-2.png"> Repost</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="session-footer session-footer1">
                                                            <ul>
                                                                <li><a href="#">More details <img src="<?php echo base_url();?>asset/images/select-bg.png"></a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
								<?php
								}
								?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
					-->
<script>
function switchoption(n1,n2)
{
	if(n1==1)
	{
		document.getElementById("MeanSpan_"+n2).style.display="block";
		document.getElementById("PercSpan_"+n2).style.display="none";
		document.getElementById("perccheck_"+n2).checked=false;
	}
	else if(n1==2)
	{
		document.getElementById("MeanSpan_"+n2).style.display="none";
		document.getElementById("PercSpan_"+n2).style.display="block";
		
		document.getElementById("perccheck_"+n2).checked=true;
	}
}
</script>
<style>
.switch-field {
	max-width: 150px;
	display: flex;
	margin-bottom: 36px;
	overflow: hidden;
	width:auto;
	padding:17px 15px 15px 15px;
	border-radius:45%;
}

.switch-field span {
cursor:pointer;
}

.switch-field input {
	position: absolute !important;
	clip: rect(0, 0, 0, 0);
	height: 1px;
	width: 1px;
	border: 0;
	overflow: hidden;
	
}



.switch-field label:hover {
	cursor: pointer;
}


.switch-field label .index{
	background-color: #ffffff;
	color: #ffffff;
	font-size: 14px;
	text-align: center;
	padding: 8px 8px;
	border: 0px solid rgba(0, 0, 0, 0);
	border-radius: 60%;
	box-shadow: none;
	
}
.switch-field input:checked + label .index{
	background-color: #0b8465;
	color: #0b8465;
	font-size: 14px;
	text-align: center;
	padding: 8px 8px;
	border: 0px solid rgba(0, 0, 0, 0);
	border-radius: 60%;
	box-shadow: none;
	
}
</style>					
					<?php
					$showCompleted=0;
					foreach($complete_orders as $row)
					{
						
						include("CheckCompletion.php");
					
						if($isComplete==1)
						{
							$showCompleted=1;
							break;
						}
					}
					if($showCompleted==1)
					{	
					?>
					<div class="col-md-12 completedsessions progress-title">
                        <h4>Completed Sessions</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="sessions-table">
                            <table class="table responsive-table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="380">Details</th>
                                        <th scope="col" width="180">Date started</th>
										<th scope="col" width="180">Date Completed</th>
										<?php
										if($is360==1)
										{
										?>
                                        <th scope="col">Respondants</th>
                                        <?php
										}
										else
										{
										echo '<th scope="col">&nbsp;</th>';
										}
										?>
										
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
						}//end show complete check
							
									$cnt=0;
									foreach($complete_orders as $row)
									{
										
										include("CheckCompletion.php");
									
										
										if($isComplete==1)
										{										
										$cnt++;
									?>
		
                                    <tr>
                                        <td colspan="5">
                                            <table class="table">
										
                                                <tr>
                                                    <td data-label="Details" width="380"><?php 
/*													
if($row['order_package_name']=="OrgInsights and 360 Assessment")
{
	if($Completed_1 >= 100 && $Completed_2 >= 100 && $Completed_3 >= 100)
	{
		echo "OrgInsights and 360 Assessment";
	}
	else if($Completed_1 >= 100 && $Completed_2 >= 100)
	{
		echo "OrgInsights Assessment";
	}
	else if($Completed_1 >= 100)
	{
		echo "Self Assessment";
	}
	
}
else if($row['order_package_name']=="OrgInsights Assessment")
{
	if($Completed_1 >= 100 && $Completed_2 >= 100)
	{
		echo "OrgInsights Assessment";
	}
	else if($Completed_1 >= 100)
	{
		echo "Self Assessment";
	}
	
}
else if($row['order_package_name']=="360 Assessment")
{
	if($Completed_1 >= 100 && $Completed_3 >= 100)
	{
		echo "360 Assessment";
	}
	else if($Completed_1 >= 100)
	{
		echo "Self Assessment";
	}
	
}
*/
													
													echo $row['order_package_name']	;
													
													
													
													?></td>
                                                    <td data-label="Date started" width="180" align="left">
													<?php
													if(isset($row['order_date']) && $row['order_date']!="")
													{
														$Splitdate=explode(" ",$row['order_date']);
														$Splitdate2=explode("-",$Splitdate[0]);
														
														$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
														
														$Corderdate=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
													}
													else
													{
														$Corderdate="";
													}
													echo $Corderdate;
													?></td>
													
						    <td data-label="Date Completed" width="180" align="left">

<?php
													$checkdate = $this->db->query("SELECT updated
									FROM orders_assessment_type_responses WHERE order_id = '".(int)$row['order_id']."' order by updated desc limit 0,1");
$checkdateR=$checkdate->result_array();	
if(isset($checkdateR[0]["updated"]) && $checkdateR[0]["updated"]!="")
{	
	$Splitdate=explode(" ",$checkdateR[0]["updated"]);
	$Splitdate2=explode("-",$Splitdate[0]);
	
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	
	$DateCompleted=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
}
else
{
	$DateCompleted="";
}
															echo $DateCompleted;
															
if($row['order_package_id'] == 3 && $isComplete360==0)
{
		echo "<br>360 Assessment in progress";
}															
															?>
</td>
<?php
if($is360==1)
{
?>
<td data-label="Respondants"><?php
if($row['order_package_id'] == 1 || $row['order_package_id'] == 3)
{
	echo $Respondants;
}
?></td>
<?php
}
else
{
echo '<td>&nbsp;</td>';
}
?>
<td align="center">
<div style="display:none;">
<input type="checkbox" value=1 name="perccheck" id="perccheck_<?php echo $row['order_id'];?>" checked>
</div>
<div class="switch-field">
<input type="radio" id="MeanScore_<?php echo $row['order_id'];?>" name="switch-one_<?php echo $row['order_id'];?>" value="yes" checked/>
<input type="radio" id="Percentage_<?php echo $row['order_id'];?>" name="switch-one_<?php echo $row['order_id'];?>" value="no" />
<span style="display:none;" id="MeanSpan_<?php echo $row['order_id'];?>" onclick="switchoption(2,<?php echo $row['order_id'];?>)"><img src="<?php echo base_url();?>assets/images/Toggl-ON.png"></span>
<span id="PercSpan_<?php echo $row['order_id'];?>" onclick="switchoption(1,<?php echo $row['order_id'];?>)"><img src="<?php echo base_url();?>assets/images/Toggl-OFF.png"></span>
</div>

<div style="clear:both;"></div>
</td>
                                                    <td data-label="View Report" width="210">
													
													<?php
													if($row['order_package_id'] == 1)
													{
														if($row['order_status'] == 'Ordered')
														{
															$url = base_url().'register/self/'.$row['order_id'];
														}else{
															$url = base_url().'selfassessment/'.$row['order_id'];
														}
													}elseif($row['order_package_id'] == 2)
													{
														if($row['order_status'] == 'Ordered')
														{
															$url = base_url().'register/self/'.$row['order_id'];
														}else{
															$url = base_url().'selfassessment/'.$row['order_id'];
														}
													}else{
														if($row['order_status'] == 'Ordered')
														{
															$url = base_url().'register/self/'.$row['order_id'];
														}else{
															$url = base_url().'selfassessment/'.$row['order_id'];
														}
													}
													?>
													<div class="session-footer session-footer2">
                                                            <ul>
														<li>
														<?php
														$Showreport=0;
														$is360=0;
														if($row['order_package_id'] == 1 || $row['order_package_id'] == 3)
														{
															$is360=1;
														}
														if($Completed_2 >= 100 || $Completed_3 >= 100)
														{
															$Showreport=1;
														}
														else if($row['order_package_id'] == 1 && $Completed_1 >= 100)
														{
															$Showreport=1;
														}
														else if($row['order_package_id'] == 3 && $Completed_1 >= 100)
														{
															$Showreport=1;
														}
														if($Showreport==1)
														{
														?>
														<a data-toggle="collapse" href="#gr-<?php echo $cnt;?>" role="button" aria-expanded="false" aria-controls="gr-<?php echo $cnt;?>" class="btn btn-secondary" style="color:#ffffff;" >Generate Report</a>
														<?php
														}
														?>
														<div class="gr-links">
															<div class="collapse" id="gr-<?php echo $cnt;?>">
																<div class="card card-body">
																<ol>
																<?php
																/*
																<li><a href="javascript:openreport(<?php echo $row['order_id'];?>)">Orginsights Assessment </a></li>
																<li><a target="_blank" href="<?php echo base_url();?>finalreportd/<?php echo $row['order_id'];?>".>Additional Insights Report<br>Optimized</a></li>
																*/
																if($Completed_2 >= 100)
																{
																?>
																
																<li><a href="javascript:openpdfreport(<?php echo $row['order_id'];?>,1)".>Orginsights PDF </a></li>
																<?php
																}
																if($Completed_2 >= 100 && $Showadditionalrep==1)
																{
																/*
																<li><a target="_blank" href="<?php echo base_url();?>finalreporte/<?php echo $row['order_id'];?>".>New Additional Insights Report<br>Optimized&nbsp;<img src="<?php echo base_url();?>assets/images/cominginmarch.png" width="150px"></a></li>
																*/
																?>
																
																<li><a target="_blank" href="<?php echo base_url();?>finalreport/<?php echo $row['order_id'];?>".> Additional Insights Report&nbsp;</a></li>
																<?php
																}
																if($isComplete360==1)
																{
																?>
																<li><a href="javascript:open360report(<?php echo $row['order_id'];?>,3)">360 Assessment</a></li>
																
																
																<?php
																}
																/*
																<li><a target="_blank" href="<?php echo base_url();?>reportvalidation/<?php echo $row['order_id'];?>".>Orginsights Validation </a></li>
																<?php
																
																if($Completed_1 >= 100 && $is360==1)
																{
																?>
																<li><a target="_blank" href="<?php echo base_url();?>report360/<?php echo $row['order_id'];?>">360 Assessment</a></li>
																
																<li><a target="_blank" href="<?php echo base_url();?>report360validation/<?php echo $row['order_id'];?>">360 Validation</a></li>
																<?php
																}
																if($Completed_2 >= 100)
																{
																?>
																<li><a target="_blank" href="<?php echo base_url();?>finalreportd/<?php echo $row['order_id'];?>".>Additional Insights Report<br>Optimized</a></li>
																<li><a target="_blank" href="<?php echo base_url();?>finalreportc/<?php echo $row['order_id'];?>".>Additional Insights Report <br>With My Data Filters</a></li>
																<li><a target="_blank" href="<?php echo base_url();?>finalreportperc/<?php echo $row['order_id'];?>".>Additional Insights Report <br> with %
</a></li>
																<?php
																}
																*/
																?>
																</ol>
																</div>
															</div>
														</div>
														</li>
														</ul>
													</div>	
													</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" class="footer-td">
                                                        <div class="session-footer session-footer2">
                                                            <ul>
                                                                <li><form action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="<?php echo (int)$row['order_package_id'];?>" />
												<button style="background:none;border:0px;font-size: 15px;color: #146da8;font-weight: 600;"><img src="<?php echo base_url();?>asset/images/session-icon-2.png"> Repurchase</button>
												</form>
																</li>
                                                            </ul>
                                                        </div>
                                                       <!-- <div class="session-footer session-footer1">
                                                            <ul>
                                                                <li><a href="#">More details <img src="<?php echo base_url();?>asset/images/select-bg.png"></a></li>
                                                            </ul>
                                                        </div>-->
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
								<?php
									}	
								}
						if($showCompleted==1)
						{		
								?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
				<?php
						}//end show complete check
				}
				?>
                </div>
            </div>

        </div>
    </div>
<script>
Displayalertmsg="<?php echo (int)$Displayalertmsg;?>";
askonselection="<?php echo (int)$askonselection;?>";
function checks()
{
	if(Displayalertmsg==1 && askonselection==1)
	{
	alert("You currently have an active assessment.\nYour assessments will be closed upon purchase of a new one.");
	}
}
function reviewpage(n1,n2)
{
	reviewpagename="self";

	if(n1==2)
	{
		reviewpagename="orginsights";
	}
	else if(n1==3)
	{
		reviewpagename="a360";
	}
	
	location.href="<?php echo base_url();?>review/"+reviewpagename+"/"+n2;
}
function openreport(n1)
{
	if(document.getElementById('perccheck_'+n1).checked==true)
	{
		window.open("<?php echo base_url();?>report/"+n1+"/1");
	}
	else
	{
		window.open("<?php echo base_url();?>report/"+n1);
	}
}
function openpdfreport(n1,n2)
{
	if(document.getElementById('perccheck_'+n1).checked==true)
	{
		window.open("<?php echo base_url();?>orgreports/"+n1+"/1");
	}
	else
	{
		window.open("<?php echo base_url();?>orgreports/"+n1);
	}
}
function open360report(n1,n2)
{
	if(document.getElementById('perccheck_'+n1).checked==true)
	{
		window.open("<?php echo base_url();?>reports360/"+n1+"/1");
	}
	else
	{
		window.open("<?php echo base_url();?>reports360/"+n1);
	}
}
function openpdf(n1,n2)
{

	if(document.getElementById('perccheck_'+n1).checked==true)
	{
		window.open("<?php echo base_url();?>showpdf/"+n1+"/1"+"/"+n2, "myWindow");
	}
	else
	{
		window.open("<?php echo base_url();?>showpdf/"+n1+"/0"+"/"+n2, "myWindow");
	}
	
		
	
}
</script>
