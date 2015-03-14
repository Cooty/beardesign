<?php if(isset($_REQUEST['lang']) == false && ($detectedLang !== 'hu')) : ?>
    <!--language warning-->
    <div class="warning_panel" id="language_setting">
        <p>
            <?=$dict['lang_setting_txt']?>
        </p>
        
        <a  href="javascript:void(0);"
            class="btn warning ie_dpi_fix"
            id="close_warning">
            <?=$dict['lang_ok_btn']?>
        </a>
        
        <a  href="index.php?lang=hu"
            class="btn warning ie_dpi_fix">
            <?=$dict['lang_hu_btn']?>
        </a>
    </div><!--end language warning-->
<?php endif;?>