@php
use App\Models\Category;
use App\Models\Setting;
$categories = Category::where('status', '1')->inRandomOrder()->limit(5)->get();
$setting = Setting::first();
@endphp
<footer class="bgBlue txtwhite pt-5 pb-0 mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="footerBox">
          <div class="footerLogo"><img src="{{ asset('assets/images/edruptz-logo.svg')}}" alt="edruptz"/></div>
          <p class="ftrTxt">
            {!! nl2br($setting->address) !!}<br/>
            Email:  {{ $setting->email }}</p>
        </div>
      </div>
      <div class="col-lg-5 col-md-5 col-sm-12">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="footerBox">
              <h2>Quick Links</h2>
              <ul class="ftrList">
                <li><a href="{{route('/')}}">Home</a></li>
                <li><a href="{{ route('courses') }}">Courses</a></li>
                <li><a href="{{ route('blog') }}">Blogs</a></li>
                <li><a href="{{ route('contact') }}">Contact us</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="footerBox">
              <h2>Quick Links</h2>
              <ul class="ftrList">
                <li><a href="{{ route('about-edruptz') }}">About us</a></li>
                {{-- <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li> --}}
                <li><a href="{{ route('terms-conditions') }}">Terms & Conditions</a></li>
                <li><a href="{{ route('faq') }}">FAQs</a></li>
              </ul>
            </div>
          </div>
          <?php /*?><div class="col-lg-6 col-md-6 col-sm-12">
            <div class="footerBox">
              <h2>Popular Courses</h2>
              <ul class="ftrList">
                @if($categories)
                @foreach($categories as $catgeory)
                <li><a href="{{$catgeory->slug}}">{{$catgeory->name}}</a></li>
                @endforeach
                @endif
              </ul>
            </div>
          </div><?php */?>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12">
        <div class="footerBox">
          <h2>Newsletter Signup</h2>
          <p>Stay up to date with Edruptz</p>
          <form action="{{ route('newsletter') }}"  method="post">
            @csrf
            <div class="form-group">
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
              <input type="submit" class="btn btn-green" value="Subscribe">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <section class="copyright txtwhite mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Copyright &copy; {{ date('Y') }} Edruptz. The trademarks, logos, courses and the content appearing therein, is exclusively owned by Edruptz and/or its licensors, and are protected. Any unauthorized use or reproduction or distribution, shall attract suitable action under applicable law.</p>
        </div>
      </div>
    </div>
  </section>
</footer>
