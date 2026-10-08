
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; 
            flex-direction: column; 
            gap: 20px; 
        }

        .pricing-table {
            display: flex;
            justify-content: space-between;
            width: 80%;
            max-width: 1200px; 
        }

        .pricing-option {
            background-color: white;
            border: 1px solid #ddd;
            padding: 30px; 
            width: calc(33.33% - 20px); 
            text-align: center;
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); 
            transition: transform 0.2s; 
        }

        .pricing-option:hover {
            transform: translateY(-5px); 
        }

        .pricing-option h2 {
            color: #189045; 
            font-size: 1.8rem; 
            margin-bottom: 20px;
        }

        .pricing-option h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            color: #189045; 
        }

        .pricing-option p {
            font-weight: bold;
            margin-bottom: 20px; 
            color: #189045; 
        }

        .pricing-option ul {
            list-style: none;
            line-height: 1.8; 
            text-align: left;
            padding: 0 20px; 
        }

        .pricing-option ul li {
            margin-bottom: 10px;
            border-bottom: 1px solid #eee; 
            padding-bottom: 10px; 
        }

        .highlight {
            background-color: #007bff; 
            color: #189045;
        }

        .highlight h2, .highlight h1, .highlight p, .highlight ul li {
            color: #189045;
        }

        .highlight ul li {
            border-bottom-color: rgba(255, 255, 255, 0.3); 
			
        }
		li{color: #189045;}
		
.pricing-table button
{
	background:#189045;
	padding:0;
	color:#fff;
	text-transform: uppercase;
	font-weight: 300;
	font-size: 15.76px;
	border:0;
	line-height: 42px;
	width: 150px;
	height: 42px;
	cursor:pointer;
}
.pricing-table button
{
	background:#ffffff;
	padding:0;
	color:#126aaf;
	text-transform: uppercase;
	font-weight: 300;
	font-size: 15.76px;
	border:0;
	line-height: 42px;
	width: 150px;
	height: 42px;
	cursor:pointer;
}
.pricing-table button:focus
{
	outline: 0;
	box-shadow: 0 0 0;
}		
	
.pricing-option {
	background:#19877d;
	color:#ffffff;
	margin:10px;
	background: #157597 !important;background: linear-gradient(172deg,rgba(21, 117, 151, 1) 25%, rgba(19, 155, 90, 1) 50%, rgba(50, 157, 22, 1) 100%) !important;
}	
.highlight h2, .highlight h1, .highlight p, .highlight ul li {
    color: white;
}	
.pricing-table {
    
    justify-content: center;		
	}
    </style>
<div class="page-banner">
        <div class="container clearfix">
            <a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>	
   <div class="pricing-table">
        <div class="pricing-option highlight">
            <h2>CAREER HACKING +</h2>
            <h1>99</h1>
            <p>WHAT YOU GET:</p>
			<p>
			ONE SESSION NOT ENOUGH? BOOK EVEN MORE TIME WITH OUR CAREER COACHES TO GET THEIR HELP IN YOUR AREA OF NEED WHICH INCLUDES:
			</p>
            <ul>
               <li>Job Search Strategies </li><li>Resume Help </li><li>Interview Support </li><li>Career Coaching </li><li>Career Path Development Support </li><li>Career Transition Support </li><li>Career Performance Advice </li><li>Mental Health & Wellness </li><li>And more... </li>
            </ul>
			<p style="line-height:68px;">&nbsp;</p>
			<?php /*<form id="checkout2" action="https://calendly.com/orgpath/additional_session" method="Post" target="_blank">*/?>
			<form id="checkout2" action="<?php echo base_url()?>checkout" method="Post">
			<input type='hidden' name='amount' value='99'>
			<input type="hidden" name="package_id" id="package_id" value="7" />
			<input type='hidden' name='ActualTicks' value='<?php echo (int)$_POST['ActualTicks'];?>'>
			<button id="orgin" data-dismiss="modal">pay now</button>
			</form>
        </div>
        
    </div>	