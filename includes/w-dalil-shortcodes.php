<?php
add_shortcode('show-dalil', 'w_dalil_echo');
function w_dalil_echo(){

    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    if(isset($_GET['wcat']) && !isset($_GET['ws']) && !isset($_GET['wcity']) ){
    $w_cat = mysql_real_escape_string( $_GET['wcat'] );
?>
    <span class="w_dalil_glyphs icon-filter"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])wcat=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $_GET['wcat'] ;
            ?></div>

<?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         'tax_query' => array(
                array(
                    'taxonomy' => 'w_dalil_category',
                    'field' => 'name',
                    'terms'    => $w_cat ,
                )
            )
     ));
    }

    elseif(isset($_GET['ws']) && !isset($_GET['wcat']) && !isset($_GET['wcity']) ){
     $w_search = mysql_real_escape_string( $_GET['ws'] );?>
    <span class="w_dalil_glyphs icon-filter-1"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])ws=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $_GET['ws'] ;
        ?></div>

    <?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         's' => $w_search
     ));

    }

    elseif(isset($_GET['wcat']) && isset($_GET['ws'])  && !isset($_GET['wcity']) ){
     $w_search = mysql_real_escape_string( $_GET['ws'] );
     $w_cat = mysql_real_escape_string( $_GET['wcat'] );?>
    <span class="w_dalil_glyphs icon-filter-1"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])ws=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
        ?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $_GET['ws'] ;
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?></div>
    <?php
        $remove_link = preg_replace('/([?&])wcat=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $_GET['wcat'] ;
        ?></div>

    <?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         's' => $w_search ,
         'tax_query' => array(
                array(
                    'taxonomy' => 'w_dalil_category',
                    'field' => 'name',
                    'terms'    => $w_cat ,
                )
            )
     ));
    }



    elseif(isset($_GET['wcat']) && !isset($_GET['ws'])  && isset($_GET['wcity']) ){
     $w_city = mysql_real_escape_string( $_GET['wcity'] );
     $w_cat = mysql_real_escape_string( $_GET['wcat'] );?>
    <span class="w_dalil_glyphs icon-filter-1"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])wcity=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
        ?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_city ;
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?></div>
    <?php
        $remove_link = preg_replace('/([?&])wcat=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $_GET['wcat'] ;
        ?></div>

    <?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'w_dalil_category',
                    'field' => 'name',
                    'terms'    => $w_cat ,
                ),
                array(
                    'taxonomy' => 'w_dalil_city',
                    'field' => 'name',
                    'terms'    => $w_city ,
                )
            )
     ));
    }



    elseif(!isset($_GET['wcat']) && isset($_GET['ws'])  && isset($_GET['wcity']) ){
     $w_city = mysql_real_escape_string( $_GET['wcity'] );
     $w_s = mysql_real_escape_string( $_GET['ws'] );?>
    <span class="w_dalil_glyphs icon-filter-1"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])wcity=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
        ?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_city ;
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?></div>
    <?php
        $remove_link = preg_replace('/([?&])ws=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_s ;
        ?></div>

    <?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         's' => $w_s ,
         'tax_query' => array(
                array(
                    'taxonomy' => 'w_dalil_city',
                    'field' => 'name',
                    'terms'    => $w_city ,
                )
            )
     ));
    }



    elseif(isset($_GET['wcat']) && isset($_GET['ws'])  && isset($_GET['wcity']) ){
     $w_city = mysql_real_escape_string( $_GET['wcity'] );
     $w_s = mysql_real_escape_string( $_GET['ws'] );
     $w_cat = mysql_real_escape_string( $_GET['wcat'] );?>
    <span class="w_dalil_glyphs icon-filter-1"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])wcity=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
        ?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_city ;
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?></div>
    <?php
        $remove_link = preg_replace('/([?&])ws=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_s ;
        ?></div>
        <?php
        $remove_link = preg_replace('/([?&])wcat=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_cat ;
        ?></div>

    <?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         's' => $w_s ,
         'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'w_dalil_category',
                    'field' => 'name',
                    'terms'    => $w_cat ,
                ),
                array(
                    'taxonomy' => 'w_dalil_city',
                    'field' => 'name',
                    'terms'    => $w_city ,
                )
            )
     ));
    }



    elseif(!isset($_GET['wcat']) && !isset($_GET['ws'])  && isset($_GET['wcity']) ){
     $w_city = mysql_real_escape_string( $_GET['wcity'] );?>
    <span class="w_dalil_glyphs icon-filter-1"></span>
    <h2 class="s_text" ><?php echo __('Search Results For : ','w_dalil');?></h2>
<?php
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $remove_link = preg_replace('/([?&])wcity=[^&]+(&|$)/','$1',$actual_link);
        $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
        ?>
        <div class="dalil_remove_wrap"><a href="<?php echo $remove_link; ?>" ><i class="icon-cancel"></i></a>&nbsp;<?php echo $w_city ;
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?></div>

    <?php
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged,
         'tax_query' => array(
                array(
                    'taxonomy' => 'w_dalil_city',
                    'field' => 'name',
                    'terms'    => $w_city ,
                )
            )
     ));
    }





    else{
     $query = new WP_Query(array(
         'post_type' => 'w_dalil_posttype',
         'posts_per_page' => 20,
//         'orderby' => 'rand',
         'paged' => $paged
//'s'                      => 'asd',
     ));
    }








     wp_reset_query();
    if($query->have_posts()){
        get_informatrion($query);
    }else{?>
        <h2 class="w_noting"><?php echo __('Sorry ... Nothing Found','w_dalil'); ?></h2>
    <?php }
    }




add_shortcode('search-dalil', 'w_dalil_search');
function w_dalil_search(){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $remove_link = preg_replace("/\/page\/\d+/", "", $actual_link);
    ?>
<form class="w_search" method="get" action="<?php echo $remove_link; ?>" >
     <?php if(isset($_GET['wcat'])){
        ?>
        <input type="hidden" required  name="wcat" value="<?php echo $_GET['wcat']; ?>"/>
        <?php
    }
    if(isset($_GET['wcity'])){
        ?>
        <input type="hidden" required  name="wcity" value="<?php echo $_GET['wcity']; ?>"/>
        <?php
    }
    ?>
<input type="text" name="ws" required class="w_s_input" placeholder="<?php echo __('Search Our Dalil','w_dalil') ?>" />
</form>


<?php
}



add_shortcode('list-cat-dalil', 'w_dalil_list_cat');
function w_dalil_list_cat(){
    ?>
<h2 class="all_cats" ><?php echo __('All Categories','w_dalil'); ?></h2>

<?php
$custom_terms = get_terms('w_dalil_category');
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $remove_link = preg_replace('/([?&])wcat=[^&]+(&|$)/','$1',$actual_link);
    $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
    if($_GET['ws'] || $_GET['wcity']){
        $getexistes = '&';
    }else{
        $getexistes = '?';
    }
//    $remove_link = preg_replace('/([?&])ws=[^&]+(&|$)/','$1',$remove_link);
    echo '<ul>';
    foreach($custom_terms as $custom_term) {
            echo '<li><a class="listcat_item" href="'.$remove_link.$getexistes.'wcat='.$custom_term->name.'" >'.$custom_term->name.'</a></li>';
    }
    echo '</ul>';
    echo '<hr/>';
}


add_shortcode('list-cities-dalil', 'w_dalil_list_cities');
function w_dalil_list_cities(){
    ?>
<h2 class="all_cats" ><?php echo __('All Cities','w_dalil'); ?></h2>

<?php
    $custom_terms = get_terms('w_dalil_city');
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $remove_link = preg_replace('/([?&])wcity=[^&]+(&|$)/','$1',$actual_link);
    $remove_link = preg_replace("/\/page\/\d+/", "", $remove_link);
    if($_GET['ws'] || $_GET['wcity']){
        $getexistes = '&';
    }else{
        $getexistes = '?';
    }
    echo '<ul>';
    foreach($custom_terms as $custom_term) {
            echo '<li><a class="listcat_item" href="'.$remove_link.$getexistes.'wcity='.$custom_term->name.'" >'.$custom_term->name.'</a></li>';
    }
    echo '</ul>';
    echo '<hr/>';
}








add_shortcode('FW-dalil', 'w_dalil_full');
function w_dalil_full(){
//    do_shortcode('[list-cat-dalil]');
    do_shortcode('[search-dalil]');
    do_shortcode('[show-dalil]');
}









add_action( 'init', 'w_dalilhandle_addnew' );
function w_dalilhandle_addnew() {
    session_start();
    if( isset($_FILES['dalil_logo']) &&  $_FILES['dalil_logo']['name'] != '' ){
        $uploadedfile = $_FILES['dalil_logo'];
        $upload_overrides = array( 'test_form' => false ,'unique_filename_callback' => 'dalil_logo_filename');
        add_filter('upload_mimes','dalil_mimes');
        add_filter( 'upload_dir', 'dalil_dir' );
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
        remove_filter( 'upload_dir', 'dalil_dir' );
        remove_filter('upload_mimes','dalil_mimes');
        if ( $movefile && !isset( $movefile['error'] ) ) {

            $get_ext = wg_get_ext($movefile['type']);
            $generated_for_small = 'sm_'. rand ( 100000 , 999999 ).$get_ext;
            $image1 = wp_get_image_editor( $movefile['file'] );
            $image1->resize( 270, NULL, true );
            $sm_dir = wp_upload_dir()['basedir'] . '/dalil_files/'.$generated_for_small;
            $sm_url = wp_upload_dir()['baseurl'] . '/dalil_files/'.$generated_for_small;
            $result = $image1->save( $sm_dir );

            $dalil_data['dalil-logo-orginal'] = $movefile['url'] ;
            $dalil_data['dalil-logo'] = $sm_url ;
        }else{
            $_SESSION['dalil_message'] = __('Logo File Not allowed','w_dalil');
            session_write_close();
            wp_redirect( $_SERVER["REQUEST_URI"] );
            exit;
        }
    }
    if(wp_verify_nonce( $_POST['w-dalil-addnew'], 'w-dalil-nonce' ) && isset($_POST['dalil_newsubmit']) ){
            $daliltitle = mysql_real_escape_string( $_POST['dalil_newtitle'] );
            $dalil_data['dalil-address'] = mysql_real_escape_string( $_POST['dalil_newaddress'] );
            $dalil_data['dalil-phone'] = mysql_real_escape_string( $_POST['dalil_newphone'] );
            $dalil_data['dalil-activity'] = mysql_real_escape_string( $_POST['dalil_newactivity'] );
        if( isset($_POST['dalil_newemail']) ){
            $dalil_data['dalil-email'] = mysql_real_escape_string( $_POST['dalil_newemail'] );
        }
        if( isset($_POST['dalil_newwebsite']) ){
            $dalil_data['dalil-website'] = mysql_real_escape_string( $_POST['dalil_newwebsite'] );
        }
        $my_post = array(
          'post_title'    => $daliltitle,
          'post_type'  => 'w_dalil_posttype'
        );
        $post_id = wp_insert_post( $my_post, $wp_error );
        if(!$wp_error){
            update_post_meta( $post_id, 'dalil_information', $dalil_data );
            $_SESSION['dalil_message'] = __('Thanks For adding','w_dalil');
            session_write_close();
            wp_redirect( $_SERVER["REQUEST_URI"] ); exit;
        }
    }
}




add_shortcode('add-item-dalil', 'w_dalil_add_item');
function w_dalil_add_item(){
    ?>
    <script>
        $(document).ready(function(){
            $('#dalil_logo_input').change(function(){
                $( '.dalil_logo_label' ).html('<?php echo __('Chosen File :','w_dalil'); ?>'+$(this).val());
            });
        });
    </script>
    <h2 class="all_cats" ><?php echo __('Add Your Company','w_dalil'); ?></h2>
    <form class="insert_item_form" method='post' enctype="multipart/form-data" >
        <?php wp_nonce_field('w-dalil-nonce', 'w-dalil-addnew');  ?>
        <input name="dalil_newtitle" required type="text" placeholder="<?php echo __('Tilte*','w_dalil'); ?>" />
        <input name="dalil_newaddress" required type="text" placeholder="<?php echo __('Adress*','w_dalil'); ?>" />
        <input name="dalil_newphone" required type="text" placeholder="<?php echo __('Phone*','w_dalil'); ?>" />
        <input name="dalil_newemail" type="text" placeholder="<?php echo __('Email','w_dalil'); ?>" />
        <input name="dalil_newwebsite" type="text" placeholder="<?php echo __('Website','w_dalil'); ?>" />
        <input name="dalil_newactivity" required type="text" placeholder="<?php echo __('Kind of activity*','w_dalil'); ?>" />
        <input id="dalil_logo_input" name="dalil_logo" type="file" />
        <label class="dalil_logo_label" for="dalil_logo_input" ><?php echo __('(optional) Upload logo : ','w_dalil'); ?></label><br />
        <p class="dalil_logo_allow"><?php echo __('Only jpg file with 2 MB allowed','w_dalil'); ?></p>
        <input title = "<?php echo __('No File Selected','w_dalil'); ?>" name="dalil_newsubmit" type="submit" value="<?php echo __('Add Your Company ','w_dalil'); ?>" />
        <p class="dalil_message"><?php echo $_SESSION['dalil_message'] ; unset($_SESSION['dalil_message']);  ?></p>
    </form>

<?php
}

?>
