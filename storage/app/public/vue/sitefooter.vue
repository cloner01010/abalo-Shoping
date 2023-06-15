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
            <GDialog v-model="dialogState" class="dialog">
                <div id="impressum-overlay" class="impressum">
                    <div class="impressum--content">
                        <div class="impressum__content--wrapper">
                            <h1>Impressum</h1>
                            <p>Angaben gemäß § 5 TMG</p>
                            <p>Max Muster<br>
                                Musterweg<br>
                                12345 Musterstadt<br>
                            </p>
                            <p><strong>Vertreten durch:</strong><br>
                                Max Muster<br>
                            </p>
                            <p><strong>Kontakt:</strong><br>
                                Telefon: 01234-789456<br>
                                Fax: 1234-56789<br>
                                E-Mail: <a href='mailto:max@muster.de'>max@muster.de</a>
                            </p>
                            <p><strong>Registereintrag:</strong><br>
                                Eintragung im Registergericht: Musterstadt<br>
                                Registernummer: 12345<br>
                            </p>
                            <p><strong>Umsatzsteuer-ID:</strong><br>
                                Umsatzsteuer-Identifikationsnummer gemäß §27a Umsatzsteuergesetz: Musterustid.<br><br>
                                <strong>Wirtschafts-ID:</strong><br>
                                Musterwirtschaftsid<br>
                            </p>
                            <p><strong>Aufsichtsbehörde:</strong><br>
                                Musteraufsicht Musterstadt<br>
                            </p>
                            <p><strong>Haftungsausschluss:</strong><br>
                                <br><strong>Urheberrecht</strong><br>
                                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem
                                deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der
                                Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung
                                des
                                jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den
                                privaten,
                                nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom
                                Betreiber
                                erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte
                                Dritter
                                als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam
                                werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen
                                werden wir derartige Inhalte umgehend entfernen.<br><br>
                                <strong>Datenschutz</strong><br><br>
                                Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich.
                                Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder
                                eMail-Adressen) erhoben werden, erfolgt dies, soweit möglich, stets auf freiwilliger Basis.
                                Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben.<br>
                                Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B. bei der Kommunikation per
                                E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff
                                durch
                                Dritte ist nicht möglich.<br>
                                Der Nutzung von im Rahmen der Impressumspflicht veröffentlichten Kontaktdaten durch Dritte
                                zur
                                Übersendung von nicht ausdrücklich angeforderter Werbung und Informationsmaterialien wird
                                hiermit ausdrücklich widersprochen. Die Betreiber der Seiten behalten sich ausdrücklich
                                rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch
                                Spam-Mails, vor.<br>
                                <br><br><strong>Google Analytics</strong><br><br>
                                Diese Website benutzt Google Analytics, einen Webanalysedienst der Google Inc. (''Google'').
                                Google Analytics verwendet sog. ''Cookies'', Textdateien, die auf Ihrem Computer gespeichert
                                werden und die eine Analyse der Benutzung der Website durch Sie ermöglicht. Die durch den
                                Cookie
                                erzeugten Informationen über Ihre Benutzung dieser Website (einschließlich Ihrer IP-Adresse)
                                wird an einen Server von Google in den USA übertragen und dort gespeichert. Google wird
                                diese
                                Informationen benutzen, um Ihre Nutzung der Website auszuwerten, um Reports über die
                                Websiteaktivitäten für die Websitebetreiber zusammenzustellen und um weitere mit der
                                Websitenutzung und der Internetnutzung verbundene Dienstleistungen zu erbringen. Auch wird
                                Google diese Informationen gegebenenfalls an Dritte übertragen, sofern dies gesetzlich
                                vorgeschrieben oder soweit Dritte diese Daten im Auftrag von Google verarbeiten. Google wird
                                in
                                keinem Fall Ihre IP-Adresse mit anderen Daten der Google in Verbindung bringen. Sie können
                                die
                                Installation der Cookies durch eine entsprechende Einstellung Ihrer Browser Software
                                verhindern;
                                wir weisen Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche
                                Funktionen dieser Website voll umfänglich nutzen können. Durch die Nutzung dieser Website
                                erklären Sie sich mit der Bearbeitung der über Sie erhobenen Daten durch Google in der zuvor
                                beschriebenen Art und Weise und zu dem zuvor benannten Zweck einverstanden.<br><br>
                                <strong>Google AdSense</strong><br><br>
                                Diese Website benutzt Google Adsense, einen Webanzeigendienst der Google Inc., USA
                                (''Google'').
                                Google Adsense verwendet sog. ''Cookies'' (Textdateien), die auf Ihrem Computer gespeichert
                                werden und die eine Analyse der Benutzung der Website durch Sie ermöglicht. Google Adsense
                                verwendet auch sog. ''Web Beacons'' (kleine unsichtbare Grafiken) zur Sammlung von
                                Informationen. Durch die Verwendung des Web Beacons können einfache Aktionen wie der
                                Besucherverkehr auf der Webseite aufgezeichnet und gesammelt werden. Die durch den Cookie
                                und/oder Web Beacon erzeugten Informationen über Ihre Benutzung dieser Website
                                (einschließlich
                                Ihrer IP-Adresse) werden an einen Server von Google in den USA übertragen und dort
                                gespeichert.
                                Google wird diese Informationen benutzen, um Ihre Nutzung der Website im Hinblick auf die
                                Anzeigen auszuwerten, um Reports über die Websiteaktivitäten und Anzeigen für die
                                Websitebetreiber zusammenzustellen und um weitere mit der Websitenutzung und der
                                Internetnutzung
                                verbundene Dienstleistungen zu erbringen. Auch wird Google diese Informationen
                                gegebenenfalls an
                                Dritte übertragen, sofern dies gesetzlich vorgeschrieben oder soweit Dritte diese Daten im
                                Auftrag von Google verarbeiten. Google wird in keinem Fall Ihre IP-Adresse mit anderen Daten
                                der
                                Google in Verbindung bringen. Das Speichern von Cookies auf Ihrer Festplatte und die Anzeige
                                von
                                Web Beacons können Sie verhindern, indem Sie in Ihren Browser-Einstellungen ''keine Cookies
                                akzeptieren'' wählen (Im MS Internet-Explorer unter ''Extras > Internetoptionen >
                                Datenschutz >
                                Einstellung''; im Firefox unter ''Extras > Einstellungen > Datenschutz > Cookies''); wir
                                weisen
                                Sie jedoch darauf hin, dass Sie in diesem Fall gegebenenfalls nicht sämtliche Funktionen
                                dieser
                                Website voll umfänglich nutzen können. Durch die Nutzung dieser Website erklären Sie sich
                                mit
                                der Bearbeitung der über Sie erhobenen Daten durch Google in der zuvor beschriebenen Art und
                                Weise und zu dem zuvor benannten Zweck einverstanden.
                            </p>
                        </div>
                    </div>
                </div>
            </GDialog>

            <button @click="dialogState = true">
                Impressum 2
            </button>
        </div>
    </footer>
</template>

<script>
import 'gitart-vue-dialog/dist/style.css'
import { GDialog } from 'gitart-vue-dialog'

export default {
    emits: ['show-impressum'],
    components: {
        GDialog,
    },
    methods: {
        show() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            const self = this;
            self.$emit('show-impressum', true);
        }
    },
    data: () => ({
        dialogState: false,
    }),
}
</script>

<style scoped lang="scss">
@import '../../../../resources/css/impressum2.scss';

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
}</style>
