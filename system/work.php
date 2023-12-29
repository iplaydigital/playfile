<section class="paragraphHome">
<section class="container">
	<header>
    	<div class="top">
        	WORK
        </div>
        <div class="bottom">
        	...
        </div>
    </header>
    <section class="pagePortFolioHome">
    	<ul>
			<? 
			$res = mysql_query("select * from food where f_type_id='1' and content_status='approved' order by content_order asc limit 0,3");
			while($row = mysql_fetch_array($res)){
			?>
        	<li>
            	<a href="index.php?page=detail-work&id=<?=$row['content_id']?>&cid=1">
                	<section class="boxPort">
                    	<figure style="background-image:url(public/food/<?=$row['content_image']?>);">
                        	<img alt="" title="" src="images/spaceQuadrate.png">
                        </figure> 
                        <article>
                        	<div class="name"><?=$row['content_title_en']?></div>
                            <div class="discription">
                            	<?=html_entity_decode($row['content_sdesc_en'])?>
                            </div>
                            <nav>
                            	More
                            </nav>
                        </article>
                    </section>
                </a>
            </li>
			<? }?> 
            <? 
			$res = mysql_query("select * from food where f_type_id='2' and content_status='approved' order by content_order asc limit 0,3");
			while($row = mysql_fetch_array($res)){
			?>
        	<li>
            	<a href="index.php?page=detail-workVDO&id=<?=$row['content_id']?>&cid=2">
                	<section class="boxPort">
                    	<figure style="background-image:url(public/food/<?=$row['content_image']?>);">
                        	<img alt="" title="" src="images/spaceQuadrate.png">
                        </figure>
                        <article>
                        	<div class="name"><?=$row['content_title_en']?></div>
                            <div class="discription">
                            	<?=html_entity_decode($row['content_sdesc_en'])?>
                            </div>
                            <nav>
                            	More
                            </nav>
                        </article>
                    </section>
                </a>
            </li>
			<? }?>    
			<? 
			$res = mysql_query("select * from food where f_type_id='3' and content_status='approved' order by content_order asc limit 0,3");
			while($row = mysql_fetch_array($res)){
			?>
        	<li>
            	<a href="index.php?page=detail-work&id=<?=$row['content_id']?>&cid=3">
                	<section class="boxPort">
                    	<figure style="background-image:url(public/food/<?=$row['content_image']?>);">
                        	<img alt="" title="" src="images/spaceQuadrate.png">
                        </figure>
                        <article>
                        	<div class="name"><?=$row['content_title_en']?></div>
                            <div class="discription">
                            	<?=html_entity_decode($row['content_sdesc_en'])?>
                            </div>
                            <nav>
                            	More
                            </nav>
                        </article>
                    </section>
                </a>
            </li>
			<? }?> 	
			<? 
			$res = mysql_query("select * from food where f_type_id='4' and content_status='approved' order by content_order asc limit 0,3");
			while($row = mysql_fetch_array($res)){
			?>
        	<li>
            	<a href="index.php?page=detail-work&id=<?=$row['content_id']?>&cid=4">
                	<section class="boxPort">
                    	<figure style="background-image:url(public/food/<?=$row['content_image']?>);">
                        	<img alt="" title="" src="images/spaceQuadrate.png">
                        </figure>
                        <article>
                        	<div class="name"><?=$row['content_title_en']?></div>
                            <div class="discription">
                            	<?=html_entity_decode($row['content_sdesc_en'])?>
                            </div>
                            <nav>
                            	More
                            </nav>
                        </article>
                    </section>
                </a>
            </li>
			<? }?> 
        </ul>
    </section>
</section>
</section>