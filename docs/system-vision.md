Specksteinofenbau System – Roadmap

Vision

Das System soll zukünftig technische Zeichnungen eines Specksteinofens analysieren und daraus automatisch alle benötigten Bauteile, Schnittpläne und Produktionsinformationen erzeugen.

Langfristiges Ziel:

Der Benutzer soll zukünftig keine Maße mehr eingeben müssen.

Das System erkennt die relevanten Maße selbst aus technischen Zeichnungen und startet den gesamten Produktionsprozess automatisch.

⸻

V1 – Grundsystem

Projektstruktur

* Projektstruktur erstellen
* Klassen trennen
* Regeln in Markdown-Dateien speichern
* Berechnungslogik erstellen

Calculator

* Maße berechnen
* Automatische Stückliste erstellen
* Weitere Ofentypen unterstützen
* Konfigurierbare Regeln

Aufteilung

* Positionen berechnen
* Plattengröße prüfen
* Maximale Höhe berechnen
* Maximale Breite berechnen

SVG-Vorschau

* Einfaches SVG erzeugen
* Bauteilnamen anzeigen
* Maße anzeigen
* Automatische Skalierung
* Verbesserte Darstellung

⸻

V2 – Realistische Schnittplanung

Schnittbreite

* Schnittbreite von 6 mm berücksichtigen
* Reinigungsschnitt berücksichtigen
* Letzten Schnitt berücksichtigen
* Materialverlust berechnen

Produktionsablauf

* Vertikale Schnitte planen
* Platte drehen
* Horizontale Schnitte planen
* Optimale Schnittreihenfolge bestimmen
* Bediener-Regeln berücksichtigen
* Winkel erhalten
* Restplatte erneut verwenden

Bericht

* Schnittliste erzeugen
* Anzahl Schnitte berechnen
* Gesamtverlust berechnen

⸻

V3 – Reststückverwaltung

Reststücke

* Reststücke erkennen
* Reststückfläche berechnen
* Reststückmaße berechnen

Lagerverwaltung

* Reststücke speichern
* Reststück-Datenbank erstellen
* Automatische Wiederverwendung

Visualisierung

* Reststücke im SVG darstellen
* Reststücke farblich markieren

⸻

V4 – Rohplattenverwaltung

Lager

* Rohplatten erfassen
* Plattennummer vergeben
* Dicke speichern
* Herkunft speichern
* Gewicht berechnen
* Warnung bei schweren Platten (>75 kg)

Suche

* Nach Größe suchen
* Nach Herkunft suchen
* Nach Familie suchen

⸻

V5 – Qualitätsmanagement

Oberflächen

* Geschliffen
* Gebürstet
* Kombinierte Oberflächen

Qualitätsklassen

* Klasse A
* Klasse B
* Klasse C

Defekte

* Kratzer erfassen
* Risse erfassen
* Ausbrüche erfassen
* Sichtflächen bewerten

⸻

V6 – Computer Vision

Projektanalyse

* Grundriss erkennen
* Frontansicht erkennen
* Maße automatisch auslesen
* Bauteile identifizieren

Kamerasystem

* Kamera im Lager installieren
* Automatische Aufnahme
* Bilder archivieren

Materialanalyse

* Plattenränder erkennen
* Kratzer erkennen
* Risse erkennen
* Defekte erkennen
* Nutzfläche automatisch berechnen

⸻

V7 – Speckstein-Familien

Strukturanalyse

* Hauptrichtung der Adern erkennen
* Horizontale Struktur erkennen
* Vertikale Struktur erkennen
* Diagonale Struktur erkennen

Materialeigenschaften

* Kontrast analysieren
* Durchschnittsfarbe bestimmen
* Textur analysieren

Familienbildung

* Ähnliche Platten gruppieren
* Familien automatisch bilden
* Ähnlichkeitswert berechnen

⸻

V8 – Intelligente Plattenauswahl

Auftragsanalyse

* Projekt analysieren
* Materialbedarf berechnen

Auswahl

* Geeignete Rohplatte auswählen
* Passende Familie auswählen
* Oberfläche berücksichtigen

Optimierung

* Materialverlust minimieren
* Schnittanzahl minimieren
* Optische Einheitlichkeit maximieren

⸻

V9 – Vollautomatisches System

Gesamtprozess

* Technische Zeichnung laden
* Maße automatisch erkennen
* Calculator starten
* Stückliste erzeugen
* Rohplatte auswählen
* Nutzfläche berechnen
* Schnittplanung erstellen
* SVG erzeugen
* Reststücke verwalten
* PDF-Bericht erzeugen

⸻

V10 – Produktionsassistent

Interaktive Produktion

* Virtuellen Sägetisch darstellen
* Schnitt Schritt für Schritt anzeigen
* Platte drehen
* Reststücke aktualisieren
* Produktionsfortschritt anzeigen

Bediener-Unterstützung

* Nächsten Schnitt empfehlen
* Warnung bei schweren Platten
* Warnung bei instabilen Reststücken
* Alternative Schnittstrategie vorschlagen

⸻

Langfristige Vision

Automatische Produktionsoptimierung

* Oberfläche nach dem Schleifen analysieren
* Geeignete Oberflächen automatisch bewerten
* Beste Rohplatte auswählen
* Passende Plattenfamilie bestimmen
* Optimale Schnittstrategie berechnen
* Materialverlust minimieren
* Vollständige Produktionsunterstützung vom technischen Plan bis zum fertigen Zuschnitt