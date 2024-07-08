<!DOCTYPE html>
<html lang="en">
 <head>
 @include('partials.head')
 </head>
 <style>
    .active-link {
        /* Define your active state styles here */
        color: blue;
        font-weight: bold;
    }
</style>
 <body>
@include('partials.head')
@include('partials.sidebar')
@include('partials.nav')
@yield('content')
@include('partials.footer')

 </body>
</html>