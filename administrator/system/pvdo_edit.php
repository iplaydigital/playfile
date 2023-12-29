<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		
		mysql_query("update pvdo set pvdo_title='".$_POST['vdo_title']."', pvdo_value='".$_POST['vdo_value']."', pvdo_status='".$_POST['status']."' where pvdo_id='".$_GET['pvid']."'");
		
		?><script> window.location='index.php?page=pvdo&cid=<?=$_GET['cid']?>&idx=<?=$_GET['idx']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('vdo_title').value==""){
			alert("กรุณากรอกชื่อวีดีโอ...");
			document.getElementById('vdo_title').focus();
			return false;
		}if(document.getElementById('vdo_value').value==""){
			alert("กรุณากรอกชื่อรหัสวีดีโอ...");
			document.getElementById('vdo_value').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขวิดีโอ</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="category" method="post" enctype="multipart/form-data">
							<fieldset><br>
								<? 
									$rs = mysql_query("select * from pvdo where pvdo_id='".$_GET['pvid']."'");
									$rw = mysql_fetch_array($rs);
								?>
								<!--<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่ :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<?
									$res = mysql_query("select * from  gallery_category where category_type='vdo' and category_status!='discard'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($row['category_id']==$rw['category_id']){ print "selected='selected'";}?>><?=$row['category_title']?></option>
									<? }?>
								  </select>
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อวีดีโอ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="vdo_title" name="vdo_title" type="text" value="<?=$rw['pvdo_title']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">YouTube ID :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="vdo_value" name="vdo_value" type="text" value="<?=$rw['pvdo_value']?>" >&nbsp;Example : dsxt3C8h_2U
								</div>
							  </div>
							  <!--<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา (TH) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="vdo_detail" name="vdo_detail" rows="3"><?=$rw['pvdo_detail']?></textarea>
							  </div>
							</div>-->
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['pvdo_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=pvdo&cid=<?=$_GET['cid']?>&idx=<?=$_GET['idx']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->