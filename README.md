# Humanist

HUMANIST Research ist eine Webanwendung welche im praktischen Teil der Bachelorarbeit etworfen wurde. 
    "Von Daten zur Webanwendung:
    Eine wissenschaftshistorische Nachzeichnung der Humanist Discussion Group zur
    Erforschung technischer Entwicklungen und Themenschwerpunkte in den Digital
    Humanities seit 1987"

Es bietet die Möglichkeit die Archive von der "Humanist Discussion Group" (1987 - 2018) mit einer erweiterten Suche zu durchforsten.
Die Ergebnisse zeigen textuell die gefundenen E-Mails und werden zusätzlich visuell durch ein Diagramm ergänzt. 
Grundlage für die Webandwendung war die Modellierung der Ausgangsdaten. Der dazu entwickelte Parser ist im Ordner ba_python zu finden.

Python:
Wenn der Code im der Datei parse_file.ipynb ausgeführt werden soll. Werden die folgenden installationen in der Konsole von VS Code empfohlen.

1. Create virtual env (Once)
```PowerShell
python -m venv .venv
```
2. Activate virtual env
```PowerShell
Set-ExecutionPolicy Unrestricted -Scope Process
.\.venv\Scripts\Activate.ps1
```
3. Install packages
```
python -m pip install -r requirements.txt

python -m pip install pandas

python -m pip install -q google-generativeai
```

Web:
Alle Dateien für die Webanwendung befinden sich im Ordner web.
Für die Nutzung ist ein lokaler Server zb. über XXAMP nötig.
In einem Unterordner von assets befindet sich eine SQL-Datenbank, oder eine CSV-Datei,
    welche in MYSQL eingebunden werden müssen um die Suche nutzen zu können. 
