<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update content_category set category_status='discard' where category_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update content_category set category_status='".$ss."' where category_id='".$_GET['idx']."' ");
		}
	}
	$where="";
	if($_GET['cid']){
		$where .= "and category_subid='".$_GET['cid']."'";
		$link = "&cid=".$_GET['cid'];
	}else{
		$where .= "and category_subid='0'";
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=category<?=$link?>&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=category<?=$link?>&ch=1&idx='+id+'&s='+status;
		}
	}
	
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการหมวดหมู่บทความ</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=category_add<?=$link?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>ลำดับ </th>
								  <th>ชื่อหมวดหมู่บทความ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								
								$res = mysql_query("select * from content_category where category_status!='discard' $where");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><?=$row['category_title_en']?>/<?=$row['category_title_th']?></td>
								
								<td class="center">
									<? if($row['category_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['category_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['category_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									
									<a class="btn btn-info" onclick="window.location='index.php?page=category_edit&idx=<?=$row['category_id']?><?=$link?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['category_id']?>);"></i> 
									</a>
									<a class="btn btn-success" style="cursor:pointer" onclick="window.location='index.php?page=category&cid=<?=$row['category_id']?>'">
										<i>จัดการหมวดหมู่ย่อย</i>  
									</a>
									<a class="btn btn-success" style="cursor:pointer" onclick="window.location='index.php?page=content&cid=<?=$row['category_id']?>'">
										<i>จัดการบทความ</i>  
									</a>
								</td>
							</tr>
							<? }?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>