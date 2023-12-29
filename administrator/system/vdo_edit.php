<?
	include("../include/checkuser.php");
	if($_POST['submit']){
		
		$vdo_title_th = htmlspecialchars($_POST['vdo_title_th'], ENT_QUOTES);
		$vdo_title_en = htmlspecialchars($_POST['vdo_title_en'], ENT_QUOTES);
		$vdo_value_th =  htmlspecialchars($_POST['vdo_value_th'], ENT_QUOTES);
		$vdo_value_en =  htmlspecialchars($_POST['vdo_value_en'], ENT_QUOTES);
		$vdo_sdetail_th = htmlspecialchars($_POST['vdo_sdetail_th'], ENT_QUOTES);
		$vdo_sdetail_en = htmlspecialchars($_POST['vdo_sdetail_en'], ENT_QUOTES);
		$vdo_detail_th = htmlspecialchars($_POST['vdo_detail_th'], ENT_QUOTES);
		$vdo_detail_en = htmlspecialchars($_POST['vdo_detail_en'], ENT_QUOTES);
		
		mysql_query("update vdo set category_id='1', vdo_title_th='".$vdo_title_th."', vdo_title_en='".$vdo_title_en."', vdo_value_th='".$_POST['vdo_value_th']."', vdo_value_en='".$_POST['vdo_value_en']."', vdo_sdetail_th='".$vdo_sdetail_th."', vdo_sdetail_en='".$vdo_sdetail_en."', vdo_detail_th='".$vdo_detail_th."', vdo_detail_en='".$vdo_detail_en."', vdo_status='".$_POST['status']."', vdo_updatedtime='".$today."', vdo_updatedip='".$_SERVER['REMOTE_ADDR']."' where vdo_id='".$_GET['idx']."'");
		
		?><script> window.location='index.php?page=vdo'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('vdo_title_th').value==""){
			alert("กรุณากรอกชื่อวีดีโอ...");
			document.getElementById('vdo_title_th').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไข heritage</h2>
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
									$rs = mysql_query("select * from vdo where vdo_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
									
								//$rw_title = str_replace('///','"', $rw['vdo_title']);
								//$rw_vdo = str_replace('///','"', $rw['vdo_detail']);
								
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
								<label class="control-label" for="focusedInput">ชื่อ  (TH):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="vdo_title_th" name="vdo_title_th" type="text" value="<?=html_entity_decode($rw['vdo_title_th'])?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อ (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="vdo_title_en" name="vdo_title_en" type="text" value="<?=html_entity_decode($rw['vdo_title_en'])?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">YouTube ID :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="vdo_value_th" name="vdo_value_th" type="text" value="<?=$rw['vdo_value_th']?>" >&nbsp;Example : dsxt3C8h_2U
								</div>
							  </div>
							  <!--<div class="control-group">
								<label class="control-label" for="focusedInput">YouTube ID (EN):</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="vdo_value_en" name="vdo_value_en" type="text" value="<?=$rw['vdo_value_en']?>" >&nbsp;Example : dsxt3C8h_2U
								</div>
							  </div>-->
							   <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหาย่อ (TH) :</label>
							  <div class="controls">
								
								<textarea class="cleditor" id="vdo_sdetail_th" name="vdo_sdetail_th" rows="3"><?=html_entity_decode($rw['vdo_sdetail_th'])?></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							 <label class="control-label" for="textarea2">เนื้อหาย่อ (EN) :</label>
							  <div class="controls">
								
								<textarea class="cleditor" id="vdo_sdetail_en" name="vdo_sdetail_en" rows="3"><?=html_entity_decode($rw['vdo_sdetail_en'])?></textarea>
							  </div>
							</div>
							  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">เนื้อหา (TH) :</label>
							  <div class="controls">
								
								<textarea class="cleditor" id="vdo_detail_th" name="vdo_detail_th" rows="3"><?=html_entity_decode($rw['vdo_detail_th'])?></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							 <label class="control-label" for="textarea2">เนื้อหา (EN) :</label>
							  <div class="controls">
								
								<textarea class="cleditor" id="vdo_detail_en" name="vdo_detail_en" rows="3"><?=html_entity_decode($rw['vdo_detail_en'])?></textarea>
							  </div>
							</div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['vdo_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=vdo&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->