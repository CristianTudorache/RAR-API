# Proiect API RAR - Instrucțiuni și Plan de Lucru

![LogoApan](https://csmgalati.ro/wp-content/uploads/2023/06/logo-apan-1920x1080-1.png)

## Vlad: Salutare echipă,

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

Pentru orice întrebare, sugestie sau nelămurire, sunt aici să ajut.  
O colaborare deschisă și eficientă duce la succesul proiectului.

## Propunere impartire task-uri

🔹 Vlad (Backend Development & Architecture)
Este responsabil pentru implementarea principală a backend-ului, cu accent pe arhitectură, validare și logica critică a aplicației.

**Responsabilități:**

- Definirea și implementarea rutei principale /api/prezentari, care primește date în format JSON și le validează.
- Validarea completă a datelor, inclusiv verificarea codurilor de prestații conform fișierului nomenclator_prestatii.json.
- Integrarea cu baza de date (pentru stocarea inputului și a statusului răspunsului).
- Gestionarea logicii de coadă (queue) și implementarea unei simulări de cron job care trimite maxim 10 cereri pe minut către endpoint-ul RAR.

🔹 Petru (Frontend UI/UX)
Se ocupă de dezvoltarea interfeței web care permite introducerea manuală a datelor de către utilizator.

**Responsabilități:**

- Crearea unei interfețe web ce conține formularul pentru completarea câmpurilor necesare (VIN, prestații, etc.).
- Validare client-side minimă (câmpuri obligatorii, formate corecte).
- Implementarea unui apel POST (folosind fetch sau axios) către API-ul implementat de Vlad, pentru trimiterea datelor.
- Colaborarea cu Vlad pentru testarea locală a interacțiunii cu backend-ul.

🔹 Gabi (Testare / Admin UI / Generare Date)
Responsabil de testarea funcționalității și generarea datelor pentru simularea cozii de trimitere.

**Responsabilități:**

- Crearea unui script sau a unei mini-interfețe care generează 30–40 de înregistrări fictive, pentru testarea cron job-ului.
- Posibilitatea de a adăuga un tabel de tip admin UI pentru vizualizarea statusului joburilor (Pending / Success / Failed).
- Testarea diverselor scenarii de edge-case (ex: coduri greșite, câmpuri lipsă) și suport în integrarea cu backend-ul.


## Propunere sistem functionare aplicatie

- Repo-ul va conține două directoare principale: /backend (PHP API) și /frontend (Vue.js UI).
- Aplicația poate fi rulată local prin Docker, cu containere separate pentru backend și frontend.
- Un docker-compose.yml va orchestra containerele astfel încât frontend-ul să comunice corect cu backend-ul, gestionând automat rețeaua și porturile.
- Backend-ul PHP va expune endpoint-ul /api/prezentari, iar frontend-ul Vue.js va face apeluri către acest endpoint prin configurația internă Docker.
- Pentru testare, echipa tehnică va putea porni aplicația cu o singură comandă (docker-compose up), având mediul complet izolat și configurat corect.
- Această abordare asigură consistență între medii (dezvoltare, testare, producție) și elimină problemele de configurare locală.

Mult succes tuturor!  
Vlad
