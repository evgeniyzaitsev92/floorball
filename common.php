<?php
// *** Хэдер *** \\
function setHeader(){
    echo '
        <header class="container d-flex flex-dir-col">
            <div class="header-border--upper">
                <div class="header-container header-container--upper d-flex jc-sb">
                    <div class="header-container--upper-left d-flex ai-cntr">
                        <p><span>Добро пожаловать</span> в команду UNIHOC</p>
                        <a href=""><img class="header-ext-link" src="icons/external_link.svg"></a>
                    </div>
                    <p class="">— Участие важно,<br>     но главное — это победа!</p>
                </div>
            </div>
            
            <div class="">           
                <div class="header-container d-flex jc-sb ai-cntr">
                    <div class="header-logo-main-menu d-flex ai-cntr">
                        <!-- ЛОГО -->
                        <a href="index.php"><img src="images/logo56.png"></a>
                        
                        <!-- ГЛАВНОЕ МЕНЮ -->
                        <nav class="header-menu">
                            <ul class="d-flex">
                                <li>
                                    <div class="drop-menu">
                                        <ul class="d-flex jc-center">
                                            <li><a href="catalog.php?brand=UNIHOC"><i class="fa"></i>UNIHOC</a>
                                                <ul>
                                                    <li><a href="catalog.php?brand=UNIHOC&type=sticks">Клюшки</a>
                                                    <li><a href="catalog.php?brand=UNIHOC&type=balls">Мячи</a>
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="drop-menu">
                                        <ul class="d-flex jc-center">
                                            <li><a href=""><i class="fa"></i>ZONEFLOORBALL</a>
                                                <ul>
                                                    <li><a href="">Клюшки</a>
                                                    <li><a href="">Мячи</a>
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="drop-menu">
                                        <ul class="d-flex jc-center">
                                            <li><a href=""><i class="fa"></i>UnihocZoneRussia</a>
                                                <ul>
                                                    <li><a href="">Клюшки</a>
                                                    <li><a href="">Мячи</a>
                                                </ul>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    
                    <!-- ПОИСК ТОВАРОВ ПО СЛОВАМ -->
                    <div class="d-flex">
                        <input class="header-input" id="search_by_word_input" type="text" name="search_by_word" placeholder="Что ищем...">
                        <label for="search_by_word_btn"><img class="header-input-img" src="icons/search.svg"></label>
                        <button hidden id="search_by_word_btn" onclick="searchByWord()"></button>
                    </div>
                    
                    <script>
                    function searchByWord(){
                        let searchString = document.getElementById("search_by_word_input").value;
                        if(searchString === "") {window.location.href = "catalog.php"; }
                        else {window.location.href = "catalog.php?search_by_word="+searchString; }
                    }
                    </script>
                    
                    <div class="header-icons-container d-flex jc-sb ai-cntr">
                        <a href="" class="header-icon-btn--cont icons" title="Фильтры"><img class="header-icon-btn icons--svg" src="icons/combo_chart.svg"></a>
                        <a href="" class="header-icon-btn--cont icons" title="Избранное"><img class="header-icon-btn icons--svg" src="icons/favorite.svg"></a>
                        <a href="" class="header-icon-btn--cont icons" title="Личный кабинет"><img class="header-icon-btn icons--svg" src="icons/login.svg"></a>
                        <a href="" class="header-icon-btn--cont icons" title="Корзина"><img class="header-icon-btn icons--svg" src="icons/open_cart.svg"></a>
                        <a href="product-manage.php" class="icons" title="Добавить товар">+</a> 
                    </div>
                       
                </div>
            </div>
        </header>
    ';

    if(isset($_GET["search_by_word"])){
        echo '
        <script>
        document.getElementById("search_by_word_input").value = "'.$_GET["search_by_word"].'";
        </script>
        ';
    }
}

// *** Футер *** \\
function setFooter(){
    echo '
         <footer class="container">
            <div class="footer-container d-flex jc-sb">
                <div class="footer-item">
                    <h1>АССОРТИМЕНТ</h1>
                    <div class="footer-item--points d-flex flex-dir-col">
                        <a href="">Клюшки</a>
                        <a href="">Крюки</a>
                        <a href="">Сумки и чехлы</a>
                        <a href="">Вратарская экипировка</a>
                        <a href="">Базовая коллекция</a>
                    </div>
                </div>
    
                <div class="footer-item">
                    <h1>ИНФОРМАЦИЯ</h1>
                    <div class="footer-item--points d-flex flex-dir-col">
                        <a href="">О нас</a>
                        <a href="">Чем отличаются наши товары</a>
                        <a href="">Где посмотреть и как купить</a>
                        <a href="">Подбор товаров и экипировки</a>
                        <a href="">Оплата и доставка заказов</a>
                        <a href="">Если не нашли то, что искали</a>
                        <a href="">Подписка на новости</a>
                        <a href="">Карта сайта</a>
    
                    </div>
                </div>
    
                <div class="footer-item">
                    <h1>СТАТЬИ И ЗАМЕТКИ</h1>
                    <div class="footer-item--points d-flex flex-dir-col">
                        <a href="">Про жёсткость (флекс)</a>
                        <a href="">Технологии рукояток</a>
                        <a href="">Как подобрать клюшку</a>
                        <a href="">Длина рукоятки/клюшки/габарит</a>
                        <a href="">Какая клюшка крепче и прочнее</a>
                        <a href="">Немного о крюках (перьях...)</a>
                        <a href="">Правые и левые клюшки и крюки</a>
                        <a href="">Сборка и компоновка клюшек</a>
                        <a href="">Разное (ответы на вопросы)</a>
                    </div>
                </div>
    
                <div class="footer-item">
                    <h1>ПОДДЕРЖКА ПОКУПАТЕЛЕЙ</h1>
                    <div class="footer-item--points d-flex flex-dir-col">
                        <a href="">Свяжитесь с нами</a>
                        <a href="">Заказать обратный звонок</a>
                        <a href="">Обмен и возврат товаров</a>
                        <a href="">Оплата и доставка заказов</a>
    
                        <div class="footer-item--icons d-grid">
                            <a href="index.php"><img src="icons/black_gmail.svg"></a>
                            <a href="index.php"><img src="icons/black_vk.svg"></a>
                            <a href="index.php"><img src="icons/black_whatsapp.svg"></a>
                            <a href="index.php"><img src="icons/black_email_send.svg"></a>
                            <a href="index.php"><img src="icons/black_viber.svg"></a>
                            <a href="index.php"><img src="icons/black_youtube.svg"></a>
                            <a href="index.php"><img src="icons/black_master_card.svg"></a>
                            <a href="index.php"><img src="icons/black_visa.svg"></a>
                        </div>
    
                        <span>+7 (910) 795-55-55</span>
                    </div>
                </div>
            </div>
        </footer>
    ';
}
?>
