<?php
$mode = $mode ?? "insertion";
require "views/errors_form.html.php";
require_once "public/header.html.php";
?>

<div class="box2"></div>
<div class="register">
    <div>
        <img src=<?= ROOT . "public/assets/img/register/9af5b39a70de1509eb2300a0328fe5b1.jpg"; ?> alt="" />
    </div>
    <div class="reg">
        <div class="titlereg">
            <h2>Register</h2>
        </div>
        <form method="POST">
            <input type="text" name="name" class="name" placeholder="&nbsp; N &nbsp; A &nbsp; M &nbsp; E" />
            <label for="name"></label>
            <br />
            <br />
            <input type="email" placeholder="&nbsp; E &nbsp; M &nbsp; A &nbsp; I &nbsp; L" class="email" name="email" />
            <label for="email"></label>
            <br />
            <br />
            <input type="password" placeholder="&nbsp; P &nbsp; A &nbsp; S &nbsp; S &nbsp; W &nbsp; O &nbsp; R &nbsp; D"
                class="pw" name="password" />
            <label for="password"></label>
            <br />
            <br />
            <button type="submit" class="cpw" name="submit" value="submit">Submit</button>
            <br />
            <br />
            <input type="checkbox" class="remb" name="check" id="check" required />
            <label for="check" class="regb">I accept the terms & conditions</label>
        </form>
    </div>
</div>
<?php
require_once "public/footer.html.php";
?>
<script>
    document.getElementById('myForm').addEventListener('submit', function (event) {
        if (!document.getElementById('check').checked) {
            alert('Please accept the terms and conditions.');
            event.preventDefault(); // Prevent the form from submitting
        }
    });
</script>