<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update news set news_status='discard' where news_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update news set news_status='".$ss."' where news_id='".$_GET['idx']."' ");
		}
	}
	
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=news&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this news!!')==true){
			window.location = 'index.php?page=news&ch=1&idx='+id+'&s='+status;
		}
	}
	
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการ HALL OF FRAME</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=news_add&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								$res = mysql_query("select * from news where news_status!='discard' order by news_id desc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><? if($row['news_tbm1']!=""){?><img src="../public/news/<?=$row['news_tbm1']?>" width="50" height="50"><? }?></td>
								<td class="center"><?=$row['news_title_th']?></td>
								
								<td class="center">
									<? if($row['news_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['news_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['news_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									
									<a class="btn btn-info" onclick="window.location='index.php?page=news_edit&cid=<?=$row['news_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['news_id']?>);"></i> 
									</a>
									<!--&nbsp;<a href="index.php?page=contentgallery&idx=<?=$row['news_id']?>"><i>แกลอรี</i></a>-->
								</td>
							</tr>
							<? }?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>