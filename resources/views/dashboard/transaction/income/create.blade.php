@extends('dashboard.master')

@section('title')
    Create income
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 bg-white mx-5 py-3">
                <div class="">
                    <h3 class="bradecrumb-title mb-1 px-2 mt-2">Create Income</h3>
                    <ol class="breadcrumb  bg-white">
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 15px">income
                        </li>
                        <li class="breadcrumb-item" style="font-size: 15px"><a href="">Add New</a></li>
                    </ol>
                </div>
                <form action="" method="POST" id="income_insert" enctype="multipart/form-data">
                    <fieldset>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <label class="label_name">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control inputs" placeholder="Enter name" name="name"
                                    id="name" required>
                                    {{-- //hidden id pass --}}
                                    <input type="hidden" value="" name="id">
                                <span id="name_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Income Head<span class="text-danger">*</span></label><br>
                                <select name="income_expenses_id" class="form-control inputs js-example-basic-single" required>
                                    @foreach ($IncomeExpenses as $IncomeExpense)
                                        <option value="{{ $IncomeExpense->id }}">
                                            {{ $IncomeExpense->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="income_expenses_id_error" class="error"></span>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 ">
                                <label class="label_name">Date <span class="text-danger">*</span></label><br>
                                <input type="date" name="date" class="form-control inputs" required>
                                <span id="date_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Invoice Number <span class="text-danger">*</span></label><br>
                                <input type="number" name="invoice_num" class="form-control inputs"
                                    placeholder="Enter invoice number" required>
                                <span id="invoice_num_error" class="error"></span>
                            </div>

                        </div>

                        <div class="row mt-3">

                            <div class="col-md-6 ">
                                <label class="label_name">Amount ($) <span class="text-danger">*</span></label><br>
                                <input type="number" name="amount" class="form-control inputs" placeholder="Enter amount" required>
                                <span id="amount_error" class="error"></span>
                            </div>

                            <div class="col-md-6 ">
                                <label class="label_name">Document <span class="text-danger">*</span></label>
                                <input type="file" name="document" class="form-control inputs" required>
                                <span id="document_error" class="error"></span>
                            </div>


                        </div>

                        <div class="row mt-3">

                            <div class="col-md-12 ">
                                <label class="label_name">Description<span class="text-danger">*</span></label><br>
                                <textarea name="description" id="" class="form-control inputs" style="width: 100%" rows="4"
                                    placeholder="Enter description" required></textarea>
                                <span id="description_error" class="error"></span>
                            </div>
                        </div>


                        <div class="col-12 d-flex justify-content-end mt-2">
                            <button type="submit" class="btn btn-primary btn-lg"><i class="fa-solid fa-save px-1"></i>
                                Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


    {{-- add income_insert --}}
    <script>
        $(document).ready(function() {
                    $('#income_insert').submit(function(e) {
                        e.preventDefault();

                        var isValid = true;
        $(".validate-input").each(function () {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass("error");
            } else {
                $(this).removeClass("error");
            }
        });
        if (isValid) {

                        x = new FormData(document.getElementById("income_insert"));
                        $.ajax({
                            url: "{{ route('income.store') }}",
                            method: "POST",
                            data: x,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            success: function(response) {
                                if (response.success == true) {

                                    alert('Add Successfully');
                                    $('#income_insert')[0].reset();
                                }
                            },
                            error: function(data, textStatus, errorMessage) {
                                newdata = $.parseJSON(data.responseText)
                                for (const key in newdata.errors) {
                                    errorContainer = $('#' + key + '_error');
                                    errorContainer.text(newdata.errors[key][0]);
                                }
                            }
                        });
        }
                    });

        });
    </script>
@endsection
