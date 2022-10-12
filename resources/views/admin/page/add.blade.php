@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Pages</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-page')}}">Pages</a></li>
            <li class="item">{{ $title }}</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ $title }}</h3>
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="{{$action}}" id="form">
                @csrf
                <input type="hidden" class="form-control" name="id" value="{{ isset($row->id)? $row->id : '' }}">
                <input type="hidden" class="form-control" name="slug" value="{{ isset($row->slug)? $row->slug : '' }}">
                <div class="mb-3">
                    <label class="form-label"> Section</label>
                    <select class="form-control" name="page_section_id" id="page_section_id">
                        @foreach ($page_sections as $page_section ) {
                        <option value="{{ $page_section->id }}" @if(isset($row->page_section_id) &&
                            $row->page_section_id == $page_section->id) selected @endif>
                            {{ $page_section->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Page Name</label>
                    <input type="text" class="form-control" name="name"
                        value="{{old('name' , isset($row->name)? $row->name : '' )}}">
                    @if($errors->has('name'))
                    <div class="error">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Page Title</label>
                    <input type="text" class="form-control" name="title"
                        value="{{old('title' , isset($row->title)? $row->title : '' )}}">
                    @if($errors->has('title'))
                    <div class="error">{{$errors->first('title')}}</div>
                    @endif
                </div>
                <div class="mb-3 hide">
                    <label class="form-label">Page Sub Title</label>
                    <input type="text" class="form-control" name="sub_title"
                        value="{{old('sub_title' , isset($row->sub_title)? $row->sub_title : '' )}}">
                    @if($errors->has('sub_title'))
                    <div class="error">{{$errors->first('sub_title')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label"> Short Description</label>
                    <textarea class="form-control"
                        name="short_description">{{old('short_description' , isset($row->short_description)? $row->short_description : '' )}}</textarea>
                    @if($errors->has('short_description'))
                    <div class="error">{{$errors->first('short_description')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea class="form-control description"
                        name="description">{{old('description' , isset($row->description)? $row->description : '' )}}</textarea>
                    @if($errors->has('description'))
                    <div class="error">{{$errors->first('description')}}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <br>
                    <input name="image" type="file" accept="image/*" />
                    <input name="old_image" type="hidden" value="{{ isset($row->image)? $row->image : '' }}" />
                    @if($row && $row->image)
                    <div id="image">
                        <div style="margin:5px 0 0 0;"> <img src="{{asset('/storage/uploads/page/'.$row->image)}}"
                                style="width:200px; border-radius:10px" /> </div>
                        <div style="margin:5px 0 0 0;">
                            <button type="button" class="btn btn-xs btn-danger" Onclick="confirmDelete('image')">Delete
                                Image</button>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="mb-3">
                    <label class="form-label">Youtube Video</label>
                    <input type="text" class="form-control" name="video"
                        value="{{old('video' , (isset($row->video) && !empty($row->video)) ? 'https://youtu.be/'.$row->video : '' )}}">
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-4 hide">
                            <label class="form-label">Status</label>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="status" value="1" {{ ((isset($row->
                status) && $row->status == 1) ||  !isset($row->status))? 'checked' : '' }} /> <span
                                    class="switch-label" data-on="Show" data-off="Hide"></span> <span
                                    class="switch-handle"></span> </label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <label class="form-label">Order By</label>
                            <input type="text" class="form-control required digits" name="orders"
                                value="{{old('orders' , isset($row->orders) ? $row->orders : $orders)}}">
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <label class="form-label">Is Sitemap </label>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="is_sitemap" value="1" {{ (isset($row->
                is_sitemap) && $row->is_sitemap == '1')? 'checked' : '' }} /> <span class="switch-label" data-on="Yes"
                                    data-off="No"></span> <span class="switch-handle"></span> </label>
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label"> Meta Title</label>
                    <input type="text" class="form-control" name="meta_title"
                        value="{{old('meta_title' , isset($row->meta_title)? $row->meta_title : '' )}}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control"
                        rows="3">{{old('meta_description' , isset($row->meta_description)? $row->meta_description : '' )}}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @include('admin.includes.footer')
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
                    url: '{{ route("admin-page-imagedelete")}}',
                    type: 'POST',
                    data: {
                        'id': '{{ @$row->id }}',
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