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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="{{ asset('assets/admin/css/vendors.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
<link href="{{ asset('assets/admin/plugins/sweetalert/sweetalert.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<title>Student Dashboard</title>
<link rel="icon" type="image/png" href="{{ asset('assets/admin/img/edruptz.svg') }}">
</head>