// Function for get Office by Organisaction
$("#organ_level_upd").change(function () {
    $("#office_name_upd").find("option").not(":first").remove();
    var org_idd = $(this).val();
    $.ajax({
        type: "GET",
        url: "getOfficeLists/" + org_idd,
        cache: false,
        contentType: "application/json;",
        datatype: "json",
        success: function (response) {
            var len = 0;
            if (response["data"] != null) {
                len = response["data"].length;
            }

            if (len > 0) {
                // Read data and create <option >
                for (var i = 0; i < len; i++) {
                    var office_id = response["data"][i].office_id;
                    var office_name = response["data"][i].office_name;

                    var option =
                        "<option class='select' value='" +
                        office_id +
                        "'>" +
                        office_name +
                        "</option>";

                    $("#office_name_upd").append(option);
                }
            }
        },
        error: function (error) {
            alert(error);
        },
    });

    getPostByOrganization(org_idd); // Get Post by Organization Level
});

//  function to Get Post by Organization
function getPostByOrganization(org_idd) {
    $("#position_upd").find("option").not(":first").remove(); // Empty Employee Position
    $.ajax({
        type: "GET",
        url: "getPosts/" + org_idd,
        cache: false,
        contentType: "application/json;",
        datatype: "json",
        success: function (response) {
            var len = 0;
            if (response["pd"] != null) {
                len = response["pd"].length;
            }

            if (len > 0) {
                // Read data and create <option >
                for (var i = 0; i < len; i++) {
                    var post_id = response["pd"][i].post_id;
                    var post_title = response["pd"][i].post_title;

                    var option =
                        "<option class='select' value='" +
                        post_id +
                        "'>" +
                        post_title +
                        "</option>";

                    $("#position_upd").append(option);
                }
            }
        },
        error: function (error) {
            alert(error);
        },
    });
}

// Function to get Designation by Position id
$("#position_upd").change(function () {
    var po_id = $(this).val();

    // Empty the dropdown
    $("#designation_upd").find("option").not(":first").remove();

    // AJAX request
    $.ajax({
        url: "getDesignations/" + po_id,
        type: "get",
        dataType: "json",
        success: function (response) {
            var len = 0;
            if (response["de"] != null) {
                len = response["de"].length;
            }

            if (len > 0) {
                // Read data and create <option >
                for (var i = 0; i < len; i++) {
                    var designation_id = response["de"][i].designation_id;
                    var designation_code = response["de"][i].designation_code;

                    var option =
                        "<option class='select' value='" +
                        designation_id +
                        "'>" +
                        designation_code +
                        "</option>";

                    $("#designation_upd").append(option);
                }
            }
        },
    });
});

// functionh to get Reporting Authority Designation

$("#ra_designation").change(function () {
    // State id
    var ur_id = $(this).val();
    var mUrl = "/getUserDesigns/" + ur_id;

    // // Empty the dropdown
    // $("#designation_upd").find("option").not(":first").remove();

    //AJAX request
    $.ajax({
        url: mUrl,
        type: "get",
        cache: false,
        contentType: "application/json",
        datatype: "json",
        success: function (respose) {
            if (result == false) {
                alert("Not Found");
            } else {
                $select = $("#ra_designation");
                $select.find("option").remove();
                $select.append($("<option>").html("-- Select --"));
                Object.keys(result).forEach(function (key) {
                    $a = result[key].designation_code;
                    $select.append(
                        "<option selected disabled data-myid=" +
                            $a +
                            " value=" +
                            $a +
                            ">" +
                            $a +
                            "</option>"
                    );
                });
            }
        },
        error: function (xhr, status, errorThrown) {
            //Here the status code can be retrieved like;
            xhr.status;
            alert(status);

            //The message added to Response object in Controller can be retrieved as following.
            xhr.responseText;
        },
    });
});
