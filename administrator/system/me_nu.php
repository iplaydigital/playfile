<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update menu set menu_status='discard' where menu_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update menu set menu_status='".$ss."' where menu_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update menu set menu_order='".($_GET['ord']-1)."' where menu_id='".$_GET['bid']."'");
			$res = mysql_query("select menu_order, menu_id from menu where menu_order='".($_GET['ord']-1)."' and menu_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update menu set menu_order='".$_GET['ord']."' where menu_id='".$row['menu_id']."'");
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(menu_order) as bo from menu where menu_status<>'discard'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update menu set menu_order='".($_GET['ord']+1)."' where menu_id='".$_GET['bid']."'");
			
			$res = mysql_query("select menu_order, menu_id from menu where menu_order='".($_GET['ord']+1)."' and menu_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update menu set menu_order='".$_GET['ord']."' where menu_id='".$row['menu_id']."'");
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=me_nu&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=me_nu&ch=1&idx='+id+'&s='+status;
		}
	}
	function up(bid, ord){
		window.location = 'index.php?page=me_nu&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=me_nu&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการเมนู</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=me_nu_add';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>ชื่อเมนู TH</th>
								  <th>ชื่อเมนู EN</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from menu where menu_status!='discard' order by menu_order asc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center">&nbsp;&nbsp;<?=$row['menu_title_th']?></td>
								<td class="center">&nbsp;&nbsp;<?=$row['menu_title_en']?></td>
								
								<td><?=$row['menu_order']?><a onclick="up(<?=$row['menu_id']?>, <?=$row['menu_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['menu_id']?>, <?=$row['menu_order']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['menu_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['menu_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['menu_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=me_nu_edit&idx=<?=$row['menu_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['menu_id']?>);"></i> 
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