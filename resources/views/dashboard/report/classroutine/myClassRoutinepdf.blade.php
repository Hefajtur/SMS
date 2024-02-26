<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Class Routine</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            font-size: 24px;
            text-align: center;
        }

        #onset {
            text-align: center;
        }

        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <h1>Class Routine</h1>

    <div class="py-1" id="onset">
        <h3 class="text-white">Onest Schooled - School Management System</h3>
        <h4 class="text-white">Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
    </div>

    <table>
        <thead>
            <tr>
                <th>Day/Time</th>
                <th>9:00 - 9:59</th>
                <th>10:00 - 11:59</th>
                <th>11:00 - 11:59</th>
                <th>12:00 - 12:59</th>
                <th>1:00 - 1:59</th>
                <th>2:00 - 2:59</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classRoutineData as $day => $entries)
                <tr>
                    <td>{{ $day }}</td>
                    @foreach ($entries as $entry)
                        <td>{{ $entry[0] }}, Room No: {{ $entry[1] }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>



</body>
</html>
