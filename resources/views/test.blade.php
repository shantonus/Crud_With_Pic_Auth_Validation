<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test only</title>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

</head>
<body>

    Hi
    
    <script>
        @if (Session::has('notification'))
            switch('{{ Session::get('notification')['type'] }}')
            {
                case 'info':
                    toastr.info('{{ Session::get('notification')['message'] }}');
                    break;
                                    
                case 'warning':
                    toastr.warning('{{ Session::get('notification')['message'] }}');
                    break;
                            
                case 'success':
                    toastr.success('{{ Session::get('notification')['message'] }}');
                    break;
                            
                case 'error':
                    toastr.error('{{ Session::get('notification')['message'] }}');
                    break;
            }
        @endif    
    </script>

</body>
</html>