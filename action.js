function validateRegistrationForm() {

    const email = document.forms["regForm"]["email"].value;
    const password = document.forms["regForm"]["pass"].value;
    const fname = document.forms["regForm"]["fname"].value;
    const lname = document.forms["regForm"]["lname"].value;
    const address = document.forms["regForm"]["address"].value;
    const suburb = document.forms["regForm"]["suburb"].value;
    const state = document.forms["regForm"]["state"].value;
    const postcode = document.forms["regForm"]["postcode"].value;
    const phone = document.forms["regForm"]["phone"].value;

    if (fname[0] != fname[0].toUpperCase() && lname[0] != lname[0].toUpperCase()) {
        alert("First Letter should be capital for First name and Last Name");
        return false;
    } else if (fname[0] != fname[0].toUpperCase()) {
        alert("First Letter should be capital for First name");
        return false;
    } else if (lname[0] != lname[0].toUpperCase()) {
        alert("First Letter should be capital for Last name");
        return false;
    }

    //This is the function to do the email verification
    if (!validateEmail()) {
        return false;
    }

    //This is a condition to check the postcodes
    if (postcode.length != 4) {
        alert('Post Code must be 4 digits only');
        return false;
    }

    //State length validity
    if (state.length > 3) {
        alert('State must be less than or equal to 3');
        return false;
    }

    // Condition of Password
    if (password.length < 8) {
        alert('Password must be 8 characters long');
        return false;
    }

    if (email === "" && password === "" && fname === "" && lname === "" && address === "" && suburb === "" && state === "" && postcode === "" && phone === "") {
        alert("All Fields are required");
        return false;
    }

    if (email == "") {
        alert("Email cannot be empty");
        return false;

        if (password == "") {
            alert("Password cannot be empty");
            return false;
        }

        if (fname == "") {
            alert("First Name cannot be empty");
            return false;
        }

        if (lname == "") {
            alert("Last Name  cannot be empty");
            return false;
        }

        if (address == "") {
            alert("Address cannot be empty");
            return false;
        }

        if (suburb == "") {
            alert("Suburb cannot be empty");
            return false;
        }

        if (state == "") {
            alert("State cannot be empty");
            return false;
        }

        if (postcode == "") {
            alert("Postcode cannot be empty");
            return false;
        }

        if (phone == "") {
            alert("Phone cannot be empty");
            return false;
        }


    }

    function validateEmail() {
        var emailID = document.forms['regForm']['email'].value;
        atpos = emailID.indexOf("@");
        dotpos = emailID.lastIndexOf(".");

        if (atpos < 1 || (dotpos - atpos < 2)) {
            alert("Please enter correct email ID")
            return false;
        }
    }

}