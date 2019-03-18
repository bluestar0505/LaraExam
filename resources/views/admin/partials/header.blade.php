<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        {{ trans('quickadmin::admin.partials-header-title') }}
    </title>

    <meta http-equiv="X-UA-Compatible"
          content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0"
          name="viewport"/>
    <meta http-equiv="Content-type"
          content="text/html; charset=utf-8">

    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{{ asset('images/favicon.ico') }}}">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900|Work+Sans:300,700" rel="stylesheet">
    <link rel="stylesheet"
          href="{{ url('quickadmin/css') }}/font-awesome.min.css"/>
    <link rel="stylesheet"
          href="{{ url('quickadmin/css') }}/bootstrap.min.css"/>
    <link rel="stylesheet"
          href="{{ url('quickadmin/css') }}/components.css"/>
    <link rel="stylesheet"
          href="{{ url('quickadmin/css') }}/quickadmin-layout.css"/>
    <link rel="stylesheet"
          href="{{ url('quickadmin/css') }}/quickadmin-theme-default.css"/>
    <link rel="stylesheet"
          href="{{ url('quickadmin/') }}/js/bootstrap-multiselect/dist/css/bootstrap-multiselect.css"/>
    <link rel="stylesheet"
          href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet"
          href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>
</head>

<body class="page-header-fixed">