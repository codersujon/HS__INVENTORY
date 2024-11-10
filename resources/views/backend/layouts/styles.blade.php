<!doctype html>
<html lang="en">

<head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <!--favicon-->
        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png" />

        <!--plugins-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/datetimepicker/css/classic.time.css" rel="stylesheet" />
        <link href="{{ asset('backend') }}/assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css">

        <!-- Bootstrap CSS -->
        <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/assets/css/app.css" rel="stylesheet">
        <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet">
        <!-- Theme Style CSS -->
        <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/header-colors.css" />
        <title>Hypershop.com.bd</title>
    </head>

    <body>
        <!--wrapper-->
        <div class="wrapper">
