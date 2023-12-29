<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		$content_title_en = htmlspecialchars($_POST['content_title_en'], ENT_QUOTES);
		$content_title_th = htmlspecialchars($_POST['content_title_th'], ENT_QUOTES);
		$content_sdesc_en = htmlspecialchars($_POST['content_sdesc_en'], ENT_QUOTES);
		$content_sdesc_th = htmlspecialchars($_POST['content_sdesc_th'], ENT_QUOTES);
		$content_desc_en = htmlspecialchars($_POST['content_desc_en'], ENT_QUOTES);
		$content_desc_th = htmlspecialchars($_POST['content_desc_th'], ENT_QUOTES);
		$content_url = htmlspecialchars($_POST['content_url'], ENT_QUOTES);
		$content_url2 = htmlspecialchars($_POST['content_url2'], ENT_QUOTES);
		
		mysql_query("insert into content(category_id, content_url, content_url2, content_title_en, content_title_th, content_sdesc_en, content_sdesc_th, content_desc_en, content_desc_th, content_status, content_createdip) values('0', '".$content_url."', '".$content_url2."', '".$content_title_en."', '".$content_title_th."', '".$content_sdesc_en."', '".$content_sdesc_th."', '".$content_desc_en."', '".$content_desc_th."', '".$_POST['content_status']."', '".$_SERVER['REMOTE_ADDR']."')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/content/".$fir1.$id.".".$last_name1);
			}
			$p.="content_thumbnail='".$fir1.$id.".".$last_name1."', ";			
		}
		
		mysql_query("update content set $p content_createdtime='".$today."' where content_id='".$id."'");
		
		?><script> window.location='index.php?page=content&cid=<?=$_GET['cid']?>'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>สร้างบทความใหม่</h2>
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
								  <label class="control-label" for="fileInput">รูปภาพ</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 714px x 431px)
									
								  </div>
							  </div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">ชื่อบทความ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_title_th" name="content_title_th" rows="3"></textarea>
							  </div>
							</div>  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">ชื่อบทความ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_title_en" name="content_title_en" rows="3"></textarea>
							  </div>
							</div>
							  <!--<div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (ไทย)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_th" name="content_title_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (EN)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_en" name="content_title_en" type="text" value="" >
								</div>
							  </div>-->
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_th" name="content_sdesc_th" rows="3"></textarea>
							  </div>
							</div>  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_en" name="content_sdesc_en" rows="3"></textarea>
							  </div>
							</div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_desc_th" name="content_desc_th" rows="3"></textarea>
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
							  <label class="control-label" for="textarea2">เนื้อหา (EN) :</label>
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
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">สถานที่ติดต่อ :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_url" name="content_url" rows="3"></textarea>
							  </div>
							</div> 
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">สถานที่ติดต่อ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_url2" name="content_url2" rows="3"></textarea>
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
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=content&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>