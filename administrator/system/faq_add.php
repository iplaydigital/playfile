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
		
		$faq_title_en = htmlspecialchars($_POST['faq_title_en'], ENT_QUOTES);
		$faq_title_th = htmlspecialchars($_POST['faq_title_th'], ENT_QUOTES);
		$faq_desc_en = htmlspecialchars($_POST['faq_desc_en'], ENT_QUOTES);
		$faq_desc_th = htmlspecialchars($_POST['faq_desc_th'], ENT_QUOTES);
		
		$res = mysql_query("select * from faq ");
		while($row = mysql_fetch_array($res)){
			$order = $row['faq_order']+1;
			mysql_query("update faq set faq_order='".$order."' where faq_id='".$row['faq_order']."'");
		}
		mysql_query("insert into faq(youtube, faq_show, faq_title_en, faq_title_th, faq_desc_en, faq_desc_th, faq_status, faq_order) values('".$_POST['youtube']."', '".$_POST['type']."', '".$faq_title_en."', '".$faq_title_th."', '".$faq_desc_en."', '".$faq_desc_th."', '".$_POST['faq_status']."', '1')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/faq/thumb/".$fir1.$id.".".$last_name1);
			}
			$p.="faq_thumb='".$fir1.$id.".".$last_name1."', ";			
		}
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);
							
			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				copy($pics2, "../public/faq/".$fir2.$id.".".$last_name2);
			}
			$p.="faq_image='".$fir2.$id.".".$last_name2."', ";			
		}
		
		mysql_query("update faq set $p faq_createdtime='".$today."' where faq_id='".$id."'");
		
		?><script> window.location='index.php?page=faq&cid=<?=$_GET['cid']?>'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>สร้าง FAQ</h2>
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
								<!--<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่ :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<option value='' >เลือกหมวดหมู่</option>
									<?
									$res = mysql_query("select * from content_category where category_status='approved'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($_GET['cid']==$row['category_id']){ print "selected";}?>><?=$row['category_title_en']?>/<?=$row['category_title_en']?></option>
									<? }?>
								  </select>
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
									<option value='<?=$row['f_type_id']?>' ><?=$row['f_type_name']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  
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
								<label class="control-label" for="focusedInput">Youtube ID :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="youtube" name="youtube" type="text" value="" > (Ex: 8UuezgWKtx0)
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
									<input type="radio" name="type" id="type" value="1">
									VDO
								  </label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">คำถาม (TH)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="faq_title_th" name="faq_title_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">คำถาม (EN)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="faq_title_en" name="faq_title_en" type="text" value="" >
								</div>
							  </div>
							
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">คำตอบ (TH) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="faq_desc_th" name="faq_desc_th" rows="3"></textarea>
								<!--<textarea cols="20" id="content_desc_th" name="content_desc_th" rows="5"></textarea>
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
								<textarea class="cleditor" id="faq_desc_en" name="faq_desc_en" rows="3"></textarea>
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
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="faq_status" name="faq_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending'>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Add data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=faq';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>