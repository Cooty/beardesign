<head prefix="og: http://ogp.me/ns#">
    <meta charset="utf-8">
    <title><?=$dict['title']?></title>
    
    <?php // basic meta info ?>
    <meta name="robots" content="index,follow">
    <meta name="keywords" content="<?=$dict['keywords']?>">
    <meta name="description" content="<?=$dict['desc']?>">
    
    <?php // set the viewport ?>
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php // favicon ?>
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    
    <?php // OG meta ?>
    <meta property="og:title" content="<?=$dict['og_title']?>">
    <meta property="og:image" content="http://beardesign.hu/images/facebook.png">
    <meta property="og:description" content="<?=$dict['og_desc']?>">
    
    <?php // Homescreen icons for Apple devices ?>
    <meta name="apple-mobile-web-app-title" content="Beardesign.hu">
    <link rel="apple-touch-icon-precomposed" href="images/touch-icon-iphone.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/touch-icon-ipad.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/touch-icon-ipad-retina.png">
    
    <?php //  Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading  ?>
    <!--[if IE]>
	<meta http-equiv="cleartype" content="on">
    <![endif]-->
    
    <?php // give HTML5Shiv to old IEs, also set image interpolaration mode ?>
    <!--[if lt IE 9]>
        <script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <style type="text/css">
	    img{-ms-interpolation-mode: bicubic}
	</style>
    <![endif]-->
    
    <?php // load styles ?>
    <?php // main stylesheet ?>
    <link rel="stylesheet" type="text/css" href="css/styles.css?t=<?=filemtime('css/styles.css')?>" media="all">
    <?php // Open Sans from Google Webfonts ?>
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