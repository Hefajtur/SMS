$('document').ready(function () {

    //edit group
    $('#groupData').on('click', '#group_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("group_id");
        // alert(id);
        window.location.href = url + "/groups/" + id + "/edit";
    });

    //Update Group Data
    $('#updateGroup').submit(function (e) {
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
            let id = $(this).attr("group_id");
            $.ajax({
                url: url + "/groups/" + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {

                    if (response.success == true) {
                        alert('Update Successfully');
                        window.location.href = url + '/groups';
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });

    //delete data
    $('#groupData').on('click', '#group_delete', function () {
        let id = $(this).attr("group_id");
        let token = $("[name='_token']").val();
        var deleteConfirm = confirm("Are you sure to delete this record?");
        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/groups/" + id,
                method: "DELETE",
                data: {
                    _token: token
                },
                dataType: "json",
                success: function (response) {
                    if (response.success == true) {
                        alert('Record Deleted?');
                        var oTable = $('#groupData').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        alert("Invalid ID.");
                    }
                },

            })
        }
    });

    // ========================
    //typeStore Insert
    $('#typeStore').submit(function (e) {
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
                url: url + '/types',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert("Type Added Successfully");
                        $('#typeStore')[0].reset();
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });


    //Edit Type
    $('#typeData').on('click', '#type_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("type_id");
        window.location.href = url + "/types/" + id + "/edit";
    });

    //Update Type Data
    $('#updateType').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr("type_id");
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
                url: url + "/types/" + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {

                    if (response.success == true) {
                        alert('Update Successfully');
                        window.location.href = url + '/types';
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });


    //delete Type data
    $('#typeData').on('click', '#type_delete', function () {
        let id = $(this).attr("type_id");
        let token = $("[name='_token']").val();
        var deleteConfirm = confirm("Are you sure to delete this record?");
        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/types/" + id,
                method: "DELETE",
                data: {
                    _token: token
                },
                dataType: "json",
                success: function (response) {
                    if (response.success == true) {
                        alert('Record Deleted?');
                        var oTable = $('#typeData').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        alert("Invalid ID.");
                    }
                },
            })
        }
    });


    // ======================
    // Master insert
    $('#masterStore').submit(function (e) {
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
                url: url + '/masters',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    let html = '';
                    if (data.success == true) {
                        alert('Master Added Successfully');
                        $('#masterStore')[0].reset();
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });


    //Edit Master
    $('#masterData').on('click', '#master_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("master_id");
        window.location.href = url + "/masters/" + id + "/edit";
    });

    //Update Master Data
    $('#updateMaster').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr("master_id");
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
                url: url + "/masters/" + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {

                    if (response.success == true) {
                        alert('Update Successfully');
                        window.location.href = url + '/masters';
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });

    //delete Master data
    $('#masterData').on('click', '#master_delete', function () {
        let id = $(this).attr("master_id");

        let token = $("[name='_token']").val();

        var deleteConfirm = confirm("Are you sure to delete this record?");
        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/masters/" + id,
                method: "DELETE",
                data: {
                    _token: token
                },
                dataType: "json",
                success: function (response) {

                    if (response.success == true) {
                        alert('Record Deleted?');
                        var oTable = $('#masterData').dataTable();
                        oTable.fnDraw(false);

                    } else {
                        alert("Invalid ID.");
                    }
                },

            })
        }
    });



    //=======Assign Functionality
    // Assign insert
    $('#assignStore').submit(function (e) {
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
                url: url + '/assigns',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    // console.log(data);
                    if (data.success == true) {
                        alert('assign Added Successfully');
                        $('#assignStore')[0].reset();
                    }
                    else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                },
            });
        }
    });


    //Edit Assign
    $('#assignData').on('click', '#assign_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("assign_id");
        window.location.href = url + "/assigns/" + id + "/edit";
    });

    //Update Assign Data
    $('#updateAssign').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr("assign_id");
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
                url: url + "/assigns/" + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (response) {
                    if (response.success == true) {
                        alert('Update Successfully');
                        window.location.href = url + '/assigns';
                    }
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });


    //delete Assign data
    $('#assignData').on('click', '#assign_delete', function () {
        let id = $(this).attr("assign_id");

        let token = $("[name='_token']").val();

        var deleteConfirm = confirm("Are you sure to delete this record?");
        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/assigns/" + id,
                method: "DELETE",
                data: {
                    _token: token
                },
                dataType: "json",
                success: function (response) {

                    if (response.success == true) {
                        alert('Record Deleted?');
                        var oTable = $('#assignData').dataTable();
                        oTable.fnDraw(false);

                    } else {
                        alert("Invalid ID.");
                    }
                },

            })
        }

    });


    //to catch the section by class selection
    $(document).on('change', '#classSelect', function () {
        var classId = $(this).val();
        section(classId);
    })

    function section(classId) {
        $.ajax({
            url: url + "/get-section-by-classId/" + classId,
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                var option = '';
                option += '<option value="" selected disabled>Select Section</option>';
                for (const key in data) {
                    option += "<option class='' value=" + data[key]['id'] + ">" + data[key]['name'] + '</option>';
                };
                $('#sectionSelect').empty().append(option);
            },
        })
    }


    // to catch the Fees by Groupselection
    $(document).on('change', '#groupSelection', function () {
        var groupId = $(this).val();

        $('#typeOfFees').empty();
        $.ajax({
            url: url + "/get-master-by-groupId/" + groupId,
            method: "GET",
            dataType: "JSON",
            success: function (data) {

                for (i = 0; i < data.length; i++) {
                    var tr = $("<tr></tr>");
                    var td = $("<td><input class='' type='checkbox' name='master_id[]' value='" + data[i].id + "'></td><td>" + data[i].types.name + "</td><td>" + data[i].amount + "</td>");

                    tr.append(td);
                    $('#typeOfFees').append(tr);
                };
            },
        })
    })


    // to catch the student by class,section,gender,category selection
    $("#classSelect, #sectionSelect, #genderSelect, #selectedCategory").on("change", function () {

        var selectedClass = $("#classSelect").val();
        var selectedSection = $("#sectionSelect").val();
        var selectedGender = $("#genderSelect").val();
        var selectedCategory = $("#selectedCategory").val();
        if (selectedSection != null && selectedCategory != null) {
            $.ajax({
                url: url + "/get-student-by-class-section-gender",
                method: "GET",
                dataType: "JSON",
                data: {
                    class: selectedClass,
                    section: selectedSection,
                    gender: selectedGender,
                    category: selectedCategory
                },
                success: function (data) {
                    $('#studentDataForAssign').empty();
                    for (i = 0; i <= data.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $("<td><input class='' type='checkbox' name='students_id[]' value='" + data[i].id + "'></td><td>" + data[i].admission_no + "</td><td>" + data[i].first_name + "(" + data[i].last_name + ") </td><td>" + data[i].class.name + "(" + data[i].section.name + ") </td><td>" + data[i].parent + "</td><td>" + data[i].mobile + "</td>");

                        tr.append(td);
                        $('#studentDataForAssign').append(tr);
                    }
                },
            });
        }
    });

    //student id selection
    $(".check-all").click(function () {
        var parentDiv = $(this).closest(".checkbox-group");
        parentDiv.find("input[type=checkbox]").prop("checked", $(this).prop("checked"));
    });
    $("input[type=checkbox]").not(".check-all").click(function () {
        var parentDiv = $(this).closest(".checkbox-group");

        if (!parentDiv.find("input[type=checkbox]").not(".check-all").prop("checked")) {
            parentDiv.find(".check-all").prop("checked", false);
        }
    });






    //Fees Collect by search
    // to catch the student by class,section,gender,category selection

    $("#classSelect, #sectionSelect, #genderSelect, #selectedCategory").on("change", function () {
        var selectedClass = $("#classSelect").val();
        var selectedSection = $("#sectionSelect").val();
        var selectedAdmission = $("#admissionSelect").val();
        var search = $("#search").val();
        $("#searchResults").html('');
        if (selectedAdmission != null && search != null) {
            $.ajax({
                url: url + "/collectSearch",
                method: "GET",
                dataType: "JSON",
                data: { selectedClass, selectedSection, selectedAdmission, search },
                success: function (response) {
                    output = [];
                    x = response.success;
                    for (i = 0; i < x.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $("<td>" + [i + 1] + "</td><td>" + x[i].first_name + "<br>" + x[i].last_name + "</td><td>" + x[i].admission_no + "</td><td>" + x[i].class.name + "(" + x[i].section.name + ")</td><td>" + x[i].parent + "</td><td>" + x[i].mobile + "</td><td><button id='master_edit' master_id=" + x[i].id + "><i class='fa-solid fa-pen-to-square'></i></button> <button id='master_delete'  master_id=" + x[i].id + "><i class='fa-solid fa-trash'></i></button> </td>>");
                        tr.append(td);
                        $("#searchResults").append(tr);
                    }
                },
            });
        }
    });

    $('#searchCollect').submit(function (e) {
        e.preventDefault();
        $("#collectResults").html('');
        $.ajax({
            url: url + '/collectSearch',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {
                x = response.success;
                for (i = 0; i < x.length; i++) {

                    var tr = $("<tr></tr>");
                    var td = $("<td>" + [i + 1] + "</td><td>" + x[i].first_name + "<br>" + x[i].last_name + "</td><td>" + x[i].admission_no + "</td><td>" + x[i].class.name + '(' + x[i].section.name + ") </td><td>" + x[i].parent + "</td><td>" + x[i].mobile + "</td><td><button id='master_edit' master_id=" + x[i].id + "><i class='fa-solid fa-pen-to-square'></i></button> <button id='master_delete'  master_id=" + x[i].id + "><i class='fa-solid fa-trash'></i></button> </td>>");

                    tr.append(td);
                    $("#collectResults").append(tr);
                }
            },
        });
    });


    //exam type 
    //exam type Insert

    $('#examTypeStore').submit(function (e) {
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
                url: url + '/examtypes',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert("Exam Type Added Successfully");
                        $('#examTypeStore')[0].reset();
                    }
                    else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                },
            });
        }
    });

    //edit exam type
    $('#examTypeData').on('click', '#exam_type_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("exam_type_id");
        window.location.href = url + "/examtypes/" + id + "/edit";
    });

    //Update Type Data
    $('#updateExamType').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr("exam_type_id");
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
                url: url + "/examtypes/" + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert("Exam Type Updated Successfully");
                        window.location.href = "/examtypes";
                    }
                    else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                },
            });
        }
    });


    //delete ExAM Type data
    $('#examTypeData').on('click', '#exam_type_delete', function () {
        let id = $(this).attr("exam_type_id");

        let token = $("[name='_token']").val();

        var deleteConfirm = confirm("Are you sure to delete this record?");
        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/examtypes/" + id,
                method: "DELETE",
                data: {
                    _token: token
                },
                dataType: "json",
                success: function (response) {

                    if (response.success == true) {
                        alert('Record Deleted?');
                        var oTable = $('#examTypeData').dataTable();
                        oTable.fnDraw(false);

                    } else {
                        alert("Invalid ID.");
                    }
                },

            })
        }
    });


    //Marks Grade 
    // Marks Grade Insert
    $('#marksGradeStore').submit(function (e) {
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
                url: url + '/markgrades',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert("Marks Grade Added Successfully");
                        $('#marksGradeStore')[0].reset();
                    }
                    else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                },
            });
        }
    });

    //edit  Marks Grade
    $('#marksGradeData').on('click', '#marks_grade_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("marks_grade_id");
        window.location.href = url + "/markgrades/" + id + "/edit";
    });

    //Update  Marks Grade Data
    $('#marksGradeUpdate').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr("marks_grade_id");
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
                url: url + "/markgrade/update/" + id,
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert("Exam Type Updated Successfully");
                        window.location.href = url + "/markgrades";
                    }
                    else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                },
            });
        }
    });


    //delete Marks Grade data
    $('#marksGradeData').on('click', '#marks_grade_delete', function () {
        let id = $(this).attr("marks_grade_id");
        var confirmDelete = confirm('Are you sure you want to delete this?');
        if (confirmDelete) {
            $.ajax({
                url: url + "/markgrade/destroy/" + id,
                method: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert('This Exam Type deleted Successfully');
                        window.location.href = url + "/markgrades";
                    }
                    else {
                        alert("This Groupcan't deleted");
                    }
                },
            })
        }
    });


    //Examination Exam Assign

    // Find Exam Assign Data
    $('#examAssignSearch').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: url + '/examAssignSearch',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response) {

                $("#examAssignResult").html('');
                x = response.success;

                for (i = 0; i < x.length; i++) {
                    var tr = $("<tr></tr>");
                    var td = $("<td>" + [i + 1] + "</td><td>" + x[i].exam.name + "</td><td>" + x[i].class.name + '(' + x[i].section.name + ")</td><td>" + x[i].subject.name + "</td><td>" + x[i].title + "</td><td>" + x[i].marks + "</td><td><button id='exxamAssign_edit' exxamAssign_id=" + x[i].id + "><i class='fa-solid fa-pen-to-square'></i></button> <button id='exxamAssign_delete'  exxamAssign_id=" + x[i].id + "><i class='fa-solid fa-trash'></i></button> </td>>");
                    tr.append(td);
                    $("#examAssignResult").append(tr);
                }
            },
        });
    });

    //to catch the section by class selection
    // $(document).on('change', '#classExam', function () {
    //     var classId = $(this).val();
    //     $.ajax({
    //         url: url + "/get-section-by-classId/" + classId,
    //         method: "GET",
    //         dataType: "JSON",
    //         success: function (data) {
    //             var option = '';
    //             for (i = 0; i < data.length; i++) {
    //                 option += "<input class='mx-2 ' type='checkbox' name='section_id[]' value=" + data[i]['id'] + ">" + data[i]['name'];
    //             };
    //             $('#sectionExam').empty().append(option);
    //         },
    //     })
    // })

    // Exam Assign Insert
    $('#examAssignStore').submit(function (e) {
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
                url: url + '/examassigns',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    alert("Exam Assign Added Successfully");
                    $('#examAssignStore')[0].reset();
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            })
        };
    });

    //edit EXAM ASSIGN  
    $('#examAssignResult').on('click', '#exxamAssign_edit', function (e) {
        e.preventDefault();
        let id = $(this).attr("exxamAssign_id");

        window.location.href = url + "/examassigns/" + id + "/edit";
    });
    //delete EXAM ASSIGN
    $('#examAssignResult').on('click', '#exxamAssign_delete', function (e) {
        e.preventDefault();
        let id = $(this).attr("exxamAssign_id");
        let exam_id = $("[name='exam_id']").val();
        let subject_id = $("[name='subject_id']").val();
        let section_id = $("[name='section_id']").val();
        var deleteConfirm = confirm("Are you sure to delete this record?");
        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/examassign/destroy/" + id + "/" + exam_id + "/" + subject_id + "/" + section_id,
                method: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success == true) {
                        alert('Record Deleted?');
                        $("#examAssignResult").html('');
                    } else {
                        alert("Invalid ID.");
                    }
                },

            })
        }
    });
    // Exam Assign Update
    $('#examAssignUpdate').submit(function (e) {
        e.preventDefault();
        let id = $(this).attr("moyemoye");
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
            // alert(id);
            $.ajax({
                url: url + '/examassigns/' + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {

                    window.location.href = url + '/examassigns';
                    alert("Exam Assign Update Successfully");
                    $('#examAssignUpdate')[0].reset();
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });

    /// MARK REGISTER 
    //section by class
    $(document).on('change', '#class_id', function () {
        var classId = $(this).val();
        section(classId);
    })
    //get subject of assign by classes and section
    $("#class_id,  #exam_type").on("change", function () {
        var class_id = $("#class_id").val();
        var section = $("#sectionSelect").val();
        var exam = $("#exam_type").val();
        var subject = $("#subject_id").val();
        $('#subject_id').empty();
        $.ajax({
            url: url + "/subjectsForMarkRegister",
            method: "GET",
            dataType: "JSON",
            data: { class_id: class_id, section: section, exam: exam, subject: subject },
            success: function (response) {
                var option = '';
                option += '<option value="" selected disabled> Select Subject</option>';
                x = response.success;

                for (i = 0; i < x.length; i++) {

                    option += "<option class='' value=" + x[i].subject.id + ">" + x[i].subject.name + '</option>';
                };
                $('#subject_id').empty().append(option);
            },
        })
    })

    //find student for mark register
    $("#class_id, #subject_id").on("change", function () {
        var class_id = $("#class_id").val();
        var section = $("#sectionSelect").val();
        var exam = $("#exam_type").val();
        var subject = $("#subject_id").val();

        if (class_id != null && section != null) {
            $("#markRegisterStudent").html('');
            $.ajax({
                url: url + "/studentsForMarkRegister",
                method: "GET",
                dataType: "JSON",
                data: { class_id: class_id, section: section, exam: exam, subject: subject },
                success: function (response) {

                    x = response.success;
                    y = response.marks;
                    for (i = 0; i < x.length; i++) {
                        var tr = $("<tr></tr>");
                        for (j = 0; j < y.length; j++) {
                            var td = $("<td><input type='hidden' name='student_id[]' value='" + x[i].id + "' />" + x[i].first_name + "(" + x[i].last_name + ")</td><td> <input type='number'  required name='total[]' class='form-control total' value='" + y[j].marks + "'/> </td><td><input type='number' required name='marks[]' class='form-control marks' attribute='" + x[i] + "'/> <span class='error-message'></span> </td>");
                        }
                        tr.append(td);
                        $("#markRegisterStudent").append(tr);
                    }
                },
            });
        }
    });


    // insert mark register
    $("#markRegisterStore").on("submit", function (e) {
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
                url: url + '/markregisters',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    alert("Mark Assign Successfully");
                    $('#markRegisterStore')[0].reset();
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });

    //index of mark regstration
    $("#markRegisterSearch").on("submit", function (e) {
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
            $('#markRegisterResult').empty();
            $.ajax({
                url: url + '/markRegisterResult',
                method: "GET",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    x = data.success;
                    for (i = 0; i < x.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $("<td>" + [i + 1] + "</td><td>" + x[i].exam.name + "</td><td>" + x[i].class.name + "(" + x[i].section.name + ") </td><td>" + x[i].subject.name + " </td><td>" + x[i].students.first_name + x[i].students.last_name + " (Marks = " + x[i].marks + ")</td><td><button id='markRegedit' markReg_id=" + x[i].id + "><i class='fa-solid fa-pen-to-square'></i></button> <button id='markRegDelete' markReg_id=" + x[i].id + "><i class='fa-solid fa-trash'></i></button></td>");
                        tr.append(td);
                        $("#markRegisterResult").append(tr);
                    }
                },
            });
        }
    });

    //edit Mark Registration  
    $('#markRegisterResult').on('click', '#markRegedit', function (e) {
        e.preventDefault();
        let id = $(this).attr("markReg_id");

        alert(id);
        window.location.href = url + "/markregisters/" + id + "/edit";
    });

    //delete Mark Registration
    $('#markRegisterResult').on('click', '#markRegDelete', function (e) {
        e.preventDefault();
        let id = $(this).attr("markReg_id");
        // alert(id);
        let token = $("[name='_token']").val();
        var deleteConfirm = confirm("Are you sure to delete this record?");

        if (deleteConfirm == true) {
            $.ajax({
                url: url + "/markregisters/" + id,
                method: "DELETE",
                data: {
                    _token: token
                },
                success: function (response) {
                    if (response.success == true) {
                        alert('Record Deleted?');
                        $("#markRegisterResult").html('');
                    } else {
                        alert("Invalid ID.");
                    }
                },

            })
        }
    });

    // Mark Registration Update
    $("#markRegisterupdate").on("submit", function (e) {
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
            let id = $(this).attr("mark_id");
            // alert(id);
            $.ajax({
                url: url + '/markregisters/' + id,
                method: "PUT",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    alert("Marks Update Successfully");
                    window.location.href = url + '/markregisters';
                },
                error: function (data, textStatus, errorMessage) {
                    newdata = $.parseJSON(data.responseText)
                    for (const key in newdata.errors) {
                        errorContainer = $('#' + key + '_error');
                        errorContainer.text(newdata.errors[key][0]);
                    }
                }
            });
        }
    });



    //Settings mark
    $("#passMarkStore").on("submit", function (e) {
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
                url: url + '/passMarkStore',
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    if (data.success == true) {
                        alert('Pass Mark Update Successfully');
                        // $('#update_role_form')['0'].reset();
                    } else {
                        for (const key in data.errors) {
                            errorContainer = $('#' + key + '_error');
                            errorContainer.text(data.errors[key][0]);
                        }
                    }
                }
            });
        }
    });



    ///report Marksheet
    //find student for mark register
    $("#class_id, #exam_id").on("change", function () {
        var class_id = $("#class_id").val();
        var section = $("#sectionSelect").val();
        var exam = $("#exam_id").val();
        // var student = $("#student_id").val();

        if (class_id != null && exam != null) {
            $("#studentDATA").html('');
            $.ajax({
                url: url + "/get-student-marksheet",
                method: "GET",
                dataType: "JSON",
                data: { class_id: class_id, section: section, exam: exam, },
                success: function (data) {
                    var option = '';
                    var x = data.success
                    option += '<option value="" selected disabled>Select Student</option>';
                    for (i = 0; i < x.length; i++) {
                        option += "<option class='' value=" + x[i].students.id + ">" + x[i].students.first_name + x[i].students.last_name + '</option>';
                    };
                    $('#studentDATA').append(option);
                },
            });
        }
    });

    //Marksheet
    $("#marksheet").on("submit", function (e) {
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
                url: url + '/marksheetOfStudent',
                method: "GET",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    $('#result').empty();
                    x = data.success;
                    $("#datatable").css("display", 'block');
                    for (i = 0; i < x.length; i++) {
                        var tr = $("<tr></tr>");
                        var td = $("<td>" + x[i].students.first_name + " " + x[i].students.last_name + "</td><td>" + x[i].class.name + " ( " + x[i].section.name + " ) </td><td>" + x[i].exam.name + " </td><td>" + x[i].subject.name + " </td><td>" + x[i].total + "</td><td> " + x[i].marks + "</td>");
                        tr.append(td);
                        $("#result").append(tr);
                    }
                },
            });
        }
    });


    //Students for Progress Card
    $("#class_id, #sectionSelect").on("change", function () {
        var class_id = $("#class_id").val();
        var section = $("#sectionSelect").val();
        if (class_id != null && section != null) {
            $.ajax({
                url: url + "/get-student-for-progress",
                method: "GET",
                dataType: "JSON",
                data: { class_id: class_id, section: section },
                success: function (data) {
                    $("#student_id").html('');
                    var option = '';
                    var x = data.success
                    option += '<option value="" selected disabled>Select Student</option>';
                    for (i = 0; i < x.length; i++) {
                        option += "<option class='' value=" + x[i].id + ">" + x[i].first_name + x[i].last_name + '</option>';
                    };
                    $('#student_id').append(option);
                },
            });
        }
    });

    //progress card data
    $("#progressCard").on("submit", function (e) {
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
            $('#progressResult').empty();
            $("#name").empty();
            $.ajax({
                url: url + '/get-progress',
                method: "GET",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    x = data.success;
                    for (i = 0; i < x.length; i++) {
                        $("#progressData").css("display", 'block');
                        var tr = $("<tr></tr>");
                        var percent = x[i].total / x[i].marks;

                        var td = $("<td>" + [i + 1] + " </td><td>" + x[i].subject.name + " </td><td>" + x[i].total + "</td><td> " + x[i].marks + "</td>");
                        tr.append(td);
                        var name = x[i].students.first_name + " " + x[i].students.last_name;
                        $("#progressResult").append(tr);
                    }
                    // Create a new row for totals
                    var totalRow = $("<tr></tr>");
                    var totalTd = $("<td>Total</td><td></td><td>" + calculateTotal(x, 'total') + "</td><td>" + calculateTotal(x, 'marks') + "</td>");
                    totalRow.append(totalTd);
                    $("#progressResult").append(totalRow);
                    $("#name").append(name);
                },
            });
        }
    });

    // Function to calculate the total of a specific property in the array of objects
    function calculateTotal(arr, property) {
        let total = 0;
        for (let i = 0; i < arr.length; i++) {
            total += parseInt(arr[i][property]);
        }
        return total;
    }

    //merit search list
    $("#meritSearch").on("submit", function (e) {
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
            // $("#meritSearchResult").html();

            // $('#meritSearchResult')[0].reset();
            $.ajax({
                url: url + '/meritSearch',
                method: "GET",
                data: $(this).serialize(),
                dataType: "json",
                success: function (data) {
                    x = data.success;
                    x.sort(function (a, b) {
                        return b.marks_sum - a.marks_sum;
                    });

                    for (i = 0; i < x.length; i++) {
                        $("#progressData").css("display", 'block');
                        var tr = $("<tr></tr>");
                        var td = $("<td> " + [i + 1] + "</td><td>" + x[i].first_name + " " + x[i].last_name + " </td><td>" + x[i].total_sum + "</td><td> " + x[i].marks_sum + "</td><td> " + [i + 1] + "</td>");
                        tr.append(td);
                        $("#meritSearchResult").append(tr);
                    }
                },
            });
        }
    });

});

