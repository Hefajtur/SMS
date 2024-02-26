@extends('dashboard.master')

@section('title')
    Create SubjectAssign
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Subject Assign</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Subject Assign</li>
                    </ol>
                </div>
                <form action="" method="POST" id="subjectAssign_insert">
                    <fieldset>
                        @csrf

                        <div class="row mt-5">
                            <div class="col-md-4 mb-3">
                                <label>Class <span class="text-danger">*</span></label>
                                <select name="class_id" required  class="form-control inputs js-example-basic-single" id="class_id">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">
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
                                    <option value="">Select Section</option>

                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-4 ">
                                <label>Status <span class="text-danger">*</span></label><br>
                                <select name="status" required  class="form-control inputs js-example-basic-single"
                                    id="classAssign_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-12 mb-5">
                                <div class="row shadow py-4 mb-5">
                                    <div
                                        class="col-12 col-md-12 d-flex justify-content-between align-items-center bg-transparent mb-4">
                                        <h3 class="text-dark">Add Subject & Teacher</h3>
                                        <div class="button">
                                            <button type="button" class="btn btn-primary" id="addmore"> + Add</button>
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
                    "<td class='col-12 col-md-5'><select name='subject_id[]' required  class='form-control inputs js-example-basic-single' id='subject_id'> <<option value=''>Select Subject</option><@foreach ($subjects as $subject)<option value='{{ $subject->id }}'>{{ $subject->name }}</option>@endforeach></select></td>";
                html_code +=
                    "<td class='col-12 col-md-5'><select name='user_id[]' required  class='form-control inputs js-example-basic-single' id='user_id'><<option value=''>Select Teacher</option><@foreach ($users as $user)<option value='{{ $user->id }}'>{{ $user->name }}</option>@endforeach></select></td>";

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

    {{-- add subjectAssign --}}

    <script>

        $(document).ready(function() {

            $('#subjectAssign_insert').submit(function(e) {
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
                    url: "{{ route('subjectAssign.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.success == true) {
                            alert('Add Successfully');
                            $('#subjectAssign_insert')[0].reset();
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
