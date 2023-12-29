<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update content set content_status='discard' where content_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update content set content_status='".$ss."' where content_id='".$_GET['idx']."' ");
		}
	}
	
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=recipe&c=1&cid=<?=$_GET['cid']?>&rid=<?=$_GET['rid']?>&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=recipe&cid=<?=$_GET['cid']?>&rid=<?=$_GET['rid']?>&ch=1&idx='+id+'&s='+status;
		}
	}
	
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการบทความ</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=product&cid=<?=$_GET['cid']?>';">ย้อนกลับ</a><a href="#" class="btn-setting" onclick="window.location='index.php?page=recipe_add&rid=<?=$_GET['rid']?>&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>ชื่อบทความ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from content where content_status!='discard' and product_id='".$_GET['rid']."' order by content_id desc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><? if($row['content_thumbnail']!=""){?><img src="../public/content/<?=$row['content_thumbnail']?>" width="50" height="50"><? }?></td>
								<td class="center"><?=$row['content_title_th']?></td>
								
								<td class="center">
									<? if($row['content_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['content_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['content_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									
									<a class="btn btn-info" onclick="window.location='index.php?page=recipe_edit&rid=<?=$_GET['rid']?>&cid=<?=$_GET['cid']?>&idx=<?=$row['content_id']?>'">
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