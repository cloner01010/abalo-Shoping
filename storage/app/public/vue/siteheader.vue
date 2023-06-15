<template>
    <div class="container">
        <img class="container--logo" src="../logoabalo.JPG" alt="">
    </div>
    <header class="header" id="header">
        <nav class="header__navbar" id="navbar">
            <ul class="header__navbar--menu-list">
                <li v-for="items in menuItems"><a :href="items.link">{{ items.label }}</a>
                    <ul v-if="items.submenu" class="header__navbar--submenu-list">
                        <li v-for="submenu in items.submenu"><a :href="submenu.link">{{ submenu.label }}</a></li>
                    </ul>
                    <ul v-else-if="items.label === 'Kategorien'" class="header__navbar--submenu-list">
                        <li v-for="category in cat"><a :href="category.link">{{ category.label }}</a>
                            <ul v-if="category.submenu" class="header__navbar--sub-submenu-list ">
                                <li v-for="submenu in category.submenu"><a :href="submenu.link">{{ submenu.label }}</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>

        <div class="header--logout">
            <button @click="logout" class="header__button" type="submit" value="Logout">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-door-closed"
                    viewBox="0 0 16 16">
                    <path
                        d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z" />
                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z" />
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
            menuItems: [],
            cat: [],
            maintenanceMessage: '',
        };
    },
    created() {
        this.loadData();
        this.renderNav();
    },

    methods: {
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
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        self.cat = JSON.parse(xhr.responseText);
                    }
                }
            }
            xhr.send();
        },
        renderNav() {
            const self = this;
            self.menuItems = [
                { label: 'Home', link: "/" },
                { label: 'Neuer Einstieg', link: '/newsite' },
                { label: 'Kategorien', link: '#' },
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

        }
    }
}
</script>

<style scoped lang="scss">
.container {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;

    &--logo {
        width: 250px;
        height: auto;
    }
}

.header {
    padding: 10px;

    &__navbar {
        background-color: #333;
        padding: 10px;

        &--menu-list {
            list-style: none;
            padding: 0;
            margin: 0;

            li {
                display: inline-block;

                a {
                    display: block;
                    padding: 10px 20px;
                    text-decoration: none;
                    color: white;

                    &:hover {
                        background-color: grey;
                    }
                }

                &:hover>.header__navbar--submenu-list {
                    display: block;
                }
            }
        }

        &--submenu-list {
            display: none;
            position: absolute;
            background-color: #333;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);

            li {
                display: block;

                a {
                    padding: 10px 20px;
                }
            }
        }

        &--sub-submenu-list {
            display: none;
            position: absolute;
            left: 100%;
            top: 0;
            background-color: #333;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);

            li {
                display: block;

                a {
                    padding: 10px 20px;
                }
            }
        }

        &--submenu-list li:hover>.header__navbar--sub-submenu-list {
            display: block;
            left: 100%;
            top: 0;
        }
    }

    &--logout {
        position: absolute;
        display: inline;
        top: 0;
        right: 0;
    }

    i {
        width: fit-content;
    }

    &__button {
        background-color: white;
        border: none;
        width: fit-content;
        padding: 0px 10px;
        margin: 10px;
        cursor: pointer;
        border-radius: 25px;

        &:hover {
            background-color: RoyalBlue;
        }
    }
}

</style>
