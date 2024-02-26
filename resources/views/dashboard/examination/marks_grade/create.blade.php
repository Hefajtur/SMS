@extends('dashboard.master')

@section('title')
    Create Types
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
            <form action="" method="POST" id="marksGradeStore">
                <fieldset>
                @csrf
                    <div class="row p-5 bg-white d-flex">
                        <div class="col-md-6">
                            <label for="" class="col-md-12 label_name"> Name <span class="text-danger">*</span></label>
                            <input type="text" required name="name" class="form-control col-md-12 inputs" placeholder="Enter Name">
                            <span id="name_error" class="error"></span>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="col-md-12 label_name">Point <span class="text-danger">*</span></label>
                           <input type="" class="col-md-12 form-control inputs" step="0.01" required  name="point"  placeholder="Enter Point">
                           <span id="point_error" class="error"></span>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="col-md-12 label_name">Percent Form <span class="text-danger">*</span></label>
                           <input type="number" class="col-md-12 form-control inputs" step="0.01" required  name="parcent_from"  placeholder="Enter Percent From">
                           <span id="parcent_from_error" class="error"></span>
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="" class="col-md-12 label_name">Percent Upto <span class="text-danger">*</span></label>
                           <input type="number" class="col-md-12 form-control inputs" step="0.01" required  name="parcent_upto"  placeholder="Enter Percent Upto">
                           <span id="parcent_upto_error" class="error"></span>
                        </div>
                       
                        <div class="col-md-6 mt-3">
                            <label for="" class="col-md-12 label_name">Reamrks <span class="text-danger">*</span></label>
                           <input type="Text" class="col-md-12 form-control inputs"  required name="remarks"  placeholder="Enter Reamrks">
                           <span id="remarks_error" class="error"></span>
                        </div>


                        <div class="col-md-6 mt-3 ">
                            <label for="" class="col-md-12 label_name">Status</label>
                            <select class="js-example-basic-single col-md-12 form-control inputs" required name="status">
                                <option class="form-control inputs" value="">select status</option>
                                <option class="form-control inputs" value="1">Active</option>
                                <option class="form-control inputs" value="0">InActive</option>
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

<script>
    $('#masterStore').validate();

    document.addEventListener('DOMContentLoaded', function() {
        var selectPercentage = document.getElementById('selectPercentage');
        var inputShow = document.getElementById('inputShow');
        var inputAmount = document.getElementById('inputAmount');
        selectPercentage.addEventListener('change', function() {
        if(selectPercentage.value ==='option1') {
            inputShow.style.display = 'none';
            inputAmount.style.display = 'none';
        }else if(selectPercentage.value ==='option2') {
            inputAmount.style.display = 'block';
            inputShow.style.display = 'none';
        }else {
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
