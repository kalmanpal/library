<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menü</title>
    <meta name="description" content="Blueprint: A basic template for a responsive multi-level menu" />
    <meta name="keywords" content="blueprint, template, html, css, menu, responsive, mobile-friendly" />
    <meta name="author" content="Codrops" />
    <link rel="shortcut icon" href="menucssfold/favicon.ico">
    <!-- food icons -->
    <link rel="stylesheet" type="text/css" href="menucssfold/css/organicfoodicons.css" />
    <!-- demo styles -->
    <link rel="stylesheet" type="text/css" href="menucssfold/css/demo.css" />
    <!-- menu styles -->
    <link rel="stylesheet" type="text/css" href="menucssfold/css/component.css" />
    <script src="menucssfold/js/modernizr-custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>



<body>
    <!-- Main container -->
    <div class="container">
        <!-- Blueprint header -->
        <header class="bp-header cf">
            <div class="dummy-logo">
                <div class="dummy-icon foodicon foodicon--coconut"></div>
                <h2 class="dummy-heading">20%</h2>
            </div>
            <div class="bp-header__main">
                <span class="bp-header__present">20% Könyvtár <span class="bp-tooltip bp-icon bp-icon--about"
                        data-content="The Blueprints are a collection of basic and minimal website concepts, components, plugins and layouts with minimal style for easy adaption and usage, or simply for inspiration."></span></span>

<!------------------------------------------------------------login------------------------------------------------------------------------------------------>

                @if (isset(Auth::user()->email))
                    <div>
                        <h1 class="bp-header__title">{{ Auth::user()->name }}</h1>
                        <br />
                        <a href="{{ url('/main/logout') }}">Kijelentkezés</a>
                    </div>
                @else
                    <script>
                        window.location = "/";
                    </script>
                @endif

<!---------------------------------------------------------------------------------------------------------------------------------------------------------->
                <nav class="bp-nav">
                    <!--VISSZA GONMB LEHET MEG BELOLE
     <a class="bp-nav__item bp-icon bp-icon--prev" href="http://tympanus.net/Blueprints/PageStackNavigation/" data-info="Vissza"><span>Vissa</span></a>-->

                    <!--a class="bp-nav__item bp-icon bp-icon--next" href="" data-info="next Blueprint"><span>Next Blueprint</span></a-->

                </nav>
            </div>
        </header>
        <button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
        <nav id="ml-menu" class="menu">
            <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
            <div class="menu__wrap">
                <ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="Kezdőlap">
                    <li><a class="menu__link" href="/home">Kezdőlap</a></li>
                    @if(Auth::user()->type === "D")
                        <li><a class="menu__link" href='/books'>Könyvek</a></li>
                        <li><a class="menu__link" href="/rental">Kölcsönzések</a></li>
                        <li><a class="menu__link" href="/reservations">Foglalások</a></li>
                        <li><a class="menu__link" href="/users">Felhasználók</a></li>
                    @else
                        <li><a class="menu__link" href="/book_reservation">Foglalás</a></li>
                        <li><a class="menu__link" href='/myhistory'>Kölcsönzés előzmények</a></li>
                    @endif
                    <li><a class="menu__link" href='/data_update'>Személyes adatok</a></li>
                </ul>

            </div>
        </nav>
        <div class="content">
            @yield('main_content')
            <!-- Ajax loaded content here -->
        </div>
    </div>
    <!-- /view -->
    <script src="menucssfold/js/classie.js"></script>
    <script src="menucssfold/js/dummydata.js"></script>
    <script src="menucssfold/js/main.js"></script>
    <script>
        (function() {
            var menuEl = document.getElementById('ml-menu'),
                mlmenu = new MLMenu(menuEl, {
                    breadcrumbsCtrl: true, // show breadcrumbs
                    initialBreadcrumb: 'all', // initial breadcrumb text
                    backCtrl: false, // show back button
                    itemsDelayInterval: 60, // delay between each menu item sliding animation
                    onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
                });

            // mobile menu toggle
            var openMenuCtrl = document.querySelector('.action--open'),
                closeMenuCtrl = document.querySelector('.action--close');

            openMenuCtrl.addEventListener('click', openMenu);
            closeMenuCtrl.addEventListener('click', closeMenu);

            function openMenu() {
                classie.add(menuEl, 'menu--open');
                closeMenuCtrl.focus();
            }

            function closeMenu() {
                classie.remove(menuEl, 'menu--open');
                openMenuCtrl.focus();
            }

            // simulate grid content loading
            var gridWrapper = document.querySelector('.content');

            function loadDummyData(ev, itemName) {
                ev.preventDefault();

                closeMenu();
                gridWrapper.innerHTML = '';
                classie.add(gridWrapper, 'content--loading');
                setTimeout(function() {
                    classie.remove(gridWrapper, 'content--loading');
                    gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
                }, 700);
            }
        })();

    </script>
</body>

</html>
