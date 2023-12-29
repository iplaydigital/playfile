<section class="paragraphHome">
<section class="container">
	<header>
    	<?
		$res = mysql_query("select * from f_type where f_type_id='".$_GET['id']."'");
		$row = mysql_fetch_array($res);
		?>
    	<div class="top">
        	<?=$row['f_type_name_en']?>
        </div>
        <div class="bottom">
        	Unlock your digital experience with us
        </div>
    </header>
    <nav class="navigator">
    	<a href="index.php?page=category&cid=<?=$_GET['cid']?>">
        	Back
        </a>
    </nav>
    <section class="paragraphDetail">
        <section class="pageDetail">
            <section class="contentDetail">
                <article>
					<?
					$res = mysql_query("select * from food where content_id='".$_GET['id']."' and content_status='approved'");
					$row = mysql_fetch_array($res);
					?>
                    <div class="title"><?=$row['content_title_en']?></div>
                    <div class="detail">
                        <?=html_entity_decode($row['content_desc_en'])?>            	
                    </div> 
                    <div class="link">
                        <strong>Link</strong> <br>
                        <a href="<?=$row['content_url']?>" target="_blank">
                            <?=$row['content_url']?>
                        </a>
                    </div>           
                </article>
            </section>
            <section class="galleryDetail">

            	<ul>
					<?
					$res = mysql_query("select * from album where category_id='".<?=$row['content_id']?>."' and album_status='approved' order by album_order asc");
					if(mysql_num_rows($resa)!=0){
						while($row = mysql_fetch_array($res)){					
						?>
						<li>
							<a class="fancybox" href="public/food/album/<?=$row['album_cover']?>" data-fancybox-group="gallery" title="">
								<img alt="" title="" src="public/food/album/<?=$row['album_cover']?>">
							</a>
						</li>
						<?
						}
					}
					?>
                    
                </ul>
            </section>
            
        </section>
    </section>
    
</section>
</section>