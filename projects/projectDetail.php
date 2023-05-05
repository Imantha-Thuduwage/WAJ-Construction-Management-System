<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  extract($_POST);

  // Validate form data
  $errors = array();

  if (empty($name)) {
    $errors[] = 'Name is required';
  }

  if (empty($email)) {
    $errors[] = 'Email is required';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Email is invalid';
  }

  if (empty($message)) {
    $errors[] = 'Message is required';
  }

  if (count($errors) == 0) {
    // If validation passes, insert data into MySQL database
    $conn = mysqli_connect('localhost', 'username', 'password', 'database_name');
    $sql = "INSERT INTO contacts (name, email, message) VALUES ('$name', '$email', '$message')";
    mysqli_query($conn, $sql);

    // Return success message
    echo "Message sent successfully";
    exit;
  }
}
?>

<form id="contact-form" method="post">
  <?php
    if (count($errors) > 0) {
      echo '<ul>';
      foreach ($errors as $error) {
        echo '<li>' . $error . '</li>';
      }
      echo '</ul>';
    }
  ?>
  <div>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
  </div>

  <div>
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
  </div>

  <div>
    <label for="message">Message:</label>
    <textarea name="message" id="message" required><?php echo isset($_POST['message']) ? $_POST['message'] : '' ?></textarea>
  </div>

  <button type="submit">Send Message</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('#contact-form').submit(function(event) {
    event.preventDefault();

    // Submit form data to PHP script using AJAX
    $.ajax({
      url: 'your_php_file.php',
      type: 'POST',
      data: $('#contact-form').serialize(),
      success: function(response) {
        alert(response);
        $('#contact-form')[0].reset();
      },
      error: function() {
        alert('An error occurred while submitting the form.');
      }
    });
  });
});
</script>

</body>
</html>





