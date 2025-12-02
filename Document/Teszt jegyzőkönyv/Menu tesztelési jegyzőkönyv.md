# Gastro Serv Now éttermi rendelés rendszer teszt jegyzőkönyv
## Menü funkciók tesztjegyzőkönyv


**Rendszer:** GastroServeNow – Menü modul  
**Verzió:** 1.0  
**Teszt típusa:** Funkcionális teszt  
**Tesztelő:** Banai Nikoletta  
**Tesztelési környezet:** Windows 11 / Brave
**Teszt dátuma:** 2025.12.02.  


---


### 1. Belépés és jogosultság


#### TC-001 – Külső menü jogosultsági ellenőrzése
- Bug ID: **BUG-037 – Menü jogosultsági hiba – minden szerepkör látja a menüt**  
- Előkészítés: Bejelentkezett Pincér, Séf, Pultos, Manager felhasználók.  
- Lépések:  
  - Jelentkezz be belső szerepkörrel (nem vendég).  
  - Navigálj a belső felületeken.  
  - Ellenőrizd, hogy a külső (vendég) menü elérhető-e.  
- Elvárt eredmény:  
  - A külső menü csak kijelentkezett, vendég felhasználónak érhető el, belső szerepkörök nem látják.
- Tényleges eredmény:  
  - A külső menü minden szerepkörrel belülről is elérhető.  
- Minősítés: **Sikertelen – BUG-037.**


### 2. Menü megjelenés és szűrés


#### TC-002 – Kategória fül (Ételek / Italok)
- Előkészítés: Vegyes (étel, ital) tételek.  
- Lépések:  
  - Karrints „Ételek”-re.  
  - Kattints szűrőt „Italok”-ra.    
- Elvárt eredmény:  
  - „Ételek” fülön csak étel kategóriájú tételek jelennek meg.  
  - „Italok” fülön csak ital kategóriájú tételek jelennek meg.  
- Tényleges eredmény:  
  - A tartalmi szűrés helyesen működik, de a kártyákon megmarad a termékekhez rögzített kategória (étel/ital).  
- Minősítés: **Részben sikeres – BUG-038 érintett.**


### 3. Kiemelt ételek viselkedése


#### TC-003 – Kiemelt tétel pozíciója
- Bug ID: **BUG-039 – Kiemelt ételek nem jelennek meg a lista elején**  
- Előkészítés: Legalább egy normál és egy „kiemelt” jelölésű étel.  
- Lépések:  
  - Jelöld ki egy ételt kiemeltnek.  
  - Töltsd újra a menü oldalt.  
- Elvárt eredmény:  
  - A kiemelt ételek a lista tetején, jól elkülönítve jelennek meg.
- Tényleges eredmény:  
  - A kiemelt tétel a lista közepén vagy végén marad.  
- Minősítés: **Sikertelen – BUG-039.**

#### TC-004 – Kategória sorrend
- Bug ID: **BUG-040 – Kategória sorrend eltér a specifikációtól (kiemelt, ételek, italok)**
- Előkészítés: Menü oldal, étel kártyák.
- Lépések:
  - Vizsgáld meg a kártyák sorrendjét.
- Elvárt eredmény:
  - A kategóriák sorrendje konzisztensen: 1. Kiemelt 2. Ételek 3. Italok).
- Tényleges eredmény:
  - A kategóriák sorrendje össze-vissza változik, nem tartja a megadott sorrendet.
- Minősítés: **Sikertelen – BUG-040.**


### 4. Megjelenési/eredeti design hibák


#### TC-005 – Ár megjelenítés: Hiányzó szóköz
- Bug ID: **BUG-028 – Hiányzó térköz a 'Ft' pénznem és az összeg között**
- Előkészítés: Menü oldal, árak kártyán.
- Lépések:
  - Vizsgáld meg az árakat a kártyákon.
- Elvárt eredmény:
  - Szabványos formátum: '2 500 Ft' (szóközzel).
- Tényleges eredmény:
  - Összefolyik ('2500Ft' vagy '2500 Ft'), ezres elválasztó nélkül.
- Minősítés: **Sikertelen – BUG-028.**


#### TC-006 – Kártyák árnyéka vágott
- Bug ID: **BUG-034 – A kártyák árnyéka levágódik a széleken**
- Előkészítés: Menü oldal, böngésző zoom 100%.
- Lépések:
  - Vizsgáld meg a kártyák szélét.
- Elvárt eredmény:
  - Lágy árnyék, minden oldalon egységes.
- Tényleges eredmény:
  - A jobb oldali árnyék élesen véget ér (padding hiba a konténeren).
- Minősítés: **Sikertelen – BUG-034.**


#### TC-007 – Kártyamagasság soronként
- Bug ID: **BUG-031 – Inkonzisztens kártyamagasságok a sorokban**
- Előkészítés: Menü oldal, különböző hosszúságú ételnevek.
- Lépések:
  - Nézd meg a hosszú és rövid nevű tételeket egy sorban.
- Elvárt eredmény:
  - Egy sorban lévő kártyák egyforma magasságúak.
- Tényleges eredmény:
  - A rövidebb nevű kártya kisebb, grid lyukasan hat.
- Minősítés: **Sikertelen – BUG-031.**


#### TC-008 – Elcsúszó sticky fülek
- Bug ID: **BUG-030 – Kategória fül elcsúsztak a lap tetején**
- Előkészítés: Menü oldal, sok étel görgetése.
- Lépések:
  - Görgess le a lista aljára, próbálj kategóriát váltani.
- Elvárt eredmény:
  - Tabok (ételek/italok) mindig fent maradnak, sticky viselkedéssel.
- Tényleges eredmény:
  - Tabok kigördülnek a képből, vissza kell görgetni a váltáshoz.
- Minősítés: **Sikertelen – BUG-030.**


#### TC-009 – Helyesírási hiba
- Bug ID: **BUG-033 – Helyesírási hiba: 'Tyúkhúsleves' u'-vel**
- Előkészítés: Menü oldal, étellista.
- Lépések:
  - Keresd meg a 'Tyúkhúsleves' seedelt sort.
- Elvárt eredmény:
  - Helyes: 'Zöldségleves' (vagy javított név).
- Tényleges eredmény:
  - Megjelenik: 'Zöldségleves' (adatbázis elírás).
- Minősítés: **Sikertelen – BUG-033.**

#### TC-010 – Lassú kép betöltés
- Bug ID: **BUG-032 – Étlap képek lassan töltődnek be (nincs lazy loading)**
- Előkészítés: Menü oldal, étellista.
- Lépések:
  - frissítés után nézd meg milyen gyorsan jelennek meg a képek.
- Elvárt eredmény:
  - Frissítéssel azonnali megjelenítés
- Tényleges eredmény:
  - lassabban töltenek be a képek a vártnál
- Minősítés: **Sikertelen – BUG-032.**

### 5. Újratesztelés eredménye (sikeres esetek)

Az alábbi tesztesetek a hibajavítások utáni újratesztelés (retest) eredményeit rögzítik.

#### TC-011 Külső menü jogosultság (BUG-037)
   - Javítás: A külső (vendég) menü megjelenítését jogosultság‑ellenőrzéshez kötöttük.
   - Újrateszt (TC-011):
     - Elvárt: Belső szerepkörrel (Pincér, Séf, Pultos, Manager) a vendég menü nem érhető el, csak kijelentkezve jelenik meg.
     - Tényleges: A külső menü kizárólag kijelentkezett állapotban látható, belső szerepkörök felületéről eltűnt.
     - Minősítés: Sikeres – BUG-037 lezárható.

#### TC-012 Kategória viselkedés, kiemelés és sorrend (BUG-038, BUG-039, BUG-040)
   - Javítás: A kategóriafülek, a kiemelt flag és a rendezési logika egységesítve lett.
   - Újrateszt (TC-012):
     - Elvárt:  
       - „Ételek” fülön csak étel, „Italok” fülön csak ital jelenik meg.  
       - Kiemelt tételek mindig a lista elején jelennek meg.  
       - A kategóriák sorrendje mindenhol: 1. Kiemelt 2. Ételek 3. Italok.  
     - Tényleges: A szűrés, a kiemeltek rendezése és a kategóriablokkok sorrendje minden frissítésnél a specifikációnak megfelelően működik.
     - Minősítés: Sikeres – BUG-038, BUG-039, BUG-040 lezárhatók.

#### TC-013 Árformátum, kártyamagasság és megjelenés (BUG-028, BUG-031, BUG-034)
   - Javítás: Árformázás, kártya layout és konténer‑padding beállítások módosítása.
   - Újrateszt (TC-013):
     - Elvárt:  
       - Az árak egységesen „2 500 Ft” formátumban jelennek meg.  
       - Egy sorban lévő kártyák azonos magasságúak, nem „lyukas” a grid.  
       - A kártyák árnyéka minden oldalon teljes, nem vágódik le.  
     - Tényleges: Az árak formátuma egységes, a kártyák magassága soronként azonos, az árnyék folytonos marad a konténer szélein is.
     - Minősítés: Sikeres – BUG-028, BUG-031, BUG-034 lezárhatók.

#### TC-014 Helyesírási és tartalmi javítások (BUG-033)
   - Javítás: Az érintett ételnevek adatbázis‑rekordjai korrigálásra kerültek.
   - Újrateszt (TC-014):
     - Elvárt: A korábban hibásan megjelenő „Tyúkhúsleves” és egyéb tételek helyes névvel szerepelnek a menüben.
     - Tényleges: Az összes korábban jelzett elgépelés javítva, a menüben csak helyes elnevezések láthatók.
     - Minősítés: Sikeres – BUG-033 lezárható.

#### TC-015 Képek betöltése és teljesítmény (BUG-032)
   - Javítás: Lazy loading és optimalizált képbetöltés bevezetése a menü kártyáinál.
   - Újrateszt (TC-015):
     - Elvárt: Lassabb hálózat mellett is folyamatos görgetés, a képek placeholderrel indulnak és zavaró elrendezés‑ugrás nélkül töltődnek be.
     - Tényleges: A képek frissítés után azonnal megjelennek
     - Minősítés: Sikeres – BUG-032 lezárható.
