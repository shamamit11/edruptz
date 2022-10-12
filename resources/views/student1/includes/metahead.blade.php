@php
use App\Models\Setting;
$setting = Setting::first();
if(isset($row) && !empty($row)) { 
	$meta_title = (isset($row->meta_title) && !empty($row->meta_title)) ? $row->meta_title : $setting->meta_title;
    $meta_description = (isset($row->meta_description) && !empty($row->meta_description)) ? $row->meta_description : $setting->meta_description;
} else {
    $meta_title = $setting->meta_title;
    $meta_description = $setting->meta_description;
}
@endphp
<!doctype html>

<html>
<head>
<title>{{ $meta_title }}</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1.0, user-scalable=no">
<meta property="og:title" content="{{ $meta_title }}" />
<meta name="description" content="{{  $meta_description }}" />
<meta property="og:description" content="{{  $meta_description }}" />
@if($setting->google_site_verification )
<meta name="google-site-verification" content="{{ $setting->google_site_verification }}" />
@endif
@if($setting->google_analytics )
{!!$setting->google_analytics!!}
@endif
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="{{ asset('assets/css/calander.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/styledashboard.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{ asset('assets/plugins/sweetalert/sweetalert.min.css') }}" rel="stylesheet">
</head>