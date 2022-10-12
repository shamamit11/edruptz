@if($banners->count() > 0)
<div id="bannerCarousel" class="mainBanner carousel slide" data-bs-ride="carousel">@php $cnt = 0; @endphp
  <div class="carousel-indicators"> @foreach($banners as $banner)
    <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="{{ $cnt }}" class="@if($cnt == 0) active @endif"></button>
    @php $cnt++; @endphp
    @endforeach </div>
  <div class="carousel-inner"> @php $cnt = 1; @endphp
    @foreach($banners as $banner)
    <div class="carousel-item @if($cnt == 1) active @endif"> <img src="{{asset('/storage/uploads/banner/'.$banner->image)}}" alt="{{ $banner->name }}" class="d-block w-100"  alt="EDRUPTZ">
      <div class="overlay"></div>
      <div class="carousel-caption d-none d-md-block">
        <h1>{{ $banner->name }}</h1>
        <p>{!! @nl2br($banner->description) !!}</p>
        <ul class="banList">
          <li><a class="btnBlue" href="{{ route('courses') }}">Explore Courses</a></li>
          <li><a class="btnGreen" href="{{ route('register') }}">Host A Course</a></li>
        </ul>
      </div>
    </div>
    @php $cnt++; @endphp
    @endforeach </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> </button>
  <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> </button>
</div>
@endif