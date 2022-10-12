@extends('admin.layout')
@section('content')
    <div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Courses</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('admin-instructor') }}">Instructor</a></li>
                <li class="item">{{ $title }}</li>
            </ol>
        </div>
        <div class="card mb-10">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>{{ $title }}</h3>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="{{ $action }}" id="form">
                    @csrf
                    <input type="hidden" class="form-control" name="id" value="{{ isset($row->id) ? $row->id : '' }}">
                    <input type="hidden" class="form-control" name="instructor_id"
                        value="{{ isset($row->instructor_id) ? $row->instructor_id : '' }}">
                    <input type="hidden" class="form-control" name="slug"
                        value="{{ isset($row->slug) ? $row->slug : '' }}">

                    <div class="mb-3 row">
                        <div class="col-md-4">
                            <label class="form-label"> Category </label>
                            <select name="category_id" class="custom-select form-control">
                                @if ($categories->count() > 0)
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            @if (@$row->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('category_id'))
                                <div class="error">{{ $errors->first('category_id') }}</div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <label class="form-label"> Course Title </label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', isset($row->name) ? $row->name : '') }}">
                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Summary</label>
                        <textarea name="summary" class="form-control" rows="3">{{ old('summary', isset($row->summary) ? $row->summary : '') }}</textarea>
                        @if ($errors->has('summary'))
                            <div class="error">{{ $errors->first('summary') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control description" name="description">{{ old('description', isset($row->description) ? $row->description : '') }}</textarea>
                        @if ($errors->has('description'))
                            <div class="error">{{ $errors->first('description') }}</div>
                        @endif
                    </div>



                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">Duration of Course</label>
                            <input type="text" name="duration"
                                value="{{ old('duration', isset($row->duration) ? $row->duration : '') }}"
                                class="form-control">
                            @if ($errors->has('duration'))
                                <div class="error">{{ $errors->first('duration') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Number of Lessons</label>
                            <input type="text" name="lectures"
                                value="{{ old('lectures', isset($row->lectures) ? $row->lectures : '') }}"
                                class="form-control">
                            @if ($errors->has('lectures'))
                                <div class="error">{{ $errors->first('lectures') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label class="form-label">Suitable Ages From </label>
                            <input type="text" class="form-control" name="age_from"
                                value="{{ old('age_from', isset($row->age_from) ? $row->age_from : '') }}">
                            @if ($errors->has('age_from'))
                                <div class="error">{{ $errors->first('age_from') }}</div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"> To </label>
                            <input type="text" class="form-control" name="age_to"
                                value="{{ old('age_to', isset($row->age_to) ? $row->age_to : '') }}">
                            @if ($errors->has('age_to'))
                                <div class="error">{{ $errors->first('age_to') }}</div>
                            @endif
                        </div>
                    </div>

                    @if ($row && count($row->skills) > 0)
                        @php $cnt = 1; @endphp
                        @foreach ($row->skills as $course_skill)
                            <div class="mb-3 row">
                                <div class="col-md-6">
                                    <label class="form-label">Skills </label>
                                    <select name="skill_id_{{ $cnt }}" class="form-control">
                                        @if ($skills->count() > 0)
                                            @foreach ($skills as $skill)
                                                <option value="{{ $skill->id }}"
                                                    @if ($course_skill->skill_id == $skill->id) selected @endif>{{ $skill->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Percentage</label>
                                    <input type="text" class="form-control" name="percent_{{ $cnt }}"
                                        value="{{ $course_skill->percent }}"
                                        value="{{ old('percent_' . $cnt, isset($row->percent) ? $row->percent : '') }}">
                                    @if ($errors->has('percent'))
                                        <div class="error">{{ $errors->first('percent') }}</div>
                                    @endif
                                </div>
                            </div>
                            @php $cnt++; @endphp
                        @endforeach
                        @if (count($row->skills) < 3)
                            @for ($i = count($row->skills); $i < 3; $i++)
                                <div class="mb-3 row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label class="form-label">Skills </label>
                                        <select name="skill_id_{{ $i + 1 }}" class="form-control">
                                            @if ($skills->count() > 0)
                                                @foreach ($skills as $skill)
                                                    <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <label class="form-label">Percentage</label>
                                        <input type="text" class="form-control" name="percent_{{ $i + 1 }}"
                                            value="{{ old('percent_' . $i + 1) }}">
                                        @if ($errors->has('percent'))
                                            <div class="error">{{ $errors->first('percent') }}</div>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        @endif
                    @else
                        <div class="mb-3 row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="form-label">Skills </label>
                                <select name="skill_id_1" class="form-control">
                                    @if ($skills->count() > 0)
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="form-label">Percentage</label>
                                <input type="text" class="form-control" name="percent_1"
                                    value="{{ old('percent_1') }}">
                                @if ($errors->has('percent_1'))
                                    <div class="error">{{ $errors->first('percent_1') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="form-label">Skills </label>
                                <select name="skill_id_2" class="form-control">
                                    @if ($skills->count() > 0)
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="form-label">Percentage</label>
                                <input type="text" class="form-control" name="percent_2"
                                    value="{{ old('percent_2') }}">
                                @if ($errors->has('percent_2'))
                                    <div class="error">{{ $errors->first('percent_2') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="form-label">Skills </label>
                                <select name="skill_id_3" class="form-control">
                                    @if ($skills->count() > 0)
                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <label class="form-label">Percentage</label>
                                <input type="text" class="form-control" name="percent_3"
                                    value="{{ old('percent_3') }}">
                                @if ($errors->has('percent_3'))
                                    <div class="error">{{ $errors->first('percent_3') }}</div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label"> Amount</label>
                        <input type="text" name="amount"
                            value="{{ old('amount', isset($row->amount) ? $row->amount : '') }}" class="form-control">
                        @if ($errors->has('amount'))
                            <div class="error">{{ $errors->first('amount') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image <small style="color: red">&nbsp; Image Size: 850px X 475px</small></label>
                        <br>
                        @if(isset($row->image))
                            <input name="image" type="file" accept="image/*"/>
                        @else
                            <input name="image" type="file" accept="image/*" required/>
                        @endif
                        <input name="old_image" type="hidden" value="{{ isset($row->image) ? $row->image : '' }}" />
                        <br>
                        @if ($row && $row->image)
                            <div id="image" class="mt-3">
                                <div class="addEditImage"> <img
                                        src="{{ asset('/storage/uploads/course/' . $row->image) }}"
                                        style="border-radius:10px; width:200px" /> </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-xs btn-danger"
                                        Onclick="confirmDelete('image')">Delete
                                        Image</button>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" @if (@$row->status == 1) selected @endif>Active</option>
                            <option value="0" @if (@$row->status == 0) selected @endif>Inactive</option>
                        </select>
                        @if ($errors->has('status'))
                            <div class="error">{{ $errors->first('status') }}</div>
                        @endif
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
                            url: '{{ route('admin-instructor-course-imagedelete') }}',
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
        })
    </script>
@endsection
