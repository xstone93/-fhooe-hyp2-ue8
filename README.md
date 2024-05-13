# Beschreibung

Im vierten Assignment soll mithilfe der neuen - und finalen - Datenbankstruktur an __Quiz Quest__ weitergearbeitet werden.
In einer vorherigen Version wurde bereits an einer Basisfunktionalität gearbeitet, die es ermöglicht Player anzulegen und ein Quiz zu erstellen bzw. zu löschen.
In den nächsten Einheiten soll die gesamte Logik des Spiels umgesetzt werden. 

# Importieren der neuen Struktur (1 Punkt)
Im Repository befindet sich die Datei __sql-quizquest.sql__, die das neue Datenmodell beinhaltet.
Diese Datei soll mithilfe von PhpMyAdmin importiert werden und resultierte in einer neuen Datenbank namens __QuizQuestNew__.

Passen Sie die Datenbank entsprechend in den jeweiligen PHP-Funktionen an, damit __QuizQuest__ eine Verbindung dazu aufbauen kann.

# Fragen hinzufügen (5 Punkte)
Ein zentraler Teil von __Quiz Quest__ sind Quizze, die Fragen und Antworten enthalten.
Die Anlage von Fragen zu einem bestimmten Quiz erfolgt mit dem Button "Questions" auf der Quiz-Übersicht. 
Dazu werden die Routen GET und POST __quizcreate__ verwendet. 
Die Route GET __quizcreate__ verwendet das Template __quiz_questions.html.twig__. 

Zu dem jeweiligs ausgewählten Quiz soll eine neue Frage hinzugefügt werden.
Dazu soll unter __src/quiz_question.php__ der Code so ergänzt werden, dass für die jeweilige Frage eine Beschreibung, Kategorie und vier Antowrtmöglichkeiten (davon eine richtig) angegeben wird. 

# Benutzerrollen (5 Punkte)
In der aktuellen Version der Webanwendung wird nicht zwischen verschiedenen Benutzerrollen unterschieden - alle angemeldeten Benutzen können alles machen. 
Um zwischen Spieler:innen und Ersteller:innen zu unterscheiden, soll bei der Registrierung ein zusätzliches Dropdown-Feld eingefügt werden.
In diesem Dropdown soll es zwei Auswahlmöglichkeiten geben: i) Player, ii) Creator. 
In der Datenbank gibt es dazu das Feld __Role__ in der Tabelle __Player__ vom Datentyp __ENUM__. 
Je nach Auswahl soll der entsprechende Wert bei der Registrierung gesetzt werden. 

Neben der Registrierung, soll die Benutzerrolle auch in der Bedienung der Anwendung berücksichtigt werden. 
Wenn ein Player eingeloggt ist, sollen User dieser Rolle nur Quizze beitreten bzw. spielen dürfen, es soll ihnen nicht möglich sein neue Quizze hinzuzufügen, sie zu bearbeiten oder zu löschen. 
Diese Optionen sind ausschließlich Personen mit der Rolle __Creator__ vorbehalten. 

Um diese Einstellung zu berücksichtigen, soll auf Seite des Frontends (d. h. in den Views) eine Anpassung erfolgen (= Twig-Files).
Wenn ein Benutzer die Rolle hat werden die Menüpunkte/Buttons angezeigt, wenn die Person diese nicht hat, dann werden diese nicht angezeigt. 
Auf diese Weise wird zwischen Player und Creator unterschieden. 

# Beitreten von Spielen (5 Punkte)
Das neue Datenmodell sieht die Tabelle __PlayerQuiz__ vor. 
Diese Tabelle dient der Zuordnung von Spieler:innen zu einem konkreten Quiz. 
Prinzipiell werden in der Liste der offenen Spiele ("Open Games") standardmäßig nur die offenen Spiele angezeigt, es soll allerdings auch möglich sein private Spiele zu zeigen. 

Wenn eine Person (= ein Spieler) ein Spiel öffnet (= Show) bzw. mithilfe eines Join-Codes einem Spiel beitritt, soll in der Tabelle __PlayerQuiz__ ein Eintrag angelegt werden. 
In der Übersicht "Open Games" sollen dann alle Spiele angezeigt werden, die entweder "Public" sind, oder private Spiele, denen mittels "Join-Code" beigetreten wurde.

# Abgabe
Wichtig: Aufgrund möglicher neuer Gruppenzusammensetzung müssen neue Teams angelegt werden. 

Die Abgabe muss - wie gehabt - bis zur Deadline in dem gemeinsamen Github-Repository erfolgen.