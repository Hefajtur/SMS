@extends('dashboard.master')

@section('title')
    Transactions
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Transactions</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Transactions</li>
                    </ol>
                </div>

        
                <div class="row bg-white">
                    <form action="" method="POST" id="transaction_report_filter">
                        @csrf

                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-2 mt-2">
                                <h2>Filtering</h2>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select required id="cost" class="form-control inputs" name="cost">
                                    <option value="">Select One</option>
                                    @foreach ($cost as $incomeExpense)
                                        <option class="form-control" value="{{ $incomeExpense->id }}">
                                            {{ $incomeExpense->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select required class="form-control inputs" name="head" id="head" required>
                                    <option value="">Select Head</option>
                                </select>
                            </div>


                            <div class="col-md-3 mt-2">
                                <input required type="text" name="daterange" id="daterange" class="form-control inputs"
                                    value="09/01/2023 - 09/30/2023" />
                            </div>


                            <div class="col-md-1 mt-2">
                                <button type="submit" class="btn p-2 btn-primary float-end" id="search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row bg-white">

                    <div class="my-4 mx-0">

                        <a href="{{ route('transactionPrint') }}" class="download p-3 rounded btn btn-primary"
                            id="pdf-print-btn">Print Now <i class="fa-solid fa-print"></i></a>


                        <a href="{{ route('transactionPdf') }}" class="download p-3 ml-2 rounded btn btn-primary"
                            id="pdf-download-btn">PDF Download <i class="fa-regular fa-file"></i></a>

                    </div>
                    <!-- Card Header -->
                    <div class="card-header text-center">

                        <div class="card_header_text py-2">
                            <h3 class="">Onest Schooled - School Management System</h3>
                            <h4 class="">Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5 border">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Head</th>
                                        <th scope="col">Amount ($)</th>
                                    </tr>
                                </thead>
                                <tbody id="IncomeAndExpense" class="">

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>

    {{-- //DateRangePicker --}}
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                    .format('YYYY-MM-DD'));
            });
        });
    </script>

    {{-- income and expense to name --}}
    <script>
        $(document).ready(function() {

            $('#cost').on('change', function() {
                var id = $("#cost").val();
                // alert(id);
                $.ajax({
                    url: url + "/getName/" + id,
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {

                        var option = '';
                        option += '<option selected disabled>Select Head</option>';
                        for (const key in data) {
                            option += "<option value=" + data[key]['id'] + ">" + data[key][
                                'name'
                            ] + '</option>';
                        };
                        $('#head').empty().append(option);

                    },
                })
            })

        });
    </script>

    {{-- filter --}}
    <script>
        $('#transaction_report_filter').submit(function(e) {
            e.preventDefault();

            // Display block for Report
            var cost = $('#cost').val();
            var head = $('#head').val();
            var datepicker = $('#daterange').val();

            $.ajax({
                url: "{{ route('filter') }}",
                method: "GET",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    var x = response.income;
                    var y = response.expense;

                    $('#IncomeAndExpense').empty('');

                    for (var i = 0; i < x.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $(
                            "<td>" + (i + 1) + "</td><td>" + x[i].date +
                            "</td><td>" + x[i].name + "</td><td>" +
                            x[i].income_expenses.name + "</td><td>" + x[i].amount + "</td>"
                        );
                        tr.append(td);
                        $('#IncomeAndExpense').append(tr);
                    }

                    for (var j = 0; j < y.length; j++) {
                        var tr = $("<tr></tr>");
                        var td = $(
                            "<td>" + (j + 1) + "</td><td>" + y[j].date +
                            "</td><td>" + y[j].name + "</td><td>" +
                            y[j].income_expenses.name + "</td><td>" + y[j].amount + "</td>"
                        );
                        tr.append(td);
                        $('#IncomeAndExpense').append(tr);
                    }


                    var totalAmount = 0;
                    for (var k = 0; k < x.length; k++) {
                        totalAmount += parseFloat(x[k].amount);
                    }
                    for (var l = 0; l < y.length; l++) {
                        totalAmount += parseFloat(y[l].amount);
                    }

                    var totalRow = $("<tr></tr>");
                    var totalTd = $(
                        "<td colspan='4'></td><td><strong>Total : </strong><strong>" + totalAmount
                        .toFixed(2) + "</strong></td>"
                    );

                    totalRow.append(totalTd);
                    $('#IncomeAndExpense').append(totalRow);
                }
            });
        });
    </script>


    {{-- make pdf  --}}
    <script>
        $('#pdf-download-btn').click(function(e) {
            e.preventDefault();

            // fetch data from server
            var cost = $('#cost').val();
            var head = $('#head').val();
            var datepicker = $('#daterange').val();

            $.ajax({
                url: "{{ route('transactionPdf') }}",
                method: "GET",
                data: {
                    cost: cost,
                    head: head,
                    daterange: datepicker
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {

                    var blob = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var url = window.URL.createObjectURL(blob);

                    // Create a temporary anchor element to trigger the download
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'transaction_report.pdf';

                    // Trigger a click event on the anchor element to start the download
                    a.click();

                    // Clean up and release the object URL
                    window.URL.revokeObjectURL(url);
                }
            });
        });
    </script>


{{-- for print pdf  --}}
<script>
    $('#pdf-print-btn').click(function(e) {
        e.preventDefault();

        var cost = $('#cost').val();
        var head = $('#head').val();
        var datepicker = $('#daterange').val();

        var printUrl = "{{ route('transactionPrint') }}?cost=" + cost + "&head=" + head + "&daterange=" + datepicker;
        window.open(printUrl, '_blank');
    });
</script>


@endsection
