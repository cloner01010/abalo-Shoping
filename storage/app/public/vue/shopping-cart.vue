<template>
    <div id="shopping-cart" class="shopping-cart">
        <button class="btn" @click="openPopup">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="shopping-cart-btn bi bi-cart4" viewBox="0 0 16 16">
                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
            </svg>
        </button>
    </div>
    <div id='shoppingCart' class="shopping-cart-popup">
        <button class="close-button btn" @click="closePopup">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </button>
        <button class="reload-btn btn" @click="loadCartItems">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
            </svg>
        </button>
        <div v-for="article in cartItems['cart-items']" :key="article.id" class="item">
            <img :src="article['ab_file_path']" :alt="article.ab_name" class="item-image">
            <div class="item-details">
                <h3 class="item-name">{{ article.ab_name }}</h3>
                <span class="item-price">{{ article.ab_price }}€</span>
                <p class="item-description">{{ article.ab_description }}</p>
            </div>
            <button @click="removeItem" :id="article.id" class="remove-btn btn">
                <svg :id="article.shoppingcartId" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-dash-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                </svg>
            </button>
        </div>
    </div>
</template>

<script >
export default {
    data() {
        return {
            cartItems:[],
        };
    },
    emits: ['remove-item'],
    created() {
        this.loadCartItems();
    },
    methods: {
        closePopup() {
            document.getElementById('shoppingCart').style.display = 'none';
            document.getElementById('shopping-cart').style.display = 'block';
        },
        openPopup(){
            const self = this;
            self.loadCartItems();
            document.getElementById('shoppingCart').style.display = 'block';
            document.getElementById('shopping-cart').style.display = 'none';
        },
        loadCartItems(){
            const self = this;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/api/shoppingcart');
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        self.cartItems=JSON.parse(xhr.responseText);
                    }
                }
            }
            xhr.send();
        },
        removeItem(event){
            let shoppingCartId = event.target.parentElement.id;
            let articleId = event.target.parentElement.parentElement.id;
            const self = this;
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            var xhr = new XMLHttpRequest();
            xhr.open('DELETE', '/api/shoppingcart/' + shoppingCartId + '/articles/' + articleId);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader("X-CSRF-Token", csrfToken);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                       self.loadCartItems();
                        self.$emit('remove-item', articleId);
                    }
                }
            }
            xhr.send();
        }
    },
};
</script>

<style scoped>
.reload-btn{
    position:relative;
    float:right;
    top: 5px;
    right: 5px;
}
.close-button {
    position: relative;
    top: 5px;
    right: 5px;
}
.shopping-cart-popup {
    display: none;
    top: 20px;
    right: 20px;
    width: 500px;
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    margin-top: 15px;
}

.item-image {
    height: 120px;
    width: 120px;
    object-fit: cover;
    margin-right: 10px;
}

.item-details {
    flex-grow: 1;
}

.item-name {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
}

.item-price {
    font-size: 14px;
    color: #888;
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
i{
    width:fit-content;
}

.remove-btn{
    display: inline-flex; /* Ensures the button only takes the necessary width */
    align-items: center; /* Aligns the icon vertically in the button */
    padding: 0; /* Removes any default padding */
    background: none; /* Removes any default background */
    border: none; /* Removes any default border */
    cursor: pointer; /* Adds cursor pointer on hover */
    border-radius: 25px;
}
/* Darker background on mouse-over */
.btn:hover {
    background-color: RoyalBlue;
}
</style>
