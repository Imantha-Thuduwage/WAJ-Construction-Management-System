// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
    $("#assign-form").submit(function (e) {
      e.preventDefault();
  
      // Remove Border Styles from Data Filled Input Fields
      $(".bg-body").removeClass("error");
  
      var data = new FormData(this);
  
      // Submit form data to PHP script using AJAX
      $.ajax({
        url: "saveAssign.php",
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
            $("#assign-form")[0].reset();
          }
          // // Check for errors
          if (response.hasOwnProperty("error_proId")) {
            $("#proId").addClass("error").addClass("option-color-set");
            $("#proId").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#proId").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_machineId")) {
            $("#machineId").addClass("error").addClass("option-color-set");
            $("#machineId").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#machineId").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_assignDate")) {
            $("#assignDate")
              .addClass("error")
              .attr("placeholder", response.error_assignDate)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_returnDate")) {
            $("#returnDate")
              .addClass("error")
              .attr("placeholder", response.error_returnDate)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_already_booked")) {
            $("#assignDate")
              .addClass("error")
              .next(".error-message")
              .html(response.error_already_booked);
          }
        },
        error: function (response) {
          Swal.fire("Failed", response.error, "error");
        },
      });
    });
  });  