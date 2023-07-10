<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($proId)) {
    $errors['error_proId'] = "Project ID is Required";
}
if (empty($payedAmount)) {
    $errors['error_payedAmount'] = "Payed Amount is Required";
}
if (empty($payedDate)) {
    $errors['error_payedDate'] = "Payed Date is Required";
}
if (empty($paymentMethod)) {
    $errors['error_paymentMethod'] = "Payment Method is Required";
}

// Check Validation is Completed
else if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

if (empty($errors)) {
    // Check if 'profileImg' key exists in $_FILES array
    $pImage = $_FILES['payedSlip'];

    // Change properties as needed
    $fileName = $pImage['name'];
    $fileSize = $pImage['size'];
    $tmpFilePath = $pImage['tmp_name'];
    $fileError = $pImage['error'];

    // Get file extension
    $file_ext = explode('.', $fileName);
    $file_ext = strtolower(end($file_ext));

    // Allowed file types
    $allowed = array('png', 'jpg', 'jpeg');

    // Check if the file is allowed
    if (in_array($file_ext, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5242880) {
                // Create a new file name to avoid conflicts
                $fileNameNew = uniqid('', true) . '.' . $file_ext;
                $fileDestination = '../assets/images/payedSlips/' . $fileNameNew;

                // Upload the file to the destination
                if (move_uploaded_file($tmpFilePath, $fileDestination)) {
                } else {
                    $errors['error_payedSlip'] = "Error uploading the file.";
                }
            } else {
                $errors['error_payedSlip'] = "File Size is Invalid";
            }
        } else {
            $errors['error_payedSlip'] = "File Has Error";
        }
    } else {
        $errors['error_payedSlip'] = "Invalid File Type";
    }
}


if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_payment
            (`project_id`, `payed_amount`, `payed_date`, `payed_method`, `special_note`, `payed_slip`, `add_user`, `add_date`) 
            VALUES ('$proId', '$payedAmount', '$payedDate', '$paymentMethod', '$description', '$fileNameNew', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
