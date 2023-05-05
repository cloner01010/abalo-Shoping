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
document.addEventListener('DOMContentLoaded', function createNewArticleForm() {
    // Formular-Container
    let formContainer = document.createElement("form");
    formContainer.classList = "newarticle-form";
    formContainer.id = "newarticle-form";
    formContainer.action = "/articles";
    formContainer.method = "POST";
    formContainer.enctype = 'multipart/form-data';


    // Name-Eingabefeld
    let nameLabel = document.createElement("label");
    nameLabel.textContent = "Name:";
    nameLabel.className = "newarticle-name-label";
    let nameInput = document.createElement("input");
    nameInput.type = "text";
    nameInput.id = "na-name-input";
    nameInput.name = "name";
    nameInput.className = "newarticle-name-input";

    nameLabel.appendChild(nameInput);
    formContainer.appendChild(nameLabel);

    // Preis-Eingabefeld
    let priceLabel = document.createElement("label");
    priceLabel.textContent = "Preis:";
    priceLabel.classList = "newarticle-price-label"
    let priceInput = document.createElement("input");
    priceInput.type = "number";
    priceInput.id = "na-price-input";
    priceInput.name = "price";
    priceInput.classList = "newarticle-price-input"
    priceLabel.appendChild(priceInput);
    formContainer.appendChild(priceLabel);



    let creatorLable = document.createElement("label");
    creatorLable.textContent = "Verkäufer:";
    creatorLable.classList = "newarticle-price-label"
    let creatorInput = document.createElement("input");
    creatorInput.type = "text";
    creatorInput.id = "na-price-input";
    creatorInput.name = "creator";
    creatorInput.value=document.getElementById('session_creator').getAttribute('data-creator');
    creatorInput.classList = "newarticle-price-input";
    creatorInput.readOnly=true;
    creatorLable.appendChild(creatorInput);
    formContainer.appendChild(creatorLable);



    // Beschreibung-Eingabefeld
    let descriptionLabel = document.createElement("label");
    descriptionLabel.textContent = "Beschreibung:";
    descriptionLabel.classList = "newarticle-description-label";
    let descriptionInput = document.createElement("textarea");
    descriptionInput.id = "na-description-input";
    descriptionInput.name = "description";
    descriptionInput.classList = "newarticle-description-input";
    descriptionLabel.appendChild(descriptionInput);
    formContainer.appendChild(descriptionLabel);

    let fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.id = 'picture';
    fileInput.name = 'picture';
    formContainer.appendChild(fileInput);

    // Token
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
    const tokenField = document.createElement('input');
    tokenField.type = 'hidden';
    tokenField.name = '_token';
    tokenField.value = csrfToken;
    formContainer.appendChild(tokenField);

    // Speichern-Schaltfläche
    let saveButton = document.createElement("button");
    saveButton.type = "button";
    saveButton.textContent = "Speichern";
    saveButton.classList = "newarticle-submit-button";
    saveButton.addEventListener("click", function (event) {
        event.preventDefault();
        testSubmit(csrfToken);
        return false;
    });

    formContainer.appendChild(saveButton);

    document.getElementById("newarticle-main-container").appendChild(formContainer);
})

const testSubmit = (csrfToken) => {
    const form = document.getElementById('newarticle-form');
    const textInput = document.getElementById('na-name-input');
    const numberInput = document.getElementById('na-price-input');

  //  if (numberInput.value <= 0) {
  //      alert("Der Preis muss größer oder gleich Null sein.");
  //      return;
  //  } if (textInput.value === '') {
  //      alert("Kein Name wurde angegeben")
  //      return;
  //  }
    let xhr = new XMLHttpRequest();

    // Set up the request
    xhr.open("POST", form.action);
    xhr.setRequestHeader("X-CSRF-Token", csrfToken);

    // Set up a callback function to handle the response
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
               const response = JSON.parse(xhr.responseText);
                if (response.errors) {
                    // There were validation errors
                    const nameError = response.errors.name ? response.errors.name : '';
                    const priceError = response.errors.price ? response.errors.price : '';
                    const descriptionError = response.errors.description ? response.errors.description : '';
                    let errorString = '';
                    if (nameError) {
                        errorString += nameError.join(', ') + ' ';
                    }

                    if (priceError) {
                        errorString += priceError.join(', ') + ' ';
                    }

                    if (descriptionError) {
                        errorString += descriptionError.join(', ');
                    }
                    alert(errorString);
                } else {
                    // The data was submitted successfully
                    alert('Artikel wurde erfolgreich hinzugefügt.');}
            } else {
                // There was an error, handle it appropriately
                alert("Problem with "+xhr.statusText)
                console.error("Problem with "+xhr.statusText);
            }
        }
    };
    const formData =new FormData(form);
    // Send the form data
    xhr.send(formData);
}
