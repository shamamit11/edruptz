<section class="whyPort pt-5 pb-5">
  <div class="container">
    <div class="row gx-5">
      <div class="col-lg-6 col-md-6 col-sm-12">
        <h1 class="txtBlue">{{ $why->title }}</h1>
        <div class="card-text">{!! $why->description !!}</div>
      
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="videoBox">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $why->video }}" title="{{ $why->title }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>