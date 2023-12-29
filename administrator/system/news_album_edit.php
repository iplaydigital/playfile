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
					unlink("../public/news/album/".$_POST['picture1']);
				}
				copy($pics1, "../public/news/album/".$fir1.$_GET['idx'].".".$last_name1);
			}
			$p.="album_cover='".$fir1.$_GET['idx'].".".$last_name1."', ";			
		}
		
		mysql_query("update news_album set $p category_id='".$_GET['nid']."', album_title='".$_POST['album_title']."', album_short_description='".$_POST['album_short_description']."', album_status='".$_POST['status']."', album_updatedtime='".$today."', album_updatedip='".$_SERVER['REMOTE_ADDR']."' where album_id='".$_GET['idx']."'");
		//print "update album set $p category_id='".$_POST['category_id']."', album_title='".$_POST['album_title']."', album_short_description='".$_POST['album_short_description']."', album_status='".$_POST['status']."', album_updatedtime='".$today."', album_updatedip='".$_SERVER['REMOTE_ADDR']."' where album_id='".$_GET['idx']."'";
		
		?><script> window.location='index.php?page=news_album&nid=<?=$_GET['nid']?>'; </script><?
	}
?>
<script language=Javascript>
	/*function check_data(){
		if(document.getElementById('album_title').value==""){
			alert("กรุณากรอกชื่ออัลบั้ม...");
			document.getElementById('album_title').focus();
			return false;
		}else if(document.getElementById('album_short_description').value==""){
			alert("กรุณากรอกรายละเอียดอัลบั้ม...");
			document.getElementById('album_short_description').focus();
			return false;
		}else{
			return true;
			
		}
	}*/
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขรูปภาพ HALL OF FRAME</h2>
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
									$rs = mysql_query("select * from news_album where album_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
								?><br><br>
								<!--
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่ออัลบั้ม :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="album_title" name="album_title" type="text" value="<?=$rw['album_title']?>" >
								</div>
							  </div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดโดยย่อ :</label>
							  <div class="controls">
								<textarea class="cleditor" id="album_short_description" name="album_short_description" rows="3"><?=$rw['album_short_description']?></textarea>
							  </div>
							</div>-->
							  <!--///////////////////picture/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<img src="../public/news/album/<?=$rw['album_cover']?>" height="300" width="300"><input type="hidden" name="picture2" id="picture2" value="<?=$rw['album_cover']?>">
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">File input1</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"><input type="hidden" name="picture1" id="picture1" value="<?=$rw['album_cover']?>">
									
								  </div>
							  </div>
							  <!------------------------------------------------->
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['album_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=news_album&cid=<?=$_GET['cid']?>&fid=<?=$_GET['fid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>