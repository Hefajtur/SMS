@extends('dashboard.master')
@section('title')
    Marksheet
@endsection
@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Marksheet</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Marksheet</li>
                    </ol>
                </div>

                <div class="row bg-white">
                    <form action="" method="POST" id="marksheet">
                        @csrf
                        <div class="">
                            <h1>Filtering</h1>
                        </div>
                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-3 mt-2">

                            </div>

                            <div class="col-md-3 mt-2">
                                <select id="class_id" required class="form-control inputs" name="class_id">
                                    <option class="form-control">--Select Class--</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <span class="text-danger" id="class_id_error"></span>
                            </div>
                            <div class="col-md-3 mt-2">
                                <select class="form-control inputs" required name="section_id" id="sectionSelect">
                                </select>
                                <span class="text-danger" id="sectionSelect_error"></span>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select class="form-control inputs" required name="exam_type" id="exam_id">
                                    <option class="form-control" value="">--Select Exam Type--</option>
                                    @foreach ($examTypes as $examType)
                                        <option class="form-control" value="{{ $examType->id }}">{{ $examType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="exam_type_error"></span>
                            </div>
                        </div>

                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-7">
                            </div>


                            <div class="col-md-3">
                                <select class="form-control inputs" required name="student_id" id="studentDATA">
                                  </select>
                                <span class="text-danger" id="student_id_error"></span>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-lg btn-primary float-end"
                                    id="search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div id="datatable" style="display: none" class="row mt-3 bg-white table-responsive">
                    <table class="table table-border">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Class Section</th>
                                <th>Exam</th>
                                <th>Subject</th>
                                <th>Total-Marks</th>
                                <th>Obtained Marks</th>
                            </tr>
                        </thead>
                        <tbody id='result'>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
