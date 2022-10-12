@extends('student.layout')
@section('content')
    <div class="main-content d-flex flex-column">
        @include('student.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Account Settings</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('student-dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
                <li class="item">Account Settings</li>
            </ol>
        </div>

        <div class="faq-area mb-30">
            <div class="tab faq-accordion-tab">
                <ul class="tabs d-flex flex-wrap">
                    <li><a href="#"><span>Profile Information</span></a></li>
                    <li><a href="#"><span>Change Password</span></a></li>
                </ul>

                <div class="tab_content">
                    @include('student.includes.alert')

                    <div class="tabs_item">
                        <div class="row d-flex">
                            <div class="col-md-8 order-2 order-md-1">
                                <form action="{{ $profile_action }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input class="form-control" name="name"
                                            value="{{ old('name', isset($user->name) ? $user->name : '') }}" type="text">
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" name="email"
                                            value="{{ old('email', isset($user->email) ? $user->email : '') }}"
                                            type="email" readonly>
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                            <input  name="country" type="text" value="{{old('country' , isset($user->address)? $user->address : '' )}}" class="form-control">
                            @if($errors->has('country'))
                            <div class="error">{{$errors->first('country')}}</div>
                            @endif
                                    </div>
                                    <div class="row hide">
                                        <div class="mb-2 col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">City</label>
                                                <input name="city" type="text"
                                                    value="{{ old('city', isset($user->city) ? $user->city : '') }}"
                                                    class="form-control">
                                                @if ($errors->has('city'))
                                                    <div class="error">{{ $errors->first('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">State</label>
                                                <input name="state" type="text"
                                                    value="{{ old('state', isset($user->state) ? $user->state : '') }}"
                                                    class="form-control">
                                                @if ($errors->has('state'))
                                                    <div class="error">{{ $errors->first('state') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-3 col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label">Zip</label>
                                                <input name="zip" type="text"
                                                    value="{{ old('zip', isset($user->zip) ? $user->zip : '') }}"
                                                    class="form-control">
                                                @if ($errors->has('zip'))
                                                    <div class="error">{{ $errors->first('zip') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <br>
                                        <input name="image" type="file" accept="image/*" />
                                        <input name="old_image" type="hidden"
                                            value="{{ isset($user->image) ? $user->image : '' }}" />
                                    </div>
                                    <smart-button role="button">
                                        <button class="btn btn-success" type="submit" role="presentation"
                                            tabindex="0">Update Information</button>
                                    </smart-button>
                                </form>
                            </div>
                            <div class="col-md-4 order-1 order-md-2 text-center">
                                <div class="avatar-holder mb-2">
                                    <div class="proPic picCricle mx-auto">
                                        @if ($user && $user->image)
                                            <div id="image">
                                                <div style="margin:5px 0 0 0;"> <img
                                                        src="{{ asset('/storage/uploads/student/' . $user->image) }}"
                                                        style="height:200px; border-radius:50%; border: 5px solid #05A3AD" /> </div>
                                                <div style="margin:10px 0 0 0;">
                                                    <button type="button" class="btn btn-xs btn-danger"
                                                        Onclick="confirmDelete('image')">Delete
                                                        Image</button>
                                                </div>
                                            </div>
                                        @else
                                            <img src="{{ asset('assets/images/no-image.jpg') }}">
                                        @endif
                                    </div>
                                </div>
                                <small>Choose an image no larger than 1MB</small>
                            </div>
                        </div>


                    </div>

                    <div class="tabs_item">
                        <form action="{{ $password_action }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 col-md-6">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input class="form-control" name="old_password" placeholder="Password"
                                            type="password">
                                        @if ($errors->has('old_password'))
                                            <div class="error">{{ $errors->first('old_password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">New Password </label>
                                        <input class="form-control" name="new_password" placeholder="Password"
                                            type="password">
                                        @if ($errors->has('new_password'))
                                            <div class="error">{{ $errors->first('new_password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="form-label">Verify Password </label>
                                        <input class="form-control" name="verify_password"
                                            value="{{ old('verify_password') }}" placeholder="Password (again)"
                                            type="password">
                                        @if ($errors->has('verify_password'))
                                            <div class="error">{{ $errors->first('verify_password') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <button class="btn btn-success" type="submit" role="presentation">Update
                                            Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="flex-grow-1"></div>

        @include('student.includes.footer')
    </div>
@endsection



@section('footer-scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
    <script>
        $().ready(function() {
            ClassicEditor.create(document.querySelector('.description'), {
                removePlugins: ['CKFinder', 'EasyImage', 'Image', 'ImageUpload', 'MediaEmbed']
            });
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
                            url: '{{ route('student-account-imagedelete') }}',
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
