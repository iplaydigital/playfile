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

		$f_type_name_en = htmlspecialchars($_POST['f_type_name_en'], ENT_QUOTES);
		$f_type_name_th = htmlspecialchars($_POST['f_type_name_th'], ENT_QUOTES);

		$_POST['f_type_order'] = (int)$_POST['f_type_order'];

/*
		$res = mysql_query("select * from f_type ");
		while($row = mysql_fetch_array($res)){
			$order = $row['f_type_order']+1;
			mysql_query("update f_type set f_type_order='".$order."' where f_type_id='".$row['f_type_order']."'");
		}
*/
		mysql_query("insert into f_type(f_type_name_en, f_type_name_th, f_type_status, f_type_order) values('".$f_type_name_en."', '".$f_type_name_th."', '".$_POST['f_type_status']."', '".$_POST['f_type_order']."')");

		$id = mysql_insert_id();
		$p="";

		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);

			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/f_type/thumb/".$fir1.$id.".".$last_name1);
			}
			$p.="f_type_thumb='".$fir1.$id.".".$last_name1."', ";
		}
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);

			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				copy($pics2, "../public/f_type/".$fir2.$id.".".$last_name2);
			}
			$p.="f_type_image='".$fir2.$id.".".$last_name2."', ";
		}

		mysql_query("update f_type set $p f_type_createdtime='".$today."' where f_type_id='".$id."'");

		?><script> window.location='index.php?page=f_type&cid=<?=$_GET['cid']?>'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>สร้างหมวดหมู่ WORK</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="content" method="post" enctype="multipart/form-data">
							<fieldset>
							<br>


								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ (thumb)</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 000px x 000px)

								  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ (image slide)</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (image size: 000px x 000px)

								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่อาหาร (TH)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="f_type_name_th" name="f_type_name_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อหมวดหมู่อาหาร (EN)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="f_type_name_en" name="f_type_name_en" type="text" value="" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="focusedInput">การจัดอันดับ  :</label>
								<div class="controls">
								  <input class="input-small focused" id="f_type_order" name="f_type_order" type="number" value="" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="f_type_status" name="f_type_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending'>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Add data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=f_type';">
							  </div>
							</fieldset>
						  </form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
			<hr>