<?php
$email="";
if($_SERVER['REQUEST_METHOD']== "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    if(empty($email)) {
        $errors['email'] = "Email is required";
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format"; 
    }
    if(empty($password)) {
        $errors['password'] = "Password is required";
    }
    elseif(strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters long";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
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
            <button type="submit">Submit</button>
        </div>
        <br>
        <a href="register.php">Create Account</a>
    </form>
</body>
</html>