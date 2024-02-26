@extends('dashboard.master')

@section('title')
    Settings
@endsection


@section('body')
    <div class="container py-5 mt-5 ">
        <div class="row">

            <div class="col-md-12  ">
                <h3 class="bg-light py-2">Examination Settings</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/passMark') }}">Examination
                                Settings</a></li>

                    </ol>
                </nav>
                <div class="row">
                    <div class=" col-md-12 bg-white d-flex justify-content-between">
                        <h3 class="p-3 mx-auto">Examination Settings</h3>
                    </div>
                </div>

                <form action="" method="POST" id="passMarkStore">
                    <fieldset>
                        @csrf
                        <div class="row p-5 bg-white">
                            <div class="col-md-11">
                                <label for="" class="col-md-11">Average Pass marks(Percentage) <span
                                        class="text-danger">*</span></label>
                                <input required type="number" required class="col-md-11 form-control" name="avg_pass"
                                    placeholder="{{$avg_pass->avg_pass}}">
                                <input type="hidden" name="id" value="{{$avg_pass->id}}">
                                <span id="avg_pass_error" class="error"></span>
                            </div>
                            <div class="col-md-11 mt-2">
                                <label for="" class="col-md-10"></label>
                                <input type="submit" class="btn btn-primary" value="Update">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#passMark').validate();
    </script>
@endsection
