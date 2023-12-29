<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		
		
		mysql_query("update menu set menu_title_en='".$_POST['menu_title_en']."', menu_title_th='".$_POST['menu_title_th']."', menu_link='".$_POST['menu_link']."', menu_status='".$_POST['status']."', menu_updatedtime='".$today."', menu_updatedip='".$_SERVER['REMOTE_ADDR']."' where menu_id='".$_GET['idx']."'");
		
		?><script> window.location='index.php?page=me_nu '; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('menu_title_th').value==""){
			alert("กรุณากรอกชื่อเมนูภาษาไทย...");
			document.getElementById('menu_title_th').focus();
			return false;
		}else if(document.getElementById('menu_title_en').value==""){
			alert("กรุณากรอกชื่อเมนูภาษาอังกฤษ...");
			document.getElementById('menu_title_en').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขเมนู</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
							<fieldset><br>
								<? 
									$rs = mysql_query("select * from menu where menu_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
								?><br><br>
								
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อเมนู (TH) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="menu_title_th" name="menu_title_th" type="text" value="<?=$rw['menu_title_th']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อเมนู (EN)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="menu_title_en" name="menu_title_en" type="text" value="<?=$rw['menu_title_en']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">link:</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="menu_link" name="menu_link" type="text" value="<?=$rw['menu_link']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['menu_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=me_nu';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>