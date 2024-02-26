@extends('dashboard.master')

@section('title')
    Edit SubjectAssign
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Class Routine</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit Class Routine</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                @foreach ($classRoutines as $classRoutine)
                @endforeach
                <form action="" method="POST" id="classRoutine_update" class_id="{{ $classRoutine->class->id }}" section_id="{{ $classRoutine->section->id }}">
                    <fieldset>
                        @csrf

                        <div class="row mt-5">
                            <div class="col-md-3 mb-3">
                                <label>Class <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control inputs" id="class_id" required>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ $classRoutine->class_id == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Section <span class="text-danger">*</span></label>
                                <select name="section_id" class="form-control inputs" id="section_id" required>
                                    <option value="{{ $classRoutine->section_id }}">{{ $classRoutine->section->name }}
                                    </option>

                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Shift <span class="text-danger">*</span></label>
                                <select name="shift_id" class="form-control inputs" id="shift_id" required>
                                     @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}"
                                            {{ $classRoutine->shift_id == $shift->id ? 'selected' : '' }}>
                                            {{ $shift->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Day <span class="text-danger">*</span></label>
                                <select name="day" class="form-control inputs" id="day" required>
                                     @foreach ($days as $day)
                                        <option value="{{ $day->id }}"
                                            {{ $classRoutine->day == $day->id ? 'selected' : '' }}>
                                            {{ $day->day }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="day_error" class="error"></span>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 mb-5">
                                <div class="row shadow py-4 mb-5">
                                    <div
                                        class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                        <h3 class="text-dark">Add Teacher, Time & Room</h3>
                                        <div class="button">
                                            <button type="button" class="btn btn-primary" id="add"> + Add</button>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Time Schedules</th>
                                                    <th scope="col">Class Room</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody id="edit_duplicate_row" class="col-12">

                                            </tbody>
                                        </table>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-lg btn-primary "><i
                                                    class="fa-solid fa-save"></i>
                                                Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Add Documnets -->
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Jquery field duplicator and remove --}}

    <script>
        $(document).ready(function() {
            var count = {{ count($classRoutines) }}; // Set the initial count to the number of existing rows.

            // Add new row
            $('#add').click(function() {
                count = count + 1;
                var html_code = "<tr id='row" + count + "'>";

                // Add options for subjects
                html_code +=
                    "<td class='col-12 col-md-3'><select name='subject_id[]' class='form-control inputs' id='subject_id'> <<option value=''>Select subject</option><@foreach ($subjects as $subject)<option value='{{ $subject->id }}'>{{ $subject->name }}</option>@endforeach></select></td>";
                html_code +=
                    "<td class='col-12 col-md-3'><select name='time_schedule_id[]' class='form-control inputs' id='time_schedule_id'><<option value=''>Select time schedule</option><@foreach ($timeschedules as $timeschedule)<option value='{{ $timeschedule->id }}'>{{ $timeschedule->start_time }} - {{ $timeschedule->end_time }}</option>@endforeach></select></td>";
                html_code +=
                    "<td class='col-12 col-md-3'><select name='class_room_id[]' class='form-control inputs' id='class_room_id'><<option value=''>Select class room</option><@foreach ($classrooms as $classroom)<option value='{{ $classroom->id }}'>{{ $classroom->room_no }}</option>@endforeach></select></td>";

                html_code += "<td class='col-12 col-md-1'><button type='button' data-row='row" + count +
                    "' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark'></i></button></td>";
                html_code += "</tr>";

                $('#edit_duplicate_row').append(html_code);
            });

            // Remove row
            $(document).on('click', '.remove', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
            });


            @foreach ($classRoutines as $key => $classRoutine)
                var existingRow = "<tr id='row{{ $key + 1 }}'>";
                existingRow +=
                    "<td class='col-12 col-md-3'><select name='subject_id[]' class='form-control inputs' id='subject_id{{ $key + 1 }}'>";

                // subjects
                @foreach ($subjects as $subject)
                    existingRow += "<option value='{{ $subject->id }}'>{{ $subject->name }}</option>";
                @endforeach
                existingRow += "</select></td>";

                existingRow +=
                    "<td class='col-12 col-md-3'><select name='time_schedule_id[]' class='form-control inputs' id='time_schedule_id{{ $key + 1 }}'>";
                // timeschedule
                @foreach ($timeschedules as $timeschedule)
                    existingRow +=
                        "<option value='{{ $timeschedule->id }}'>{{ $timeschedule->start_time }} - {{ $timeschedule->end_time }}</option>";
                @endforeach

        
                existingRow +=
                    "<td class='col-12 col-md-3'><select name='class_room_id[]' class='form-control inputs' id='class_room_id{{ $key + 1 }}'>";
                // Add classroom
                @foreach ($classrooms as $classroom)
                    existingRow += "<option value='{{ $classroom->id }}'>{{ $classroom->room_no }}</option>";
                @endforeach

                //pass hidden classRoutine id
                existingRow +=
                    "</select><input type='hidden' name='classRoutine_id[]' value='{{ $classRoutine->id }}'></td>";

                existingRow +=
                    "<td class='col-12 col-md-1'><button type='button' data-row='row{{ $key + 1 }}' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark' ></i></button></td>";
                existingRow += "</tr>";

                $('#edit_duplicate_row').append(existingRow);
                $('#subject_id{{ $key + 1 }}').val('{{ $classRoutine->subject->id }}');
                $('#time_schedule_id{{ $key + 1 }}').val('{{ $classRoutine->timeschedule->id }}');
                $('#class_room_id{{ $key + 1 }}').val('{{ $classRoutine->classroom->id }}');
            @endforeach
        });
    </script>


    {{-- class and section --}}
    <script>
        $(document).ready(function() {

            $(document).on('change', '#class_id', function() {
                var classId = $(this).val();
                // console.log(classId);
                $.ajax({
                    url: url + "/getSection/" + classId,
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

    {{-- update subjectAssign --}}

    <script>
        $('#classRoutine_update').validate();

        $(document).ready(function() {

            $('#classRoutine_update').submit(function(e) {
                e.preventDefault();

                var isValid = true;
                $(".validate-input").each(function () {
                    if ($(this).val() === '') {
                        isValid = false;
                        $(this).addClass("error");
                    } else {
                        $(this).removeClass("error");
                    }
                });

                let class_id = $(this).attr("class_id");
                let section_id = $(this).attr("section_id");

                if (isValid) {
                    $.ajax({
                        url: url + "/ClassRoutineUpdate/" + class_id + "/" + section_id,
                        method: "POST",
                        data: $(this).serialize(),
                        // data:{
                        //     'class_id': class_id,
                        //     'section_id': section_id,
                        // },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Update Successfully');
                                window.location.href = url + '/ClassRoutine';
                            }
                        },
                        error: function(data, textStatus, errorMessage) {
                            newdata = $.parseJSON(data.responseText)
                            for (const key in newdata.errors) {
                                errorContainer = $('#' + key + '_error');
                                errorContainer.text(newdata.errors[key][0]);
                            }
                        }
                    });
                }
            });
        });
    </script>
@endsection
