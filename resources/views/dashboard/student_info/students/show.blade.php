@extends('dashboard.master')

@section('title')
    Create Student
@endsection

@section('body')
    {{-- <div class="container"> --}}
    <div class="container p-5 ">
        <div class="row">
            <div class="col-md-12 mt-5 bg-white mx-auto">
                <div class="row my-5 mx-2">

                    <div class="col-md-4">
                        <img class="img-fluid rounded-circle" src="{{ asset($students->image) }}" alt="" style="height: 65px" width="65px">
                        <span class="" style="font-size: 20px" >{{ $students->first_name }}
                            {{ $students->last_name }}</span>
                        <div class="row mt-5">
                            <h4>Profile</h4>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-flex justify-content-between">
                            <h1> Student Details</h1>
                            <a class="btn btn-primary btn-lg" href="{{ route('student.edit', ['id'=> $students->id ]) }}" type="button"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                        </div>
                        <div class="row mt-5">
                            <h4>Admission No</h4>
                            <span>{{ $students->admission_no }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Roll NO</h4>
                            <span>{{ $students->roll_no }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>First Name</h4>
                            <span>{{ $students->first_name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Last Name</h4>
                            <span>{{ $students->last_name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Mobile</h4>
                            <span>{{ $students->mobile }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Email</h4>
                            <span>{{ $students->email }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Class</h4>
                            <span>{{ $students->class->name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Section</h4>
                            <span>{{ $students->section->name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Shift</h4>
                            <span>{{ $students->shift->name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Date of Birth</h4>
                            <span>{{ $students->b_date }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Religion</h4>
                            <span>{{ $students->religions->name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Genders</h4>
                            <span>{{ $students->genders->name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Blood</h4>
                            <span>{{ $students->bloods->name }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Admission date</h4>
                            <span>{{ $students->admission_date }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Select parent</h4>
                            <span>{{ $students->parent }}</span>
                        </div>
                        <div class="row mt-5">
                            <h4>Status</h4>
                            <span>{{ $students->status ==1 ? 'Active' : 'Inactive' }}</span>
                        </div>
                        <div class="row mt-5">
                            <h3>Documents</h3>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
