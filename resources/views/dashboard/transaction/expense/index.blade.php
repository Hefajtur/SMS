@extends('dashboard.master')

@section('title')
    Index expense
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Expense</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">Expense</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Expense</label>
                        <a href="{{ route('expense.create') }}" class="text-white btn btn-primary p-3"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>

                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="expenseTable" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Expense Head</th>
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
            $('#expenseTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('expense.index') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'name', name: 'name' },
                    { data: 'ExpenseHead', name: 'ExpenseHead' },
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

        $('#expenseTable').on('click', '#expense_edit', function(e) {
            e.preventDefault();
         
            let id = $(this).attr("expense_id");
            window.location.href = url +  "/expense/" + id +"/edit";
        });

        //// Delete incomeAndexpenseData

        $('#expenseTable').on('click', '#expense_delete', function() {
            let id = $(this).attr("expense_id");

            let token = $("[name='_token']").val();

            var deleteConfirm = confirm("Are you sure to delete this record?");
            if (deleteConfirm == true) {
                $.ajax({
                    url: url + "/expense/" + id,
                    method: "DELETE",
                    data: {
                        _token: token
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.success == true) {
                            alert('Record Deleted?');
                            var oTable = $('#expenseTable').dataTable();
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
