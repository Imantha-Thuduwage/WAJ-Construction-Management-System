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
      success: function (response) {
        // Check for error message
        if (response === "Form submission failed") {
          Swal.fire("Failed", response, "error");
        } else {
          // Display the result
          $("#output").html(response);
          alert(response);
        }

        // Handle specific error messages
        if (response.indexOf("error_empId") !== -1) {
          $("#empId").addClass("error").addClass("option-color-set");
          $("#empId").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#empId").removeClass("option-color-set");
            }
          });
        }
        if (response.indexOf("error_startDate") !== -1) {
          $("#startDate")
            .addClass("error")
            .attr("placeholder", response.split(": ")[1])
            .addClass("placeholder-set");
        }
        if (response.indexOf("error_endDate") !== -1) {
          $("#endDate")
            .addClass("error")
            .attr("placeholder", response.split(": ")[1])
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        Swal.fire("Failed", "Form submission failed", "error");
      },
    });
  });
});
