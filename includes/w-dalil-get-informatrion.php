<?php

function get_informatrion($query){
    $count = 0;?>
    <div class="dalil_container">
     <?php while ($query->have_posts()) {
         $query->the_post();
         $dalil_information = get_post_meta( $query->post->ID, 'dalil_information', true );
         $dalil_item_cat = get_the_terms( $query->post->ID , 'w_dalil_category' );
         $dalil_item_cat =  $dalil_item_cat[0]->name;// we assume that every dalil item have one category listed udner it
         ?>
            <div class="dalil_item">
            <a style="<?php if(is_rtl()){echo "float:left;";}else{echo "float:right;";};  ?>" class="w_dalil_glyphs icon-print" onclick="printDiv<?php echo $count;?>('print-content')" ></a>
            <h2 class="dalil-title"><?php echo the_title();?></h2>
            <h3 class="dalil-cat">
                <?php
            if(!isset($_GET['wcat'])){
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $remove_link = preg_replace('/([?&])wcat=[^&]+(&|$)/','$1',$actual_link);
                if(isset($_GET['ws']) || isset($_GET['wcity']) ){
                        $getvalue = "&";
                }else{
                        $getvalue = "?";
                }?>
                <a href="<?php echo $remove_link;echo $getvalue; ?>wcat=<?php echo $dalil_item_cat; ?>" ><?php echo $dalil_item_cat; ?></a>
                <?php } ?>
            </h3>
            <?php
                if( isset( $dalil_information['dalil-logo'] ) && $dalil_information['dalil-logo'] != null && !get_post_meta($query->post->ID,'dalil_item_hidden', true ) ){ ?>
                <div class="dalil_item_container">
                    <img style="<?php if(is_rtl()){echo "float:right;";}else{echo "float:left;";};  ?>" class="dalil_logo" src="<?php echo $dalil_information['dalil-logo']; ?>" />
                    <div style="<?php if(is_rtl()){echo "float:left;";}else{echo "float:right;";}  ?>" class="dalil_inf">

            <?php  }else{ ?>
<!--

                <div class="dalil_item_container">
                    <img style="<?php if(is_rtl()){echo "float:right;";}else{echo "float:left;";};  ?>" class="dalil_logo" src="<?php echo DALILURL; ?>includes/file/default.jpg" />
                    <div style="<?php if(is_rtl()){echo "float:left;";}else{echo "float:right;";}  ?>" class="dalil_inf">

-->
            <?php   } ?>


            <?php
                if(isset($dalil_information['dalil-address'] )){?>
                <div class="dalil-address">
                    <span class="w_dalil_glyphs icon-location"></span>
                    <p><?php echo $dalil_information['dalil-address'] ;?></p>
                </div>
                <?php }
            ?>
            <?php
                if(isset($dalil_information['dalil-phone']) && $dalil_information['dalil-phone']!=''){?>
                <div class="dalil-phone">
                    <span class="w_dalil_glyphs icon-phone"></span>
                    <p><?php echo $dalil_information['dalil-phone'] ;?></p>
                </div>
                <?php }
            ?>
            <?php
                if(isset($dalil_information['dalil-email'] ) && $dalil_information['dalil-email']!=''){?>
                <div class="dalil-email">
                    <span class="w_dalil_glyphs icon-mail-alt"></span>
                    <a onclick='pop_email(<?php echo $query->post->ID;?>);'><p><?php echo $dalil_information['dalil-email'] ;?></p></a>
                </div>
                <?php }
            ?>
            <?php
                if(isset($dalil_information['dalil-website'] ) && $dalil_information['dalil-website']!=''){?>
                <div class="dalil-website">
                    <span class="w_dalil_glyphs icon-globe"></span>
                    <a target="_blank" href="http://<?php echo $dalil_information['dalil-website'] ;?>"><p><?php echo $dalil_information['dalil-website'] ;?></p></a>
                </div>
                <?php }
            ?>
            <?php
                if( isset( $dalil_information['dalil-logo'] ) && $dalil_information['dalil-logo'] != null  && !get_post_meta($query->post->ID,'dalil_item_hidden', true )  ){ ?>
                        </div> <!--  end dalil_inf -->
                </div> <!--  end dalil_item_container -->

            <?php  }else{ ?>
<!--                        </div>   end dalil_inf -->
<!--                </div>   end dalil_item_container -->
            <?php  } ?>


                <!-- edit -->
                <?php
                    if( is_user_logged_in() ){?>
                        <a target="_blank" class="w_dalil_edit_item" href="<?php echo  get_site_url(); ?>/wp-admin/post.php?post=<?php echo $query->post->ID; ?>&action=edit"><?php echo __('edit','w_dalil'); ?></a>
                    <?php }
                ?>

                <script type="text/javascript">

                function printDiv<?php echo $count;?>(divName) {
                     var printContents = $($('.dalil_item')[<?php echo $count; ?>]).html();
                     w=window.open("", "", "width=500, height=300");
                     w.document.write('<!DOCTYPE html><html><body><img class="logo_print" src="<?php echo plugins_url(); ?>/w-dalil/includes/file/print_logo.png" />');
                     w.document.write(printContents);
                     w.document.write('<style>.w_dalil_edit_item{display:none;}.dalil-title, .dalil-phone, .dalil-address, .dalil-cat, .dalil-email, .dalil-website {text-align:center;display:block !important;margin:auto !important;float:none !important;}.print_footer{text-align:center;background-color:#202020;color:#fff;display:block;cleat:both;}.dalil_inf,.dalil_logo{display:block !important;margin:auto !important;float:none !important;max-width:200px;}.logo_print{margin:auto;display:block;max-width:200px;}</style>');
                     w.document.write('<p class="print_footer"><?php echo __('This is generated By : ','w_dalil'); echo get_bloginfo('url'); ?></p></body></html>');
                     w.print();
                     w.close();
                }
                </script>



            </div><!-- End dalil Item  -->
            <hr />
     <?php $count++; }?>


<nav class="w_dalil_nav">
    <?php previous_posts_link( __('Previous','w_dalil') , $query->max_num_pages) ?>
    <?php next_posts_link( __('Next','w_dalil') , $query->max_num_pages) ?>
</nav>
</div> <!-- end of dalil_container -->


<?php

}

?>
