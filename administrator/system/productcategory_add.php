<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		$res = mysql_query("select * from product_category ");
		while($row=mysql_fetch_array($res)){
			$sum = $row['category_order']+1;
			mysql_query("update product_category set category_order='$sum' where category_id='".$row['category_id']."'");
		}
		
		mysql_query("insert into product_category(category_subid, category_title_en, category_title_th, category_order, category_status, category_createdip) values('".$_POST['category_id']."', '".$_POST['category_title_en']."', '".$_POST['category_title_th']."', '1', '".$_POST['status']."', '".$_SERVER['REMOTE_ADDR']."')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/category/".$fir1.$id.".".$last_name1);
			}
			$p.="category_icon='".$fir1.$id.".".$last_name1."', ";			
		}
		
		mysql_query("update product_category set $p category_createdtime='".$today."' where category_id='".$id."'");
		
		?><script> window.location='index.php?page=productcategory'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>สร้างหมวดหมู่สินค้า</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="productcategory" method="post" enctype="multipart/form-data">
							<fieldset><br>
								<!--<div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<?
									$res = mysql_query("select * from banner_category");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='approved' <? if($row['category_id']==$_GET['cid']){ print "selected='selected'";}?>><?=$row['category_title_th']?>/<?=$row['category_title_en']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file">
									&nbsp; size:(400 x 400 pixel)
								  </div>
							  </div>
							  <!--<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่หลัก :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<option value='0' >[-SELECT CATEGORY-]</option>
									<?
									$res = mysql_query("select * from product_category");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' ><?=$row['category_title_th']?>/<?=$row['category_title_en']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่ (TH)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_th" name="category_title_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่  (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_en" name="category_title_en" type="text" value="" >
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
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=productcategory';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>