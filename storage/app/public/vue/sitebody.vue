<template>
    <main>

   <!--     <div class="shopping-cart">
            <shopping-cart-popup :current-page="articles.current_page" @remove-item="loadData"></shopping-cart-popup>
        </div> -->
        <div class="pagination">
            <pagination  :pagination="articles" @page-change="loadData"></pagination>
        </div>
        <div class="card-container">
            <div  v-for="article in articles['data']" :key="article.id" class="card">
                <img :src="article.ab_file_path" alt="Artikel">
                <h2>{{article.ab_name}}</h2>
                <h3>{{article.ab_price}} €</h3>
                <h5>{{article.ab_description}}</h5>
                <h5>Von <a href="">{{article.user_name}}</a></h5>
                <h5>Seit {{article.ab_createdate}} Tagen Online</h5>
                <p>
                    <input type="submit" id="login" value="Anfrage Senden">
                </p>
            </div>
        </div>
       <!-- <table id="articles-table">
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

        </table> -->
        <sitefooter @show-impressum="imprint"></sitefooter>
        <impressum @hide-impressum="imprint" v-if="showImpressum"></impressum>
    </main>
</template>

<script>

import ShoppingCartPopup from "./shopping-cart.vue";
import pagination from "./pagination.vue";
import search from "./search.vue";
import impressum from "./impressum.vue";
import sitefooter from "./sitefooter.vue";

export default {

    data() {
        return {
            articles:[],
            showImpressum: false
        };
    },
    components: {
        ShoppingCartPopup,
        pagination,
        search,
        sitefooter,
        impressum
    },
    created() {
        this.loadData({search:"",page:1});

    },
    methods:{
        loadData({search,page}){
            const self = this;
            let xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/articles?page='+page+'&search='+search);
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
                            self.loadData({search:"",page:self.articles.current_page});
                        }
                    }
                }
            }
            xhr.send(JSON.stringify({
                id: event.target.parentElement.id
            }));
        },
        imprint(show){
            const self = this;
            self.showImpressum=show;
        }
    }
}
</script>

<style scoped>

input {
    display: block;
    box-sizing: border-box;
    width: 100%;
    outline: none;
    height: 60px;
    line-height: 60px;
    border-radius: 4px;
}
input[type="submit"] {
    border: none;
    display: block;
    background-color: #3ca9e2;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
    font-size: 18px;
    position: relative;
    display: inline-block;
    cursor: pointer;
    text-align: center;
}
input[type="submit"]:hover {
    background-color: #329dd5;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
.pagination{
    float: left;
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


.shopping-cart{

    position: relative;
    float: right;
    margin: 25px;


}

.card-container {
    position: relative;
    display: grid;
    width: 900px;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 15px;
    margin: 10px;
}

.card {
    width: 300px;
    background-color: #e5dada;
    padding: 20px;
    border-radius: 8px;
}

.card img {
    width: 300px;
    height: 200px;
    border-radius: 8px;
    margin-bottom: 10px;
}

.card h3 {
    font-size: 20px;
    margin-bottom: 10px;
}

.card p {
    font-size: 14px;
    color: #666;
}


</style>

