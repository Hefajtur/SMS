<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transaction Report</title>
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
    <h1>Transaction Report</h1>

    <div class="card_header_text py-2" id="onset">
        <h3 class="text-white">Onest Schooled - School Management System</h3>
        <h4 class="text-white">Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Name</th>
                <th>Head</th>
                <th>Amount ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($income as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->incomeExpenses->name }}</td>
                    <td>{{ $item->amount }}</td>
                </tr>
            @endforeach
            @foreach ($expense as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->incomeExpenses->name }}</td>
                    <td>{{ $item->amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total Income: ${{ $total_income }}</p>
    <p>Total Expense: ${{ $total_expense }}</p>


    <script>
        window.print();
    </script>
</body>
</html>
