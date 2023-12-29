<section class="paragraphHome">

<!--
<section id="slide-banner-detail">
	<div class='slide-banner-center-detail slideForMain'>
		<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(images/slideMain/Cellox.jpg);"/></div>
		<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(images/slideMain/dm_1.gif);"/></div>
		<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(images/slideMain/KS.png);"/></div>
		<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(images/slideMain/Singha.png);"/></div>
		<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(images/slideMain/sriraja_web1.png);"/></div>
		<div class="item"><img src='images/space600x450.png' alt="" class='img img-responsive img-center' style="background-image:url(images/slideMain/YY.png);"/></div>
	</div>
</section>
-->

<section class="container">
	<header>
    	<div class="top">
        	Turn on our ideas, Let's play to win
        </div>
        <div class="bottom">
        	Unlock your digital experience with us
        </div>

<div>
<iframe width="100%" height="600" src="https://www.youtube.com/embed/sOUuPwDTE0s?si=VdSssTckl5t-C5pG?rel=0" title="Play Digital Showreel" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope;" allowfullscreen></iframe>
</div>


    </header>






    <section class="pagePortFolioHome">


    	<ul>
			<?
			$resc = mysql_query("select * from f_type where f_type_status='approved' order by f_type_order asc");
			while($rowc = mysql_fetch_array($resc)){
			if($rowc['f_type_id']!=2){
				$res = mysql_query("select * from food where f_type_id='".$rowc['f_type_id']."' and content_status='approved' order by content_order asc limit 0,2");
				while($row = mysql_fetch_array($res)){
				?>
				<li>
					<a href="index.php?page=detail-work&id=<?=$row['content_id']?>&cid=<?=$rowc['f_type_id']?>">
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
				<? }
			}else{?>
				<?
				$res = mysql_query("select * from food where f_type_id='".$rowc['f_type_id']."' and content_status='approved' order by content_order asc limit 0,12");
				while($row = mysql_fetch_array($res)){
				?>
				<li>
					<a href="index.php?page=detail-work&id=<?=$row['content_id']?>&cid=<?=$rowc['f_type_id']?>">
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
				<? }
			}
			}?>

        </ul>
    </section>
</section>
</section>
<section class="pageAbout" id="about">
<section class="container">
	<header >
    	<div class="top">
        	about
        </div>
        <div class="bottom">
        	A Total Digital Driven Experience!
        </div>
    </header>
    <article class="pageContent">
    	<p>
        	We offer ways to maximize success in every area of your business by providing you with what it takes to effectively engage
in digital commerce with A Total Digital Driven Experience! from start to finish and everything in between to create,
market and manage all your digital needs.
        </p>
    </article>
   	<section class="pageAbout2">
    	<header id="about">
		<div class="top">
    Play's Rules
</div>
        </header>
        <section class="contentAbout2">
        	<ul>
            	<li>
                	<section>
                    	<figure>
                        	<img alt="" title="" src="images/picAbout1.png">
                        </figure>
                        <article>
                        	<strong>Top form players</strong> <br>
                            Top form players are among the most skilled and outstanding players.
                        </article>
                    </section>
                </li>
                <li>
                	<section>
                    	<figure>
                        	<img alt="" title="" src="images/picAbout2.png">
                        </figure>
                        <article>
                        	<strong>Winning Strategies</strong> <br>
                            Discover effective strategies for success, improve your skills, and achieve victory in various situations.
						</article>
                    </section>
                </li>
                <li>
                	<section>
                    	<figure>
                        	<img alt="" title="" src="images/picAbout3.png">
                        </figure>
                        <article>
                        	<strong>Teamwork</strong> <br>
							Enhance collaboration, communication, and coordination to achieve greater efficiency and success in various endeavors.
						</article>
                    </section>
                </li>
                <li>
                	<section>
                    	<figure>
                        	<img alt="" title="" src="images/picAbout4.png">
                        </figure>
                        <article>
                        	<strong>Aim high scores</strong> <br>
							Aspire to achieve high scores and aim for excellence in your endeavors.
						</article>
                    </section>
                </li>
            </ul>
        </section>
    </section>

</section>
</section>

<section class="pageService" id="service">
<section class="container">
	<header>
    	<div class="top">
        	Services
        </div>
        <div class="bottom">
        	Communicate through Digital-Based media with strategic ideas
        </div>
    </header>
    <section class="blogService">
    	<ul>
        	<li>
            	<figure>
                	<img alt="" title="" src="images/iconservice01.png">
                </figure>
                <article>
                	Website Design<br>
					& Development
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice02.png">
                </figure>
                <article>
                	E-Commerce<br>
					Online Shopping
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice03.png">
                </figure>
                <article>
                	E-CRM<br>
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice04.png">
                </figure>
                <article>
                	Mobile<br>
                    Application
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice05.png">
                </figure>
                <article>
                	Facebook<br>
                    Application
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice06.png">
                </figure>
                <article>
                	Fanpage<br>
                    Management
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice07.png">
                </figure>
                <article>
                	Viral Campaign
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice08.png">
                </figure>
                <article>
                	Pr-seeding<br>
                    & Bloggers
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice09.png">
                </figure>
                <article>
                	Online Media<br>
                    Planning
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice10.png">
                </figure>
                <article>
                	Google Seo <br>
                    /adwords
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice11.png">
                </figure>
                <article>
                	Digital Kios
                </article>
            </li>
            <li>
            	<figure>
                	<img alt="" title="" src="images/iconservice12.png">
                </figure>
                <article>
                	Realtime<br>
                    Streaming
                </article>
            </li>
            <li style="width:100%;">
            	<figure>
                	<img alt="" title="" src="images/iconservice13.png">
                </figure>
                <article>
                    Brand Monitoring & Tracking System<br>
                    To Analyse Share Of Voice On Online Media<br>
                    & Social Network
                </article>
            </li>
        </ul>
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

		/*if(widthres > 750){
			$('.slide-banner-center-detail').slick({
				centerMode: true,
				//centerPadding: '60px',
				slidesToShow: 1,
				variableWidth: true,
				prevArrow: jQuery('#slide-banner-detail .slide-control .prev'),
				nextArrow: jQuery('#slide-banner-detail .slide-control .next'),
				slidesToScroll: 1,
				variableWidth: true,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							arrows: true,
							centerMode: true,
							centerPadding: '40px',
							slidesToShow: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: true,
							centerMode: true,
							centerPadding: '40px',
							slidesToShow: 1,
							variableWidth : true,
							mobileFirst: true,
						}
					}
				]
			});
		}else{
			jQuery('.slide-banner-center-detail').slick({
			  infinite: true,
			  slidesToShow: 1,
			  slidesToScroll: 1,
				prevArrow: jQuery('#slide-banner-detail .slide-control .prev'),
				nextArrow: jQuery('#slide-banner-detail .slide-control .next'),
			});
		}*/
	});

</script>


