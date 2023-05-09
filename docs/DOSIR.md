# DOSIR DBWT2

## Praktikum 1
### ER- Diagramm
![ER-Diagramm](/docs/img/ER_P1_Aufgabe7.jpg)

<hr>

## Praktikum 2
### Aufgabe 2 - Sinnvolle Feature:
- ESLint:
  - ESLint hilft dabei Javascript Code zu analysieren. Ebenso hilft es potenzielle Fehler, Stil Verstöße und weitere Qualitätsprobleme zu identifizieren. Ebenfalls kann man die spezifischen Regeln anpassen.
- Laravel Artisan 4VS:
  - Ermöglicht LAravel spezifische Artisan BEfehle via VS auszuführen ohne direkt die Kommandozeile verwenden zu müssen. Hilft beim Workflow bei der Entwicklung.
- Laravel Blade Snippets:
  - Ermöglicht eine kleine Code Generierung, sodass sich Schreibarbeit sparen lässt und man schneller Codieren kann. [Empfehlenswert nur, wenn man bereits Erfahrungen hat]
  
### Aufgabe 3 - Browserunterstüzung:
- Welcher Webbrowser wird am meisten unterstützt (Desktop/Mobil)
  - Desktop: Chrome, Edge, Safari, Firefox, Opera 
  - Mobil: Chrome, Safari, Samsung Internet, Opera
  - Insgesamt: Chrome, Safari, Edge
  - Quelle: https://www.similarweb.com/de/browsers/
- Worauf achtet man bei einer Auswahl der Quelle?
  - Die Quelle muss unabhänig von den Browsern Hersteller sein
- Welcher Browser untersützt welche Version von JAvascript?
  - Desktop: Chrome, Edge, Safari, Firefox, Opera -> ES6 
  - Opera fürs Handy supported bspw. kein Javascript
  - Quelle: https://caniuse.com/?search=javascript
- Für welche Webbrowser würden Sie Abalo umsetzen?
  - Als erstes kommt Chrome, da der Marktanteil deutlich der größte ist und von den meisten Menschen genutzt wird.
  - Danach Safari, da auch wenn Sie auf Desktop nur auf den dritten Platz kommen benutzen fast alle Apple User den Brwoser. Man würde ggf. eine potenzielle Kundensparte verlieren
  - Platz 3 wird vorraussichtlich Edge. Zumal ist Edge tatsächlich beliebter als Firefox und Microsoft wird die KI von ChatGPT bei sich einbauen. Wenn man die Website dementsprechend anpasst, könnte das einiges verändern und ermöglicht neues Potenzial.

### Aufgabe 4 - Vergleich mit bekanter Programmiersprachen:

**Gemeinsamkeiten von Javascript & PHP:**

| Gemeinsamkeit  | Erklärung |
|---|-------------|
| Programmiersprachen | Beide sind Skriptsprachen, die zur Entwicklung von dynamischen Webanwendungen verwendet werden. |
| Serverseitige Verarbeitung | Beide können serverseitig verarbeitet werden, um dynamische Inhalte auf Webseiten zu erzeugen. |
| Syntax | Beide verwenden eine C-ähnliche Syntax mit ähnlichen Konstrukten wie Variablen, Operatoren, Schleifen und Bedingungen. |
| Objektorientierte Programmierung |Beide unterstützen objektorientierte Programmierung mit Klassen, Vererbung und Polymorphismus. |
| Gemeinsame Anwendungen | Beide werden häufig für die Entwicklung von Webanwendungen verwendet, z.B. für die Validierung von Formularen, die Manipulation von DOM-Elementen und die Kommunikation mit Webservern über AJAX. |
| Plattformunabhängigkeit | Beide können auf verschiedenen Plattformen und Betriebssystemen ausgeführt werden, darunter Windows, macOS, Linux und verschiedene Webserver. |

**Unterschiede von Javascript & PHP:**

| Unterschied  | JavaScript | PHP |
|---|-------------|-----|
| Verwendung | JavaScript ist eine clientseitige Skriptsprache, die im Webbrowser des Benutzers ausgeführt wird. | PHP ist eine serverseitige Skriptsprache, die auf dem Webserver ausgeführt wird und dynamischen HTML-Code erzeugt. |
| Typisierung | JavaScript ist dynamisch typisiert, was bedeutet, dass Variablen ihre Typen während der Laufzeit ändern können. | PHP ist statisch typisiert, was bedeutet, dass Variablen einen festen Typ haben und dieser während der Laufzeit nicht geändert werden kann. |
| Ausführungsort | JavaScript-Code wird im Browser des Benutzers ausgeführt und kann auf DOM-Elemente zugreifen und diese manipulieren. | PHP-Code wird auf dem Webserver ausgeführt und kann auf Datenbanken zugreifen und dynamischen HTML-Code generieren. |
| Funktionen | JavaScript bietet viele Funktionen zur Manipulation des DOM (Document Object Model), um dynamische Inhalte auf Webseiten zu erstellen und zu ändern. | PHP bietet Funktionen zur Verarbeitung von Formularen, Kommunikation mit Datenbanken und zur Generierung von dynamischem HTML-Code. |
| Anwendungsbereiche | JavaScript wird häufig für Frontend-Entwicklung, Benutzerschnittstellen und Interaktionen in Webbrowsern verwendet. | PHP wird häufig für Backend-Entwicklung, serverseitige Logik und Datenbankkommunikation verwendet. |
| Verbreitung | JavaScript ist eine weit verbreitete Skriptsprache, die von allen gängigen Webbrowsern unterstützt wird. | PHP ist eine der beliebtesten serverseitigen Skriptsprachen und wird von vielen Webservern und Content-Management-Systemen unterstützt. |

Quellen: [Ionos - April 2022](https://www.ionos.de/digitalguide/websites/web-entwicklung/php-vs-javascript/), [PHP vs Javascript Video - August 2021](https://www.youtube.com/watch?v=hZhQyA5cvDs)

<hr>

## Praktikum 3
### Aufgabe 5 - neueste Technologien

- JavaScriptCore:
  - JavaScriptCore ist die JavaScript-Engine, die von Apple für Safari und andere Apple-Produkte entwickelt wurde
- V8:
  - V8 ist eine von Google entwickelte JavaScript-Engine, die in erster Linie für die Ausführung von JavaScript in der Chrome-Webbrowserumgebung entwickelt wurde.
- SpiderMonkey:
  - SpiderMonkey ist eine von Mozilla entwickelte JavaScript-Engine, die in erster Linie für den Mozilla Firefox Webbrowser entwickelt wurde. Sie gilt als erste jemals entwickelte JavaScriptEngine.

Alle drei Engines sind jeweils OpenSource und basieren auf dem ECMAScript (Javascript).
Quellen: 
- [JavaScriptCore](https://developer.apple.com/documentation/javascriptcore)
- [V8](https://v8.dev/)
- [SpiderMonkey](https://spidermonkey.dev/)

| Sprachkonstrukt       | JavaScriptCore | V8      | SpiderMonkey |
| --------------------- | -------------- | ------- | ------------ |
| Set.prototype.*       | ✅            | ✅      |     ✅      |
| Static Blocks         | ✅            | ✅      | ✅ (ab ES6) |
| Array.prototype.flat  | ✅            | ✅      | ✅          |
| Array.prototype.group | ✅            | ❌      | ❌          |
| Temporal              | ❌            | ❌      | ❌          |

Quellen: [CanIUse.com](https://caniuse.com/), [MDN.org](https://developer.mozilla.org/en-US/)

- Grundsätzlich sollten Sprachkonstrukte vermieden werden, die nicht browserübergreifend für eine allgemeine Programmierung geeignet sind (die letzten beiden).
- [setPrototype](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/setPrototypeOf) ermöglicht es die Eigenschaften von einer Klasse o.ä. zu erben und duese zu manipulieren. Das erbende Objekt verliert alle Eigenschaften und Methoden des alten Prototyps, die nicht im neuen definiert sind. Die Verwendung wird nicht empfohlen, da dies schwerwiegende Nebenwirkungen haben kann. Bspw. die Verletzung der Semantik.
- [staticBlocks](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Classes/Static_initialization_blocks) Ermöglicht es statischen Code in einer Klasse zu definieren. Sinnvoll zu verwenden, wenn die jeweilige Klasse einen gewissen Wert immer haben soll.
- [Array.prototype.flat()](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/flat) Ermöglicht es verschatelte Arrays in ein flaches Array zu konvertieren. Erscheint durchaus sinnvoll, wenn es so einen Anwendungsfall gibt.

### Aufgabe 6 - Analyse Webservices

- Spotify API:
  - Die Spotify API ist eine Schnittstelle, die von Spotify bereitgestellt wird, um Entwicklern Zugriff auf verschiedene Funktionen und Daten von Spotify zu ermöglichen. Mit der Spotify API können Entwickler auf Musikdatenbanken zugreifen, Musik suchen, Wiedergabelisten erstellen, Songs abspielen und vieles mehr. Entwickler können die API nutzen, um Anwendungen zu erstellen, die mit Spotify interagieren, wie zum Beispiel Musik-Streaming-Apps, Wiedergabelisten-Manager oder Analysetools für Musikdaten.
  - Die Spotify API folgt den grundlegenden Prinzipien der REST-Architektur:
    - Ressourcenbasierte URL-Struktur
    - Einheitliche Schnittstelle
    - Zustandslosigkeit
    - Client-Server Aufteilung
  - Level 2 Sie verwendet verschiedene HTTP-Methoden wie GET, POST, PUT und DELETE, um Operationen auf Ressourcen auszuführen.
  - Die Version wird als Präfix in der API-URL angegeben, um sicherzustellen, dass Anfragen an eine bestimmte Version der API gerichtet werden.
  - Bsp: `https://api.spotify.com/v1/`

- Google Maps API: 
  - Die Google Maps API ermöglicht die Integration interaktiver Karten und Standortinformationen in Anwendungen. Entwickler können damit Karten anzeigen, Standorte suchen, Routen planen und viele andere Funktionen nutzen.
  - Die Google Maps API folgt den grundlegenden Prinzipien der REST-Architektur:
    - Ressourcenbasierte URL-Struktur
    - Einheitliche Schnittstelle
    - Zustandslosigkeit
    - Client-Server Aufteilung
  - Die Google Maps API erfüllt wahrscheinlich die Anforderungen von Level 2, da sie verschiedene HTTP-Methoden wie GET, POST, PUT und DELETE verwendet, um Operationen auf Ressourcen auszuführen.
  - Die Versionsnummer wird als Teil der API-URL angegeben
  - ``https://maps.googleapis.com/maps/api/{version}/{resource}``
