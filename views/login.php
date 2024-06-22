<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/resources/css/style.css">
</head>

<body>
<div class="form_wrapper">
    <div class="form_container">
        <div>
            <h2>Login</h2>
        </div>
        <div>
            <div>
                <form action="<?php echo BASE_URL ?>login/signIn" method="POST">
                    <input placeholder="Username" type="text" id="username" name="username" required><br><br>
                    <input placeholder="Password" type="password" id="password" name="password" required><br><br>

                    <div>
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo '<p style="color: red;">Invalid credentials</p>';
                        }
                        ?>
                    </div>

                    <button type="submit">Sign In</button>
                </form>

            </div>
            <div>
                Don't have an account ? <a href="registration">Sign Up</a>
            </div>

        </div>
    </div>
</div>

</body>

</html>