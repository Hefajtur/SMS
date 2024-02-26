@extends('dashboard.master')

@section('title')
    Edit Types
@endsection

@section('body')
<div class="container p-5 ">
    <div class="row">    
        <div class="col-md-12 mt-5 mx-auto ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/examtypes') }}">Exam type</a></li>
              
                </ol>
            </nav>
        </div>
        <div class="col-md-12 bg-white mx-auto py-3">
            <div class="row d-flex justify-content-between">
                <h3 class="p-3">Exam-Types</h3>
                <h3 class="mt-5 badge_status_act">Edit Type Of Exam Data</h3>
                  <a href="{{url('/examtypes')}}" class="p-3"><button class="btn btn-primary"><strong>See Exam-Types</strong></button></a>
            </div>

            <form action="" method="POST" id="updateExamType" exam_type_id="{{$examtypes->id}}">
                <fieldset>
                @csrf
                <div class="row ">
                    <div class="col-md-6">
                        <label for="" class="label_name">Name</label>
                        <input type="text" class="form-control inputs" name="name" required minlength="3" value="{{$examtypes->name}}">
                        <span id="name_error" class="error"></span>
                    </div>

                    <div class="col-md-6 ">
                        <label for="" class="col-md-12 label_name">Status</label>
                        <select required class=" inputs col-md-12 form-control" name="status">
                            <option value="1" class="inputs" {{$examtypes->status==1 ? 'selected' : '' }}>Active</option>
                            <option value="0" class="inputs" {{$examtypes->status==0 ? 'selected' : '' }}>InActive</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3" >
                        <input type="submit" class="btn btn-primary float-right" value="Update">
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
