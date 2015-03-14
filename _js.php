<?php // JS ?>

<script>
    <?php
     /**
     * helper function for loading a script into the page
     * @url  String  the url of the script resource
     * @callback  Function  the function to called when the script is loaded
     * @isAsync   Boolean (optional) if set to TRUE the <script> tag's async attribute will be set to true
    */
    ?>
   function addScript(url, callback, isAsyncs){
       <?php //create the script ?>
       var js;
       js = document.createElement('script');
       js.src = url;
       if (isAsyncs !== null) {
            js.async = true;
       }
       
       <?php //helper function, we don't want to duplicate the try... catch... statement ?>
       function tryCallBack(callback) {
           try {
               callback();
           } catch(e) {
               if(console in window) console.log(e);
           };
       }
       
       <?php //if there is a callback... ?>
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
       <?php //append the script ?>
       document.getElementsByTagName('body')[0].appendChild(js);
   };
   
   <?php // load our scripts with chained callbacks, begining with jQuery ?>
   addScript('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
                function(){
                    addScript('js/plugins.min.js?t=<?=filemtime('js/plugins.min.js');?>',
                                     function(){
                                             if(!Modernizr.touch) {
                                                  addScript('js/script<?= $productionAssetSuffix ?>.js?t=<?=filemtime('js/script' .$productionAssetSuffix. '.js');?>');     
                                             } else {
                                                  addScript('js/hammer.jquery.hammer.min.js?t=<?=filemtime('js/hammer.jquery.hammer.min.js');?>', function() {
                                                       addScript('js/script<?= $productionAssetSuffix ?>.js?t=<?=filemtime('js/script' .$productionAssetSuffix. '.js');?>');     
                                                  });
                                             }
                                            
                                        })},
                true);
</script><?php // end JS ?>