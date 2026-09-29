<?php
$whereq="";
						
						$Message=$_POST['Message'];
						$Section=$_POST['Section'];
						$user_id=(int)$this->session->userdata('user_id');
						
						$Message=str_replace("'","\'",$Message);
						$TemplateName=$_POST['TemplateName'];
						
						//$sql = "delete from Mail_messages where user_id=".$user_id;
						//$con->query($sql);
						
						$MsgType=0;
						
						if((int)$ID > 0)
						{
							$whereq=" WHERE ID=".(int)$ID." and user_id=".(int)$user_id;
							
							$sql = "Update Mail_messages set TemplateName='".$TemplateName."',Message='".$Message."',Section='".$Section."' ".$whereq;
							
							$ThanksText="Record Updated";
						}
						else
						{
						
							if((int)$_POST['ID']==0)
							{	
								$MsgType=1;
							}
							
						
							$sql = "Insert Into Mail_messages (TemplateName,Message,Section,user_id,MsgType) VALUES('".$TemplateName."','".$Message."','".$Section."','".$user_id."','".$MsgType."')";
							
							$ThanksText="Record Added";
						}	
						//echo $sql;	
							
						$resultT = $this->db->query($sql);
?>						