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
</script><!--end JS-->