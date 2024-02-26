@extends('dashboard.master')

@section('title')
    Exam Routine
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Exam Routine</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Exam Routine</li>
                    </ol>
                </div>

                <div class="row bg-white">
                    <form action="" method="" id="searchBtn">
                        @csrf
                        <div class="">
                            <h2>Filtering</h2>
                        </div>
                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-1 mt-2">

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
                                <select required class="col-md-12 form-control inputs" name="type" id="type" required>
                                    <option class="form-control">--Select Type--</option>
                                    @foreach ($examTypes as $examType)
                                        <option value="{{ $examType->id }}">
                                            {{ $examType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-2 mt-2">
                                <button type="button" class="btn btn-lg btn-primary float-end"
                                    id="search-btn">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row bg-white">

                    <div class="col-md-12 mt-5 border">
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Class Room</th>
                                        <th scope="col">Time Schedule</th>
                                    </tr>
                                </thead>

                                <tbody id="examRoutineData" class="">

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


{{-- show examroutine data --}}
<script>
    $(document).ready(function() {

        function routineData(classValue, sectionValue, typeValue) {
            $.ajax({
                type: 'GET',
                url: url + '/get-ExamRoutineData',
                data: {
                    class: classValue,
                    section: sectionValue,
                    typeValue: typeValue
                },
                success: function(data) {

                    $('#examRoutineData').empty('');

                    for (var i = 0; i < data.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $(
                            "<td>" + (i + 1) + "</td><td>" + data[i].date +
                            "</td><td>" + data[i].subject.name + "</td><td>" +
                            data[i].classroom.room_no + "</td><td>" + data[i]
                            .timeschedule.start_time + " - " + data[i].timeschedule
                            .end_time + "</td>"
                        );
                        tr.append(td);
                        $('#examRoutineData').append(tr);
                    }

                },
            });
        }

        $('#search-btn').click(function(e) {
            e.preventDefault();
            var selectedClass = $('#class_id').val();
            var selectedSection = $('#section_id').val();
            var selectedType = $('#type').val();
            // alert(selectedType);
            routineData(selectedClass, selectedSection, selectedType);
        });

    });
</script>

@endsection
