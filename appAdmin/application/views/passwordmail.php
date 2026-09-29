<?php
$timestamp=mktime(date('H'), date('i'),date('s'), date('m'), date('d'), date('Y'));

$message='<style type="text/css">
@import url(\'https://fonts.googleapis.com/css2?family=Libre+Baskerville:wght@700&display=swap\');
@import url(\'https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap\');
body{ margin:0; padding:0; font-family: \'Karla\', sans-serif; color:283250; font-size:17px;}
</style>
<table width="650" border="0" cellspacing="0" align="center">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
<td style="text-align:center; border-bottom:3px solid #0A8CAD;"><img src="https://app.orginsights.io/asset/images/emaillogo.png" alt=""></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding:20px;">
    <h3 style="color:#042F39; font-size:32px; margin:0 0 6px; padding:0; font-family: \'Libre Baskerville\', serif; text-align:center; font-weight:700;">Password Reset</h3>
    <p style="color:#0A8CAD; text-transform:uppercase; font-size:12px; margin:0; text-align:center;">';
	
	$message.=date("l, F d, Y",$timestamp);$message.=' at ';$message.=date("h:i A",$timestamp);$message.='</p>
    </td>
  </tr>
  <tr>
    <td style="padding:6px;">&nbsp;</td>
  </tr>
  <tr>
    <td style="padding:6px;">Hi '.$TONAME1.',<br><br>
	Your password has been reset to '.$password.'<br><br>
	Please login with the above password.<br><br>
	Login: https://app.orginsights.io/login<br><br>
	Email Address: '.$TOEMAIL1.'<br><br>
	Password: '.$password.'<br><br>
	Thank You,<br><br>
	OrgInsights<br><br>
	</td>
  </tr>
  <tr>
    <td style="padding:6px;">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" style="padding:15px;background:#404449; text-align:center; font-size:12px; color:rgba(255,255,255,0.5)">Copyright &copy; '.date("Y").' Orginsights. All Rights Reserved.</td>
  </tr>
  ';
   
$message.='</table>'; 
	
  $message.='  </td> </tr>
  
   
</table>
</td>
</tr>
<tr>
    <td style="padding:6px;">&nbsp;</td>
  </tr>
  
</table>';