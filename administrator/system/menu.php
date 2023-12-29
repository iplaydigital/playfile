	<div class="span2 main-menu-span">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="index.php?page=home"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> Change Password</span></a></li>
						<!--<li><a href="index.php?page=me_nu"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> Menu</span></a></li>-->
						<li><a href="index.php?page=slide"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> SLIDE </span></a></li>
						<!--<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify icon-white"></i><span class="hidden-tablet"> &nbsp;HERITAGE</span></a>
							<ul>
								<li><a class="submenu" href="index.php?page=vdo"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> HERITAGE</span></a></li>
								<li><a class="submenu" href="index.php?page=hslide"><i class="fa-icon-file-alt"></i><span class="hidden-tablet">Slide</span></a></li>
								<li><a class="submenu" href="index.php?page=vdo_album"><i class="fa-icon-file-alt"></i><span class="hidden-tablet">Album</span></a></li>
							</ul>	
						</li>
						<li><a href="index.php?page=upload"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> Upload Picture</span></a></li>
						<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify icon-white"></i><span class="hidden-tablet"> &nbsp;SPICY PRODUCTS</span></a>
							<ul>
								<li><a class="submenu" href="index.php?page=productcategory"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> รายการหมวดหมู่สินค้า</span></a></li>
								<?
								$res = mysql_query("select * from product_category where category_subid='0' and category_status='approved' order by category_order asc");
								while($row = mysql_fetch_array($res)){
								?>
								<li><a class="submenu" href="index.php?page=product&cid=<?=$row['category_id']?>"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"><?=$row['category_title_th']?></span></a></li>
								<?
								 $res2 = mysql_query("select * from product_category where category_subid='".$row['category_id']."' and category_status!='discard' order by category_id asc");
								 while($row2 = mysql_fetch_array($res2)){
								 ?>
								 <li><a class="submenu" href="index.php?page=product&cid=<?=$row2['category_id']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<span class="hidden-tablet"><?=$row2['category_title_th']?></span></a></li>
								 <?
								 }
								}
								?>
							</ul>	
						</li>-->
						
						<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify icon-white"></i><span class="hidden-tablet"> &nbsp;WORK</span></a>
							<ul>
								<li><a class="submenu" href="index.php?page=f_type"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> รายการหมวด WORK</span></a></li>
								<?
								$res = mysql_query("select * from f_type where f_type_status='approved' order by f_type_order asc");
								while($row = mysql_fetch_array($res)){
								?>
								<li><a class="submenu" href="index.php?page=food&cid=<?=$row['f_type_id']?>"><i>    - </i><span class="hidden-tablet"><?=$row['f_type_name_th']?></span></a></li>
								<?
								}
								?>
							</ul>	
						</li>
						<!--<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify icon-white"></i><span class="hidden-tablet"> &nbsp;Banner</span></a>
							<ul>
								<li><a class="submenu" href="index.php?page=banner_category"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> Banner Category</span></a></li>
								<?
								$res = mysql_query("select * from banner_category where category_status='approved' order by category_id asc");
								while($row = mysql_fetch_array($res)){
								?>
								<li><a class="submenu" href="index.php?page=banner&cid=<?=$row['category_id']?>"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> หมวด "<?=$row['category_title_en']?>"</span></a></li>
								
								<?
								}
								?>
							</ul>	
						</li>-->
						
						
						
						<!--<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify icon-white"></i><span class="hidden-tablet">  บทความ </span></a>
							<ul>
								<li><a class="submenu" href="index.php?page=category"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> หมวดหมู่บทความ</span></a></li>
								<?
								$res = mysql_query("select * from content_category where category_status='approved' order by category_id asc");
								while($row = mysql_fetch_array($res)){
								?>
								<li><a class="submenu" href="index.php?page=content&cid=<?=$row['category_id']?>"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> หมวด "<?=$row['category_title_en']?>"</span></a></li>
								
								<?
								}
								?>
							</ul>	
							
						</li>-->
						<?
						$res = mysql_query("select * from content_category where category_status='approved' order by category_id asc");
						while($row = mysql_fetch_array($res)){
						?>
						<!--<li><a href="index.php?page=content&cid=3"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> แนะนำร้านอาหาร</span></a></li>-->
						<?
						}
						?>
						<!--<li><a href="index.php?page=content&cid=1"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> เมนูอาหาร</span></a></li>
						<li><a href="index.php?page=news"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> HALL OF FAME</span></a></li>
						<li><a href="index.php?page=content"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> SELECTED</span></a></li>
						<!--<li><a href="index.php?page=recipe"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> Recipe</span></a></li>-->
						<!--
						<li>
							<a class="dropmenu" href="#"><i class="icon-align-justify icon-white"></i><span class="hidden-tablet"> การจัดการหมวดหมู่อาหาร</span></a>
							<ul>
								<li><a class="submenu" href="index.php?page=ftype"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"> รายการหมวดหมู่อาหาร</span></a></li>
								<?
								$res = mysql_query("select * from product_category where category_subid='0' and category_status='approved' order by category_order asc");
								while($row = mysql_fetch_array($res)){
								?>
								<li><a class="submenu" href="index.php?page=product&cid=<?=$row['category_id']?>"><i class="fa-icon-file-alt"></i><span class="hidden-tablet"><?=$row['category_title_th']?></span></a></li>
								<?
								 $res2 = mysql_query("select * from product_category where category_subid='".$row['category_id']."' and category_status!='discard' order by category_id asc");
								 while($row2 = mysql_fetch_array($res2)){
								 ?>
								 <li><a class="submenu" href="index.php?page=product&cid=<?=$row2['category_id']?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;<span class="hidden-tablet"><?=$row2['category_title_th']?></span></a></li>
								 <?
								 }
								}
								?>
							</ul>
						</li>
						
						
						<li><a href="index.php?page=faq"><i class="fa-icon-folder-close-alt"></i><span class="hidden-tablet"> FAQ </span></a></li>-->
						
					</ul>
				</div><!--/.well -->
			</div><!--/span-->