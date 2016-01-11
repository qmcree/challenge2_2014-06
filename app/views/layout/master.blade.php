<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Generate Report</title>
    <meta name="description" content="Generates reports.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/packages/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="/packages/adscend_challenge/css/adscend_challenge.css" />
</head>
<body>
<!--[if lte IE 8]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="content" class="container">
    <img id="logo" src="/packages/adscend_challenge/images/logo.png" alt="Adscend Media" class="pull-left" />

    <h2>Generate Report</h2>

    <main class="row">
        <div id="form" class="col-sm-3">
            @section('alert')
            @show

            @section('form')
            @show
        </div>
        <div class="col-sm-9">
            @yield('results')
        </div>
    </main>
</div>

</body>
</html>