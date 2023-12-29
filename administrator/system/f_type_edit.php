<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];

		$pics2 = $_FILES['file2']['tmp_name'];
		$pics_name2 = $_FILES['file2']['name'];
		$pics_size2 = $_FILES['file2']['size'];
		$pics_type2 = $_FILES['file2']['type'];

		$_POST['f_type_order'] = (int)$_POST['f_type_order'];

		$p="";

		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);

			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/f_type/thumb/".$_POST['picture1']);
				}
				copy($pics1, "../public/f_type/thumb/".$fir1.$_GET['cid'].".".$last_name1);
			}
			$p.="f_type_thumb='".$fir1.$_GET['cid'].".".$last_name1."', ";
		}
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);

			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				if($_POST['picture2']!="default.jpg"){
					unlink("../public/f_type/".$_POST['picture2']);
				}
				copy($pics2, "../public/f_type/".$fir2.$_GET['cid'].".".$last_name2);
			}
			$p.="f_type_image='".$fir2.$_GET['cid'].".".$last_name2."', ";
		}

		$f_type_name_en = htmlspecialchars($_POST['f_type_name_en'], ENT_QUOTES);
		$f_type_name_th = htmlspecialchars($_POST['f_type_name_th'], ENT_QUOTES);

		mysql_query("update f_type set $p f_type_name_en='".$f_type_name_en."', f_type_name_th='".$f_type_name_th."', f_type_status='".$_POST['f_type_status']."', f_type_order='".$_POST['f_type_order']."', f_type_updatedtime='".$today."' where f_type_id='".$_GET['idx']."'");


		if($_POST['delete_pics']=="1"){
			if($_POST['picture1']!="default.jpg"){
				unlink("../public/f_type/thumb/".$_POST['picture1']);
			}
			mysql_query("update f_type set f_type_thumb='' where f_type_id='".$_GET['idx']."'");
		}
		if($_POST['delete_pics2']=="1"){
			if($_POST['picture2']!="default.jpg"){
				unlink("../public/f_type/".$_POST['picture2']);
			}
			mysql_query("update f_type set f_type_image='' where f_type_id='".$_GET['idx']."'");
		}

		?><script> window.location='index.php?page=f_type'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('f_type_name_th').value==""){
			alert("กรุณาใส่ชื่อหมวดหมู่ภาษาไทย...");
			document.getElementById('f_type_name_th').focus();
			return false;
		}else if(document.getElementById('f_type_name_en').value==""){
			alert("กรุณาใส่ชื่อหมวดหมู่ภาษาอังกฤษ...");
			document.getElementById('f_type_name_en').focus();
			return false;
		}else{
			return true;

		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขหมวดหมู่ WORK</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="content" method="post" enctype="multipart/form-data">
							<fieldset>
								<?
									$rs = mysql_query("select * from f_type where f_type_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);

									$f_type_name_en = html_entity_decode($rw['f_type_name_en']);
									$f_type_name_th = html_entity_decode($rw['f_type_name_th']);
								?><br><br>

							  <!--///////////////////picture/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['f_type_thumb']){?>
									<img src="../public/f_type/thumb/<?=$rw['f_type_thumb']?>" height="225" width="300">
								<? }?>
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 000px x 000px)
									<input type="hidden" name="picture1" id="picture1" value="<?=$rw['f_type_thumb']?>">

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
							  <!--///////////////////picture2/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['f_type_image']){?>
									<img src="../public/f_type/<?=$rw['f_type_image']?>" height="225" width="300">
								<? }?>
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ (image slide)</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (image size: 000px x 000px)
									<input type="hidden" name="picture2" id="picture2" value="<?=$rw['f_type_image']?>">

								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label">ลบรูปภาพ</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="delete_pics2" name="delete_pics2" value="1"> ลบ
								  </label>
								</div>
							  </div>
							  <!------------------------------------------------->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่อาหาร (TH) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="f_type_name_th" name="f_type_name_th" type="text" value="<?=$f_type_name_th?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่อาหาร (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="f_type_name_en" name="f_type_name_en" type="text" value="<?=$f_type_name_en?>" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="focusedInput">การจัดอันดับ  :</label>
								<div class="controls">
								  <input class="input-small focused" id="f_type_order" name="f_type_order" type="number" value="<?=$rw['f_type_order']?>" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="f_type_status" name="f_type_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['f_type_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Edit data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=f_type';">
							  </div>
							</fieldset>
						  </form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
			<hr>