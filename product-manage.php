<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Карточки</title>

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
    include_once "devtools.php";
    include_once "common.php";

    // *** Получаем массив артикулов и отправляем его в cookie *** \\
    $conn  = new PDO('sqlite:database/cards.sqlite') or die("Cannot open the database");
    $stmt = $conn->prepare("SELECT p_vendor_code FROM prods");
    $stmt->execute();
    $vendor_code_array = $stmt->fetchAll();
    setcookie('vendor_code_array', json_encode($vendor_code_array));
    $conn=null;
    ?>
    <!-- ПОИСК КАРТОЧКИ ПО АРТИКУЛУ ДЛЯ РЕДАКТИРОВАНИЯ -->
    <div class="main prod-manage">
        <div class="prod-manage__top d-flex ai-cntr">
            <a href="index.php"><img src="images/logo56.png"></a>
            <form id="search_by_vendor_code_form" method="GET" class="search_by_vendor_code_form d-flex ai-cntr">
                <label id="search_by_vendor_code" class=""><input class="search_by_vendor_code_input" id="search_by_vendor_code_input" type="number" name="search_by_vendor_code"
                                                         placeholder="Поиск по артикулу"></label>
                <button id="search_by_vendor_code_btn" class="search_by_vendor_code_btn icons" type="submit" disabled>Загрузить</button>
                <label hidden id="search_by_vendor_code_warning">АРТИКУЛ СУЩЕСТВУЕТ!</label>
            </form>
            <div class="prod-manage__top-title d-flex">
                <h1 class="">РЕДАКТОР КАРТОЧЕК ТОВАРОВ</h1>
            </div>
        </div>

        <!--  ПОЛЯ ВВОДА  -->
        <div class="prod-manage__main d-flex flex-dir-col">
            <div class="prod-manage__main-top d-flex jc-sb">
                <h2 class="prod-manage__sub-title" id="prod_manage_title">Карточка товара</h2>
                <label for="save_card_btn" id="save_card_pseudo" class="save_card_pseudo icons">Сохранить</label>
            </div>

            <div class="">
                <form method="POST" enctype="multipart/form-data" class="prod-manage__sub-main d-grid">
                    <div class="prod-manage__fields-left d-flex flex-dir-col">
                        <!-- Тип товара -->
                        <div class="prod-manage__field">
                            <h3 class="d-flex jc-sb">Тип товара
                                <select id="p_type" name="type" size="1">
                                    <option value="Не выбран" selected>Не выбран</option>
                                    <option value="Клюшка">Клюшка</option>
                                    <option value="Мяч">Мяч</option>
                                </select>
                            </h3>
                        </div>

                        <!-- Артикул --> <div class="prod-manage__field">
                            <h3 id="p_vendor_code" class="d-flex jc-sb">Артикул<input id="p_vendor_code_input" type="number" name="vendor_code" placeholder="Обязательное поле!"></h3>
                            <label hidden id="p_vendor_code_warning">АРТИКУЛ ЗАНЯТ!</label>
                        </div>
                        <!-- Наименование --> <div class="prod-manage__field" id="p_name_input_cont" title="">
                            <h3 id="p_name" class="d-flex jc-sb">Наименование<input id="p_name_input" type="text" name="name" readonly></h3>
                        </div>
                        <!-- Тип для карточки --> <div class="prod-manage__field">
                            <h3 id="p_type_card" class="d-flex jc-sb">Тип для карточки<input id="p_type_card_input" type="text" name="type_card"></h3>
                        </div>
                        <!-- Товарный знак --> <div class="prod-manage__field">
                            <h3 id="p_brand" class="d-flex jc-sb">Товарный знак<input id="p_brand_input" type="text" name="brand"></h3>
                        </div>
                        <!-- Марка --> <div class="prod-manage__field">
                            <h3 id="p_trademark" class="d-flex jc-sb">Марка<input id="p_trademark_input" type="text" name="trademark"></h3>
                        </div>
                        <!-- Модель --> <div class="prod-manage__field">
                            <h3 id="p_model" class="d-flex jc-sb">Модель<input id="p_model_input" type="text" name="model"></h3>
                        </div>
                        <!-- Спецификация --> <div class="prod-manage__field">
                            <h3 id="p_spec" class="d-flex jc-sb">Спецификация<input id="p_spec_input" type="text" name="spec"></h3>
                        </div>
                        <!-- Индекс жёсткости -->
                        <div hidden id="p_rigid" class="prod-manage__field">
                            <h3>Индекс жёсткости, мм</h3>
                            <label><input hidden id="p_rigid_no_sel" type="radio" name="rigid" value="" checked></label>
                            <div class="prod-manage__field-rigid d-grid">
                                <label><input type="radio" name="rigid" value="24"><span>24</span></label>
                                <label><input type="radio" name="rigid" value="26"><span>26</span></label>
                                <label><input type="radio" name="rigid" value="27"><span>27</span></label>
                                <label><input type="radio" name="rigid" value="28"><span>28</span></label>
                                <label><input type="radio" name="rigid" value="29"><span>29</span></label>
                                <label><input type="radio" name="rigid" value="30"><span>30</span></label>
                                <label><input type="radio" name="rigid" value="32"><span>32</span></label>
                                <label><input type="radio" name="rigid" value="34"><span>34</span></label>
                                <label><input type="radio" name="rigid" value="35"><span>35</span></label>
                                <label><input type="radio" name="rigid" value="36"><span>36</span></label>
                            </div>
                        </div>
                        <!-- Цвет --> <div class="prod-manage__field">
                            <h3 id="p_color" class="d-flex jc-sb">Цвет<input id="p_color_input" type="text" name="color"></h3>
                        </div>
                        <!-- Серия --> <div class="prod-manage__field">
                            <h3 id="p_series" class="d-flex jc-sb">Серия<input id="p_series_input" type="text" name="series"></h3>
                        </div>
                    </div>

                    <div class="prod-manage__fields-mid d-flex flex-dir-col">
                        <!-- Профиль рукоятки --> <div class="prod-manage__field">
                            <h3 hidden id="p_handle" class="d-flex jc-sb">Профиль рукоятки<input id="p_handle_input" type="text" name="handle"></h3>
                        </div>
                        <!-- Материал рукоятки --> <div class="prod-manage__field">
                            <h3 hidden id="p_handle_mat" class="d-flex jc-sb">Материал рукоятки<input id="p_handle_mat_input" type="text" name="handle_mat"></h3>
                        </div>
                        <!-- Длина -->
                        <div hidden id="p_length" class="prod-manage__field">
                            <h3>Длина, см</h3>
                            <label><input hidden  id="p_length_no_sel" type="radio" name="length" value="" checked></label>
                            <div class="prod-manage__field-length d-grid">
                                <label><input type="radio" name="length" value="55"><span>55</span></label>
                                <label><input type="radio" name="length" value="60"><span>60</span></label>
                                <label><input type="radio" name="length" value="65"><span>65</span></label>
                                <label><input type="radio" name="length" value="70"><span>70</span></label>
                                <label><input type="radio" name="length" value="75"><span>75</span></label>
                                <label><input type="radio" name="length" value="80"><span>80</span></label>
                                <label><input type="radio" name="length" value="83"><span>83</span></label>
                                <label><input type="radio" name="length" value="87"><span>87</span></label>
                                <label><input type="radio" name="length" value="92"><span>92</span></label>
                                <label><input type="radio" name="length" value="96"><span>96</span></label>
                                <label><input type="radio" name="length" value="100"><span>100</span></label>
                                <label><input type="radio" name="length" value="104"><span>104</span></label>
                                <label><input type="radio" name="length" value="110"><span>110</span></label>
                            </div>
                        </div>
                        <!-- Хват -->
                        <div hidden id="p_grab" class="prod-manage__field">
                            <h3>Хват</h3>
                            <label><input hidden id="p_grab_no_sel" type="radio" name="grab" value="" checked></label>
                            <div class="prod-manage__field-grab d-flex jc-sb">
                                <label><input type="radio" name="grab" value="левый"><span>Левый</span></label>
                                <label><input type="radio" name="grab" value="правый"><span>Правый</span></label>
                                <label><input type="radio" name="grab" value="с обеих сторон"><span>С обеих сторон</span></label>
                            </div>
                        </div>
                        <h3 hidden id="p_grab">Хват
                            <label><input hidden id="p_grab_no_sel" type="radio" name="grab" value="" checked></label>
                            <label><input type="radio" name="grab" value="левый"><span>Левый</span></label>
                            <label><input type="radio" name="grab" value="правый"><span>Правый</span></label>
                            <label><input type="radio" name="grab" value="с обеих сторон"><span>С обеих сторон</span></label>
                        </h3>
                        <!-- Вес --> <div class="prod-manage__field">
                            <h3 id="p_weight" class="d-flex jc-sb">Вес<input id="p_weight_input" type="number" step="0.001" name="weight"></h3>
                        </div>
                        <!-- Цена --> <div class="prod-manage__field">
                            <h3 id="p_price" class="d-flex jc-sb">Цена<input id="p_price_input" type="number" step="0.001" name="price"></h3>
                        </div>
                        <!-- Скидка --> <div class="prod-manage__field">
                            <h3 id="p_discount" class="d-flex jc-sb">Скидка<input id="p_discount_input" type="number" step="0.001" name="discount"></h3>
                        </div>
                        <!-- Цена со скидкой --> <div class="prod-manage__field">
                            <h3 id="p_price_with_discount" class="d-flex jc-sb">Цена со скидкой<input id="p_price_with_discount_input" type="number" step="0.001" name="price_with_discount" readonly></h3>
                        </div>
                        <!-- Наличие на складе --> <div class="prod-manage__field">
                                <h3 id="p_stock_status" class="d-flex jc-sb">Наличие на складе<input id="p_stock_status_input" type="text" name="stock_status"></h3>
                        </div>
                        <!-- Группа --> <div class="prod-manage__field"  id="p_group_input_cont">
                                <h3 id="p_group" class="d-flex jc-sb">Группа<input id="p_group_input" type="text" name="group" readonly></h3>
                        </div>
                    </div>

                    <div class="prod-manage__fields-right d-flex flex-dir-col">
                        <!-- Описание --> <div class="prod-manage__field d-flex flex-dir-col">
                            <h3 id="p_desc" class="">Описание</h3>
                            <textarea id="p_desc_input" name="desc"></textarea>
                        </div>
                        <!-- Фото --> <div class="prod-manage__field d-flex flex-dir-col">
                            <div class="prod-image-main d-flex flex-dir-col">
                                <div class="prod-image-and-title d-flex">
                                    <h3 class="d-flex flex-dir-col">Фото</h3>
                                    <button type="button" class="prod-image-add-btn search_by_vendor_code_btn icons"><span>Добавить</span></button>
                                </div>
                                <div class="images-container d-grid"></div>
                            </div>


                        </div>
                    </div>

                    <!-- СОХРАНИТЬ КАРТОЧКУ -->
                    <button hidden id="save_card_btn" type="submit" name="save_card" disabled>Сохранить</button>


                    <!-- JS -->
                    <script>
                        // *** Фотографии *** \\
                        let idNum = -1;

                        // Процесс добавления элемента изображения
                        function addImgItem(editMode, pathToFile){
                            // if(editMode){ // Режим редактирования
                            idNum++;
                            // } else {idNum = 0;} // Режим добавления

                            // Добавлчем в HTML блок-элемент
                            jQuery('.images-container').append(`
                                <div class="p_image-item d-flex flex-dir-col">
                                    <div class="d-flex jc-sb">
                                        <label for="p_images_input`+String(idNum)+`" class="p_images_input__sel icons">...</label>
                                        <label for="prod_image_del`+String(idNum)+`" class="p_images_input__del icons">x</label>

                                    </div>
                                    <input hidden type="file" id="p_images_input`+String(idNum)+`" name="images[]" accept="image/*"
                                        onchange="document.getElementById('p_images_img`+String(idNum)+`').src = window.URL.createObjectURL(this.files[0]);
                                                    document.getElementById('p_images_img`+String(idNum)+`').hidden = false;">
                                    <div class="p_images_common_cont d-flex jc-center ai-cntr"><img hidden src="" id="p_images_img`+String(idNum)+`" class="p_images_common d-flex"></div>
                                    <button hidden type="button" id="prod_image_del`+String(idNum)+`" class="prod-image-del-btn"><span>Удалить</span></button>
                                </div>`);

                            // Режим редактирования
                            if(editMode){
                                // Ставим фото
                                document.getElementById('p_images_img'+String(idNum)).src = pathToFile;

                                let fileName = pathToFile.substring(pathToFile.lastIndexOf('/')+1); // Имя файла
                                const fileInput = document.getElementById('p_images_input'+String(idNum)); // ID блок-элемента

                                // Создаём объект файла
                                fetch(document.location.origin+'/'+pathToFile).then(res => res.blob()).then(blob => {
                                    // Референс файла
                                    const imageFile = new File([blob], fileName, { type: blob.type });

                                    // Добавляем файл в блок-элемент
                                    const dataTransfer = new DataTransfer();
                                    dataTransfer.items.add(imageFile);
                                    fileInput.files = dataTransfer.files;


                                });
                            }
                        }

                        // Загружаем все файла из массива
                        function loadImages(imagesArr){
                            for(let i=0; i<imagesArr.length; i++){
                                addImgItem(true, imagesArr[i]);
                            }
                        }

                        // Добавить элемент изображения
                        jQuery('.prod-image-add-btn').on('click', function(){
                            addImgItem(false);
                        });

                        // Удалить элемент изображения
                        jQuery('.images-container').on('click', '.prod-image-del-btn', function(){
                            jQuery(this).parent('div').remove();
                        });

                        // *** Получаем cookie по имени *** \\
                        let vendorCodeOfEdited = null;

                        // *** Получаем cookie по имени *** \\
                        function getCookieByName(name) {
                            // Делим строку cookie и получаем пары name=value
                            let cookieArr = document.cookie.split(";");

                            // Идем по элементам массива
                            for(let i = 0; i < cookieArr.length; i++) {
                                let cookiePair = cookieArr[i].split("=");

                                // Удаляем пробелы вначале имени cookie и сравниваем с заданным именем
                                if(name === cookiePair[0].trim()) {
                                    // Декодируем значение cookie и получаем
                                    return decodeURIComponent(cookiePair[1]);
                                }
                            }

                            // Если нет такого имени
                            return null;
                        }

                        // *** Проверяем есть ли введённый артикул в массиве артикулов из cookie *** \\
                        function checkIfExistsByVendorCode(searchVendorCode, elementToChange){

                            // Если поле "Артикул" карточки пустое, деактивируем кнопку "Сохранить", чтобы не записать карточку с пустым артикулом
                            if (elementToChange === 'save_card_btn') {
                                document.getElementById("p_vendor_code_warning").hidden=true; // Прячем предупреждение "АРТИКУЛ ЗАНЯТ!"
                                if (document.getElementById('p_vendor_code_input').value === '') {
                                    document.getElementById('save_card_btn').disabled = true;
                                    document.getElementById('save_card_pseudo').style.display = "none";
                                    return;
                                }
                            }

                            if (elementToChange === 'search_by_vendor_code_btn') {
                                document.getElementById("search_by_vendor_code_warning").hidden=true; // Прячем предупреждение "АРТИКУЛ СУЩЕСТВУЕТ!"
                            }

                            let vendorCodesArr = JSON.parse(getCookieByName('vendor_code_array')); // Получаем строку артикулов из cookie и переводим её в массив

                            if(vendorCodesArr.length !== 0){
                                // Сравниваем каждый артикул в массиве с введённым артикулом
                                for(let i=0; i<=vendorCodesArr.length; i++){

                                    // Если артикул введём в "Поиске по артикулу"
                                    if (elementToChange === 'search_by_vendor_code_btn') {

                                        // Если найден, активируем кнопку "Загрузить"
                                        if (vendorCodesArr[i]['p_vendor_code'] === Number(searchVendorCode)) {
                                            document.getElementById("search_by_vendor_code_warning").hidden=false;
                                            document.getElementById('search_by_vendor_code_btn').disabled = false;
                                            break;

                                        // Если нет, деактивируем кнопку "Загрузить"
                                        } else {
                                            document.getElementById('search_by_vendor_code_btn').disabled = true;
                                        }

                                    // Если артикул введён поле "Артикул" карточки
                                    } else if (elementToChange === 'save_card_btn') {
                                        // Если найден ...
                                        if (vendorCodesArr[i]['p_vendor_code'] === Number(searchVendorCode)) {
                                            // в режиме "Создания" карточки, деактивируем кнопку "Сохранить", чтобы избежать дублирования артикула
                                            if(vendorCodeOfEdited===null){ // переменная артикула редактируемой карточки пустая, режим редак-я отключён
                                                document.getElementById("p_vendor_code_warning").hidden=false;
                                                document.getElementById('save_card_btn').disabled = true;
                                                document.getElementById('save_card_pseudo').style.display = "none";
                                                break;

                                            // в режиме "Редактирования" карточки ...
                                            } else {
                                                // и совпадает с артикулом редактируемой карточки, активируем кнопку "Сохранить", чтобы перезаписать её
                                                if(vendorCodeOfEdited===searchVendorCode){
                                                    document.getElementById('save_card_btn').disabled = false;
                                                    document.getElementById('save_card_pseudo').style.display = "block";

                                                // и совпадает с каким-то другим артикулом, деактивируем кнопку "Сохранить", чтобы не перезаписать карточку другого товара
                                                } else {
                                                    document.getElementById("p_vendor_code_warning").hidden=false;
                                                    document.getElementById('save_card_btn').disabled = true;
                                                    document.getElementById('save_card_pseudo').style.display = "none";
                                                    break;
                                                }
                                            }

                                        // Если не найден, активируем кнопку "Сохранить"
                                        } else {
                                            document.getElementById('save_card_btn').disabled = false;
                                            document.getElementById('save_card_pseudo').style.display = "block";
                                        }
                                    }
                                }
                            } else {
                                document.getElementById('save_card_btn').disabled = false;
                                document.getElementById('save_card_pseudo').style.display = "block";
                            }
                        }

                        // *** Поиск по артикулу *** \\
                        // Если артикул найден, активируем кнопку "Загрузить" карточку по артикулу
                        document.getElementById('search_by_vendor_code_input').oninput = function() {
                            checkIfExistsByVendorCode(document.getElementById('search_by_vendor_code_input').value, 'search_by_vendor_code_btn') };

                        // Если артикул найден, деактивируем кнопку сохранения
                        document.getElementById('p_vendor_code_input').oninput = function() {
                            checkIfExistsByVendorCode(document.getElementById('p_vendor_code_input').value, 'save_card_btn') };

                        // *** Наименование *** \\
                        document.getElementById('p_type').oninput = function() { composeNameAndGroup(); }; // тип товара
                        document.getElementById('p_type_card_input').oninput = function() { composeNameAndGroup(); }; // тип для карточки
                        document.getElementById('p_brand_input').oninput = function() { composeNameAndGroup(); }; // товарный знак
                        document.getElementById('p_trademark_input').oninput = function() { composeNameAndGroup(); }; // марка
                        document.getElementById('p_model_input').oninput = function() { composeNameAndGroup(); }; // модель
                        document.getElementById('p_color_input').oninput = function() { composeNameAndGroup(); }; // цвет
                        document.getElementById('p_spec_input').oninput = function() { composeNameAndGroup(); }; // спец-я

                        // Длина клюшки
                        let p_length_input = document.querySelector('input[name="length"]:checked').value;
                        let radiosLength = document.querySelectorAll('input[type=radio][name="length"]');
                        radiosLength.forEach(radio => radio.addEventListener('change', () => { composeNameAndGroup();}));

                        // Жёсткость клюшки
                        let p_rigid_input = document.querySelector('input[name="rigid"]:checked').value;
                        let radiosRigid = document.querySelectorAll('input[type=radio][name="rigid"]');
                        radiosRigid.forEach(radio => radio.addEventListener('change', () => { composeNameAndGroup(); }));

                        // Хват
                        let p_grab = document.querySelector('input[name="grab"]:checked').value;
                        let radiosGrab = document.querySelectorAll('input[type=radio][name="grab"]');
                        radiosGrab.forEach(radio => radio.addEventListener('change', () => {composeNameAndGroup();}));

                        // Компоновка наименования
                        function composeNameAndGroup(){
                            let p_type = document.getElementById('p_type').value; // тип товара
                            let p_type_card = (document.getElementById('p_type_card_input').value) ? (' '+document.getElementById('p_type_card_input').value) : ""; // тип для карточки
                            let p_brand = (document.getElementById('p_brand_input').value) ? (' '+document.getElementById('p_brand_input').value) : ""; // товарный знак
                            let p_trademark = (document.getElementById('p_trademark_input').value) ? (' '+document.getElementById('p_trademark_input').value) : ""; // марка
                            let p_model = (document.getElementById('p_model_input').value) ? (' '+document.getElementById('p_model_input').value) : ""; // модель
                            let p_color = (document.getElementById('p_color_input').value) ? (' '+document.getElementById('p_color_input').value) : ""; // цвет
                            let p_spec = (document.getElementById('p_spec_input').value) ? (' '+document.getElementById('p_spec_input').value) : ""; // спец-я
                            let p_rigid = ' '+document.querySelector('input[type=radio][name="rigid"]:checked').value;
                            let p_length = ' '+document.querySelector('input[type=radio][name="length"]:checked').value;
                            let p_grab = (document.querySelector('input[type=radio][name="grab"]:checked').value) ? (', '+document.querySelector('input[type=radio][name="grab"]:checked').value) : "";

                            document.getElementById('p_name_input').value = (p_type+p_type_card+p_brand+p_trademark+p_model+p_rigid+p_color+p_length+p_grab).trim();
                            document.getElementById('p_group_input').value = (p_trademark+p_model+p_spec+p_rigid).trim();
                        }

                        // *** Цена со скидкой *** \\
                        document.getElementById('p_price_input').oninput = function() { composePriceWithDiscount(); }; // цена
                        document.getElementById('p_discount_input').oninput = function() { composePriceWithDiscount(); }; // скидка
                        // Компоновка цены со скидкой
                        function composePriceWithDiscount(){
                            let p_price = Number(document.getElementById('p_price_input').value); // цена
                            let p_discount = Number(document.getElementById('p_discount_input').value); // скидка
                            document.getElementById('p_price_with_discount_input').value = (p_price===0 || p_discount===0) ? "" : p_price-(p_price*(p_discount/100));
                        }

                        // *** Для скрытия/показывания специфичных параметров, у label выше изначально должен быть hidden  *** \\
                        function showSticksParams(){
                            document.getElementById("p_rigid").hidden=false;
                            document.getElementById("p_handle").hidden=false;
                            document.getElementById("p_handle_mat").hidden=false;
                            document.getElementById("p_length").hidden=false;
                            document.getElementById("p_grab").hidden=false;
                        }
                        const productTypeElement = document.getElementById('p_type');
                        productTypeElement.addEventListener('change', (event) => {
                            // Показываем параметры специфичные для клюшек
                            if(event.target.value === "Клюшка") { showSticksParams();
                            // Скрываем параметры специфичные для клюшек и обнуляем
                            } else {
                                document.getElementById("p_rigid").hidden=true; document.getElementById("p_rigid_no_sel").checked = true; p_rigid_input="";
                                document.getElementById("p_handle").hidden=true; document.getElementById("p_handle_input").value="";
                                document.getElementById("p_handle_mat").hidden=true; document.getElementById("p_handle_mat_input").value="";
                                document.getElementById("p_length").hidden=true; document.getElementById("p_length_no_sel").checked = true; p_length_input="";
                                document.getElementById("p_grab").hidden=true; document.getElementById("p_grab_no_sel").checked = true; p_grab="";
                            }

                            if(event.target.value === "Мяч") {
                                // document.getElementById("arc3").hidden=false;
                                // document.getElementById("arc4").hidden=false;
                            } else {
                                // document.getElementById("arc3").hidden=true;
                                // document.getElementById("arc4").hidden=true;
                            }
                            composeNameAndGroup(); // Перекомпоновка наименования
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>

    <?php
    $type = $vendorCode = $name = $typeCard = $brand = $trademark = $model = $spec = $rigid = $color = $series = $handle = $handleMat = $length =
    $grab = $weight = $price = $discount = $priceWithDiscount = $stockStatus = $group = $desc = $searchVendorCode = null;
    $images = "";
    $prodIDForEdit = -1; // Временная переменная ID карточки, нужна для обновления

    // Получаем параметры через GET REQUEST и загружаем их из БД
    if(isset($_GET["search_by_vendor_code"])) {
        // Получаем артикул через GET REQUEST
        $searchByVendorCode = $_GET["search_by_vendor_code"];

        // Получаем параметры из БД
        $conn  = new PDO('sqlite:database/cards.sqlite') or die("Cannot open the database");
        $stmt = $conn->prepare("SELECT * FROM prods WHERE p_vendor_code=:p_vendor_code");
        $stmt->execute([':p_vendor_code' => $searchByVendorCode]);
        $cardArray = $stmt->fetch();
        $conn=null;
        $prodIDForEdit = $cardArray[0];
    ?>
        <script>
            document.getElementById('save_card_btn').disabled = false;
            document.getElementById('save_card_pseudo').style.display = "block";
            vendorCodeOfEdited = "<?php echo $cardArray[1]; ?>";
            // Заполняем поля карточки
            document.getElementById("p_vendor_code_input").value = "<?php echo $cardArray[1]; $vendorCode=$cardArray[1]; ?>";
            document.getElementById('prod_manage_title').innerHTML = "<?php echo $cardArray[1]; ?>";
            document.getElementById("p_type").value = "<?php echo $cardArray[2]; ?>";
            document.getElementById("p_name_input").value = "<?php echo $cardArray[3]; ?>";
            document.getElementById('p_name_input_cont').setAttribute('title', document.getElementById('p_name_input').value);
            document.getElementById("p_type_card_input").value = "<?php echo $cardArray[4]; ?>";
            document.getElementById("p_brand_input").value = "<?php echo $cardArray[5]; ?>";
            document.getElementById("p_trademark_input").value = "<?php echo $cardArray[6]; ?>";
            document.getElementById("p_model_input").value = "<?php echo $cardArray[7]; ?>";
            document.getElementById("p_spec_input").value = "<?php echo $cardArray[8]; ?>";
            document.querySelector('input[type=radio][value="<?php echo $cardArray[9]; ?>"]').checked=true;
            document.getElementById("p_color_input").value = "<?php echo $cardArray[10]; ?>";
            document.getElementById("p_series_input").value = "<?php echo $cardArray[11]; ?>";
            document.getElementById("p_handle_input").value = "<?php echo $cardArray[12]; ?>";
            document.getElementById("p_handle_mat_input").value = "<?php echo $cardArray[13]; ?>";
            document.querySelector('input[type=radio][value="<?php echo $cardArray[14]; ?>"]').checked=true;
            document.querySelector('input[type=radio][value="<?php echo $cardArray[15]; ?>"]').checked=true;
            document.getElementById("p_weight_input").value = "<?php echo $cardArray[16]; ?>";
            document.getElementById("p_price_input").value = "<?php echo $cardArray[17]; ?>";
            document.getElementById("p_discount_input").value = "<?php echo $cardArray[18]; ?>";
            document.getElementById("p_price_with_discount_input").value = "<?php echo $cardArray[19]; ?>";
            document.getElementById("p_stock_status_input").value = "<?php echo $cardArray[20]; ?>";
            document.getElementById("p_group_input").value = "<?php echo $cardArray[21]; ?>";
            document.getElementById('p_group_input_cont').setAttribute('title', document.getElementById('p_group_input').value);
            document.getElementById("p_desc_input").value = "<?php echo $cardArray[22]; ?>";
            if(document.getElementById("p_type").value==="Клюшка"){ showSticksParams(); }
            loadImages(<?php echo $cardArray[23]; ?>);
        </script>
    <?php
    }

    // Получаем параметры через POST REQUEST и сохраняем в БД
    if(isset($_POST["save_card"])) {
        // Получаем параметры через POST REQUEST
        $type = $_POST["type"]; // 1
        $vendorCode = $_POST["vendor_code"]; // 2
        $name = $_POST["name"]; // 3
        $brand = $_POST["brand"]; // 4
        $typeCard = $_POST["type_card"]; // 5
        $trademark = $_POST["trademark"]; // 6
        $model = $_POST["model"]; // 7
        $spec = $_POST["spec"]; // 8
        $rigid = $_POST["rigid"]; // 9
        $color = $_POST["color"]; // 10
        $series = $_POST["series"]; // 11
        $handle = $_POST["handle"]; // 12
        $handleMat = $_POST["handle_mat"]; // 13
        $length = $_POST["length"]; // 14
        $grab = $_POST["grab"]; // 15
        $weight = $_POST["weight"]; // 16
        $price = $_POST["price"]; // 17
        $discount = $_POST["discount"]; // 18
        $priceWithDiscount = $_POST["price_with_discount"]; // 19
        $stockStatus = $_POST["stock_status"]; // 20
        $group = $_POST["group"]; // 21
        $desc = $_POST["desc"]; // 22

        $targetDir = 'images/prods/';
        $total = 0;
        if(array_key_exists('images', $_FILES)){
            $total = count($_FILES['images']['name']);
        }
        if($total>0){
            $imagesArr = [];
            for($i=0; $i<$total ; $i++){
                if(basename($_FILES["images"]["name"][$i] == "")){
                    continue;
                }
                $uploadOk = 1;
                $targetFile = $targetDir.basename($_FILES["images"]["name"][$i]);
                $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
                $imagesArr[] = $targetFile;
                // Проверяем, изображение ли
//                $checkIfImage = getimagesize($_FILES["images"]["name"][$i]);
//                if($checkIfImage === false) {
//                    logMes("File \"".basename($_FILES["images"]["name"][$i])."\" is a fake image!");
//                    $uploadOk = 0;
//                }

                // Проверяем, не существует ли уже
                if (file_exists($targetFile)) {
                    logMes("File named \"".basename($_FILES["images"]["name"][$i])."\" already exists!");
                    $uploadOk = 0;
                }

                // Проверяем формат
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif"  && $imageFileType != "bmp") {
                    logMes("Available formats are JPG, JPEG, PNG, GIF, BMP.");
                    $uploadOk = 0;
                }

                // Проверяем можно ли загрузить файл
                if ($uploadOk == 0) { // нельзя
                    logMes("File \"".basename( $_FILES["images"]["name"][$i])."\" was not uploaded!");

                } else { // можно
                    if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetDir.$_FILES['images']["name"][$i])) {
                        logMes("File \"".basename( $_FILES["images"]["name"][$i])."\" was uploaded!");
                    } else {
                        logMes("When uploading file \"".basename( $_FILES["images"]["name"][$i])."\" an error occurred!");
                    }
                }
            }
            $images = json_encode($imagesArr);
        }

        // Сохраняем в БД
        if($prodIDForEdit==-1){
            $conn  = new PDO('sqlite:database/cards.sqlite') or die("Cannot open the database");
            $sql = "INSERT INTO prods (p_vendor_code, p_type, p_name, p_type_card, p_brand, p_trademark, p_model, p_spec, p_rigid, p_color, p_series, 
               p_handle, p_handle_mat, p_length, p_grab, p_weight, p_price, p_discount, p_price_with_discount, p_stock_status, p_group, p_desc, 
               p_images) VALUES('$vendorCode', '$type', '$name', '$typeCard', '$brand', '$trademark', '$model', '$spec', '$rigid', '$color', '$series', 
               '$handle', '$handleMat', '$length', '$grab', '$weight', '$price', '$discount', '$priceWithDiscount', '$stockStatus', '$group',
                '$desc', '$images')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $conn=null;
        } else {
            $conn = new PDO('sqlite:database/cards.sqlite') or die("Cannot open the database");
            $sql = "UPDATE prods SET p_vendor_code='$vendorCode', p_type='$type', p_name='$name', p_type_card='$typeCard', p_brand='$brand', 
                 p_trademark='$trademark', p_model='$model', p_spec='$spec', p_rigid='$rigid', p_color='$color', p_series='$series', 
                 p_handle='$handle', p_handle_mat='$handleMat', p_length='$length', p_grab='$grab', p_weight='$weight', p_price='$price', 
                 p_discount='$discount', p_price_with_discount='$priceWithDiscount', p_stock_status='$stockStatus', p_group='$group',
                 p_desc='$desc', p_images='$images' WHERE ID='$prodIDForEdit'";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
            // Ресетим временную переменную ID карточки
            $prodIDForEdit = -1;
        }
    ?>
            <script>
                // Обновляем страницу
                window.location.href = 'product-manage.php';
            </script>
    <?php
    }
    ?>
</body>
</html>