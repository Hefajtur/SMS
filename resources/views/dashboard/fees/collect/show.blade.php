@extends('dashboard.master')

@section('title')
    Collect show
@endsection

@section('body')
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5  mx-auto py-3">
                <div class="row d-flex justify-content-between">
                    <h2>Fees Collect</h2>
                    <h5 class="p-3">Home / Fees Collect / Details</h5>
                </div>

                @foreach ($assigns as $assign)
                @endforeach

                <div class="row mt-5">

                    <div class="col-md-3">
                        <label class="fs-5">Admission NO</label>
                        <div>
                            <h5>{{ $assign->students->admission_no }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="fs-5">Class</label>
                        <div>
                            <h5>{{ $assign->students->class->name }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="fs-5">Roll NO</label>
                        <div>
                            <h5>{{ $assign->students->roll_no }}</h5>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="fs-5">Guardian name</label>
                        <div>
                            <h5>{{ $assign->students->guardians->guard_name }}</h5>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-3">
                    <label class="fs-5">Student name</label>
                    <div>
                        <h5>{{ $assign->students->first_name }} {{ $assign->students->last_name }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="fs-5">Section</label>
                    <div>
                        <h5>{{ $assign->students->section->name }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="fs-5">Date of Birth</label>
                    <div>
                        <h5>{{ $assign->students->b_date }}</h5>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="fs-5">Mobile number</label>
                    <div>
                        <h5>{{ $assign->students->mobile }}</h5>
                    </div>
                </div>
            </div>

            <div class=" d-flex justify-content-between mt-5">
                <h3>Fees Details</h3>
                <button type="button" class="btn btn-primary" id="collect-fees">+ Collect</button>
            </div>



            <div class="collectTable my-5">
                <table class="table border checkbox-group">
                    <thead>
                        <tr>
                            <th scope="col"> All
                                <input class="check-all" type="checkbox">
                            </th>
                            <th scope="col">Group</th>
                            <th scope="col">Type</th>
                            <th scope="col">Due date</th>
                            <th scope="col">Amount ($)</th>
                            <th scope="col">Status</th>
                            <th scope="col">Fine type</th>
                            <th scope="col">Percentage</th>
                            <th scope="col">Fine amount ($)</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($assigns as $assign)
                            <tr>
                                <td><input class="check-to-collect check" type="checkbox" value=""
                                        data-group="{{ $assign->masters->group_id }}"
                                        data-type="{{ $assign->masters->type_id }}"
                                        data-student="{{ $assign->students->id }}"
                                        data-master="{{ $assign->masters->id }}" data-assign="{{ $assign->id }}">
                                </td>


                                <td>{{ $assign->masters->groups->name }}</td>
                                <td>{{ $assign->masters->types->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($assign->masters->due_date)->format('d M Y') }}</td>
                                <td>{{ $assign->masters->amount }} <span class="text-danger"> +
                                        {{ $assign->masters->fine_amount }}</span></td>
                                <td>
                                    @if ($assign->status == 0)
                                        <span class="badge rounded-pill bg-danger">Unpaid</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Paid</span>
                                    @endif
                                </td>

                                <td>{{ $assign->masters->fine_type }}</td>
                                <td>{{ $assign->masters->percentage }}</td>
                                <td>{{ $assign->masters->fine_amount }}</td>
                                <td><button type="button" class="btn btn-danger" assignData="{{ $assign->id }}"
                                        id="revert"><i class="fa-solid fa-trash"></i> Revert
                                        Payment</button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>


    <!-- Modal -->

    <div class="modal fade" id="collectModal" tabindex="-1" aria-labelledby="collectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="collectModalLabel">Fees collect</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" enctype="multipart/form-data" method="post" id="visitForm">

                        @csrf
                        <div class="row">

                            <div class="col-md-6 ">
                                <label class="fs-5">Due date<span class="text-danger">*</span></label>
                                <input type="date" class="inputs form-control" name="due_date" id="" required>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label class="fs-5">Payment Method<span class="text-danger">*</span><label>
                                </div>
                                <div class="">
                                    <input class="mx-2" type="radio" id="" name="payment" checked=""
                                        value="1"> Cash
                                    <input class="mx-2" type="radio" id="" name="payment" value="2">
                                    Online
                                    payment
                                    <input class="mx-2" type="radio" id="" name="payment" value="3">
                                    Cheque
                                </div>
                            </div>
                        </div>

                        <table class="table border mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">Group</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Due date</th>
                                    <th scope="col">Amount ($)</th>
                                </tr>
                            </thead>
                            <tbody id="modalTableBody">

                            </tbody>
                            <tfoot>
                                {{-- //total --}}
                            </tfoot>
                        </table>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


    {{-- //show the data in modal and save the data and change the status --}}

    <script>
        function encodeAndSetDataAttributes() {
            $(".check").each(function() {
                var $checkbox = $(this);
                var data = {
                    group_id: $checkbox.data("group"),
                    type_id: $checkbox.data("type"),
                    student_id: $checkbox.data("student"),
                    master_id: $checkbox.data("master"),
                    assign_id: $checkbox.data("assign"),
                };
                var base64Data = btoa(JSON.stringify(data));
                $checkbox.val(base64Data);
            });
        }

        $(document).ready(function() {
            encodeAndSetDataAttributes();
        });

        $("#collect-fees").click(function() {
            var selectedData = [];
            var totalAmount = 0;

            $("#modalTableBody").empty();

            $(".check:checked").each(function() {
                var base64Data = $(this).val();
                var data = JSON.parse(atob(base64Data));
                selectedData.push(data);
            });

            if (selectedData.length === 0) {
                $('#collectModal').modal('show');
            } else {
                $.ajax({
                    url: url + "/data-show-modal", // Update this URL to match your route
                    method: "GET",
                    data: {
                        selectedData: selectedData
                    },
                    success: function(response) {
                        $('#collectModal').modal('show');
                        $("#modalTableBody").empty();

                        for (var i = 0; i < response.length; i++) {
                            for (var j = 0; j < response[i].length; j++) {
                                var data = response[i][j];

                                // Check if data.amount and data.fine_amount are valid numbers
                                if (!isNaN(data.amount) && !isNaN(data.fine_amount)) {
                                    var formattedDueDate = new Date(data.due_date).toLocaleDateString(
                                        'en-US', {
                                            day: 'numeric',
                                            month: 'short',
                                            year: 'numeric'
                                        });

                                    var tr = $("<tr></tr>");
                                    var td = $(
                                        "<td><input type='hidden' name='assign_id[]' value='" + data
                                        .assign_id +
                                        "'><input type='hidden' name='students_id' value='" + data
                                        .student_id +
                                        "'><input type='hidden' name='amounts[]' value='" + data
                                        .amount +
                                        "'><input type='hidden' name='fine_amounts[]' value='" +
                                        data.fine_amount + "'>" + data.group_name + "</td><td>" +
                                        data.type_name + "</td><td>" + formattedDueDate +
                                        "</td><td>" + data.amount + " + " + data.fine_amount +
                                        "</td>");

                                    tr.append(td);
                                    $("#modalTableBody").append(tr);

                                    totalAmount += parseFloat(data.amount) + parseFloat(data
                                        .fine_amount);
                                } else {
                                    console.error("Invalid data received:", data);
                                }
                            }
                        }

                        var trFoot = $("<tr></tr>");
                        var tdFoot = $(
                            "<td colspan='3' align='right'><strong>Total</strong></td><td id='totalAmount'>" +
                            totalAmount.toFixed(2) + "</td>");

                        trFoot.append(tdFoot);
                        $("#modalTableBody").append(trFoot);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + error);
                    }
                });
            }
        });

        // Handle form submission
        $('#visitForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: url + "/fee-collect-from-modal",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(data) {
                    if (data.success === true) {
                        $('#collectModal').modal('hide');

                        window.location.reload();
                    }
                },

            });
        });
    </script>



    {{-- //rever status --}}

    <script>
        $('.collectTable').on('click', '#revert', function() {

            let id = $(this).attr("assignData");

            $.ajax({
                url: url + "/revert-status/" + id,
                method: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {

                    if (response.success == true) {

                        alert('delete successfully')
                        window.location.reload();

                    }
                },

            })


        });
    </script>
@endsection
