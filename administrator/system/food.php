<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update food set content_status='discard' where content_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update food set content_status='".$ss."' where content_id='".$_GET['idx']."' ");
		}
	}
	
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update food set content_order='".($_GET['ord']-1)."' where content_id='".$_GET['bid']."' and content_status='approved'");
			//print "update food set content_order='".($_GET['ord']-1)."' where content_id='".$_GET['bid']."'";
			$res = mysql_query("select content_order, content_id from food where content_order='".($_GET['ord']-1)."' and content_status='approved' and f_type_id='".$_GET['cid']."' and content_id!='".$_GET['bid']."'");
			
			$row = mysql_fetch_array($res);
			
			mysql_query("update food set content_order='".$_GET['ord']."' where content_id='".$row['content_id']."' and content_status='approved'");
			//print "update product set product_seq='".$_GET['ord']."' where product_id='".$row['product_id']."'";
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(content_order) as bo from food where content_status<>'discard' and f_type_id='".$_GET['cid']."'");
		
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update food set content_order='".($_GET['ord']+1)."' where content_id='".$_GET['bid']."' and content_status='approved'");
			//print "update product set product_seq='".($_GET['ord']+1)."' where product_id='".$_GET['bid']."'";
			$res = mysql_query("select content_order, content_id from food where content_order='".($_GET['ord']+1)."' and content_status='approved' and f_type_id='".$_GET['cid']."' and content_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update food set content_order='".$_GET['ord']."' where content_id='".$row['content_id']."' and content_status='approved'");
			//print "update product set product_seq='".$_GET['ord']."' where product_id='".$row['product_id']."'";
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=food&c=1&cid=<?=$_GET['cid']?>&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=food&cid=<?=$_GET['cid']?>&ch=1&idx='+id+'&s='+status;
		}
	}
	function up(bid, ord){
		window.location = 'index.php?page=food&cid=<?=$_GET['cid']?>&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=food&cid=<?=$_GET['cid']?>&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<?
						$resc = mysql_query("select * from f_type where f_type_id='".$_GET['cid']."'");
						$rowc = mysql_fetch_array($resc);
						?>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการ <?=$rowc['f_type_name_en']?></h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=food_add&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>ตัวอย่างรูปภาพ</th>
								  <th>ชื่อ (title)</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from food where content_status!='discard' and f_type_id='".$_GET['cid']."' order by content_order asc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<?
								if($row['content_image']==""){
								?>
									<td class="center"><img src="../images/default-photo.png" width="50" height="50"></td>
									
								<?
								}else{?>
									<td class="center"><img src="../public/food/<?=$row['content_image']?>" width="50" height="50"></td>
								<? }?>
								
								<td class="center"><?=$row['content_title_en']?></td>
								<td><?=$row['content_order']?><a onclick="up(<?=$row['content_id']?>, <?=$row['content_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['content_id']?>, <?=$row['content_order']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['content_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['content_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['content_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<a class="btn btn-success" href="#" onclick="window.location='index.php?page=album&cid=<?=$_GET['cid']?>&fid=<?=$row['content_id']?>'">
										<i>album</i>  
									</a>
									<a class="btn btn-info" onclick="window.location='index.php?page=food_edit&cid=<?=$row['content_id']?>&cid2=<?=$_GET['cid']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['content_id']?>);"></i> 
									</a>
									<!--&nbsp;<a href="index.php?page=contentgallery&idx=<?=$row['content_id']?>"><i>แกลอรี</i></a>-->
								</td>
							</tr>
							<? }?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>