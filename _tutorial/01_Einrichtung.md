# Tutorial: Einrichtung der Entwicklungsumgebung

## Projekt auschecken

Zunächst einmal muss das Projekt ausgecheckt werden. Dazu kannst
Du einfach `git clone` nutzen.


## Composer initialisieren.

Nachdem Du das Projekt ausgecheckt hast, sollte Dir die IDE
massive Fehler anzeigen. Etliche Klassen fehlen, Abhängigkeiten
sind nicht erfüllt.

Guck Dir mal die Datei `/composer.json` an:

```json
    "require": {
        "php": ">=7.0",
        "gismo/php-foundation": "*",
        "gismo/di": "*",
        "gismo/http-foundation": "*"
    },
```

Diese Sektion bestimmt, welche Abhängigkeiten das Projekt hat, und
welche Pakete installiert werden müssen. Um das ganze nicht von
Hand zu machen, wechselst Du in der Konsole in das Projekthauptverzeichnis
und führst dort 

```
composer update
```

aus. (Ggf. musst Du Composer erst durch `sudo apt-get install composer`
installieren.)

Nachdem Composer gupdatet ist, findest du ein neues Verzeichnis
`/vendor`. Warum war das Verzeichnis vorher nicht da? Guck mal in
die Datei `/.gitignore`. Hier ist festgelegt, welche Verzeichnisse
nicht mit ins Repository hochgeladen werden dürfen.

## Autoload nutzen

Unter `/vendor` findest Du die Datei `autoload.php`. Diese Datei
ist die einzige, die jemals per `require` irgendwo eingebunden wird.
Und zwar ausschließlich in `/www/index.php` als erste Zeile.

```php
require __DIR__ . "/../vendor/autoload.php";
```

Composer sorgt nämlich automatisch dafür, dass die Namespaces von
Klassen in die korrekten Dateipfade umgewandelt werden. Es ist daher
wichtig, wie bei Java immer nur eine Klasse pro Datei anzulegen.
Außerdem muss der Dateiname exakt wie die Klasse heissen.

Damit auch die Projekteigenen Klassen gefunden werden, sind diese
ebenfalls in der `/composer.json` definiert:

```json
    "autoload": {
        "psr-4": {
            "Gismo\\Tutorial\\": "src/Tutorial"
        },
```


## Apache konfigurieren

Damit Mod-Rewrite arbeiten kann, muss `AllowOverride All` in der Apache-
Host-Config gesetzt sein.

Also als root die Datei `/etc/apache2/hosts-available/000-default` editieren
und AllowOverride einfügen:

```
<Directory /doc/root>
    AllowOverride All
</Directory>
```
Danach Apache neu starten. `sudo service apache2 restart`;

Danach sollte unter dem Verzeichnis /www die Website angezeigt werden.

## Host-Konfiguration anlegen


    