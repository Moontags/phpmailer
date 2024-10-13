# Contact Form with PHPMailer

This project is a PHP-based contact form that uses PHPMailer to send emails via Gmail's SMTP server. The form includes fields for the user's name, email, subject, and message. The script validates the user's input and sends an email to a predefined recipient.

## Features

- **PHPMailer Integration**: Uses PHPMailer to send emails through Gmail's SMTP server.
- **Form Validation**: Validates the user's email address format and checks that all required fields are filled.
- **Error Handling**: Displays error messages for missing fields or invalid email formats.
- **Security Considerations**: This script contains essential security measures, but some additional steps are necessary to ensure it's secure in a production environment (see Security section below).

## Requirements

- PHP 7.4 or higher
- PHPMailer (installed via Composer or manually)
- A Gmail account (or other SMTP provider)

## Installation

1. Clone or download this repository to your local machine.
2. Ensure PHPMailer is installed. You can install it via Composer:

   ```bash
   composer require phpmailer/phpmailer
   ```

3. Update the email credentials in the script:

   ```php
   $mail->Username = 'your_email@gmail.com'; // Your Gmail address
   $mail->Password = 'your_app_password'; // Your Gmail app password
   ```

4. Ensure that your Gmail account allows less secure apps or use an app-specific password if 2FA is enabled.

## Usage

1. Place the contact form in your project directory.
2. Update the email address where you want to receive the form submissions:

   ```php
   $mail->addAddress('your_receiver_email@gmail.com');
   ```

3. Make sure the form is correctly pointing to this PHP file as the action handler.
4. Open the form in a browser and submit a test message.

## Security

To ensure the security of this contact form, several measures should be considered:

### During Development

- **Error Reporting**: The script uses `ini_set('display_errors', 1);` for debugging purposes. **Disable this in production** by either removing these lines or setting `display_errors` to `0`. In a production environment, logging errors to a file is a safer option.

  ```php
  ini_set('display_errors', 0);
  error_log("Error Message", 3, "/path/to/error.log");
  ```

### Sensitive Data Protection

- **Never Hardcode Credentials**: Avoid hardcoding credentials (e.g., `$mail->Password`) directly in your scripts. Use environment variables or a secure configuration file that is not exposed to the public:

  ```php
  $mail->Username = getenv('MAIL_USERNAME');
  $mail->Password = getenv('MAIL_PASSWORD');
  ```

- **Use App Passwords**: If you are using Gmail, generate an **app password** instead of using your regular Gmail password. This limits access to your account and increases security.

### Server-Side Validation

- **Input Validation**: The script currently checks for empty fields and validates email addresses. You may want to add additional validation and sanitation to prevent injection attacks or other malicious inputs.

  Example of additional input sanitization:

  ```php
  $name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);
  ```

- **Email Injection Protection**: Ensure that fields such as `$name` and `$email` do not contain malicious content, such as line breaks that could be used in email header injection.

### Secure Connection

- **HTTPS**: Ensure your website is served over HTTPS to protect the data transmitted between the client and the server.
- **SMTP Encryption**: PHPMailer uses SSL/TLS for SMTP encryption. Make sure this remains enabled (`$mail->SMTPSecure = 'ssl';` or `tls`) to secure email communication.

### Deployment

- **Server Configuration**: Ensure the server has secure PHP settings:
  - Disable `display_errors` in `php.ini` on a production server.
  - Set `open_basedir` and other directory access restrictions to limit PHP’s access to sensitive files.
- **File Permissions**: Limit file permissions to prevent unauthorized access to configuration files. For example, use `chmod 644` for most PHP files and `chmod 600` for configuration files.

### Future Enhancements

- **CAPTCHA Integration**: To prevent spam submissions, integrate a CAPTCHA solution like Google reCAPTCHA.
- **Rate Limiting**: Implement rate-limiting to prevent automated abuse of the contact form.

## License

This project is licensed under the MIT License.

## License

This project is licensed under the [GPL Cooperation Commitment](https://gplcc.github.io/gplcc/).

For more details, please refer to the [GPL Cooperation Commitment full text](https://gplcc.github.io/gplcc/).
