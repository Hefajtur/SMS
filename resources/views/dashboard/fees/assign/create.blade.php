@extends('dashboard.master')

@section('title')
    Create Types
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/assigns') }}">Fess Assign</a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 ">


                <form action="" method="POST" id="assignStore">
                    <fieldset>
                        @csrf
                        <div class="row p-5 bg-white d-flex">
                            <div class="col-md-3 mt-3">
                                <label for="" class="col-md-12">Group Name</label>
                                <select class="js-example-basic-single col-md-12 form-control" required name="group_id"
                                    id="groupSelection">
                                    <option class="form-control" value="">select fees group</option>
                                    @foreach ($groups as $group)
                                        <option class="form-control" value="{{ $group->id }}">{{ $group->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="group_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="" class="col-md-12">Class</label>
                                <select id="classSelect" required class=" col-md-12 form-control" name="class_id">
                                    <option class="form-control" value="">select Class</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Sections</label>
                                <select class="js-example-basic-single col-md-12 form-control" name="section_id"
                                    id="sectionSelect" required>
                                    <option class="form-control" value="">select Section</option>

                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 mt-3">
                                <label for="">Gender</label>
                                <select  class="col-md-12 form-control" name="gender" id="genderSelect">
                                    <option class="form-control" value="">Select Gender</option>
                                    @foreach ($genders as $gender)
                                        <option class="form-control" value="{{ $gender->id }}">{{ $gender->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="gender_error" class="error"></span>
                            </div>

                            <div class="col-md-3 mt-3">
                                <label for="">Student Category</label>
                                <select  class="col-md-12 form-control" name="category_id" id="selectedCategory">
                                    <option class="form-control" value="">Select Category</option>
                                    @foreach ($StudentCategories as $StudentCategory)
                                        <option class="form-control" value="{{ $StudentCategory->id }}">
                                            {{ $StudentCategory->name }}</option>
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
                                                <th class="">
                                                    <label>All</label>
                                                    <input class="check-all"type="checkbox">
                                                </th>

                                                <th>Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id='typeOfFees'>

                                        </tbody>
                                    </table>
                                    <span id="type_id_error" class="error"></span>
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

                                        </tbody>
                                    </table>
                                    <span id="students_id_error" class="error"></span>
                                </div>
                            </div>

                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn btn-primary mx-auto" value="Assign Fees">
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
            $.ajax({
                url: url + "/get-section-for-assign/" + classId,
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    var option = '';
                    option += '<option value="" selected disabled>Select Section</option>';
                    for (const key in data) {
                        option += "<option class='' value=" + data[key]['id'] + ">" + data[key][
                            'name'] + '</option>';
                    };
                    $('#sectionSelect').empty().append(option);
                },
            })
        })
    </script>


@endsection
