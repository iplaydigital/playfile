<?php

	include("../include/checkuser.php");
	if($_POST['submit']){
		$pics1 = $_FILES['file1']['tmp_name'];
		$pics_name1 = $_FILES['file1']['name'];
		$pics_size1 = $_FILES['file1']['size'];
		$pics_type1 = $_FILES['file1']['type'];
		
		$rrs = mysql_query("select * from hslide");
		while($rrw = mysql_fetch_array($rrs)){
			$sorder = $rrw['sorder']+1;
			mysql_query("update hslide set sorder='".$sorder."' where slide_id='".$rrw['slide_id']."'");
		}
			if($pics1){
				mysql_query("insert into `hslide`(url, youtube, type, sorder, status) values('".$_POST['url']."', '".$_POST['youtube']."', '".$_POST['type']."', '1', 'approved')");
				$id = mysql_insert_id();
				$array_last = explode(".",$pics_name1);
				$c = count($array_last)-1;
				$p="";
				$last_name1 = strtolower($array_last[$c]);
				
				
				if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
					copy($pics1, "../public/vdo/slide/s".$id.".".$last_name1);
				}
				
				mysql_query("update hslide set pics='s".$id.".".$last_name1."' where slide_id='".$id."'");
			}else{ 
				mysql_query("insert into `hslide`(youtube, type, sorder, status, pics) values('".$_POST['youtube']."', '".$_POST['type']."', '1', 'approved', 'default.jpg')");
			}
			?><script> window.location="index.php?page=hslide&chk=<?=$chk?>";</script><?
		
	}
?>
<script>
	function changeoption(id){
		window.location='index.php?page=hslide_add&mid='+id;
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Add Picture Slide </h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="menu" method="post" enctype="multipart/form-data">
							<fieldset>
							<!--<div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<img src="../picture/slide/default.jpg" height="225" width="200">
							  </div>
							</div>-->
							
							<div class="control-group">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on" id="file1" name="file1" type="file">
								File Size:(00x00)
							  </div>
							</div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Picture URL :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="url" name="url" type="text" value="" > (Ex: http://google.co.th)
								</div>
							  </div>
							<div class="control-group">
								<label class="control-label" for="focusedInput">Youtube ID :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="youtube" name="youtube" type="text" value="" > (Ex: OzfaLHm2bW0)
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
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending'>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							</div>						
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="Add data" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="Cancel" onclick="window.location='index.php?page=hslide';">
							  </div>
							</fieldset>
							
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>
			