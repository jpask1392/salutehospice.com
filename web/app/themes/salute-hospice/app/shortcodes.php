<?php

namespace App;

/**
 * Button
 */
add_shortcode('button', function ( $atts, $content = null ) {
    return '<span class="btn btn--primary">'. $content .'</span>';
});

/**
 * Icon shortcode
 *
 * [icon value="icon-name"]
 */
add_shortcode('icon', function ($atts) {
  $icon = shortcode_atts(['value' => '', 'type' => 'default'], $atts);
  ob_start();
  get_template_part(asset_path('images/icons/icon-phone.svg.php'));
  return ob_get_clean();
});

/**
 * Phone shortcode
 *
 * [company_phone use="name,name"]
 */
add_shortcode('company_phone', function ($atts = []) {
  $content = "";
  if (!empty($atts)) :
    $numbers = get_field('company_phone', 'options');
    $useArray = explode(',', $atts['use']);
    $content .= '<span class="company-number">';
    foreach ($numbers as $number) :
      if (in_array($number['use'], $useArray)) {
        $content .= '<a href="tel:' . $number['number'] . '">' . $number['number'] . "</a>";
      }
    endforeach;
    $content .= '</span>';
  else :
    if (have_rows('company_phone', 'options')) :
      $content .= '<span class="company-number">';
        while (have_rows('company_phone', 'options')) : 
          the_row();
          $content .= '<a href="tel:' . get_sub_field('number') . '">' . get_sub_field('number') . "</a>";
        endwhile;
      $content .= '</span>';
    endif;
  endif;
  return $content;
});

add_shortcode('company_email', function ($atts) {  
    return '<a href="mailto:' . get_field('company_email', 'option') . '">' . get_field('company_email', 'option') . '</a>';;
});

add_shortcode('company_address', function ($atts) {
    return get_field('company_address', 'option');
});

add_shortcode('company_open_times', function ($atts) {
    $open_time = get_field('opening_times', 'option')['opening_time'];
    $close_time = get_field('opening_times', 'option')['closing_time'];
    $suffix = get_field('opening_times', 'option')['time_suffix'];
    return $open_time . '-' . $close_time . ' ' . $suffix;
});

add_shortcode('contact_card', function () {
  ob_start();
  echo template('partials/contact-info');
  return ob_get_clean();
});

/**
 * Icon shortcode
 *
 * [icon value="icon-name"]
 */
add_shortcode('icon', function ($atts) {
  $icon = shortcode_atts(['value' => '', 'type' => 'default'], $atts);
  $filename = locate_template('views/icons/icon-' . $icon['value']);
  ob_start();
  if (file_exists($filename)) {
    include \App\template_path(locate_template('views/icons/icon-' . $icon['value']));
  } else {
    echo "?";
  }
  return ob_get_clean();
});
