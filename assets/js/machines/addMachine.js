// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
    $("#machine-form").submit(function (e) {
      e.preventDefault();
  
      // Remove Border Styles from Data Filled Input Fields
      $(".bg-body").removeClass("error");
  
      var data = new FormData(this);
  
      // Submit form data to PHP script using AJAX
      $.ajax({
        url: "saveMachine.php",
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
            $("#machine-form")[0].reset();
          }
          // // Check for errors
          if (response.hasOwnProperty("error_machineName")) {
            $("#machineName")
              .addClass("error")
              .attr("placeholder", response.error_machineName)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_serialNumber")) {
            $("#serialNumber")
              .addClass("error")
              .attr("placeholder", response.error_serialNumber)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_purchaseDate")) {
            $("#purchaseDate")
              .addClass("error")
              .attr("placeholder", response.error_purchaseDate)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_condition")) {
            $("#condition").addClass("error").addClass("option-color-set");
            $("#condition").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#condition").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_fuelType")) {
            $("#fuelType").addClass("error").addClass("option-color-set");
            $("#fuelType").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#fuelType").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_brand")) {
            $("#brand").addClass("error").addClass("option-color-set");
            $("#brand").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#brand").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_description")) {
            $("#description")
              .addClass("error")
              .attr("placeholder", response.error_description)
              .addClass("placeholder-set");
          }
          if(response.hasOwnProperty("error_machineImg")) {
            $("#machineImg")
              .addClass("error")
              .next(".error-message")
              .html(response.error_machineImg);
          }
          if(response.hasOwnProperty("error_already")) {
            $("#serialNumber")
              .addClass("error")
              .next(".error-message")
              .html(response.error_already);
          }
        },
        error: function (response) {
          Swal.fire("Failed", response.error, "error");
        },
      });
    });
  });  