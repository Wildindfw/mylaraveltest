<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns"
        crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="/css/app.css">

    <title>CPNT 262 - PHP - Assignment 2</title>
</head>

<body>
    
    @include('components.header')

    <main class="reddit-main">
        <div class="wrapper">
            <div class="main-feed">

                @yield('main-feed-content')

            </div>
            <div class="auxilliary-feed">

                @yield('aux-feed-content')

            </div>
        </div>
    </main>
</body>

</html>