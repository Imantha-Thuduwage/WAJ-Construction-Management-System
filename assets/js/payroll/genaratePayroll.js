$(document).ready(function () {
  $("#submit").click(function (event) {
    event.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    var data = $("#payroll-form").serialize();

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "createReport.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function (response) {
        // Checking if Form data is Successfully Submitted
        if (response.hasOwnProperty("success")) {
          // Send Successful Alert Message to User
          Swal.fire("Completed", response.success, "success");
          // Clear form data
          $("#payroll-form")[0].reset();
        } else if (response.hasOwnProperty("error_month")) {
          // Show error for the month field
          $("#month")
            .addClass("error")
            .next(".error-message")
            .html(response.error_month);
        } 
        else if (response.hasOwnProperty("error_already")) {
          // Show error if payroll for the selected month already exists
          Swal.fire("Error", response.error_already, "error");
        } else {
          // Show a generic error message
          Swal.fire("Error", "Form submission failed", "error");
        }
      },
      error: function (response) {
        // Show the error message from the server
        Swal.fire("Failed", response.responseText, "error");
      },
    });
  });
});
