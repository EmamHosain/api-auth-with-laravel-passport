<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery AJAX Example</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


</head>
<body>

    <script>
        $.ajax({
        url: 'https://api.aladhan.com/v1/calendarByCity?city=dhaka&country=bangladesh&month=10&year=2024', 
        type: 'GET', 
        dataType: 'json', 
        success: function(data) {
            console.log('Data retrieved successfully:', data); 
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('Request failed:', textStatus, errorThrown); 
        }
    });
    </script>

</body>
</html>