<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" type="image/png" href="img/icon.png"/>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="stylesheet" href="{{ elixir('css/public.css') }}">
        <!-- #GOOGLE FONT -->
        {{-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700"> --}}
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <style type="text/css">
            [v-cloak] {
              display: none;
            }
        </style>
    </head>
    <body>
        <div id="app" v-cloak>
            <router-view></router-view>
        </div>
        <script src="{{ elixir('js/public.js') }}"></script>
    </body>
</html>
