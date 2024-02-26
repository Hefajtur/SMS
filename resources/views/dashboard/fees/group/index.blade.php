@extends('dashboard.master')

@section('title')
    index Group
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 mx-auto ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/groups/index') }}">Fess Group</a></li>
                    </ol>
                </nav>
            </div>

            <div class="col-md-12 bg-white mx-auto py-3">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Fees Group</h3>
                    <a href="{{ url('/groups/create') }}"><button class="p-1 btn btn-primary "><strong>+ Add Group</strong></button></a>
                </div>

            </div>
            <div class="col-md-12 bg-white mx-auto py-3">
                <table class="table table-border " id="groupData">
                    <thead>
                        <tr>
                            <th>Sr No</th>
                            <th>Name</th>
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
        $(function() {
            var table = $('#groupData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('groups') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
