@extends('student.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('student.includes.header')
  <div class="app-main"> @include('student.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <div class="card-shadowNone">
          <ol class="nobg breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('student-dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Account Setting</li>
          </ol>
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card">
                <div class="card-header">Account Settings</div>
                <div class="card-body">
                  <div class="tab">
                 <button class="tablinks active" onclick="openCity(event, 'account')"
                                            id="click_account">Account</button>
                    <button class="tablinks" onclick="openCity(event, 'password')" id="click_password">Change Password</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12"> @include('student.includes.alert')
              <div class="tabcontent" id="account" style="display: block;">
                <div class="card mb-4">
                  <div class="card-header">Profile info</div>
                  <div class="card-body">
                    <div id="publicInfoContainer" class="row d-flex">
                      <div class="col-md-8 order-2 order-md-1">
                        <form action="{{ $profile_action }}" method="post" enctype="multipart/form-data">
                          @csrf
                          <div class="position-relative form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" value="{{old('name' , isset($user->name)? $user->name : '' )}}"  type="text">
                            @if($errors->has('name'))
                            <div class="error">{{$errors->first('name')}}</div>
                            @endif </div>
                          <div class="position-relative form-group">
                            <label>Email</label>
                            <input class="form-control" name="email" value="{{old('email' , isset($user->email)? $user->email : '' )}}"  type="email" readonly>
                            @if($errors->has('email'))
                            <div class="error">{{$errors->first('email')}}</div>
                            @endif </div>
                          <div class="position-relative form-group">
                            <label>Country</label>
                            <input  name="country" type="text" value="{{old('country' , isset($user->address)? $user->address : '' )}}" class="form-control">
                            @if($errors->has('country'))
                            <div class="error">{{$errors->first('country')}}</div>
                            @endif </div>
                          <div class="row d-none">
                            <div class="mb-2 col-sm-4">
                              <div class="position-relative form-group">
                                <label>City</label>
                                <input  name="city" type="text" value="{{old('city' , isset($user->city)? $user->city : '' )}}" class="form-control">
                                @if($errors->has('city'))
                                <div class="error">{{$errors->first('city')}}</div>
                                @endif </div>
                            </div>
                            <div class="mb-3 col-sm-4">
                              <div class="position-relative form-group">
                                <label>State</label>
                                <input  name="state" type="text" value="{{old('state' , isset($user->state)? $user->state : '' )}}" class="form-control">
                                @if($errors->has('state'))
                                <div class="error">{{$errors->first('state')}}</div>
                                @endif </div>
                            </div>
                            <div class="mb-3 col-sm-4">
                              <div class="position-relative form-group">
                                <label>Zip</label>
                                <input  name="zip" type="text" value="{{old('zip' , isset($user->zip)? $user->zip : '' )}}" class="form-control">
                                @if($errors->has('zip'))
                                <div class="error">{{$errors->first('zip')}}</div>
                                @endif </div>
                            </div>
                          </div>
                          <div class="position-relative form-group">
                            <label class="form-label">Image</label>
                            <br>
                            <input name="image" type="file" accept="image/*" />
                            <input name="old_image" type="hidden" value="{{ isset($user->image)? $user->image : '' }}" />
                          </div>
                          <smart-button  role="button">
                            <button class="btn btn-success" type="submit" role="presentation" tabindex="0">Save changes</button>
                          </smart-button>
                        </form>
                      </div>
                      <div class="col-md-4 order-1 order-md-2 text-center">
                        <div class="avatar-holder mb-3">
                          <div class="proPic picCricle mx-auto"> @if($user && $user->image)
                            <div id="image">
                              <div style="margin:5px 0 0 0;"> <img src="{{asset('/storage/uploads/student/'.$user->image)}}"
                                style="height:200px; border-radius:10px" /> </div>
                              <div style="margin:5px 0 0 0;">
                                <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('image')">Delete
                                Image</button>
                              </div>
                            </div>
                            @else <img src="{{asset('assets/images/no-image.jpg')}}"> @endif </div>
                        </div>
                        <small>Choose an image no <br>
                        larger than 1MB</small> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tabcontent" id="password" style="display: none;">
                <div class="card">
                  <div class="card-header">Password </div>
                  <div class="card-body">
                    <div id="privateInfoContainer">
                      <form action="{{ $password_action }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                          <div class="col-sm-12">
                            <div class="position-relative form-group">
                              <label>Current password</label>
                              <input class="form-control" name="old_password" placeholder="Password" type="password">
                              @if($errors->has('old_password'))
                              <div class="error">{{$errors->first('old_password')}}</div>
                              @endif </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="position-relative form-group">
                              <label>New password </label>
                              <input class="form-control" name="new_password"  placeholder="Password" type="password">
                              @if($errors->has('new_password'))
                              <div class="error">{{$errors->first('new_password')}}</div>
                              @endif </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="position-relative form-group">
                              <label>Verify password </label>
                              <input class="form-control" name="verify_password" value="{{old('verify_password')}}" placeholder="Password (again)" type="password">
                              @if($errors->has('verify_password'))
                              <div class="error">{{$errors->first('verify_password')}}</div>
                              @endif </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="position-relative form-group">
                              <button class="btn btn-success" type="submit" role="presentation" >Save changes</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php /*?><div class="tabcontent" id="billing" style="display: none;">
                <div class="card mb-4">
                  <div class="card-header">Billing info</div>
                  <div class="card-body">
                    <form action="#" class="form-horizontal">
                      <div class="form-group row">
                        <label for="name_on_invoice"
                                                    class="col-sm-3 col-form-label form-label">Name on Invoice</label>
                        <div class="col-sm-9 col-md-9">
                          <input id="name_on_invoice" type="text" class="form-control"
                                                        value="Adrian Demian">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="billing_address"
                                                    class="col-sm-3 col-form-label form-label">Address</label>
                        <div class="col-sm-9 col-md-9">
                          <input id="billing_address" type="text" class="form-control"
                                                        value="Sunny Street, 21, Miami, Florida">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="billing_country"
                                                    class="col-sm-3 col-form-label form-label">Country</label>
                        <div class="col-sm-9 col-md-9">
                          <select id="billing_country"
                                                        class="custom-control custom-select form-control">
                            <option value="1" selected="">USA</option>
                            <option value="2">India</option>
                            <option value="3">United Kingdom</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="col-sm-6 col-md-4 offset-sm-3"> <a href="#" class="btn btn-success"> Update Billing</a> </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card paymentInfo">
                  <div class="card-header">Payment Info </div>
                  <ul class="card-footer p-0 list-group list-group-fit">
                    <li class="list-group-item active">
                      <div class="media align-items-center">
                        <div class="media-left"> <span class="btn btn-primary btn-circle"><i
                                                            class="fa fa-credit-card"></i></span> </div>
                        <div class="media-body">
                          <p class="mb-0">**** **** **** 2422</p>
                          <small>Updated on 12/02/2016</small> </div>
                        <div class="media-right"> <a href="#" class="btn btn-primary btn-sm"> <i class="fa fa-pencil btn__icon--left"></i> EDIT </a> </div>
                      </div>
                    </li>
                    <li class="list-group-item">
                      <div class="media align-items-center">
                        <div class="media-left"> <span class="btn btn-white btn-circle"><i
                                                            class="fa fa-credit-card"></i></span> </div>
                        <div class="media-body">
                          <p class="mb-0">**** **** **** 6321</p>
                          <small class="text-muted">Updated on 11/01/2016</small> </div>
                        <div class="media-right"> <a href="#" class="btn btn-white btn-sm"> <i class="fa fa-pencil btn__icon--left"></i> EDIT </a> </div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div><?php */?>
            </div>
          </div>
        </div>
      </div>
      @include('student.includes.footer') </div>
  </div>
</div>
@endsection

@section('footer-scripts') 
<script>
function openCity(evt, cityName) {
                        var i, tabcontent, tablinks;
                        tabcontent = document.getElementsByClassName("tabcontent");
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }
                        tablinks = document.getElementsByClassName("tablinks");
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                        }
                        document.getElementById(cityName).style.display = "block";
                        evt.currentTarget.className += " active";
						localStorage.setItem('lastTab_ins_acc', 'click_'+cityName);
                    }
var lastTab = localStorage.getItem('lastTab_ins_acc');
if (lastTab) {
	 document.getElementById(lastTab).click();
} else {
	 document.getElementById('click_account').click();
}
					
$().ready(function() {
	 //to delete
    confirmDelete = function(field_name) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("student-account-imagedelete")}}',
                    type: 'POST',
                    data: {
                        'id': '{{ @$user->id }}',
                        'field_name': field_name,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#" + field_name).remove();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        );
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                )
            }
        })
    }
   
});
</script> 
@endsection