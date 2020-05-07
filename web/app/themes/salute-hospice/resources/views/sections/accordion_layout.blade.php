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
@endphp

<section id="section-{{ $section_index }}" {{ App\get_section_classes('accordion-section'. $has_background) }}>
  
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

  @if ($inc_pre_content_block)
  <div class="container container--narrow">
    <div class="row">
      <div class="pre-content mb-5 col"> 
        {!! get_sub_field('pre_content_block') !!}
      </div>
    </div>
  </div>
  @endif

  <div class="{{ $content_width }} py-5">   
    <div class="accordion-wrapper row">
      @if (have_rows('section_content'))
        @while (have_rows('section_content')) @php the_row() @endphp
        @php $unique_id = $section_index . '' . get_row_index() @endphp 
          <div class="accordion" id="accordion-{{ $unique_id }}">
            <div class="accordion-card">
                
              <div  class="card-header p-4 collapsed" 
                    id="heading-{{ $unique_id }}" 
                    data-toggle="collapse" 
                    data-target="#collapse-{{ $unique_id }}" 
                    aria-expanded="true" 
                    aria-controls="collapse-{{ $unique_id }}">
          
                  <h5 class="card-title">
                      {{ get_sub_field('accordion_header') }}
                  </h5>
                  <div class="expand-symbol">
                    <span></span>
                  </div>
              </div>
          
              <div 
                id="collapse-{{ $unique_id }}" 
                class="collapse" 
                aria-labelledby="heading-{{ $unique_id }}" 
                data-parent="#accordion-{{ $unique_id }}">
                  <div class="card-body p-5">
                      {!! get_sub_field('accordion_content') !!}
                  </div>
              </div>
            </div>
          </div>
        @endwhile
        @endif
             
    </div>
  </div>
    
</section>

