function validation() {
    let aadharValid = document.forms["validateForm"]["aadhar_no"].value;
    if (aadharValid == "") {
        swal({
            title: "Aadhar No Field is Required",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    if (aadharValid.length != 12) {
        swal({
            title: "Aadhar No Must Be 12 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let panValid = document.forms["validateForm"]["pan_no"].value;
    if (panValid == "") {
        swal({
            title: "Pan No Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (panValid.length != 10) {
        swal({
            title: "Pan No Must Be 10 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let uanValid = document.forms["validateForm"]["uan_no_of_emp"].value;
    if (uanValid == "") {
        swal({
            title: "Uan No Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (uanValid.length != 12) {
        swal({
            title: "Uan No Must Be 12 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let presentpinValid = document.forms["validateForm"]["present_pin"].value;
    if (presentpinValid == "") {
        swal({
            title: "Present Pin Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (presentpinValid.length != 6) {
        swal({
            title: "Present Pin Must Be 6 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let permanentpinValid =
        document.forms["validateForm"]["permanent_pin"].value;
    if (permanentpinValid == "") {
        swal({
            title: "Permanent Pin Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (permanentpinValid.length != 6) {
        swal({
            title: "Permanent Pin  Must Be 6 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let personalcontactValid =
        document.forms["validateForm"]["personal_contact"].value;
    if (personalcontactValid == "") {
        swal({
            title: "personal Contact Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (personalcontactValid.length != 10) {
        swal({
            title: "personal Contact Must Be 10 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let alternativecontactValid =
        document.forms["validateForm"]["alternative_contact"].value;
    if (alternativecontactValid == "") {
        swal({
            title: "Alternative Contact Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (alternativecontactValid.length != 10) {
        swal({
            title: "Alternative Contact  Must Be 10 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let emergencycontactValid =
        document.forms["validateForm"]["emergency_contact"].value;
    if (emergencycontactValid == "") {
        swal({
            title: "Emergency Contact Field is Required",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (emergencycontactValid.length != 10) {
        swal({
            title: "Emergency Contact Must Be 10 Digits",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let eduquapassingyearValid =
        document.forms["validateForm"]["edu_qua_passing_year"].value;
    if (eduquapassingyearValid == "") {
        swal({
            title: "Emergency Contact Field is Required",
            input: "number",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (!/^[0-9]+$/.test(eduquapassingyearValid)) {
        swal({
            title: "Emergency Contact  Must Be 10 Digits",
            input: "number",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }

    let eproquayearValid = document.forms["validateForm"]["pro_qua_year"].value;
    if (eproquayearValid == "") {
        swal({
            title: "Emergency Contact Field is Required",
            input: "number",
            text: "Oops something Wrong!",
            icon: "error",
            button: "OK!",
        });
        return false;
    }
    if (!/^[0-9]+$/.test(eproquayearValid)) {
        swal({
            title: "Emergency Contact Must Be 10 Digits",
            input: "number",
            text: "Oops Something Went Wrong!",
            icon: "error",
            button: "Ok!",
        });
        return false;
    }
}
