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
            <th>IUID</th>
            <th>Event Name</th>
            <th>Event Date</th>
            <th>Publish Date</th>
            <th>Sender Name</th>
            <th>Recipient Name</th>
            <th>Purpose of Sharing</th>
            <th>Status</th>
            <th>Sharing Date</th>
            <th>Trading Window</th>
            <th>Closure Start Date</th>
            <th>Closure End Date</th>
            <th>Remarks</th>
            <th>Notice of Confidentiality Shared</th>
            <th>Audit Trail</th>
        </tr>
        @foreach($users as $user)
            <tr>
              @php
                $status = $user->status == 1 ? 'Approved' : 'Not Approved';
                $notice_shared = $user->notice_of_confidentiality_shared == 1 ? 'Yes' : 'No';
              @endphp
    
                <td>{{ $user->upsi_id }}</td>
                <td>{{ $user->event_name }}</td>
                <td>{{ $user->event_date }}</td>
                <td>{{ $user->publishing_date }}</td>
                <td>{{ $user->sender_name }}</td>
                <td>{{ $user->recipient_name }}</td>
                <td>{{ $user->purpose_of_sharing }}</td>
                <td>{{  $status }}</td>
                <td>{{ $user->sharing_date }}</td>
                <td>{{ $user->trading_window }}</td>
                <td>{{ $user->closure_start_date }}</td>
                <td>{{ $user->closure_end_date }}</td>
                <td>{{ $user->remarks }}</td>
                <td>{{ $notice_shared }}</td>
                <td>
                  @if ($user->updated_at)
                      {{ $user->updated_at->toDateString() }}
                  @else
                      {{ $user->created_at->toDateString() }}
                  @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>