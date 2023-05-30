<template>
    <div id="shopping-cart" class="shopping-cart">
        <button class="btn" @click="openPopup"><i class="shopping-cart-btn fa-solid fa-cart-shopping fa-xl"></i></button>
    </div>
    <div id='shoppingCart' class="shopping-cart-popup">
        <button class="close-button btn" @click="closePopup"><i class="fa-solid fa-circle-xmark fa-lg"></i></button>
        <button class="reload-btn btn" @click="loadCartItems"><i class="fa-solid fa-rotate fa-lg"></i></button>
        <div v-for="article in cartItems['cart-items']" :key="article.id" class="item">
            <img :src="article['ab_file_path']" :alt="article.ab_name" class="item-image">
            <div class="item-details">
                <h3 class="item-name">{{ article.ab_name }}</h3>
                <span class="item-price">{{ article.ab_price }}€</span>
                <p class="item-description">{{ article.ab_description }}</p>
            </div>
            <button @click="removeItem" :id="article.id" class="remove-btn btn"><i :id="article.shoppingcartId" class="fa-solid fa-circle-minus fa-xl"></i></button>
        </div>
    </div>
</template>

<script >
export default {
    props:{
        currentPage:{
            type: Number,
            required: true,
        }
    },
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
            let shoppingCartId = event.target.id;
            let articleId = event.target.parentElement.id;
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
                        self.$emit('remove-item', self.$props.currentPage);
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
/* Darker background on mouse-over */
.btn:hover {
    background-color: RoyalBlue;
}
</style>
