<!DOCTYPE html>
<html>
<head>
    <?php include('header.php'); ?>
    <title>Custommvc Login Form</title>
</head>

<body>
<?php if (isset($_SESSION['member']['name'])): ?>
    <div class="parent">
        <div class="cikis">
            <h1>Iyimisin <?= $_SESSION['member']['name'] ?></h1>
            <button id="logout_button"> Cikis Yap</button>
        </div>
    </div>

<?php else: ?>
    <div class="parent">
        <h1 class="login_title">Login Pages</h1>
        <form method="post" action="/member/login" class="form--login">
            <div class="form">
                <input type="text" placeholder="Enter Name" name="name" required>
                <input type="password" placeholder="Enter Password" name="password" required>
                <button type="submit" id="submit_form">Login</button>
            </div>
        </form>
    </div>
<?php endif; ?>
</body>

</html>
