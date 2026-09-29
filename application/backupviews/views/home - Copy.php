<?php
if(isset($order_date) && $order_date!="")
{
	$Splitdate=explode(" ",$order_date);
	$Splitdate2=explode("-",$Splitdate[0]);
	
	$monthName = date('F', mktime(0, 0, 0, $Splitdate2[1], 10));
	
	$order_date=$Splitdate2[2]." ".$monthName." ".$Splitdate2[0];
}
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
                        <p><?php echo $this->session->userdata('ref_code');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <div class="section">
        <div class="container">
            <div class="register-column">
                <div class="row">
                    <div class="col-md-12 progress-title border-bottom-text">
                        <h4>In progress</h4>
                    </div>
                </div>
                <div class="row rounded-column-row">
				<div class="col-lg-3 offset-lg-0 col-md-3 offset-md-0 rounded-block">
                        <?php
						if($users_package1==1)
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
									
							if($query_total_q_s->num_rows() > 0)
							{
								$res_q_s = $query_total_q_s->row();
								$query_total_a_s = $this->db->query("SELECT COUNT(oatr.oatr_id) AS total_answer 
									FROM orders_assessment_type_responses oatr
									LEFT JOIN orders_assessment_type AS oat ON oat.oat_id = oatr.oat_id
									WHERE oatr.order_id = '".$order_id."' AND oat.assessment_type = 'Self Assessment' AND oatr.oa_id <> 0");
							$res_a_s = $query_total_a_s->row();
								$progress_s1 = (integer)(($res_a_s->total_answer/$res_q_s->total_question) * 100);
							}else{
								$progress_s1 = 0;
							}	
						
							$Completed_1=0;
							if($progress_s1 > 10)
							{
								$Completed_1=1;
							}
						$actibebox2="";	
						if($Completed_1==1)
						{
							$actibebox2=" style='background:#cccccc !important;'";
						?>
						<div style='background:#cccccc !important;' class="rounded-column">
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
                                            <td><strong>Start date</strong><br><?php echo $order_date;?></td>
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
									<br><a href="javascript:void(0)">&nbsp;</a>
									<?php
									}
									else
									{
									?>
									<br><a href="<?php echo base_url();?>register/self/<?php echo (int)$users_ordersnumber1;?>">Continue session</a>
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
                    <div class="col-lg-3 offset-lg-0 col-md-3 offset-md-0 rounded-block">
                        <?php
						if($users_package1==2 || $users_package1==3)
						{
						?>
						<div class="rounded-column">
						<?php
						
							$actibebox="";
							if((int)$users_no_of_orders2==0 || (int)$Completed2==0)
							{
								$actibebox=" style='background:#cccccc !important;'";
							}
						?>
                            <div <?php echo $actibebox;?> class="rounded-column-text">
                                <p>OrgInsights Assessment</p>
                            </div>
						
                            <div <?php echo $actibebox;?> class="rounded-column-table">
                                <table class="table table-bordered">
                                    <tbody>
									<?php
									if((int)$users_no_of_orders2==0)
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
                                            <td><strong>Start date</strong><br>01 August 2020</td>
                                            <td>
                                                <div class="complete-text text-left">
                                                    <p><strong>Status (45%)</strong></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
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
                            <div <?php echo $actibebox;?> class="rounded-column-footer text-center">
                                <ul>
                                    <li>
									<?php
									if((int)$users_no_of_orders2==0)
									{
									?>
									<br><a href="javascript:void(0)">&nbsp;</a>
									<?php
									}
									else
									{
									?>
									<br><a href="<?php echo base_url();?>register/professional/<?php echo (int)$users_ordersnumber2;?>">Continue session</a></li>
									<?php
									}
									?>
                                </ul>
                            </div>
							
						<?php
						}
						else
						{
						?>
						<div style='background:#cccccc !important;' class="rounded-column">
						<?php
						}
						?>
						</div>
                        
                    </div>
					<div class="col-lg-3 offset-lg-0 col-md-3 offset-md-0 rounded-block">
                        <div class="rounded-column">
						<?php
						if($users_no_of_orders > 0)
						{
						
							$actibebox="";
							if((int)$users_no_of_orders3==0 || (int)$Completed3==0)
							{
								$actibebox=" style='background:#cccccc !important;'";
							}
						?>
                            <div <?php echo $actibebox;?> class="rounded-column-text">
                                <p>360 Assessment</p>
                            </div>
						
                            <div <?php echo $actibebox;?> class="rounded-column-table">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><strong>Start date</strong><br>01 August 2020</td>
                                            <td>
                                                <div class="complete-text text-left">
                                                    <p><strong>Status (45%)</strong></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="60"></div>
                                                </div>

                                            </td>
                                        </tr>
                                         <tr>
                                            <td><strong>Invited</strong><br>1233</td>
                                            <td><strong>Respondants</strong><br>3025</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!--<div class="text-center btn-area">
                                <button type="submit" class="btn btn-secondary">view report</button>
                            </div>-->
                            <div <?php echo $actibebox;?> class="rounded-column-footer text-center">
                                <ul>
                                    <li><a href="#">Send reminder</a><br><a href="<?php echo base_url();?>register/orginsights/<?php echo (int)$users_ordersnumber3;?>">Continue session</a></li>
                                </ul>
                            </div>
						<?php
						}
						?>
                        </div>
                    </div>
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
                                            <div class="col-md-4 leftModalContent">
                                                <h4>360 Assessment</h4>
                                                <h2>
                                                    <span class="cutOffPrice">
                                                        <sup>$</sup>
                                                        <span>125</span>
                                                    </span>
                                                    <span class="actualPrice">
                                                        <sup>$</sup>
                                                        <span>100</span>
                                                    </span>
                                                </h2>
                                                <h6>per month</h6>
                                                <ul>
                                                    <li>Self Assessment</li>
                                                    <li>360 Assessment</li>
                                                    <li></li>
                                                </ul>
												<form id="checkout1" action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="1" />
                                                <button <?php echo $checksession1;?> data-dismiss="modal" id="self" >pay now</button>
												</form>
                                            </div>
                                            <div class="col-md-4 leftModalContent blueColor">
                                                <h4>OrgInsights Assessment</h4>
                                                <h2>
                                                    <span class="cutOffPrice">
                                                        <sup>$</sup>
                                                        <span>225</span>
                                                    </span>
                                                    <span class="actualPrice">
                                                        <sup>$</sup>
                                                        <span>205</span>
                                                    </span>
                                                </h2>
                                                <h6>per month</h6>
                                                <ul>
                                                    <li>Self Assessment</li>
                                                    <li>OrgInsights Assessment </li>
                                                    <li></li>
													
                                                </ul>
												<form id="checkout2" action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="2" />
                                                <button <?php echo $checksession2;?> id="orgin" data-dismiss="modal">pay now</button>
												</form>
                                            </div>
											<div class="col-md-4 leftModalContent">
                                                <h4>OrgInsights and 360 Assessment</h4>
                                                <h2>
                                                    <span class="cutOffPrice">
                                                        <sup>$</sup>
                                                        <span>275</span>
                                                    </span>
                                                    <span class="actualPrice">
                                                        <sup>$</sup>
                                                        <span>235</span>
                                                    </span>
                                                </h2>
                                                <h6>per month</h6>
                                                <ul>
                                                    <li>Self Assessment</li>
                                                    <li>OrgInsights Assessment</li>
                                                    <li>360 Assessment </li>
                                                </ul>
												<form id="checkout3" action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="3" />
                                                <button id="orgin360" data-dismiss="modal">pay now</button>
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
					
					<div class="col-md-12 progress-title">
                        <h4>Completed Sessions</h4>
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
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$cnt=0;
									foreach($complete_orders as $row)
									{
										$cnt++;
									?>
		
                                    <tr>
                                        <td colspan="5">
                                            <table class="table">
                                                <tr>
                                                    <td data-label="Details" width="380"><?php echo $row['order_package_name']	;?></td>
                                                    <td data-label="Date started" width="180">31 July 2020</td>
                                                    <td data-label="Respondants" width="180"><?php
													if($row['order_package_id'] == 1)
													{
													echo "1233";
													}
													?></td>
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
														<li><a data-toggle="collapse" href="#gr-<?php echo $cnt;?>" role="button" aria-expanded="false" aria-controls="gr-<?php echo $cnt;?>" class="btn btn-secondary" style="color:#ffffff;" >Generate Report</a>
														<div class="gr-links">
															<div class="collapse" id="gr-<?php echo $cnt;?>">
																<div class="card card-body">
																<ol>
																<li><a href="<?php echo base_url();?>register/self/<?php echo (int)$row['order_id'];?>">Self Assessment </a></li>                                     
																<li><a href="<?php echo base_url();?>register/professional/<?php echo (int)$row['order_id'];?>">Orginsights Assessment </a></li>                                   
																<li><a href="<?php echo base_url();?>register/orginsights/<?php echo (int)$row['order_id'];?>">360 Assessment</a></li>
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
                                                    <td colspan="5" class="footer-td">
                                                        <div class="session-footer session-footer2">
                                                            <ul>
                                                                <li><form action="<?php echo base_url()?>checkout" method="Post">
												<input type="hidden" name="package_id" id="package_id" value="<?php echo (int)$row['order_package_id'];?>" />
												<button style="background:none;border:0px;font-size: 15px;color: #146da8;font-weight: 600;"><img src="<?php echo base_url();?>asset/images/session-icon-2.png"> Repost</button>
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
								?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
				<?php
				}
				?>
                </div>
            </div>

        </div>
    </div>
<script>
function checks()
{
	alert("You currently have an active assessment.\nYour assessments will be closed upon purchase of a new one.");
}
</script>