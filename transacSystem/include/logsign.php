<style>

.signupPanel-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    width: 100%;
}

.panelMain{
    display: block;
	width: 30em;
	height: 35em;
	background: red;
	overflow: hidden;
    background-color: #5a5a5a;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000;
    justify-content: center;
    align-items: center;
}

#chk{
	display: none;
}

.signup{
	position: relative;
	width:100%;
	height: 100%;
}

.signupPanel-moreInfo {
    color: #fff;
    text-align: center;
}

.signupPanel label, .loginPanel label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}

.panelMain input{
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}

.signupPanel button, .loginPanel button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: var(--theme-col);
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}

.signupPanel button:hover, .loginPanel button:hover{
	background: var(--theme-col);
}

.login{
	height: 460px;
	background: #eee;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}

.login label{
	color: var(--theme-col);
	transform: scale(.6);
}


#chk:checked ~ .login{
	transform: translateY(-500px);
}

#chk:checked ~ .login label{
	transform: scale(1);	
}

#chk:checked ~ .signup label{
	transform: scale(.6);
}

.modal {
    display: none;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    opacity: 0;
    transition: opacity 0.5s ease;
}

.closeBtn {
    position: absolute;
    top: -7%;
    right: 30%;
    font-size: 7em;
    font-weight: bold;
    cursor: pointer;
    text-shadow: 2px 2px 1px #eebc1d;
}

/*==========Add Form==========*/

body.addForm {
    height: 100vh;
}
</style>

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
