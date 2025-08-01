 <div class="s-widget"> <p style="font-weight:bold;font-family: 'chunkfiveroman', sans-serif; color:#094971; font-size:14px;"><i class="fa fa-search color"></i>&nbsp; <?php echo lang_key('search'); ?></p><div class="widget-content search">
   <!-- Widgets Content --><div id="homeheadersearch" style="">
            
            <div class="widget-content search"  style="margin-right:25px;float:right;max-width:380px;">
<section role="search" data-ss360="true">
	<input type="search" id="searchBox">
	<button id="searchButton"></button>
</section>    
    </div></div></div>
    </div>

<div class="s-widget" style="display:none;">
   <!-- Heading -->
   <p style="font-weight:bold;font-family: 'chunkfiveroman', sans-serif; color:#094971; font-size:14px;"><i class="fa fa-search color"></i>&nbsp; <?php echo lang_key('search'); ?></p>
   <!-- Widgets Content -->
    <div class="widget-content search">
        <form role="form" action="<?php echo site_url('show/advfilter')?>" method="post">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="<?php echo lang_key('type_something'); ?>" value="<?php echo (isset($data['plainkey']))?rawurldecode($data['plainkey']):'';?>" name="plainkey">


                <span class="input-group-btn">
                    <button type="submit" class="btn btn-color"><?php echo lang_key('search');?></button>
                </span>
            </div>
        </form>
    </div>
</div>
