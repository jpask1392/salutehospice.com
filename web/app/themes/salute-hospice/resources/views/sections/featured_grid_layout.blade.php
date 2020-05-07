@php 
/**
 * Content
 */
$content = get_sub_field('grid_content');
$post_type = $content['filter_by_post_type'] ?: 'any'; // 'any' for all post types
$limit = $content['limit'];
$order_by = $content['order_by'];
$asc_desc = $content['asc_desc'];
$ids = $content['show_posts'] ?: '';
$loop = new WP_Query(array( 
  'post_type'         => $post_type,
  'posts_per_page'    => $limit,
  'order_by'          => $order_by, 
  'order'             => $asc_desc,
  'post__in'			    => $ids
));

/**
 * Layout 
 */ 
$padding = get_sub_field('section_padding');
$layout_type = get_sub_field('layout_type');
$col_class = get_sub_field('split_column') ? "col-md-6" : 'col'; 
$content_width = get_sub_field('content_width');
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

<section id="section-{{ $section_index }}" {{ App\get_section_classes('ft-grid'. $has_background) }}>

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
  <div class="{{ $content_width }} content align-items-{{ $vertical_content_align }}">
    
    @if ($inc_pre_content_block)
    <div class="row">
      <div class="pre-content mb-5 col"> 
        {!! get_sub_field('pre_content_block') !!}
      </div>
    </div>
    @endif
    @if ($loop->have_posts())
      <div class="row justify-content-{{ $justify_content }} ft-grid__card-group">
      @while ($loop->have_posts()) @php $loop->the_post() @endphp
      <!-- Feature grid card -->
      <div class="{{ $col_width }} ft-grid__card mb-5">
        <div class="ft-grid__picture">
          <div class="ft-grid__picture__sizer">
            <img src="{{ get_the_post_thumbnail_url() }}" alt="">
          </div>
        </div>
        <div class="ft-grid__info py-4">
          <h3 class="name">{{ get_field('name') }}</h3>
          <h4 class="job-title">{{ get_field('job_title') }}</h4>
        </div>
        @if(!empty(get_field('bio'))) 
        <button class="btn btn--primary" data-toggle="modal" data-target="#teamModal">
          View Bio
        </button>
        @endif 
      </div>
      @include('modals.team-modal')
      @endwhile
      {{ wp_reset_query() }}
    </div>
    @endif
    @if ($inc_post_content_block)
    <div class="row">
      <div class="section-intro mt-5 col"> 
        {!! get_sub_field('post_content_block') !!}
      </div>    
    </div>
    @endif
  </div>
</section>


