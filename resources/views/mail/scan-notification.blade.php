<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        p {
            font-size: 12px;
        }

        h2 {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div>
        <h2>New Scan:</h2>
        <p>{{ $brand->name }}</p>
        <p>{{ $brand->website }}</p>
        <p>{{ $brand->phone }}</p>
        <p>{{ $brand->email }}</p>
        <p>{{ $brand->address }}</p>
    </div>
</body>

</html>
