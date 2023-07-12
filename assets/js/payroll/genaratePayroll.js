// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
  $("#payroll-form").submit(function (e) {
    e.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    var data = new FormData(this);

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "saveReport.php",
      type: "POST",
      data: data,
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,

      success: function (response) {
        //Checking if Form data is Successfully Submitted
        if (response.hasOwnProperty("success")) {
          // Send Successfull Alert Messsage to User
          Swal.fire("Completed", response.success, "success");
          // Clear form data
          $("#payroll-form")[0].reset();
        }
        // // Check for errors
        if (response.hasOwnProperty("error_empId")) {
          $("#empId").addClass("error").addClass("option-color-set");
          $("#empId").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#empId").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_startDate")) {
          // $("#pName").val('');
          $("#startDate")
            .addClass("error")
            .attr("placeholder", response.error_startDate)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_endDate")) {
          $("#endDate")
            .addClass("error")
            .attr("placeholder", response.error_endDate)
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        Swal.fire("Failed", response.error, "error");
      },
    });
  });
});
