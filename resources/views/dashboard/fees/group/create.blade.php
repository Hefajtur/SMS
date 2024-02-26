@extends('dashboard.master')

@section('title')
    Create Group
@endsection

@section('body')
    <div class="container py-5 ">
        <div class="row">
            <div class="col-md-11 mt-5  mx-5 py-3">
                <div class="row d-flex justify-content-between">
                    <h3 class="p-3">Home / Fees-Group / Create</h3>
                    <a href="{{ url('/groups') }}"><button class="p-3 btn-primary"><strong>See
                                Group</strong></button></a>
                </div>

                <form action="" method="POST" id="groupStore">
                    <fieldset>
                        @csrf
                        <div class="row p-5 bg-white d-flex">
                            <div class="col-md-6">
                                <label for="" class="label_name">Name </label>
                                <input required type="text" class="form-control inputs" name="name">
                                <span id="name_error" class="error"></span>
                            </div>


                            <div class="col-md-6">
                                <label for="" class="col-md-12 label_name">Status </label>
                                <select required class="inputs col-md-12 " name="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">InActive</option>
                                </select>
                                <span id="status_error" class="error"></span>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="" class="label_name">Description </label>
                                {{-- //id="summernote" --}}
                                <textarea name="description" required class="form-control" cols="30" rows="6"></textarea>
                                <span id="description_error" class="error"></span>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button class="btn btn-primary float-right" value="">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>


        {{-- add Group --}}

        <script>
            $(document).ready(function() {
    
                $('#groupStore').submit(function(e) {
                    e.preventDefault();
                     var isValid = true;
        $(".validate-input").each(function () {
            if ($(this).val() === '') {
                isValid = false;
                $(this).addClass("error");
            } else {
                $(this).removeClass("error");
            }
        });
        if (isValid) {
    
                    $.ajax({
                        url: "{{ route('groups.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response.success == true) {
                                alert('Add Successfully');
                                $('#groupStore')[0].reset();
                            }
                        },
                        error: function(data, textStatus, errorMessage) {
                            newdata = $.parseJSON(data.responseText)
                            for (const key in newdata.errors) {
                                errorContainer = $('#' + key + '_error');
                                errorContainer.text(newdata.errors[key][0]);
                            }
                        }
                    });
        }
                });
            });
        </script>
@endsection
