=== Ticketleo Events ===
Contributors: hayloft
Tags: events, ticketing, event-listing, Ticketleo
Requires at least: 6.6
Tested up to: 6.6
Stable tag: 1.0.2
Requires PHP: 8.1
License: GPLv2 or later
Werben Sie Ihre Ticketleo-Events direkt auf Ihrer Website – wählen Sie aus drei flexiblen Ansichten.



== Description ==
Das Ticketleo Events Plugin ermöglicht es Ihnen, Veranstaltungen von Ticketleo nahtlos in Ihre WordPress-Website zu integrieren.
Nutzen Sie die Flexibilität von WordPress Blöcke, um Events direkt auf Ihrer Seite zu bewerben und benutzerdefinierte Ansichten Ihrer Veranstaltungen anzuzeigen.

Um dieses Plugin zu benutzen, müssen Sie einen [Ticketleo](https://www.ticketleo.com/) Account besitzen. Falls Sie noch keinen haben, können Sie [hier](https://www.ticketleo.com/de/veranstalter-werden/#register) einen ganz einfach und schnell erstellen. Zusätzlich müssen Sie auch mind. eine Veranstaltung erstellt haben.



**Kernfunktionen des Plugins**

* **Integration mit Ticketleo-API:** Das Plugin verbindet sich direkt mit der Ticketleo-API, um aktuelle Veranstaltungsdaten zu laden. Sie können Veranstaltungen basierend auf der Benutzer-ID oder der Event-ID anzeigen, ohne manuelle Inhalte einpflegen zu müssen. Alle Daten werden in Echtzeit von Ticketleo abgerufen.

* **Drei flexible Ansichtsoptionen:** Wählen Sie zwischen verschiedenen Darstellungsoptionen, um die Events auf Ihrer Website ansprechend zu präsentieren.

 * *Tabellarisch:* Zeigt Veranstaltungen in einer übersichtlichen Tabelle an.
 * *Liste:* Ideal für eine kompakte, vertikale Auflistung von Events.
 * *Kacheln:* Eine visuell ansprechende Kachelansicht für eine moderne Darstellung.

* **Dynamisches Laden von Veranstaltungen:** Durch die einfache Eingabe einer Benutzer-ID oder Event-ID können Sie dynamisch die Veranstaltungen auf Ihrer Website anzeigen lassen. Änderungen, die in Ticketleo vorgenommen werden, werden automatisch auf Ihrer Website übernommen.

* **Anpassbare Metadatenanzeige:** Entscheiden Sie, welche zusätzlichen Informationen zu einer Veranstaltung angezeigt werden sollen. Sie haben die Möglichkeit, Metadaten wie den Event-Status oder weitere Informationen ein- oder auszublenden.

* **Einfache Integration in WordPress Block-Editor:** Mit nativer Unterstützung für WordPress Blöcke können Sie Ticketleo-Veranstaltungen direkt über den Block-Editor Ihrer Seite hinzufügen und konfigurieren. Dank der Vorschau im Editor sehen Sie sofort, wie Ihre Events auf der Webseite aussehen werden.

* **Fehlermeldungen und Debugging im Editor:** Sollte es Probleme mit den Veranstaltungsdaten oder der API-Verbindung geben, werden detaillierte Fehlermeldungen direkt im WordPress-Editor angezeigt, sodass Sie schnell reagieren und Anpassungen vornehmen können. Diese Informationen werden nur im Editor und nicht auf der öffentlichen Website angezeigt.


**Vorteile für Ihre WordPress-Seite**

1. **Zeitsparend:** Keine manuelle Pflege von Veranstaltungsdaten – alle Informationen werden direkt aus Ticketleo übernommen.

2. **Flexibel:** Wählen Sie aus verschiedenen Anzeigeformaten und passen Sie die Darstellung Ihrer Events an.

3. **Echtzeit-Daten:** Die Daten auf Ihrer Website sind immer auf dem neuesten Stand, da sie direkt über die API geladen werden.

4. **Benutzerfreundlich:** Einfache Handhabung und Integration in den WordPress Block-Editor, auch für weniger erfahrene Benutzer.

Mit dem Ticketleo Events Plugin wird Ihre Website zur zentralen Plattform für die Darstellung Ihrer Veranstaltungen – schnell, einfach und effizient!

== Nutzung eines externen Drittanbieterdienstes ==
Dieses Plugin verwendet den externen Drittanbieterdienst, [Ticketleo](https://www.ticketleo.com/), um Eventdaten direkt auf deiner Webseite abzurufen und anzuzeigen.

**Datenaustausch**
Bei der Verwendung dieses Plugins werden Daten, wie z.B. Eventinformationen und Verfügbarkeiten, von einem Drittanbieterdienst abgerufen. Dieser Datenaustausch erfolgt unter bestimmten Umständen, wie zum Beispiel, wenn der Benutzer eine Anfrage stellt, um Eventdetails anzuzeigen.

Weitere Informationen findest du hier:

* [Datenschutzerklärung](https://www.ticketleo.com/de/datenschutzerklaerung/)
* [Nutzungsbedingungen](https://www.ticketleo.com/de/nutzungsbedingungen/)

== Installation ==
Laden Sie das Plugin herunter und aktivieren Sie es. Die Blöcke sollten dann automatisch bei Ihnen im Block Editor zur Verfügung stehen.



== Frequently Asked Questions ==
= Wie zeige ich die Vorstellungen von einer Veranstaltung an? =
Nachdem Sie das Plugin installiert und aktiviert haben, können Sie im Block-Editor den Block „Einzelne Veranstaltung“ hinzufügen. Geben Sie die entsprechende Event-ID ein, um Ihre Vorstellungen auf Ihrer Website anzuzeigen.

= Wo finde ich die Event-ID einer Veranstaltung? =
1. In Ihrem Ticketleo Dashboard in der Menüsparte "**Übersicht**" finden Sie die Kategorie "**Veranstaltungen**". Darin finden Sie Ihre Übersicht aller Ihrer Veranstaltungen.
2. Zu oberst finden Sie eine Liste aller Ihrer zukünftigen Veranstaltungen. Wählen Sie irgendeine heraus, um deren Event-ID herauszukopieren.
3. Sie kommen dann zu der Übersicht Ihres Events. Auf der rechten Seite finden Sie den Veranstaltungslink, wo sich die Event-ID befindet.
4. Diese können Sie herauskopieren und im Block "**Einzelne Veranstaltung**", in den Block Einstellungen, bei "**Event-ID**" eintragen.

= Wie zeige ich alle meine Veranstaltungen an? =
Nachdem Sie das Plugin installiert und aktiviert haben, können Sie im Block-Editor den Block „Alle Veranstaltungen“ hinzufügen. Geben Sie die entsprechende User-ID ein, um Ihre Vorstellungen auf Ihrer Website anzuzeigen.

= Wo finde ich meine User-ID? =
1. In Ihrem Ticketleo Dashboard in der Menüsparte "**Übersicht**" finden Sie die Kategorie "**Veranstaltungen**". Darin finden Sie Ihre Übersicht aller Ihrer Veranstaltungen.
2. Die Box "**Link für die Veranstaltungsübersicht**" erscheint. Auf der rechten Seite finden Sie den Link mit Ihrer User-ID.
3. Diese können Sie herauskopieren und im Block "**Alle Veranstaltungen**", in den Block Einstellungen, bei "**User-ID**" eintragen.

= Was mache ich, wenn keine Veranstaltungen angezeigt werden? =
Grundsätzlich werden Fehlermeldungen im Block-Editor angezeigt. Schauen Sie sich die Fehlermeldung an und handeln Sie entsprechend.

= Wie kann ich die Darstellung meiner Veranstaltungen anpassen? =
Wenn Sie den Block innerhalb des Block-Editors auswählen, können Sie anhand eines Dropdownmenüs eine von drei verschiedenen Anzeigeoptionen auswählen, wie z.B. eine tabellarische Ansicht, Listenansicht oder Kachelansicht.
Darüber hinaus können Sie, je nach Block, Metadaten wie den Status des Events ein- oder ausblenden.

= Was passiert, wenn ich eine falsche User- oder Event-ID eingebe? =
Wenn eine ungültige User- oder Event-ID eingegeben wird, zeigt das Plugin eine Fehlermeldung im Block-Editor an.
Auf der Frontend-Seite wird in diesem Fall gar nichts angezeigt.

= Sind meine Ticketleo-Daten auf dem neuesten Stand? =
Ja, das Plugin holt die Daten direkt aus der Ticketleo API. Wenn Sie Änderungen an Ihren Veranstaltungen in Ticketleo vornehmen, werden diese automatisch auf Ihrer WordPress-Seite aktualisiert.

= Wie muss ich Fehlermeldungen behandeln? =
* **"User *123* does not exist"**: Kontrollieren Sie, ob Sie Ihre User-ID richtig eingetragen haben.
Überprüfen Sie, ob für den entsprechenden Benutzer öffentliche Veranstaltungsdaten auf Ticketleo vorhanden sind.
* **"Event *XYZ* does not exist"**: Kontrollieren Sie, ob Sie die Event-ID richtig eingetragen haben.
Überprüfen Sie, ob das entsprechende Event auf Ticketleo öffentlich und nicht versteckt ist.
* **"Event *XYZ* is not public"**: Kontrollieren Sie, ob die Veranstaltung öffentlich ist.
Versteckte Veranstaltungen werden von der API nicht zurückgegeben.
* **"Sie haben noch keine Veranstaltungen erfasst"**: Überprüfen Sie, ob ihre Veranstaltungen öffentlich sind.
* **"Sie haben noch keine Vorstellungen erfasst"**: Stellen Sie sicher, dass Sie mindestens eine Veranstaltung mit mind. einer Vorstellung erfassen, damit diese überhaupt angezeigt werden kann.



== Screenshots ==
1. User-ID finden: Ticketleo Admin Dashboard &rarr; Übersicht &rarr; Veranstaltungen &rarr; Link für Veranstaltungsübersicht &rarr; Zahl zwischen *'user'* und *'event-list'*
2. Event-ID finden: Ticketleo Admin Dashboard &rarr; Übersicht &rarr; Veranstaltungen &rarr; auf gewünschte Veranstaltung drucken &rarr; Veranstaltungslink &rarr; Zahl nach *'event'*


== Changelog ==
= 1.0 =
Initial release

== Upgrade Notice ==
= 1.0 =
Initial release