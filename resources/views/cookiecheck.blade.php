
@section('cookie-popup')
    @if(!isset($_COOKIE["saveCookies"]))
        <div id="cookie-popup">
            <div class="hinweis">
                <p>Wir verwenden Cookies. Durch die weitere Nutzung der Webseite stimmen Sie der Verwendung von Cookies zu.</p>
            </div>
            <span class="more">
      <a href="https://dsgvo-gesetz.de" target="_blank" rel="noopener noreferrer">Details</a>
    </span>
            <button class="btn" onclick='saveCookies()'>OK, ich bin einverstanden.</button>
            <button class="btn" onclick='dontSaveCookies()'>Keine Cookies speichern.</button>
        </div>
    @endif
    <script src="{{asset('storage/js/cookiecheck.js')}}"></script>
@show

