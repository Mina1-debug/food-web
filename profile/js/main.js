// const { swal } = require("lib/sweetalert2/sweetalert2.min");

$(document).ready(function () {
    $(document).on("keyup, change", "input, select", function () {
        $(".error_info[input-name='" + $(this).attr("name") + "']").text("");
    });
    $(document).on("click", ".btn", function () {
        $(".error_info").text("");
    });

    $(document).on('change', '.custom-file-input', function(){
        var fileName = $(this).val();
        $(this).next('.custom-file-label').html(fileName);
    })


    $(document).on("click", "button[data-toggle='modal']", function (e) {
        e.preventDefault();
        var _this = $(this);
        // var _target = _this.attr("data-target").replace("#", "").split("_");
        // console.log(_target);

        $(_this.attr("data-target") +" form").attr("action-type", _this.attr("data-target").replace("#", ""));
        $(_this.attr("data-target") +" form").trigger("reset");
        // if(_target[1].charAt(0).toUpperCase() + _target[1].slice(1) == "User")
        //     $(_this.attr("data-target") +" form button.btn-primary").text(
        //         _target[0].charAt(0).toUpperCase() + _target[0].slice(1) 
        //         + " " +
        //         _target[1].charAt(0).toUpperCase() + _target[1].slice(1)
        //     );
        $(_this.attr("data-target")).modal("show");
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
                console.log(response);
                if(response['status'] == "OK") {
                    if(_this.attr("action-type") == "logout") {
                        swal.fire({
                            title: "Logout successful",
                            text: response['message'],
                            icon: "success"
                        }).then((value) => {
                           window.location = "index.php";
                        });
                    } else if(_this.attr("action-type") == "delete_user") {
                        swal.fire({
                            title: "Deletion successful",
                            text: response['message'],
                            icon: "success"
                        }).then((value) => {
                           window.location.reload();
                        });
                    } else if(_this.attr("action-type") == "get_user") {
                        $("#add_user form").attr("action-type", "update_user");
                        $("#add_user form button.btn-primary").text("Save");
                        for (const key in response['data']) {
                            $("#add_user form input[name='" + key + "']:not(input[type='file'])").val(response['data'][key]);
                            $("#add_user form select[name='" + key + "'] option[value='" + response['data'][key] + "']").prop("selected", true);
                            $("#add_user").modal("show");
                        }
                    } else if (_this.attr("action-type") == "get_accompaniment") {
                        $("#add_accompaniment form").attr("action-type", "update_accompaniment");
                        $("#add_accompaniment form button.btn-primary").text("Save");
                        for (const key in response['data']) {
                            if(key != "image") {
                                $("#add_accompaniment form input[name='" + key + "']").val(response['data'][key]);
                                $("#add_accompaniment form select[name='" + key + "']").val(response['data'][key]);
                                $("#add_accompaniment").modal("show");
                            }
                        }
                    } else if (_this.attr("action-type") == "get_food") {
                        $("#add_food form").attr("action-type", "update_food");
                        $("#add_food form button.btn-primary").text("Save");
                        for (const key in response['data']) {
                            if(key != "image") {
                                $("#add_food form input[name='" + key + "']").val(response['data'][key]);
                                $("#add_food form select[name='" + key + "']").val(response['data'][key]);
                                $("#add_food").modal("show");
                            }
                        }
                    } else {
                        swal.fire({
                            title: "Delete Successful",
                            text: response['message'],
                            icon: "success"
                        }).then((value) => {
                           window.location.reload();
                        });
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