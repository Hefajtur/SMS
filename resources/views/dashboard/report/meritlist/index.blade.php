@extends('dashboard.master')

@section('title')
    Merit List
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Merit List</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Merit List</li>
                    </ol>
                </div>


                <div class="row bg-white mt-3 mb-3">
                    <form action="" method="" id="meritSearch">
                        @csrf
                        <div class="">
                            <h2>Filtering</h2>
                        </div>
                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-1 mt-2">
                            </div>

                            <div class="col-md-3 mt-2">
                                <select id="class_id" class="col-md-12 form-control inputs" name="class_id" required>
                                    <option class="form-control" value="">--Select Class--</option>
                                    @foreach ($classes as $item)
                                        <option class="form-control" value="{{ $item->id }}">{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="class_id_error"></span>
                            </div>
                            <div class="col-md-3 mt-2">
                                <select class="col-md-12 form-control inputs" name="section_id" id="sectionSelect" required>
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select class="col-md-12 form-control inputs" name="exam_type" id="exam_type" required>
                                    <option class="form-control">--Select Exam Type--</option>
                                    @foreach ($exam_type as $exam_type)
                                        <option class="form-control" value="{{ $exam_type->id }}">{{ $exam_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="exam_type_error"></span>
                            </div>

                            <div class="row p-3 bg-white d-flex">

                                <div class="col-md-7">
                                </div>

                                <div class="col-md-3">
                                    <select class="col-md-12 form-control inputs" name="shift_id" id="shift_id" required>
                                        <option class="form-control">--Select shift--</option>
                                        @foreach ($shift as $val)
                                            <option class="form-control" value="{{ $val->id }}">{{ $val->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="shift_id_error"></span>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-lg btn-primary float-end"
                                        id="search">Search</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div style="display: none" class="row bg-white table-responsive" id="progressData">
                    <table class="table table-bordered ">
                        <thead>
                            <h4 class="text-center" id="name"> </h4>
                            <tr>
                                <th>Sr.No</th>
                                <th>Student Name</th>
                                <th>Total-Marks</th>
                                <th>Obtained Marks</th>
                                <th>Merit-List</th>
                            </tr>
                        </thead>
                        <tbody id='meritSearchResult'>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
