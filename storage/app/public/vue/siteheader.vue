<template>
    <div class="logo-container">
        <img class="logo" src="../logoabalo.JPG" alt="">
    </div>
    <header class="header-container" id="header">
        <nav class="navbar" id="navbar">
            <ul class="menu-list">
                <li v-for="items in menuItems"><a :href="items.link">{{items.label}}</a>
                    <ul v-if="items.submenu" class="submenu-list">
                        <li v-for="submenu in items.submenu" ><a :href="submenu.link">{{submenu.label}}</a></li>
                    </ul>
                    <ul v-else-if="items.label==='Kategorien'" class="submenu-list">
                        <li  v-for="category in cat"><a :href="category.link">{{category.label}}</a>
                            <ul v-if="category.submenu" class="submenu-submenu-list">
                                <li v-for="submenu in category.submenu" ><a :href="submenu.link">{{submenu.label}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>

        <div class="logout">

                <button @click="logout" class="btn" type="submit" value="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
                        <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                    </svg>
                </button>
        </div>
    </header>

</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            menuItems:[],
            cat:[],
        };
    },
    created() {
        this.loadData();
        this.renderNav();
    },

    methods:{
        logout() {
            axios.get('/logout')
                .then(response => {
                    // Redirect the user to the desired location
                    window.location.href = '/';
                })
                .catch(error => {
                    console.error(error);
                });
        },
        loadData() {
            const self = this;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/category');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        self.cat=JSON.parse(xhr.responseText);
                    }
                }
            }
            xhr.send();
        },
        renderNav(){
            const  self=this;
            self.menuItems=[
                {label: 'Home', link: "/"},
                {label: 'Neuer Einstieg', link: '/newsite'},
                {label: 'Kategorien', link: '#'},
                {
                    label: 'Verkaufen', link: '#',
                    submenu: [
                        {label: 'Neuer Artikel', link: '/newarticle'},
                    ]
                },
                {
                    label: 'Unternehmen',
                    link: '#',
                    submenu: [
                        {label: 'Philosophie', link: '#'},
                        {label: 'Karriere', link: '#'}
                    ]
                }
            ];

        }
    }
}
</script>

<style scoped>
.navbar {
    background-color: #333;
    padding: 10px;
}

/* Styles for the main navigation bar */
.menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-list li {
    display: inline-block;
}

.menu-list li a {
    display: block;
    padding: 10px 20px;
    text-decoration: none;
    color: white;
}

.menu-list li:hover > a {
    background-color: grey;
}

/* Styles for the nested submenus */
.submenu-list {
    display: none;
    position: absolute;
    background-color: #333;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}

.submenu-list li {
    display: block;
}

.submenu-list li a {
    padding: 10px 20px;
}

.submenu-submenu-list {
    display: none;
    position: absolute;
    left: 100%;
    top: 0;
    background-color: #333;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
}

.submenu-submenu-list li {
    display: block;
}

.submenu-submenu-list li a {
    padding: 10px 20px;
}

/* Show the submenus on hover */
.menu-list li:hover > .submenu-list {
    display: block;
}

.submenu-list li:hover > .submenu-submenu-list {
    display: block;
    left: 100%;
    top: 0;
}



.header-container{
    padding: 10px;
}

.shopping-cart{
    float: right;
}
.logout{
    position: absolute;
    display: inline;
    top: 0;
    right: 0;
}

i{
    width:fit-content;
}
/* Darker background on mouse-over */
.btn:hover {
    background-color: RoyalBlue;
}

.btn {
    background-color: white; /* Blue background */
    border: none; /* Remove borders */
    width: fit-content;
    padding: 0px 10px;
    margin: 10px;
    cursor: pointer; /* Mouse pointer on hover */
    border-radius: 25px;
}
.logo-container {
    position: relative;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    padding: 10px; /* Add some padding around the logo */
}
.logo{
    width: 250px; /* Set the desired width of the logo */
    height: auto;
}

</style>
