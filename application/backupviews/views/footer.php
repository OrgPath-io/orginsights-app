<footer class="footer">
        <div class="container">&copy; Copyrights 2020 Orginsights. All Rights Reserved</div>
    </footer>

    <!-- Price Modal ---->
    <div class="price-modal modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 price-left">
                            <div class="plan-price-col text-center">
                                <h6>plan 1</h6>
                                <h4><span class="symbol">$</span>125<br>
                                    <span class="text">per month</span></h4>
                                <ul>
                                    <li>self and professional</li>
                                    <li></li>
                                </ul>
                                <a class="btn btn-secondary">pay now</a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 price-right">
                            <div class="plan-price-col text-center">
                                <h6>plan 2</h6>
                                <h4><span class="symbol">$</span>225<br>
                                    <span class="text">per month</span></h4>
                                <ul>
                                    <li>360 Feedback</li>
                                    <li>Self and Professional</li>
                                    <li>Peers (up TO 10)</li>
                                </ul>
                                <a class="btn btn-secondary">pay now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" id="footerfield" value=1>
    <!-- Bootstrap core JavaScript================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url();?>asset/js/jquery-min.js"></script>
    <script src="<?php echo base_url();?>asset/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>asset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>asset/js/ie10-viewport-bug-workaround.js"></script>
    <script src="<?php echo base_url();?>asset/js/ie-emulation-modes-warning.js"></script>
    <script src="<?php echo base_url();?>asset/js/custom.js"></script>
    <script src="<?php echo base_url();?>asset/js/jquery.matchHeight-min.js"></script>
	<script src="<?php echo base_url();?>asset/js/typeahead.js"></script>
    <script type="text/javascript">
        jQuery('.coleql_height').matchHeight();
		var checkboxes = $("input[type='checkbox']"),
		submitButt = $("button[type='button']");
		checkboxes.click(function() {
		//submitButt.attr("disabled", !checkboxes.is(":checked"));
		});
		
		
		function continue_click(id,n1=0)
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
				$(".unknow").hide();
				
				$('#div'+id).show(function(){$('#div'+id).focus();});
				
				if(n1==1)
				{
					checkprogress(n1);
				}
				
			}
			else
			{
				alert("Please Select Answer for all questions");
			}
		}
		
		$('form[name="form_register"]').submit(function(e) {
									  
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if($("#first_name").val()=="First name" || $("#first_name").val()=="")
		{
			$("#first_name").addClass('error');	
			$("#first_name").focus().val('').attr('placeholder','Please Enter First Name');
			return false;
		}
		
		if($("#last_name").val()=="Last name" || $("#last_name").val()=="")
		{
			$("#last_name").addClass('error');	
			$("#last_name").focus().val('').attr('placeholder','Please Enter Last Name');
			return false;
		}
		
		if(!filter.test($("#email").val()))
		{
			$("#email").addClass('error');	
			$("#email").focus().val('').attr('placeholder','Please Enter Valid Email Address');
			return false;
		}
		
		if($("#password").val()=="Password" || $("#password").val()=="")
		{
			$("#password").addClass('error');	
			$("#password").focus().val('').attr('placeholder','Please Enter Password Here');
			return false;
		}
		
		if($("#password").val()!=$("#confirm_password").val() )
		{
			$("#confirm_password").focus().val('').attr('placeholder','Password does not match');
			return false;
		}
		
		
	});

		$('form[name="forgot_password"]').submit(function(e) {

			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if(!filter.test($("#email").val()))
			{
				$("#email").addClass('error');
				$("#email").focus().val('').attr('placeholder','Please Enter Valid Email Address');
				return false;
			}




		});


		$('form[name="set_new_password"]').submit(function(e) {



			if($("#password").val()=="Password" || $("#password").val()=="")
			{
				$("#password").addClass('error');
				$("#password").focus().val('').attr('placeholder','Please Enter Password Here');
				return false;
			}

			if($("#password").val()!=$("#confirm_password").val() )
			{
				$("#confirm_password").focus().val('').attr('placeholder','Password does not match');
				return false;
			}


		});



		$('#self').click(function(e) {
        e.preventDefault();
        $("#checkout1").submit();
    });
	
   $('#orgin').click(function(e) {
        e.preventDefault();
        $("#checkout2").submit();
    });
   $('#orgin360').click(function(e) {
        e.preventDefault();
        $("#checkout3").submit();
    });	
	if(typeof state_id !== "undefined")
	{
		continue_click(state_id);
    }


	
$(document).on('click', '#invite_users',function(e) {

		//var FrequencyofReminders=$("#FrequencyofReminders").val();
		//var LengthofAssessment=$("#LengthofAssessment").val();
		//$("#FrequencyofR").val(FrequencyofReminders);
		//$("#LengthofA").val(LengthofAssessment);
		
		var LengthofAssessment=$("#MainLengthofAssessment").val();
		$("#LengthofAssessment").val(LengthofAssessment);
		
		var FrequencyofReminders=$("#MainFrequencyofReminders").val();
		$("#FrequencyofReminders").val(FrequencyofReminders);
		
		var MessageID=$("#ID").val();
		$("#MessageTemplate").val(MessageID);
		
									 
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if($("#first_name").val()=="First name" || $("#first_name").val()=="")
		{
			$("#first_name").addClass('error');	
			$("#first_name").focus().val('').attr('placeholder','Please Enter First Name');
			return false;
		}
		
		if($("#last_name").val()=="Last name" || $("#last_name").val()=="")
		{
			$("#last_name").addClass('error');	
			$("#last_name").focus().val('').attr('placeholder','Please Enter Last Name');
			return false;
		}
		
		if(!filter.test($("#email").val()))
		{
			
			$("#email").addClass('error');	
			$("#email").focus().val('').attr('placeholder','Please Enter Valid Email Address');
			return false;
		}
		
		/*if($("#wwt").val()=="Last name" || $("#wwt").val()=="")
		{
			$("#wwt").addClass('error');	
			$("#wwt").focus().val('').attr('placeholder','Please Enter Details');
			return false;
		}
		
		if($("#mentor").val()=="Last name" || $("#mentor").val()=="")
		{
			$("#mentor").addClass('error');	
			$("#mentor").focus().val('').attr('placeholder','Please Enter Mentor');
			return false;
		}
		
		if($("#peer").val()=="Last name" || $("#peer").val()=="")
		{
			$("#peer").addClass('error');	
			$("#peer").focus().val('').attr('placeholder','Please Enter if this person a peer');
			return false;
		}*/
		
		$("#invite_users_form").on( "submit", function(e) {
			
			//var FrequencyofReminders=$("#FrequencyofReminders").val();
			//var LengthofAssessment=$("#LengthofAssessment").val();
			//$("#FrequencyofR").val(FrequencyofReminders);
			//$("#LengthofA").val(LengthofAssessment);
			
			var data2=1;
			
			
			var postData = $(this).serializeArray();
			var formURL = "<?php echo base_url().'selfassessment/add_invite_user/';?>"+order_id; 
			
			$.ajax(
			{
				url : formURL,
				type: "POST",
				data : postData,
				success:function(data) 
				{
					//$("#footerfield").val(1);
					/*
					//document.getElementById('footerfield').value=data;
					if(data==0)
					{
						//alert("You have already added a name with the same email address");
						//data=1;
					}
					*/
					
					//data: return data from server
					//alert('it worked');
					var checkboxes = $('input[type="checkbox"]').length;
					if(checkboxes > 1)
					{
						document.getElementById('invite_submit_div').style.display="";
					}
					
					
					$('#invitee').empty();
					$( "#invitee" ).load("<?php echo base_url().'selfassessment/show_invited_people/';?>"+order_id);
					//$('#ModalForm').modal('toggle');
					//location.reload("<?php echo base_url().'selfassessment/thirdparty/8#invitee';?>");
					//window.location.href = "<?php echo base_url().'selfassessment/thirdparty/'.$order_id;?>";
					$('#ModalForm').modal('toggle');
					$("#first_name").val("");
					$("#last_name").val("");
					$("#email").val("");
					$("#wwt").val("");
					$("#mentor").val("");
					$("#peer").val("");
					
					//var checkboxes = $('input[type="checkbox"]').length;
					check1=0;
					setTimeout(function() {if(check1==0){ if(data==0){
					//alert("You have already added a name with the same email address");
					}}check1=1;}, 1000);
					
					//window.location.href = "<?php echo base_url().'selfassessment/thirdparty/8#invitee';?>";
					return false;
					
				}
				
			});
		e.preventDefault();	
		});
		
		
		
		
		
	});
	$('#invite_submit').click( function(){
			$('form[name="thirdparty_assessment_form"]').submit();
		});
		<?php
		if(isset($cities1))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var cities = <?php echo $cities;?>;

				// Constructing the suggestion engine
				var cities = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: cities
				});
				
				function citiesWithDefaults(q, sync) {
				  if (q === '') {
					sync(cities.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					cities.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#cities').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'cities',
							limit: 500,
							source: citiesWithDefaults
						});
			});
		<?php
		}
		if(isset($age1))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var age = <?php echo $age;?>;

				// Constructing the suggestion engine
				var age = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: age
				});
				
				function ageWithDefaults(q, sync) {
				  if (q === '') {
					sync(age.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					age.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#age').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'age',
							limit: 500,
							source: ageWithDefaults
						});
			});
		<?php
		}
		?>
		<?php
		if(isset($hletypes1))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var hletypes = <?php echo $hletypes;?>;

				// Constructing the suggestion engine
				var hletypes = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: hletypes
				});
				
				function hleWithDefaults(q, sync) {
				  if (q === '') {
					sync(hle.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					hle.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#hletypes').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'hletypes',
							limit: 500,
							source: hleWithDefaults
						});
			});
		<?php
		}
		if(isset($university))
		{
		?>
			$(document).ready(function(){
			
				
			
				// Defining the local dataset
				
				var university = <?php echo $university;?>;
				

				// Constructing the suggestion engine
				var university = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: university
				});
				
				function universityWithDefaults(q, sync) {
				  if (q === '') {
					sync(university.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					university.search(q, sync);
				  }
				}
				

				// Initializing the typeahead
				$('#university').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'university',
							limit: 500,
							source: universityWithDefaults
						});
						
						
			});
		<?php
		}
		?>

		<?php
		if(isset($study))
		{
		?>
		$(document).ready(function(){
			// Defining the local dataset
			var study = <?php echo $study;?>;

			// Constructing the suggestion engine
			var study = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				local: study
			});
			
			function studyWithDefaults(q, sync) {
				  if (q === '') {
					sync(study.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					study.search(q, sync);
				  }
				}

			// Initializing the typeahead
			$('#study').typeahead({
						hint: false,
						highlight: true, /* Enable substring highlighting */
						minLength: 0 /* Specify minimum characters required for showing suggestions */
					},
					{
						name: 'study',
						limit: 500,
							source: studyWithDefaults
					});
		});
		<?php
		}
		if(isset($designations))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var designations = <?php echo $designations;?>;

				// Constructing the suggestion engine
				var designations = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: designations
				});
				
				function designationsWithDefaults(q, sync) {
				  if (q === '') {
					sync(designations.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					designations.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#designations').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'designations',
							limit: 500,
							source: designationsWithDefaults
						});
			});
		<?php
		}
		if(isset($employers))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var employers = <?php echo $employers;?>;

				// Constructing the suggestion engine
				var employers = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: employers
				});
				
				function employersWithDefaults(q, sync) {
				  if (q === '') {
					sync(employers.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					employers.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#employers').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'employers',
							limit: 500,
							source: employersWithDefaults
						});
			});
		<?php
		}
		if(isset($mrels1))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var mrels = <?php echo $mrels;?>;

				// Constructing the suggestion engine
				var mrels = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: mrels
				});
				
				
				function mrelsWithDefaults(q, sync) {
				  if (q === '') {
					sync(mrels.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					mrels.search(q, sync);
				  }
				}
				

				// Initializing the typeahead
				$('#mrels').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'mrels',
							limit: 500,
							source: mrelsWithDefaults
						});
			});
		<?php
		}
		if(isset($performances1))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var performances = <?php echo $performances;?>;

				// Constructing the suggestion engine
				var performances = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: performances
				});
				
				function performancesWithDefaults(q, sync) {
				  if (q === '') {
					sync(performances.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					performances.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#performances').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'performances',
							limit: 500,
							source: performancesWithDefaults
						});
			});
		<?php
		}
		if(isset($industry))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var industry = <?php echo $industry;?>;

				// Constructing the suggestion engine
				var industry = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: industry
				});
				
				function industryWithDefaults(q, sync) {
				  if (q === '') {
					sync(industry.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					industry.search(q, sync);
				  }
				}

				// Initializing the typeahead
				$('#industry').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'industry',
							limit: 500,
							source: industryWithDefaults
						});
			});
		<?php
		}
		?>


		<?php
		if(isset($industry))
		{
		?>
		$(document).ready(function(){
			// Defining the local dataset
			var industry = <?php echo $industry;?>;

			// Constructing the suggestion engine
			var industry = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.whitespace,
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				local: industry
			});
			
			function industryWithDefaults(q, sync) {
				  if (q === '') {
					sync(industry.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					industry.search(q, sync);
				  }
				}

			// Initializing the typeahead
			$('#industry_employer').typeahead({
						hint: false,
						highlight: true, /* Enable substring highlighting */
						minLength: 0 /* Specify minimum characters required for showing suggestions */
					},
					{
						name: 'industry',
						limit: 500,
							source: industryWithDefaults
					});
		});
		<?php
		}
		if(isset($expertises))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var expertises = <?php echo $expertises;?>;

				// Constructing the suggestion engine
				var expertises = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: expertises
				});

				
				function expertisesWithDefaults(q, sync) {
				  if (q === '') {
					sync(expertises.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					expertises.search(q, sync);
				  }
				}
				// Initializing the typeahead
				$('#expertises').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'expertises',
							limit: 500,
							source: expertisesWithDefaults
						});
			});
		<?php
		}
		if(isset($salarys1))
		{
		?>
			$(document).ready(function(){
				// Defining the local dataset
				var salarys = <?php echo $salarys;?>;

				// Constructing the suggestion engine
				var salarys = new Bloodhound({
					datumTokenizer: Bloodhound.tokenizers.whitespace,
					queryTokenizer: Bloodhound.tokenizers.whitespace,
					local: salarys
				});

				function salarysWithDefaults(q, sync) {
				  if (q === '') {
					sync(salarys.all()); // This is the only change needed to get 'ALL' items as the defaults
				  }

				  else {
					salarys.search(q, sync);
				  }
				}
				// Initializing the typeahead
				$('#salarys').typeahead({
							hint: false,
							highlight: true, /* Enable substring highlighting */
							minLength: 0 /* Specify minimum characters required for showing suggestions */
						},
						{
							name: 'salarys',
							limit: 500,
							source: salarysWithDefaults
						});
			});
		<?php
		}
		?>
</script>
</body>

</html>
