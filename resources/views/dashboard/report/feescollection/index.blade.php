@extends('dashboard.master')

@section('title')
    Fees Collection
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Fees Collection</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Fees Collection</li>
                    </ol>
                </div>

                <div class="row bg-white">
                    <form action="" method="" id="filter">
                        @csrf

                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-2 mt-2">
                                <h2>Filtering</h2>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select required id="class_id" class="col-md-12 form-control inputs" name="class_id" required>
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
                                <select required class="col-md-12 form-control inputs" name="section_id" id="section_id" required>
                                    <option class="form-control">--Select Section--</option>
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-3 mt-2">
                                <input required type="text" name="daterange" id="daterange" class="form-control inputs"
                                    value="10/01/2023 - 10/30/2023" />
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-1 mt-2">
                                <button type="button" class="btn p-2 btn-primary float-end"
                                    id="fees-search-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row bg-white">

                    <!-- Card Header -->
                    <div class="card-header text-center">

                        <div class="card_header_text py-2">
                            <h3 class="">Onest Schooled - School Management System</h3>
                            <h4 class="">Resemont Tower, House 148, Road 13/B, Block E Banani Dhaka 1213.</h4>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5 border">
                        <div class="row">
                            <table class="table my-5">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Admission NO</th>
                                        <th scope="col">Class (Section)</th>
                                        <th scope="col">Fees type</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Amount ($)</th>
                                    </tr>
                                </thead>
                                <tbody id="feeData">

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


    {{-- class and section --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '#class_id', function() {
                var classId = $(this).val();
                // console.log(classId);
                $.ajax({
                    url: url + "/getSectionforfeesCollection/" + classId,
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



    {{-- show FeesCollection data --}}

    <script>
        $(document).ready(function() {

            function FeesCollection(classValue, sectionValue, selecteddaterange) {
                $.ajax({
                    type: 'GET',
                    url: url + '/get-feesCollection',
                    data: {
                        class: classValue,
                        section: sectionValue,
                        daterange: selecteddaterange,
                    },
                    success: function(data) {

                        console.log(data);

                        $('#feeData').empty('');

                        for (var i = 0; i < data.length; i++) {
                            var tr = $("<tr></tr>");
                            var td = $(
                                "<td>" + (i + 1) + "</td><td>" + data[i].first_name + " " + data[i]
                                .last_name + "</td><td>" + data[i].admission_no + "</td><td>" +
                                data[i].class_name + " (" + data[i].section_name + ")</td><td>" +
                                data[i].type_name + "</td><td>" + data[i].date + "</td><td>" + data[i].amount + " + " + data[i].fine_amount + "</td>");
                            tr.append(td);
                            $('#feeData').append(tr);
                        }

                    },
                });
            }

            $('#fees-search-btn').click(function(e) {
                e.preventDefault();
                var selectedClass = $('#class_id').val();
                var selectedSection = $('#section_id').val();
                var selecteddaterange = $('#daterange').val();
                // alert(selecteddaterange);
                FeesCollection(selectedClass, selectedSection, selecteddaterange);
            });

        });
    </script>
@endsection
