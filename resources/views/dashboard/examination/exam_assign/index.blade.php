@extends('dashboard.master')

@section('title')
Exam-Assign
@endsection

@section('body')
<div class="container py-5 mt-5 ">
    <div class="row">    
        
        <div class="col-md-12  ">
            <h3 class="bg-light py-2">Exam-Assign</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/examassigns')}}">Exam-Assign</a></li>
                    
                </ol>
            </nav>
            <div class="row">
                <div class=" col-md-12 bg-white d-flex justify-content-between">
                    <h3 class="p-3">Filtering</h3>
                    <a href="{{url('/examassigns/create')}}"><button class="btn btn-primary mt-3">+Add </button></a>
                </div>
            </div>

            <form action="" method="POST" id="examAssignSearch">
                <fieldset>
                @csrf
                    <div class="row p-5 bg-white">
                        <div class="col-md-3">
                            <label for="" class="col-md-12 label_name"> Exam-Assign <span class="text-danger">*</span></label>
                            <select required class="js-example-basic-single col-md-12 form-control" name="exam_id">
                                <option class="form-control inputs" value="">Select Exam-Assign</option>
                                @foreach ($examTypes as $examType)  
                                    <option class="form-control inputs"  value="{{$examType->id}}">{{$examType->name}}</option>
                                @endforeach
                            </select>        
                         <span id="exam_id_error" class="error"></span>
                        </div>
                        <div class="col-md-2">
                            <label for="" class="label_name" >Class<span class="text-danger">*</span></label>
                            <select id="class_id"  class="js-example-basic-single col-md-12 form-control" name="class_id">
                                    <option class="form-control" value="">select Class</option>
                                    @foreach ($classes as $class)  
                                        <option class="form-control"  value="{{$class->id}}">{{$class->name}}</option>
                                    @endforeach
                                </select>        
                            <span id="class_id_error" class="error"></span>
                        </div>

                        <div class="col-md-2 " >
                            <label for="" class="label_name">Sections<span class="text-danger">*</span></label>
                            <select class="js-example-basic-single col-md-12 form-control"  name="section_id" id="sectionSelect">
                            
                            </select>        
                            <span id="section_id_error" class="error"></span>
                        </div>


                        <div class="col-md-3">
                            <label for="" class="col-md-12 label_name">Subject <span class="text-danger">*</span></label>
                            <select id="" class="js-example-basic-single col-md-12 form-control inputs" name="subject_id">
                                <option class="form-control inputs" value="">Select Exam Type</option>
                                @foreach ($subjects as $subject)  
                                    <option class="form-control inputs"  value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>        
                         <span id="subject_id_error" class="error"></span>
                        </div>

                        <div class="col-md-2 mt-4">
                            <label for=""></label>
                            <input type="submit" class="btn btn-success" value="Search">
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
                        <th>Exam Title </th>
                        <th>Class (Section)</th>
                        <th>Subject </th>
                        <th>Total Marks</th>
                        <th>Mark Distribution</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="examAssignResult">

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    
    $('#masterStore').validate();

  </script>

@endsection
