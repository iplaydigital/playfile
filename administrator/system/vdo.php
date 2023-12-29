<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update vdo set vdo_status='discard' where vdo_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update vdo set vdo_status='".$ss."' where vdo_id='".$_GET['idx']."' ");
		}
	}
	
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=vdo&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=vdo&ch=1&idx='+id+'&s='+status;
		}
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการ Heritage</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=vdo_add';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>รูปตัวอย่าง</th>
								  <th>รายการ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from vdo where vdo_status!='discard' order by vdo_id desc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><img src="http://img.youtube.com/vi/<?=$row['vdo_value_th']?>/1.jpg" alt=""></td>
								<td class="center"><?=$row['vdo_title_th']?></td>
								<td class="center">
									<? if($row['vdo_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['vdo_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['vdo_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#" onclick="window.location='index.php?page=vdo_album&nid=<?=$row['vdo_id']?>'">
										<i>album</i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=vdo_edit&idx=<?=$row['vdo_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['vdo_id']?>);"></i> 
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