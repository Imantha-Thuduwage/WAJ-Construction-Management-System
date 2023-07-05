// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
  $("#employee-form").submit(function (e) {
    e.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    // var data = $("#employee-form").serialize();

    var title = document.querySelector('input[name="title"]:checked').value;
    var gender = document.querySelector('input[name="gender"]:checked').value;

    var data = new FormData(this);
    
    data.append("title",title);
    data.append("gender",gender);

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "saveEmployee.php",
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
          $("#employee-form")[0].reset();
        }
        // // Check for errors
        if (response.hasOwnProperty("error_firstName")) {
          $("#firstName")
            .addClass("error")
            .attr("placeholder", response.error_firstName)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_lastName")) {
          // $("#pName").val('');
          $("#lastName")
            .addClass("error")
            .attr("placeholder", response.error_lastName)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_nicNumber")) {
          $("#nicNumber")
            .addClass("error")
            .attr("placeholder", response.error_nicNumber)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_dob")) {
          $("#dob")
            .addClass("error")
            .attr("placeholder", response.error_dob)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_street1")) {
          $("#street1")
            .addClass("error")
            .attr("placeholder", response.error_street1)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_city")) {
          $("#city")
            .addClass("error")
            .attr("placeholder", response.error_city)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_phoneNum")) {
          $("#phoneNum")
            .addClass("error")
            .attr("placeholder", response.error_phoneNum)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_joinDate")) {
          $("#joinDate")
            .addClass("error")
            .attr("placeholder", response.error_joinDate)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_basicSal")) {
          $("#basicSal")
            .addClass("error")
            .attr("placeholder", response.error_basicSal)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_tackQuantity")) {
          $("#tackQuantity")
            .addClass("error")
            .attr("placeholder", response.error_tackQuantity)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_tackRate")) {
          $("#tackRate")
            .addClass("error")
            .attr("placeholder", response.error_tackRate)
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        Swal.fire("Failed", response.error, "error");
      },
    });
  });
});
