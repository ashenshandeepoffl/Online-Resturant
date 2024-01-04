function validateForm() {
    let first_name = document.forms["myForm"]["first_name"].value;
    let last_name = document.forms["myForm"]["last_name"].value;
    let email = document.forms["myForm"]["email"].value;
    let username = document.forms["myForm"]["username"].value;
    let address_no = document.forms["myForm"]["address_no"].value;
    let address_street = document.forms["myForm"]["address_street"].value;
    let address_city = document.forms["myForm"]["address_city"].value;
    let dob = document.forms["myForm"]["dob"].value;
    let password = document.forms["myForm"]["password"].value;
    let confirm_password = document.forms["myForm"]["confirm_password"].value;

    if (first_name == "") {
        alert("Please enter your First Name.");
        return false;
    }

    if (last_name == "") {
        alert("Please enter your Last Name.");
        return false;
    }

    if (email == "") {
        alert("Please enter your Email Address.");
        return false;
    } else {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert("Please enter a valid Email Address.");
            return false;
        }
    }

    if (username == "") {
        alert("Please enter a Username.");
        return false;
    }

    if (address_no == "") {
        alert("Please enter your Address Number.");
        return false;
    }

    if (address_street == "") {
        alert("Please enter your Address Street.");
        return false;
    }

    if (address_city == "") {
        alert("Please enter your Address City.");
        return false;
    }

    if (dob == "") {
        alert("Please enter your Date of Birth.");
        return false;
    }

    if (password == "") {
        alert("Please enter a Password.");
        return false;
    }

    if (confirm_password == "") {
        alert("Please confirm your Password.");
        return false;
    }

    // Check if password and confirm password match
    if (password !== confirm_password) {
        alert("Password and Confirm Password do not match.");
        return false;
    }
}
