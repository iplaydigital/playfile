<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		$p="";
		
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/category/".$_POST['picture1']);
				}
				copy($pics1, "../public/category/".$fir1.$_GET['idx'].".".$last_name1);
			}
			$p.="category_icon='".$fir1.$_GET['idx'].".".$last_name1."', ";			
		}
		
		mysql_query("update product_category set $p category_subid='".$_POST['category_id']."', category_title_en='".$_POST['category_title_en']."', category_title_th='".$_POST['category_title_th']."', category_status='".$_POST['status']."', category_updatedtime='".$today."', category_updatedip='".$_SERVER['REMOTE_ADDR']."' where category_id='".$_GET['idx']."'");
		
		?><script> window.location='index.php?page=productcategory '; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขหมวดหมู่สินค้า</h2>
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
									$rs = mysql_query("select * from product_category where category_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
								?><br><br>
								<!--<div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="category" name="category">
									<?
									$res = mysql_query("select * from banner_category");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($row['category_id']==$rw['category_id']){ print "selected='selected'";}?>><?=$row['category_title_th']?>/<?=$row['category_title_en']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  <!--///////////////////picture/////////////////////////-->
							  <? if($rw['category_icon']!=NULL){?>
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<img src="../public/category/<?=$rw['category_icon']?>" height="200px" width="200ox"><input type="hidden" name="picture2" id="picture2" value="<?=$rw['category_icon']?>">
							  </div>
							</div>
							<?}?>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"><input type="hidden" name="picture1" id="picture1" value="<?=$rw['category_icon']?>"> &nbsp; file size:(400 x 400 pixel)
									
								  </div>
							  </div>
							  <!------------------------------------------------->
							  <!--<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่หลัก :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<option value='0' >[-SELECT CATEGORY-]</option>
									<?
									$res = mysql_query("select * from product_category");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($row['category_id']==$rw['category_subid']){ print "selected='selected'";}?>><?=$row['category_title_th']?>/<?=$row['category_title_en']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่ (TH)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_th" name="category_title_th" type="text" value="<?=$rw['category_title_th']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่  (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_en" name="category_title_en" type="text" value="<?=$rw['category_title_en']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['category_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=productcategory';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>