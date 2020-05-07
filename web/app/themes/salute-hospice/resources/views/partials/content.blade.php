<article {{ post_class('container post-card') }}>
  <div class="row">

    <div class="col-md-5 post-card__image p-0">      
      <img class="w-100" src="{{ the_post_thumbnail_url('large') }}" alt="">
    </div>

    <div class="col-md-7 align-self-center post-card__content p-5">
      <img class="heart-background" src="@asset('images/heart-logo.png')" alt="">
      <header>
        <h2 class="entry-title"><a href="{{ get_permalink() }}">{!! get_the_title() !!}</a></h2>
      </header>
      
      <div class="d-flex justify-content-start">
        @include('partials/entry-meta')
      </div>
        
      
      <div class="entry-summary">
        @php the_excerpt() @endphp
      </div>

      <a href="{{get_the_permalink()}}">
        <button class="mt-3 btn btn--primary">
          <span>Read More</span>
        </button>
      </a>
    </div>
    
  </div>
</article>
  