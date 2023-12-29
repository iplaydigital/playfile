
<section class="paragraphHome">

	<section id="slide-banner-detail">
		<div class='slide-banner-center-detail slideForMain'>

			<?
			$res = mysql_query("select * from food where content_id='".$_GET['id']."' and content_status='approved'");
			$row = mysql_fetch_array($res);
			$resa = mysql_query("select * from album where category_id='".$row['content_id']."' and album_status='approved' order by album_order asc");
			if(mysql_num_rows($resa)!=0){
				while($rowa = mysql_fetch_array($resa)){
				?>
				<div class="item">
                	<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(public/food/album/<?=$rowa['album_cover']?>);"/></div>
				</div>
				<?
				}
			}
			?>

		</div>
	</section>

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
                    <?php if(!empty($row['content_url'])): ?>
                    	<div class="link">
	                        <strong>Link</strong> <br>
	                        <a href="<?=$row['content_url']?>" target="_blank">
	                            <?=$row['content_url']?>
	                        </a>
	                    </div>
                    <?php endif; ?>
                </article>
            </section>
            <section class="galleryDetail">

            	<ul>
	            	<?php if(!empty($row['content_vdo_en'])): ?>
	            	<li>
                    	<a class="fancybox-media" href="http://www.youtube.com/watch?v=<?=$row['content_vdo_en']?>">
                        	<img alt="" title="" src="public/food/<?=$row['content_image']?>">
                            <div class="iconPlay"></div>
                        </a>

                    </li>
                    <?php endif; ?>
					<?
					$resa = mysql_query("select * from album where category_id='".$row['content_id']."' and album_status='approved' order by album_order asc");
					if(mysql_num_rows($resa)!=0){
						while($rowa = mysql_fetch_array($resa)){
						?>
						<li>
							<a class="fancybox" href="public/food/album/<?=$rowa['album_cover']?>" data-fancybox-group="gallery" title="">
								<img alt="" title="" src="public/food/album/<?=$rowa['album_cover']?>">
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


<style>

.navbar-wrapper {
    left: 0;
    position: relative;
    right: 0;
    top: 0;
    z-index: 20;
}

#slide-banner-detail {
    margin-top: 10px;
    z-index: 1;
}

#slide-banner-detail .slide-control {
    left: 0;
    margin-top: -20px;
    position: absolute;
    top: 50%;
    width: 100%;
}
.slide-control {
    bottom: 0;
    margin: 0;
    padding: 0;
    position: absolute;
    right: 0;
    width: 81px;
    z-index: 19;
}
.slick-slide {
    padding-right: 10px;
}

.slide-banner-center-detail img {
    opacity: 0.3;
    transition: all 300ms ease 0s;
}

.slide-banner-center-detail .slick-center img {
    border: medium none;
    opacity: 1;
}

.slide-control .prev::before, .slide-control .next::before {
    transform: translate(-50%, -50%) rotate(-45deg);
}
.up-arrow::before, .slide-control .prev::before, .slide-control .prev::after {
    transform-origin: 2px center 0;
}
.up-arrow::before, .up-arrow::after, .slide-control .prev::before, .slide-control .prev::after, .slide-control .next::before, .slide-control .next::after {
    background-color: #3f3f3f;
    content: "";
    height: 4px;
    left: 50%;
    position: absolute;
    top: 50%;
    width: 18px;
}
</style>

<script type='text/javascript'>

	$(document).ready(function() {

		var widthres = $(window).width();

		$('.slide-banner-center-detail').slick({
			lazyLoad: 'ondemand',
			  centerMode: true,
			  centerPadding: '60px',
			  slidesToShow: 1,
			  slidesToScroll: 1,
			  variableWidth: true,
			  autoplay: true,
			  autoplaySpeed: 3000,
			  speed: 800,
			  prevArrow: jQuery('#slide-banner-detail .slide-control .prev'),
			  nextArrow: jQuery('#slide-banner-detail .slide-control .next'),
			  responsive: [
				{
				  breakpoint: 768,
				  settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 3
				  }
				},
				{
				  breakpoint: 480,
				  settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 1
				  }
				}
			  ]
		});
	});

</script>
