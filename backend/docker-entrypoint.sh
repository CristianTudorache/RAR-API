#!/bin/bash
set -e

# Ruleaza scriptul care initiaza baza de date si creaza tabelul daca nu exista deja
php /var/www/html/scripts/init.php

# Porneste Apache in foreground
apache2-foreground