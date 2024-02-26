@extends('dashboard.master')

@section('title')
    Class Routine
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Class Routine</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Class Routine</li>
                    </ol>
                </div>

                <div class="row bg-white">
                    <form action="" method="" id="ClassRoutine">
                        @csrf

                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-2 mt-2">
                                <h2>Filtering</h2>
                            </div>

                            <div class="col-md-3 mt-2">

                            </div>

                            <div class="col-md-3 mt-2">
                                <select id="class_id" class="col-md-12 form-control inputs" name="class_id" required>
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
                                <select class="col-md-12 form-control inputs" name="section_id" id="section_id" required>
                                    <option class="form-control">--Select Section--</option>
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>



                            <div class="col-md-1 mt-2">
                                <button type="button" class="btn p-2 btn-primary float-end" id="search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row bg-white">

                    <div class="my-4 mx-0">
                        <a href="{{ route('classRoutinePrint') }}" class="print p-3 rounded btn btn-primary mr-2" id="print-classRoutine">Print Now
                            <i class="fa-solid fa-print"></i></a>

                        <a href="{{ route('classRoutinePdf') }}" id="classpdf-btn"
                            class="download p-3 rounded btn btn-primary">PDF
                            Download <i class="fa-regular fa-file"></i></a>
                    </div>


                    <div class="col-md-12 mt-5 border">
                        <div class="row">
                            <table class="table table-bordered">
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
                                <tbody id="ClassRoutineData">

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
                    url: url + "/getSectionforclassroutine/" + classId,
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



    {{-- show classroutine data --}}

    {{-- <script>
        $(document).ready(function() {

            $('#search').click(function(e) {
                e.preventDefault();

                var selectedClass = $('#class_id').val();
                var selectedSection = $('#section_id').val();
                // alert(selectedClass);
                RoutineData(selectedClass, selectedSection);

            });

            function RoutineData(classValue, sectionValue) {
                $.ajax({
                    type: 'GET',
                    url: url + '/get-ClassRoutineData',
                    data: {
                        class: classValue,
                        section: sectionValue
                    },
                    success: function(data) {

                        console.log(data);

                        $('#ClassRoutineData').empty('');

                        for (var i = 0; i < data.length; i++) {
                            var tr = $("<tr></tr>");
                            var td = $(
                                "<td>" + (i + 1) + "</td><td>" + data[i].days.day +
                                "</td><td>" + data[i].subject.name + "</td><td>" +
                                data[i].classroom.room_no + "</td><td>" + data[i].timeschedule
                                .start_time + " - " + data[i].timeschedule.end_time + "</td>"
                            );
                            tr.append(td);
                            $('#ClassRoutineData').append(tr);
                        }

                    },
                });
            }

        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $("#search").click(function() {

                var classId = $("#class_id").val();
                var sectionId = $("#section_id").val();

                $.ajax({
                    type: "GET",
                    url: url + "/get-ClassRoutineData",
                    data: {
                        class: classId,
                        section: sectionId
                    },
                    success: function(response) {
                        $("#ClassRoutineData").empty();

                        $.each(response, function(day, entries) {
                            var row = $("<tr>");
                            row.append($("<td>").text(day));

                            $.each(entries, function(index, entry) {
                                var subjectClass = entry[0] + ", Room No: " +
                                    entry[1];
                                row.append($("<td class='text-danger'>").text(
                                    subjectClass));
                            });

                            $("#ClassRoutineData").append(row);
                        });
                    },
                });
            });
        });
    </script>


    {{-- make pdf  --}}
    <script>
        $('#classpdf-btn').click(function(e) {
            e.preventDefault();

            // fetch data from server
            var classId = $("#class_id").val();
            var sectionId = $("#section_id").val();

            $.ajax({
                url: "{{ route('classRoutinePdf') }}",
                method: "GET",
                data: {
                    class: classId,
                    section: sectionId
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
                    a.download = 'myClassRoutinePdf.pdf';

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
        $('#print-classRoutine').click(function(e) {
            e.preventDefault();

            var classId = $("#class_id").val();
            var sectionId = $("#section_id").val();

            var printUrl = "{{ route('classRoutinePrint') }}?classId=" + classId + "&sectionId=" + sectionId;
            window.open(printUrl, '_blank');
        });
    </script>
@endsection
