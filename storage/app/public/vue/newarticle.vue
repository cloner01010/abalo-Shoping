<template lang="">
    <div class=".container--newarticle">
    <form class="form--newarticle" id="newarticle-form" action="/api/articles" method="POST" enctype="multipart/form-data">
        <!--Name Eingabe-->
        <label class="form__label--name" for="name">
            Name:
        </label>
        <input type="text" id="na-name-input" name="name" class="form__input--name" />
        <!-- Preiseingabe-->
        <label class="form__label--preis" for="price">
            Preis:
        </label>
        <input type="number" id="na-price-input" name="price" class="form__input--price" />
        <!-- Person -->
        <label class="form__label--creator" for="creator">
            Verkäufer:
        </label>
        <input type="text" readonly=true id="na-price-input" name="creator" class="form__input--creator" :value="valueCreator"/>
        <!-- Beschreibung -->
        <label class="form__label--description">
            Beschreibung:
        </label>
        <textarea id="na-description-input" name="description" class="form__input--description"/>
        <!-- Fileinput -->
        <input type="file" id="picture" name="picture" />
        <!-- Token [Achtung das Token noch richtig umsetzen] -->
        <input type="hidden" name="_token" :value="csrfToken" />
        <!-- Speichern  -->
        <button type="submit" class="form__button--save" @click="submitNewArticle">
            Speichern
        </button>
    </form>
</div>
</template>


<script>
export default {
    data() {
        return {
            csrfToken: document.head.querySelector('meta[name="csrf-token"]') ? document.head.querySelector('meta[name="csrf-token"]').content : '',
            valueCreator: document.getElementById('session_creator').getAttribute('data-creator'),
        }
    },
    methods: {
        submitNewArticle(csrfToken) {
            const form = document.getElementById('newarticle-form');
            const textInput = document.getElementById('na-name-input');
            const numberInput = document.getElementById('na-price-input');

            let xhr = new XMLHttpRequest();

            // Set up the request
            xhr.open("POST", form.action);
            xhr.setRequestHeader("X-CSRF-Token", csrfToken);

            // Set up a callback function to handle the response
            xhr.onreadystatechange = function () {
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
                            alert('Artikel wurde erfolgreich hinzugefügt. ID: ' + response.id);
                            console.log(response)
                        }
                    } else {
                        // There was an error, handle it appropriately
                        alert("Problem with " + xhr.statusText)
                        console.error("Problem with " + xhr.statusText);
                    }
                }
            }
            const formData = new FormData(form);
            // Send the form data
            xhr.send(formData);
        }
    }
}
</script>
<style scoped>
@import '../../../../resources/css/newarticle.scss';
</style>