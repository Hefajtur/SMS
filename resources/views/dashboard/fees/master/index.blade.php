@extends('dashboard.master')

@section('title')
    index masters
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
            <div class="col-md-12 mx-auto bg-white">
                <div class="row ">
                    <div class="col-md-12 d-flex justify-content-between">
                        <h3 class="p-3">Fees masters</h3>
                    
                        <h3 class="mt-5 btn badge_status_act" style="font-size: 20px">All-Master-Data-Info</h3> 
    
                        <a href="{{ url('/masters/create') }}"><button class="p-3 btn-primary "><strong>+Add Master</strong></button></a>
                   
                    </div>
                </div>
                <div class="row ">
                   <div class="col-md-12 mx-auto">
                    <table class="table table-border" id="masterData">
                        <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Group</th>
                                <th>Type</th>
                                <th>Due-Date</th>
                                <th>Amount</th>
                                <th>fine-type</th>
                                <th>percentage</th>
                                <th>fine-amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
@csrf

    <script type="text/javascript">
        $(function() {
            var table = $('#masterData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('masters') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'groups.name',
                        name: 'groups.name'
                    },
                    {
                        data: 'types.name',
                        name: 'types.name'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'fine_type',
                        name: 'fine_type'
                    },
                    {
                        data: 'percentage',
                        name: 'percentage'
                    },
                    {
                        data: 'fine_amount',
                        name: 'fine_amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endsection
