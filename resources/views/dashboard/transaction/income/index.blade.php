@extends('dashboard.master')

@section('title')
    Index income
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Income</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">Income</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Income</label>
                        <a href="{{ route('income.create') }}" class="text-white btn btn-primary p-3"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>

                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="incomeTable" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Income Head</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Invoice Number</th>
                                    <th scope="col">Amount ($)</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Document</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- // show incomeData --}}
    <script>
        $(document).ready(function () {
            $('#incomeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('income.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'IncomeHead', name: 'IncomeHead' },
                    { data: 'date', name: 'date' },
                    { data: 'invoice_num', name: 'invoice_num' },
                    { data: 'amount', name: 'amount' },
                    { data: 'description', name: 'description' }, 
                    { data: 'document', name: 'document' }, 
                    { data: 'action', name: 'action'}
                ]
            });
        });
    </script>
  
 
    
    <script>
        //edit incomeAndexpenseData

        $('#incomeTable').on('click', '#income_edit', function(e) {
            e.preventDefault();
         
            let id = $(this).attr("income_id");
            window.location.href = url + "/income/" + id +"/edit";
        });

        //// Delete incomeAndexpenseData

        $('#incomeTable').on('click', '#income_delete', function() {
            let id = $(this).attr("income_id");

            let token = $("[name='_token']").val();

            var deleteConfirm = confirm("Are you sure to delete this record?");
            if (deleteConfirm == true) {
                $.ajax({
                    url: url + "/income/" + id,
                    method: "DELETE",
                    data: {
                        _token: token
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Record Deleted?');
                            var oTable = $('#incomeTable').dataTable();
                            oTable.fnDraw(false);

                        } else {
                            alert("Invalid ID.");
                        }
                    },

                })
            }

        });
    </script>
@endsection
