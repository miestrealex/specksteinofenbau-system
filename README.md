# Specksteinofenbau System

Version: 1.2.0

Status: V1 abgeschlossen / V2 in Entwicklung

Ein PHP-basiertes System zur Berechnung und Planung von Specksteinöfen.

Projektbeschreibung

Das Specksteinofenbau System automatisiert die Berechnung von Bauteilen für Specksteinöfen. Aus den eingegebenen Grundmaßen werden automatisch die benötigten Bauteile, Stücklisten und eine grafische Plattenaufteilung erzeugt.

Zusätzlich wird geprüft, ob die Bauteile auf eine Rohplatte passen, und die Aufteilung wird als SVG-Vorschau dargestellt.

Funktionen

V1 – Grundsystem

* Automatische Berechnung der Bauteilmaße
* Automatische Stücklistenerstellung
* Eindeutige Bauteil-IDs
* Positionsberechnung (X/Y)
* Automatischer Zeilenumbruch bei Plattenende
* Prüfung der maximalen Plattenbreite
* Prüfung der maximalen Plattenhöhe
* SVG-Vorschau der Plattenaufteilung
* Anzeige von Bauteilnamen im SVG
* Anzeige von Bauteilmaßen im SVG

Technologien

* PHP
* HTML
* CSS
* SVG

Projektstruktur

src/
├── Calculator.php
├── Aufteilung.php
assets/
└── css/
docs/
├── regelwerk.md
├── system-vision.md
└── project_status.md
index.php

Aktueller Entwicklungsstand

Version: 1.2.0

Status:

* V1 abgeschlossen
* V2 in Entwicklung

Geplante Erweiterungen:

* Schnittbreite (6 mm) berücksichtigen
* Materialverlust berechnen
* Realistische Schnittplanung

Lokale Ausführung

1. XAMPP installieren
2. Projekt in den Ordner htdocs kopieren
3. Apache starten
4. Im Browser öffnen:

http://localhost/specksteinofenbau

Screenshot

![SVG Vorschau](assents/images/SVG%201.2.png)


Autor

Alex Mestre