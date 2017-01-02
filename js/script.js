/**
 * Scripts for Beardesign.hu
 * @author  Tamas Kuti
 * @requires    jQuery, jQuery.lazyload, Modernizr
 * @notes       The file is loaded after jquery.1.9.1.js and plugins.min.js
*/

//Everything goes into jQuery scope to avoid globals
(function($) {
    //define our variables
    var resizeTimer,
    $tags = jQuery('.js_add_tag_elements'),
    $contactIcons = jQuery('.js_add_icon'),
    $theFooter = jQuery('#the_footer'),
    $portrait = jQuery('.portrait'),
    $backToTopLink = jQuery('#back_to_top_link'),
    introSectionH = jQuery('#intro').height(), //needed for showing/hiding the back to top button
    scrollTimer,
    $body = jQuery('body'),
    windowWidth = document.documentElement.clientWidth,
    $langWarning = jQuery(document.getElementById('language_setting')),
    seenLangSettings = window.localStorage ? localStorage.seenLangSetting : getCookie('seenLangSetting');
    
    //animated scroll to top for the back to top link
    $backToTopLink.on('click', function(e){
            jQuery('body, html').animate({
                scrollTop : 0}, 300);
            e.preventDefault();
        });
    
    //show or hide the back to top link
    //@arrLink  jQuery Object   the link object
    //@arrLimit Number  the number of pixels scrolled vertically when the link should be visible
    function toggleBackToTopLink(arrLink, arrLimit) {
        if (jQuery(window).scrollTop() >= arrLimit) {
            if (Modernizr.csstransitions) {
                arrLink.addClass('show');
            }
            else {
                arrLink.animate({
                        bottom : '0px',
                        right : '0px'
                    });
            }
        }
        else{
            if (Modernizr.csstransitions) {
                arrLink.removeClass('show');
            }
            else {
                arrLink.animate({
                        bottom : '-60px',
                        right : '-60px'
                    });
            }
        }
    };
    
    //helper function to set a cookie
    //@cname    String  the name of the cookie
    //@cvalue   String  the value of the cookie
    //@exdays   Number  the number of days the cookie will expire
    function setCookie(cname, cvalue, exdays){
        var d = new Date();
        d.setTime(d.getTime()+(exdays*24*60*60*1000));
        var expires = "expires="+d.toGMTString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }; 
    
    //helper to get the value of a cookie
    //@cname    String  the name of the cookie we want to get
    //@return   String  the value of the cookie, empty string if the cookie was not found
    function getCookie(cname){
        var name = cname + "=",
        ca = document.cookie.split(';');
        
        for (var i=0; i<ca.length; i++){
                var c = ca[i].trim();
                if (c.indexOf(name) == 0)
                    return c.substring(name.length,c.length);
            };
        return "";
    };
    
    //hides the language setting warning DIV
    //sets a cookie not to show the DIV again on next visit
    function hideLangWarning() {
        var $warningDiv = jQuery(document.getElementById('language_setting'));
        $warningDiv.slideUp(250, function() {
                if (window.localStorage) {
                    localStorage.seenLangSetting = '1';
                }else {
                    setCookie('seenLangSetting', '1', 365);   
                }
            });
    };
    
    //wrapper for stuff to do on scroll
    function scrollFunction() {
        toggleBackToTopLink($backToTopLink, introSectionH);
    };
    
    //wrapper for everything that should happen on the resize event
    function resizeFunction() {
        //recalculate the intro section's height
        introSectionH = jQuery(document.getElementById('intro')).height();
        
        //recalculate the browser window's width
        windowWidth = document.documentElement.clientWidth;
        
        //media query emulation for IE lte 8
        if (!window.addEventListener) {
            emulateMQOldIE();
        }
    };

    //Throtteled resize event, thx: http://gomakethings.com/javascript-resize-performance/
    // On resize, run the function and reset the timeout
    // 250 is the delay in milliseconds. Change as you see fit.
    jQuery(window).resize(function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(resizeFunction, 250);
    });
    
    //do the same with scrolling
    jQuery(window).scroll(function(event) {
        //only do it if it was not triggered by the Instagram slider
        if (!event.isTrigger) {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(scrollFunction, 200);
        }
    });
    
    //add the email address to the email link
    jQuery('#js_email_link').attr('href', 'mailto:cooty13@gmail.com');
    
    //add hover effect elements for the contact icons, but only if CSS3 transitions are supported
    if (Modernizr.csstransitions) {
        $contactIcons.append('<span class="color_layer"></span>');
    };
    
    //polyfills for no :before/:after
    if (!Modernizr.generatedcontent) {
        //arrow heads for the tags
        $tags.append('<span class="tag_before"></span><span class="tag_after"></span>');
        
        //icons in the contact circles
        $contactIcons.append('<span class="contact_icon_icon"></span>');
        
        //up arrow icon
        $backToTopLink.append('<span class="icon ie_dpi_fix"></span>');
    };
    
    //media query emulation - only effects old IEs
    function emulateMQOldIE() {
        //add some media query support
        //style defined in conditional stylesheet only served for IE8 and below
        if ((windowWidth >= 1220 ) && (windowWidth < 1440)) {
            $body.addClass('desktop_size_2');
        }
        else if (windowWidth >= 1441) {
            $body.addClass('desktop_size_3');
        };
    };
    
    //add bullets to the tags
    $tags.append('<span class="tag_bullet">&bull;</span>');
    
    //creates the slider around the Instagram images
    //must be called after the carousel items are injected to the DOM
    function setUpInstaSlider() {
        //the DIV around the UL
        var $instaSliderWrap = jQuery(document.getElementById('insta_wrapper')),
        //the UL
        $instaSlider = jQuery(document.getElementById('insta_photos')),
        //all the LIs
        $items = $instaSlider.find('li'),
        //the number of images
        itemNum = $items.length,
        //the width of a single LI
        itemWidth = $items.width(),
        //the total width of the image strip
        itemsWidth  = itemWidth * itemNum,
        //the number of offscreen items
        nonVisibleItemsNum = itemNum - Math.ceil(windowWidth / itemWidth),
        //the difference between the maximum visible itmes width and the total screen width
        offsetDif = windowWidth - ((itemNum - nonVisibleItemsNum) * itemWidth),
        //save the window width so we can chack if it was resized
        initailWindowWidth = document.documentElement.clientWidth,
        counter = 0,
        $prevArrow,
        $nextArrow;
        
        //only create and add the images if their width is larger than the screens
        if (itemsWidth > windowWidth) {
            //create the arrows
            $prevArrow = jQuery('<a class="insta_arrow prev"></a>');
            $nextArrow = jQuery('<a class="insta_arrow next"></a>');
            
            //add event handlers to them
            $prevArrow.click(function(){
                    moveImages('back');
                });
            $nextArrow.click(function(){
                    moveImages('forward');
                });
            
            // Add touc support
            if ($instaSlider.hammer) {
                
                $instaSlider.hammer().on('swipeleft', function() {
                    if ($nextArrow.css('display') !== 'none') {
                        moveImages('forward');
                    }    
                });
                
                $instaSlider.hammer().on('swiperight', function() {
                    if ($prevArrow.css('display') !== 'none') {
                        moveImages('back');
                    }    
                }); 
                
            }
            
            
            //add the invsible layers to prevent missed click once the arrows fade out
            $instaSliderWrap.append('<span class="click_protect prev"></span><span class="click_protect next"></span>');
            
            //add arrows to the DOM
            $instaSliderWrap.append($prevArrow);
            $instaSliderWrap.append($nextArrow);
            
            //hide the prev arrow
            $prevArrow.css('display', 'none');
            
            //add fix for old browsers that don't support :before/:after
            if (Modernizr.generatedcontent) {
                $prevArrow.append('<span class="icon"></span>');
                $nextArrow.append('<span class="icon"></span>');
            };
        }
        
        //this moves the images
        //@argDirection     String     'forward' for scrolling right 'back' for scrolling left
        //@local
        function moveImages(argDirection) {
            var offset;
            
            //recalculate some metrics is the window's width was changed
            if (windowWidth !== initailWindowWidth) {
                itemWidth = $items.width();
                itemsWidth = itemWidth * itemNum;
                nonVisibleItemsNum = itemNum - Math.ceil(windowWidth / itemWidth);
                offsetDif = windowWidth - ((itemNum - nonVisibleItemsNum) * itemWidth);
            };
            
            //increment the counter
            if (argDirection === 'back') {
                counter--;
            }
            else{
                counter++;   
            };
            
            //set the offset
            offset = (itemWidth * -1) * counter;
            //change the offset for the last and first images to account for the differance in the width of the screen and the visible items
            if ((argDirection == 'forward' && counter == nonVisibleItemsNum) ||
                (argDirection == 'back' && counter == 1)) {
                //we have reached the last image add the offsetDif
                offset = offset + offsetDif;
            };
            
            //trigger the windows scroll event so the lazy loading images will show up
            //this is only needed when goind 'forward'
            if (argDirection === 'forward') {
                jQuery(window).trigger('scroll');
            };
            
            //show or hide the next/prev buttons
            //show the prev button when the images have moved one
            //and hide it ven we reach zero again
            if (counter == 1 && $prevArrow.css('display') !== 'block') {
                $prevArrow.fadeIn(250);
            }
            if (counter == 0 && $prevArrow.css('display') !== 'none') {
                $prevArrow.fadeOut(250);
            }
            //hide the next button when we have reached the last image
            //and show it again when we start going back 
            if (counter == nonVisibleItemsNum && $nextArrow.css('display') !== 'none' ) {
                $nextArrow.fadeOut(250);
            }
            if (counter < nonVisibleItemsNum && $nextArrow.css('display') !== 'block') {
                $nextArrow.fadeIn(250);
            }
            
            //moving the images
            //if we have transitions
            if (Modernizr.csstransforms) {
                if (Modernizr.csstransforms3d) {
                    $instaSlider.css('transform', 'translate3d(' + offset + 'px, 0, 0)');
                }
                else{
                    $instaSlider.css('margin-left', offset + 'px');
                }
            }
            //and if we don't
            else{
                $instaSlider.animate({
                    marginLeft : offset + 'px'
                });
            };
        };
    };
    
    //show :active styles in Webkit Mobile
    if (Modernizr.touch) {
        document.addEventListener("touchstart", function(){}, true);
    }
    
    /*Instagram API request*/
    jQuery.ajax({
        type: "GET",
        dataType: "jsonp",
        cache: false,
        //Endpoint of the most recent images of the loged in user
        url: "https://api.instagram.com/v1/users/607261781/media/recent/?access_token=607261781.899a4e2.255f2d1d9ce145c4b9e45c51c1b900e3",
        success: function(data) {
            var instagramResponse = data;
            var instagramData = instagramResponse.data;
            /*Error handling for Instagram API*/
            if(instagramResponse.meta.code == 200){
                $theFooter.prepend('<div id="insta_wrapper"><ul id="insta_photos"></ul></div>');
                for(i = 0; i < instagramData.length; i++){
                    jQuery('#insta_photos').append('<li class="ie_dpi_fix"><a href="'+instagramData[i].link+'"><img class="js_lazy_insta_images" data-original="'+instagramData[i].images.thumbnail.url+'" src="images/blank.gif"></a></li>');
                };
                //call lazy load on the Instagram images added to the page
                jQuery('.js_lazy_insta_images').lazyload({
                    effect : 'fadeIn',
                    threshold : jQuery(document.getElementById('insta_photos')).find('li').width()
                });
                
                //create the slider
                setUpInstaSlider();
            }else{
                /*If Instagram returns an error*/
                if(window.console){
                    console.log(instagramResponse.meta.error_type);
                    console.log(instagramResponse.meta.code);
                    console.log(instagramResponse.meta.error_message);			    
                }
            }
        },
        error: function(jqXHR, textStatus, errorThrown){
            if (window.console) {
                console.log(textStatus);
                console.log(errorThrown);
            }
        }
    });
    
    //add lazy load functionality
    jQuery('.js_lazy_img').lazyload({effect : 'fadeIn'});
    
    //polyfills for lte IE8
    if (!window.addEventListener) {
        //emulate media queries
        emulateMQOldIE();
        
        //emulate :last-child
        jQuery('.contact_icon:last-child').addClass('last');
        jQuery('.tag:last-child').addClass('last');
        jQuery('.portfolio_item:last-child').addClass('last');
    };
    
    //stuff for the warning DIV
    //add the close function to the button
    jQuery(document.getElementById('close_warning')).on('click', function(){
        hideLangWarning();
    });
    
    //show the language warning DIV
    if ($langWarning.length && !seenLangSettings) {
        $langWarning.slideDown(250);
    }
    
})(jQuery);