@php
use App\Models\Setting;
use App\Models\Seo;
$setting = Setting::first();
if(isset($row) && !empty($row)) { 
	$meta_title = (isset($row->meta_title) && !empty($row->meta_title)) ? $row->meta_title : $setting->meta_title;
    $meta_description = (isset($row->meta_description) && !empty($row->meta_description)) ? $row->meta_description : $setting->meta_description;
} 
else {
    if(isset($seo_link) && !empty($seo_link)) {
        $seo = SEO::where('link', $seo_link)->first();
        if($seo) {
            $meta_title = $seo->meta_title;
            $meta_description = $seo->meta_description;
        }
        else {
            $meta_title = $setting->meta_title;
            $meta_description = $setting->meta_description;
        }
    }
    else {
        $meta_title = $setting->meta_title;
        $meta_description = $setting->meta_description;
    } 
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link media="all" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
<link media="all" href="{{ asset('assets/css/header.css') }}" rel="stylesheet" type="text/css" />
<link media="all" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/testimonials.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/logoslider.css') }}">
</head>