@extends('dashboard.master')

@section('title')
    Create Exam-Assign
@endsection

@section('body')
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5  mx-5 py-3">
                <h3 class="bg-light text-center py-2">Mark Register</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a
                                href="{{ url('/markregisters') }}">Mark-Register</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="{{ url('/markregisters/create') }}">Add
                                Mark-Register</a></li>

                    </ol>
                </nav>
                <form action="" method="POST" class="p-5 bg-white" id="markRegisterStore">
                    <fieldset>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="col-md-12 label_name">Class<span
                                        class="text-danger">*</span></label>
                                <select id="class_id" required class="js-example-basic-single col-md-12 form-control"
                                    name="class_id">
                                    <option class="form-control " value="">select Class</option>
                                    @foreach ($classes as $class)
                                        <option class="form-control" value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="class_id_error" class="error"></span>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="label_name">Sections</label>
                                <select required class="js-example-basic-single col-md-12 form-control" name="section_id"
                                    id="sectionSelect">
                                </select>

                                <span id="section_id_error" class="error"></span>
                            </div>

                            <div class="col-md-3 ">
                                <label for="" class="col-md-12 label_name">Exam Type <span
                                        class="text-danger">*</span></label>
                                <select required class="js-example-basic-multiple col-md-12 form-control" name="exam_type"
                                    id="exam_type">
                                    <option class="form-control" selected value="">Select Exam Type</option>
                                    @foreach ($examTypes as $examType)
                                        <option class="form-control" value="{{ $examType->id }}">{{ $examType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="exam_type_error" class="error"></span>
                            </div>

                            <div class="col-md-3">
                                <label for="" class="col-md-12 label_name">Subject <span class="text-danger">*</span></label>
                                <select required class="js-example-basic-single col-md-12 form-control" id="subject_id" name="subject_id">
                                </select>
                                <span id="subject_id_error" class="error"></span>
                            </div>
                        </div>
                        <div class="row mt-3 d-flex">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Total-Mark</th>
                                        <th>Mark-Distribution</th>
                                    </tr>
                                </thead>
                                <tbody id="markRegisterStudent">
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <label for="" class="col-md-10"></label>
                            <input type="submit" class="btn btn-success float-right" value="Submit">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#markRegisterStudent').on('input', '.marks', function() {
                var totalInput = $(this).closest('tr').find('.total');
                var totalValue = parseFloat(totalInput.val());
                var marksValue = parseFloat($(this).val());
                let id = $(this).attr("attribute");
                if (marksValue > totalValue) {
                    $(this).addClass('error');
                    alert("The marks is greater than total-marks.");
                } else {
                    $(this).removeClass('error');
                }
            });
        });
    </script>
@endsection
