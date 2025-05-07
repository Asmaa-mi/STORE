<?php
$servername = "localhost";
$username = "root";
$email = "";
$age = "";
$password = "";
$confirm_password = "";
$databaseName = "mystore";
$errors = [];

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if($_SERVER['REQUEST_METHOD']== "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $age = trim($_POST["age"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    if(empty($username)) {
        $errors['username'] = "Username is required";
    }
    if(empty($email)) {
        $errors['email'] = "Email is required";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format"; 
    }
    if(empty($age)) {
        $errors['age'] = "Age is required";
    }
    elseif(!is_numeric($age)) {
        $errors['age'] = "Age must be number";
    }
    elseif($age < 18) {
        $errors['age'] = "You must be at least 18 year old";
    }
    if(empty($password)) {
        $errors['password'] = "Password is required";
    }
    elseif(strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    }
    if(empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm_Password is required";
    }
    elseif($password != $confirm_password) {
        $errors['confirm_password'] = "Password do not match";
    }
    if(empty($errors)) {
        echo "<h3>Create Account Successfuly</h3>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Form</h1>
    <form method="POST">
        <div>
          <label for="username">Username</label>
          <input type="text" name="username" id="username" value="<?=htmlspecialchars($username);?>">
        </div>
        <div>
            <?php if(isset($errors['username'])) : ?>
                <p style="color : red;"><?= $errors['username']?></p>
                <?php endif;  ?>
        </div>
        <br>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?= htmlspecialchars($email);?>">
        </div>
        <div>
            <?php if(isset($errors['email'])) : ?>
                <p style="color : red;"><?= $errors['email']?></p>
                <?php endif;  ?>
        </div>
        <br>
        <div>
            <label for="age">Age</label>
            <input type="number" name="age" id="age" value="<?= htmlspecialchars($age);?>">
        </div>
        <div>
            <?php if(isset($errors['age'])) : ?> 
                <p style="color : red;"><?= $errors['age']?></p>
                <?php endif;  ?>
        </div>
        <br>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <?php if(isset($errors['password'])) : ?>
                <p style="color : red;"><?= $errors['password']?></p>
                <?php endif;  ?>
        </div>
        <br>
        <div>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password">
        </div>
        <div>
            <?php if(isset($errors['confirm_password'])) : ?>
                <p style="color : red;"><?= $errors['confirm_password']?></p>
                <?php endif;  ?>
        </div>
        <br>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>