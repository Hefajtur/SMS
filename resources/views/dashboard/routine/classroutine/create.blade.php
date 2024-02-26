@extends('dashboard.master')

@section('title')
    Create classroutine
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Class Routine</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Class Routine</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Add New</li>
                    </ol>
                </div>
                <form action="" method="POST" id="classroutine_insert">
                    <fieldset>
                        @csrf

                        <div class="row mt-5">
                            <div class="col-md-3 mb-3">
                                <label>Class <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control inputs" id="class_id" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">
                                            {{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Section <span class="text-danger">*</span></label>
                                <select name="section_id" class="form-control inputs" id="section_id" required>
                                    <option value="">Select Section</option>

                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Shift <span class="text-danger">*</span></label>
                                <select name="shift_id" class="form-control inputs" id="shift_id" required>
                                    <option value="">Select Shift</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}">
                                            {{ $shift->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="shift_id_error" class="error"></span>              
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Day <span class="text-danger">*</span></label>
                                <select name="day" class="form-control inputs" id="day" required>
                                    <option value="">Select Day</option>
                                    @foreach ($days as $day)
                                        <option value="{{ $day->id }}">
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
                                            <button type="button" class="btn btn-primary" id="addmore"> + Add</button>
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

                                            <tbody id="duplicate_row" class="col-12">

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

    {{-- Jquery field duplicator and remove --}}
    <script>
        $(document).ready(function() {

            var count = 1;
            $('#addmore').click(function() {
                count = count + 1;
                var html_code = "<tr id='row" + count + "'>";
                    
                html_code +=
                    "<td class='col-12 col-md-3'><select name='subject_id[]' class='form-control inputs' id='subject_id' required> <<option value=''>Select subject</option><@foreach ($subjects as $subject)<option value='{{ $subject->id }}'>{{ $subject->name }}</option>@endforeach></select></td>";
                html_code +=
                    "<td class='col-12 col-md-3'><select name='time_schedule_id[]' class='form-control inputs' id='time_schedule_id' required><<option value=''>Select time schedule</option><@foreach ($timeschedules as $timeschedule)<option value='{{ $timeschedule->id }}'>{{ $timeschedule->start_time }} - {{ $timeschedule->end_time }}</option>@endforeach></select></td>";
                html_code +=
                    "<td class='col-12 col-md-3'><select name='class_room_id[]' class='form-control inputs' id='class_room_id' required><<option value=''>Select class room</option><@foreach ($classrooms as $classroom)<option value='{{ $classroom->id }}'>{{ $classroom->room_no }}</option>@endforeach></select></td>";    

                html_code +=
                    "<td class='col-12 col-md-1'><button type='button' data-row='row" +
                    count +
                    "' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark'></i></button></td>";
                html_code += "</tr>";

                $('#duplicate_row').append(html_code);
            });

            $(document).on('click', '.remove', function() {
                var delete_row = $(this).data("row");
                $('#' + delete_row).remove();
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

        {{-- add classRoutine --}}

        <script>
            $('#classroutine_insert').validate();
    
            $(document).ready(function() {
    
                $('#classroutine_insert').submit(function(e) {
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
    
         
                    if (isValid) {
                        $.ajax({
                            url: "{{ route('ClassRoutine.store') }}",
                            method: "POST",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function(response) {
                                if (response.success == true) {
                                    alert('Add Successfully');
                                    $('#classroutine_insert')[0].reset();
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
