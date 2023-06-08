<?php

// Testimonial
// add_action( 'after_setup_theme', 'calling_child_theme_setup' );

// function calling_chid_theme_setup() {
//     remove_shortcode('testimonial');
//     add_shortcode("testimonial", "branding_testimonial");
// }

function branding_testimonial($atts, $content = null) {
  global $flatsome_opt;
  $sliderrandomid = rand();
  extract(shortcode_atts(array(
    'name' => '',
    'class' => '',
    'visibility' => '',
    'company' => '',
    'stars' => '5',
    'font_size' => '',
    'text_align' => '',
    'image'  => '',
    'image_width' => '80',
    'pos' => 'left',
    'link' => '',
  ), $atts));
  ob_start();

  $classes = array('testimonial-box');
  $classes_img = array('icon-box-img','testimonial-image','circle');
  
  $classes[] = 'icon-box-'.$pos;
  if ( $class ) $classes[] = $class;
  if ( $visibility ) $classes[] = $visibility;

  if($pos == 'center') $classes[] = 'text-center';
  if($pos == 'left' || $pos == 'top') $classes[] = 'text-left';
  if($pos == 'right') $classes[] = 'text-right';
  if($font_size) $classes[] = 'is-'.$font_size;
  if($image_width) $image_width = 'width: '.intval($image_width).'px';

	$star_row = '';
	if ($stars == '1'){$star_row = '<div class="star-rating"><span style="width:25%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '2'){$star_row = '<div class="star-rating"><span style="width:35%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '3'){$star_row = '<div class="star-rating"><span style="width:55%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '4'){$star_row = '<div class="star-rating"><span style="width:75%"><strong class="rating"></strong></span></div>';}
	else if ($stars == '5'){$star_row = '<div class="star-rating"><span style="width:100%"><strong class="rating"></strong></span></div>';}

  $classes = implode(" ", $classes);
  $classes_img = implode(" ", $classes_img);
  ?>
  <div class="testimonial-box-360 icon-box <?php echo $classes; ?>">
        <div class="icon-box-text p-last-0 t-text-wrapper">
            <?php if($stars > 0) echo $star_row; ?>
                    <div class="testimonial-text line-height-small italic test_text first-reset last-reset is-italic">
                <?php echo do_shortcode( $content ); ?>
            </div>
        </div>
        <?php if($image) { ?>
            <div class="t-img-wrapper">
                <div class="<?php echo $classes_img; ?>" style="<?php if($image_width) echo $image_width; ?>">
                    <?php echo flatsome_get_image($image, $size = 'thumbnail', $alt = $name) ;?>
                </div>
                <div class="testimonial-meta pt-half">
                    <strong class="testimonial-name test_name"><?php echo $name; ?></strong>
                    <?php if($name && $company) ?>
                    <p class="testimonial-company test_company"><?php echo $company; ?></p>
                </div>
            </div>
        <?php } ?>
  </div>

  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
