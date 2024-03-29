// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
    $("#salary-form").submit(function (e) {
      e.preventDefault();
  
      // Remove Border Styles from Data Filled Input Fields
      $(".bg-body").removeClass("error");
  
      var data = new FormData(this);
  
      // Submit form data to PHP script using AJAX
      $.ajax({
        url: "saveSalary.php",
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
            $("#salary-form")[0].reset();
          }
          // Check for errors
          if (response.hasOwnProperty("error_employeeId")) {
            $("#employeeId").addClass("error").addClass("option-color-set");
            $("#employeeId").change(function () {
              var selectedValue = $(this).val();
              if (selectedValue != "") {
                $("#employeeId").removeClass("option-color-set");
              }
            });
          }
          if (response.hasOwnProperty("error_basicSal")) {
            // $("#pName").val('');
            $("#basicSal")
              .addClass("error")
              .attr("placeholder", response.error_basicSal)
              .addClass("placeholder-set");
          }
          if (response.hasOwnProperty("error_companyAllowance")) {
            $("#companyAllowance")
              .addClass("error")
              .attr("placeholder", response.error_companyAllowance)
              .addClass("placeholder-set");
          }
          if(response.hasOwnProperty("error_already")) {
            $("#employeeId")
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