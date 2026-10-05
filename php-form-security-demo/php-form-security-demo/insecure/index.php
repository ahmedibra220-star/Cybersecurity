<?php
// INSECURE DEMO - intentionally vulnerable.
// Do NOT use this pattern in production.

$username = $_POST['username'] ?? '';
$age = $_POST['age'] ?? '';
$email = $_POST['email'] ?? '';
$telephone = $_POST['telephone'] ?? '';

$submitted = $_SERVER['REQUEST_METHOD'] === 'POST';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insecure PHP Form Demo</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 650px; margin: 40px auto; padding: 20px; }
        label { display:block; margin-top: 14px; font-weight:bold; }
        input { width:100%; padding:10px; box-sizing:border-box; margin-top:5px; }
        button { margin-top:18px; padding:10px 18px; }
        .result { margin-top:25px; padding:15px; background:#f3f3f3; }
        .warning { color:#a00; }
    </style>
</head>
<body>
    <h1>Insecure PHP Form</h1>
    <p class="warning">Training demo only. This form intentionally uses unsafe patterns.</p>

    <form method="POST">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">

        <label for="age">Age</label>
        <input type="text" id="age" name="age">

        <label for="email">Email</label>
        <input type="text" id="email" name="email">

        <label for="telephone">Telephone</label>
        <input type="text" id="telephone" name="telephone">

        <button type="submit">Submit</button>
    </form>

    <?php if ($submitted): ?>
        <div class="result">
            <h2>Submitted Data</h2>

            <!-- INTENTIONALLY UNSAFE: raw user input is written into HTML. -->
            <p>Username: <?php echo $username; ?></p>

            <!-- INTENTIONALLY UNSAFE: no type/range validation. -->
            <p>Age: <?php echo $age; ?></p>

            <!-- INTENTIONALLY UNSAFE: no server-side email validation. -->
            <p>Email: <?php echo $email; ?></p>

            <!-- INTENTIONALLY UNSAFE: no server-side telephone validation. -->
            <p>Telephone: <?php echo $telephone; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
