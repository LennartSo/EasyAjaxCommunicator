EasyAjaxCommunicator
====================

Mit diesem kleines Plugin ist es möglich einfach von der HTML seite aus 
eine Funktion in der Ziel PHP aufzurufen.

In PHP Datei:
```php
// Klasse laden
require_once('class/EasyAjaxCom.class.php');

// Diese Funktion wird über den Client aufgerufen
function helloWorld($eins,$zwei,$drei) {

    echo 'Hello WORLD';
    print_r( $eins);
    echo $zwei;
    echo $drei;
}

//Klasse erzeugen
$EasyAjax = new EasyAjaxCom();

// 'helloWorld' Functions Name der Klasse bekannt  machen
$EasyAjax->regFunction('helloWorld');
```

In der HTML Datei:
```javascript
// XMLHttpRequest erzeugen
  var ajax = new XMLHttpRequest();

// Zurückgeben Daten in der Konsole ausgeben
  ajax.onloadend = function(e){
    console.log(this.response);
  };

// Funktionsname in der PHP die aufgerufen werden soll
  ajax.targetFunction = 'helloWorld';

// die übergeben Parametern der Funktion
  ajax.targetFunctionPara = [{1:'test'},'test','test'];

// Daten verschicken an Ziel Datei
  ajax.sendData("index.php");
```
