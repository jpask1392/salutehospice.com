@php 
/**
 * Layout 
 */ 
$padding = get_sub_field('section_padding');
$content_width = get_sub_field("content_width");
$justify_content = get_sub_field("justify_content");
$inc_post_content_block = get_sub_field("inc_post_content_block");
$inc_pre_content_block = get_sub_field("inc_pre_content_block");
$vertical_content_align = get_sub_field("vertical_content_align");
$swap_image = get_sub_field('swap_image_and_text') ? ' order-3 order-md-1' : ' order-1';
$ul_type = get_sub_field("list_type") ?: "";
$asymetric = get_sub_field('asymetric_layout');
$priority = get_sub_field('priority');
$col_left;
$col_right;
if ($asymetric == true & $priority == 'left') { 
    $col_left = "col-md-7";
    $col_right = "col-md-5";
} else {
    $col_left = "col-md-5";
    $col_right = "col-md-7";
}

/**
 * Colors 
 */ 
$body_text_color = get_sub_field('body_text_color');
$header_text_color = get_sub_field('header_text_color');

/**
 * Background
 */ 
$bkg_image = get_sub_field('background_image');
$bkg_color = get_sub_field('background_color');
$bkg_overlay_opacity = get_sub_field('background_color_opacity');
$is_gradient = get_sub_field('gradient');
$has_background = ($bkg_image['url'] || $bkg_color && $bkg_color != "none" ) ? ' has-background' : '';

/**
 * Content
 */
$col_1_content;
$col_2_content;
$col_1_content_type;
$col_2_content_type;

switch (get_sub_field('layout_options')) {
  case 'text_image':
    $col_1_content_type = ' text pr-lg-5';
    $col_2_content_type = ' image';
    $col_2_content = (get_sub_field('uncrop_image'))
      ? '<img class="w-100" src="' . get_sub_field('image_rhs')['url'] . '">'
      : '<div class="split-layout__image" style="background-image: url(' . get_sub_field('image_rhs')['url'] . ')"></div>';
    $col_1_content = get_sub_field('text_lhs');
    break;

  case 'image_text':
    $col_1_content_type = ' image';
    $col_2_content_type = ' text pl-lg-5';
    $col_1_content = (get_sub_field('uncrop_image'))
      ? '<img class="w-100" src="' . get_sub_field('image_lhs')['url'] . '">'
      : '<div class="split-layout__image" style="background-image: url(' . get_sub_field('image_lhs')['url'] . ')"></div>';
    $col_2_content = get_sub_field('text_rhs');
    break;
}
  
@endphp


<section id="section-{{ $section_index }}" {{ App\get_section_classes('split-layout'. $has_background) }}>

  <!-- Section specific styles -->
  <style>
    #section-{{ $section_index }} {
      padding: {{$padding['padding_top']}}px {{$padding['padding_right']}}px {{$padding['padding_bottom']}}px {{$padding['padding_left']}}px;
      <?php if ($bkg_image['url']): ?>background-image: url('{{ $bkg_image['url'] }}');<?php endif; ?>
      color: {{ $body_text_color }};
      justify-content: {{ $justify_content }};
      align-items: center;
      background-position: center;
    }

    #section-{{ $section_index }} h2,
    #section-{{ $section_index }} h3,
    #section-{{ $section_index }} h4,
    #section-{{ $section_index }} h5,
    #section-{{ $section_index }} h6 {
      color: {{ $header_text_color }};
    }

    #section-{{ $section_index }} .is-background {
      <?php if ($is_gradient): ?>
      background: linear-gradient(to right, {{$bkg_color}} 40%, rgba({{App\hex2RGB($bkg_color, true)}}, 0) 100%);
      <?php else : ?>
      background: {{ $bkg_color }};
      <?php endif; ?>
      opacity: {{ $bkg_overlay_opacity }};
    }
  </style>
  <!-- Section specific styles END -->

  @if ($has_background) <div class="is-background"></div> @endif
  @if ($inc_pre_content_block)
  <div class="container container--narrow">
    <div class="row">
      <div class="pre-content mb-5 col"> 
        {!! get_sub_field('pre_content_block') !!}
      </div>
    </div>
  </div>
  @endif
  <div class="{{ $content_width }} content align-items-{{ $vertical_content_align }} {{ $ul_type }}">

    <div class="row align-items-{{ $vertical_content_align }}">
      <div class="{{ $asymetric ? $col_left : 'col-md-6' }}{{ $col_1_content_type }}{{ $swap_image }}">
        {!! $col_1_content !!}
      </div>
      <div class="{{ $asymetric ? $col_right : 'col-md-6' }}{{ $col_2_content_type }} order-2">
        {!! $col_2_content !!}
      </div> 
    </div>
    @if ($inc_post_content_block)
    <div class="container--narrow">
      <div class="row">
        <div class="section-intro mt-5 col"> 
          {!! get_sub_field('post_content_block') !!}
        </div>    
      </div>
    </div>
    @endif
  </div>
    
</section>