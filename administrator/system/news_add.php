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
		
		/*$pics3 = $_FILES['file3']['tmp_name'];
		$pics_name3 = $_FILES['file3']['name'];
		$pics_size3 = $_FILES['file3']['size'];
		$pics_type3 = $_FILES['file3']['type'];
		
		$pics4 = $_FILES['file4']['tmp_name'];
		$pics_name4 = $_FILES['file4']['name'];
		$pics_size4 = $_FILES['file4']['size'];
		$pics_type4 = $_FILES['file4']['type'];
		
		$pics5 = $_FILES['file5']['tmp_name'];
		$pics_name5 = $_FILES['file5']['name'];
		$pics_size5 = $_FILES['file5']['size'];
		$pics_type5 = $_FILES['file5']['type'];*/
		
		$news_title_en = htmlspecialchars($_POST['news_title_en'], ENT_QUOTES);
		$news_title_th = htmlspecialchars($_POST['news_title_th'], ENT_QUOTES);
		$news_sdesc_en = htmlspecialchars($_POST['news_sdesc_en'], ENT_QUOTES);
		$news_sdesc_th = htmlspecialchars($_POST['news_sdesc_th'], ENT_QUOTES);
		$news_desc_en = htmlspecialchars($_POST['news_desc_en'], ENT_QUOTES);
		$news_desc_th = htmlspecialchars($_POST['news_desc_th'], ENT_QUOTES);
		$news_url = htmlspecialchars($_POST['news_url'], ENT_QUOTES);
		$news_url2 = htmlspecialchars($_POST['news_url2'], ENT_QUOTES);
		
		/*$news_title_en = str_replace('"','///', $_POST['news_title_en']);
		$news_title_th = str_replace('"','///', $_POST['news_title_th']);
		$news_sdesc_en = str_replace('"','///', $_POST['news_sdesc_en']);
		$news_sdesc_th = str_replace('"','///', $_POST['news_sdesc_th']);
		$news_desc_en = str_replace('"','///', $_POST['news_desc_en']);
		$news_desc_th = str_replace('"','///', $_POST['news_desc_th']);*/
		
		mysql_query("insert into news(news_s, news_url, news_url2, news_vdo_th, news_vdo_en, news_title_en, news_title_th, news_sdesc_en, news_sdesc_th, news_desc_en, news_desc_th, news_status, news_createdip) values('".$_POST['news_s']."', '".$news_url."', '".$news_url2."', '".$_POST['news_vdo_th']."', '".$_POST['news_vdo_en']."', '".$news_title_en."', '".$news_title_th."', '".$news_sdesc_en."', '".$news_sdesc_th."', '".$news_desc_en."', '".$news_desc_th."', '".$_POST['news_status']."', '".$_SERVER['REMOTE_ADDR']."')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/news/thumb/".$fir1.$id.".".$last_name1);
			}
			$p.="news_tbm1='".$fir1.$id.".".$last_name1."', ";			
		}
		
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);
							
			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				copy($pics2, "../public/news/".$fir2.$id.".".$last_name2);
			}
			$p.="news_tbm2='".$fir2.$id.".".$last_name2."', ";			
		}
		/*if($pics3){
			$array_last = explode(".",$pics_name3);
			$fir3 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name3 = strtolower($array_last[$c]);
							
			if($last_name3=="gif" or $last_name3=="jpg" or $last_name3=="jpeg" or $last_name3=="png"){
				copy($pics3, "../public/news/".$fir3.$id.".".$last_name3);
			}
			$p.="news_tbm3='".$fir3.$id.".".$last_name3."', ";			
		}
		if($pics4){
			$array_last = explode(".",$pics_name4);
			$fir4 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name4 = strtolower($array_last[$c]);
							
			if($last_name4=="gif" or $last_name4=="jpg" or $last_name4=="jpeg" or $last_name4=="png"){
				copy($pics4, "../public/news/".$fir4.$id.".".$last_name4);
			}
			$p.="news_tbm4='".$fir4.$id.".".$last_name4."', ";			
		}
		if($pics5){
			$array_last = explode(".",$pics_name5);
			$fir5 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name5 = strtolower($array_last[$c]);
							
			if($last_name5=="gif" or $last_name5=="jpg" or $last_name5=="jpeg" or $last_name5=="png"){
				copy($pics5, "../public/news/".$fir5.$id.".".$last_name5);
			}
			$p.="news_tbm5='".$fir5.$id.".".$last_name5."', ";			
		}*/
		
		mysql_query("update news set $p news_createdtime='".$today."' where news_id='".$id."'");
		
		?><script> window.location='index.php?page=news&cid=<?=$_GET['cid']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('news_title_th').value==""){
			alert("กรุณากรอกชื่อภาษาไทย...");
			document.getElementById('news_title_th').focus();
			return false;
		}else if(document.getElementById('news_title_en').value==""){
			alert("กรุณากรอกชื่อภาษาอังกฤษ...");
			document.getElementById('news_title_en').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>สร้าง HALL OF FRAME</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="news" method="post" enctype="multipart/form-data">
							<fieldset>
							<br>
								
							  
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ </label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"> (image size: 000px x 000px)
									
								  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ 2</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (image size: 959px x 723px)
									
								  </div>
							  </div>
							  <!--<div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ 3</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file3" name="file3" type="file"> (image size: 959px x 723px)
									
								  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ 4</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file4" name="file4" type="file"> (image size: 959px x 723px)
									
								  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label" for="fileInput">รูปภาพ 5</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file5" name="file5" type="file"> (image size: 959px x 723px)
									
								  </div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">vdo (ไทย)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="news_vdo_th" name="news_vdo_th" type="text" value="" > (Ex => 0X5RhuzKnhY)
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">vdo (EN)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="news_vdo_en" name="news_vdo_en" type="text" value="" > (Ex => 0X5RhuzKnhY)
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">เลือกแสดง</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="news_s" id="news_s" value="0" checked="checked">
									Picture
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="news_s" id="news_s" value="1">
									VDO
								  </label>
								</div>
							  </div>
							  
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (ไทย)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="news_title_th" name="news_title_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อบทความ (EN)  :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="news_title_en" name="news_title_en" type="text" value="" >
								</div>
							  </div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="news_sdesc_th" name="news_sdesc_th" rows="3"></textarea>
							  </div>
							</div>  
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาโดยย่อ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="news_sdesc_en" name="news_sdesc_en" rows="3"></textarea>
							  </div>
							</div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="news_desc_th" name="news_desc_th" rows="3"></textarea>
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
								<textarea class="cleditor" id="news_desc_en" name="news_desc_en" rows="3"></textarea>
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
							  <label class="control-label" for="textarea2">สถานที่ติดต่อ  :</label>
							  <div class="controls">
								<textarea class="cleditor" id="news_url" name="news_url" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">สถานที่ติดต่อ (EN) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="news_url2" name="news_url2" rows="3"></textarea>
							  </div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="news_status" name="news_status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending'>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Add data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=news&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>