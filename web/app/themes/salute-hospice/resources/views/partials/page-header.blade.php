@php 
// if page is posts archive
if (is_home()) {
  $feature_img_url = get_the_post_thumbnail_url(get_option('page_for_posts')) ?: \App\asset_path('images/default-blog-header.jpg');
  $display_page_header = get_field('display_page_header', get_option('page_for_posts'));
  $title = get_field('alternative_page_header', get_option('page_for_posts')) ?: App::title();
  $bkg_color = 'white';
} 
elseif (is_single()) {
  $feature_img_url = get_the_post_thumbnail_url();
  $title = App::title();
  $bkg_color = 'white';
}
else {
  $feature_img_url = get_the_post_thumbnail_url();
  $display_page_header = get_field('display_page_header');
  $title = the_field('alternative_page_header') ?? App::title();
  $bkg_color = get_field("background_color") ?? 'white';
}

$bkg_overlay = true;
$overlay = "linear-gradient(to right, rgba(255, 255, 255, 0.6), rgba(255,255,255,0)), ";

@endphp

@if (get_field('display_page_header') | is_home() | is_single() | is_archive()) 
<section class="page-header" style="background-image: {{ $overlay }}url('{{ $feature_img_url }}');">
  <div class="container content--header d-flex align-items-center">
    <h1 class="icon--lg"> {!! $title !!} </h1>
  </div>
</section>
@endif