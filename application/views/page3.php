
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
            color: #007bff; 
            font-size: 1.8rem; 
            margin-bottom: 20px;
        }

        .pricing-option h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            color: #333; 
        }

        .pricing-option p {
            font-weight: bold;
            margin-bottom: 20px; 
            color: #555; 
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
            color: white;
        }

        .highlight h2, .highlight h1, .highlight p, .highlight ul li {
            color: white;
        }

        .highlight ul li {
            border-bottom-color: rgba(255, 255, 255, 0.3); 
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

.pricing-table {
    display: flex;
    justify-content: center;
    width: 80%;
    max-width: 1200px;
}
		
    </style>

<div class="page-banner">
        <div class="container clearfix">
            <a href='<?php echo base_url();?>' class="save-btn">Back to Dashboard</a>
        </div>
    </div>	
<div class="calendly-inline-widget" id="Calendlydiv" style="display:none;min-width:100%;height:680px;max-height:auto;" data-auto-load="false"></div>

<script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>

<script>
function opencalendly()
{
Calendly.initInlineWidget({
  "url": 'https://calendly.com/orgpath/additional_session',
  "parentElement": document.getElementById('Calendlydiv'),
  "prefill": {},
  "utm": {}
});

document.getElementById("Calendlydiv").style.display="block";
}
opencalendly();
</script>	