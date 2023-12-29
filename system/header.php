<header class="mainHeader">
    <section class="container">
        <section class="paragraph overflowNone">
            <section class="logoMain">
                <a href="https://www.playdigital.co.th/">
					<img alt="Play digital" title="Play digital" src="images/playdigital-logo.png">
					</a>
            </section>
            <section class="iconSocial">
            	<nav>
                	<a href="https://www.facebook.com/iplayproject/" target="_blank">
                    	<img alt="" title="" src="images/iconFacebook.png">	
                    </a>
                </nav>
                <nav>
                	<a href="https://www.youtube.com/channel/UCy_pLTa_i5vpBgbmOn8sCdQ" target="_blank">
                    	<img alt="" title="" src="images/iconYoutube.png">	
                    </a>
                </nav>
                <div class="clear"></div>
            </section>
            <section class="menuMain">
                <ul id="example">
                    <li>
                        <a href="index.php?page=home">
                            Home
                        </a>
                    </li>
                    <li>
                        <a onclick="window.location='index.php?page=home#service';" style="cursor:pointer">
                            Services
                        </a>
                    </li>
                    <li class='m-work'>
                        <a href="index.php?page=work">
                            Work
                        </a>
                        <ul>
                            <span></span>
                            <?
							$resm = mysql_query("select * from f_type where f_type_status='approved' order by f_type_order asc");
							while($rowm = mysql_fetch_array($resm)){
							?>
                            <li>
                                <a href="index.php?page=category&cid=<?=$rowm['f_type_id']?>">
									<?=$rowm['f_type_name_en']?>
                                </a>
                            </li>
							<?
							}?>
                        </ul>
                    </li>
                    <li>
                        <a href="index.php?page=clients">
                            Client
                        </a>
                    </li>
                    <li>
                        <a href="index.php?page=home#about">
                            About
                        </a>
                    </li>
                    <!--<li>
                        <a href="#" style="cursor:none;">
                            Blog
                        </a>
                    </li>-->
                    <li>
                        <a href="#contact">
                            Contact
                        </a>
                    </li>
                </ul> 
            </section>
            
            <div class="clear"></div>
        </section>
        
        
        
        	
    </section>
</header>
<section class="paragraph Menumobile overflowNone" >
<section class="boxMenuBurger">
    <div class="column">
        <div id="dl-menu" class="dl-menuwrapper">
            <button class="dl-trigger">Open Menu</button>
            <ul class="dl-menu">
                <li>
                    <a href="index.php?page=home">Home</a>
                    
                </li>
                <li>
                    <a onclick="window.location='index.php?page=home#service';" style="cursor:pointer">Services</a>
                    
                </li>
                <li>
                    <a href="index.php?page=work">Work </a>
                    <ul class="dl-submenu">
                    	<?
						$resm = mysql_query("select * from f_type where f_type_status='approved' order by f_type_order asc");
						while($rowm = mysql_fetch_array($resm)){
						?>
						<li>
                            <a href="index.php?page=category&cid=<?=$rowm['f_type_id']?>">
                                <?=$rowm['f_type_name_en']?>
                            </a>
                        </li>
						<? }?>
                        
					</ul>                    
                </li>
                <li>
                    <a href="index.php?page=clients">Client</a>
                    
                </li>
                <li>
                    <a href="index.php?page=home#about">About</a>
                </li>
                <li>
                    <a href="#">Blog</a>
                </li>
                <li>
                    <a href="#contact">Contact</a>
                </li>
            </ul>
        </div><!-- /dl-menuwrapper -->
    </div>
</section>
<div class="clear"></div>


</section>