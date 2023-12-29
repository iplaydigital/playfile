<?
	include("../include/checkuser.php");
	
	
	$where="";
	if($_GET['cid']){
		$where .= "and category_subid!='0'";
		$link = "&cid=".$_GET['cid'];
	}else{
		$where .= "and category_subid='0'";
	}
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
					unlink("../public/content/thumb/".$_POST['picture1']);
				}
				copy($pics1, "../public/content/thumb/".$fir1.$_GET['idx'].".".$last_name1);
			}
			$p.="category_image='".$fir1.$_GET['idx'].".".$last_name1."', ";			
		}
		
		mysql_query("update content_category set $p category_subid='".$_POST['category_subid']."', category_title_en='".$_POST['category_title_en']."', category_title_th='".$_POST['category_title_th']."', category_status='".$_POST['category_status']."', category_updatedtime='".$today."', category_updatedip='".$_SERVER['REMOTE_ADDR']."' where category_id='".$_GET['idx']."'");
		
		if($_POST['delete_pics']=="1"){
			if($_POST['picture1']!="default.jpg"){
				unlink("../public/content/thumb/".$_POST['picture1']);
			}
			mysql_query("update content_category set category_image='' where category_id='".$_GET['idx']."'");
		}
		?><script> window.location='index.php?page=category<?=$link?>'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขหมวดหมู่บทความ</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
							<fieldset>
								<? 
									$rs = mysql_query("select * from content_category where category_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
								?><br><br>
								<div class="control-group">
								<label class="control-label" for="selectError3">หมวหมู่หลัก :</label>
								<div class="controls">
								  <select id="category_subid" name="category_subid">
									<option value='0' >หมวดหมู่หลัก</option>
									<?
									$res = mysql_query("select * from content_category where category_status!='discard' and category_subid='0'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($rw['category_subid']==$row['category_id']){ print "selected='selected'";}?>><?=$row['category_title_en']?>/<?=$row['category_title_th']?></option>
									<? }?>
								  </select>
								</div>
							  </div>
							  <!--///////////////////picture/////////////////////////-->
							  <? if($rw['category_image']){?>
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<img src="../public/content/thumb/<?=$rw['category_image']?>" height="225" width="300"><input type="hidden" name="picture2" id="picture2" value="<?=$rw['category_image']?>">
							  </div>
							</div>
							<? }?>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"><input type="hidden" name="picture1" id="picture1" value="<?=$rw['category_image']?>">
									
								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label">ลบรูปภาพ</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="delete_pics" name="delete_pics" value="1"> ลบ
								  </label>
								</div>
							  </div>
							  <!------------------------------------------------->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่ (ไทย) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_th" name="category_title_th" type="text" value="<?=$rw['category_title_th']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่ (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="category_title_en" name="category_title_en" type="text" value="<?=$rw['category_title_en']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="category_status" name="category_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['category_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Edit data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=category<?=$link?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>