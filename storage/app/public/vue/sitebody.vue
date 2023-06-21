<template>
    <div v-if="maintenanceMessage" class="maintenance-popup">
        <button id="maintenanceMessage" class="close-button btn" @click="closePopUp">
            <svg id="maintenanceMessage" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </button>
        <h2>Under Maintenance</h2>
        <p>{{maintenanceMessage}}</p>
    </div>
    <div v-if="articleSoldMessage" class="maintenance-popup">
        <button id="articleSoldMessage" class="close-button btn" @click="closePopUp">
            <svg  id="articleSoldMessage" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </button>
        <h2>Verkauft</h2>
        <p>{{articleSoldMessage}}</p>
    </div>
    <div v-if="articleForSaleMessage" class="maintenance-popup">
        <button id="articleForSaleMessage" class="close-button btn" @click="closePopUp">
            <svg id="articleForSaleMessage" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </button>
        <h2>Angebot</h2>
        <p>{{articleForSaleMessage}}</p>
    </div>
    <main class="container">
        <search @search-input="loadData"></search>
        <div class="container--shopping-cart">
            <shopping-cart-popup :current-page="articles.current_page" @remove-item="loadData"></shopping-cart-popup>
        </div>
        <div class="container--pagination">
            <pagination :pagination="articles" @page-change="loadData"></pagination>
        </div>
        <div class="container__section">
            <div v-for="article in articles['data']" :key="article.id" class="container__section--card" >
                <img style="height: 75px; background-color: coral;" v-if="article.forSale" src="../for-sale.svg" alt="failed">
                    <img :src="article.ab_file_path" alt="Artikel">
                    <h3>{{ article.ab_name }}</h3>
                    <p>Price: {{ article.ab_price }} €</p>
                    <p>Description: {{ article.ab_description }}</p>
                    <p>Creator: {{ article.user_name }}</p>
                    <p>Created at: {{ article.ab_createdate }}</p>
                    <button @click="addCartItem" :id="article.id" class="container__button container__button--add">
                        <svg :id="article.id" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                             class="button--add bi bi-cart-plus-fill" viewBox="0 0 16 16">
                            <path
                                d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z" />
                        </svg>
                    </button>
                    <button @click="buy" :id="article.id" class="container__button container__button--add">
                        Kaufen
                    </button>
                    <button  v-if="article.ab_creator_id===user_id" @click="articleForSale" :id="article.id" class="container__button container__button--add">
                        Artikel jetzt als Angebot anbieten
                    </button>
            </div>

        </div>
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
import axios from 'axios';
export default {
    mounted() {
        this.loadData({ search: "", page: 1 });
        axios.get('/api/current-user')
            .then(response => {
                // Redirect the user to the desired location
                this.user_id=response.data;
                console.log(this.user_id);
                let socket = new WebSocket('ws://127.0.0.1:8888/?user_id='+this.user_id);
                socket.onopen = (event) => {

                };
                socket.onclose = (closeEvent) => {
                    console.log(
                        'Connection closed' +
                        ': code=', closeEvent.code,
                        '; reason=', closeEvent.reason);
                };
                socket.onmessage = (msgEvent) => {
                    let data=JSON.parse(msgEvent.data);
                    if(data.from==='MaintenanceMode') {
                        this.maintenanceMessage = data.message;
                    }
                    else if (data.from==='sold'){
                        this.articleSoldMessage=data.message;
                    }
                    else if (data.from==='forSale'){
                        let message=data.message.split('#');
                        const articles=this.articles["data"];
                        for (let i = 0; i < articles.length; i++) {
                            if (parseInt(articles[i].id)=== parseInt(message[1])) {
                                this.articles["data"][i].forSale=true;
                                this.articleForSaleMessage=message[0];
                            }
                        }
                    }
                };
            })
            .catch(error => {
                console.error(error);
            });

    },
    data() {
        return {
            articles: [],
            showImpressum: false,
            maintenanceMessage:'',
            articleSoldMessage:'',
            articleForSaleMessage:'',
            user_id:'',
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
       // this.loadData({ search: "", page: 1 });

    },

    methods: {
        loadData({ search, page }) {
            const self = this;
            let xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/articles?page=' + page + '&search=' + search);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        self.articles = JSON.parse(xhr.responseText);


          }
        }
      }
      xhr.send();
    },
    buy(event){
        const self = this;
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/articles/'+event.target.id+'/sold');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.setRequestHeader("X-CSRF-Token", csrfToken);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.errors) {
                        alert(response.errors);
                    } else {
                        console.log('Artikel '+event.target.id+' sold');
                    }
                }
            }
        }
        xhr.send(JSON.stringify({
            id: event.target.id
        }));
    },
    closePopUp(event){
            const id=event.target.parentElement.id;
            if(id==='maintenanceMessage'){
                this.maintenanceMessage='';
            }else if(id==='articleSoldMessage'){
                this.articleSoldMessage='';
            }else if(id==='articleForSaleMessage'){
                this.articleForSaleMessage='';
            }
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
              self.loadData({ search: "", page: self.articles.current_page });
            }
          }
        }
      }
      xhr.send(JSON.stringify({
        id: event.target.parentElement.id
      }));
    },
    imprint(show) {
      const self = this;
      self.showImpressum = show;
    },
    articleForSale(event){
        const articleId=event.target.id;
        axios.get('/api/articles/for-sale?article_id='+articleId)
            .then(response => {
                console.log('Artikel '+articleId+' wird günstiger angeboten')
            })
            .catch(error => {
                console.error(error);
            });

    }
  }
}
</script>

<style scoped lang="scss">
$primary-font: 'Lora', sans-serif;
$container-width: 900px;

html {
  font-family: $primary-font;
  width: 100%;
}

body {
  padding: 0 20px 20px 20px;
  width: 95%;
}

h1 {
  font-size: 28px;
  margin-bottom: 2.5%;

  table {
    border-spacing: 30px;
  }
}

main {
  padding: 30px;
}

.container {
  margin: 0;

  &--pagination {
    float: left;
    margin: 25px;
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

    &--add {
      background: none;
      display: inline-flex;
      align-items: center;
      padding: 0;
      border: none;
      cursor: pointer;
      border-radius: 25px;
    }
  }

  &__section {
    position: relative;
    display: grid;
    width: $container-width;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin: 10px;

    &--card {
      width: 300px;
      background-color: #f1f1f1;
      padding: 20px;
      border-radius: 8px;

      img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;
      }

      h3 {
        font-size: 20px;
        margin-bottom: 10px;
      }

      p {
        font-size: 14px;
        color: #666;
      }
    }
  }
}

.container--shopping-cart {
  position: relative;
  float: right;
  margin: 25px;
}
.maintenance-popup {
     background-color: #ffffff;
     max-width: 400px;
     margin: 100px auto;
     padding: 20px;
     box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
     text-align: center;
 }

.maintenance-popup h2 {
    color: #333333;
}

.maintenance-popup p {
    color: #666666;
}
.close-button{
    float: right;
}



</style>

