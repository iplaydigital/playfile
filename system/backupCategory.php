<section class="paragraphHome">
<section class="container">
	<header>
		<?
		$res = mysql_query("select * from f_type where f_type_id='".$_GET['cid']."'");
		$row = mysql_fetch_array($res);
		?>
    	<div class="top">
        	<?=$row['f_type_name_en']?>
        </div>
        <div class="bottom">
        	Unlock your digital experience with us
        </div>
    </header>
    <section class="pagePortFolioHome">
    	<ul>
        	<? 
			$res = mysql_query("select * from food where f_type_id='".$_GET['cid']."' and content_status='approved' order by content_order asc ");
			while($row = mysql_fetch_array($res)){
			?>
        	<li>
				<? if($_GET['cid']=='2'){
					?><a href="index.php?page=detail-workVDO&id=<?=$row['content_id']?>&cid=<?=$_GET['cid']?>"><?
				}else{ ?>
					<a href="index.php?page=detail-work&id=<?=$row['content_id']?>&cid=<?=$_GET['cid']?>">
				<? }?>
                	<section class="boxPort">
                    	<figure style="background-image:url(public/food/<?=$row['content_image']?>);">
                        	<img alt="" title="" src="images/spaceQuadrate.png">
                        </figure>
                        <article>
                        	<div class="name"><?=$row['content_title_en']?></div>
                            <div class="discription">
                            	<?=html_entity_decode($row['content_desc_en'])?>
                            </div>
                            <nav>
                            	More
                            </nav>
                        </article>
                    </section>
                </a>
            </li>
			<? 
			}?> 
                       
        </ul>
    </section>
</section>
</section>