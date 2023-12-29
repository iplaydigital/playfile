<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update faq set faq_status='discard' where faq_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update faq set faq_status='".$ss."' where faq_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update faq set faq_order='".($_GET['ord']-1)."' where faq_id='".$_GET['bid']."'");
			$res = mysql_query("select faq_order, faq_id from faq where faq_order='".($_GET['ord']-1)."' and faq_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update faq set faq_order='".$_GET['ord']."' where faq_id='".$row['faq_id']."'");
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(faq_order) as bo from faq where faq_status<>'discard'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update faq set faq_order='".($_GET['ord']+1)."' where faq_id='".$_GET['bid']."'");
			
			$res = mysql_query("select faq_order, faq_id from faq where faq_order='".($_GET['ord']+1)."' and faq_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update faq set faq_order='".$_GET['ord']."' where faq_id='".$row['faq_id']."'");
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=faq&c=1&cid=<?=$_GET['cid']?>&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=faq&cid=<?=$_GET['cid']?>&ch=1&idx='+id+'&s='+status;
		}
	}
	function up(bid, ord){
		window.location = 'index.php?page=faq&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=faq&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการ  (Frequently Asked Questions: FAQ)</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=faq_add&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>คำถาม</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from faq where faq_status!='discard' order by faq_order asc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><? if($row['faq_thumb']!=""){?><img src="../public/faq/thumb/<?=$row['faq_thumb']?>" width="50" height="50"><? }?></td>
								<td class="center"><?=$row['faq_title_th']?></td>
								<td><?=$row['faq_order']?><a onclick="up(<?=$row['faq_id']?>, <?=$row['faq_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['faq_id']?>, <?=$row['faq_order']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['faq_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['faq_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['faq_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									
									<a class="btn btn-info" onclick="window.location='index.php?page=faq_edit&cid=<?=$row['faq_id']?>&cid2=<?=$row['faq_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['faq_id']?>);"></i> 
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