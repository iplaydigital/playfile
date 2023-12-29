<?php
	include("../include/checkuser.php");
	
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update news_album set album_status='discard' where album_id='".$_GET['idx']."' ");
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			if($_GET['s']==1){ $ss = "approved";}else{ $ss = "pending";} 
			mysql_query("update news_album set album_status='".$ss."' where album_id='".$_GET['idx']."' ");
		}
	}
	
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update news_album set album_order='".($_GET['ord']-1)."' where album_id='".$_GET['bid']."' and category_id='".$_GET['nid']."'");
			$res = mysql_query("select album_order, album_id from news_album where album_order='".($_GET['ord']-1)."' and album_id!='".$_GET['bid']."' and category_id='".$_GET['nid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update news_album set album_order='".$_GET['ord']."' where album_id='".$row['album_id']."' and category_id='".$_GET['nid']."'");
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(album_order) as bo from news_album where album_status<>'discard' and category_id='".$_GET['nid']."'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update news_album set album_order='".($_GET['ord']+1)."' where album_id='".$_GET['bid']."' and category_id='".$_GET['nid']."'");
			
			$res = mysql_query("select album_order, album_id from news_album where album_order='".($_GET['ord']+1)."' and album_id!='".$_GET['bid']."' and category_id='".$_GET['nid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update news_album set album_order='".$_GET['ord']."' where album_id='".$row['album_id']."' and category_id='".$_GET['nid']."'");
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=news_album&nid=<?=$_GET['nid']?>&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show or hide this content!!')==true){
			window.location = 'index.php?page=news_album&nid=<?=$_GET['nid']?>&ch=1&idx='+id+'&s='+status;
		}
	}
	
	function up(bid, ord){
		window.location = 'index.php?page=news_album&nid=<?=$_GET['nid']?>&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=news_album&nid=<?=$_GET['nid']?>&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>รายการภาพ HALL OF FRAME</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting" onclick="window.location='index.php?page=news&cid=<?=$_GET['cid']?>';"><i class="icon-plus"></i>ย้อนกลับ</a>
							<span class="break">
							<a href="#" class="btn-setting" onclick="window.location='index.php?page=news_album_add&nid=<?=$_GET['nid']?>';"><i class="icon-plus"></i>เพิ่มข้อมูล</a></span>
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
								  <th>รูปภาพ</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from news_album where album_status!='discard' and category_id='".$_GET['nid']."' order by album_order asc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><? if($row['album_cover']!=NULL){?><img src="../public/news/album/<?=$row['album_cover']?>" width="188" height="103"><? }?></td>
								<td><?=$row['album_order']?><a onclick="up(<?=$row['album_id']?>, <?=$row['album_order']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['album_id']?>, <?=$row['album_order']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['album_status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['album_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['album_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=news_album_edit&idx=<?=$row['album_id']?>&nid=<?=$_GET['nid']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['album_id']?>);"></i> 
									</a>
									<!--<a class="btn btn-success" href="index.php?page=gallery&alb=<?=$row['album_id']?>">
										จัดการแกลอรี  
									</a>-->
								</td>
							</tr>
							<? }?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>