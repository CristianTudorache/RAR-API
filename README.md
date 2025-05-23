# Proiect API RAR - Instrucțiuni și Plan de Lucru

![LogoApan](https://csmgalati.ro/wp-content/uploads/2023/06/logo-apan-1920x1080-1.png)

## Vlad: Salutare echipă,

Acest document va fi actualizat pe parcurs pe măsură ce avansăm cu proiectul.  
Am inițiat organizarea acestui repo și setup-ul de bază pentru colaborare.  

## Pentru rularea aplicatiei foloseste:
 
    
    ```bash
    docker compose up --build
    ```

### Ce am făcut la inceput

- Am clonat repository-ul și am creat branch-uri individuale pentru fiecare dintre noi, în formatul `feature/nume`.
- Am stabilit un workflow simplu de lucru cu git: branch-uri separate pentru fiecare, branch `dev` pentru integrare și `main` pentru versiune stabilă.
- Am pregătit pașii inițiali pentru colaborare în echipă și gestionarea codului.

## Ce am realizat până acum ca si echipa

- Am containerizat ambele aplicații — backend-ul PHP și frontend-ul Vue.js — în containere separate, orchestrate eficient cu un fișier **docker-compose.yml**.  
Aceasta asigură un mediu consistent, ușor de pornit și scalabil.

- Am respectat **best practices** în scrierea codului și gestionarea versiunilor pe Git, folosind branch-uri dedicate, commit-uri clare și un workflow simplu pentru colaborare.

- Am optimizat validările input-urilor în frontend, pentru a preveni trimiterea de date invalide și pentru a oferi feedback clar utilizatorului.

- Am implementat o validare riguroasă în backend la primirea datelor, pregătind arhitectura pentru integrarea cu platforma RAR, cu atenție la consistența și securitatea informațiilor.

- Am creat script-uri și entrypoint-uri Docker pentru a putea porni toată soluția dintr-o singură comandă în terminal (`docker-compose up`), facilitând dezvoltarea și testarea locală.

- Am separat clar logica de cod pe directoare și module, pentru a avea un proiect scalabil, ușor de înțeles și de extins pe viitor.

- Am configurat baza de date astfel încât să stocheze toate vehiculele care trebuie trimise către RAR într-un tabel **vehicle_queue**, facilitând managementul cozii de procesare.

- Am simulat un **cronjob** intern care procesează această coadă, trimițând către RAR un număr limitat (maxim 10) de inserții pe minut, respectând astfel cerințele proiectului.

---

## Observații finale

Există cu siguranță zone unde soluția poate fi îmbunătățită și optimizată (ex: extinderea testelor automate, tratarea mai complexă a erorilor, o interfață de administrare mai detaliată).  
Din cauza constrângerilor de timp, am prioritizat implementarea funcționalităților de bază, pentru a avea un MVP stabil și funcțional.  

## Video cu aplicatia si metoda de rulare: 
https://vladspace.s3.eu-central-1.amazonaws.com/proof_of_work.mov


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

---

Mult succes tuturor!  
Vlad
