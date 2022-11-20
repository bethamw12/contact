<?php include 'inc/header.php' ?>


<?php
// Set vars to empty values
$name = $email = $message = '';
$nameErr = $emailErr = $messageErr = '';

// Form submit
if (isset($_POST['submit'])) {
  // Validate name
  if (empty($_POST['name'])) {
    $nameErr = 'Name is required';
  } else {
    // $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = filter_input(
      INPUT_POST,
      'name',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  // Validate email
  if (empty($_POST['email'])) {
    $emailErr = 'Email is required';
  } else {
    // $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  }

  // Validate message
  if (empty($_POST['message'])) {
    $messageErr = 'Message is required';
  } else {
    // $message = filter_var($_POST['message'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $message = filter_input(
      INPUT_POST,
      'message',
      FILTER_SANITIZE_FULL_SPECIAL_CHARS
    );
  }

  if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
    // add to database
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";
    if (mysqli_query($conn, $sql)) {
      // success
      header('Location: index.php');
    } else {
      // error
      echo 'Error: ' . mysqli_error($conn);
    }
  }
}
?>


<style>
body{
    background-color: pink;
}
.form-control{
    width: 50%;
    height: 30px;
}
form{
    text-align: center;
}
header{
    text-align: center;
    padding: 30px
}
</style>

<header>
    <h1>Contact Me</h1>
</header>
<body>
<form method='POST' action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label>Name <br><input name='name' id='name' class='form-control' required></label><br><br>
    <label>Email <br><input name='email' id='email' type='email' class='form-control' required></label><br><br>
    <label>Message <br><textarea name='message' id='message'  class='form-control' required></textarea><br><br>
    <button name='submit' type='submit'>Submit</button>
</form>
</body>

<?php include 'inc/footer.php'; ?>
