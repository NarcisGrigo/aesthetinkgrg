<?php
require_once "public/header.html.php";
?>

<body class="artistbody">

    <form action="logout.php" method="POST">
        <input type="submit" class="logout custom-button" value="Logout"
            style="background-color: #1b201e; color:#ffd700; width:120px; height:35px; font-family: Raleway, sans-serif; font-size:25px; border:none; outline:none; box-shadow:none; cursor:pointer;">
    </form>
    <h2 class="value">The value we offer</h2>
    <div class="artistpg">
        <img src=<?= ROOT . "public/assets/img/stephane.jpg"; ?> alt="artist" class="artists"/>
        <img src=<?= ROOT . "public/assets/img/aladino.jpg"; ?> alt="artist" class="artists" />
        <img src=<?= ROOT . "public/assets/img/alisya.jpg"; ?> alt="artist" class="artists" />
        <img src=<?= ROOT . "public/assets/img/howard.jpg"; ?> alt="artist" class="artists" />
    </div>
    <div class="nameartist">
        <p class="stph">Stephane</p>
        <p class="alad">Aladino</p>
        <p class="alisy">Alisya</p>
        <p class="howa">Howard</p>
    </div>
    <div class="nameartist">
        <p class="stph">Myers</p>
        <p class="alad">Gosling</p>
        <p class="alisy">Keys</p>
        <p class="howa">Ledger</p>
    </div>
    <h2 class="finds">Where to find us</h2>
    <div class="borderblk"></div>
    <div class="findmap">
        <img src="/aesthetinkmvc/public/assets/img/Sydney-Map.jpg" alt="" class="maps" />
        <div class="lorem">
            <h4 class="bking">Booking needed</h4>
            <br />
            <p class="mrgin">Sed ut perspiciatis unde omnis</p>
            <p class="mrgin">iste natus error sit voluptatem</p>
            <p class="mrgin">accusantium doloremque</p>
            <p class="mrgin">laudantium, totam rem aperiam,</p>
            <p class="mrgin">eaque ipsa quae ab illo inventore</p>
            <p class="mrgin">veritatis et quasi architecto</p>
            <p class="mrgin">beatae vitae dicta sunt</p>
            <p class="mrgin">explicabo.</p>
        </div>
    </div>
</body>
<?php
require_once "public/footer.html.php";
?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script> -->