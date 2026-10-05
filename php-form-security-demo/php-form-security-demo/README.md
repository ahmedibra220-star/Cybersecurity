# PHP Form Security Demo

A small educational project comparing an intentionally **insecure PHP form** with a more defensive **secure PHP form**.

Both forms collect:

- Username
- Age
- Email
- Telephone

## Project structure

```text
php-form-security-demo/
├── insecure/
│   └── index.php
├── secure/
│   └── index.php
└── README.md
```

## Purpose

This project is designed for learning secure web application development and for demonstrating the difference between:

> accepting user input blindly

and

> validating input and encoding output on the server.

The `insecure` directory is intentionally vulnerable and should **only** be run in a controlled local lab.

## 1. Insecure form

`insecure/index.php` intentionally demonstrates poor security practices:

- No CSRF protection
- No server-side validation
- No length restrictions
- No strict type validation
- User-controlled data is printed directly into HTML
- Client-side restrictions are not used as a security boundary

### Why raw output is dangerous

The insecure form contains patterns such as:

```php
echo $username;
```

If an attacker supplies HTML/JavaScript as input, the application places that input directly into the response.

This is the basic pattern behind a reflected/stored **Cross-Site Scripting (XSS)** vulnerability, depending on how the application handles and stores the data.

For example, in a local lab, a harmless test value such as:

```html
<script>alert('XSS demo')</script>
```

can demonstrate why output encoding is necessary.

Do not deploy the insecure version publicly.

## 2. Secure form

`secure/index.php` applies several defensive controls.

### Server-side validation

The server validates every field instead of trusting browser validation.

#### Username

- Required
- Maximum 50 characters
- Restricted character set

#### Age

Uses strict integer validation and accepts only:

```text
1–120
```

#### Email

Uses PHP's:

```php
filter_var($email, FILTER_VALIDATE_EMAIL)
```

#### Telephone

Uses a server-side allowlist for a basic international-style telephone format.

## 3. Output encoding

The secure form defines:

```php
function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
```

User-controlled values are then encoded before being inserted into HTML:

```php
<?= e($username) ?>
```

This is an important defense against HTML-context XSS.

## 4. CSRF protection

The secure form creates a cryptographically random token:

```php
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
```

The token is included in the form and verified using:

```php
hash_equals()
```

This helps prevent another site from submitting unauthorized requests on behalf of a user's authenticated browser session.

## 5. Client-side vs server-side validation

The secure form uses HTML attributes such as:

```html
required
maxlength="50"
min="1"
max="120"
type="email"
```

These improve usability, but they are **not security controls by themselves**.

An attacker can bypass browser validation by sending an HTTP request directly.

Therefore:

```text
Browser validation
        ↓
   User experience

Server-side validation
        ↓
   Security boundary
```

## 6. Database security

This project does not connect to a database.

If you later add MySQL/MariaDB, do **not** construct SQL queries using raw form values.

Bad:

```php
$sql = "INSERT INTO users (username) VALUES ('$username')";
```

Use PDO prepared statements instead:

```php
$stmt = $pdo->prepare(
    'INSERT INTO users (username, age, email, telephone)
     VALUES (:username, :age, :email, :telephone)'
);

$stmt->execute([
    ':username' => $username,
    ':age' => $ageValue,
    ':email' => $email,
    ':telephone' => $telephone
]);
```

Prepared statements protect the SQL query structure from user-controlled values.

## 7. Running locally

You need PHP installed.

From the project directory:

```bash
php -S localhost:8000 -t insecure
```

Then open:

```text
http://localhost:8000
```

Stop the server with `Ctrl+C`.

Run the secure version:

```bash
php -S localhost:8000 -t secure
```

Then open:

```text
http://localhost:8000
```

## 8. Suggested security testing

Run both versions locally and compare their behavior.

### Test normal input

```text
Username: Ahmed
Age: 22
Email: ahmed@example.com
Telephone: +252 63 0000000
```

### Test boundary values

Try:

```text
Age: 0
Age: 121
Age: -1
Age: abc
```

### Test oversized input

Submit a username significantly longer than the allowed length.

### Test malformed email

Examples:

```text
hello
hello@
@example.com
```

### Test HTML/XSS handling

In the local insecure application, try a harmless XSS demonstration:

```html
<script>alert('XSS demo')</script>
```

The important comparison is that the secure application treats the value as data and HTML-encodes it rather than interpreting it as markup.

Only perform these tests against systems you own or are explicitly authorized to test.

## 9. Security comparison

| Control | Insecure | Secure |
|---|---:|---:|
| Server-side validation | ❌ | ✅ |
| Username length limit | ❌ | ✅ |
| Age range validation | ❌ | ✅ |
| Email validation | ❌ | ✅ |
| Telephone validation | ❌ | ✅ |
| Output encoding | ❌ | ✅ |
| CSRF token | ❌ | ✅ |
| Strict input handling | ❌ | ✅ |
| Database prepared statements | N/A | Recommended |
| Safe for production | ❌ | Not by itself |

## Important note

The secure version is an **educational baseline**, not a complete production security architecture.

A production application may additionally require:

- HTTPS
- Secure session cookie attributes
- Authentication and authorization
- Rate limiting
- Content Security Policy (CSP)
- Security headers
- Centralized logging and monitoring
- Database constraints
- Prepared statements
- Password hashing where passwords are used
- Session fixation protection
- Appropriate input/output validation for each data context
- Dependency and PHP version management

## License

Use this project for educational and authorized security testing.
