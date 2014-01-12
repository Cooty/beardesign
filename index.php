<?php
    //mobile UA testing
    $uaCookieName = 'ua_cookie';
    $uaCookieExp = time()+60*60*24*365;
    $ismobile = false;
    
    //only do the testing when the cookie has not been set up
    if(!isset($_COOKIE[$uaCookieName])){
	
	$useragent = $_SERVER['HTTP_USER_AGENT'];
	
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
	    $ismobile = true;
	    //set a cookie so we don't have to run the test again on the users next 
	    setcookie($uaCookieName, 'mobile', $uaCookieExp);
	}
	else{
	    setcookie($uaCookieName, 'not_mobile', $uaCookieExp);
	}
    }
    
    if(isset($_COOKIE[$uaCookieName]) && $_COOKIE[$uaCookieName] == 'mobile'){
	$ismobile = true;
    };
    
    //language setting
    $language = 'hu';
    $detectedLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    
    if((!isset($_REQUEST['lang']) && $detectedLang !== 'hu') || (isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'en')){
	include_once('php_lang/en.php');
	$language = 'en';
    }
    if((!isset($_REQUEST['lang']) && $detectedLang == 'hu') || (isset($_REQUEST['lang']) && $_REQUEST['lang'] == 'hu')){
	include_once('php_lang/hu.php');
    }
?>
<!DOCTYPE html>
<html lang="<?=($language == 'hu' ? 'hu' : 'en');?>" class="no-js">
<head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <title><?=$dict['title']?></title>
    
    <!--basic meta info-->
    <meta name="robots" content="index,follow">
    <meta name="keywords" content="<?=$dict['keywords']?>">
    <meta name="description" content="<?=$dict['desc']?>">
    
    <!--set the viewport-->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!--favicon-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    
    <!--OG meta-->
    <meta property="og:title" content="<?=$dict['og_title']?>">
    <meta property="og:image" content="http://beardesign.hu/images/facebook.png">
    <meta property="og:description" content="<?=$dict['og_desc']?>">
    
    <!--Homescreen icons for Apple devices-->
    <meta name="apple-mobile-web-app-title" content="Beardesign.hu">
    <link rel="apple-touch-icon-precomposed" href="images/touch-icon-iphone.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/touch-icon-ipad.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/touch-icon-ipad-retina.png">
    
    <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
    <!--[if IE]>
	<meta http-equiv="cleartype" content="on">
    <![endif]-->
    
    <!--give HTML5Shiv to old IEs, also set image interpolaration mode-->
    <!--[if lt IE 9]>
        <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <style type="text/css">
	    img{-ms-interpolation-mode: bicubic}
	</style>
    <![endif]-->
    
    <!--load styles-->
    <!--main stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/styles.css?t=<?=filemtime('css/styles.css')?>" media="all">
    <!--Open Sans from Google Webfonts-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,700,300italic&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:700&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic&amp;subset=latin,latin-ext" rel="stylesheet" type="text/css">
    <![endif]-->
    
    <!--[if lte IE 9]>
        <link rel="stylesheet" type="text/css" href="css/ie9.css?t=<?=filemtime('css/ie9.css')?>" media="all">
    <![endif]-->
    <!--[if lte IE 8]>
        <link rel="stylesheet" type="text/css" href="css/ie_lte_8.css?t=<?=filemtime('css/ie_lte_8.css')?>" media="all">
    <![endif]-->
    <!--[if lte IE 7]>
        <link rel="stylesheet" type="text/css" href="css/ie7.css?t=<?=filemtime('css/ie7.css')?>" media="all">
    <![endif]-->
</head>

<body dir="ltr">
    <!--full site wrapper-->
    <div class="wrapper">
        <!--intro-->
        <section id="intro" class="content_section">
            <h1 id="logo">
                <img src="images/logo_circle<?=$ismobile ? '_mobile' : '';?>.png" id="logo_mask" alt="logo">
                <img src="images/bear_head<?=$ismobile ? '_mobile' : '';?>.png" id="logo_head" alt="Bear">
                <img src="images/bear_tipo<?=$ismobile ? '_mobile' : '';?>.png" id="logo_type" alt="Design">
            </h1>
            
            <p class="intro_txt centered_text js_hyphenate">
                <span class="portrait_cont">
                    <img src="images/content/self.jpg" alt="<?=$dict['my_name']?>" class="portrait">
                </span>
		<?=$dict['intro_txt']?>
            </p>
        </section><!--end intro-->
        
        <!--portfolio-->
        <section id="portfolio" class="content_section">
            <h1 class="section_heading"><?=$dict['portfolio_title']?></h1>
            
            <ul id="portfolio_list">
                <li class="portfolio_item">
                    <article class="portfolio_item_content">
                        <img src="images/blank.gif" data-original="images/content/vszek_cover<?=$ismobile ? '_mobile' : '';?>.png" alt="<?=$dict['vszek_txt']?>" class="portfolio_cover_pic js_lazy_img">
                        <h2 class="portfolio_item_title"><?=$dict['vszek_title'];?></h2>
                        <p class="centered_text js_hyphenate">
                            <?=$dict['vszek_txt']?>
                        </p>
                        <p class="tags">
                            <span class="tag ie_dpi_fix js_add_tag_elements">RWD</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">front-end</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">jQuery</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">CSS3</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">HTML5</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">proaction</span>
                        </p>
                        <a href="http://vszek.hu" class="btn icon_out ie_dpi_fix" target="_blank"><?=$dict['btn_txt']?></a>
                    </article>
                </li>
                <li class="portfolio_item">
                    <article class="portfolio_item_content">
                        <img src="images/blank.gif" data-original="images/content/az_izlelo_cover<?=$ismobile ? '_mobile' : '';?>.png" alt="<?=$dict['azizlelo_alt']?>" class="portfolio_cover_pic js_lazy_img">
                        <h2 class="portfolio_item_title"><?=$dict['azizlelo_title']?></h2>
                        <p class="centered_text js_hyphenate">
                            <?=$dict['azizlelo_txt']?>
                        </p>
                        <p class="tags">
                            <span class="tag ie_dpi_fix js_add_tag_elements">RWD</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">front-end</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">jQuery</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">CSS3</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">HTML5</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">Google Maps API</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">Instagram API</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">proaction</span>
                        </p>
                        <a href="http://azizlelo.hu" class="btn icon_out ie_dpi_fix" target="_blank"><?=$dict['btn_txt']?></a>
                    </article>
                </li>
                <li class="portfolio_item">
                    <article class="portfolio_item_content">
                        <img src="images/blank.gif" data-original="images/content/arthur_cover<?=$ismobile ? '_mobile' : '';?>.jpg" alt="<?=$dict['arthur_txt']?>" class="portfolio_cover_pic js_lazy_img">
                        <h2 class="portfolio_item_title"><?=$dict['arthur_title']?></h2>
                        <p class="centered_text js_hyphenate">
                            <?=$dict['arthur_txt']?>
                        </p>
                        <p class="tags">
                            <span class="tag ie_dpi_fix js_add_tag_elements">mobile</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">front-end</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">back-end</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">proaction</span>
                        </p>
                        <a href="http://arthursofor.hu/m/" class="btn icon_out ie_dpi_fix" target="_blank"><?=$dict['btn_txt']?></a>
                    </article>
                </li>
                <li class="portfolio_item">
                    <article class="portfolio_item_content">
                        <img src="images/blank.gif" data-original="images/content/serniorkempo_cover<?=$ismobile ? '_mobile' : '';?>.png" alt="<?=$dict['seniorkempo_title']?>" class="portfolio_cover_pic js_lazy_img">
                        <h2 class="portfolio_item_title"><?=$dict['seniorkempo_title']?></h2>
                        <p class="centered_text js_hyphenate">
                            <?=$dict['seniorkempo_txt']?>
                        </p>
                        <p class="tags">
                            <span class="tag ie_dpi_fix js_add_tag_elements"><?=$dict['tag_identity']?></span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">front-end</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">RWD</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements"><?=$dict['tag_freelance']?></span>
                        </p>
                        <a href="http://seniorkempo.hu" class="btn icon_out ie_dpi_fix" target="_blank"><?=$dict['btn_txt']?></a>
                    </article>
                </li>
                <li class="portfolio_item">
                    <article class="portfolio_item_content">
                        <img src="images/blank.gif" data-original="images/content/aszavakembere_cover<?=$ismobile ? '_mobile' : '';?>.png" alt="<?=$dict['matya_title']?>" class="portfolio_cover_pic js_lazy_img">
                        <h2 class="portfolio_item_title"><?=$dict['matya_title']?></h2>
                        <p class="centered_text js_hyphenate">
                            <?=$dict['matya_txt']?>
                        </p>
                        <p class="tags">
                            <span class="tag ie_dpi_fix js_add_tag_elements"><?=$dict['tag_identity']?></span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">front-end</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">RWD</span>
                            <span class="tag ie_dpi_fix js_add_tag_elements"><?=$dict['tag_freelance']?></span>
                            <span class="tag ie_dpi_fix js_add_tag_elements">Tumblr</span>
                        </p>
                        <a href="http://aszavakembere.tumblr.com/" class="btn icon_out ie_dpi_fix" target="_blank"><?=$dict['btn_txt']?></a>
                    </article>
                </li>
            </ul>
        </section><!--end portfolio-->
        <section id="contacts" class="content_section">
            <h1 class="section_heading"><?=$dict['social_title']?></h1>
            <p class="contact_icons">
                <a href="#" class="contact_icon mail_icon ie_dpi_fix js_add_icon" id="js_email_link" title="Email"></a>
                <a href="http://hu.linkedin.com/in/kutitamas/" class="contact_icon linkedin_icon ie_dpi_fix js_add_icon" title="hu.linkedin.com/in/kutitamas/"></a>
                <a href="http://cooty13.deviantart.com" class="contact_icon devart_icon ie_dpi_fix js_add_icon" title="cooty13.deviantart.com"></a>
                <a href="http://instagram.com/cooty13#" class="contact_icon instagram_icon ie_dpi_fix js_add_icon" title="Instagram"></a>
            </p>
        </section>
    </div><!--end full site wrapper-->
    <footer id="the_footer">
        <p>
            &copy; <?=$dict['my_name']?> <?=date('Y');?> &bull; <?=$dict['word_photo']?>: <a href="http://kimuraweb.hu"><?=$dict['zsolt_name']?></a> &bull; <?=$dict['lang_link']?>
        </p>
	<a id="back_to_top_link" href="#" title="Vissza a tetjére"></a>
    </footer>
    <?php //Notify the user that the language of the site has been automaticaly set ?>
    <?php if(isset($_REQUEST['lang']) == false && ($detectedLang !== 'hu')) : ?>
	<div class="warning" id="language_setting">
	    <p><?=$dict['lang_setting_txt']?></p>
	    <a href="javascript:void(0);" class="btn_warning ie_dpi_fix" id="close_warning"><?=$dict['lang_ok_btn']?></a>
	    <a href="index.php?lang=hu" class="btn_warning ie_dpi_fix"><?=$dict['lang_hu_btn']?></a>
	</div>
    <?php endif;?>
    <!--JS-->
    <script type="text/javascript">
        /**
        * helper function for loading a script into the page
        * @url  String  the url of the script resource
        * @callback  Function  the function to called when the script is loaded
        * @isAsync   Boolean (optional) if set to TRUE the <script> tag's async attribute will be set to true
       */
       function addScript(url, callback, isAsyncs){
           //create the script
           var js;
           js = document.createElement('script');
           js.src = url;
           if (isAsyncs !== null) {
                js.async = true;
           }
           
           //helper function, we don't want to duplicate the try... catch... statement
           function tryCallBack(callback) {
               try {
                   callback();
               } catch(e) {
                   if(console in window) console.log(e);
               };
           }
           
           //if there is a callback...
           if(callback !== null){
               //IE8 and below
               if(!window.addEventListener){
                   js.onreadystatechange = function(){
                       if(js.readyState === 'loaded'){
                           tryCallBack(callback)
                       };    
                   };
               }
               else{
                   js.onload = function(){
                       tryCallBack(callback)
                   };
               }
           };
           //append the script
           document.getElementsByTagName('body')[0].appendChild(js);
       };
       
       //load our scripts with chained callbacks, begining with jQuery
       addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
                    function(){
                        addScript('js/plugins.min.js?t=<?=filemtime('js/plugins.min.js');?>',
                                         function(){
                                                addScript('js/script.js?t=<?=filemtime('js/script.js');?>')
                                            })},
                    true);
    </script>
</body>
</html>
