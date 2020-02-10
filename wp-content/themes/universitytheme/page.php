<?php
  get_header();
?>
<div class="container container--narrow page-section">
<?php 
$parentId = $post->post_parent;
if ($parentId) {
?>
    <div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="#"><i class="fa fa-home" aria-hidden="true"></i> Back to About Us</a> <span class="metabox__main"><?php echo $post->post_title; ?></span></p>
    </div>
<?php
 }
?>
<div class="page-links">
  <h2 class="page-links__title"><a href="#">About Us</a></h2>
  <ul class="min-list">
    <?php 

    if ( !$parentId) {
        $childOf = $post->ID;
    }
    $args = array('child_of' => $childOf, 'order'  => 'menu_order', 'order_by' => 'ASC', 'title_li' => ''); 
    wp_list_pages($args);
    ?>
  </ul>
</div>

<div class="generic-content">
    <?php echo apply_filters('the_content', $post->post_content); ?>
</div>

</div>

<?php
  get_footer();
?>