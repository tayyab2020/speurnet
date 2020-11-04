<html>
<head>

</head>

<body>

<form enctype="multipart/form-data" method="POST" action="{{ URL::to('/test-upload') }}">

@csrf

    <input name="property_images[]" type="file" multiple required>Select Files

    <br>
    <button style="margin-top: 20px;" type="submit">Submit</button>

</form>

</body>

</html>
