function validate(){
            let firstname = document.getElementById("username").value;
            if(firstname=== ""){
                document.getElementById("firstname-error").innerText="Please enter your first name";
                return false;
            }

            let lastname = document.getElementById("lastname").value;
            if(lastname === ""){
                document.getElementById("lastname-error").innerText="Please enter your last name";
                return false;
            }

            let email = document.getElementById("email").value;
            if(email === ""){
                document.getElementById("email-error").innerText="Please enter your email address";
                return false;
            }
            var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            if(!email.match(mailformat)){
                document.getElementById("email-error").innerText="Invalid email";
                return false;
            }

            let password = document.getElementById("password").value;
            if(password === ""){
                document.getElementById("password-error").innerText="Please enter your password";
                return false;
            } else{
                if(password.length < 6){
                    document.getElementById("password-error").innerText = "Password must be 6 characters long";
                    return false;
                }
            }
            return true;
        }