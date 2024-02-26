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
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Edit Subject Assign</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit Subject Assign</li>
                        <li class="breadcrumb-item" style="font-size: 15px">Edit</li>
                    </ol>
                </div>
                @foreach ($subjectAssigns as $subjectAssign)
                @endforeach
                <form action="" method="POST" id="subjectAssign_update" class_id="{{ $subjectAssign->class->id }}"
                    section_id={{ $subjectAssign->section->id }}>
                    <fieldset>
                        @csrf

                        <div class="row mt-5">
                            <div class="col-md-4 mb-3">
                                <label>Class <span class="text-danger">*</span></label>
                                <select name="class_id" required  class="form-control inputs js-example-basic-single" id="class_id">
                                    @foreach ($subjectAssigns as $subjectAssign)
                                    @endforeach

                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}" {{ $subjectAssign->class_id == $class->id ? 'selected' : ''}}>
                                            {{ $class->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Section <span class="text-danger">*</span></label>
                                <select name="section_id" required  class="form-control inputs js-example-basic-single"
                                    id="section_id">
                                    <option value="{{ $subjectAssign->section->id }}">{{ $subjectAssign->section->name }}
                                    </option>

                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-4 ">
                                <label>Status <span class="text-danger">*</span></label><br>
                                <select name="status" required  class="form-control inputs js-example-basic-single"
                                    id="classAssign_status">
                                    <option value="1" {{ $subjectAssign->status == 1 ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="0" {{ $subjectAssign->status == 0 ? 'selected' : '' }}>Inactive
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 mb-5">
                                <div class="row shadow py-4 mb-5">
                                    <div
                                        class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                        <h3 class="text-dark">Add Subject & Teacher</h3>
                                        <div class="button" id="x">
                                            <button type="button" class="btn btn-primary" id="add"> +
                                                Add</button>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Teacher</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>

                                            <tbody id="edit_duplicate_row" class="col-12">

                                            </tbody>
                                        </table>

                                            <button type="submit" class="btn btn-lg btn-primary float-end"><i
                                                    class="fa-solid fa-save"></i>
                                                Submit</button>
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
        var count = {{ count($subjectAssigns) }}; // Set the initial count to the number of existing rows.

        // Add new row
        $('#add').click(function() {
            count = count + 1;
            var html_code = "<tr id='row" + count + "'>";

            // Add options for subjects
            html_code +=
                    "<td class='col-12 col-md-5'><select  required name='subject_id[]' class='form-control inputs js-example-basic-single' id='subject_id'> <<option value=''>Select Subject</option><@foreach ($subjects as $subject)<option value='{{ $subject->id }}'>{{ $subject->name }}</option>@endforeach></select></td>";

            html_code +=
                    "<td class='col-12 col-md-5'><select  required name='user_id[]' class='form-control inputs js-example-basic-single' id='user_id'><<option value=''>Select Teacher</option><@foreach ($users as $user)<option value='{{ $user->id }}'>{{ $user->name }}</option>@endforeach></select></td>";

            html_code += "<td class='col-12 col-md-1'><button type='button' data-row='row" + count + "' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark'></i></button></td>";
            html_code += "</tr>";

            $('#edit_duplicate_row').append(html_code);
        });

        // Remove row
        $(document).on('click', '.remove', function() {
            var delete_row = $(this).data("row");
            $('#' + delete_row).remove();
        });

        // Populate existing data and retain selected options
        @foreach ($subjectAssigns as $key => $subjectAssign)
            var existingRow = "<tr id='row{{ $key + 1 }}'>";
            existingRow += "<td class='col-12 col-md-5'><select required  name='subject_id[]' class='form-control inputs' id='subject_id{{ $key + 1 }}'>";

            // Add options for subjects
            @foreach ($subjects as $subject)
                existingRow += "<option value='{{ $subject->id }}'>{{ $subject->name }}</option>";
            @endforeach
            existingRow += "</select></td>";

            existingRow += "<td class='col-12 col-md-5'><select required  name='user_id[]' class='form-control inputs' id='user_id{{ $key + 1 }}'>";
            // Add options for users
            @foreach ($users as $user)
                existingRow += "<option value='{{ $user->id }}'>{{ $user->name }}</option>";
            @endforeach

            //pass hidden subjectAssign id
            existingRow += "</select><input type='hidden' name='subjectAssign_id[]' value='{{$subjectAssign->id}}'></td>";

            existingRow += "<td class='col-12 col-md-1'><button type='button' data-row='row{{ $key + 1 }}' class='btn btn-danger btn-lg remove'><i class='fa-solid fa-xmark' ></i></button></td>";
            existingRow += "</tr>";

            $('#edit_duplicate_row').append(existingRow);
            $('#subject_id{{ $key + 1 }}').val('{{ $subjectAssign->subject->id }}');
            $('#user_id{{ $key + 1 }}').val('{{ $subjectAssign->user->id }}');
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
        $(document).ready(function() {

            $('#subjectAssign_update').submit(function(e) {
                e.preventDefault();
                let class_id = $(this).attr("class_id");
                let section_id = $(this).attr("section_id");
                // alert(section_id);
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
                    url: url + "/subjectAssignUpdate/" + class_id + "/" + section_id,
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
                            window.location.href = url + '/subjectAssign';
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
