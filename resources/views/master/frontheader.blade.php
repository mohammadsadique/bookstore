<!DOCTYPE html>
<html>
<title>Books Record</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{URL('/')}}/custom/css/style.css">

<body>
<!-- Links (sit on top) -->
<div class="w3-top">
    <div class="w3-row w3-large w3-light-grey">
        <div class="w3-col s3">
            <a href="{{ route('books') }}" class="w3-button w3-block">Home</a>
        </div>
        <div class="w3-right w3-hide-small">
            <a href="{{ route('login') }}" target="_blank" class="w3-bar-item w3-button">Go To Admin Panel</a>
        </div>
    </div>
</div>

@yield('main-section')


<script>

</script>
</body>
</html>
