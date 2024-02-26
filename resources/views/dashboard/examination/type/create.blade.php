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
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/examtypes') }}">Exam type</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/examtypes/create') }}">Add Exam
                            type</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12 mx-auto bg-white py-3">
            <div class="row d-flex justify-content-between">
                <h3 class="p-3">Exam-Types</h3>
                <h3 class="mt-5 badge_status_act">Add Types Of Exam Data</h3>
                 <a href="{{url('/examtypes')}}"><button class="btn-primary"><strong>See Exam-Types</strong></button></a>
            </div>

            <form action="" method="POST" id="examTypeStore">
                <fieldset>
                    @csrf
                    <div class="row ">
                        <div class="col-md-6">
                            <label for=""  class="col-md-12 label_name">Name</label>
                            <input type="text" required class="form-control col-md-12 inputs" required minlength="3" name="name">
                            <span id="name_error" class="error"></span>
                        </div>
                       
                        <div class="col-md-6 ">
                            <label for="" class="col-md-12 label_name">Status</label>
                            <select class=" inputs col-md-12 form-control" required  name="status">
                                <option class="form-control inputs" value="">Select Satus</option>
                                <option class="form-control inputs" value="1">Active</option>
                                <option class="form-control inputs" value="0">InActive</option>
                            </select>
                           
                            <span id="status_error" class="error"></span>
                        </div>
                    
                        <div class="col-md-12 mt-3" >
                            <input type="submit" class="btn btn-primary float-right" value="Add Exam">    
                        </div>
                    </div>
                </fieldset>
             </form>

        </div>
    </div>
</div>
<script>
</script>
@endsection
