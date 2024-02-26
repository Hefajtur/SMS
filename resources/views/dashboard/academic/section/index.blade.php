@extends('dashboard.master')

@section('title')
    Index Section
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5 mx-5 py-3">
                <div class="row  bg-white">
                    <div class="">
                        <h4 class="bradecrumb-title mb-1 px-2 mt-2">Section</h4>
                        <ol class="breadcrumb  bg-white">
                            <li class="breadcrumb-item"><a href="">Home</a></li>
                            <li class="breadcrumb-item">section</li>
                        </ol>
                    </div>
                </div>

                <div class="row  bg-white mt-3">
                    <div class="col-12 mb-3 d-flex justify-content-between mt-3">
                        <label class="" style="font-size: 30px">Section</label>
                        <a href="{{ route('section.create') }}" class="text-white btn btn-primary p-3"><i
                                class="fa fa-plus pe-1"></i>Add</a>
                    </div>

                    <div class="col-md-11 mt-1 mb-5 mx-auto">
                        <table class="table" id="sectionData" style="border: 0">
                            <thead>
                                <tr>
                                    <th scope="col">SR No.</th>
                                    <th scope="col">Class</th>
                                    <th scope="col">Section</th>
                                    <th scope="col">Status</th>
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

    {{-- // show Section Data --}}

    <script type="text/javascript">
        $(function() {
            var table = $('#sectionData').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('section.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'class.name',
                        name: 'class.name'
                    },

                    {
                        data: 'name',
                        name: 'name'
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


    <script>
        $(document).ready(function() {

            //edit Section

            $('#sectionData').on('click', '#section_edit', function(e) {
                e.preventDefault();
                // alert('hi');
                let id = $(this).attr("section_id");
                window.location.href = url + "/section/" + id + "/edit";
            });

            //// Delete Section

            $('#sectionData').on('click', '#section_delete', function() {
                let id = $(this).attr("section_id");

                let token = $("[name='_token']").val();

                var deleteConfirm = confirm("Are you sure to delete this record?");
                if (deleteConfirm == true) {
                    $.ajax({
                        url: url + "/section/" + id,
                        method: "DELETE",
                        data: {
                            _token: token
                        },
                        dataType: "json",
                        success: function(response) {

                            if (response.success == true) {
                                alert('Record Deleted?');
                                var oTable = $('#sectionData').dataTable();
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
