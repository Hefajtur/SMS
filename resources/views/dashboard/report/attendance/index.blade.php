@extends('dashboard.master')

@section('title')
    Attendance
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto">
                <div class="row bg-white">
                    <h4 class="bradecrumb-title py-1">Attendance</h4>
                    <ol class="breadcrumb bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">Attendance</li>
                    </ol>
                </div>

                <div class="row bg-white">
                    <form action="" method="" id="filter">
                        @csrf
                        <div class="">
                           <h1>Filtering</h1>
                        </div>
                        <div class="row p-3 bg-white d-flex">

                            <div class="col-md-1 mt-2">
                                
                            </div>

                            <div class="col-md-3 mt-2">
                                <select required  class="col-md-12 form-control inputs" name="section_id" id="section_id" required>
                                    <option class="form-control">--Short View--</option>
                                    <option class="form-control">--Details View--</option>
                                </select>
                            </div>

                            <div class="col-md-3 mt-2">
                                <select required  id="class_id" class="col-md-12 form-control inputs" name="class_id" required>
                                    <option class="form-control">--Select Class--</option>
                                    
                                </select>
                                <span class="text-danger" id="class_id_error"></span>
                            </div>
                            <div class="col-md-3 mt-2">
                                <select required  class="col-md-12 form-control inputs" name="section_id" id="section_id" required>
                                    <option class="form-control">--Select Section--</option>
                                </select>
                                <span class="text-danger" id="section_id_error"></span>
                            </div>

                            <div class="col-md-2 mt-2">
                                <input required type="month" class="form-control inputs" min="2023-01" max="2023-12">
                                <span class="text-danger" id="section_id_error"></span>
                            </div>    
                        </div>

                        <div class="row p-3 bg-white">

                            <div class="col-md-6">
                               
                            </div>

                            <div class="col-md-2">
                                <input required type="date" class="form-control inputs">
                            </div> 

                            <div class="col-md-3">
                               <input required type="number" class="form-control inputs" placeholder="Roll Number">
                            </div> 

                            <div class="col-md-1 px-3">
                                <button type="button" class="btn btn-primary float-end" id="search">Search</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

@endsection
