<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/resources/css/style.css">

</head>
<body>

<div class="form_wrapper">
    <div class="form_container">
        <div>
            <h2>Registration</h2>
        </div>
        <div>
            <div>
                <form action="<?= BASE_URL ?>registration/signUp" method="POST">
                    <div>
                        <div>
                            <label for="username">Username</label>
                        </div>
                        <input type="text" id="username" name="username" required><br><br>
                    </div>
                    <div>
                        <div>
                            <label for="dateOfBirth">Date Of Birth</label>
                        </div>
                        <input type="date" id="dateOfBirth" name="dateOfBirth" required><br><br>
                    </div>
                    <div>
                        <div>
                            <label for="password">Password</label>
                        </div>
                        <input type="password" id="password" name="password" required><br><br>
                    </div>

                    <div>

                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo "<p style='color: red;'>$error</p>";
                        }
                        ?>
                    </div>

                    <button type="submit">Sign Up</button>
                </form>
            </div>
            <div>
                Do you have an account ? <a href="login">Sign In</a>
            </div>

        </div>
    </div>
</div>
</body>
</html>
