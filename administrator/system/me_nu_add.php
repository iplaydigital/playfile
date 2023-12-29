<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		/*$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];*/
		
		$res = mysql_query("select * from `menu` ");
		while($row=mysql_fetch_array($res)){
			$sum = $row['menu_order']+1;
			mysql_query("update `menu` set menu_order='$sum' where menu_id='".$row['menu_id']."'");
		}
		
		mysql_query("insert into `menu`(menu_title_en, menu_title_th, menu_link, menu_order, menu_status, menu_createdtime, menu_createdip) values('".$_POST['menu_title_en']."', '".$_POST['menu_title_th']."', '".$_POST['menu_link']."', '1', '".$_POST['status']."', '".$today."', '".$_SERVER['REMOTE_ADDR']."')");
		
		
		
		?><script> window.location='index.php?page=me_nu'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>สร้างเมนู  </h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="productcategory" method="post" enctype="multipart/form-data">
							<fieldset><br>
								
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อเมนู (TH)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="menu_title_th" name="menu_title_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อเมนู  (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="menu_title_en" name="menu_title_en" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">link:</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="menu_link" name="menu_link" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending'>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="เพิ่มข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=me_nu';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>