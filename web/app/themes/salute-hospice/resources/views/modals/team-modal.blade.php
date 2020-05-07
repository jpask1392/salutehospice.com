<!-- Modal -->
<div class="modal fade" id="teamModal" tabindex="-1" role="dialog" aria-labelledby="teamModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-5">
        <div class="member-picture">
          <img src="@asset('images/heart-logo.png')" alt="">
          <img class="member-picture__img" src="{{get_the_post_thumbnail_url()}}" alt="">
          <img src="@asset('images/heart-logo.png')" alt="">
        </div>
        <h3>{{get_field('name')}}</h3>
        <h4 class="team-job-title">{{ get_field('job_title') }}</h4>
        {!! get_field('bio') !!}
      </div>
    </div>
  </div>
</div>