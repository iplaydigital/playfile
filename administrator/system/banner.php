<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			//mysql_query("delete from banner where banner_id='".$_GET['idx']."'");
			mysql_query("update banner set banner_status='discard' where banner_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update banner set banner_status='".$ss."' where banner_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update banner set banner_order='".($_GET['ord']-1)."' where banner_id='".$_GET['bid']."'");
			//print "update banner set banner_order='".($_GET['ord']-1)."' where banner_id='".$_GET['bid']."'";
			
			$res = mysql_query("select banner_order, banner_id from banner where banner_order='".($_GET['ord']-1)."' and banner_id!='".$_GET['bid']."' and category_id='".$_GET['cid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update banner set banner_order='".$_GET['ord']."' where banner_id='".$row['banner_id']."'");
			//print "update banner set banner_order='".$_GET['ord']."' where banner_id='".$row['banner_id']."'";
		}
		
		
	}
	if($_GET['upd']=="x2"){
		$res_c = mysql_query("select MAX(banner_order) as bo from banner where banner_status<>'discard' and category_id='".$_GET['cid']."'");
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		
		if($_GET['ord']<$max){
			mysql_query("update banner set banner_order='".($_GET['ord']+1)."' where banner_id='".$_GET['bid']."'");
			//print "update banner set banner_order='".($_GET['ord']+1)."' where banner_id='".$_GET['bid']."'";
			
			$res = mysql_query("select banner_order, banner_id from banner where banner_order='".($_GET['ord']+1)."' and banner_id!='".$_GET['bid']."' and category_id='".$_GET['cid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update banner set banner_order='".$_GET['ord']."' where banner_id='".$row['banner_id']."'");
			//print "update banner set banner_order='".$_GET['ord']."' where banner_id='".$row['banner_id']."'";
		}
		/*$res = mysql_query("select banner_order from banner where category_id='".$_GET['cid']."' and banner_id='".$_GET['bid']."'");
		$row = mysql_fetch_array($res);
		$mat = $row['banner_order']+1;
		
		$res_c = mysql_query("select MAX(banner_order) as bo from banner where banner_status<>'discard' and category_id='".$_GET['cid']."'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		
		if($mat>=$max){ $mat= $max ;}
		
		mysql_query("update banner set banner_order='".$row['banner_order']."' where category_id='".$_GET['cid']."' and banner_order='".$mat."'");
		
		mysql_query("update banner set banner_order='".$mat."' where category_id='".$_GET['cid']."' and banner_id='".$_GET['bid']."'");*/
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=banner&cid=<?=$_GET['cid']?>&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=banner&cid=<?=$_GET['cid']?>&ch=1&idx='+id+'&s='+status;
		}
	}
	function up(bid, ord){
		window.location = 'index.php?page=banner&cid=<?=$_GET['cid']?>&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=banner&cid=<?=$_GET['cid']?>&bid='+bid+'&upd=x2&ord='+ord;
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการแบนเนอร์</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="window.location='index.php?page=banner_add&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>ตัวอย่าง</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from banner where category_id='".$_GET['cid']."' and banner_status!='discard' order by banner_order asc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center">
									<? if($row['banner_value']!=""){?>
									<img src="../public/banner/<?=$row['banner_value']?>" width="200" height="80">
									<? }?>
								</td>
								<td><?=$row['banner_order']?><a onclick="up(<?=$row['banner_id']?>, <?=$row['banner_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['banner_id']?>, <?=$row['banner_order']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['banner_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['banner_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['banner_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=banner_edit&cid=<?=$_GET['cid']?>&idx=<?=$row['banner_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['banner_id']?>);"></i> 
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