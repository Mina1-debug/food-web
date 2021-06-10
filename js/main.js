// const { swal } = require("lib/sweetalert2/sweetalert2.min");

$(document).ready(function () {
    $(document).on("keyup, change", "input, select", function () {
        $(".error_info[input-name='" + $(this).attr("name") + "']").text("");
    });

    $(document).on("click", "a[data-target='#add_user']", function (e) {
        e.preventDefault();

        $("#add_user form").attr("action-type", "add_user");
        $("#add_user form").trigger("reset");
        $("#add_user form button.btn-primary").text("Add User");
        $("#add_user").modal("show");
    })

    $(document).on("submit", "form", function(e) {
        e.preventDefault();
        var _this = $(this);
        var _formData = new FormData(this);
        _formData.append("action", _this.attr("action-type"))

        $.ajax({
            url: "core/mina.php",
            method: "post",
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: _formData,
            error: (e) => {
                console.log(e);
            },
            beforeSend: () => {

            },
            success: (response) => {
                if(response['status'] == "OK") {
                    swal.fire({
                        title: "Submission successful",
                        text: response['message'],
                        icon: "success"
                    }).then((value) => {
                        _this.trigger("reset");
                       window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: "Submission unsuccessful",
                        text: response['message'],
                        icon: "error"
                    });
                    response['data'].forEach(item => {
                        $(".error_info[input-name='" + item[0] + "']").text(item[1]);
                    });
                }
            }
        });
    })


    $(document).on("click", ".btn-action", function (e) {
        console.log("dd");
        e.preventDefault();
        var _this = $(this);

        $.ajax({
            url: "core/mina.php",
            method: "post",
            dataType: "json",
            data: {
                action: _this.attr("action-type"),
                id: _this.attr("data")
            },
            error: (e) => {
                console.log(e);
            },
            beforeSend: () => {

            },
            success: (response) => {
                if(response['status'] == "OK") {
                    if(_this.attr("action-type") == "logout") {
                        swal.fire({
                            title: "Logout successful",
                            text: response['message'],
                            icon: "success"
                        }).then((value) => {
                           window.location.reload();
                        });
                    } else if(_this.attr("action-type") == "delete_user") {
                        swal.fire({
                            title: "Deletion successful",
                            text: response['message'],
                            icon: "success"
                        }).then((value) => {
                           window.location.reload();
                        });
                    } else {
                        $("#add_user form").attr("action-type", "update_user");
                        $("#add_user form button.btn-primary").text("Update User");
                        for (const key in response['data']) {
                            $("#add_user form input[name='" + key + "']").val(response['data'][key]);
                            $("#add_user form select[name='" + key + "']").val(response['data'][key]);
                            $("#add_user").modal("show");
                        }
                    }
                } else {
                    swal.fire({
                        title: "Error Occured",
                        text: response['message'],
                        icon: "error"
                    });
                }
            }
        });
    })

})