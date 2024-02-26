@extends('dashboard.master')

@section('title')
    Edit Types
@endsection

@section('body')
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/masters') }}">Fess Masters</a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 ">
                <div class="row d-flex mx-auto justify-content-between">
                    <a href="{{ url('/masters') }}"><button class="p-1 btn btn-primary"><strong>See Master</strong></button></a>
                    <h3 class="mt-5 btn badge_status_act" style="font-size: 20px">Edit Master Data</h3>
                    <a href="{{ url('/masters/create') }}"><button class="p-1 btn btn-primary "><strong>+Add
                                Master</strong></button></a>
                </div>
            </div>
            <div class="col-md-12 mb-5">
                <form class="mx-auto" action="" method="POST" id="updateMaster" master_id="{{ $master->id }}">
                    <fieldset>
                        @csrf

                       
                        <div class="row mx-auto">
                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Fees Group Name</label>
                                <select class="col-md-12 form-control inputs" name="group_id">
                                    @foreach ($groups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ $master->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                    <span id="group_id_error" class="error"></span>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Fees Type</label>
                                <select class=" col-md-12 form-control inputs" name="type_id">
                                    @foreach ($types as $type)
                                        <option  value="{{ $type->id }}"
                                            {{ $type->id == $master->type_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <span id="type_id_error" class="error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Due Date</label>
                                <input type="date" required class="form-control inputs" name="due_date"
                                    value="{{ $master->due_date }}">

                                <span id="due_date_error" class="error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Amount</label>
                                <input type="number" name="amount" id="amount" required class="form-control inputs"
                                    value="{{ $master->amount }}">
                                <span id="amount_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label for="" class="col-md-12 label_name">Fine type</label>
                                <select class="col-md-12 form-control inputs" id="selectPercentage" required name="fine_type">
                                    <option class="form-control" value="option2" {{ $master->fine_type == 'option2' ? 'selected' : '' }}>Fix Amount 2</option>
                                    <option class="form-control" value="option3" {{ $master->fine_type == 'option3' ? 'selected' : '' }}>Percentage</option>
                                </select>
                                <span id="fine_type_error" class="error"></span>
                            </div>

                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name ">Status</label>
                                <select class="col-md-12 form-control inputs" name="status">
                                    <option class="form-control" {{ $master->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option class="form-control" {{ $master->status== 0 ? 'selected' : '' }} value="0">InActive</option>
                                </select>
                            </div>

                            <div class="col-md-6 " id="inputShow" style="display: none;">
                                <label id="inputShow" for="inputField" class="label_name">percentage</label>
                                <input type="text" id="percentage" min="0" value="{{ $master->percentage }}"
                                    name="percentage" class="col-md-12 form-control inputs">

                            </div>
                            <div class="col-md-6" id="inputAmount" style="display: none;">
                                <label for="inputField" class="label_name">Fine Amount</label>
                                <input type="text" id="fineAmount" min="0" value="{{ $master->fine_amount }}"
                                    name="fine_amount" class="col-md-12 form-control inputs">


                            </div>

                            <div class="col-md-12 mt-2 mx-auto">
                                <input type="submit" class="btn btn-success" value="Update Master">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#updateMaster').validate();

        document.addEventListener('DOMContentLoaded', function() {
            var selectPercentage = document.getElementById('selectPercentage');
            var inputShow = document.getElementById('inputShow');
            var inputAmount = document.getElementById('inputAmount');
            selectPercentage.addEventListener('change', function() {
                if (selectPercentage.value === 'option1') {
                    inputShow.style.display = 'none';
                    inputAmount.style.display = 'none';
                } else if (selectPercentage.value === 'option2') {
                    inputAmount.style.display = 'block';
                    inputShow.style.display = 'none';
                } else {
                    inputShow.style.display = 'block';
                    inputAmount.style.display = 'block';
                }
            });
        });

        $(document).ready(function() {
            $('#amount, #percentage').on('input', function() {
                var amount = parseFloat($('#amount').val());
                var percentage = parseFloat($('#percentage').val());
                var fineAmount = amount * (percentage / 100);

                $('#fineAmount').val(fineAmount.toFixed(2));
            });
        });
    </script>
@endsection
