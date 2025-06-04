<?php
include '../connection.php'; // Correct path to connection.php

$signupMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $age = $_POST['age'];
    $blood_group = $_POST['blood_group'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_query = "SELECT * FROM user_details WHERE email = '$email'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $signupMessage = "User with this email already exists!";
    } else {
        $sql = "INSERT INTO user_details (full_name, email, contact_number, password, age, blood_group)
                VALUES ('$fullname', '$email', '$phone', '$hashed_password', $age, '$blood_group')";

        if (mysqli_query($con, $sql)) {
            header("Location: index.html"); // inside day3/
            exit();
        } else {
            $signupMessage = "Error: " . mysqli_error($con);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .signup-container {
      background: white;
      padding: 40px 30px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      width: 350px;
      text-align: center;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="number"],
    select {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0 20px;
      border: 1.5px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }
    button {
      width: 100%;
      padding: 12px;
      background-color: #28a745;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #1e7e34;
    }
    .message {
      margin-top: 15px;
      color: #d9534f;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <h2>Create Account</h2>
    <form method="POST" autocomplete="off">
      <input type="text" name="fullname" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="number" name="age" placeholder="Age" min="18" required />
      <select name="blood_group" required>
        <option value="" disabled selected>Select your Blood Group</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
      </select>
      <input type="text" name="phone" placeholder="Phone Number" required pattern="[0-9]{10}" title="Enter a 10-digit phone number" />
      <button type="submit">Sign Up</button>
    </form>
    <?php
      if (!empty($signupMessage)) {
        echo "<div class='message'>$signupMessage</div>";
      }
    ?>
  </div>
</body>
</html>
