@extends('dashboard.master')

@section('title')
    edit marks grade
@endsection

@section('body')
<div class="container py-5 ">
    <div class="row">    
        <div class="col-md-11 mt-5  mx-5 py-3">
            <h3 class=" bg-light py-3">Marks Grade</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/markgrades')}}">Marks Grade</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{url('/markgrades/create')}}">Add Marks Grade</a></li>
                </ol>
            </nav>
            <form action="" method="POST" id="marksGradeUpdate" marks_grade_id="{{$marks_grade->id}}">
                <fieldset>
                @csrf
                    <div class="row p-5 bg-white d-flex">
                        <div class="col-md-6">
                            <label for="" class="col-md-12 label_name"> Name <span class="text-danger">*</span></label>
                            <input type="text" required name="name" class="form-control col-md-12 inputs" placeholder="Enter Name" value="{{$marks_grade->name}}">
                            <span id="name_error" class="error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-md-12 label_name">Point <span class="text-danger">*</span></label>
                           <input type="number" class="col-md-12 form-control inputs"  required  name="point"  placeholder="Enter Point" value="{{$marks_grade->point}}">
                           <span id="point_error" class="error"></span>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="col-md-12 label_name">Percent Form <span class="text-danger">*</span></label>
                           <input type="number" class="col-md-12 form-control inputs"  required  name="parcent_from"  placeholder="Enter Percent From" value="{{$marks_grade->parcent_from}}">
                           <span id="parcent_from_error" class="error"></span>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="col-md-12 label_name">Percent Upto <span class="text-danger">*</span></label>
                           <input type="number" class="col-md-12 form-control inputs"  required  name="parcent_upto"  placeholder="Enter Percent Upto" value="{{$marks_grade->parcent_upto}}">
                           <span id="parcent_upto_error" class="error"></span>
                        </div>
                       
                        <div class="col-md-6 mt-3">
                            <label for="" class="col-md-12 label_name">Reamrks <span class="text-danger">*</span></label>
                           <input type="number" class="col-md-12 form-control inputs" required  name="remarks"  placeholder="Enter Reamrks" value="{{$marks_grade->remarks}}">
                           <span id="remarks_error" class="error"></span>
                        </div>


                        <div class="col-md-6 mt-3 ">
                            <label for="" class="col-md-12 label_name">Status</label>
                            <select class="js-example-basic-single col-md-12 form-control inputs" required name="status">
                                <option class="form-control inputs" value="1" {{$marks_grade->status==1?'selected': ''}}>Active</option>
                                <option class="form-control inputs" value="0" {{$marks_grade->status==0 ?'selected': ''}}>InActive</option>
                            </select>
                            <span id="status_error" class="error"></span>
                        </div>
                
                        <div class="col-md-12 mt-3" >
                            <input type="submit" class="btn btn-primary mx-auto" value="Add Marks">    
                        </div>
                    </div>
            </fieldset>
         </form>
        </div>
    </div>
</div>

@endsection
