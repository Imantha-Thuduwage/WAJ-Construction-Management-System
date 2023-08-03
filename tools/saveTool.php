<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($toolName)) {
    $errors['error_toolName'] = "Tool Name is Required";
}
if (empty($serialNumber)) {
    $errors['error_serialNumber'] = "Serial Number is Required";
}
if (empty($purchaseDate)) {
    $errors['error_purchaseDate'] = "Purchase Date is Required";
}
if (empty($status)) {
    $errors['error_status'] = "Status is Required";
}
if (empty($description)) {
    $errors['error_description'] = "Description is Required";
}

// Advanced Validation 
else if (!empty($serialNumber)) {
    $sql = "SELECT * FROM tbl_tool WHERE serial_number = '$serialNumber'";
    $db = dbConn();
    $result = $db->query($sql);

    // Checks if another project name already exists with the same name
    if ($result->num_rows > 0) {
        $errors['error_already'] = "Serial Number is Already Exists";
    }
    // Check Validation is Completed
    else if (empty($_SESSION['status'])) {
        // Retrieving values for fields that are not in the form
        $addUser = $_SESSION['userid'];
        $addDate = date('y-m-d');
    }
}

$fileNameNew = NULL;

if (empty($errors)&& !empty($_FILES['toolImg']['name'])) {
    // Check if 'profileImg' key exists in $_FILES array
    $pImage = $_FILES['toolImg'];

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
                $fileDestination = '../assets/images/toolImages/' . $fileNameNew;

                // Upload the file to the destination
                if (move_uploaded_file($tmpFilePath, $fileDestination)) {
                } else {
                    $errors['error_toolImg'] = "Error uploading the file.";
                }
            } else {
                $errors['error_toolImg'] = "File Size is Invalid";
            }
        } else {
            $errors['error_toolImg'] = "File Has Error";
        }
    } else {
        $errors['error_toolImg'] = "Invalid File Type";
    }
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_tool
            (`tool_name`, `serial_number`, `description`, `purchase_date`, `current_condition`, `tool_image`, `add_user`, `add_date`) 
            VALUES ('$toolName', '$serialNumber', '$description', '$purchaseDate', '$status', '$fileNameNew', '$addUser','$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
