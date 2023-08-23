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
        rel="stylesheet"
        media="(prefers-color-scheme:light)"
        href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.8.0/cdn/themes/light.css"
    />
    <link
        rel="stylesheet"
        media="(prefers-color-scheme:dark)"
        href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.8.0/cdn/themes/dark.css"
        onload="document.documentElement.classList.add('sl-theme-dark');"
    />
    <script type="module" src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.8.0/cdn/shoelace-autoloader.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Password Generator</h1>
    <p>Welcome to the password generator. Please select which kind of password you want to use.</p>
    <form method="post">
        <sl-radio-group
            name="pw_type"
            value="<?= $type ?>"
        >
            <sl-radio value="numbers">Numbers</sl-radio>
            <sl-radio value="letters">Characters</sl-radio>
            <sl-radio value="no_symbols">Characters and numbers</sl-radio>
            <sl-radio value="some_symbols">Characters, numbers and usual symbols</sl-radio>
            <sl-radio value="all">Characters, numbers and all symbols</sl-radio>
        </sl-radio-group>
        <sl-input
            type="number"
            name="pw_length"
            min="1"
            max="1000"
            value="<?= $length ?>"
            required
        ></sl-input>
        <sl-button
            type="submit"
            name="submit"
            variant="primary"
        >Generate Password</sl-button>
        <p>
            Password: <span id="pw-box"><?= $password ?? '' ?></span>
            <sl-copy-button from="pw-box"></sl-copy-button>
        </p>
    </form>
</body>
</html>
