@extends('dashboard.master')

@section('title')
    Edit Types
@endsection

@section('body')
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5  mx-5 py-3">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Home / Fees-Types /Edit Assigns</h3>

                </div>
                <form action="" method="POST" id="updateAssign" assign_id="{{ $assign->id }}">
                    <fieldset>
                        @csrf
                        <div class="row p-5 bg-white d-flex">
                            <div class="col-md-3 mt-3">
                                <label for="" class="col-md-12">Group Name</label>
                                <select required class="col-md-12 form-control" name="group_id" id="groupSelection">
                                    @foreach ($groups as $group)
                                        <option class="form-control" value="{{ $group->id }}"
                                            {{ $group->id == $assign->group_id ? 'selected' : '' }}>{{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="group_id_error" class="error"></span>
                            </div>

                            {{-- //hidden id pass --}}
                            <input type="hidden" name="assign_id"  id="assign_id" value="{{ $assign->id }}">

                            <div class="col-md-2 mt-3">
                                <label for="" class="col-md-12">Class</label>
                                <select id="classSelect" required class="col-md-12 form-control" name="class_id">
                                    @foreach ($classes as $class)
                                        <option class="form-control" {{ $class->id == $assign->class_id ? 'selected' : '' }}
                                            value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Sections</label>
                                <select required class="js-example-basic-single col-md-12 form-control" name="section_id"
                                    id="sectionSelect">
                                    <option value="{{ $assign->section_id }}"> {{ $assign->section->name }}</option>
                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Gender</label>
                                <select  class="col-md-12 form-control" name="gender" id="genderSelect">
                                    <option class="form-control" value="">Select Gender</option>
                                    @foreach ($genders as $gender)
                                        <option class="form-control" value="{{ $gender->id }}"
                                            {{ $gender->id == $assign->gender ? 'selected' : '' }}>
                                            {{ $gender->name }}</option>
                                    @endforeach
                                </select>
                                <span id="gender_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mt-3">
                                <label for="">Student Category</label>
                                <select  class="col-md-12 form-control" name="category_id" id="selectedCategory">
                                    <option class="form-control" value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option class="form-control" value="{{ $category->id }}"
                                            {{ $category->id == $assign->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <span id="category_id_error" class="error"></span>
                            </div>

                            <div class="col-md-4 mt-3 border checkbox-group ">
                                <h2>fees Types</h2>
                                <div class="row">
                                    <table class="table border checkbox-group">
                                        <thead>
                                            <tr>
                                                <th class=""><label>All</label>
                                                    <input class="check-all"type="checkbox">
                                                </th>
                                                <th>Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id='typeOfFees'>

                                            @foreach ($allDatas as $val)
                                                <tr>
                                                    <td><input type='checkbox' class="check" checked value="{{ $val->type_id }}" type-data=""  name='master_id[]'></td>

                                                    <td>{{ $val->type_name }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-8 mt-3 border ">
                                <h2>Student List</h2>
                                <div class="row">
                                    <table class="table checkbox-group">
                                        <thead>
                                            <tr>
                                                <th scope="col">
                                                    All <input class="check-all" type="checkbox" id="selectStudentId">
                                                </th>
                                                <th scope="col">Admission NO</th>
                                                <th scope="col">Student Name</th>
                                                <th scope="col">Class (Section)</th>
                                                <th scope="col">Guardian Name</th>
                                                <th scope="col">Mobile Number</th>
                                            </tr>
                                        </thead>
                                        <tbody id="studentDataForAssign" class="">

                                            @foreach ($allStudents as $key => $val)
                                                <tr>
                                                    <td><input type='checkbox' class="check" checked class="check"
                                                            value="{{ $val->id }}" student-data="" name='students_id[]'></td>

                                                    <td>{{ $val->admission_no }}</td>
                                                    <td>{{ $val->first_name }} {{ $val->last_name }}</td>
                                                    <td>{{ $val->class_name }} ({{ $val->section_name }})</td>
                                                    <td>{{ $val->guardians_name }}</td>
                                                    <td>{{ $val->mobile }}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <span id="students_id_error" class="error"></span>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary mx-auto" id="update-button">Update</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    {{-- //to catch the section by class selection --}}

    <script>
        $(document).on('change', '#classSelect', function() {
            var classId = $(this).val();
            if(classId != null){
            $.ajax({
                url: url + "/get-section-for-assign/" + classId,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    var option = '';
                    option += '<option value="" selected disabled>Select Section</option>';
                    for (const key in data) {
                        option += "<option class='' value=" + data[key]['id'] + ">" + data[key][
                            'name'
                        ] + '</option>';
                    };
                    $('#sectionSelect').empty().append(option);
                },
            })
            }
        })
    </script>

@endsection
