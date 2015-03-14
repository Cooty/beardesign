<?php include_once('_phpscripts.php'); ?>
<!DOCTYPE html>
<html lang="<?= ($language == 'hu' ? 'hu' : 'en'); ?>" class="no-js">
    <?php include_once('_head.php'); ?>

    <body dir="ltr">
	<!--full site wrapper-->
	<div class="wrapper">
	    <!--intro-->
	    <section id="intro" class="content_section">
		<?php include_once('_intro.php'); ?>
	    </section><!--end intro-->
	    
        <!--contacts and social icons-->
	    <section id="contacts" class="content_section">
		  <?php include_once('_contacts.php'); ?>
	    </section><!--end contacts and social icons-->
        
	    <!--portfolio-->
	    <section id="portfolio" class="content_section">
		  <?php include_once('_portfolio.php'); ?>
	    </section><!--end portfolio-->
        
	</div><!--end full site wrapper-->
	
	<!--footer-->
	<footer id="the_footer">
	    <?php include_once('_footer.php'); ?>
	</footer><!--end footer-->
	
	<?php //Notify the user that the language of the site has been automaticaly set ?>
	
	<?php include_once('_langwarning.php'); ?>
	
	<div class="loading-layer">
	    <div class="loading-layer-content">
		<img src="images/logo_loading.png" alt="Bear Design" class="loading-logo">
		<span class="loading-animation-text"><?=$dict['loading']?></span>
	    </div>
	</div>
	
	<?php include_once('_js.php'); ?>
    </body>
</html>
