<?php
	include("../include/checkuser.php");
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update slide set status='discard' where slide_id='".$_GET['idx']."' ");
			
		}
	}
	if($_GET['ch']==1){
		if($_GET['idx']){
			mysql_query("update slide set status='".$_GET['s']."' where slide_id='".$_GET['idx']."' ");
		}
	}
	
	if($_GET['upd']=="x1"){
		if($_GET['ord']>1){
			mysql_query("update slide set sorder='".($_GET['ord']-1)."' where slide_id='".$_GET['bid']."'");
			$res = mysql_query("select sorder, slide_id from slide where sorder='".($_GET['ord']-1)."' and slide_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update slide set sorder='".$_GET['ord']."' where slide_id='".$row['slide_id']."'");
		}
		
	}
	if($_GET['updx']=="x2"){
		$res_c = mysql_query("select MAX(sorder) as bo from slide where status<>'discard'");
		
		$row_c = mysql_fetch_array($res_c);
		$max = $row_c['bo'];
		if($_GET['ord']<$max){
			mysql_query("update slide set sorder='".($_GET['ord']+1)."' where slide_id='".$_GET['bid']."'");
			
			$res = mysql_query("select sorder, slide_id from slide where sorder='".($_GET['ord']+1)."' and slide_id!='".$_GET['bid']."'");
			$row = mysql_fetch_array($res);
			
			mysql_query("update slide set sorder='".$_GET['ord']."' where slide_id='".$row['slide_id']."'");
		}
		
	}
?>

<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=slide&c=1&idx='+id;
		}
	}
	function change_s(id, status){
		if(confirm('Do you want show this content in your web site!!')==true){
			window.location = 'index.php?page=slide&ch=1&idx='+id+'&s='+status;
		}
	}
	
	function up(bid, ord){
		window.location = 'index.php?page=slide&bid='+bid+'&upd=x1&ord='+ord;
	}
	function down(bid, ord){
		window.location = 'index.php?page=slide&bid='+bid+'&updx=x2&ord='+ord;
	}
</script>
	
	
	
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>Create Slide Picture..</h2>
						<div class="box-icon">
							<span class="break"><a class="btn-setting" style='cursor:pointer' onclick="window.location='index.php?page=slide_add';"><i class="icon-plus"></i>Add Data</a></span>
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
								  <th>VDO</th>
								  <th>Picture</th>
								  <th>Pic URL</th>
								  <th>ประเภทการแสดงผล</th>
								  <th>การจัดลำดับ</th>
								  <th>การแสดงผล</th>
								  <th>การจัดการ</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
							$res = mysql_query("select * from `slide` where status!='discard' order by `sorder` asc");
							$i=0;
							while($row=mysql_fetch_array($res)){
							$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><img src="http://img.youtube.com/vi/<?=$row['youtube']?>/1.jpg" alt=""></td>
								<td class="center"><img width="100" height="100" src="../public/slide/<?=$row['pics']?>"></td>
								
								
								<td class="center"><?=$row['url']?></td>
								<td class="center">
								<? if($row['type']==0){
									print "Picture";
								}else{
									print "VDO";
								}?>
								</td>
								<td><?=$row['sorder']?><a onclick="up(<?=$row['slide_id']?>, <?=$row['sorder']?>);" style="cursor:pointer"> ขึ้น </a> / <a onclick="down(<?=$row['slide_id']?>, <?=$row['sorder']?>);" style="cursor:pointer">ลง </a></td>
								<td class="center">
									<? if($row['status']=="approved"){?>
										<span class="label label-success" style="cursor:pointer" onclick="change_s(<?=$row['slide_id']?>, 0);">เปิดการแสดงผล</span>
									<? }else{ ?>
										<span class="label label-important" style="cursor:pointer" onclick="change_s(<?=$row['slide_id']?>, 1);">ปิดการแสดงผล</span>
									<? }?>
								</td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>-->
									<a class="btn btn-info" onclick="window.location='index.php?page=slide_edit&idx=<?=$row['slide_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['slide_id']?>);"></i> 
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