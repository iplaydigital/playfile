<?php
	if($_POST['submit']){
		if($_POST['mission']!=""){
			$res = mysql_query("select * from mission");
			if(mysql_num_rows($res)==0){
				$chk = "1";
				mysql_query("insert into mission(mission_detail) values('".$_POST['mission']."')");
				
			}else{
				$chk = "2";
				mysql_query("update mission set mission_detail='".$_POST['mission']."' where ID='".$_POST['id']."'");
			}
		}else{ $chk = "0";}
	}
?>
	<div id="rightContent">
		<h3>Profile</h3>
		<?php if($chk == "1"){?>
		<div class="informasi">
			Data detatail was saved!!!
		</div>
		<?php }?>
		<?php if($chk == "0"){?>
		<div class="gagal">
			Can not save data!!!
		</div>
		<?php }?>
		<?php if($chk == "2"){?>
		<div class="sukses">
			Data detatail was updated!!!
		</div>
		<?php }?>
		<form method="POST" name="mission">
		<table width="95%">
			<?
			$res = mysql_query("select * from mission");
			if(mysql_num_rows($res)!=0){
				$row = mysql_fetch_array($res);
			}
			?>
			<tr>
				<td valign="top"><b>รายละเอียด :</b></td>
				<td><textarea name="mission" ><?=$row['mission_detail']?></textarea><input type="hidden" value="<?=$row['ID']?>" name="id"></td>
			</tr>
			<tr><td width="125px"></td><td>
				<input type="button" class="button" value="Button">
				<input type="submit" class="button" value="Submit" name="submit">
				<input type="reset" class="button" value="Reset" > 
			</td></tr>
			<tr><td height="500"></td></tr>
		</table>
		</form>
	</div>