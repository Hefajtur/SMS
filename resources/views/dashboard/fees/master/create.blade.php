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
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/masters') }}">Fess Masters</a>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 mx-auto ">
                <div class="row d-flex justify-content-between">
                    <h3>Fees Master</h3>
                    <h3 class="mt-5 btn badge_status_act" style="font-size: 20px">Edit Type Data</h3>

                    <a href="{{ url('/masters') }}"><button class="p-3 btn-primary"><strong>See Master</strong></button></a>
                </div>
            </div>
            <div class="col-md-12">
                <form action="" method="POST" id="masterStore">
                    <fieldset>
                        @csrf
                        <div class="row p-5 bg-white d-flex">
                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Fees Group Name</label>
                                <select required class="col-md-12 form-control" name="group_id">
                                    <option class="form-control inputs" value="">--Select Fees Group--</option>
                                    @foreach ($groups as $group)
                                        <option class="form-control inputs" value="{{ $group->id }}">{{ $group->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <span id="group_id_error" class="error"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Fees Type</label>
                                <select required class="col-md-12 form-control"  name="type_id">
                                    <option class="form-control" value="">--Select fees type--</option>
                                    @foreach ($types as $type)
                                        <option class="form-control inputs" value="{{ $type->id }}">{{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <span id="type_id_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="" class="label_name">Due Date</label>
                                <input type="date" required class="form-control inputs"  name="due_date">

                                <span id="due_date_error" class="error"></span>
                            </div>


                            <div class="col-md-6 mt-3">
                                <label for="" class="label_name">Amount</label>
                                <input type="number" required name="amount" id="amount"  minlength="2"
                                    class="form-control inputs">
                                <span id="amount_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="" class="col-md-12 label_name ">Fine type</label>
                                <select class=" col-md-12 form-control inputs" id="selectPercentage" name="fine_type" required>
                                    <option class="form-control inputs" value="option1">select a fine type</option>
                                    <option class="form-control inputs" value="option2">Fix Amount</option>
                                    <option class="form-control inputs" value="option3">Percentage</option>
                                </select>

                                <span id="fine_type_error" class="error"></span>
                            </div>
                            <div class="col-md-6 mt-3 ">
                                <label for="" class="col-md-12 label_name">Status</label>
                                <select required class="js-example-basic-single col-md-12 form-control inputs" name="status">
                                    <option class="form-control inputs" value="">select status</option>
                                    <option class="form-control inputs" value="1">Active</option>
                                    <option class="form-control inputs" value="0">InActive</option>
                                </select>

                                <span id="status_error" class="error"></span>
                            </div>

                            <div class="col-md-6 mt-3" id="inputShow" style="display: none;">
                                <label id="inputShow" for="inputField" class="label_name">percentage</label>
                                <input type="text" id="percentage" min="0" required name="percentage"
                                    class="col-md-12 form-control inputs">
                            </div>

                            <div class="col-md-6 mt-3" id="inputAmount" style="display: none;">
                                <label for="inputField" class="label_name">Fine Amount</label>
                                <input type="number" id="fineAmount" required name="fine_amount" class="inputs col-md-12 form-control">

                                <span id="fine_amount_error" class="error"></span>
                            </div>

                            <div class="col-md-12 mt-3">
                                <input type="submit" class="btn btn-primary mx-auto" value="Add Type">
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#masterStore').validate();

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
                $('#fineAmount').val(fineAmount.toFixed(2)); // Display fine amount with 2 decimal places
            });
        });
    </script>
@endsection
