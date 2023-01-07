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
}
