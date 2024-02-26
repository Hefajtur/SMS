<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DueFees Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            font-size: 24px;
            text-align: center;
        }
        #onset{
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
    <h1>DueFees Report</h1>

    <div class="card_header_text py-2" id="onset">
        <h3 class="text-white">Onest Schooled - School Management System</h3>
        <h4 class="text-white">Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
    </div>

    <table>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Admission NO</th>
                <th scope="col">Class (Section)</th>
                <th scope="col">Fees type</th>
                <th scope="col">Amount ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $dt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->first_name }} {{ $dt->last_name }}</td>
                    <td>{{ $dt->admission_no }}</td>
                    <td>{{ $dt->class_name}} ({{ $dt->section_name }})</td>
                    <td>{{ $dt->type_name }}</td>
                    <td>{{ $dt->amount }} + {{ $dt->fine_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
