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
		
		$p="";
				
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/faq/thumb/".$_POST['picture1']);
				}
				copy($pics1, "../public/faq/thumb/".$fir1.$_GET['cid'].".".$last_name1);
			}
			$p.="faq_thumb='".$fir1.$_GET['cid'].".".$last_name1."', ";			
		}
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);
							
			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				if($_POST['picture2']!="default.jpg"){
					unlink("../public/faq/".$_POST['picture2']);
				}
				copy($pics2, "../public/faq/".$fir2.$_GET['cid'].".".$last_name2);
			}
			$p.="faq_image='".$fir2.$_GET['cid'].".".$last_name2."', ";			
		}
		
		$faq_title_en = htmlspecialchars($_POST['faq_title_en'], ENT_QUOTES);
		$faq_title_th = htmlspecialchars($_POST['faq_title_th'], ENT_QUOTES);
		$faq_desc_en = htmlspecialchars($_POST['faq_desc_en'], ENT_QUOTES);
		$faq_desc_th = htmlspecialchars($_POST['faq_desc_th'], ENT_QUOTES);  
		
		mysql_query("update faq set $p youtube='".$_POST['youtube']."', faq_show='".$_POST['type']."', faq_title_en='".$faq_title_en."', faq_title_th='".$faq_title_th."', faq_desc_en='".$faq_desc_en."', faq_desc_th='".$faq_desc_th."', faq_status='".$_POST['faq_status']."', faq_updatedtime='".$today."' where faq_id='".$_GET['cid']."'");
		
		
		if($_POST['delete_pics']=="1"){
			if($_POST['picture1']!="default.jpg"){
				unlink("../public/faq/thumb/".$_POST['picture1']);
			}
			mysql_query("update faq set faq_thumb='' where faq_id='".$_GET['cid']."'");
		}
		if($_POST['delete_pics2']=="1"){
			if($_POST['picture2']!="default.jpg"){
				unlink("../public/faq/".$_POST['picture2']);
			}
			mysql_query("update faq set faq_image='' where faq_id='".$_GET['cid']."'");
		}
		
		?><script> window.location='index.php?page=faq&cid=<?=$_GET['cid2']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('faq_title_th').value==""){
			alert("กรุณากรอกคำถามภาษาไทย...");
			document.getElementById('faq_title_th').focus();
			return false;
		}else if(document.getElementById('faq_desc_th').value==""){
			alert("กรุณากรอกคำตอบภาษาไทย...");
			document.getElementById('faq_desc_th').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไข FAQ</h2>
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
									$rs = mysql_query("select * from faq where faq_id='".$_GET['cid']."'");
									$rw = mysql_fetch_array($rs);
									
									$rw_title_en = html_entity_decode($rw['faq_title_en']);
									$rw_title_th = html_entity_decode($rw['faq_title_th']);
									$rw_desc_en = html_entity_decode($rw['faq_desc_en']);
									$rw_desc_th = html_entity_decode($rw['faq_desc_th']);
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
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">ประเภทอาหาร (สำหรับหมวดหมู่ recipe):</label>
								<div class="controls">
								  <select id="f_type_id" name="f_type_id">
									<option value='' >เลือกประเภทอาหาร</option>
									<?
									$res = mysql_query("select * from f_type");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['f_type_id']?>' <? if($rw['f_type_id']==$row['f_type_id']){ print "selected='selected'";}?>><?=$row['f_type_name']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  <!--///////////////////picture/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['faq_thumb']){?>
									<img src="../public/faq/thumb/<?=$rw['faq_thumb']?>" height="225" width="300">
								<? }?>
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 000px x 000px)
									<input type="hidden" name="picture1" id="picture1" value="<?=$rw['faq_thumb']?>">
									
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
								<? if($rw['faq_image']){?>
									<img src="../public/faq/<?=$rw['faq_image']?>" height="225" width="300">
								<? }?>
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ (image slide)</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (image size: 000px x 000px)
									<input type="hidden" name="picture2" id="picture2" value="<?=$rw['faq_image']?>">
									
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
								<label class="control-label" for="focusedInput">Youtube ID :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="youtube" name="youtube" type="text" value="<?=$rw['youtube']?>" > (Ex: 8UuezgWKtx0)
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">เลือกแสดง</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="type" id="type" value="0" checked="checked">
									Picture
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="type" id="type" value="1" <? if($rw['faq_show']==1){ print "checked='checked'";}?>>
									VDO
								  </label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">คำถาม (TH) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="faq_title_th" name="faq_title_th" type="text" value="<?=$rw_title_th?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">คำถาม (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="faq_title_en" name="faq_title_en" type="text" value="<?=$rw_title_en?>" >
								</div>
							  </div>
							  
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">คำตอบ (TH) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="faq_desc_th" name="faq_desc_th" rows="3"><?=$rw_desc_th?></textarea>
								
								<!--<textarea cols="20" id="content_desc_th" name="content_desc_th" rows="5"><?=$rw['content_desc_th']?></textarea>
								<script type="text/javascript"> 
								CKEDITOR.replace( 'content_desc_th', {
										filebrowserBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor',
										filebrowserImageBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor&filter=image',
										filebrowserFlashBrowseUrl : '/utip2015/administrator/pdw_file_browser/index.php?editor=ckeditor&filter=flash',
									}
								);
								</script>-->
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">คำตอบ (EN) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="faq_desc_en" name="faq_desc_en" rows="3"><?=$rw_desc_en?></textarea>
								
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
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="faq_status" name="faq_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['faq_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Edit data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=faq';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>