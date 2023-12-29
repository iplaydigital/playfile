<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['pvid']){
			mysql_query("update pvdo set pvdo_status='discard' where pvdo_id='".$_GET['pvid']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['pvid']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update pvdo set pvdo_status='".$ss."' where pvdo_id='".$_GET['pvid']."' ");
		}
	}
	
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=pvdo&c=1&cid=<?=$_GET['cid']?>&idx=<?=$_GET['idx']?>&pvid='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=pvdo&ch=1&cid=<?=$_GET['cid']?>&idx=<?=$_GET['idx']?>&pvid='+id+'&s='+status;
		}
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการวิดีโอ</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=product&cid=<?=$_GET['cid']?>';">ย้อนกลับ</a><a href="#" class="btn-setting" onclick="window.location='index.php?page=pvdo_add&cid=<?=$_GET['cid']?>&idx=<?=$_GET['idx']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								$res = mysql_query("select * from pvdo where product_id='".$_GET['idx']."' and pvdo_status!='discard' order by pvdo_id desc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><img src="http://img.youtube.com/vi/<?=$row['pvdo_value']?>/1.jpg" alt=""></td>
								<td class="center"><?=$row['pvdo_title']?></td>
								<td class="center">
									<? if($row['pvdo_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['pvdo_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['pvdo_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=pvdo_edit&cid=<?=$_GET['cid']?>&idx=<?=$_GET['idx']?>&pvid=<?=$row['pvdo_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['pvdo_id']?>);"></i> 
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