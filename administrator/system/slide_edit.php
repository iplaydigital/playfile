<?php
	include("../include/checkuser.php");
	if($_POST['submit']){
	
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
			if($pics1){
				$array_last1 = explode(".",$pics_name1);
				$c1 = count($array_last1)-1;
				$p="";
				$last_name1 = strtolower($array_last1[$c1]);
				
				if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
					if($_POST['picture1']!="default.jpg"){
						unlink("../public/slide/".$_POST['picture1']);
					}
					copy($pics1, "../public/slide/s".$_GET['idx'].".".$last_name1);
				}
				$p .= " pics='s".$_GET['idx'].".".$last_name1."', ";
				
				//mysql_query("insert into `paper`(p_name, detail, date_time, sub_menu_id, status) values('".$_POST['p_name']."', '".$_POST['detail']."', '".$date_now."', '".$_POST['sub_menu']."', '1')");
				mysql_query("update `slide` set $p url='".$_POST['url']."', youtube='".$_POST['youtube']."', type='".$_POST['type']."', status='".$_POST['status']."' where slide_id='".$_GET['idx']."'");
			}else{
				
				mysql_query("update `slide` set url='".$_POST['url']."', youtube='".$_POST['youtube']."', type='".$_POST['type']."', status='".$_POST['status']."', pics='".$_POST['picture1']."' where slide_id='".$_GET['idx']."'");
				
			}
			
			$chk = "2";
			?><script> window.location="index.php?page=slide&chk=<?=$chk?>";</script><?
		
	}
?>

<script>
	function changeoption(id){
		window.location='index.php?page=slide_edit&idx=<?=$_GET['idx']?>&mid='+id;
	}
</script>
	
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Edit Picture Slide </h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="menu" method="post" enctype="multipart/form-data">
							<fieldset>
								<?
									$rs = mysql_query("select * from slide where slide.slide_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
								?>
								
							  
							 <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls"><br>
								<img src="../public/slide/<?=$rw['pics']?>" height="225" width="200"><input type="hidden" name="picture1" id="picture1" value="<?=$rw['pics']?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="file1" name="file1" type="file">
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">URL :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="url" name="url" type="text" value="<?=$rw['url']?>" > (Ex: http://google.co.th)
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Youtube ID :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="youtube" name="youtube" type="text" value="<?=$rw['youtube']?>" > (Ex: OzfaLHm2bW0)
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
									<input type="radio" name="type" id="type" value="1" <? if($rw['type']==1){ print "checked='checked'";}?>>
									VDO
								  </label>
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>	
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Edit data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=slide';">
							  </div>
							</fieldset>
							
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>