# Proiect API RAR - Instrucțiuni și Plan de Lucru

## Vlad
## Salutare echipă,

Acest document va fi actualizat pe parcurs pe măsură ce avansăm cu proiectul.  
Am inițiat organizarea acestui repo și setup-ul de bază pentru colaborare.  

### Ce am făcut până acum

- Am clonat repository-ul și am creat branch-uri individuale pentru fiecare dintre noi, în formatul `feature/nume`.
- Am stabilit un workflow simplu de lucru cu git: branch-uri separate pentru fiecare, branch `dev` pentru integrare și `main` pentru versiune stabilă.
- Am pregătit pașii inițiali pentru colaborare în echipă și gestionarea codului.

### Cum lucrăm

1. Clonați repository-ul (dacă nu l-ați clonat deja):

    ```bash
    git clone <url-repo>
    ```

2. Faceți checkout pe branch-ul vostru personal:

    ```bash
    git checkout feature/numele-tau
    ```

3. Faceți modificările necesare, apoi commit:

    ```bash
    git add .
    git commit -m "feat: descriere scurtă a modificării"
    ```

4. Urcați modificările:

    ```bash
    git push origin feature/numele-tau
    ```

5. Deschideți Pull Request către branch-ul `dev` când sunteți gata pentru review.

---

## Cerințele proiectului

- Dezvoltarea unui **API PHP** pentru transmiterea informațiilor către RAR, cu validarea datelor și a răspunsurilor.
- Utilizarea unei baze de date pentru stocarea datelor transmise.
- Limitarea la maximum 10 inserții pe minut.
- Simularea unui **cron job** care procesează o coadă de 30-40 job-uri respectând această limită.
- Posibilitatea de a introduce manual datele de test (fișier sau tabel).
- O interfață web pentru introducerea și transmiterea manuală a datelor prin API.

---

## Tehnologii și detalii

În acest moment nu am stabilit tech stack-ul final.  
Fiecare poate propune soluția potrivită, respectând cerințele de mai sus.  

---

## Suplimentar

Acest README va fi actualizat pe măsură ce avansăm, cu informații noi legate de implementare, standarde de cod, testare și alte detalii importante.

Atentie! Dacă apar modificări sau completări în acest fișier și doriți să aveți mereu o versiune actualizată, puteți aduce doar acest fișier din branch-ul dev, fără a afecta restul codului din branch-ul vostru personal, folosind comanda: **git checkout origin/dev -- README.md** 

Comanda este sigură și nu afectează alte fișiere sau cod la care lucrați. Recomand să nu faceți merge complet din dev decât dacă sunteti siguri de varianta codului.

---

## Întrebări și comunicare

Pentru orice întrebare, sugestie sau nelămurire, vă rog să mă contactați.  
Ne dorim o colaborare deschisă și eficientă pentru succesul proiectului.

Mult succes tuturor!  
Vlad
