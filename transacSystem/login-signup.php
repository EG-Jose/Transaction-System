<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Signup</title>

    <link rel="stylesheet" type="text/css" href="css/main4.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <script src="https://kit.fontawesome.com/b9d5bac5fa.js" crossorigin="anonymous"></script>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
        }

        .modal {
            display: block;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            opacity: 1;
            transition: opacity 0.5s ease;
        }
    </style>
</head>
<body>

    <?php include 'include/header.php'; ?>

<div class="container">

<div id="logsignModal" class="modal">
    <span class="closeBtn" onclick="closeModal()">&times;</span>
<div class="signupPanel-container">
    <div class="panelMain">
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form class="signupPanel" action="process/process-signup.php" method="post" id="signup" novalidate>
					<label for="chk" aria-hidden="true">Sign up</label>
                    <p class="signupPanel-moreInfo">Click Login if you have already signed up</p>
					    <?php if (!empty($_SESSION['form_errors']['name'])): ?>
                            <span class="warning-message"><?= $_SESSION['form_errors']['name'] ?></span>
                        <?php endif; ?>
                    <input type="text" name="name" id="name" placeholder="Name" autocomplete="off" required>

				        <?php if (!empty($_SESSION['form_errors']['email'])): ?>
                            <span class="warning-message"><?= $_SESSION['form_errors']['email'] ?></span>
                        <?php endif; ?>
                    <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>

                        <?php if (!empty($_SESSION['form_errors']['password'])): ?>
                            <span class="warning-message"><?= $_SESSION['form_errors']['password'] ?></span>
                        <?php endif; ?>
					<input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>

					<input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password" autocomplete="off" required>
					<button>Sign up</button>
				</form>
			</div>
			<div class="login">
				<form class="loginPanel" action="process/process-login.php" method="post" id="login">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
	</div>
</div>
</div>

</div>

    <?php include 'include/logsign.php'; ?>

<footer>
    <?php include 'include/footer.php'; ?>
</footer>

<script type="text/javascript" src="js/scripties.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        showModal();
    });

    function showModal() {
        var modal = document.getElementById('logsignModal');
        modal.style.display = 'block';
    }

    function closeModal() {
        var modal = document.getElementById('logsignModal');
        modal.style.display = 'none';
    }
</script>
    
</body>
</html>