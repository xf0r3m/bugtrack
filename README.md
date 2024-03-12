# BugTrack

Chcąc skorzystać z `btcli` należy skopiować plik do katalogu /usr/local/bin.
Następnie wskazać gdzie znajdują się pliki instancji BugTrack (zmienna `ROOT`
na samym początku pliku).

### Zapis czasu w UTC:
Domyślnie PHP zapisuje czas zgodnie ze strefą UTC, chcąc do zmienić należy
ustawić opcję `date.timezone` w pliku /etc/php/apache2/php.ini (dla Debiana)
na żądaną przez nas strefę czasową.
