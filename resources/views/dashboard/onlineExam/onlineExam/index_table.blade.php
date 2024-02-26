<div class="table-responsive">
    <table class="table table-bordered" id="onlineExam_table">
        <thead>
            <tr>
                <th>SR No</th>
                <th>Class (Section)</th>
                <th>Subject</th>
                <th>Name</th>
                <th>Type</th>
                <th>Total Mark</th>
                <th>Exam Start</th>
                <th>Exam End</th>
                <th>Duration</th>
                <th>Exam Published</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($onlineExamData as $key => $data)

            <!-- {{ $data->online_exam_type }} -->
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    {{ $data->classes->name }} {{ '(' . $data->section->name . ')' }}
                    <input type="hidden" name="id" value="{{ $data->id }}">
                </td>
                <td>
                    {{ $data->subject->name }}
                </td>
                <td>
                    {{ $data->name }}
                </td>
                <td>
                    {{ $data->online_exam_type->name }}

                </td>
                <td>
                    {{ $data->total_mark }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($data->start)->format('d-m-Y h:i a') }}
                </td>
                <td>
                    {{ \Carbon\Carbon::parse($data->end)->format('d-m-Y h:i a') }}
                </td>
                <td>
                    @php
                    $start_time = \Carbon\Carbon::parse($data->start);
                    $end_time = \Carbon\Carbon::parse($data->end);

                    $hours_diff = $start_time->diffInHours($end_time);
                    $min_diff = $start_time->diffInMinutes($end_time);



                    if($hours_diff >= 24){

                    $totalDay = $start_time->diffInDays($end_time);
                    $remaining_hour = $hours_diff - $totalDay * 24;
                    $remaining_min;

                    echo $totalDay . ' Days' . ' ' . $remaining_hour . ' hours' . ' ';


                    }elseif($hours_diff < 24) { $totalHours=$start_time->diffInHours($end_time);

                        echo 0 . ' Days' . ' ' . $totalHours . ' hours' . ' ';

                        }

                        @endphp

                </td>
                <td>
                    {{ \Carbon\Carbon::parse($data->published)->format('d-m-Y h:i a') }}
                </td>
                <td>
                    @if($data->status == null)
                    <span class="badge_status_act">Active</span>
                    @endif
                </td>
                <td>

                    <!-- Download Question -->
                    <a href="{{ url('/pdf') }}/{{ $data->id }}" type="submit" class="edit btn btn-info btn-sm mb-2" ids="onDownload_btn" id=" {{ $data->id }}"><i class="fa-solid fa-download"></i>Question</a>


                    <!-- Edit -->
                    <button class="edit btn btn-success btn-sm mb-2 mr-2" edit_id="{{ $data->id }}" id="onlineExamEdit"><i class="fa-regular fa-pen-to-square"></i></button>


                    <!-- Delete -->
                    <a href="" class="edit btn btn-danger btn-sm mb-2" del_id="{{ $data->id }}" id="onlineExamDel"><i class="fa-solid fa-trash-can"></i></a>


                    <!-- View Question -->
                    <a href="javascript:void(0)" data-url="{{ url('/view-question') }}/{{ $data->id }}" class="edit btn btn-info btn-sm mb-2" data-toggle="modal" data-target="#viewQuestion" ids="onViewQst_btn" id="viewQst"><i class="fa-solid fa-eye"></i>View Questions</a>

                    <!-- View Question Modal -->
                    <div class="modal fade" id="viewQuestion_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Question List</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" id="cross_btn" style="font-weight: 400;width: 40px;height: 40px;background: #ddd;border-radius: 50%;display: flex;justify-content: center;align-items: center;">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped" id="viewQst_table">
                                        <thead>
                                            <tr id="" style="background: #f4f4f4;">
                                                <th style="background: #f4f4f4;border-radius: 12px 0px 2px!important;">SR NO.</th>
                                                <th>Question</th>
                                                <th style="background: #f4f4f4; border-radius: 0px 12px 0px 0px!important;">Mark</th>
                                            </tr>
                                        </thead>
                                        <tbody id="viewQst_tbody">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="modalCancelBtn">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->


                    <!-- View Student -->
                    <a href="javascript:void(0)" data-url="{{ url('/view-students') }}/{{ $data->id }}" data-toggle="modal" data-target="#viewStudent" class="edit btn btn-info btn-sm" ids="onViewStd_btn" id="viewStd"><i class="fa-solid fa-eye"></i>Students</a>


                    <!-- View Student Modal -->
                    <div class="modal fade" id="viewStudent_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content" style="width: auto;">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Student List</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" id="cross_btn" style="font-weight: 400;width: 40px;height: 40px;background: #ddd;border-radius: 50%;display: flex;justify-content: center;align-items: center;">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <table class="table table-striped" id="viewStd_table">
                                        <thead>
                                            <tr id="" style="background: #f4f4f4;">
                                                <th style="background: #f4f4f4;border-radius: 12px 0px 2px!important;">SR NO.</th>
                                                <th>Admission NO</th>
                                                <th>Student name</th>
                                                <th>Guardian name</th>
                                                <th>Mobile number</th>
                                                <th>Answer</th>
                                                <th style="background: #f4f4f4; border-radius: 0px 12px 0px 0px!important;">Result</th>
                                            </tr>
                                        </thead>
                                        <tbody id="viewStd_tbody">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" id="modalCancelBtn">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--  -->

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>