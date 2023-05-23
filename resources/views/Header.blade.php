<head>
    <script src="{{ asset('storage/js/navbar.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('storage/css/navbar.css') }}">
</head>
<header class="header-container" id="header">
    <div id="data-kategorien" data-kategorien="{{ $kategorien }}"></div>
    <nav class="navbar" id="navbar">
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const kategorienData = JSON.parse(document.getElementById('data-kategorien').getAttribute('data-kategorien'));
                const menuItems = [
                    { label: 'Home', link: "/" },
                    {label: 'Neuer Einstieg', link: '/newsite'},
                    { label: 'Kategorien', link: '#'},
                    {
                        label: 'Verkaufen', link: '#',
                        submenu: [
                            { label: 'Neuer Artikel', link: '/newarticle' },
                        ]
                    },
                    {
                        label: 'Unternehmen',
                        link: '#',
                        submenu: [
                            { label: 'Philosophie', link: '#' },
                            { label: 'Karriere', link: '#' }
                        ]
                    }
                ];
                const nav = new Navigation(menuItems);
                nav.setKategorien(kategorienData);
                nav.render('navbar');
            });
        </script>
    </nav>
    <div class="logout">
        <form method="get" action="{{ route('logout') }}">
            <button class="btn" type="submit" value="Logout"><i
                    class="fa-solid fa-right-from-bracket fa-lg"></i></button>
        </form>
    </div>
    <div class="shopping-cart">
        <button class="btn"><i onclick="showCart()"
                class="shopping-cart-btn fa-solid fa-cart-shopping fa-lg"></i></button>
    </div>
    <div class="amount">
        <p class="amount-text"></p>
    </div>
    <div id="cart-container" class="cart-container">
        <table id="cart-table">
            <tr class="cart-header">
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Creator</th>
            </tr>
        </table>
    </div>
    <div>
        <form method="get" action="{{ route('articles') }}">
            <input type="search" name="search" class="question" id="nme" required autocomplete="off"
                value="{{ request('search') }}" />
            <label for="nme"><span>Search</span></label>
            <button class="search-button btn" type="submit" value="search"><i
                    class="fa-brands fa-searchengin fa-xl"></i></button>
        </form>
    </div>
</header>
