var data = {
    'produkte': [
        { name: 'Ritterburg', preis: 59.99, kategorie: 1, anzahl: 3 },
        { name: 'Gartenschlau 10m', preis: 6.50, kategorie: 2, anzahl: 5 },
        { name: 'Robomaster' ,preis: 199.99, kategorie: 1, anzahl: 2 },
        { name: 'Pool 250x400', preis: 250, kategorie: 2, anzahl: 8 },
        { name: 'Rasenmähroboter', preis: 380.95, kategorie: 2, anzahl: 4 },
        { name: 'Prinzessinnenschloss', preis: 59.99, kategorie: 1, anzahl: 5 }
    ],
    'kategorien': [
        { id: 1, name: 'Spielzeug' },
        { id: 2, name: 'Garten' }
    ]
};

function getMaxPrice(data){
    let name="";
    let max = 0;
    for(let i = 0; i < data.produkte.length; i++){
        if(data.produkte[i].preis > max){
            max = data.produkte[i].preis;
            name = data.produkte[i].name;
        }
    }
    return name;
}
function getMinPreisProdukt(data){
    let min = data.produkte[0].preis;
    let product;
    for(let i = 0; i < data.produkte.length; i++){
        if(data.produkte[i].preis < min){
            min = data.produkte[i].preis;
            product = data.produkte[i];
        }
    }
    return product;
}
function getPreisSum(data){
    let sum=0;
    data.produkte.forEach(function(product){
        sum += product.preis;
    })
    return sum
}
function getGesamtWert(data){
    let total=0;
    data.produkte.forEach(function(product){
        total += product.preis * product.anzahl;
    })
    return total;
}
function getAnzahlProdukteOfKategorie(data,kategorie){
    let anzahl = 0;
    let catID;
    data.kategorien.forEach(function(cat){
        if(cat.name===kategorie){
            catID=cat.id;
        }
    })
    if(catID===null){
        return 0;
    }
    data.produkte.forEach(function(product){
        if(product.kategorie === catID){
            anzahl += product.anzahl;
        }
    })
    return anzahl;
}
console.log(getAnzahlProdukteOfKategorie(data,""));
