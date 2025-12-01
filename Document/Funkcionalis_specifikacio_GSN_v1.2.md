**Funkcionális specifikáció**

**Gastro Serve Now (GSN)**

**1.2 verzió**

Készült: 2025. 10.05.

**Készítette:  
Banai Nikoletta, Puskás Bálint László, Csuka Roland, Kelemen Tamás**

# Dokumentum kontroll

## Dokumentum jellemzők

|     |     |
| --- | --- |
| Projekt hivatalos neve: | Gastro Serve Now |
| Projekt rövid neve | GSN |
| Dokumentum címe: | Gastro Serve Now – Funkcionális Specifikáció |
| Verziószám: | 1.0 |
| Állapot: |     |
| Kiadás kelte: | 2025.10.05 |
| Utolsó mentés kelte: | 2025.11.30 |
| Készítette: | Banai Nikoletta |
| Fájlnév: | Funkcionális_specifikáció_GSN_v1.3.docx |

## Változtatások jegyzéke

|     |     |     |
| --- | --- | --- |
| Verzió | Dátum | Változtatás rövid leírása |
| 1.0 | 2025.10.05 | Első verzió |
| 1.1 | 2025.10.08 | Módosítás |
| 1.2 | 2025.10.12 | Módosítás |
| 1.3 | 2025.11.30 | Módosítás |

## Kapcsolódó dokumentumok

|     |     |
| --- | --- |
| Dokumentum címe | Dokumentum helye /fájl neve |
|     |     |
|     |     |

Tartalomjegyzék

[1 Dokumentum kontroll]
[1.1 Dokumentum jellemzők]
[1.2 Változtatások jegyzéke]
[1.3 Kapcsolódó dokumentumok]
[2 Bevezetés]
[3 Felhasználói felületek]
[3.1.1 Bejelentkezési felület]
[3.1.2 Vendég felület]
[3.1.3 Adminisztrációs felület]
[3.1.4 Bár/Konyha felület]
[4 Funkcionális folyamatok (használati esetek)]
[4.1.1 Kitchen/Bar értesítést kap az új tételekrőlStátusz tervek]
[5 Adatmodell (egyszerűsített)]
[5.1.1 Vendég (Guest)]
[5.1.2 Admin]
[5.1.3 Konyha/Bár (Kitchen/Bar)]
[5.1.4 Kiegészítő táblák]
[6 Jogosultsági rendszer]
[6.1.1 Szerepkörök]
[7 Middleware Védelmi Szintek]
[8 Diagrammok]
[8.1.1 Use case diagramm]
[8.1.2 ER diagramm]
[9 Rendszerkövetelmények]
[Böngésző Támogatás]
[Teljesítmény]
[Biztonsági Követelmények]
[10 Elfogadási kritériumok]
[10.1 Jövőbeli funkciók]

# Bevezetés

Ez a dokumentum egy modern, egy modern konténerizációs technológiákon alapuló platform rendszer funkcionális specifikációját tartalmazza. A rendszer célja, hogy megkönnyítse és felgyorsítsa az éttermi rendelési folyamatokat úgy, hogy a vendégek kényelmesen, asztaluktól digitálisan rögzíthessék rendeléseiket, miközben a bár, konyha és az adminisztrátor valós időben kezelheti és nyomon követheti a folyamatokat. A platform alkalmas arra, hogy csökkentse az emberi hibák számát, növelje a kiszolgálás sebességét, és javítsa az éttermi élményt minden résztvevő számára.

A rendszer tabletes felületén a felszolgáló egy legördülő listából kiválasztja, hogy éppen melyik asztalhoz viszi ki a tabletet, és ott indítja el a vendég sessiont. A vendégek az asztalnál elhelyezett QR kód segítségével saját telefonjukon vagy a tableten megnyithatják az étterem digitális étlapját, így egyszerre többen is böngészhetik az ajánlatot, nincs szükség papíralapú étlapokra

A rendszer azonnali visszacsatolást ad a rendelés státuszáról, lehetőséget biztosít több rendelési ciklusra, és kiterjedt adminisztrációs funkciókat tartalmaz, mint például étel- és italkínálat menedzsment. Mindamellett a rendszer allergén információkat és speciális étkezési igények szerinti szűrést is támogat.

**Rendszeráttekintés**

Az éttermi rendeléskezelő rendszer, amely lehetővé teszi a vendégek, a személyzet és az adminisztrátorok számára, hogy hatékonyan kommunikáljanak és kezeljék a rendeléseket. A rendszer nem platformfüggő, böngésző alapú, így bármilyen eszközön (asztali, tablet vagy mobil) elérhető, és később mobil applikációval is bővíthető, amely biztosítja a zavartalan felhasználói élményt. A vendégek a QR kód beolvasásával gyorsan hozzáférnek az aktuális étlaphoz digitális formában, így egyszerre több személy is böngészheti azt az étteremben, okostelefonon vagy tableten, a papíralapú étlap kiváltásával.

A felszolgálók a tableten választhatják ki az asztalt, ahol elindítják a vendég sessiont, így biztosított a pontos rendelési folyamat és az asztalhoz rendelt digitális élmény. A kezelőfelület minden eszközön egységes és reszponzív marad, alkalmazkodik a kijelző méretéhez, ezért bármilyen eszközön intuitív és könnyen kezelhető felületet kapnak a felhasználók. A rendszer működése során nincs lehetőség az egyedi felület vagy platform elkülönítésére, minden felhasználó egységes élményt kap.

A megoldás nem csak egységessé, hanem egyszerűvé is teszi a rendeléskezelést, miközben papíralapú étlapokra nincs szükség; ezzel támogatja a modern vendéglátóhely fenntartható és digitális működését.

A rendszer helyi infrastruktúrán, saját vagy bérelt szervereken fut, amely biztosítja a magas rendelkezésre állást és a gyors helyi adatkezelést. A fejlesztés és üzemeltetés modern eszközökkel, például Docker konténerekkel történik, amelyek megkönnyítik a telepítést, frissítést és skálázást a helyi környezetben.

# Felhasználói felületek

### Bejelentkezési felület

- - Username mező
    - Jelszó mező
    - "Bejelentkezés" gomb

### Vendég felület

- - Valós idejű étel- és itallap.
    - Többszöri rendelés (pl. utólagos ital, desszert).
    - Rendelési státusz követése: Megrendelve, Lezárva, Teljesítve, Fizetve.
    - Borravaló választás (0%, 5%, 10%), összeg automatikus frissítése.
    - Allergén- és speciális igény szűrők (vegan, gluténmentes stb.).

### Adminisztrációs felület

- - Jólszó változtatás
    - Kínálat karbantartása, termékek státuszának módosítása, törlés, módosítás.
    - Userek karbantartása.

### Bár/Konyha felület

- - Aktuális rendelések asztalonként, valós időben.
    - Rendelés státusz frissítése: "Konyha kész", "Bár kész", "Teljesítve".
    - Munkafolyamat, státusz alapú automatikus szűrés.

#  Funkcionális folyamatok (használati esetek)

- - Pincér elindít session-t
    - Étlapot böngészi (kategória szűrés)
    - Kosárba tesz tételeket (pl. 1x Gulyásleves + 2x Sör)
    - Kattint "Submit Order"

Backend:

- - Order létrehozása (status: active)
    - Order items szétválogatása (kitchen vs bar)

Frontend redirect: Rendelés státusza nézet

### Kitchen/Bar értesítést kap az új tételekrőlStátusz tervek

|     |     |
| --- | --- |
| **Státusz** | **Leírás** |
| Megrendelve | Vendég elküldte a rendelést |
| Konyha Kész | Konyha elérhetővé tette a fogást |
| Bár Kész | Bár elkészítette az italt |
| Teljesítve | Minden rendelés elkészült, kész a fizetéshez |
| Vendég Vége | Vendég jelzi fizetési szándékát |
| Fizetve | A teljes számla rendezve, vendég távozhat |

# Adatmodell (egyszerűsített)

### Vendég (Guest)

Vendég nem regisztrál, nem lép be, azonosító automatikusan kiosztásra kerül.

- Attribútumok:
    - GuestID (automatikus egyedi azonosító)
    - Asztalszám (melyik asztalnál ül)
    - Rendelések listája (kapcsolat a Rendelés entitással)
    - Fizetési mód (bankkártya/készpénz, ha választott)
    - Allergén szűrő preferenciák (opcionális)

### Admin

Az éttermi adminisztrátor, aki kezeli a kínálatot és rendszerszintű beállításokat. Csak adminisztrátor tud új felhasználót regisztrálni, azonban minden user (admin vagy staff) módosíthatja saját jelszavát.Attribútumok:

- - AdminID (egyedi azonosító)
    - Felhasználónév
    - Jelszó (titkosítva, bármely user módosíthatja, csak admin vihet fel újat)
    - Jogosultság szintek (pl. teljes admin, konyhai dolgozó stb.)

### Konyha/Bár (Kitchen/Bar)

Konyhai és bár személyzet, akik nyomon követik és kezelik a rendeléseket.

- Attribútumok:
    - StaffID (egyedi azonosító)
    - Név
    - Feladatkör (Konyha vagy Bár)
    - Aktuális rendelések listája (kapcsolat a Rendelés entitással)
    - Rendelés státuszok frissítési jogosultsága

### Kiegészítő táblák

- Rendelés (Order)
    - OrderID
    - GuestID (kapcsolat a Vendég táblához)
    - Asztalszám
    - Termékek listája (Termék entitás hivatkozással)
    - Státusz (Megrendelve, Konyha kész, Bár kész, Teljesítve, Fizetve)
    - Időbélyeg (rendelési idő)
    - Fizetési mód
    - timestamp_ordered (rendelés időpontja, datetime)
    - timestamp_closed (lezárás időpontja, datetime)
    - total_amount (végösszeg, decimal)
- order_item (Rendelési tétel)
    - order_item_id (egyedi azonosító, int)
    - order_id (hivatkozás rendelésre, int)
    - product_id (hivatkozás termékre, int)
    - quantity (mennyiség, int)
    - unit_price (egységár, decimal)
- table_location (Asztalok helye)
    - table_number (egyedi azonosító, int)
    - location_description (helyleírás, varchar)
    - qr_code (táblára generált QR-kód, varchar)
    - status (pl. szabad, foglalt, varchar)
- guest_session (Vendég munkamenet)
    - session_id (egyedi azonosító, int)
    - table_number (hivatkozás az asztalra, int)
    - session_token (vendég token azonosító, varchar)
    - started_at (belépés időpontja, datetime)
    - ended_at (kilépés időpontja, datetime)
    - active (jelenleg aktív-e, bool)
- assignment (Asztalhoz rendelés, személyzethez)
    - assignment_id (egyedi azonosító, int)
    - table_number (hivatkozás asztalra, int)
    - user_id (hivatkozás user-re, int)
    - assigned_at (rendelés ideje, datetime)
    - status (pl. aktív, nyitott, lezárt, varchar)
- staff (Dolgozó)
    - user_id (hivatkozás user-re, int)
    - name (név, varchar)
    - username (felhasználónév, varchar)
    - password (bármely user módosíthatja a sajátját)
    - role (pl. konyha, bár, felszolgáló, varchar)
    - active (aktív státusz, bool)
- Termék (Product)
    - ProductID
    - Név
    - Kategória (étel, ital, desszert)
    - Ár
    - Aktív/Inaktív státusz
    - Allergén jelölések
    - Fotók, videók
- Értékelés (Review)
    - ReviewID
    - GuestID
    - OrderID
    - Értékelés (csillagok)

# Jogosultsági rendszer

### Szerepkörök
![szerepkorok](https://github.com/EvilSakalaka/GastroServeNow/tree/main/Document/image/szerepkorok.jpg)

# Middleware Védelmi Szintek
![vedelmiszintek](https://github.com/EvilSakalaka/GastroServeNow/tree/main/Document/image/vedelmiszintek.jpg)

# Diagrammok

### Use case diagramm
![use_case](https://github.com/EvilSakalaka/GastroServeNow/tree/main/Document/image/use_case.jpg)

### ER diagramm
![ER_DIAGRAMM](https://github.com/EvilSakalaka/GastroServeNow/tree/main/Document/image/ER_DIAGRAMM.jpg)

# Rendszerkövetelmények

## Böngésző Támogatás

- - Chrome 90+
    - Firefox 88+
    - Safari 14+
    - Edge 90+

## Teljesítmény

- - Oldal betöltés: < 2 sec
    - Order submit: < 1 sec
    - Status refresh: < 500ms (polling) / real-time (SSE v1.1+)

## Biztonsági Követelmények

- - HTTPS (production)
    - CSRF protection (@csrf token)
    - SQL Injection prevention (Eloquent)
    - XSS prevention (Blade escaping)
    - Session timeout: 30 perc

# Elfogadási kritériumok

- Funkcionális megfelelőség: a rendszer az összes meghatározott funkciót helyesen és megbízhatóan látja el.
- Felhasználói élmény: a felület felhasználóbarát, könnyen kezelhető és reszponzív platformokon is megbízható.
- Teljesítmény: a rendszer kezelni tudja a megengedett felhasználói terhelést, például több száz rendelést valós időben.
- Stabilitás: a rendszer karbantartás nélkül működik az elfogadási időszak alatt.

## Jövőbeli funkciók

- Mobil alkalmazás bevezetése a még kényelmesebb vendégélmény érdekében.
- Készletfigyelés
- Képfeltöltés: ételfotók, videók, és vendégértékelések integrálása a menübe.
- Élő statisztikai panel bővítése, például csapat- és árbevétel-analitika.
- Automatikus rendelésfeldolgozás és -optimalizálás AI segítségével.
- Egyedi promóciók, kedvezmények időzítése és kiemelése.
- Időzített rendelés (Főételre, desszertre)