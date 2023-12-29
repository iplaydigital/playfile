<?php
	include("../include/checkuser.php");
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update f_type set status='discard' where f_type_id='".$_GET['idx']."' ");
			
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			mysql_query("update f_type set f_type_status='".$_GET['s']."' where f_type_id='".$_GET['idx']."' ");
		}
	}
	
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update f_type set f_type_order='".($_GET['ord']-1)."' where f_type_id='".$_GET['bid']."'");
			$res = mysql_query("select f_type_order, f_type_id from f_type where f_type_order='".($_GET['ord']-1)."' and f_type_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update f_type set f_type_order='".$_GET['ord']."' where f_type_id='".$row['f_type_id']."'");
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(f_type_order) as bo from f_type where f_type_status<>'discard'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update f_type set f_type_order='".($_GET['ord']+1)."' where f_type_id='".$_GET['bid']."'");
			
			$res = mysql_query("select f_type_order, f_type_id from f_type where f_type_order='".($_GET['ord']+1)."' and f_type_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update f_type set f_type_order='".$_GET['ord']."' where f_type_id='".$row['f_type_id']."'");
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=f_type&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show this content in your web site!!')==true){
			window.location = 'index.php?page=f_type&ch=1&idx='+id+'&s='+status;
		}
	}
	
	function up(bid, ord){
		window.location = 'index.php?page=f_type&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=f_type&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>Create WORK..</h2>
						<div class="box-icon">
							<span class="break"><a class="btn-setting" style='cursor:pointer' onclick="window.location='index.php?page=f_type_add';"><i class="icon-plus"></i>Add Data</a></span>
							<a href="#" class="btn-setting"><i class="icon-wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>#</th>
								  <th>Picture</th>
								  <th>ชื่อหมวดหมู่</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
							$res = mysql_query("select * from `f_type` where f_type_status!='discard' order by `f_type_order` asc");
							$i=0;
							while($row=mysql_fetch_array($res)){
							$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><? if($row['f_type_thumb']!=""){?><img width="100" height="100" src="../public/f_type/thumb/<?=$row['f_type_thumb']?>"><? }?></td>
								<td class="center"><?=$row['f_type_name_th']?> / <?=$row['f_type_name_en']?></td>
								<td><?=$row['f_type_order']?><a onclick="up(<?=$row['f_type_id']?>, <?=$row['f_type_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['f_type_id']?>, <?=$row['f_type_order']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['f_type_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['f_type_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['f_type_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=f_type_edit&idx=<?=$row['f_type_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['f_type_id']?>);"></i> 
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