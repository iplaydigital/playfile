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

		$_POST['content_order'] = (int)$_POST['content_order'];

		$p="";

		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);

			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/food/thumb/".$_POST['picture1']);
				}
				copy($pics1, "../public/food/thumb/".$fir1.$_GET['cid'].".".$last_name1);
			}
			$p.="content_thumbnail='".$fir1.$_GET['cid'].".".$last_name1."', ";
		}
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);

			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				if($_POST['picture2']!="default.jpg"){
					unlink("../public/food/".$_POST['picture2']);
				}
				copy($pics2, "../public/food/".$fir2.$_GET['cid'].".".$last_name2);
			}
			$p.="content_image='".$fir2.$_GET['cid'].".".$last_name2."', ";
		}

		$content_title_en = htmlspecialchars($_POST['content_title_en'], ENT_QUOTES);
		//$content_title_th = htmlspecialchars($_POST['content_title_th'], ENT_QUOTES);
		$content_sdesc_en = htmlspecialchars($_POST['content_sdesc_en'], ENT_QUOTES);
		//$content_sdesc_th = htmlspecialchars($_POST['content_sdesc_th'], ENT_QUOTES);
		$content_desc_en = htmlspecialchars($_POST['content_desc_en'], ENT_QUOTES);
		//$content_desc_th = htmlspecialchars($_POST['content_desc_th'], ENT_QUOTES);
		if($_POST['f_type_id']==$_GET['cid2']){
			mysql_query("update food set $p content_url='".$_POST['content_url']."', f_type_id='".$_POST['f_type_id']."', content_vdo_en='".$_POST['content_vdo_en']."', content_title_en='".$content_title_en."', content_sdesc_en='".$content_sdesc_en."', content_desc_en='".$content_desc_en."', content_status='".$_POST['content_status']."', content_order='".$_POST['content_order']."', content_updatedtime='".$today."', content_updatedip='".$_SERVER['REMOTE_ADDR']."' where content_id='".$_GET['cid']."'");
		}else{
/*
			$res = mysql_query("select * from food where f_type_id='".$_POST['f_type_id']."'");
			while($row = mysql_fetch_array($res)){
				$order = $row['content_order']+1;
				mysql_query("update food set content_order='".$order."' where content_id='".$row['content_order']."'");

			}
*/

			mysql_query("update food set $p content_url='".$_POST['content_url']."', content_order='1', f_type_id='".$_POST['f_type_id']."', content_vdo_en='".$_POST['content_vdo_en']."', content_title_en='".$content_title_en."', content_sdesc_en='".$content_sdesc_en."', content_desc_en='".$content_desc_en."', content_status='".$_POST['content_status']."', content_order='".$_POST['content_order']."', content_updatedtime='".$today."', content_updatedip='".$_SERVER['REMOTE_ADDR']."' where content_id='".$_GET['cid']."'");
		}



		if($_POST['delete_pics']=="1"){
			if($_POST['picture1']!="default.jpg"){
				unlink("../public/food/thumb/".$_POST['picture1']);
			}
			mysql_query("update food set content_thumbnail='' where content_id='".$_GET['cid']."'");
		}
		if($_POST['delete_pics2']=="1"){
			if($_POST['picture2']!="default.jpg"){
				unlink("../public/food/".$_POST['picture2']);
			}
			mysql_query("update food set content_image='' where content_id='".$_GET['cid']."'");
		}

		?><script> window.location='index.php?page=food&cid=<?=$_POST['f_type_id']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('content_title_th').value==""){
			alert("กรุณากรอกชื่อหมวดหมูภาษาไทย...");
			document.getElementById('content_title_th').focus();
			return false;
		}else if(document.getElementById('content_title_en').value==""){
			alert("กรุณากรอกชื่อหมวดหมู่ภาษาอังกฤษ...");
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
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขหมวดหมู่</h2>
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
									$rs = mysql_query("select * from food where content_id='".$_GET['cid']."'");
									$rw = mysql_fetch_array($rs);

									$rw_title_en = html_entity_decode($rw['content_title_en']);
									$rw_title_th = html_entity_decode($rw['content_title_th']);
									$rw_sdesc_en = html_entity_decode($rw['content_sdesc_en']);
									$rw_sdesc_th = html_entity_decode($rw['content_sdesc_th']);
									$rw_desc_en = html_entity_decode($rw['content_desc_en']);
									$rw_desc_th = html_entity_decode($rw['content_desc_th']);
								?><br><br>
								<!--<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่ :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<option value='' >เลือกหมวดหมู่</option>
									<?
									$res = mysql_query("select * from content_category where category_status='approved'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($row['category_id']==$rw['category_id']){ print "selected='selected'";}?>><?=$row['category_title_en']?>/<?=$row['category_title_th']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่ :</label>
								<div class="controls">
								  <select id="f_type_id" name="f_type_id">
									<option value='' >เลือกประเภท</option>
									<?
									$res = mysql_query("select * from f_type where f_type_status='approved'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['f_type_id']?>' <? if($rw['f_type_id']==$row['f_type_id']){ print "selected='selected'";}?>><?=$row['f_type_name_th']?></option>
									<? }?>
								  </select>
								</div>
							  </div>
							  <!--///////////////////picture/////////////////////////
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['content_thumbnail']){?>
									<img src="../public/food/thumb/<?=$rw['content_thumbnail']?>" height="225" width="300">
								<? }?>
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 714px x 431px)
									<input type="hidden" name="picture1" id="picture1" value="<?=$rw['content_thumbnail']?>">

								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label">ลบรูปภาพ</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="delete_pics" name="delete_pics" value="1"> ลบ
								  </label>
								</div>
							  </div>-->
							  <!------------------------------------------------->
							  <!--///////////////////picture2/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['content_image']){?>
								<img src="../public/food/<?=$rw['content_image']?>" height="225" width="300">
								<? }?>
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ </label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (image size: 959px x 723px)
									<input type="hidden" name="picture2" id="picture2" value="<?=$rw['content_image']?>">

								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label">ลบรูปภาพ </label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="delete_pics2" name="delete_pics2" value="1"> ลบ
								  </label>
								</div>
							  </div>
							  <!--//////////////////////////////////////-->
							  <!--<div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อ vdo (ไทย)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_vdo_th" name="content_vdo_th" type="text" value="<?=$rw['content_vdo_th']?>" > (Ex => 0X5RhuzKnhY)
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput"> vdo  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_vdo_en" name="content_vdo_en" type="text" value="<?=$rw['content_vdo_en']?>" > (Ex => 0X5RhuzKnhY)
								</div>
							  </div>
							  <!--<div class="control-group">
								<label class="control-label">เลือกแสดง</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="content_s" id="content_s" value="0" checked="checked">
									Picture
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="content_s" id="content_s" value="1" <? if($rw['content_s']==1){ print "checked='checked'";}?>>
									VDO
								  </label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (ไทย) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_th" name="content_title_th" type="text" value="<?=$rw_title_th?>" >
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อ:</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_en" name="content_title_en" type="text" value="<?=$rw_title_en?>" >
								</div>
							  </div>
							  <!--<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_th" name="content_sdesc_th" rows="3"><?=$rw_sdesc_th?></textarea>
							  </div>
							</div>  -->
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_en" name="content_sdesc_en" rows="3"><?=$rw_sdesc_en?></textarea>
							  </div>
							</div>
							  <!--<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_desc_th" name="content_desc_th" rows="3"><?=$rw_desc_th?></textarea>

								<!--<textarea cols="20" id="content_desc_th" name="content_desc_th" rows="5"><?=$rw['content_desc_th']?></textarea>
								<script type="text/javascript">
								CKEDITOR.replace( 'content_desc_th', {
										filebrowserBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor',
										filebrowserImageBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor&filter=image',
										filebrowserFlashBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor&filter=flash',
									}
								);
								</script>
							  </div>
							</div>-->
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา  :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_desc_en" name="content_desc_en" rows="3"><?=$rw_desc_en?></textarea>

								<!--<textarea cols="20" id="content_desc_en" name="content_desc_en" rows="5"><?=$rw['content_desc_en']?></textarea>
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
								  <input class="input-xlarge focused" id="content_url" name="content_url" type="text" value="<?=$rw['content_url']?>" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="focusedInput">การจัดอันดับ  :</label>
								<div class="controls">
								  <input class="input-small focused" id="content_order" name="content_order" type="number" value="<?=$rw['content_order']?>" >
								</div>
							  </div>

							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="content_status" name="content_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['content_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Edit data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=food&cid=<?=$_GET['cid2']?>';">
							  </div>
							</fieldset>
						  </form>

					</div>
				</div><!--/span-->

			</div><!--/row-->
			<hr>