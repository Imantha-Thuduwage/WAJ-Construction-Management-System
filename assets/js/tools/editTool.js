// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
    $("#tool-form").submit(function (e) {
      e.preventDefault();
  
      // Remove Border Styles from Data Filled Input Fields
      $(".bg-body").removeClass("error");
  
      var data = new FormData(this);
  
      // Submit form data to PHP script using AJAX
      $.ajax({
        url: "saveEditTool.php",
        type: "POST",
        data: data,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
  
        success: function (response) {
          alert(response);
          //Checking if Form data is Successfully Submitted
          if (response.hasOwnProperty("success")) {
            // Send Successfull Alert Messsage to User
            Swal.fire("Completed", response.success, "success");
            // Clear form data
            $("#tool-form")[0].reset();
          }
          // // Check for errors
          if (response.hasOwnProperty("error_toolName")) {
            // $("#pName").val('');
            $("#toolName")
              .addClass("error")
              .attr("placeholder", response.error_toolName)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_purchaseDate")) {
            $("#purchaseDate")
              .addClass("error")
              .attr("placeholder", response.error_purchaseDate)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_status")) {
            $("#status").addClass("error").addClass("option-color-set");
            $("#status").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#status").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_description")) {
            $("#description")
              .addClass("error")
              .attr("placeholder", response.error_description)
              .addClass("placeholder-set");
          }
        },
        error: function (response) {
          Swal.fire("Failed", response.error, "error");
        },
      });
    });
  });  