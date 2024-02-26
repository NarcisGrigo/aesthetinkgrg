<?php
// require "views/errors_form.html.php";
require_once "/xampp/htdocs/aesthetink/public/header.html.php";
?>

<body>
    <main>
        <div class="box"></div>
        <div class="lgin">
            <div>
                <h2>Login</h2>
            </div>
            <form method="POST">
                <input type="email" placeholder="&nbsp E &nbsp M &nbsp A &nbsp I &nbsp L" class="email" name="email" />
                <label for="email"></label>
                <br />
                <br />
                <input type="password" placeholder="&nbsp P &nbsp A &nbsp S &nbsp S &nbsp W &nbsp O &nbsp R &nbsp D"
                    class="pw" name="password" />
                <label for="password"></label>
                <br />
                <br />
                <button type="submit" class="cpw" name="submit" value="submit">Login</button>
                <input type="checkbox" class="checkb" name="check" />
                <label for="checkbox" class="check">Remember me</label>
            </form>
        </div>
        <div>
            <img src="/aesthetink/public/assets/img/d3090dde93588424e7563d5b40a0a795.jpg" alt="" class="hands" />
        </div>
    </main>
</body>