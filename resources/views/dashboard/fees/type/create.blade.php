@extends('dashboard.master')

@section('title')
    Create Types
@endsection

@section('body')
    <div class="container p-4 ">
        <div class="row">

            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/types') }}">Fess type</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 bg-white mx-auto p-3 ">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Fees type</h3>
                    <h3 class="mt-5 btn badge_status_act" style="font-size: 20px">Add New Type</h3>
                    <a href="{{ url('/types') }}"><button class="p-3 btn-primary "><strong>See Type</strong></button></a>
                </div>
            </div>
            <div class="col-md-12 bg-white mx-auto p-3 mb-5" >
                <form action="" method="POST" id="typeStore">
                    <fieldset>
                        @csrf
                        <div class="row  bg-white ">
                            <div class="col-md-6">
                                <label for="" class="label_name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control inputs" required minlength="3" name="name">
                                <span id="name_error" class="error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="label_name">Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control inputs" required minlength="2" name="code">
                                <span id="code_error" class="error"></span>

                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="" class="label_name">Description <span
                                        class="text-danger">*</span></label>
                                {{-- id="summernote" --}}
                                <textarea name="description" required minlength="11" class="form-control" cols="20" rows="5"></textarea>
                                <span id="description_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="" class="col-md-12 label_name">Status <span
                                        class="text-danger">*</span></label>
                                <select required class="col-md-12 form-control inputs" name="status">
                                    <option class="form-control " value="">Select Satus</option>
                                    <option class="form-control " value="1">Active</option>
                                    <option class="form-control " value="0">InActive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                           
                                <input type="submit" class="btn btn-success mt-3" value="Add-Type">
                           
                            </div>

                            <div class="col-md-12">
                                </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
    <script>
        $('#typeStore').validate();
    </script>
@endsection
