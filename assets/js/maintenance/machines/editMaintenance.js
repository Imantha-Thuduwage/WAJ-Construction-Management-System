// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
  $("#maintenance-form").submit(function (e) {
    e.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    var data = new FormData(this);

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "saveEditMaintenance.php",
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
          $("#maintenance-form")[0].reset();
        }
        // // Check for errors
        if (response.hasOwnProperty("error_machineId")) {
          $("#machineId").addClass("error").addClass("option-color-set");
          $("#machineId").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#machineId").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_maintainedDate")) {
          $("#maintainedDate")
            .addClass("error")
            .attr("placeholder", response.error_maintainedDate)
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        Swal.fire("Failed", response.error, "error");
      },
    });
  });
});  