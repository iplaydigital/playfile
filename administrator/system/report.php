<?php
	include("../include/checkuser.php");
	if($_GET['c']==1){
		if($_GET['idx']){
			mysql_query("update checkin set checkin_status='discard' where checkin_id='".$_GET['idx']."' ");
		}
	}
?>
<script>
	function del_row(id){
		if(confirm('Do you want to delete!!')==true){
			window.location = 'index.php?page=report&c=1&idx='+id;
		}
	}
</script>
	<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-tasks"></i><span class="break"></span>Checkin Report</h2>
						<div class="box-icon">
							<span class="break"><a href="#" class="btn-setting" onclick="#"><i class="icon-plus"></i>Add Data</a></span>
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
								  <th>Emp_code</th>
								  <th>name surname</th>
								  <th>Date (Y-m-d)</th>
								  <th>Time_in (H:i:s)</th>
								  <th>Time_out(H:i:s)</th>
								  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
							<?
								$i=0;
								$res = mysql_query("select * from employee inner join checkin on checkin.emp_code=employee.emp_code where checkin_status!='discard' order by checkin_id desc");
								while($row = mysql_fetch_array($res)){
								$i++;
							?>
							<tr>
								<td class="center"><?=$i?></td>
								<td class="center"><?=$row['emp_code']?></td>
								<td class="center"><?=$row['emp_name']?></td>
								<td class="center"><?=$row['date']?></td>
								<td class="center"><?=$row['time_in']?></td>
								<td class="center"><?=$row['time_out']?></td>
								<td class="center">
									<!--<a class="btn btn-success" href="#">
										<i class="icon-zoom-in icon-white"></i>  
									</a>
									<a class="btn btn-info" onclick="window.location='index.php?page=employee_edit&idx=<?=$row['emp_id']?>'">
										<i class="icon-edit icon-white"></i>  
									</a>-->
									<a class="btn btn-danger" href="#">
										<i class="icon-trash icon-white" onclick="del_row(<?=$row['checkin_id']?>);"></i> 
									</a>
									<!--<a class="btn btn-success" href="#">เบิกจ่ายล่วงหน้า</a>
									<a class="btn btn-success" href="#">ซื้อของ</a>-->
								</td>
							</tr>
							<? }?>
							
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
			<hr>
			