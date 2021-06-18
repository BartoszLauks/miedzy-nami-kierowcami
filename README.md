# miedzy-nami-kierowcami
Autor aplikacji Bartosz Lauks
Stworzona na zaliczenie przedmiotów Projekt Inżynierski oraz Testowanie Oprogramowania

Instrukcja uruchamiania aplikacji;
- Pobierz i zainstaluj doker

W folderze gdzie znajduje się projekt w konsoli wpisz:
- Make build_dev
- Make start_dev


- symfony console doctrine:fixtures:load
  Jest to załadowanie danych tekstowych do bazy danych oraz test ORM

W przeglądarce wpisz następujący URL:
http://localhost:8083/
lub
localhost:8083

I GOTOWE !

# Test

W folderze gdzie znajduje się projekt w konsoli wpisz:

- Make stop (Jeśli dev juz jest uruchomiony)
- Make build_tests
- Make start_tests

Nastepnie przejdz do kontenera:
- docker exec -it miedzy-nami-kierowcami-php-dev bash

Zainstaluj symfony cli:
  - ./symfony_cli_install.sh

Wykonaj test ORM oraz wypełnienie bazy danych danymi testowymi:
 - symfony console doctrine:fixtures:load

W pliku ./config/pacages/security.yaml:
 - Zakomentuj zależonści w access_control

A następnie wykonaj wszystkie testy:
- php vendor/bin/phpunit 

Uwaga !!!
 - Wykonaj przedostati test przed testami funcyjnymi (ostatnie)
 - Po Wykonanie testu nazeży załadować dane jeszcze raz.
