<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		if($_POST['opassword']!="" and $_POST['password']!="" and $_POST['cpassword']!=""){
			$res = mysql_query("select * from `administrator` where admin_id='".$_SESSION['UserId']."' and admin_password='".md5($_POST['opassword'])."' and permission='".$_SESSION['permission']."'");
			
			if(mysql_num_rows($res)==0){
				$chk = 0;
			}else{
				$chk = 2;
				mysql_query("update `administrator` set admin_password='".md5($_POST['password'])."' where admin_id='".$_SESSION['UserId']."'");
			}
		}
		?><script> alert("เปลี่ยนรหัสผ่านแล้วครับ");</script> <?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('opassword').value==""){
			alert("กรุณาใส่รหัสผ่านเก่า...");
			document.getElementById('opassword').focus();
			return false;
		}else if(document.getElementById('password').value==""){
			alert("กรุณาใส่รหัสผ่านใหม่...");
			document.getElementById('password').focus();
			return false;
		}else if(document.getElementById('cpassword').value==""){
			alert("กรุณายืนยันรหัสผ่านใหม่...");
			document.getElementById('cpassword').focus();
			return false;
		}else if(document.getElementById('cpassword').value!=document.getElementById('password').value){
			alert("รหัสผ่านไม่ตรงกัน กรุณาใส่รหัสผ่านใหม่...");
			document.getElementById('password').value="";
			document.getElementById('cpassword').value="";
			document.getElementById('password').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Change Password<?=$chk?></h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="password" method="post">
							<fieldset>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Old Password:</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="opassword" name="opassword" type="password" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">New Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="password" name="password" type="password" value="">
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">Confirm Password</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="cpassword" name="cpassword"type="password" value="">
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Submit">
								<button class="btn">Cancel</button>
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>