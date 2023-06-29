$("#add").click(function () {
  $("#resource-table").removeClass("d-none");
});


$(document).ready(function () {

  // JQuery Function for submitting data using AJAX ( Just for Add Task)
  $("#add-task").click(function (event) {
    event.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    var data = $("#task-form").serialize();

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "saveTask.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function (response) {
        //Checking if Form data is Successfully Submitted
        if (response.hasOwnProperty("success")) {
          // Send Successfull Alert Message to User
          Swal.fire({
            title: "Completed",
            text: response.success,
            icon: "success",
            didClose: function () {
              location.reload(); // Reload the page after the alert is closed
            },
          });
        }
        // Check for errors
        if (response.hasOwnProperty("error_startDate")) {
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
        if (response.hasOwnProperty("error_description")) {
          $("#description")
            .addClass("error")
            .attr("placeholder", response.error_description)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_currentStatus")) {
          $("#currentStatus").addClass("error").addClass("option-color-set");
          $("#currentStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#currentStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_cost")) {
          $("#cost")
            .addClass("error")
            .attr("placeholder", response.error_cost)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_labourCount")) {
          $("#labourCount")
            .addClass("error")
            .attr("placeholder", response.error_labourCount)
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        Swal.fire("Failed", response.error, "error");
      },
    });
  });

  // JQuery Function for submitting data using AJAX (To Complete All Tasks)
  $("#complete").click(function (event) {
    event.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    var data = $("#task-form").serialize();

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "completeTask.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function (response) {
        //Checking if Form data is Successfully Submitted
        if (response.hasOwnProperty("success")) {
          // Send Successfull Alert Message to User
          Swal.fire({
            title: "Completed",
            text: response.success,
            icon: "success",
            didClose: function () {
              window.location.href = "schedule.php"; // Redirect to Schedule Table
            },
          });
        }
        // Check for errors
        if (response.hasOwnProperty("error_startDate")) {
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
        if (response.hasOwnProperty("error_description")) {
          $("#description")
            .addClass("error")
            .attr("placeholder", response.error_description)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_currentStatus")) {
          $("#currentStatus").addClass("error").addClass("option-color-set");
          $("#currentStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#currentStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_cost")) {
          $("#cost")
            .addClass("error")
            .attr("placeholder", response.error_cost)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_labourCount")) {
          $("#labourCount")
            .addClass("error")
            .attr("placeholder", response.error_labourCount)
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        Swal.fire("Failed", response.error, "error");
      },
    });
  });
});
