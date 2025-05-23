#!/bin/bash
set -e

# Așteaptă conexiunea la baza de date
echo "Verific conexiunea la baza de date..."

until php -r '
    try {
        $pdo = new PDO("pgsql:host=db;port=5432;dbname=postgres", "postgres", "postgres");
        exit(0);
    } catch (PDOException $e) {
        exit(1);
    }
'; do
  echo "Baza de date nu e gata. Reîncerc în 2 secunde..."
  sleep 2
done

echo "Baza de date este gata. Pornesc scriptul init.php..."

# Rulează scriptul care inițializează baza de date și creează tabelul
php /var/www/html/scripts/init.php

# Pornește Apache în foreground
apache2-foreground