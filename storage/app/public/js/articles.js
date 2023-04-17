if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}
let articlesInCart = 0;
let cartOpen = false;
let articles = [];
function ready() {
    let addBtn = document.getElementsByClassName('add-btn');
    for (let i = 0; i < addBtn.length; i++) {
        addBtn[i].addEventListener('click', addCartItem);
    }
}
function showCart() {
    if (!cartOpen) {
        document.getElementById('cart-container').style.display = 'block';
        cartOpen = true;
    } else {
        document.getElementById('cart-container').style.display = 'none';
        cartOpen = false;
    }

}
function addCartItem(event) {
    removeFromArticles(event);
    articlesInCart++;
    let cart_count = document.getElementsByClassName('amount-text');
    cart_count[0].innerHTML = articlesInCart.toString();
    let article = null;
    //console.log(articles);
    for (let i = 0; i < articles.length; i++) {
        if (articles[i].id === event.target.id) {
            article = articles[i];
            break;
        }
    }
    if (article == null) {
        let seller = event.target.parentElement.parentElement.previousSibling.previousSibling.previousSibling.previousSibling;
        let created = seller.nextSibling.nextSibling;
        let description = seller.previousSibling.previousSibling;
        let price = description.previousSibling.previousSibling;
        let name = price.previousSibling.previousSibling;
        let image = name.previousSibling.previousSibling;
        let id = event.target.id;
        article = {
            id: id,
            image: image.innerHTML,
            name: name.innerHTML,
            created: created.innerHTML,
            description: description.innerHTML,
            price: price.innerHTML,
            seller: seller.innerHTML,
        }
        articles.push(article);
    }
    let lastItem = document.getElementById('cart-table').lastChild;
    let zeile = document.createElement('tr');
    let imageSpalte = document.createElement('th');
    imageSpalte.innerHTML = article.image;
    zeile.appendChild(imageSpalte);
    let nameSpalte = document.createElement('th');
    nameSpalte.innerHTML = article.name;
    zeile.appendChild(nameSpalte);
    let priceSpalte = document.createElement('th');
    priceSpalte.innerHTML = article.price;
    zeile.appendChild(priceSpalte);
    let sellerSpalte = document.createElement('th');
    sellerSpalte.innerHTML = article.seller;
    zeile.appendChild(sellerSpalte);
    let buttonSpalte = document.createElement('th');
    let button = document.createElement('button');
    button.className = 'btn';
    let buttonLogo = document.createElement('i');
    buttonLogo.className = "remove-btn fa-solid fa-circle-minus fa-lg";
    buttonLogo.addEventListener('click', removeFromArticles);
    button.appendChild(buttonLogo);
    buttonSpalte.appendChild(button);
    zeile.appendChild(buttonSpalte);
    lastItem.appendChild(zeile);

}
function removeFromArticles(event) {
    let clickedItem = event.target;
    if (clickedItem.className.includes('remove-btn')) {
        articlesInCart--;
        let cart_count = document.getElementsByClassName('amount-text');
        if (articlesInCart === 0) {
            cart_count[0].innerHTML = '';
        } else {
            cart_count[0].innerHTML = articlesInCart.toString();
        }
        for (let i = 0; i < articles.length; i++) {
            let name = clickedItem.parentElement.parentElement.previousSibling.previousSibling.previousSibling.innerHTML;
            if (articles[i].name === name) {
                let tbody = document.getElementById('articles-table').lastChild;
                let zeile = document.createElement('tr');
                let imageSpalte = document.createElement('th');
                imageSpalte.innerHTML = articles[i].image;
                zeile.appendChild(imageSpalte);
                let nameSpalte = document.createElement('th');
                nameSpalte.innerHTML = articles[i].name;
                zeile.appendChild(nameSpalte);
                let priceSpalte = document.createElement('th');
                priceSpalte.innerHTML = articles[i].price;
                zeile.appendChild(priceSpalte);
                let descriptionSpalte = document.createElement('th');
                descriptionSpalte.innerHTML = articles[i].description;
                zeile.appendChild(descriptionSpalte);
                let sellerSpalte = document.createElement('th');
                sellerSpalte.innerHTML = articles[i].seller;
                zeile.appendChild(sellerSpalte);
                let createdSpalte = document.createElement('th');
                createdSpalte.innerHTML = articles[i].created;
                zeile.appendChild(createdSpalte);
                let buttonSpalte = document.createElement('th');
                let button = document.createElement('button');
                button.className = 'btn';
                let buttonLogo = document.createElement('i');
                buttonLogo.className = "add-btn fa-solid fa-circle-plus fa-lg";
                buttonLogo.id = articles[i].id;
                buttonLogo.addEventListener('click', addCartItem);
                button.appendChild(buttonLogo);
                buttonSpalte.appendChild(button);
                zeile.appendChild(buttonSpalte);
                tbody.insertBefore(zeile, document.getElementById('header-table').nextSibling);
            }
        }
    }
    let item = clickedItem.parentElement.parentElement.parentElement;
    item.remove();

}
