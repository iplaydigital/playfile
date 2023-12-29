<?
	if($_POST['login']){
		$res = mysql_query("select * from `administrator` where admin_username='".$_POST['username']."' and admin_password='".md5($_POST['password'])."' and permission='777'");
		if(mysql_num_rows($res)==0){
			$chk = "999";
			
		}else{
			
			$row = mysql_fetch_array($res);
			$_SESSION['UserId'] = $row['admin_id'];
			$_SESSION['admin_username'] = $row['admin_username'];
			$_SESSION['permission'] = $row['permission'];
			
			?>
			<script>
				window.location = "index.php?page=home";
			</script>
			<?
		}
	}
?>
<!--/login form-->
		
		<div class="row-fluid">
					
			<div class="row-fluid">
				<div class="login-box">
					<!--<div class="icons">
						<a href="index.html"><i class="icon-home"></i></a>
						<a href="#"><i class="icon-cog"></i></a>
					</div>-->
					
					<h2>Login to your account </h2>
					<?	if($chk==999){	print "<h2><font color='#FF0000'>*** This password is incorrect... ***</font></h2>";	}	?>
					<form class="form-horizontal" method="post">
						<fieldset>
							
							<div class="input-prepend" title="Username">
								<span class="add-on"><i class="icon-user"></i></span>
								<input class="input-large span10" name="username" id="username" type="text" placeholder="type username"/>
							</div>
							<div class="clearfix"></div>

							<div class="input-prepend" title="Password">
								<span class="add-on"><i class="icon-lock"></i></span>
								<input class="input-large span10" name="password" id="password" type="password" placeholder="type password"/>
							</div>
							<div class="clearfix"></div>
							
							<label class="remember" for="remember"><input type="checkbox" id="remember" />Remember me</label>

							<div class="button-login">	
								<input type="submit" class="btn btn-primary" name="login" value="Login">
							</div>
							<div class="clearfix"></div>
					</form>
					<!--<hr>
					<h3>Forgot Password?</h3>
					<p>
						No problem, <a href="#">click here</a> to get a new password.
					</p>	-->
				</div><!--/span-->
			</div><!--/row-->
		</div><!--/fluid-row-->
		
		<!--/End login form-->