@php 
/**
 * Layout 
 */ 
$padding = get_sub_field('section_padding');
$col_class = get_sub_field('split_column') ? "col-md-6" : 'col'; 
$content_width = get_sub_field("content_width");
$ul_type = get_sub_field("list_type") ?: "";
$justify_content = get_sub_field("justify_content");
$inc_post_content_block = get_sub_field("inc_post_content_block");
$inc_pre_content_block = get_sub_field("inc_pre_content_block");
$vertical_content_align = get_sub_field("vertical_content_align");
$column_count = get_sub_field('split_column') ? 2 : 1;

/**
 * Colors 
 */ 
$body_text_color = get_sub_field('body_text_color');
$header_text_color = get_sub_field('header_text_color');
$column_bkg_color = get_sub_field('column_background_color');
$container_bkg_color = get_sub_field('container_background_color');

/**
 * Background
 */ 
$bkg_image = get_sub_field('background_image');
$bkg_color = get_sub_field('background_color');
$bkg_overlay_opacity = get_sub_field('background_color_opacity');
$is_gradient = get_sub_field('gradient');
$has_background = ($bkg_image['url'] || $bkg_color && $bkg_color != "none" ) ? ' has-background' : '';
 
@endphp

<section id="section-{{ $section_index }}" {{ App\get_section_classes('standard-layout'. $has_background) }}>

  <!-- Section specific styles -->
  <style>
    #section-{{ $section_index }} {
      padding: {{$padding['padding_top']}}px {{$padding['padding_right']}}px {{$padding['padding_bottom']}}px {{$padding['padding_left']}}px;
      <?php if ($bkg_image['url']): ?>background-image: url('{{ $bkg_image['url'] }}');<?php endif; ?>
      color: {{ $body_text_color }};
      justify-content: {{ $justify_content }};
      align-items: center;
      background-position: center;
      background-size: cover;
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

    #section-{{ $section_index }} .content {
      align-content: {{ $vertical_content_align }};
    }
    
  </style>
  <!-- Section specific styles END -->

  @if ($has_background) <div class="is-background"></div> @endif
  <div class="{{ $content_width }} content {{ $ul_type }}">

      @if ($inc_pre_content_block)
      <div class="row">
        <div class="pre-content mb-5 col"> 
          {!! get_sub_field('pre_content_block') !!}
        </div>
      </div>
      @endif
      @while (have_rows('section_content')) @php the_row() @endphp
        <div class="mb-3 row">
          @if (get_sub_field('split_section'))
            <div class="col-md-6">
              {!! get_sub_field('content_lhs') !!}
            </div>
            <div class="col-md-6">
              {!! get_sub_field('content_rhs') !!}
            </div>  
          @else 
            <div class="col">{!! get_sub_field('text') !!}</div>
          @endif
        </div>
      @endwhile 
      @if ($inc_post_content_block)
      <div class="row">
        <div class="section-intro mt-5 col"> 
          {!! get_sub_field('post_content_block') !!}
        </div>    
      </div>
      @endif
    </div>
  </div>
</section>