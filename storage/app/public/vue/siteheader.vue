<template>
    <header class="header-container" id="header">
        <nav class="navbar" id="navbar">
            <ul class="menu-list">
                <li v-for="items in menuItems"><a :href="items.link">{{items.label}}</a>
                    <ul v-if="items.submenu" class="submenu-list">
                        <li v-for="submenu in items.submenu" ><a :href="submenu.link">{{submenu.label}}</a></li>
                    </ul>
                    <ul v-else-if="items.label==='Kategorien'" class="submenu-list">
                        <li v-for="category in cat"><a>{{category.ab_name}}</a></li>
                    </ul>
                </li>
            </ul>

        </nav>

        <div class="logout">

                <button @click="logout" class="btn" type="submit" value="Logout"><i
                    class="fa-solid fa-right-from-bracket fa-xl"></i></button>
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
            console.log('es funktioniert');
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

.menu-list {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

.menu-list li {
    display: inline-block;
}

.menu-list li a {
    display: block;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
}

.menu-list li a:hover {
    background-color: #555;
}

.submenu-list {
    display: none;
    position: absolute;
    background-color: #333;
    padding: 10px;
    z-index: 1;
}

.menu-list li:hover .submenu-list {
    display: block;
}

.submenu-list li {
    display: block;
}

.submenu-list li a {
    color: #fff;
    text-decoration: none;
}

.submenu-list li a:hover {
    background-color: #555;
}
.header-container{
    padding: 30px;
}

.shopping-cart{
    float: right;
}
.logout{
    position: absolute;
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


</style>
