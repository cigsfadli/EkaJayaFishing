<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">
    <script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
</head>
<body class="bg-dark">
    <br><br><br><br><br>
    <table id="tblLapak" width='100%' class="table table-borderless"></table>
    <script>
        $(() => {
            refreshLapak();
        });
        function refreshLapak() {
            
            $.ajax({
                type: "GET",
                url: "{{ url('/get-halaman-lapak') }}",
                success: function (response) {
                    $("#tblLapak").html(response);
                    setTimeout(() => {
                        refreshLapak();
                    }, 5000);
                    
                }
            });
        }
    </script>
    
</body>
</html>