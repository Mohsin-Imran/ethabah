<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('storeImg') }}" enctype="multipart/form-data" method="post">
        @csrf
        <input type="file" name="image" id="image">
        <button type="submit">Add</button>
    </form>

</body>
</html>
