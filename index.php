<?php
    include_once 'PasswordGenerator.php';

    if (isset($_POST['submit'])) {
        session_start();
        $type                  = $_POST['pw_type'];
        $length                = $_POST['pw_length'];
        $_SESSION['pw_type']   = $type;
        $_SESSION['pw_length'] = $length;
        $passwordGenerator     = new PasswordGenerator($type, $length);
        $password              = $passwordGenerator->createPassword();
    } else {
        $type   = $_SESSION['pw_type']   ?? 'some_symbols';
        $length = $_SESSION['pw_length'] ?? 8;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Generator</title>
    <meta charset="utf-8">
    <meta author="Bünyamin Eskiocak">
    <meta keywords="Password,Generator,Creator">
    <meta description="A tool to generate a random password.">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Password Generator</h1>
    <p>Welcome to the password generator. Please select which kind of password you want to use.</p>
    <form method="POST">
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                id="numbers"
                name="pw_type"
                value="numbers"
                <?php echo $type === 'numbers' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="numbers">
                Numbers
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                id="letters"
                name="pw_type"
                value="letters"
                <?php echo $type === 'letters' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="letters">
                Characters
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                id="no_symbols"
                name="pw_type"
                value="no_symbols"
                <?php echo $type === 'no_symbols' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="no_symbols">
                Characters and numbers
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                id="some_symbols"
                name="pw_type"
                value="some_symbols"
                <?php echo $type === 'some_symbols' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="some_symbols">
                Characters, numbers and usual symbols
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                id="all"
                name="pw_type"
                value="all"
                <?php echo $type === 'all' ? 'checked' : '' ?>
            >
            <label class="form-check-label" for="all">
                Characters, numbers and all symbols
            </label>
        </div><br>
        <input type="number" name="pw_length" min="1" max="1000" value="<?php echo $length; ?>" required><br><br>
        <button type="submit" name="submit" class="btn btn-primary">Generate Password</button><br><br>
        <p>Password: <span class="pw-box"><?php echo $password ?? ''; ?></span></p>
    </form>
</body>
</html>
