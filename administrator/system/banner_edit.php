<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		if($_POST['category']!=$_GET['cid']){
			$res = mysql_query("select * from banner where category_id='".$_POST['category']."'");
			while($row=mysql_fetch_array($res)){
				$sum = $row['banner_order']+1;
				mysql_query("update banner set banner_order='$sum' where banner_id='".$row['banner_id']."'");
			}
		}
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/banner/".$_POST['picture1']);
				}
				copy($pics1, "../public/banner/".$fir1.$_GET['idx'].".".$last_name1);
			}
			$p.="banner_value='".$fir1.$_GET['idx'].".".$last_name1."', ";			
		}
		
		mysql_query("update banner set $p category_id='".$_POST['category']."', banner_url='".$_POST['banner_url']."', banner_caption='".$_POST['banner_caption']."', banner_status='".$_POST['status']."', banner_updatedtime='".$today."', banner_updatedip='".$_SERVER['REMOTE_ADDR']."', banner_order='1' where banner_id='".$_GET['idx']."'");
		
		if($_POST['delete_pics']=="1"){
			if($_POST['picture1']!="default.jpg"){
				unlink("../public/banner/".$_POST['picture1']);
			}
			mysql_query("update banner set banner_value='' where banner_id='".$_GET['idx']."'");
		}
		/*if($_POST['category']!=$_GET['cid']){
		
			mysql_query("update banner set $p banner_url='".$_POST['banner_url']."', banner_caption='".$_POST['banner_caption']."', banner_status='".$_POST['status']."', banner_updatedtime='".$today."', banner_updatedip='".$_SERVER['REMOTE_ADDR']."', banner_order='1' where banner_id='".$_GET['idx']."'");
			
			$res = mysql_query("select * from banner where category_id='".$_GET['cid']."'");
			$i=0;
			while($row=mysql_fetch_array($res)){
				$i++;
				mysql_query("update banner set banner_order='$i' where banner_id='".$row['banner_id']."'");
			}
		}else{
			mysql_query("update banner set $p banner_url='".$_POST['banner_url']."', banner_caption='".$_POST['banner_caption']."', banner_status='".$_POST['status']."', banner_updatedtime='".$today."', banner_updatedip='".$_SERVER['REMOTE_ADDR']."' where banner_id='".$_GET['idx']."'");
		}*/
		?><script> window.location='index.php?page=banner&cid=<?=$_POST['category']?>'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขแบนเนอร์ใหม่</h2>
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
									$rs = mysql_query("select * from banner where banner_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
								?><br><br>
								<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่แบนเนอร์ :</label>
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
							  </div>
							  <!--///////////////////picture/////////////////////////-->
							  <? if($rw['banner_value']!=""){?>
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<img src="../public/banner/<?=$rw['banner_value']?>" height="425" width="600">
							  </div>
							</div>
							  <? }?>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"><input type="hidden" name="picture1" id="picture1" value="<?=$rw['banner_value']?>"> (size: 1140 x 473 px)
									
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
								<label class="control-label" for="focusedInput">คำอธิบายใต้ภาพ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="banner_caption" name="banner_caption" type="text" value="<?=$rw['banner_caption']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ลิงค์ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="banner_url" name="banner_url" type="text" value="<?=$rw['banner_url']?>" > ( Ex => http://www.nguansoon.com )
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['banner_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=banner&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>