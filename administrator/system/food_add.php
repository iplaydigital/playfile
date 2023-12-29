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

		$content_title_en = htmlspecialchars($_POST['content_title_en'], ENT_QUOTES);
		//$content_title_th = htmlspecialchars($_POST['content_title_th'], ENT_QUOTES);
		$content_sdesc_en = htmlspecialchars($_POST['content_sdesc_en'], ENT_QUOTES);
		//$content_sdesc_th = htmlspecialchars($_POST['content_sdesc_th'], ENT_QUOTES);
		$content_desc_en = htmlspecialchars($_POST['content_desc_en'], ENT_QUOTES);
		//$content_desc_th = htmlspecialchars($_POST['content_desc_th'], ENT_QUOTES);

		$_POST['content_order'] = (int)$_POST['content_order'];

/*
		$res = mysql_query("select * from food where f_type_id='".$_POST['f_type_id']."'");
		while($row = mysql_fetch_array($res)){
			$order = $row['content_order']+1;
			mysql_query("update food set content_order='".$order."' where content_id='".$row['content_order']."'");
		}
*/

		//mysql_query("insert into food(f_type_id, content_vdo_en, content_vdo_th, content_s, content_title_en, content_title_th, content_sdesc_en, content_sdesc_th, content_desc_en, content_desc_th, content_status, content_createdip) values('".$_POST['f_type_id']."', '".$_POST['content_vdo_en']."', '".$_POST['content_vdo_th']."', '".$_POST['content_s']."', '".$content_title_en."', '".$content_title_th."', '".$content_sdesc_en."', '".$content_sdesc_th."', '".$content_desc_en."', '".$content_desc_th."', '".$_POST['content_status']."', '".$_SERVER['REMOTE_ADDR']."')");
		mysql_query("insert into food(content_url, f_type_id, content_vdo_en, content_title_en, content_sdesc_en, content_desc_en, content_status, content_order, content_createdip) values('".$_POST['content_url']."', '".$_POST['f_type_id']."', '".$_POST['content_vdo_en']."', '".$content_title_en."', '".$content_sdesc_en."', '".$content_desc_en."', '".$_POST['content_status']."', '".$_POST['content_order']."', '".$_SERVER['REMOTE_ADDR']."')");

		$id = mysql_insert_id();
		$p="";

		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);

			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/food/thumb/".$fir1.$id.".".$last_name1);
			}
			$p.="content_thumbnail='".$fir1.$id.".".$last_name1."', ";
		}

		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);

			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				copy($pics2, "../public/food/".$fir2.$id.".".$last_name2);
			}
			$p.="content_image='".$fir2.$id.".".$last_name2."', ";
		}

		mysql_query("update food set $p content_createdtime='".$today."' where content_id='".$id."'");

		?><script> window.location='index.php?page=food&cid=<?=$_POST['f_type_id']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('content_title_en').value==""){
			alert("กรุณาใส่ชื่อหัวข้อ...");
			document.getElementById('content_title_en').focus();
			return false;
		}else{
			return true;

		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>สร้างหมวดหมู่ใหม่</h2>
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
								<label class="control-label" for="selectError3">หมวดหมู่ :</label>
								<div class="controls">
								  <select id="f_type_id" name="f_type_id">
									<option value='' >เลือกประเภท</option>
									<?
									$res = mysql_query("select * from f_type where f_type_status='approved'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['f_type_id']?>'<? if($_GET['cid']==$row['f_type_id']){ print "selected";}?> ><?=$row['f_type_name_th']?></option>
									<? }?>
								  </select>
								</div>
							  </div>


							  <div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (image size: 000px x 000px)

								  </div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="focusedInput"> vdo :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_vdo_en" name="content_vdo_en" type="text" value="" > (Ex => 0X5RhuzKnhY)
								</div>
							  </div>


							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อ  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_en" name="content_title_en" type="text" value="" >
								</div>
							  </div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ  :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_en" name="content_sdesc_en" rows="3"></textarea>
							  </div>
							</div>

							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_desc_en" name="content_desc_en" rows="3"></textarea>
								<!--<textarea cols="20" id="content_desc_en" name="content_desc_en" rows="5"></textarea>
								<script type="text/javascript">
								CKEDITOR.replace( 'content_desc_en', {
										filebrowserBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor',
										filebrowserImageBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor&filter=image',
										filebrowserFlashBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor&filter=flash',
									}
								);
								</script>-->
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Link  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_url" name="content_url" type="text" value="" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="focusedInput">การจัดอันดับ  :</label>
								<div class="controls">
								  <input class="input-small focused" id="content_order" name="content_order" type="number" value="" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="content_status" name="content_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending'>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Add data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=food&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
			<hr>