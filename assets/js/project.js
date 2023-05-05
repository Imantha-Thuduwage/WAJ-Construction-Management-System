// Function for Hiding and Showing the input Fields of ABC Deatils Based on Drop Down
function enableAbcDetails(answer) {
  if (answer.value == 1) {
    for (var i = 1; i <= 3; i++) {
      const id = document.getElementById("abc-details-" + i.toString());
      id.classList.remove("d-none");
    }
  } else {
    for (var i = 1; i <= 3; i++) {
      document
        .getElementById("abc-details-" + i.toString())
        .classList.add("d-none");
    }
  }
}

// Function for Hiding and Showing the input Fields of Prime Coat Deatils Based on Drop Down
function enablePrimeDetails(answer) {
  if (answer.value == 1) {
    for (var i = 1; i <= 3; i++) {
      const id = document.getElementById("prime-coat-details-" + i.toString());
      id.classList.remove("d-none");
    }
  } else {
    for (var i = 1; i <= 3; i++) {
      document
        .getElementById("prime-coat-details-" + i.toString())
        .classList.add("d-none");
    }
  }
}

// Function for Hiding and Showing the input Fields of Tack Coat Deatils Based on Drop Down
function enableTackDetails(answer) {
  if (answer.value == 1) {
    for (var i = 1; i <= 3; i++) {
      const id = document.getElementById("tack-coat-details-" + i.toString());
      id.classList.remove("d-none");
    }
  } else {
    for (var i = 1; i <= 3; i++) {
      document
        .getElementById("tack-coat-details-" + i.toString())
        .classList.add("d-none");
    }
  }
}

// Function for Hiding and Showing the input Fields of Asphalt Deatils Based on Drop Down
function enableAsphaltDetails(answer) {
  if (answer.value == 1) {
    for (var i = 1; i <= 4; i++) {
      const id = document.getElementById("asphalt-details-" + i.toString());
      id.classList.remove("d-none");
    }
  } else {
    for (var i = 1; i <= 4; i++) {
      document
        .getElementById("asphalt-details-" + i.toString())
        .classList.add("d-none");
    }
  }
}

// Function for Hiding and Showing the input Fields of Tack Coat Deatils Based on Drop Down
function enableConcreteDetails(answer) {
  if (answer.value == 1) {
    for (var i = 1; i <= 3; i++) {
      const id = document.getElementById("concrete-details-" + i.toString());
      id.classList.remove("d-none");
    }
  } else {
    for (var i = 1; i <= 3; i++) {
      document
        .getElementById("conrete-details-" + i.toString())
        .classList.add("d-none");
    }
  }
}

// JQuery Function function for submitting data using AJAX
$(document).ready(function () {
  $("#submit").click(function (event) {
    event.preventDefault();

    // Remove Border Styles from Data Filled Input Fields
    $(".bg-body").removeClass("error");

    var data = $("#project-form").serialize();

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: "projectSubmit.php",
      type: "POST",
      data: data,
      dataType: "json",
      success: function (response) {
        //Checking if Form data is Successfully Submitted
        if (response.hasOwnProperty("success")) {
          // Send Successfull Alert Messsage to User
          Swal.fire("Completed", response.success, "success");
          // Clear form data
          $("#project-form")[0].reset();
        }
        // Check for errors
        if (response.hasOwnProperty("error_pName")) {
          $("#pName")
            .addClass("error")
            .attr("placeholder", response.error_pName)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_location")) {
          $("#pLocation")
            .addClass("error")
            .attr("placeholder", response.error_location)
            .addClass("placeholder-set");
        }
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
        if (response.hasOwnProperty("error_proManager")) {
          $("#proManager").addClass("error").addClass("option-color-set");
          $("#proManager").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#proManager").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_abcStatus")) {
          $("#abcStatus").addClass("error").addClass("option-color-set");
          $("#abcStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#abcStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_abcUnit")) {
          $("#abcUnit").addClass("error").addClass("option-color-set");
          $("#abcUnit").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#abcUnit").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_abcQuantity")) {
          $("#abcQuantity")
            .addClass("error")
            .attr("placeholder", response.error_abcQuantity)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_abcRate")) {
          $("#abcRate")
            .addClass("error")
            .attr("placeholder", response.error_abcRate)
            .addClass("placeholder-set");
        }

        if (response.hasOwnProperty("error_primeStatus")) {
          $("#primeStatus").addClass("error").addClass("option-color-set");
          $("#primeStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#primeStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_primeUnit")) {
          $("#primeUnit").addClass("error").addClass("option-color-set");
          $("#primeUnit").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#primeUnit").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_primeQuantity")) {
          $("#primeQuantity")
            .addClass("error")
            .attr("placeholder", response.error_primeQuantity)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_primeRate")) {
          $("#primeRate")
            .addClass("error")
            .attr("placeholder", response.error_primeRate)
            .addClass("placeholder-set");
        }

        if (response.hasOwnProperty("error_tackStatus")) {
          $("#tackStatus").addClass("error").addClass("option-color-set");
          $("#tackStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#tackStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_tackUnit")) {
          $("#tackUnit").addClass("error").addClass("option-color-set");
          $("#tackUnit").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#tackUnit").removeClass("option-color-set");
            }
          });
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

        if (response.hasOwnProperty("error_asphaltStatus")) {
          $("#asphaltStatus").addClass("error").addClass("option-color-set");
          $("#asphaltStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#asphaltStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_asphaltThicknes")) {
          $("#asphaltThicknes")
            .addClass("error")
            .attr("placeholder", response.error_asphaltThicknes)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_asphaltUnit")) {
          $("#asphaltUnit").addClass("error").addClass("option-color-set");
          $("#asphaltUnit").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#asphaltUnit").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_asphaltQuantity")) {
          $("#asphaltQuantity")
            .addClass("error")
            .attr("placeholder", response.error_asphaltQuantity)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_asphaltRate")) {
          $("#asphaltRate")
            .addClass("error")
            .attr("placeholder", response.error_asphaltRate)
            .addClass("placeholder-set");
        }

        if (response.hasOwnProperty("error_markingStatus")) {
          $("#markingStatus").addClass("error").addClass("option-color-set");
          $("#markingStatus").change(function () {
            var selectedValue = $(this).val();
            if (selectedValue != "") {
              $("#markingStatus").removeClass("option-color-set");
            }
          });
        }
        if (response.hasOwnProperty("error_bridges")) {
          $("#bridges")
            .addClass("error")
            .attr("placeholder", response.error_bridges)
            .addClass("placeholder-set");
        }
        if (response.hasOwnProperty("error_pCost")) {
          $("#pCost")
            .addClass("error")
            .attr("placeholder", response.error_pCost)
            .addClass("placeholder-set");
        }
      },
      error: function (response) {
        // alert("heelo");
        // $("#message").html(response); // Display error message
      },
    });
  });
});
