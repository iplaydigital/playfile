<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update product set product_status='discard' where product_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update product set product_status='".$ss."' where product_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update product set product_order='".($_GET['ord']-1)."' where product_id='".$_GET['bid']."'");
			//print "update product set product_seq='".($_GET['ord']-1)."' where product_id='".$_GET['bid']."'";
			$res = mysql_query("select product_order, product_id from product where product_order='".($_GET['ord']-1)."' and category_id='".$_GET['cid']."' and product_id!='".$_GET['bid']."'");
			
			$row = mysql_fetch_array($res);
			
			mysql_query("update product set product_order='".$_GET['ord']."' where product_id='".$row['product_id']."'");
			//print "update product set product_seq='".$_GET['ord']."' where product_id='".$row['product_id']."'";
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(product_order) as bo from product where product_status<>'discard' and category_id='".$_GET['cid']."'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update product set product_order='".($_GET['ord']+1)."' where product_id='".$_GET['bid']."'");
			//print "update product set product_seq='".($_GET['ord']+1)."' where product_id='".$_GET['bid']."'";
			$res = mysql_query("select product_order, product_id from product where product_order='".($_GET['ord']+1)."' and category_id='".$_GET['cid']."' and product_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update product set product_order='".$_GET['ord']."' where product_id='".$row['product_id']."'");
			//print "update product set product_seq='".$_GET['ord']."' where product_id='".$row['product_id']."'";
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=product&cid=<?=$_GET['cid']?>&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=product&cid=<?=$_GET['cid']?>&ch=1&idx='+id+'&s='+status;
		}
	}
	function up(bid, ord){
		window.location = 'index.php?page=product&cid=<?=$_GET['cid']?>&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=product&cid=<?=$_GET['cid']?>&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการสินค้า</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=product_add&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
							<!--<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>-->
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ลำดับ </th>
								  <th>ภาพตัวอย่าง</th>
								  <th>ชื่อสินค้า</th>
								  <th>การจัดลำดับ</th>
								  <!--<th>HOT PRODUCT</th>-->
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from product where product_status!='discard' and category_id='".$_GET['cid']."' order by product_order asc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center">
								<? if($row['product_image']){?>
									<img src="../public/product/<?=$row['product_image']?>" width="50" height="50">
								<? }?>
								</td>
								<td><?=$row['product_title_th']?></td>
								<td><?=$row['product_order']?><a onclick="up(<?=$row['product_id']?>, <?=$row['product_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['product_id']?>, <?=$row['product_order']?>);" style="cursor:pointer">ลง </a></td>
								<!--<td class="center">
									<? if($row['product_hilight']=="1"){?>
										YES
									<? }else{ ?>
										NO
									<? }?>
								</td>-->
								<td class="center">
									<? if($row['product_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['product_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['product_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<? //if($_GET['cid']==1){?>
									<!--<a class="btn btn-success" href="index.php?page=pvdo&cid=<?=$_GET['cid']?>&idx=<?=$row['product_id']?>">
										<i>วีดีโอ</i>  
									</a>
									<a class="btn btn-success" href="index.php?page=recipe&cid=<?=$_GET['cid']?>&rid=<?=$row['product_id']?>">
										<i>ตำรับอร่อย</i>  
									</a>-->
									<? //}?>
									<a class="btn btn-info" onclick="window.location='index.php?page=product_edit&cid=<?=$_GET['cid']?>&idx=<?=$row['product_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['product_id']?>);"></i> 
									</a>
									<!--<a class="btn btn-success" onclick="window.location='index.php?page=product_pic&cid=<?=$_GET['cid']?>&pid=<?=$row['product_id']?>'">รูปภาพ</a>
									<a class="btn btn-success" onclick="window.location='index.php?page=product_image&cid=<?=$_GET['cid']?>&pid=<?=$row['product_id']?>'">สี</a>
									<a class="btn btn-success" onclick="window.location='index.php?page=product_co&cid=<?=$_GET['cid']?>&pid=<?=$row['product_id']?>'">สินค้าที่เกี่ยวข้อง</a>
									<a class="btn btn-success" onclick="window.location='index.php?page=promotion&cid=<?=$_GET['cid']?>&pid=<?=$row['product_id']?>'">โปรโมชั่น</a>-->
								</td>
							</tr>
							<? }?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>