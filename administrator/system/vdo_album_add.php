<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		$rrs = mysql_query("select * from vdo_album");
		while($rrw = mysql_fetch_array($rrs)){
			$sorder = $rrw['album_order']+1;
			mysql_query("update vdo_album set album_order='".$sorder."' where album_id='".$rrw['album_id']."'");
		}
		
		mysql_query("insert into vdo_album(album_title, album_short_description, album_status, album_createdtime, album_createdip) values('".$_POST['album_title']."', '".$_POST['album_short_description']."', '".$_POST['status']."', '".$today."', '".$_SERVER['REMOTE_ADDR']."')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/vdo/album/".$fir1.$id.".".$last_name1);
			}
			$p.="album_cover='".$fir1.$id.".".$last_name1."', ";			
		}
		
		mysql_query("update vdo_album set $p album_createdtime='".$today."' where album_id='".$id."'");
		
		?><script> window.location='index.php?page=vdo_album&nid=<?=$_GET['nid']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('file1').value==""){
			alert("กรุณาเพิ่มรุปภาพ...");
			document.getElementById('file1').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>เพิ่มรูปภาพ HERITAGE</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
							<fieldset><br>
								<!--<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่ :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<?
									$res = mysql_query("select * from  gallery_category where category_type='gallery' and category_status='approved'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' ><?=$row['category_title']?></option>
									<? }?>
								  </select>
								</div>
							  </div><div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดโดยย่อ :</label>
							  <div class="controls">
								<textarea class="cleditor" id="album_short_description" name="album_short_description" rows="3"></textarea>
							  </div>
							</div>-->
							<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ :</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file">&nbsp; รองรับไฟล์รูปภาพนามสกุล .jpg, .png, .gif เท่านั้น ภาพต้องมีขนาดไม่เกิน 1 เมกะไบต์ (Mb)
									
								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อรูปภาพ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="album_title" name="album_title" type="text" value="" >
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
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=vdo_album&nid=<?=$_GET['nid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>