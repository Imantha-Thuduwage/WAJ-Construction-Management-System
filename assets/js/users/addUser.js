  // JQuery Function function for submitting data using AJAX
  $(document).ready(function () {
    $("#submit").click(function (event) {
      event.preventDefault();
  
      // Remove Border Styles from Data Filled Input Fields
      $(".bg-body").removeClass("error");
  
      var data = $("#user-form").serialize();
  
      // Submit form data to PHP script using AJAX
      $.ajax({
        url: "saveUser.php",
        type: "POST",
        data: data,
        dataType: "json",
        success: function (response) {
          //Checking if Form data is Successfully Submitted
          if (response.hasOwnProperty("success")) {
            // Send Successfull Alert Messsage to User
            Swal.fire("Completed", response.success, "success");
            // Clear form data
            $("#user-form")[0].reset();
          }
          // Check for errors
          if (response.hasOwnProperty("error_userName")) {
            $("#userName").addClass("error")
              .attr("placeholder", response.error_userName)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_password")) {
            $("#password")
              .addClass("error")
              .attr("placeholder", response.error_password)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_firstName")) {
            $("#firstName").addClass("error").addClass("option-color-set");
            $("#firstName").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#firstName").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_lastName")) {
            $("#lastName").addClass("error").addClass("option-color-set");
            $("#lastName").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#lastName").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_userRole")) {
            $("#userRole").addClass("error").addClass("option-color-set");
            $("#userRole").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#userRole").removeClass("option-color-set");
              }
            });
          }      },
        error: function (response) {
          Swal.fire("Failed", response.error, "error");
        },
      });
    });
  });
  