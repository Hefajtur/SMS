@extends('dashboard.master')

@section('title')
    index type
@endsection

@section('body')

<div class="container p-5 ">
    <div class="row">    
        <div class="col-md-12 mt-5 mx-auto ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item" style="font-size: 20px"><a href="{{ url('/examtypes') }}">Exam type</a></li>
              
                </ol>
            </nav>
        </div>
        <div class="col-md-12 bg-white mx-auto py-3">

            <div class="row d-flex justify-content-between">
                <h3 class="p-3">Exam-Types</h3>
                <h3 class="mt-5 badge_status_act">All-Types Of Exam Data</h3>
                <a href="{{url('/examtypes/create')}}"><button class="btn btn-primary "><strong>+Add Exam-Types</strong></button></a>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-border"  id="examTypeData">            
                        <thead>
                            <th>Sr No</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(function () {
            var table = $('#examTypeData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('examtypes') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ]
            });
          });
  </script>
 
@endsection
