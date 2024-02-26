@extends('dashboard.master')

@section('title')
    index type
@endsection

@section('body')
    <div class="container p-4 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/types') }}">Fess type</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/types/create') }}">Add Fess
                                type</a></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12 bg-white mx-auto py-3">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Fees type</h3>
                    <h3  class="mt-5 btn badge_status_act" style="font-size: 20px"> See All Data of Types</h3>
                    <a href="{{ url('/types/create') }}"><button class="p-3 btn-primary "><strong>+Add
                                Type</strong></button></a>
                </div>
            </div>

            <div class="col-md-12  bg-white mx-auto ">
                <table class="table table-border" id="typeData" >
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@csrf
  
<script type="text/javascript">

    $(function () {
            var table = $('#typeData').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ url('types') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
          });
  </script>
@endsection
