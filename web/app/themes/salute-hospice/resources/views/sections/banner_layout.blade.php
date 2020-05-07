@php 
// Layout
$container_width = get_sub_field("container_width");
$justify_content = get_sub_field("justify_content");
$vertical_content_align = get_sub_field("vertical_content_align");

// Images 
$bkg_image = get_sub_field('background_image')['url'];
@endphp


<section class="banner-section align-items-center">

  <div class="standard-background">
    <div  class="bg-gradient-red background-overlay"></div>
    <div  class="background-image" 
          style="background-image: url('{{ $bkg_image }}'); background-position: center; "></div>
  </div>

  <div class="{{ $container_width }} py-5">

    <div class="row align-items-{{ $vertical_content_align }}">
      <div class="col-md-6">
        {!! get_sub_field('content') !!}
      </div>
    </div>
  </div>
    
</section>