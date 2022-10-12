@include('admin.includes.metahead')
<body>
<div class="login-area">
  <div class="d-table">
    <div class="d-table-cell">
      <div class="login-form">
        <div class="login-image"><img src="{{ asset('assets/admin/img/edruptz.svg') }}"/></div>
        <h2>Admin Login</h2>
       @include('admin.includes.alert')
        <form method="post" action="{{ route('admin-checkLogin') }}">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="Email" value="{{old('email')}}">
            <span class="label-title"><i class='bx bx-user'></i></span> @if($errors->has('email'))
            <div class="error">{{$errors->first('email')}}</div>
            @endif </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="label-title"><i class='bx bx-lock'></i></span> @if($errors->has('password'))
            <div class="error">{{$errors->first('password')}}</div>
            @endif </div>
          <button type="submit" class="login-btn">Login</button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('admin.includes.scripts')
</body>
</html>