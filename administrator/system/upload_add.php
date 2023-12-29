<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		
		mysql_query("insert into upload(upload_status, upload_createdtime, upload_createdip) values('".$_POST['status']."', '".$today."', '".$_SERVER['REMOTE_ADDR']."')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/upload/picture/".$fir1.$id.".".$last_name1);
			}
			$p.="upload_value='".$fir1.$id.".".$last_name1."', ";			
		}
		
		mysql_query("update upload set $p upload_url='http://www.thaitheparos.com/srirajapanich/public/upload/picture/".$fir1.$id.".".$last_name1."', upload_createdtime='".$today."' where upload_id='".$id."'");
		
		?><script> window.location='index.php?page=upload'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>เพิ่มรูปภาพใหม่</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
							<fieldset><br>
							  
							<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (size: xxxx x xxxx px)
									
								  </div>
							  </div>
							  
							  <!--<div class="control-group">
								<label class="control-label" for="focusedInput">ลิงค์ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="banner_url" name="banner_url" type="text" value="" > ( Ex => index.php?page=tint )
								</div>
							  </div>-->
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
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=upload&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>