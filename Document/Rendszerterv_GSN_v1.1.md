Rendszerterv

Gastro Serve Now (GSN)

1.1 verzió

Készült: 2025. 10.05.

Készítette:  
Banai Nikoletta, Puskás Bálint László, Csuka Roland, Kelemen Tamás

# **Dokumentum kontroll****Dokumentum jellemzők**

|     |     |
| --- | --- |
| Projekt hivatalos neve: | Gastro Serve Now - Éttermi digitális rendeléskezelő rendszer |
| Projekt rövid neve | \[Kulcsszavak\] |
| Dokumentum címe: | Gastro Serve Now – Rendszerterv |
| Verziószám: | 1.0 |
| Állapot: |     |
| Kiadás kelte: | 2025.10.12 |
| Utolsó mentés kelte: | 2025.11.30 |
| Készítette: | Banai Nikoletta |
| Fájlnév: | &lt;FileName&gt; |

## Változtatások jegyzéke

|     |     |     |
| --- | --- | --- |
| Verzió | Dátum | Változtatás rövid leírása |
| 1.0 | 2025.10.12 | Első verzió |
| 1.1 | 2025.11.30 | Módosítás |
|     |     |     |

## Kapcsolódó dokumentumok

|     |     |
| --- | --- |
| Dokumentum címe | Dokumentum helye /fájl neve |
|     |     |
|     |     |

Tartalomjegyzék

[**1\. Bevezetés** ]
[**2\. Célok és funkciók**]
[**3\. Érintettek és szerepkörök**]
[**4\. Funkcionális követelmények**]
[**5\. Nem funkcionális követelmények**]
[**6\. Rendszerkörnyezet**]
[**7\. Korlátozások**]
[**8\. Példa felhasználói történet**]
[**9\. Elfogadási kritériumok** ]
[**10\. Jövőbeli bővítési lehetőségek**]

# **1\. Bevezetés**

A Gastro Serve Now egy modern konténerizációs technológiákon alapuló platform, amely célja az éttermi rendelési folyamatok megkönnyítése és felgyorsítása. A rendszer lehetővé teszi a vendégek számára, hogy kényelmesen, asztaluktól digitálisan adják le rendeléseiket, miközben a bár, konyha és adminisztrátor valós időben kezelheti és nyomon követheti a folyamatokat. A cél a kiszolgálás minőségének javítása, emberi hibák csökkentése és optimális vendégélmény biztosítása.

# **2\. Célok és funkciók**

- Digitális rendeléskezelés: Böngésző alapú, minden eszközön (asztali, tablet, mobil) elérhető
- Asztal kezelés: Felszolgáló a listából választja ki az asztalt és indítja a vendég sessiont
- Asztal azonosítás: Session-based URL azonosítás (QR kód jövőbeni fejlesztés)
- Többszöri rendelés: Vendég több rendelési körben adhat le tételeket
- Valós idejű státuszkövetés: Rendelés állapota (új, készül, kész, kiszolgálva, fizetve)

**3\. Érintettek és szerepkörök**

## **Vendég (Guest)**

- Nem regisztrált, azonosító automatikus Session-alapú hozzáférés (Pincér indítja el)
- Étrend-böngészés és rendelés leadása
- Borravaló kiválasztása

## **Felszolgáló (Waiter)**

- Bejelentkezik saját fiókkal
- Asztal kiválasztása
- vendég session indítása
- Fizetés kezelése
- Asztal státuszának manuális frissítése

## **Konyha/Bár Személyzet (Kitchen/Bar)**

- Bejelentkezik dedikált fiókkal
- Konyha: Csak a konyhára vonatkozó tételek láthatók
- Bár: Csak a bárra vonatkozó tételek láthatók
- Rendelés státuszának frissítése (új → készül → kész)

## **Adminisztrátor (Admin)**

- Felhasználók kezelése (létrehozás, szerkesztés, deaktiváció)
- Étlap kezelése (termékek, árak, kategóriák)
- Teljes körű rendszerfelügyelet

## **4\. Funkcionális követelmények**

**Rendelési folyamat:**

1\. Pincér: Asztalt választ listából, "Vendég Session Indítása" gomb

2\. Rendszer: Session generálás, asztal státusza: "ordering"

3\. Vendég: Étlapot böngészi saját eszközén vagy a tableten

4\. Vendég: Tételeket kiválaszt, kosárhoz tesz, rendelést leadja

5\. Rendszer: Order szétválogatása (Konyha vs. Bár items)

6\. Konyha/Bár: Tételeket elkészítik, státuszt "kész"-re állítják

7\. Pincér: Értesítést kap, tételeket kiszolgálja

8\. Vendég: Fizetni szeretne, Pincér visszaveszi az eszközt

9\. Pincér: Lezárja a session-t, asztal: "szabad"

**Adatmodell és adatbázis-terv:**

- Vendégek, felhasználók, rendelés, termékek, értékelés, asztalok és munkamenetek táblázatos modellje.
- Minden asztal egyedi azonosítóval rendelkezik, nincs QR kód használat.
- Minden felhasználó maga tud jelszót módosítani, új felhasználót csak az admin vihet fel.

## **5\. Nem funkcionális követelmények**

- Platform: Böngésző alapú (Chrome, Firefox, Safari, Edge)
- Backend: Laravel (PHP)
- Frontend: Laravel Blade Templates
- Adatbázis: SQLite (v1.0), MariaDB (v1.1+)
- Deployment: Docker konténerek
- Biztonság: HTTPS, jelszavas hitelesítés, CSRF protection
- Teljesítmény: Több párhuzamos rendelés kezelése

**6\. Rendszerkörnyezet**

**Backend**

- Framework: Laravel (PHP)
- ORM: Eloquent
- Autentikáció: Laravel built-in auth
- Database: SQLite (v1.0) → MariaDB (v1.1+)

**Frontend**

- Rendezés: Laravel Blade Templates
- Styling: Bootstrap/Tailwind (TBD)
- Interaktivitás: HTMX / Alpine.js / Vanilla JS

**Infrastructure Containerization:**

- Docker Orchestration:
- Docker Compose

**7\. Korlátozások**

- Valós idejű kommunikáció: Nincs (v1.1-ben SSE-vel bővül)
- QR Kód: Nincs (jövőbeni fejlesztés)
- Készlet figyelés: Nincs
- Push notifikáció: Nincs
- Mobil app: Nincs (böngésző alapú alternatíva elérhető)

**8\. Példa felhasználói történet**

**Vendégként:**

Szeretném kiválasztani a választott ételeket és italokat akár nagyobb társaság esetén egy termékből többet is rendelni, hogy egyszerű legyen a rendelés. Szeretném, ha lehetőségem lenne újra rendelést leadni (például plusz italt kérni). A rendelés végén szeretném látni az összes fizetendő összeget, valamint a borravaló választási lehetőségét.

**Bár/Konyha személyzetként:**

Szeretném valós időben látni a vendégek rendeléseit, hogy gyorsan és pontosan tudjam elkészíteni az ételeket és italokat. Fontos, hogy a többszöri rendeléseket kezelni tudjam, és minden új rendelés külön érkezzen, így biztosítva a gördülékeny munkát.

**Adminisztrátorként:**

Szeretném kezelni a termékkínálatot és beállítani a borravaló opciókat. Az admin felület segítségével szeretném biztosítani, hogy a vendégfelület mindig naprakész árinformációkat és termékinformációkat mutasson, valamint kezelni a felhasználói jogosultságokat és munkameneteket.

## **9\. Elfogadási kritériumok**
✅ Rendelések leadása és kezelése működik
✅ Felhasználói felület logikus, könnyen használható
✅ Rendelés státuszok megfelelően frissülnek
✅ Konyha/Bár csak saját tételeket látja
✅ Admin funkciók jogosultságkezeléssel működnek

**10\. Jövőbeli bővítési lehetőségek**

**v1.1 (Q1 2026)**

- Server-Sent Events (valós idejű frissítés)
- MariaDB migrációs support
- API dokumentáció (Swagger)
- Unit test suite

**v2.0 (Q2 2026)**

- QR kód generálás
- Mobil alkalmazás (React Native/Flutter)
- Képfeltöltés + vendor review

**v3.0 (Q3 2026)**

- Készletfigyelés
- AI-alapú rendelésfeldolgozás
- Statisztikai dashboard
- Automata promóciók