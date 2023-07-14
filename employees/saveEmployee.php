<?php
session_start();

include '../function.php';

// Create array to store error messages
$errors = array();

// This function uses array keys as variable names and values as variable values
extract($_POST);

// Required Fields Validation
if (empty($firstName)) {
    $errors['error_firstName'] = "First Name is Required";
}
if (empty($lastName)) {
    $errors['error_lastName'] = "Last Name is Required";
}
if (empty($nicNumber)) {
    $errors['error_nicNumber'] = "NIC Number is Required";
}
if (empty($dob)) {
    $errors['error_dob'] = "Date of Birth is Required";
}
if (empty($street1)) {
    $errors['error_street1'] = "Street Line 01 is Required";
}
if (empty($city)) {
    $errors['error_city'] = "City is Required";
}
if (empty($phoneNum)) {
    $errors['error_phoneNum'] = "Phone Number is Required";
}
if (empty($joinDate)) {
    $errors['error_joinDate'] = "Joined Date is Required";
}
if (empty($supervisor)) {
    $errors['error_supervisor'] = "Supervisor is Required";
}

// Advanced Validation 
if (!empty($nicNumber)) {
    $sql = "SELECT * FROM tbl_employee WHERE nic_number = '$nicNumber'";
    $db = dbConn();
    $result = $db->query($sql);

    // Check if another employee with the same NIC number already exists
    if ($result->num_rows > 0) {
        $errors['error_nicNumber'] = "NIC is Already Exists";
    }
} 
if (!empty($phoneNum)) {
    // Check if the phone number has more than 10 digits or less than 10 digits
    if (strlen($phoneNum) != 10) {
        $errors['error_phoneNum'] = "Invalid Number";
    } else {
        $sql = "SELECT * FROM tbl_employee WHERE contact_number = '$phoneNum'";
        $db = dbConn();
        $result = $db->query($sql);

        // Check if another employee with the same contact number already exists
        if ($result->num_rows > 0) {
            $errors['error_phoneNum'] = "Contact Number Already Exists";
        }
    }
}

// Check Validation is Completed
if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $addUser = $_SESSION['userid'];
    $addDate = date('y-m-d');
}

$fileNameNew = NULL;

if (empty($errors) && !empty($_FILES['profileImg']['name'])) {
    // Check if 'profileImg' key exists in $_FILES array
    $pImage = $_FILES['profileImg'];

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
                $fileDestination = '../assets/images/profileImages/' . $fileNameNew;

                // Upload the file to the destination
                if (move_uploaded_file($tmpFilePath, $fileDestination)) {
                } else {
                    $errors['error_profileImg'] = "Error uploading the file.";
                }
            } else {
                $errors['error_profileImg'] = "File Size is Invalid";
            }
        } else {
            $errors['error_profileImg'] = "File Has Error";
        }
    } else {
        $errors['error_profileImg'] = "Invalid File Type";
    }
}


// Set employee status
$empStatus = 1;

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "INSERT INTO tbl_employee
            (`title`, `first_name`, `last_name`, `nic_number`, `date_of_birth`, `gender`, `street_line_one`, `street_line_two`,
            `city`, `contact_number`, `date_of_joining`,`supervisor`,`employee_status`, `profile_image`, `add_user`, `add_date`) 
            VALUES ('$title', '$firstName', '$lastName', '$nicNumber', '$dob', '$gender', '$street1', '$street2', 
            '$city', '$phoneNum', '$joinDate', '$supervisor', '$empStatus', '$fileNameNew', '$addUser', '$addDate')";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form submitted successfully"));
    } else {
        echo json_encode(array('error' => "Form submission failed"));
    }
}
