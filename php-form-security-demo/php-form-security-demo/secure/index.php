<?php
declare(strict_types=1);

// SECURE DEMO
// This example demonstrates basic defensive input handling.
// It is intentionally simple so the security controls are easy to study.

session_start();

// Generate a CSRF token once per session.
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errors = [];
$success = false;

$username = '';
$age = '';
$email = '';
$telephone = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read the CSRF token without trusting it.
    $csrfToken = $_POST['csrf_token'] ?? '';

    if (!is_string($csrfToken) || !hash_equals($_SESSION['csrf_token'], $csrfToken)) {
        $errors[] = 'The form session is invalid. Please reload the page and try again.';
    }

    // Read fields as strings.
    $usernameInput = $_POST['username'] ?? '';
    $ageInput = $_POST['age'] ?? '';
    $emailInput = $_POST['email'] ?? '';
    $telephoneInput = $_POST['telephone'] ?? '';

    // Reject unexpected array input.
    if (
        !is_string($usernameInput) ||
        !is_string($ageInput) ||
        !is_string($emailInput) ||
        !is_string($telephoneInput)
    ) {
        $errors[] = 'Invalid form input.';
    } else {
        // Trim surrounding whitespace.
        $username = trim($usernameInput);
        $age = trim($ageInput);
        $email = trim($emailInput);
        $telephone = trim($telephoneInput);

        // Username: allow letters, numbers, spaces, underscore and hyphen.
        if ($username === '') {
            $errors[] = 'Username is required.';
        } elseif (mb_strlen($username) > 50) {
            $errors[] = 'Username must be 50 characters or fewer.';
        } elseif (!preg_match('/^[A-Za-z0-9 _-]+$/', $username)) {
            $errors[] = 'Username contains unsupported characters.';
        }

        // Age: strict integer validation and sensible range.
        $ageValue = filter_var($age, FILTER_VALIDATE_INT, [
            'options' => ['min_range' => 1, 'max_range' => 120]
        ]);

        if ($age === '' || $ageValue === false) {
            $errors[] = 'Age must be an integer from 1 to 120.';
        }

        // Email: validate on the server.
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Enter a valid email address.';
        } elseif (mb_strlen($email) > 254) {
            $errors[] = 'Email address is too long.';
        }

        // Telephone: example international-style validation.
        // Allows +, digits, spaces, parentheses and hyphens.
        if ($telephone === '') {
            $errors[] = 'Telephone is required.';
        } elseif (mb_strlen($telephone) > 25) {
            $errors[] = 'Telephone number is too long.';
        } elseif (!preg_match('/^\+?[0-9 ()-]{7,25}$/', $telephone)) {
            $errors[] = 'Enter a valid telephone number.';
        }

        if (!$errors) {
            $success = true;

            // In a real application, save data using a parameterized database query.
            // Never build SQL using raw form values.
        }
    }
}

/**
 * Escape data before placing it into HTML.
 */
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure PHP Form Demo</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 650px; margin: 40px auto; padding: 20px; }
        label { display:block; margin-top:14px; font-weight:bold; }
        input { width:100%; padding:10px; box-sizing:border-box; margin-top:5px; }
        button { margin-top:18px; padding:10px 18px; }
        .errors, .success { margin-top:20px; padding:15px; }
        .errors { background:#ffe8e8; }
        .success { background:#e8f7e8; }
    </style>
</head>
<body>
    <h1>Secure PHP Form</h1>
    <p>This form demonstrates server-side validation, CSRF protection, and HTML output encoding.</p>

    <?php if ($errors): ?>
        <div class="errors">
            <strong>Please correct the following:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="success">
            <strong>Form accepted.</strong>
            The submitted values passed the validation rules.
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?= e($_SESSION['csrf_token']) ?>">

        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            maxlength="50"
            autocomplete="username"
            value="<?= e($username) ?>"
            required
        >

        <label for="age">Age</label>
        <input
            type="number"
            id="age"
            name="age"
            min="1"
            max="120"
            value="<?= e($age) ?>"
            required
        >

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            maxlength="254"
            autocomplete="email"
            value="<?= e($email) ?>"
            required
        >

        <label for="telephone">Telephone</label>
        <input
            type="tel"
            id="telephone"
            name="telephone"
            maxlength="25"
            autocomplete="tel"
            value="<?= e($telephone) ?>"
            required
        >

        <button type="submit">Submit</button>
    </form>
</body>
</html>
