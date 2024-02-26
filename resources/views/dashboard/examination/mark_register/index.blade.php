@extends('dashboard.master')

@section('title')
    Marks
@endsection

@section('body')
    <div class="container py-5 mt-5 ">
        <div class="row">

            <div class="col-md-12  ">
                <div class="bg-light ">
                    <h3 class="text-center">Mark Register</h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item" style="font-size: 20px"><a
                                    href="{{ url('/markregisters') }}">Mark-Register</a></li>

                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class=" col-md-12 bg-white d-flex justify-content-between">
                        <h3 class="p-3">Filtering</h3>
                        <a href="{{ url('/markregisters/create') }}"><button class="btn btn-primary mt-3">+Add </button></a>
                    </div>
                </div>

                <form action="" method="POST" id="markRegisterSearch">
                    <fieldset>
                        @csrf
                        <div class="row p-5 bg-white">

                            <div class="col-md-2">
                                <label for="" class="label_name">Class<span class="text-danger">*</span></label>
                                <select id="class_id" required class="js-example-basic-single col-md-12 form-control"
                                    name="class_id">
                                    <option class="form-control" value="">select Class</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 ">
                                <label for="" class="label_name">Sections<span class="text-danger">*</span></label>
                                <select required class="js-example-basic-single col-md-12 form-control mt-1"
                                    name="section_id" id="sectionSelect">
                                </select>
                                <span id="section_id_error" class="error"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="col-md-12 label_name"> Exam-Assign <span
                                        class="text-danger">*</span></label>
                                <select required class="js-example-basic-single col-md-12 form-control" name="exam_id"
                                    id="exam_type">
                                    <option class="form-control inputs" value="">Select Exam-Assign</option>
                                    @foreach ($examTypes as $examType)
                                        <option class="form-control inputs" value="{{ $examType->id }}">
                                            {{ $examType->name }}</option>
                                    @endforeach
                                </select>
                                <span id="exam_id_error" class="error"></span>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="col-md-12 label_name">Subject <span
                                        class="text-danger">*</span></label>
                                <select id="subject_id" required class="js-example-basic-single col-md-12 form-control inputs" name="subject_id">
                                   
                                </select>
                                <span id="subject_id_error" class="error"></span>
                            </div>

                            <div class="col-md-2 mt-4">
                                <label for=""></label>
                                <input type="submit" class="btn btn-success" id="result" value="Search..">
                            </div>

                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="col-md-12 ">
                <table class="table bg-white">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Exam Type </th>
                            <th>Class (Section)</th>
                            <th>Subject </th>
                            <th>Student & Marks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="markRegisterResult">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @csrf
    <script>
        // $('#markRegisterSearch').validate();
    </script>
@endsection
