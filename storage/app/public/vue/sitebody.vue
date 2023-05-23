<template>
    <div class="shopping-cart">
        <shopping-cart-popup @remove-item="loadData"></shopping-cart-popup>
    </div>
    <main>
        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-input">
            <button class="search-button btn" type="submit" value="search">
                <i class="fa-brands fa-searchengin fa-xl"></i>
            </button>
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
            <tr v-for="article in articles['articles']" :key="article.id">
                <th><img class="article-image" :src="article.ab_file_path" alt="Artikel"></th>
                <th>{{article.ab_name}}</th>
                <th>{{article.ab_price}}€</th>
                <th>{{article.ab_description}}</th>
                <th>{{article.user_name}}</th>
                <th>{{article.ab_createdate}}</th>
                <th><button @click="addCartItem" :id="article.id" class="btn"><i :id="article.id" class="add-btn fa-solid fa-circle-plus fa-xl"></i></button></th>
            </tr>


        </table>
    </main>
</template>

<script>

import ShoppingCartPopup from "./shopping-cart.vue";

export default {

    data() {
        return {
            articles:[],

        };
    },
    components: {
        ShoppingCartPopup,
    },
    created() {
        this.loadData();

    },
    methods:{
        loadData(){
            const self = this;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/articles');
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
                            self.loadData();
                        }
                    }
                }
            }
            xhr.send(JSON.stringify({
                id: event.target.id
            }));
        }
    }
}
</script>

<style scoped>
.btn {
    background-color: white; /* Blue background */
    border: none; /* Remove borders */
    width: fit-content;
    padding: 0px 10px;
    margin: 10px;
    cursor: pointer; /* Mouse pointer on hover */
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
    right: 40px;

}



</style>

