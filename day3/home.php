<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Home</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #f0f0f0;
    }

    img {
      max-width: 90%;
      max-height: 60%;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    h1 {
      font-family: Arial, sans-serif;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <h1>Now you are successfully logged <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
  
</body>
</html>
