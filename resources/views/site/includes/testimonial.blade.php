@if($reviews->count() > 0)
<section class="bgGreen testimonialBelt mt-5 pt-5 pb-5">
  <div class="container">
    <div class="lead-testimonial-cont">
      <div class="lead-tstmnl-slider">
      @foreach($reviews as $review)
        <div class="lead-tstmnl-slide">
          <div class="lead-tstmnl-img"> @if($review->image) <img src="{{asset('/storage/uploads/review/'.$review->image)}}" alt=""> @else <img src="{{asset('assets/images/no-image.jpg')}}" alt=""> @endif </div>
          <div class="lead-tstmnl-text-cont">
            <ul class="lead-tstmnl-nm-dsg">
              <li>{{ $review->name }}</li>
              <li> {{ $review->designation }}</li>
            </ul>
            <span class="lead-tstmnl-comment">{!! $review->description !!} </span> </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif