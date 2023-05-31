<template>
    <div class="shopping-cart">
        <shopping-cart-popup :current-page="articles.current_page" @remove-item="loadData"></shopping-cart-popup>
    </div>
    <main>
        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-input">
            <button class="search-button btn" type="submit" value="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
        </div>
        <div class="pagination">
            <pagination  :pagination="articles" @page-change="loadData"></pagination>
        </div>
        <table id="articles-table">
            <tr id="header-table">
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Creator</th>
                <th>Created at</th>
            </tr>
            <tr v-for="article in articles['data']" :key="article.id">
                <th><img class="article-image" :src="article.ab_file_path" alt="Artikel"></th>
                <th>{{article.ab_name}}</th>
                <th>{{article.ab_price}}€</th>
                <th>{{article.ab_description}}</th>
                <th>{{article.user_name}}</th>
                <th>{{article.ab_createdate}}</th>
                <th><button @click="addCartItem" :id="article.id" class="btn add-btn">
                    <svg :id="article.id" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="add-btn bi bi-cart-plus-fill" viewBox="0 0 16 16">
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z"/>
                    </svg>
                </button></th>
            </tr>


        </table>
    </main>
</template>

<script>

import ShoppingCartPopup from "./shopping-cart.vue";
import pagination from "./pagination.vue";

export default {

    data() {
        return {
            articles:[],


        };
    },
    components: {
        ShoppingCartPopup,
        pagination
    },
    created() {
        this.loadData(1);

    },
    methods:{
        loadData(page){
            const self = this;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/articles?page='+page);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function(){
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        self.articles=JSON.parse(xhr.responseText);


                    }
                }
            }
            xhr.send();
        },
        addCartItem(event) {
            const self = this;
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/api/shoppingcart');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader("X-CSRF-Token", csrfToken);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.errors) {
                            alert(response.errors);
                        } else {
                            self.loadData(self.articles.current_page);
                        }
                    }
                }
            }
            xhr.send(JSON.stringify({
                id: event.target.parentElement.id
            }));
        },
    }
}
</script>

<style scoped>
.pagination{
    float: right;
    margin:25px;
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
.add-btn {
    background: none;
    display: inline-flex; /* Ensures the button only takes the necessary width */
    align-items: center; /* Aligns the icon vertically in the button */
    padding: 0; /* Removes any default padding */
    border: none; /* Removes any default border */
    cursor: pointer; /* Adds cursor pointer on hover */
    border-radius: 25px;
}

.btn:hover {
    background-color: RoyalBlue;
}
i{
    width:fit-content;
}

main{
    padding: 30px;

}
html {
    font-family: 'Lora', sans-serif;
    width: 100%;
}

body {
    /* margin: 5% auto 0 auto;*/
    padding: 0 20px 20px 20px;
    width: 95%;
}

h1 {
    font-size: 28px;
    margin-bottom: 2.5%;
}


table{
    border-spacing: 30px;
}

.article-image{
    height: 120px;
    width: auto;

}

.search-container {
    display: flex;
    align-items: center;
    background-color: #f5f5f5;
    border-radius: 4px;
    padding: 8px;
}

.search-input {
    flex: 1;
    border: none;
    outline: none;
    background-color: transparent;
    font-size: 16px;
    padding: 8px;
}
.search-button{
    background-color: transparent;

}
.shopping-cart{

    position: absolute;
    top: 0;
    right: 50px;

}



</style>

