// JavaScript Document

function formhash(form, email, password) {
    // Create a new element input, this will be our hashed password field.
	if (email.value == '' || password == '') {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Please make sure you fill out all of the fields!</div>";
        return false;
	}
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
 
    // Finally submit the form. 
    form.submit();
}

function regformhash(form, uid, name, password, conf) {
     // Check each field has a value
    if (uid.value == ''         || 
          name.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Please make sure you fill out all of the fields!</div>";
        return false;
    }
 
    // Check the user's name.
 
    re = /^[A-Za-z- ]+$/; 
    if(!re.test(form.name.value)) { 
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your name can only contain letters, spaces and hyphens.</div>";
        form.name.focus();
        return false; 
    }
 
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (password.value.length < 6) {
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your password must be 6 letters long!</div>";
        form.password.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(password.value)) {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Passwords must contain at least one number, one lowercase and one uppercase letter.</div>";
        return false;
    }
 
    // Check password and confirmation are the same
    if (password.value != conf.value) {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your password and confirmation password do not match.</div>";
        form.password.focus();
        return false;
    }
 
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Make sure the plaintext password doesn't get sent. 
    password.value = "";
    conf.value = "";
 
    // Finally submit the form. 
    form.submit();
    return true;
}

function checknewname(form, newname) {
	//Are the confirmation and name set.
	if (newname.value == '' || form.conf.value == '') {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Please make sure you fill out all of the fields!</div>";
        return false;
		}
	
	//Check the user's name
	
	re = /^[A-Za-z- ]+$/; 
    if(!re.test(form.name.value)) { 
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your name can only contain letters, spaces and hyphens.</div>";
        form.name.focus();
        return false; 
    }
	
	//Do the username and confirmation match.
	if (newname.value != form.conf.value) {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your name and confirmation name do not match.</div>";
        return false; 
		}
	
	//Submit the form.
	form.submit()
	return true;
	
}

function checknewpass(form) {
	//Are the confirmation and name set.
	if (form.new.value == '' || form.conf.value == '') {
		document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Please make sure you fill out all of the fields!</div>";
        return false;
		}
	
	// Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (form.new.value.length < 6) {
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your password must be 6 letters long!</div>";
        form.new.focus();
        return false;
    }
 
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(form.new.value)) {
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Passwords must contain at least one number, one lowercase and one uppercase letter.</div>";
        return false;
    }
 
    // Check password and confirmation are the same
    if (form.new.value != form.conf.value) {
        document.getElementById("alerts").innerHTML = "<div class='alert alert-warning alert-dismissible fade in'><a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a><strong>WARNING!</strong> Your password and confirmation password do not match.</div>";
        form.new.focus();
        return false;
    }
	
	// Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");
 
    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(form.new.value);
 
    // Make sure the plaintext password doesn't get sent. 
    form.new.value = "";
    form.conf.value = "";
	
	form.submit()
	return true;
}