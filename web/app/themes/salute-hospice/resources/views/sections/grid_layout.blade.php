@php 
/**
 * Layout 
 */ 
$padding = get_sub_field('section_padding');
$col_class = get_sub_field('split_column') ? "col-md-6" : 'col'; 
$content_width = get_sub_field('content_width');
$layout_type = get_sub_field('layout_type');
$justify_content = get_sub_field("justify_content");
$inc_post_content_block = get_sub_field("inc_post_content_block");
$inc_pre_content_block = get_sub_field("inc_pre_content_block");
$vertical_content_align = get_sub_field("vertical_content_align");
$max_items_per_row = get_sub_field('max_items_per_row'); // default 'no limit'
$col_width;
switch ($max_items_per_row) {
  case 1: $col_width = "col-lg-12"; break;
  case 2: $col_width = "col-lg-6"; break;
  case 3: $col_width = "col-sm-6 col-lg-4"; break;
  case 4: $col_width = "col-sm-6 col-lg-3"; break;
  default: $col_width = "col-sm-6 col-md-3 col-lg-2"; break;
}

/**
 * Colors 
 */ 
$body_text_color = get_sub_field('body_text_color');
$header_text_color = get_sub_field('header_text_color');
$card_color = get_sub_field('card_color');

/**
 * Background
 */ 
$bkg_image = get_sub_field('background_image');
$bkg_color = get_sub_field('background_color');
$bkg_overlay_opacity = get_sub_field('background_color_opacity');
$is_gradient = get_sub_field('gradient');
$has_background = ($bkg_image['url'] || $bkg_color && $bkg_color != "none" ) ? ' has-background' : '';

@endphp 

<section id="section-{{ $section_index }}" {{ App\get_section_classes('grid-layout'. $has_background) }}">

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

    #section-{{ $section_index }} .card {
      background: {{ $card_color }};
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
  <div class="content container container--narrow">
    <div class="row">
      <div class="pre-content mb-5 col"> 
        {!! get_sub_field('pre_content_block') !!}
      </div>
    </div>
  </div>
  @endif
  
  <div class="container {{ $content_width }} content align-items-{{ $vertical_content_align }}">

    <div class="row justify-content-{{ $justify_content }} {{ $layout_type }}">
      @if (have_rows('grid_content'))
        @while (have_rows('grid_content')) @php the_row() @endphp
        @php
        $card_image = get_sub_field('card_image');
        $card_link = get_sub_field('link');
        $card_color = get_sub_field('card_color');
        @endphp
        <div class="{{ $col_width }} my-4 {{$layout_type}}">
          @if (!empty($card_link)) <a class="card-link" href="{{ $card_link }}"> @endif 
          <div class="card mx-auto" style="background: {{ $card_color }}">
            @switch($layout_type)
              @case('numbered-grid')
                <div class="numbered-img p-3 text-center">{{ get_row_index() }}</div>
                @break
              @case('image-grid')
                <img class="card-img" src="{{ $card_image['url'] }}" alt="{{ $card_image['alt'] }}">
                @break
              @case('image-as-background')
                <img class="card-img" src="{{ $card_image['url'] }}" alt="{{ $card_image['alt'] }}">
                @break
            @endswitch
            <div class="card-body">
              <div class="header"><h4>{{ get_sub_field('header') }}</h4></div>
              {{ get_sub_field('content') }}
            </div>
          </div>
          @if (!empty(get_sub_field('link'))) </a> @endif 
        </div>
        @endwhile 
      @endif
    </div>

    @if ($inc_post_content_block)
    <div class="row">
      <div class="content section-intro mt-5 col"> 
        {!! get_sub_field('post_content_block') !!}
      </div>    
    </div>
    @endif
  </div>
  
</section>
