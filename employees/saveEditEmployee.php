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
    $sql = "SELECT * FROM tbl_employee WHERE nic_number = '$nicNumber' AND employee_id <> '$empId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Check if another employee with the same NIC number already exists
    if ($result->num_rows > 0) {
        $errors['error_nicNumber'] = "NIC is Already Exists";
    } else {
        if (strlen($nicNumber) == 10) {
            // Check nic length is 10
            $lastCharactor = strtoupper(substr($nicNumber, -1)); //get last charactor by converting uppercase.
            //check last character equal to V or X and check first 9 charactors are numeric.
            if (!(($lastCharactor == "V" || $lastCharactor == "X") && is_numeric(substr($nicNumber, 0, 9)))) {
                $errors['error_nicNumber'] = "You Entered Invalid Old NIC Number";
            }
        } else if (strlen($nicNumber) == 12) { // Check NIC length is 12
            if (!is_numeric($nicNumber)) { // Check all characters are numeric
                $errors['error_nicNumber'] = "You Entered Invalid New NIC Number";
            }
        } else {
            $errors['error_nicNumber'] = "Please Enter Valid NIC Number";
        }
    }
}
if (!empty($phoneNum)) {
    $sql = "SELECT * FROM tbl_employee WHERE contact_number = '$phoneNum' AND employee_id <> '$empId'";
    $db = dbConn();
    $result = $db->query($sql);

    // Check if another employee with the same contact number already exists
    if ($result->num_rows > 0) {
        $errors['error_phoneNum'] = "Contact Number Already Exists";
    } else if (strlen($phoneNum) != 9) {
        $errors['error_phoneNum'] = "Invalid Phone Number";
    }
}

// Check Validation is Completed
if (empty($_SESSION['status'])) {
    // Retrieving values for fields that are not in the form
    $updateUser = $_SESSION['userid'];
    $updateDate = date('y-m-d');
}

if (empty($errors) && !empty($pImage = $_FILES['profileImg']['name'])) {
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
                    $fileDestination = '../assets/images/profileImages/' . $sameProfileImg;
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
} else {
    $fileNameNew = $sameProfileImg;
}

if (!empty($errors)) {
    echo json_encode($errors);
} else {
    // Calling DB Connection
    $sql = "UPDATE tbl_employee
    SET `title` = '$title', `first_name` = '$firstName', `last_name` = '$lastName', `nic_number` = '$nicNumber', `date_of_birth` = '$dob',
    `gender` = '$gender', `street_line_one` = '$street1', `street_line_two` = '$street2', `city` = '$city',
    `contact_number` = '$phoneNum', `date_of_joining` = '$joinDate', `supervisor` = '$supervisor', `profile_image` = '$fileNameNew',
     `update_user` = '$updateUser', `update_date` = '$updateDate'
    WHERE `employee_id` = '$empId'";
    $db = dbConn();
    if ($db->query($sql)) {
        echo json_encode(array('success' => "Form Updated successfully"));
    } else {
        echo json_encode(array('error' => "Form Updating failed"));
    }
}
