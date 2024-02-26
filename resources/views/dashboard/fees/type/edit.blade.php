@extends('dashboard.master')

@section('title')
    Edit Types
@endsection

@section('body')
    <div class="container py-5 ">
        <div class="row px-4">
            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/types') }}">Fess type</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 bg-white mx-auto p-3">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Fees type</h3>
                    <h3 class="mt-5 btn badge_status_act" style="font-size: 20px">Edit Type Data</h3>
                   
                    <a href="{{ url('/types') }}"><button class="p-3 btn-primary "><strong>See Type</strong></button></a>
                </div>
            </div>
            <div class="col-md-12 bg-white mx-auto p-3">
                <form action="" method="POST" id="updateType" type_id="{{ $type->id }}">
                    <fieldset>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="label_name">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control inputs" name="name" required minlength="3"
                                    value="{{ $type->name }}">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="label_name">Code<span class="text-danger">*</span></label>
                                <input type="text" class="form-control inputs" required minlength="3" name="code" value="{{ $type->code }}">
                                <span id="code_error" class="error"></span>
                            </div>

                            <div class="col-md-6  mt-3">
                                <label for="" class="label_name">Description<span class="text-danger">*</span></label>
                                <textarea name="description" required class="form-control" cols="20" rows="6">{{ $type->description }}</textarea>
                                <span id="description_error" class="error"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="" class="col-md-12 label_name">Status<span class="text-danger">*</span></label>
                                <select required class="col-md-12 form-control inputs" name="status">
                                    <option class="inputs" value="1" {{ $type->status== 1 ? 'selected' : '' }}>Active</option>
                                    <option class="inputs"  value="0" {{ $type->status== 0 ? 'selected' : '' }}>InActive</option>
                                </select>
                                <input type="submit" class="btn btn-success mt-3" value="Update">
                            </div>                        
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
@endsection
