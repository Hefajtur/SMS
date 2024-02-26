@extends('dashboard.master')

@section('title')
    Index ExamRoutine
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Exam Routine</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">Exam Routine</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Exam Routine</label>
                        <a class="text-white btn btn-primary p-3" href="{{route('examRoutine.create')}}"><i
                                    class="fa fa-plus pe-1"></i>Add</a>
                    </div>

                    <div class="col-md-12 mt-1 mb-5 mx-auto bg-white">
                        <table class="table" id="examRoutineData" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No</th>
                                    <th scope="col">Class(Section)</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
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

 {{-- // show ClassRoutine with pagination Data --}}
 <script type="text/javascript">
    $(function() {
        var table = $('#examRoutineData').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('examRoutine.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'classAndSection',
                    name: 'classAndSection'
                },

                {
                    data: 'type',
                    name: 'type'
                },

                {
                    data: 'date',
                    name: 'date'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });
</script>


    {{-- //edit & delete --}}
    <script>
        $(document).ready(function() {

            //edit subjectAssign

            $('#examRoutineData').on('click', '#examRoutine_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let classid = $(this).attr("examRoutineclass_id");
                let sectionid = $(this).attr("examRoutinesection_id");
                window.location.href = url + "/examRoutine/" + classid + "/" + sectionid;
            });

            //// Delete subjectAssign

            $('#examRoutineData').on('click', '#examRoutine_delete', function() {
                let classid = $(this).attr("examRoutineclass_id");
                let sectionid = $(this).attr("examRoutinesection_id");
                // let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/examRoutineDelete/" + classid + "/" + sectionid,
                        method: "GET",
                        data:{
                            'classid': classid,
                            'sectionid': sectionid,
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#examRoutineData').dataTable();
                                oTable.fnDraw(false);

                            } else {
                                alert("Invalid ID.");
                            }
                        },

                    })
                }

            });
        });
    </script>
 
@endsection