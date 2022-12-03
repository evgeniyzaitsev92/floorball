<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Каталог</title>
    <link rel="stylesheet" href="/styles/normalise.css">
    <link rel="stylesheet" href="/styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="plugins/galleria/galleria.js"></script>
</head>
<body>
<!-- ТУТ ХЭДЭР -->
    <header class="d-flex flex-dir-col ai-cntr">
        <nav class="header-menu">
            <ul>
                <li><a href="catalog.php"><i class="fa"></i>Каталог</a>
                    <ul>
                        <li><a href="catalog.php?brand=UNIHOC&type=sticks">Клюшки</a>
                        <li><a href="catalog.php?brand=UNIHOC&type=balls">Мячи</a>
                    </ul>
                </li>
                <li><a href="product-manage.php"><i class="fa"></i>Добавить карточку товара</a></li>
            </ul>
        </nav>

        <!-- ПОИСК ТОВАРОВ ПО СЛОВАМ -->
        <form class="search-by-word">
            <label id="search_by_word"><input id="search_by_word_input" type="text" name="search_by_word" placeholder="Поиск товара..."></label>
            <button id="search_by_word_btn" type="submit">Найти</button>
        </form>
    </header>

    <?php
    include_once "devtools.php";
    // *** Поиск товаров по фильтрам *** \\
    $searchByWord = false;
    $type = $typeCat = $brand = null;
    $cardsArray = [];
    $paramsCount = 0;
    $baseSQL = "SELECT p_vendor_code, p_name, p_price, p_discount, p_price_with_discount, p_images FROM prods WHERE ";
    $params = [];

    if(isset($_GET["brand"])){
        $brand = $_GET["brand"];
        $baseSQL .= "p_brand='$brand' ";
    }

    if(isset($_GET["series"])){
        $baseSQL .= "AND p_series='".$_GET["series"]."'";
    }

    if(isset($_GET["type"])){
        $type = $_GET["type"];
        $baseSQL .= "AND p_type=:p_type";

        if ($type == "sticks") {
            $typeCat = "Клюшки";
            $params[':p_type'] = "Клюшка";

            // Жёсткость
            if(isset($_GET["rigid24"])) {$paramsCount++; $baseSQL .= " AND p_rigid='24'";} if(isset($_GET["rigid26"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='26'";}
            if(isset($_GET["rigid27"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='27'";} if(isset($_GET["rigid28"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='28'";}
            if(isset($_GET["rigid29"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='29'";} if(isset($_GET["rigid30"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='30'";}
            if(isset($_GET["rigid32"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='32'";} if(isset($_GET["rigid34"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='34'";}
            if(isset($_GET["rigid35"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='35'";} if(isset($_GET["rigid36"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_rigid='36'";}

            // Длина
            if(isset($_GET["length55"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='55'";} if(isset($_GET["length60"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='60'";}
            if(isset($_GET["length65"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='65'";} if(isset($_GET["length70"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='70'";}
            if(isset($_GET["length75"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='75'";} if(isset($_GET["length80"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='80'";}
            if(isset($_GET["length83"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='83'";} if(isset($_GET["length87"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='87'";}
            if(isset($_GET["length92"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='92'";} if(isset($_GET["length96"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='96'";}
            if(isset($_GET["length100"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='100'";} if(isset($_GET["length104"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='104'";}
            if(isset($_GET["length110"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_length='110'";}

            // Хват
            if(isset($_GET["grab-left"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_grab='левый'";}
            if(isset($_GET["grab-right"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_grab='правый'";}
            if(isset($_GET["grab-both"])) {$paramsCount++; $baseSQL .= (($paramsCount==1)?" AND":" OR")." p_grab='с обеих сторон'";}

        } else if ($type == "balls") {
            $typeCat = "Мячи";
            $params[':p_type'] = "Мяч";
        }
    }

    // *** Поиск товаров по словам *** \\
    if(isset($_GET["search_by_word"])){
        $searchByWord = true;
    }
    ?>

    <section class="container d-grid catalog-main">
        <!-- ФИЛЬТРЫ -->
        <div class="catalog-filters">
            <div class="">
                <form method="GET">
                    <div class="d-flex">
                        <a href="catalog.php">Каталог</a>
                        <a href="catalog.php?brand=UNIHOC"><?php echo $brand; ?><input hidden type="text" name="brand" value="<?php echo $brand; ?>"></a>
                        <?php if($type != null){ echo '<a href="catalog.php?type='.$type.'">'.$typeCat.'<input hidden type="text" name="type" value="'.$type.'"></a>';} ?>

                    </div>

                    <nav class="catalog-series">Клюшки
                        <ul>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=EVOLAB">EVOLAB</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=CARBSKIN">CARBSKIN</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=CARBSKIN CURVE">CARBSKIN CURVE</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=SUPERSKIN">SUPERSKIN</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=SIGNATURE SERIES">SIGNATURE SERIES</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=ECO">ECO</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=SUPERSHAPE">SUPERSHAPE</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=TITAN SERIES">TITAN SERIES</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=OVAL SERIES">OVAL SERIES</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=COMPOSITE">COMPOSITE</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=COMPOSITE SERIES">COMPOSITE SERIES</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=COMPOSITE YOUNGSTER">COMPOSITE YOUNGSTER</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=PLAYER">PLAYER</a></li>
                            <li><a href="catalog.php?brand=UNIHOC&type=sticks&series=ZORRO">ZORRO</a></li>
                        </ul>
                    </nav>

                <?php
                if ($type == "sticks") {
                    echo '
                        <div class="catalog-filters--sticks-rigid">
                            <h3>ЖЁСТКОСТЬ (ММ)</h3>
                            <div class="d-grid catalog-filters--sticks-rigid-items">
                                <label><input type="checkbox" name="rigid24" value="24"><span>24</span></label>
                                <label><input type="checkbox" name="rigid26" value="26"><span>26</span></label>
                                <label><input type="checkbox" name="rigid27" value="27"><span>27</span></label>
                                <label><input type="checkbox" name="rigid28" value="28"><span>28</span></label>
                                <label><input type="checkbox" name="rigid29" value="29"><span>29</span></label>
                                <label><input type="checkbox" name="rigid30" value="30"><span>30</span></label>
                                <label><input type="checkbox" name="rigid32" value="32"><span>32</span></label>
                                <label><input type="checkbox" name="rigid34" value="34"><span>34</span></label>
                                <label><input type="checkbox" name="rigid35" value="35"><span>35</span></label>
                                <label><input type="checkbox" name="rigid36" value="36"><span>36</span></label>
                            </div>
                        </div>
                        
                        <div class="catalog-filters--sticks-length">
                            <h3>ДЛИНА РУКОЯТКИ (СМ)</h3>
                            <div class="d-grid catalog-filters--sticks-length-items">
                                <label><input type="checkbox" name="length55" value="55"><span>55</span></label>
                                <label><input type="checkbox" name="length60" value="60"><span>60</span></label>
                                <label><input type="checkbox" name="length65" value="65"><span>65</span></label>
                                <label><input type="checkbox" name="length70" value="70"><span>70</span></label>
                                <label><input type="checkbox" name="length75" value="75"><span>75</span></label>
                                <label><input type="checkbox" name="length80" value="80"><span>80</span></label>
                                <label><input type="checkbox" name="length83" value="83"><span>83</span></label>
                                <label><input type="checkbox" name="length87" value="87"><span>87</span></label>
                                <label><input type="checkbox" name="length92" value="92"><span>92</span></label>
                                <label><input type="checkbox" name="length96" value="96"><span>96</span></label>
                                <label><input type="checkbox" name="length100" value="100"><span>100</span></label>
                                <label><input type="checkbox" name="length104" value="104"><span>104</span></label>
                                <label><input type="checkbox" name="length110" value="110"><span>110</span></label>
                            </div>
                            
                            <div class="catalog-filters--sticks-grab">
                                <h3>ХВАТ (ИГРОВАЯ СТОРОНА)</h3>
                                <div class="d-grid catalog-filters--sticks-grab-items">
                                    <label><input type="checkbox" name="grab-left" value="Левый"><span>Левый</span></label>
                                    <label><input type="checkbox" name="grab-right" value="Правый"><span>Правый</span></label>
                                    <label><input type="checkbox" name="grab-both" value="С обеих сторон"><span>С обеих сторон</span></label>
                                </div>
                            </div>
                        </div>
                    ';
                }
                ?>
                    <button id="search_btn" type="submit">ПОИСК</button>
                </form>
            </div>
        </div>

        <!-- КАРТОЧКИ -->
        <div class="d-grid catalog-viewer">
            <?php
            // *** Получаем параметры из БД *** \\
            // Переводим значения из БД в верхний регистр, необходимо для сравнения кириллицы при поиске
            function toUpperCase($string): string { return mb_strtoupper($string); }

            $conn  = new PDO('sqlite:database/cards.sqlite') or die("Cannot open the database");

            // Поиск по слову
            if($searchByWord == true){
                $conn->sqliteCreateFunction('toUpC', 'toUpperCase', 1);
                $word = mb_strtoupper($_GET["search_by_word"]);
                $baseSQL .= "toUpC(p_type) LIKE '%$word%' OR toUpC(p_name) LIKE '%$word%' OR toUpC(p_brand) LIKE '%$word%' 
                OR toUpC(p_trademark) LIKE '%$word%' OR toUpC(p_model) LIKE '%$word%' OR toUpC(p_spec) LIKE '%$word%' 
                OR toUpC(p_color) LIKE '%$word%' OR toUpC(p_series) LIKE '%$word%' OR toUpC(p_handle) LIKE '%$word%' 
                OR toUpC(p_handle) LIKE '%$word%' OR toUpC(p_handle_mat) LIKE '%$word%' OR toUpC(p_handle_mat) LIKE '%$word%'";
            }
            $stmt = $conn->prepare($baseSQL);
            $stmt->execute($params);
            $cardsArray = $stmt->fetchAll();
            $conn=null;
            $num = 0;

            // Выводим карточки
            foreach($cardsArray as $card)
            {
                echo '<div class="prod-card d-flex flex-dir-col">
                    <span id="prod-card--price'.$num.'" class="prod-card--price"></span>';
                if($card[5]!=""){
                    echo '<div class="galleria">';
                    $imgArr = json_decode($card[5]);
                    for($i=0; $i<count($imgArr); $i++){
                        echo '<img src="'.$imgArr[$i].'" class="p_images_common">';
                    };
                    echo '</div>';
                }
                echo '<a href="" id="prod-card--name'.$num.'" class="prod-card--name"></a>
                    <a href="" id="prod-card--edit'.$num.'" class="prod-card--edit">Редактировать</a>
                 </div>
      
                <script>
                    document.getElementById("prod-card--edit'.$num.'").href = "product-manage.php?search_by_vendor_code='.$card[0].'";
                    document.getElementById("prod-card--name'.$num.'").href = "product.php?search_by_vendor_code='.$card[0].'";
                    document.getElementById("prod-card--name'.$num.'").textContent = "'.$card[1].'";
                    document.getElementById("prod-card--price'.$num.'").textContent = '.$card[2].';
                </script>';
                $num++;
            }
            ?>
        </div>
    </section>
    <script>
        Galleria.loadTheme('plugins/galleria/themes/classic/galleria.classic.js');
        Galleria.configure({
            // transition: "fade",
            imageCrop: false,
            lightbox: true,
            responsive: true,
            showInfo: true,
        });
        Galleria.run('.galleria');
    </script>
</body>
</html>