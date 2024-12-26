<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academa | Report Export</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            direction: ltr;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        h1,
        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Report: {{ $reportType == 'users' ? 'Users' : ($reportType == 'courses' ? 'Courses' : 'Statistics') }}</h1>
    @if($startDate && $endDate)
    <h2>From {{ $startDate }} to {{ $endDate }}</h2>
    @endif

    <table>
        <thead>
            <tr>
                @foreach($headers as $header)
                <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                @foreach($row as $value)
                <td>{{ $value }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>