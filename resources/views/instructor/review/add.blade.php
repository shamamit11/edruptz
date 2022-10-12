@extends('instructor.layout')
@section('content')
    <div class="main-content d-flex flex-column">
        @include('instructor.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Course Review</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('instructor-dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
                <li class="item"><a href="{{ route('instructor-review') }}">Reviews</a></li>
                <li class="item">View</li>
            </ol>
        </div>

        <div class="chat-content-area mt-20">
            <div class="content-right">
                <div class="chat-area">
                    <div class="chat-list-wrapper">
                        <div class="chat-list">
                            <div class="chat-list-header d-flex align-items-center">
                                <div class="header-left d-flex align-items-center mr-3">
                                    <div class="avatar mr-3">
                                        <img src="{{ asset('/storage/uploads/student/' . $row->student->image) }}"
                                            width="70" height="70" class="rounded-circle" alt="image">
                                        <span class="status-online"></span>
                                    </div>
                                    <h6 class="mb-0 font-weight-bold">{{ $row->student->name }}</h6>
                                </div>
                            </div>

                            <div class="chat-container" data-simplebar="init">
                                <div class="simplebar-wrapper" style="margin: -25px -20px;">
                                    <div class="simplebar-height-auto-observer-wrapper">
                                        <div class="simplebar-height-auto-observer"></div>
                                    </div>
                                    <div class="simplebar-mask">
                                        <div class="simplebar-offset" style="right: -20px; bottom: 0px;">
                                            <div class="simplebar-content-wrapper"
                                                style="height: 100%; padding-right: 20px; padding-bottom: 0px; overflow: hidden scroll;">
                                                <div class="simplebar-content" style="padding: 25px 20px;">
                                                    <div class="chat-content">
                                                        <div class="chat">

                                                            <div>{!! nl2br($row->description) !!}</div>

                                                        </div>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="simplebar-placeholder" style="width: auto;"></div>
                                </div>
                            </div>

                            <div class="chat-list-footer">
                                <form action="{{ $action }}" method="post" enctype="multipart/form-data" class="d-flex align-items-center">
                                    @csrf
                                    <input type="hidden" class="form-control" name="id" value="{{ isset($row->id) ? $row->id : '' }}">
                                    <textarea class="form-control description" name="description">{{ old('description', isset($row->reply->description) ? $row->reply->description : '') }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="error">{{ $errors->first('description') }}</div>
                                    @endif

                                    <button type="submit" class="send-btn d-inline-block">Send <i class="bx bx-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('instructor.includes.footer')
    </div>
@endsection
@section('footer-scripts')
@endsection
