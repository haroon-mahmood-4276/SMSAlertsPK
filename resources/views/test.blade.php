<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <style>
        .w-5 {
            display: none;
        }

    </style>
</head>

<body>
    <div>
        <h1>Pagination Testing</h1>
    </div>

    <div>
        <table>
            <tr>
                <th>code</th>
                <th>name</th>
            </tr>
            @foreach ($groups as $group)
                <tr>
                    <td>{{ $group->code }}</td>
                    <td>{{ $group->name }}</td>
                </tr>
            @endforeach
        </table>
        {{ $groups->onEachSide(1)->links('shared.pagination') }}

    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">

    </script>
</body>

</html>
