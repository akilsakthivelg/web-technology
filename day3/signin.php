<?php
session_start();
$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $con = mysqli_connect("localhost", "root", "root", "donarbase");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user_details WHERE email = '$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_name'] = $row['full_name'];
            header("Location: home.php");
            exit();
        } else {
            $loginMessage = "Invalid credentials!";
        }
    } else {
        $loginMessage = "User not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign In</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url("background_image.png") repeat;
      background-size: 500px;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .signin-container {
      background: white;
      padding: 40px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 320px;
      text-align: center;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0 20px;
      border: 1.5px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    .message {
      margin-top: 15px;
      color: #d9534f;
      font-weight: bold;
    }
  </style>

  <script>
    function validateForm() {
      const email = document.forms["signinForm"]["email"].value.trim();
      const password = document.forms["signinForm"]["password"].value.trim();

      if (email === "" || password === "") {
        alert("Please enter both email and password.");
        return false;
      }
      return true;
    }
  </script>
</head>
<body>

  <div class="signin-container">
    <h2>Sign In</h2>
    <form name="signinForm" method="POST" onsubmit="return validateForm()">
      <input type="email" name="email" placeholder="Email" />
      <input type="password" name="password" placeholder="Password" />
      <button type="submit">Sign In</button>
    </form>
    <?php if (!empty($loginMessage)) echo "<div class='message'>$loginMessage</div>"; ?>
  </div>

</body>
</html>
