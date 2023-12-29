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
		
		$product_title_en = htmlspecialchars($_POST['product_title_en'], ENT_QUOTES);
		$product_title_th = htmlspecialchars($_POST['product_title_th'], ENT_QUOTES);
		$product_sdesc_en = htmlspecialchars($_POST['product_sdesc_en'], ENT_QUOTES);
		$product_sdesc_th = htmlspecialchars($_POST['product_sdesc_th'], ENT_QUOTES);
		$product_desc_en = htmlspecialchars($_POST['product_desc_en'], ENT_QUOTES);
		$product_desc_th = htmlspecialchars($_POST['product_desc_th'], ENT_QUOTES);
		
		$res = mysql_query("select * from product where category_id='".$_POST['category_id']."'");
		while($row=mysql_fetch_array($res)){
			$sum = $row['product_order']+1;
			mysql_query("update product set product_order='$sum' where product_id='".$row['product_id']."'");
		}
		
		if($_POST['product_hilight']==""){ $_POST['product_hilight']=0; }
		
		mysql_query("insert into product(category_id, product_type, product_title_th, product_title_en, product_sdesc_th, product_sdesc_en, product_desc_th, product_desc_en, product_size, product_quantity_th, product_quantity_en, product_price, product_price2, product_hilight, product_status, product_order, product_createdip) values('".$_POST['category_id']."', '".$_POST['product_type']."', '".$product_title_th."', '".$product_title_en."', '".$product_sdesc_th."', '".$product_sdesc_en."', '".$product_desc_th."', '".$product_desc_en."', '".$_POST['product_size']."', '".$_POST['product_quantity_th']."', '".$_POST['product_quantity_en']."', '".$_POST['product_price1']."', '".$_POST['product_price2']."', '".$_POST['product_hilight']."', '".$_POST['status']."', '1', '".$_SERVER['REMOTE_ADDR']."')");
		
		$id = mysql_insert_id();
		$p="";
		
		if($pics1){
			$array_last = explode(".",$pics_name1);
			$fir1 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name1 = strtolower($array_last[$c]);
							
			if($last_name1=="gif" or $last_name1=="jpg" or $last_name1=="jpeg" or $last_name1=="png"){
				copy($pics1, "../public/product/thumb/".$fir1.$id.".".$last_name1);
			}
			$p.="product_thumbnail='".$fir1.$id.".".$last_name1."', ";			
		}
		
		if($pics2){
			$array_last = explode(".",$pics_name2);
			$fir2 = md5($array_last[0]);
			$c = count($array_last)-1;
			$last_name2 = strtolower($array_last[$c]);
							
			if($last_name2=="gif" or $last_name2=="jpg" or $last_name2=="jpeg" or $last_name2=="png"){
				copy($pics2, "../public/product/".$fir2.$id.".".$last_name2);
			}
			$p.=" product_image='".$fir2.$id.".".$last_name2."', ";			
		}
		
		mysql_query("update product set $p product_createdtime='".$today."' where product_id='".$id."'");
		
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
						<h2><i class="icon-edit"></i><span class="break"></span>เพิ่มสินค้าใหม่</h2>
						<!--<div class="box-icon">
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>-->
					</div>
					<div class="box-content">
						<form class="form-horizontal" name="productcategory" method="post" enctype="multipart/form-data">
							<fieldset><br>
								<div class="control-group">
								<label class="control-label" for="selectError3">หมวดหมู่สินค้า :</label>
								<div class="controls">
								  <select id="category_id" name="category_id">
									<?
									$res = mysql_query("select * from product_category where category_subid='0'");
									while($row = mysql_fetch_array($res)){
									?>
									<option value='<?=$row['category_id']?>' <? if($_GET['cid']==$row['category_id']){ print "selected='selected'";}?>><?=$row['category_title_th']?></option>
									<? }?>
								  </select>
								</div>
							  </div>
							  <!--<div class="control-group">
								<label class="control-label" for="selectError3">ประเภทสินค้า :</label>
								<div class="controls">
								  <select id="product_type" name="product_type">
									<option value='item' >สินค้าปลีก</option>
									<option value='package' >สินค้าจัดแพ็คเกจ</option>
								  </select>
								</div>
								</div>-->
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปขนาดเล็ก (Thumbnail) :</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file1" name="file1" type="file">
									
								  </div>
							  </div>
							  
								<div class="control-group">
								  <label class="control-label" for="fileInput">รูปขนาดใหญ่ (Image) :</label>
								  <div class="controls">
									<input class="input-file uniform_on" id="file2" name="file2" type="file"> (size: 300 x 400 px)
									
								  </div>
							  </div>
							  
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อสินค้า (ไทย) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_title_th" name="product_title_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ชื่อสินค้า (En) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_title_en" name="product_title_en" type="text" value="" >
								</div>
							  </div>
							<!--  <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้าโดยย่อ (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_sdesc_th" name="product_sdesc_th" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้าโดยย่อ (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_sdesc_en" name="product_sdesc_en" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้า (ไทย) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_desc_th" name="product_desc_th" rows="3"></textarea>
							  </div>
							</div>
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">รายละเอียดสินค้า (En) :</label>
							  <div class="controls">
								<textarea class="cleditor" id="product_desc_en" name="product_desc_en" rows="3"></textarea>
							  </div>
							 </div>
							 <div class="control-group">
								<label class="control-label" for="focusedInput">ราคา :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_price" name="product_price" type="text" value="" >
								</div>
							  </div>
							
							
							 <div class="control-group">
								<label class="control-label">ไฮไลต์ :</label>
								<div class="controls">
								  <label class="radio">
									<input type="radio" name="product_fea" id="product_fea" value="none" checked="">
									NONE
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="product_fea" id="product_fea" value="new">
									NEW
								  </label>
								  <div style="clear:both"></div>
								  <label class="radio">
									<input type="radio" name="product_fea" id="product_fea" value="hot">
									HOT
								  </label>
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label">กำหนดสินค้าเป็น :<br />Hot Products</label>
								<div class="controls">
								  <label class="checkbox inline">
									<input type="checkbox" id="product_hilight" name="product_hilight" value="1"> yes
								  </label>
								</div>
							  </div>-->
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ขนาด (gram) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_size" name="product_size" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">บรรจุ/หีบ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_quantity_th" name="product_quantity_th" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">บรรจุ/หีบ :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_quantity_en" name="product_quantity_en" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ราคาขายปลีก(บาท/ขวด) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_price1" name="product_price1" type="text" value="" >
								</div>
							  </div>
							  <div class="control-group">
								<label class="control-label" for="focusedInput">ราคาขายส่งปกติ/หีบ(ไม่รวม Vat) :</label>
								<div class="controls">
								  <input class="input-xlarge focused" id="product_price2" name="product_price2" type="text" value="" >
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
							  <div class="form-actions">
								<input type="submit" class="btn btn-primary" name="submit" value="เพิ่มข้อมูล" onmousedown="check_data();">
								<input type="button" class="btn btn-primary" value="ยกเลิก" onclick="window.location='index.php?page=product&cid=<?=$_GET['cid']?>';">
							  </div>
							</fieldset>
						  </form>
					
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>