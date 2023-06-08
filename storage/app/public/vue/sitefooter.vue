<template>
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__container--content">
                <div class="footer__container--section">
                    <h3>About Us</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis semper consequat velit, non auctor odio
                        accumsan ac.</p>
                </div>
                <div class="footer__container--section">
                    <h3>Contact</h3>
                    <p>Phone: +1 123-456-7890</p>
                    <p>Email: info@example.com</p>
                </div>
                <div class="footer__container--section">
                    <h3>Follow Us</h3>
                    <div class="footer__container--social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer__container--section">
                    <h3 class="footer__container--show-imprint" @click="show">Impressum</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Duis semper consequat velit, non auctor odio accumsan ac.</p>
                </div>
            </div>
            <div class="footer__container--bottom">
                <p>&copy; 2023 Abalo Marketplace. All rights reserved.</p>
            </div>
        </div>
    </footer>
</template>

<script>


export default {
    emits: ['show-impressum'],
    methods: {
        show() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            const self = this;
            self.$emit('show-impressum', true);
        }
    }
}
</script>

<style scoped lang="scss">
/* Footer styles */
.footer {
    position: absolute;
    background-color: #f8f8f8;
    padding: 40px 0;
    color: #777;
    font-size: 14px;

    &__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;

        &--content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;

            &--section {
                width: 30%;
                margin-bottom: 20px;

                h3 {
                    font-size: 18px;
                    margin-bottom: 10px;
                    color: #333;
                }

                p {
                    margin: 0;
                }

                a {
                    color: #777;
                    margin-right: 10px;
                    transition: color 0.3s ease;

                    &:hover {
                        color: #333;
                    }
                }
            }
        }

        &--bottom {
            text-align: center;
            margin-top: 20px;

            p {
                margin: 0;
            }
        }

        &--show-imprint {
            cursor: pointer;
        }
    }
}
</style>
