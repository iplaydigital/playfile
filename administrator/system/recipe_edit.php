<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		$p="";
			
		$content_title_en = htmlspecialchars($_POST['content_title_en'], ENT_QUOTES);
		$content_title_th = htmlspecialchars($_POST['content_title_th'], ENT_QUOTES);
		$content_sdesc_en = htmlspecialchars($_POST['content_sdesc_en'], ENT_QUOTES);
		$content_sdesc_th = htmlspecialchars($_POST['content_sdesc_th'], ENT_QUOTES);
		$content_desc_en = htmlspecialchars($_POST['content_desc_en'], ENT_QUOTES);
		$content_desc_th = htmlspecialchars($_POST['content_desc_th'], ENT_QUOTES);
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/content/".$_POST['picture1']);
				}
				copy($pics1, "../public/content/".$fir1.$_GET['cid'].".".$last_name1);
			}
			$p.="content_thumbnail='".$fir1.$_GET['cid'].".".$last_name1."', ";			
		}
		
		mysql_query("update content set $p category_id='".$_POST['category_id']."', f_type_id='".$_POST['f_type_id']."', content_title_en='".$content_title_en."', content_title_th='".$content_title_th."', content_sdesc_en='".$content_sdesc_en."', content_sdesc_th='".$content_sdesc_th."', content_desc_en='".$content_desc_en."', content_desc_th='".$content_desc_th."', content_status='".$_POST['content_status']."', content_updatedtime='".$today."', content_updatedip='".$_SERVER['REMOTE_ADDR']."' where content_id='".$_GET['idx']."'");
		
		?><script> window.location='index.php?page=recipe&cid=<?=$_GET['cid']?>&rid=<?=$_GET['rid']?>'; </script><?
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
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขตำรับความอร่อย</h2>
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
									$rs = mysql_query("select * from content where content_id='".$_GET['idx']."'");
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
							  <!--///////////////////picture/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<img src="../public/content/<?=$rw['content_thumbnail']?>" height="225" width="300"><input type="hidden" name="picture2" id="picture2" value="<?=$rw['content_thumbnail']?>">
							  </div>
							</div>
								<div class="control-group">
								  <label class="control-label" for="fileInput">File input</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 714px x 431px)
									<input type="hidden" name="picture1" id="picture1" value="<?=$rw['content_thumbnail']?>">
									
								  </div>
							  </div>
							  <!------------------------------------------------->
							  <div class="control-group">
								<label class="control-label" for="selectError3">ประเภทอาหาร (สำหรับหมวดหมู่ recipe):</label>
								<div class="controls">
								  <select id="f_type_id" name="f_type_id">
									<option value='' >เลือกประเภทอาหาร</option>
									<?
									$res = mysql_query("select * from f_type");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['f_type_id']?>' <? if($rw['f_type_id']==$row['f_type_id']){ print "selected='selected'";}?>><?=$row['f_type_name_th']?></option>
									<? }?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (ไทย) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_th" name="content_title_th" type="text" value="<?=$rw_title_th?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="content_title_en" name="content_title_en" type="text" value="<?=$rw_title_en?>" >
								</div>
							  </div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_th" name="content_sdesc_th" rows="3"><?=$rw_sdesc_th?></textarea>
							  </div>
							</div>  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="content_sdesc_en" name="content_sdesc_en" rows="3"><?=$rw_sdesc_en?></textarea>
							  </div>
							</div>
							  <div class="control-group hidden-phone">
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
								</script>-->
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา (EN) :</label>
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
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=recipe&cid=<?=$_GET['cid']?>&rid=<?=$_GET['rid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>