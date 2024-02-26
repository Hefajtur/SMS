@extends('dashboard.master')

@section('title')
Disable Student
@endsection

@section('body')
<div class="container p-5 ">
    <div class="row">
        <div class="col-md-12 mt-5 mx-auto">
            <div class="row bg-white">
                <h4 class="bradecrumb-title py-1">Disabled Students</h4>
                <ol class="breadcrumb bg-white">
                    <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                    <li class="breadcrumb-item" style="font-size: 15px">Disabled Students</li>
                </ol>
            </div>

            <div class="row bg-white">
                <form action="" method="POST" id="filter">
                    <fieldset>
                        @csrf
                        <div class="row p-3 bg-white d-flex">
                            <div class="col-md-6 mt-2">
                                <label for="" class="label_name">Class<span class="text-danger">*</span></label>
                                <select id="class_id" class="col-md-12 form-control inputs" name="class_id"
                                    required>
                                    <option class="form-control">Select Class</option>
                                    @foreach ($classes as $class)
                                    <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="" class="label_name">Section<span class="text-danger">*</span></label>
                                <select required class="col-md-12 form-control inputs" name="section_id" id="section_id"
                                    required>
                                    <option class="form-control">Select Section</option>
                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>
                            <div class="mt-2 p-3">
                                <button type="button" class="btn btn-lg btn-primary float-end" id="search"><i
                                        class="fa-solid fa-search px-1"></i>Search</button>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" id="student" style="display: none">
                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SR No.</th>
                                            <th scope="col">Admission NO</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Class (Section)</th>
                                            <th scope="col">Guardian name</th>
                                            <th scope="col">Date of birth</th>
                                            <th scope="col">Gender</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="DisableStudentData" class="">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</div>
</div>

{{-- //section with class --}}
<script>
    $(document).ready(function () {

        $(document).on('change', '#class_id', function () {
            var classId = $(this).val();
            // console.log(classId);
            $.ajax({
                url: url + "/getSection/" + classId,
                method: "GET",
                dataType: "JSON",
                success: function (data) {

                    var option = '';
                    option += '<option  selected disabled>Select Section</option>';

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



<script>
    $(document).ready(function () {

        $('#search').click(function (e) {
            e.preventDefault();
            var selectedClass = $('#class_id').val();
            var selectedSection = $('#section_id').val();
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
                showStudent(selectedClass, selectedSection);
            }
        });

        function showStudent(classValue, sectionValue) {
            $.ajax({
                type: 'GET',
                url: url + '/disableStudent-data',
                data: {
                    class: classValue,
                    section: sectionValue
                },
                success: function (data) {
                    $('#DisableStudentData').empty();
                    $('#student').css('display', 'block');
                    for (var i = 0; i < data.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $(
                            "<td>" + (i + 1) + "</td><td>" + data[i].admission_no +
                            "</td><td>" + data[i].first_name + " " + data[i].last_name +
                            " </td><td>" + data[i].class.name + "(" + data[i].section.name +
                            ")" + "</td><td>" + data[i].guardians.guard_name + "</td><td>" + data[i].b_date +
                            "</td><td>" + data[i].genders.name + "</td><td>" + data[i].mobile +
                            "</td><td class='bg-danger badge rounded-pill'>" + [(data[i]
                                .status == 0) ? 'Inactive' : ''] +
                            "</td>");
                        tr.append(td);
                        $('#DisableStudentData').append(tr);
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });
</script>
@endsection