@extends('dashboard.master')

@section('title')
    Progress Card
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Progress Card</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Progress Card</li>
                    </ol>
                </div>

                <div class="row bg-white mt-3 mb-3">
                    <form action="" method="" id="progressCard">
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
                                <select class="col-md-12 form-control inputs" name="student_id" id="student_id" required>
                                    <option class="form-control">--Select Student--</option>
                                </select>
                                <span class="text-danger" id="student_id_error"></span>
                            </div>

                            <div class="col-md-2 mt-2">
                                <button type="submit" class="btn btn-lg btn-primary float-end"
                                    id="search">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="display: none" class="row bg-white table-responsive" id="progressData" >
                    <table class="table table-bordered ">
                        <thead>
                            <h4 class="text-center" id="name"> </h4>
                            <tr>
                                <th>Sr.No</th>
                                <th>Subject</th>
                                <th>Total-Marks</th>
                                <th>Obtained Marks</th>
                            </tr>
                        </thead>
                        <tbody id='progressResult'>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
