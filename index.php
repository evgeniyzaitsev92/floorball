<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Floorball</title>

    <!--  CSS  -->
    <link rel="stylesheet" href="/styles/normalise.css">
    <link rel="stylesheet" href="/styles/style.css">

    <!--  JS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!--  ШРИФТЫ  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include_once "common.php";
    setHeader();
    ?>

    <section class="main container">
        <div class="main-container d-grid">
            <div class="main-item">
                <img class="main-item--img" src="images/floorball-pro.jpg">
                <div class="main-item--text d-flex">
                    <a href="">Для профессионалов...</a>
                    <img src="icons/about.svg">
                </div>
            </div>

            <div class="main-item">
                <img class="main-item--img" src="images/floorball-girls.jpg">
                <div class="main-item--text">
                    <a href="">любителей...</a>
                    <img src="icons/about.svg">
                </div>
            </div>

            <div class="main-item">
                <img class="main-item--img" src="images/floorball-boys.jpg">
                <div class="main-item--text">
                    <a href="">школ, ФОКов, спортсменов других видов спорта...</a>
                    <img src="icons/about.svg">
                </div>
            </div>

            <div class="main-item">
                <img class="main-item--img" src="images/floorball-parents-children.png">
                <div class="main-item--text">
                    <a href="">самых маленьких (первая самая лучшая клюшка)</a>
                    <img src="icons/about.svg">
                </div>
            </div>
        </div>
    </section>

    <?php
    setFooter();
    ?>
</body>
</html>