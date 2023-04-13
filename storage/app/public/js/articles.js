if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}
let articlesInCart = 0;

function ready() {
    let addBtn= document.getElementsByClassName('add-btn');
    for(let i=0;i<addBtn.length;i++){
        addBtn[i].addEventListener('click',addCartItem);
    }
}
function showCart(){
    document.getElementById('cart-container').style.display='block';
}
function addCartItem(event) {
    removeFromArticles(event);
    articlesInCart++;
    let cart_count =document.getElementsByClassName('amount-text');
    cart_count[0].innerHTML=articlesInCart.toString();
    let seller=event.target.parentElement.parentElement.previousSibling.previousSibling.previousSibling.previousSibling;
    let description=seller.previousSibling.previousSibling;
    let price=description.previousSibling.previousSibling;
    let name=price.previousSibling.previousSibling;
    let image=name.previousSibling.previousSibling;

    lastItem=document.getElementById('cart-table').lastChild;
    let zeile=document.createElement('tr');
    let imageSpalte=document.createElement('th');
    imageSpalte.innerHTML=image.innerHTML;
    zeile.appendChild(imageSpalte);
    let nameSpalte=document.createElement('th');
    nameSpalte.innerHTML=name.innerHTML;
    zeile.appendChild(nameSpalte);
    let priceSpalte=document.createElement('th');
    priceSpalte.innerHTML=price.innerHTML;
    zeile.appendChild(priceSpalte);
    let sellerSpalte=document.createElement('th');
    sellerSpalte.innerHTML=seller.innerHTML;
    zeile.appendChild(sellerSpalte);
    let buttonSpalte=document.createElement('th');
    let button=document.createElement('button');
    button.className='btn remove-btn';
    let buttonLogo=document.createElement('i');
    buttonLogo.className="fa-solid fa-circle-minus fa-lg";
    button.appendChild(buttonLogo);
    buttonSpalte.appendChild(button);
    zeile.appendChild(buttonSpalte);
    lastItem.appendChild(zeile);

}
function removeFromArticles(event){
    let clickedItem=event.target;
    let item=clickedItem.parentElement.parentElement.parentElement;
    item.remove();

}
