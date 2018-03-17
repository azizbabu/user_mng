$(document).ready(function() {
    //listens for typing on the desired field
    $("#email").keyup(function() {
        //gets the value of the field
        var email = $("#email").val();
 
        //here would be a good place to check if it is a valid email before posting to your db
 
        //displays a loader while it is checking the database
        $("#emailError").html('<img alt="" src="/images/loader.gif" />');
 
        //here is where you send the desired data to the PHP file using ajax
        $.post("../checkavailability.php", {email:email},
            function(result) {
                if(result == 1) {
                    //the email is available
                    $("#emailError").html("Available");
                }
                else {
                    //the email is not available
                    $("#emailError").html("Email not available");
                }
            });
     });
});