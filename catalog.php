<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Каталог</title>

    <!--  CSS  -->
    <link rel="stylesheet" href="/styles/normalise.css">
    <link rel="stylesheet" href="/styles/style.css">

    <!--  JS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="plugins/galleria/galleria.js"></script>

    <!--  ШРИФТЫ  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@100;300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- PLUGINS-->
    <link  href="plugins/fotorama/fotorama.css" rel="stylesheet">
    <script src="plugins/fotorama/fotorama.js"></script>
</head>
<body>
<!-- ТУТ ХЭДЭР -->
    <?php
    include_once "devtools.php";
    include_once "common.php";
    setHeader();
    // *** Поиск товаров по фильтрам *** \\
    $searchByWord = false;
    $type = $typeCat = $brand = null;
    $cardsArray = [];
    $seriesCount = $rigidCount = $lengthCount = $grabCount = 0;
    $baseSQL = "SELECT p_vendor_code, p_name, p_price, p_discount, p_price_with_discount, p_images FROM prods WHERE ";
    $baseSQLExcept = "";
    $params = [];

    if(isset($_GET["brand"])){
        $brand = $_GET["brand"];
        if($brand=="UNIHOC"){ $baseSQLExcept .= " EXCEPT ".$baseSQL."p_brand = 'ZONEFLOORBALL' "; }
        $baseSQL .= "p_brand='$brand' ";
    }

    if(isset($_GET["series"])){
//        $baseSQL .= "AND p_series='".$_GET["series"]."'";
        foreach($_GET["series"] as $ser){
//            if(in_array("series".$ser, $_GET["series"])){ echo '<script>document.getElementById("series'.$ser.'").checked=true;</script>'; }
            if(in_array($ser, $_GET["series"])){ $seriesCount++; $baseSQL .= (($seriesCount==1)?" AND":" OR")." p_series='$ser'"; }
        }
    }

    if(isset($_GET["type"])){
        $type = $_GET["type"];
        logMes($_GET["type"]);
        $baseSQL .= "AND p_type=:p_type";

        if ($type == "sticks") {
            $typeCat = "Клюшки";
            $params[':p_type'] = "Клюшка";

            // Жёсткость
            if(isset($_GET["rigid"])) {
                foreach($_GET["rigid"] as $rig){
                    if(in_array($rig, $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='$rig'"; }
                }
//                if(in_array("24", $_GET["rigid"])){ $rigidCount++; $baseSQL .= " AND p_rigid='24'"; } if(in_array("26", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='26'"; }
//                if(in_array("27", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='27'"; } if(in_array("28", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='28'"; }
//                if(in_array("29", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='29'"; } if(in_array("30", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='30'"; }
//                if(in_array("32", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='32'"; } if(in_array("34", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='34'"; }
//                if(in_array("35", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='35'"; } if(in_array("36", $_GET["rigid"])){ $rigidCount++; $baseSQL .= (($rigidCount==1)?" AND":" OR")." p_rigid='36'"; }

            }

            // Длина
            if(isset($_GET["length"])) {
                foreach($_GET["length"] as $len){
                    if(in_array($len, $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='$len'"; }
                }
//                if(in_array("55", $_GET["length"])){ $lengthCount++; $baseSQL .= " AND p_length='55'"; } if(in_array("60", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='60'"; }
//                if(in_array("65", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='65'"; } if(in_array("70", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='70'"; }
//                if(in_array("75", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='75'"; } if(in_array("80", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='80'"; }
//                if(in_array("83", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='83'"; } if(in_array("87", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='87'"; }
//                if(in_array("92", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='92'"; } if(in_array("96", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='96'"; }
//                if(in_array("100", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='100'"; } if(in_array("104", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='104'"; }
//                if(in_array("110", $_GET["length"])){ $lengthCount++; $baseSQL .= (($lengthCount==1)?" AND":" OR")." p_length='110'"; }
            }

            // Хват grab_left
            if(isset($_GET["grab"])) {
                if(in_array("левый", $_GET["grab"])){ $grabCount++; $baseSQL .= " AND p_grab='левый'"; }
                if(in_array("правый", $_GET["grab"])){ $grabCount++; $baseSQL .= (($grabCount==1)?" AND":" OR")." p_grab='правый'"; }
                if(in_array("с обеих сторон", $_GET["grab"])){ $grabCount++; $baseSQL .= (($grabCount==1)?" AND":" OR")." p_grab='с обеих сторон'"; }
            }

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

    <section class="container catalog-main d-grid">
        <!-- ФИЛЬТРЫ -->
        <div class="catalog-filters main">
            <div class="">
                <form method="GET">

                <?php
                // *** Если товарный знак выбран *** \\
                if($brand != null){
                    echo '
                        <div class="catalog-path d-flex">
                            <a href="">Каталог</a>
                            <span>/</span>
                            <a href="catalog.php?brand='.$brand.'">'.$brand.'<input hidden type="text" name="brand" value="'.$brand.'"></a>
                            <span>/</span>
                            <a href="catalog.php?brand='.$brand.'&type='.$type.'">'.$typeCat.'<input hidden type="text" name="type" value="'.$type.'"></a>
    
                        </div>
                        <div class="catalog-filters--types d-flex flex-dir-col">
                            <input id="types_sticks" type="radio"><a href="catalog.php?brand='.$brand.'&type=sticks">КЛЮШКИ</a>
                            <input id="types_balls" type="radio"><a href="catalog.php?brand='.$brand.'&type=balls">МЯЧИ</a>
                        </div>
                        
                        <div class="catalog-filters--custom d-flex flex-dir-col">
                    ';


                    // Тип
                    if(isset($_GET["type"])){
                        echo '<script>document.getElementById("types_'.$_GET["type"].'").checked=true;</script>';
                    }

                    if($type == "sticks"){
                        echo '
                            <div class="catalog-filters--sticks-series catalog-filters--bcg">
                                <h1>СЕРИЯ</h1>
                                <div class="d-grid catalog-filters--sticks-series-items catalog-filters--items-cont d-flex flex-dir-col">
                                    <label><input id="series_EVOLAB" type="checkbox" name="series[]" value="EVOLAB"><span>EVOLAB</span></label>
                                    <label><input id="series_BASIC_COLLECTION" type="checkbox" name="series[]" value="BASIC_COLLECTION"><span>BASIC COLLECTION</span></label>
                                    <label><input id="series_CARBSKIN" type="checkbox" name="series[]" value="CARBSKIN"><span>CARBSKIN</span></label>
                                    <label><input id="series_CARBSKIN_CURVE" type="checkbox" name="series[]" value="CARBSKIN_CURVE"><span>CARBSKIN CURVE</span></label>
                                    <label><input id="series_SUPERSKIN" type="checkbox" name="series[]" value="SUPERSKIN"><span>SUPERSKIN</span></label>
                                    <label><input id="series_SIGNATURE_SERIES" type="checkbox" name="series[]" value="SIGNATURE_SERIES"><span>SIGNATURE SERIES</span></label>
                                    <label><input id="series_ECO" type="checkbox" name="series[]" value="ECO"><span>ECO</span></label>
                                    <label><input id="series_SUPERSHAPE" type="checkbox" name="series[]" value="SUPERSHAPE"><span>SUPERSHAPE</span></label>
                                    <label><input id="series_TITAN_SERIES" type="checkbox" name="series[]" value="TITAN_SERIES"><span>TITAN SERIES</span></label>
                                    <label><input id="series_OVAL_SERIES" type="checkbox" name="series[]" value="OVAL_SERIES"><span>OVAL SERIES</span></label>
                                    <label><input id="series_COMPOSITE" type="checkbox" name="series[]" value="COMPOSITE"><span>COMPOSITE</span></label>
                                    <label><input id="series_COMPOSITE_SERIES" type="checkbox" name="series[]" value="COMPOSITE_SERIES"><span>COMPOSITE SERIES</span></label>
                                    <label><input id="series_COMPOSITE_YOUNGSTER" type="checkbox" name="series[]" value="COMPOSITE_YOUNGSTER"><span>COMPOSITE YOUNGSTER</span></label>
                                    <label><input id="series_PLAYER" type="checkbox" name="series[]" value="PLAYER"><span>PLAYER</span></label>
                                    <label><input id="series_ZORRO" type="checkbox" name="series[]" value="ZORRO"><span>ZORRO</span></label>
                                </div>
                            </div>
    
                            <div class="catalog-filters--sticks-rigid catalog-filters--bcg">
                                <h1>ЖЁСТКОСТЬ (ММ)</h1>
                                <div class="d-grid catalog-filters--sticks-rigid-items catalog-filters--items-cont">
                                    <label><input id="rigid24" type="checkbox" name="rigid[]" value="24"><span>24</span></label>
                                    <label><input id="rigid26" type="checkbox" name="rigid[]" value="26"><span>26</span></label>
                                    <label><input id="rigid27" type="checkbox" name="rigid[]" value="27"><span>27</span></label>
                                    <label><input id="rigid28" type="checkbox" name="rigid[]" value="28"><span>28</span></label>
                                    <label><input id="rigid29" type="checkbox" name="rigid[]" value="29"><span>29</span></label>
                                    <label><input id="rigid30" type="checkbox" name="rigid[]" value="30"><span>30</span></label>
                                    <label><input id="rigid32" type="checkbox" name="rigid[]" value="32"><span>32</span></label>
                                    <label><input id="rigid34" type="checkbox" name="rigid[]" value="34"><span>34</span></label>
                                    <label><input id="rigid35" type="checkbox" name="rigid[]" value="35"><span>35</span></label>
                                    <label><input id="rigid36" type="checkbox" name="rigid[]" value="36"><span>36</span></label>
                                </div>
                            </div>
                            
                            <div class="catalog-filters--sticks-length catalog-filters--bcg">
                                <h1>ДЛИНА РУКОЯТКИ (СМ)</h1>
                                <div class="d-grid catalog-filters--sticks-length-items catalog-filters--items-cont">
                                    <label><input id="length55" type="checkbox" name="length[]" value="55"><span>55</span></label>
                                    <label><input id="length60" type="checkbox" name="length[]" value="60"><span>60</span></label>
                                    <label><input id="length65" type="checkbox" name="length[]" value="65"><span>65</span></label>
                                    <label><input id="length70" type="checkbox" name="length[]" value="70"><span>70</span></label>
                                    <label><input id="length75" type="checkbox" name="length[]" value="75"><span>75</span></label>
                                    <label><input id="length80" type="checkbox" name="length[]" value="80"><span>80</span></label>
                                    <label><input id="length83" type="checkbox" name="length[]" value="83"><span>83</span></label>
                                    <label><input id="length87" type="checkbox" name="length[]" value="87"><span>87</span></label>
                                    <label><input id="length92" type="checkbox" name="length[]" value="92"><span>92</span></label>
                                    <label><input id="length96" type="checkbox" name="length[]" value="96"><span>96</span></label>
                                    <label><input id="length100" type="checkbox" name="length[]" value="100"><span>100</span></label>
                                    <label><input id="length104" type="checkbox" name="length[]" value="104"><span>104</span></label>
                                    <label><input id="length110" type="checkbox" name="length[]" value="110"><span>110</span></label>
                                </div>
                            </div>
                            
                            <div class="catalog-filters--sticks-grab catalog-filters--bcg">
                                <h1>ХВАТ (ИГРОВАЯ СТОРОНА)</h1>
                                <div class="d-grid catalog-filters--sticks-grab-items catalog-filters--items-cont">
                                    <label><input id="grab_left" type="checkbox" name="grab[]" value="левый"><span>Левый</span></label>
                                    <label><input id="grab_right" type="checkbox" name="grab[]" value="правый"><span>Правый</span></label>
                                    <label><input id="grab_both" type="checkbox" name="grab[]" value="с обеих сторон"><span>С обеих сторон</span></label>
                                </div>
                            </div>
                        ';

                        // *** Устанавливаем значения фильтров поиска *** \\
                        // Серия echo '<script>document.querySelector(\'input[type=radio][value="'.$_GET["series"].'"]\').checked=true;</script>';
                        if(isset($_GET["series"])) {
                            foreach($_GET["series"] as $ser){
                                if(in_array($ser, $_GET["series"])){ echo '<script>document.getElementById("series_'.$ser.'").checked=true;</script>'; }
                            }
                        }

                        // Жёсткость
                        if(isset($_GET["rigid"])) {
                            foreach($_GET["rigid"] as $rig){
                                if(in_array($rig, $_GET["rigid"])){ echo '<script>document.getElementById("rigid'.$rig.'").checked=true;</script>'; }
                            }
    //                        if(in_array("24", $_GET["rigid"])){ echo '<script>document.getElementById("rigid24").checked=true;</script>'; } if(in_array("26", $_GET["rigid"])){ echo '<script>document.getElementById("rigid26").checked=true;</script>'; }
    //                        if(in_array("27", $_GET["rigid"])){ echo '<script>document.getElementById("rigid27").checked=true;</script>'; } if(in_array("28", $_GET["rigid"])){ echo '<script>document.getElementById("rigid28").checked=true;</script>'; }
    //                        if(in_array("29", $_GET["rigid"])){ echo '<script>document.getElementById("rigid29").checked=true;</script>'; } if(in_array("30", $_GET["rigid"])){ echo '<script>document.getElementById("rigid30").checked=true;</script>'; }
    //                        if(in_array("32", $_GET["rigid"])){ echo '<script>document.getElementById("rigid32").checked=true;</script>'; } if(in_array("34", $_GET["rigid"])){ echo '<script>document.getElementById("rigid34").checked=true;</script>'; }
    //                        if(in_array("35", $_GET["rigid"])){ echo '<script>document.getElementById("rigid35").checked=true;</script>'; } if(in_array("36", $_GET["rigid"])){ echo '<script>document.getElementById("rigid36").checked=true;</script>'; }
                        }

                        // Длина
                        if(isset($_GET["length"])) {
                            foreach($_GET["length"] as $len){
                                if(in_array($len, $_GET["length"])){ echo '<script>document.getElementById("length'.$len.'").checked=true;</script>'; }
                            }
    //                        if(in_array("55", $_GET["length"])){ echo '<script>document.getElementById("length55").checked=true;</script>'; } if(in_array("60", $_GET["length"])){ echo '<script>document.getElementById("length60").checked=true;</script>'; }
    //                        if(in_array("65", $_GET["length"])){ echo '<script>document.getElementById("length65").checked=true;</script>'; } if(in_array("70", $_GET["length"])){ echo '<script>document.getElementById("length70").checked=true;</script>'; }
    //                        if(in_array("75", $_GET["length"])){ echo '<script>document.getElementById("length75").checked=true;</script>'; } if(in_array("80", $_GET["length"])){ echo '<script>document.getElementById("length80").checked=true;</script>'; }
    //                        if(in_array("83", $_GET["length"])){ echo '<script>document.getElementById("length83").checked=true;</script>'; } if(in_array("87", $_GET["length"])){ echo '<script>document.getElementById("length87").checked=true;</script>'; }
    //                        if(in_array("92", $_GET["length"])){ echo '<script>document.getElementById("length92").checked=true;</script>'; } if(in_array("96", $_GET["length"])){ echo '<script>document.getElementById("length96").checked=true;</script>'; }
    //                        if(in_array("100", $_GET["length"])){ echo '<script>document.getElementById("length100").checked=true;</script>'; } if(in_array("104", $_GET["length"])){ echo '<script>document.getElementById("length104").checked=true;</script>'; }
    //                        if(in_array("110", $_GET["length"])){ echo '<script>document.getElementById("length110").checked=true;</script>'; }
                        }

                        // Хват
                        if(isset($_GET["grab"])) {
                            if(in_array("левый", $_GET["grab"])){ echo '<script>document.getElementById("grab_left").checked=true;</script>'; }
                            if(in_array("правый", $_GET["grab"])){ echo '<script>document.getElementById("grab_right").checked=true;</script>'; }
                            if(in_array("с обеих сторон", $_GET["grab"])){ echo '<script>document.getElementById("grab_both").checked=true;</script>'; }
                        }
                    }
                }
                if($type != null){
                    echo '<button class="search_btn icons" id="search_btn" type="submit">ПОИСК</button>';
                }

                ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- КАРТОЧКИ -->
        <div class="main">
            <div class="catalog-viewer d-grid">
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
                    $stmt = $conn->prepare($baseSQL.$baseSQLExcept);
                    $stmt->execute($params);
                    $cardsArray = $stmt->fetchAll();
                }
                if($brand != null){
                    $stmt = $conn->prepare($baseSQL.$baseSQLExcept);
                    $stmt->execute($params);
                    $cardsArray = $stmt->fetchAll();
                }
                $conn=null;

                // Выводим карточки
                if(count($cardsArray)!=0) {
                    $num = 0;
                    foreach ($cardsArray as $card) {
                        echo '<div class="prod-card d-flex flex-dir-col">';
                        if($card[5] != ""){
                            echo '<div class="fotorama d-flex flex-dir-col ai-cntr">';
                            $imgArr = json_decode($card[5]);
                            for ($i = 0; $i < count($imgArr); $i++) {
                                echo '<img src="' . $imgArr[$i] . '" class="">';
                            }
                            echo '</div>';
                        }
                        echo '
                                <div class="prod-card--container d-flex flex-dir-col jc-sb">
                                    <a href="" id="prod-card--name'.$num.'" class="prod-card--name"></a>
                                    <div class="prod-card--container-lower d-flex jc-sb ai-cntr">
                                        <div class="prod-card--container-lower--price d-flex ai-cntr">';
                                        if($card[3] == "") {
                                            echo '
                                                <span id="prod-card--price' . $num . '" class="prod-card--price-current"></span>';

                                        } else {
                                            echo '
                                                <span id="prod-card--price-with-discount' . $num . '" class="prod-card--price-current"></span>
                                                <span id="prod-card--price' . $num . '" class="prod-card--price-before-discount prod-card--price"></span>';

                                        }
                        echo '
                                            <span hidden id="prod-card--discount'.$num.'" class="prod-card--discount"></span>
                                        </div>
                                        <a href="" class="prod-card--edit-btn--cont icons d-flex" id="prod-card--edit'.$num.'" title="Редактировать карточку товара"><img class="prod-card--edit-btn icons--svg" src="icons/edit.svg"></a>
                                    </div>
                                </div>
                            </div>
              
                        <script>
                            document.getElementById("prod-card--edit'.$num.'").href = "product-manage.php?search_by_vendor_code='.$card[0].'";
                            document.getElementById("prod-card--name'.$num.'").href = "product.php?search_by_vendor_code='.$card[0].'";
                            document.getElementById("prod-card--name'.$num.'").textContent = "'.$card[1].'";
                            document.getElementById("prod-card--price'.$num.'").textContent = "'.$card[2].'"+"₽";';
                            if($card[4] != ""){echo 'document.getElementById("prod-card--price-with-discount'.$num.'").textContent = "'.$card[4].'"+"₽";';}
                            if($card[3] != ""){echo 'document.getElementById("prod-card--discount'.$num.'").hidden = false;
                                                        document.getElementById("prod-card--discount'.$num.'").textContent = "-"+"'.$card[3].'"+"%";';}
                        echo '</script>';
                        $num++;
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <script>
        $('.fotorama').fotorama({
            height: 350,
            width: 280,
            allowfullscreen: true,
            loop: true,
        });
        // Galleria.loadTheme('plugins/galleria/themes/classic/galleria.classic.js');
        // Galleria.configure({
        //     transition: "fade",
        //     // imageCrop: false,
        //     lightbox: true,
        //     // responsive: true,
        //     // showInfo: true,
        // });
        // Galleria.run('.galleria');
    </script>

    <?php
    setFooter();
    ?>
</body>
</html>