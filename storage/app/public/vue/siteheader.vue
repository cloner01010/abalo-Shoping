<template>
    <div class="logo-container">
        <img class="logo" src="../logoabalo.JPG" alt="">
    </div>
    <header class="header-container" id="header">
        <nav class="navbar" id="navbar">
            <ul class="menu-list">
                <li v-for="items in menuItems"><a :href="items.link">{{items.label[langId]}}</a>
                    <ul v-if="items.submenu" class="submenu-list">
                        <li v-for="submenu in items.submenu" ><a :href="submenu.link">{{submenu.label[langId]}}</a></li>
                    </ul>
                    <ul v-else-if="items.label==='Kategorien'" class="submenu-list">
                        <li  v-for="category in cat"><a :href="category.link">{{category.label}}</a>
                            <ul v-if="category.submenu" class="submenu-submenu-list">
                                <li v-for="submenu in category.submenu" ><a :href="submenu.link">{{submenu.label}}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <search @search-input="loadData"></search>
                </li>
                <li>
                    <div id="language-switcher">
                        <button class="language-button" @click="changeLanguage('en')">
                            <img src="../united-kingdom-uk-svgrepo-com.svg" alt="">
                        </button>
                        <button class="language-button" @click="changeLanguage('de')">
                            <img src="../flag-for-flag-germany-svgrepo-com.svg" alt="">
                        </button>
                    </div>
                </li>
                <li> <div class="logout">

                    <button @click="logout" class="btn" type="submit" value="Logout">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-door-closed" viewBox="0 0 16 16">
                            <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                            <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                        </svg>
                    </button>
                </div></li>
            </ul>

        </nav>

    </header>

</template>

<script>
import axios from 'axios';
import search from "./search.vue";
export default {
    components: {search},
    data() {
        return {
            menuItems:[],
            cat:[],
            langId:0
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
        changeLanguage(lang){
            const self = this;
            if(lang==="en"){
                self.langId=0;
            }else{
                self.langId=1;
            }
        },
        renderNav(){
            const  self=this;
            self.menuItems=[
                {label: ['Home','Startseite'], link: "/"},
                {label: ['New Site','Einstieg'], link: '/newsite'},
                {label: ['Categories','Kategorien'], link: '#'},
                {
                    label: ['Sell Now','Verkaufen'], link: '#',
                    submenu: [
                        {label: ['New Article','Neuer Artikel'], link: '/newarticle'},
                    ]
                },
                {
                    label: ['Company','Unternehmen'],
                    link: '#',
                    submenu: [
                        {label: ['Philosophy','Philosophie'], link: '#'},
                        {label: ['Career','Karriere'], link: '#'}
                    ]
                }
            ];

        }
    }
}
</script>

<style scoped>
.navbar {
    background-color: #e5dada;
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
    color: black;
}

.menu-list li:hover > a {
    background-color: #565353;
}

/* Styles for the nested submenus */
.submenu-list {
    display: none;
    position: absolute;
    background-color: #e5dada;
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
    background-color: #e5dada;
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
   margin-left: 10px;
}

i{
    width:fit-content;
}
/* Darker background on mouse-over */
.btn:hover {
    background-color: #565353;
}

.btn {
    background-color: #e5dada; /* Blue background */
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
#language-switcher {
    display: flex;
    gap: 5px;
    width: 100px;
    margin-right: 10px;
    margin-left: 10px;
}

.language-button {
    border: none;
    cursor: pointer;
    background: transparent;

}
ul li:nth-child(-n+5) {
    width: 120px;
}




</style>
