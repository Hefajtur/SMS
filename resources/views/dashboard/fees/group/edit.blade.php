@extends('dashboard.master')

@section('title')
    Edit Group
@endsection

@section('body')
<div class="container py-5 ">
    <div class="row">    
        <div class="col-md-11 mt-5  mx-5 py-3">
            <div class="row d-flex justify-content-between">
                <h3 class="p-3">Home / Fees-Group /Edit Group</h3>
                <a href="{{url('/groups/index')}}"><button class="p-3 btn-primary"><strong>See Group</strong></button></a>
            </div>

            <form action="" method="POST" id="updateGroup" group_id="{{$group->id}}">
                <fieldset>
                @csrf
                <div class="row p-5 bg-white d-flex">
                    <div class="col-md-6">
                        <label for="" class="label_name">Name</label>
                        <input type="text" class="form-control inputs" required minlength="3" name="name" value="{{$group->name}}">
                        <span id="name_error" class="error"></span>
                    </div>
                   
                    <div class="col-md-6">
                        <label for="" class=" col-md-12 label_name">Status </label>
                        <select class=" inputs col-md-12 " name="status" required>
                            <option value="1" {{$group->status==1 ? 'Active' : '' }}>Active</option>
                            <option value="0" {{$group->status==0 ? 'Active' : '' }}>InActive</option>
                        </select>
                        <span id="status_error" class="error"></span>
                    </div>
                    
                    <div class="col-md-12 mt3" >
                        <label for="" class="label_name" >Description </label>
                        {{-- id="summernote" --}}
                        <textarea name="description" class="form-control" required  minlength="11" cols="25" rows="4" >
                            {!! $group->description !!}</textarea>
                        <span id="description_error" class="error"></span>
                    </div>

                    <div class="col-md-12 mt-2" >
                        <input type="submit" class="btn btn-primary float-right" value="Update">
                    </div>
                </div>
            </fieldset>
            </form>

        </div>
    </div>
</div>

@endsection
