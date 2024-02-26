@extends('dashboard.master')

@section('title')
    Due Fees
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Due Fees</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Due Fees</li>
                    </ol>
                </div>

                <div class="row bg-white">
                    <form action="" method="" id="filter">
                        @csrf
                        <div class="">
                            <h2>Filtering</h2>
                        </div>
                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-1 mt-2">

                            </div>

                            <div class="col-md-3 mt-2">
                                <select  class="col-md-12 form-control inputs" name="class_id" id="class_id">
                                    <option class="form-control">--Select Class--</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="class_id_error"></span>
                            </div>
                            <div class="col-md-3 mt-2">
                                <select class="col-md-12 form-control inputs" name="section_id" id="section_id">
                                    <option class="form-control">--Select Section--</option>
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select class="col-md-12 form-control inputs" name="fees" id="fees">
                                    <option class="form-control">--Select Fees Type--</option>
                                    @foreach ($types as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-2 mt-2">
                                <button type="button" class="btn btn-lg btn-primary float-end"
                                id="searchdue-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row bg-white">
                  
                    <div class="my-4 mx-0">

                        <a href="{{route('dueFeesPrint')}}" class="download p-3 rounded btn btn-primary"
                            id="print-duePdf-btn">Print Now <i class="fa-solid fa-print"></i></a>

                        <a href="{{route('dueFeesPdf')}}" class="download p-3 ml-2 rounded btn btn-primary"
                            id="duePdf-btn">PDF Download <i class="fa-regular fa-file"></i></a>

                    </div>
                    <!-- Card Header -->
                    <div class="card-header text-center bg-white">

                        <div class="card_header_text py-2">
                            <h3 class="">Onest Schooled - School Management System</h3>
                            <h4 class="">Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
                        </div>
                    </div>

                    <div class="col-md-12 border">
                        <div class="row">
                            <table class="table my-5">
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

                                <tbody id="dueFeeData" class="">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- class and section --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '#class_id', function() {
                var classId = $(this).val();
                // console.log(classId);
                $.ajax({
                    url: url + "/getSectionforduefee/" + classId,
                    method: "GET",
                    dataType: "JSON",
                    success: function(data) {

                        var option = '';
                        option += '<option selected disabled>Select Section</option>';

                        for (const key in data) {
                            option += "<option value=" + data[key]['id'] + ">" + data[key][
                                'name'
                            ] + '</option>';
                        };
                        $('#section_id').empty().append(option);

                    },
                })
            })

        });
    </script>

    {{-- show duefee data --}}
<script>
    $(document).ready(function() {

        function DueData(classValue, sectionValue, feesValue) {
            $.ajax({
                type: 'GET',
                url: url + '/get-dueFees',
                data: {
                    class: classValue,
                    section: sectionValue,
                    feesValue: feesValue
                },
                success: function(data) {

                    console.log(data);

                    $('#dueFeeData').empty('');

                    for (var i = 0; i < data.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $(
                            "<td>" + (i + 1) + "</td><td>" + data[i].first_name + " "  + data[i].last_name + "</td><td>" + data[i].admission_no + "</td><td>" + data[i].class_name + " ("+ data[i].section_name + ")</td><td>" + data[i].type_name + "</td><td>" + data[i].amount +  " + "  + data[i].fine_amount + "</td>");
                        tr.append(td);
                        $('#dueFeeData').append(tr);
                    }

                },
            });
        }

        $('#searchdue-btn').click(function(e) {
            e.preventDefault();
            var selectedClass = $('#class_id').val();
            var selectedSection = $('#section_id').val();
            var selectedFees = $('#fees').val();
            // alert(selectedFees);
            DueData(selectedClass, selectedSection, selectedFees);
        });

    });
</script>

    {{-- make pdf  --}}
    <script>
        $('#duePdf-btn').click(function(e) {
            e.preventDefault();

            // fetch data from server
            var selectedClass = $('#class_id').val();
            var selectedSection = $('#section_id').val();
            var selectedFees = $('#fees').val();

            // alert(selectedFees);

            $.ajax({
                url: "{{ route('dueFeesPdf') }}",
                method: "GET",
                data: {
                    class: selectedClass,
                    section: selectedSection,
                    feesValue: selectedFees
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(response) {

                    // console.log(response);

                    var blob = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var url = window.URL.createObjectURL(blob);

                    // Create a temporary anchor element to trigger the download
                    var a = document.createElement('a');
                    a.href = url;
                    a.download = 'dueFees_report.pdf';

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
    $('#print-duePdf-btn').click(function(e) {
        e.preventDefault();

        var selectedClass = $('#class_id').val();
        var selectedSection = $('#section_id').val();
        var selectedFees = $('#fees').val();

        var printUrl = "{{ route('dueFeesPrint') }}?class_id=" + selectedClass + "&section_id=" + selectedSection + "&fees=" + selectedFees;
        window.open(printUrl, '_blank');
    });
</script>

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
