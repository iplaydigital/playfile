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
		
		$product_title_en = htmlspecialchars($_POST['product_title_en'], ENT_QUOTES);
		$product_title_th = htmlspecialchars($_POST['product_title_th'], ENT_QUOTES);
		$product_sdesc_en = htmlspecialchars($_POST['product_sdesc_en'], ENT_QUOTES);
		$product_sdesc_th = htmlspecialchars($_POST['product_sdesc_th'], ENT_QUOTES);
		$product_desc_en = htmlspecialchars($_POST['product_desc_en'], ENT_QUOTES);
		$product_desc_th = htmlspecialchars($_POST['product_desc_th'], ENT_QUOTES);
		
		if($_POST['category_id']!=$_GET['cid']){
		
			$res = mysql_query("select * from product where category_id='".$_POST['category_id']."'");
			while($row=mysql_fetch_array($res)){
				$sum = $row['product_order']+1;
				mysql_query("update product set product_order='$sum' where product_id='".$row['product_id']."'");
			}
		}
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				if($_POST['picture1']!="default.jpg"){
					unlink("../public/product/thumb/".$_POST['picture1']);
				}
				copy($pics1, "../public/product/thumb/".$fir1.$_GET['idx'].".".$last_name1);
			}
			$p.="product_thumbnail='".$fir1.$_GET['idx'].".".$last_name1."', ";			
		}
		
		if($pics2){
			$array_last2 = explode(".",$pics_name2);
			$fir2 = md5($array_last2[0]);
			$c = count($array_last2)-1;
			$last_name2 = strtolower($array_last2[$c]);
							
			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				if($_POST['picture2']!="default.jpg"){
					unlink("../public/product/".$_POST['picture2']);
				}
				copy($pics2, "../public/product/".$fir2.$_GET['idx'].".".$last_name2);
			}
			$p.="product_image='".$fir2.$_GET['idx'].".".$last_name2."', ";			
		}
		
		if($_POST['category_id']!=$_GET['cid']){
			mysql_query("update product set $p category_id='".$_POST['category_id']."', product_type='".$_POST['product_type']."', product_title_th='".$product_title_th."', product_title_en='".$product_title_en."', product_sdesc_th='".$product_sdesc_th."', product_sdesc_en='".$product_sdesc_en."', product_desc_th='".$product_desc_th."', product_desc_en='".$product_desc_en."', product_size='".$_POST['product_size']."', product_quantity_th='".$_POST['product_quantity_th']."', product_quantity_en='".$_POST['product_quantity_en']."', product_price='".$_POST['product_price1']."', product_price2='".$_POST['product_price2']."', product_hilight='".$_POST['product_hilight']."', product_status='".$_POST['status']."', product_updatedtime='".$today."', product_updatedip='".$_SERVER['REMOTE_ADDR']."', product_order='1' where product_id='".$_GET['idx']."'");
			
			
			$res = mysql_query("select * from product where category_id='".$_GET['cid']."' order by product_order asc");
			$i=0;
			while($row=mysql_fetch_array($res)){
				$i++;
				mysql_query("update product set product_order='$i' where product_id='".$row['product_id']."'");
			}
		}else{
			mysql_query("update product set $p category_id='".$_POST['category_id']."', product_type='".$_POST['product_type']."', product_title_th='".$product_title_th."', product_title_en='".$product_title_en."', product_sdesc_th='".$product_sdesc_th."', product_sdesc_en='".$product_sdesc_en."', product_desc_th='".$product_desc_th."', product_desc_en='".$product_desc_en."', product_size='".$_POST['product_size']."', product_quantity_th='".$_POST['product_quantity_th']."', product_quantity_en='".$_POST['product_quantity_en']."', product_price='".$_POST['product_price1']."', product_price2='".$_POST['product_price2']."', product_hilight='".$_POST['product_hilight']."', product_status='".$_POST['status']."', product_updatedtime='".$today."', product_updatedip='".$_SERVER['REMOTE_ADDR']."' where product_id='".$_GET['idx']."'");
			
		}
		
		if($_POST['delete_pics']=="1"){
			if($_POST['picture1']!="default.jpg"){
				unlink("../public/product/thumb/".$_POST['picture1']);
			}
			mysql_query("update product set product_thumbnail='' where product_id='".$_GET['idx']."'");
		}
		if($_POST['delete_pics2']=="1"){
			if($_POST['picture2']!="default.jpg"){
				unlink("../public/product/".$_POST['picture2']);
			}
			mysql_query("update product set product_image='' where product_id='".$_GET['idx']."'");
		}
		?><script> window.location='index.php?page=product&cid=<?=$_POST['category_id']?>'; </script><?
	}
?>
<script language=Javascript>
	function check_data(){
		if(document.getElementById('product_title_th').value==""){
			alert("กรุณากรอกชื่อหมวดหมูภาษาไทย...");
			document.getElementById('product_title_th').focus();
			return false;
		}else if(document.getElementById('product_title_en').value==""){
			alert("กรุณากรอกชื่อหมวดหมู่ภาษาอังกฤษ...");
			document.getElementById('product_title_en').focus();
			return false;
		}else{
			return true;
			
		}
	}
</script>
	<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>แก้ไขสินค้าใหม่</h2>
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
									$rs = mysql_query("select * from product where product_id='".$_GET['idx']."'");
									$rw = mysql_fetch_array($rs);
									
									$rw_title_en = html_entity_decode($rw['product_title_en']);
									$rw_title_th = html_entity_decode($rw['product_title_th']);
									$rw_sdesc_en = html_entity_decode($rw['product_sdesc_en']);
									$rw_sdesc_th = html_entity_decode($rw['product_sdesc_th']);
									$rw_desc_en = html_entity_decode($rw['product_desc_en']);
									$rw_desc_th = html_entity_decode($rw['product_desc_th']);
								?><br><br>
								<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่สินค้า :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<?
									$res = mysql_query("select * from product_category");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($rw['category_id']==$row['category_id']){ print "selected='selected'";}?>><?=$row['category_title_th']?>/<?=$row['category_title_en']?></option>
									<? }?>
								  </select>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">ประเภทสินค้า :</label>
								<div class="controls">
								  <select id="product_type" name="product_type">
									<option value='item' >สินค้าปลีก</option>
									<option value='package' <? if($rw['product_type']=='package'){ print "selected='selected'";}?>>สินค้าจัดแพ็คเกจ</option>
								  </select>
								</div>
								</div>
							  <!--///////////////////picture/////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['product_thumbnail']){?>
								<img src="../public/product/thumb/<?=$rw['product_thumbnail']?>" height="150" width="150">
								<? }?>
								<input type="hidden" name="picture" id="picture" value="<?=$rw['product_thumbnail']?>">
							  </div>
							</div>
							
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปขนาดเล็ก (Thumbnail)</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file"><input type="hidden" name="picture1" id="picture1" value="<?=$rw['category_icon']?>">
									
								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label">ลบรูปภาพ 1</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="delete_pics" name="delete_pics" value="1"> ลบ
								  </label>
								</div>
							  </div>
							  <!--//////////////////////////////////////////////////-->
							  <div class="control-group">
							  <label class="control-label" for="fileInput"></label>
							  <div class="controls">
								<? if($rw['product_image']){?>
								<img src="../public/product/<?=$rw['product_image']?>" height="300" width="300">
								<? }?>
								<input type="hidden" name="picture2" id="picture2" value="<?=$rw['product_image']?>">
							  </div>
							  </div>
							  <div class="control-group">
								  <label class="control-label" for="fileInput">รูปขนาดใหญ่ (Image) :</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (size: 300 x 400 px)
									
								  </div>
							  </div>
							  <div class="control-group">
								<label class="control-label">ลบรูปภาพ 2</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="delete_pics2" name="delete_pics2" value="1"> ลบ
								  </label>
								</div>
							  </div>
							  <!------------------------------------------------->					  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อสินค้า (ไทย) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_title_th" name="product_title_th" type="text" value="<?=$rw_title_th?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อสินค้า (En) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_title_en" name="product_title_en" type="text" value="<?=$rw_title_en?>" >
								</div>
							  </div>
							  <!--<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้าโดยย่อ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_sdesc_th" name="product_sdesc_th" rows="3"><?=$rw_sdesc_th?></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้าโดยย่อ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_sdesc_en" name="product_sdesc_en" rows="3"><?=$rw_sdesc_en?></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้า (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_desc_th" name="product_desc_th" rows="3"><?=$rw_desc_th?></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้า (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_desc_en" name="product_desc_en" rows="3"><?=$rw_desc_en?></textarea>
							  </div>
							 </div>
							  <!--<div class="control-group">
								<label class="control-label" for="focusedInput">ราคา :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_price" name="product_price" type="text" value="<?=$rw['product_price']?>" >
								</div>
							  </div>-->
							
							<!--<div class="control-group">
								<label class="control-label">ไฮไลต์ :</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="product_fea" id="product_fea" value="none" checked="">
									NONE
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="product_fea" id="product_fea" value="new" <? if($rw['product_fea']=="new"){ print "checked"; }?>>
									NEW
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="product_fea" id="product_fea" value="hot" <? if($rw['product_fea']=="hot"){ print "checked"; }?>>
									HOT
								  </label>
								</div>
							  </div>
							  
								<div class="control-group">
								<label class="control-label">กำหนดสินค้าเป็น :<br />Hot Products</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="product_hilight" name="product_hilight" value="1" <? if($rw['product_hilight']==1){ print "checked"; }?>> yes
								  </label>
								</div>
								</div>-->
								<div class="control-group">
								<label class="control-label" for="focusedInput">ขนาด (gram) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_size" name="product_size" type="text" value="<?=$rw['product_size']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">บรรจุ/หีบ (th) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_quantity_th" name="product_quantity_th" type="text" value="<?=$rw['product_quantity_th']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">บรรจุ/หีบ (en) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_quantity_en" name="product_quantity_en" type="text" value="<?=$rw['product_quantity_en']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ราคาขายปลีก(บาท/ขวด) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_price1" name="product_price1" type="text" value="<?=$rw['product_price']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ราคาขายส่งปกติ/หีบ(ไม่รวม Vat) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_price2" name="product_price2" type="text" value="<?=$rw['product_price2']?>" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="selectError3">สถานะการแสดงผล :</label>
								<div class="controls">
								  <select id="status" name="status">
									<option value='approved'>เปิดการแสดงผล</option>
									<option value='pending' <? if($rw['product_status']=="pending"){ print "selected='selected'";}?>>ปิดการแสดงผล</option>
								  </select>
								</div>
							  </div>
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="แก้ไขข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=product&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>