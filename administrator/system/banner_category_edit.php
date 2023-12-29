<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		mysql_query("update banner_category set category_title_th='".$_POST['category_title_th']."', category_title_en='".$_POST['category_title_en']."', category_status='".$_POST['status']."', category_updatedtime='".$today."', category_updatedip='".$_SERVER['REMOTE_ADDR']."', category_updatedid='".$_SESSION['UserId']."' where category_id='".$_GET['idx']."'");
		
		
		?><script> window.location='index.php?page=banner_category'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('category_title_th').value==""){
			alert("กรุณากรอกชื่อหมวดหมูภาษาไทย...");
			document.getElementById('category_title_th').focus();
			return false;
		}else if(document.getElementById('category_title_en').value==""){
			alert("กรุณากรอกชื่อหมวดหมู่ภาษาอังกฤษ...");
			document.getElementById('category_title_en').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขหมวดหมู่แบนเนอร์</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
					<?
						$res = mysql_query("select * from banner_category where category_id='".$_GET['idx']."'");
						$row = mysql_fetch_array($res);
					?>
						<form class="form-horizontal" name="category" method="post">
							<fieldset><br>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่ (ไทย)​ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_th" name="category_title_th" type="text" value="<?=$row['category_title_th']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่ (en)​ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_en" name="category_title_en" type="text" value="<?=$row['category_title_en']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved' <? if($row['category_status']=="approved"){ print "selected='selected'";}?>>เปิดการแสดงผล</option>
									<option value='pending' <? if($row['category_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=banner_category';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>