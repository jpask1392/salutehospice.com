<div class="post-meta-data flex-wrap py-2 m-0">

  <span class="byline author vcard mr-2">
    <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
      <i class="fas fa-user mr-2"></i> {{ get_the_author() }}
    </a>
  </span>

  <time class="mx-5 updated mr-2" datetime="{{ get_post_time('u', true) }}"><i class="far fa-calendar-alt mr-2"></i>{{ get_the_date('m/d/y') }}</time>

  <span class="category">
      <i class="fas fa-tag mr-2"></i>{{ the_category() }}
  </span>

</div>