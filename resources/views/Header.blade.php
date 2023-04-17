<head>
    <script src="{{ asset('storage/js/navbar.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('storage/css/navbar.css') }}">
</head>
<header class="header-container" id="header">
    <nav class="navbar" id="navbar">
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
