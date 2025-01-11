<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/common.css') }}" />

    <!-- common js function -->
    <script>
    
    </script>
    
</head>

<body>
    <div style="display:flex">
        <div class="left-pannel" >
            <li class="px-nav-item">
                <a href="{{ url('Employee') }}"><span
                        class="px-nav-label">Employee Report</span></a>
            </li>
            
        </div>
        <div class="right-pannel">
            <div class="right-header">
            
            </div>
            <div class="right-content" >
            @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
