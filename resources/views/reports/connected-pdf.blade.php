<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>SDD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>Created on {{ $date }}</p>
  
    <table>
        <tr>
            <th>Name</th>
            <th>IUID</th>
            <th>PAN</th>
            <th>Demat Account Number</th>
            <th>No. of Share Held</th>
        </tr>
        @foreach($users as $user)
            <tr>

                <td>{{ $user->name }}</td>
                <td>{{ $user->iuid }}</td>
                <td>{{ $user->pan }}</td>
                <td>{{ $user->demat_account_number }}</td>
                <td>{{ $user->no_of_share_held}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
