# Követelményspecifikáció  
**Gastro Serve Now (GSN)**  

## 1. Vezetői összefoglaló

A Gastro Serve Now (GSN) egy éttermi digitális rendeléskezelő rendszer, amely a hagyományos, szóbeli és papíralapú rendelésfelvételt váltja ki egy böngészőből elérhető, több szerepkört (vendég, pincér, bár/konyha, admin) támogató alkalmazással.  
A cél az, hogy gyorsabbá, átláthatóbbá és hibamentesebbé tegye a rendelési folyamatot, csökkentse a tévesen rögzített tételek számát, és javítsa a vendégélményt az étteremben.  

A rendszer lehetővé teszi, hogy a vendégek digitális étlapról válasszanak, rendeléseik státuszát valós időben kövessék, míg a személyzet (pincérek, bár és konyha) strukturált, asztalhoz kötött nézetben lássa és kezelje a beérkező tételeket.  
Az adminisztrátor az étlapot, a felhasználókat és a jogosultságokat kezeli.  
A megoldás böngészőalapú, konténerizált (Docker), ezért könnyen telepíthető és üzemeltethető helyi vagy felhős környezetben.  

## 2. Jelenlegi helyzet leírása

- A rendeléseket jelenleg a felszolgálók szóban veszik fel, jegyzetfüzetbe vagy papír blokkra írják, majd később rögzítik a kasszában vagy egy külön rendszerben.  
- A konyha és a bár sokszor egy közös, nyomtatott vagy kézzel írt „cetli” alapján dolgozik, ami növeli a félreértések, elveszett vagy duplikált rendelések esélyét.  
- Az étlap papíralapú, frissítése (ár‑ vagy kínálatváltozás) nyomdai költséggel és időráfordítással jár, ezért az aktuális készlet és a nyomtatott étlap gyakran eltér egymástól.  
- A vendégek nem látnak valós idejű státuszt a rendelésükről, legfeljebb a felszolgálót kérdezik vissza; ez mindkét félnek plusz terhet jelent.  
- A vezetőség számára korlátozottak a riportálási lehetőségek (forgalom időszakokra bontva, legnépszerűbb termékek, leterheltség asztalonként); ezek általában manuális Excel‑jelentésekből készülnek.  

## 3. Vágyálomrendszer leírása

A cél egy olyan böngészőalapú, több szerepkört támogató rendszer kialakítása, amely:

- Digitális, kategorizált étlapot biztosít (ételek, italok, desszertek, allergén információk), amelyet a vendégek saját eszközről vagy az étterem által biztosított tabletről böngészhetnek.  
- Lehetővé teszi, hogy a pincér asztalhoz kötött „vendég sessiont” indítson, amelyhez a vendég telefonja vagy a tablet csatlakozik, és több körben is lehessen rendelést leadni ugyanarra az asztalra.  
- Az egyes rendelések tételeit automatikusan szétosztja a konyha és a bár között (például az ételek a konyhai nézetben, az italok a bárnézetben jelennek meg).  
- Valós idejű státuszkezelést biztosít (pl. Megrendelve, Készül, Konyha kész, Bár kész, Teljesítve, Fizetés alatt, Fizetve), amelyről a pincér és opcionálisan a vendég is visszajelzést kap.  
- Központilag kezeli az étlapot, az árakat, a termékstátuszokat (aktív/inaktív, kifogyott) és a dolgozói felhasználói fiókokat, szerepköröket.  
- Támogatja az egyszerű, de bővíthető riportálási lehetőségeket (napi/ heti forgalom, termék‑statisztikák, asztalonkénti számlák).  
- Reszponzív felületet biztosít mobilon, tableten és asztali gépen is, minimális betanulási igénnyel a személyzet számára.  
- Konténerizált (Docker) formában telepíthető, Laravel (PHP) alapú backendet, Blade alapú frontendet és relációs adatbázist (SQLite/MariaDB) használ.  

## 4. Vonatkozó előírások, szabványok és ajánlások

- Adatvédelem és személyes adatok kezelése: általános GDPR‑elvárásoknak megfelelő kezelés (felhasználói fiókok, logok).  
- Webes biztonsági alapelvek: jelszavas hitelesítés, HTTPS használata éles környezetben, CSRF‑védelem, SQL injection és XSS elleni védelem (Laravel alapértelmezett mechanizmusai).  
- Böngésző‑kompatibilitás: Chrome, Firefox, Edge, Safari aktuális stabil verziói támogatottak.  
- Elérhetőség és reszponzivitás: az alkalmazás mobil‑ és tablet‑képernyőn is használható legyen.  

## 5. Érintettek és szerepkörök rövid áttekintése

- **Vendég (Guest):** asztalnál ül, digitális étlapot böngészik, saját eszközről vagy tabletről rendel, rendelését és végösszegét megtekintheti.  
- **Felszolgáló (Waiter):** bejelentkezés után asztalokat kezel, vendég sessiont indít/leállít, rendeléseket indít/véglegesít, fizetést kezeli.  
- **Konyha/Bár személyzet (Kitchen/Bar):** a csak rájuk vonatkozó tételeket látják, a rendelések státuszát frissítik (készül → kész).  
- **Adminisztrátor (Admin):** termékek, árak, kategóriák, felhasználók, szerepkörök karbantartása, rendszerbeállítások, riportok.  

## 6. Fő üzleti folyamatok (áttekintés)

- Vendég érkezik – pincér asztalhoz rendel egy vendég sessiont.  
- Vendég(ek) az asztalhoz tartozó digitális étlapról tételeket választanak, rendelést küldenek be.  
- Rendszer rendelést hoz létre, tételeket szétosztja konyha/bár között.  
- Konyha és bár dolgozói a saját felületükön dolgozzák fel a tételeket, státuszt frissítenek.  
- Pincér értesül a kész tételekről, kiszolgálja a vendéget.  
- Vendég fizet, pincér lezárja a rendelést és a sessiont, az asztal ismét szabad lesz.  

## 7. Követelménylista (GSN)

ID | Verzió | Név | Kifejtés
-- | ------ | --- | -------
K01 | V1.0 | Asztalok és vendég sessionök kezelése | A rendszernek támogatnia kell az asztalok nyilvántartását, a felszolgáló által indított és lezárt vendég sessionök kezelését, így egy asztalhoz több rendelési kör is kapcsolható ugyanazon ülés alatt.
K02 | V1.0 | Digitális étlap és termékadminisztráció | Az admin felületen az éttermi termékek (ételek, italok, desszertek stb.) rögzíthetők, módosíthatók, inaktiválhatók; a vendég és a személyzet digitális étlap‑nézetben, kategóriák szerint böngészheti az aktuális kínálatot.
K03 | V1.0 | Rendelés és tételkezelés | A vendég vagy a felszolgáló kosárba helyezhet tételeket, rendelést adhat le; a rendszer rendelésenként tárolja a tételeket, mennyiséggel, árakkal, kapcsolódó asztal‑ és session‑azonosítóval.
K04 | V1.0 | Konyha/bár munkafolyamat támogatása | A rendszer a rendeléstételeket automatikusan konyhai és bár tételekre bontja, és a megfelelő szerepkör felületén jeleníti meg; a konyha/bár státuszt állíthat (készül, kész), ami visszajelzésként megjelenik a pincér felületén.
K05 | V1.0 | Rendelési státuszok és fizetés kezelése | A rendszer a rendeléshez státuszláncot tart fenn (pl. Megrendelve, Készül, Konyha/Bár kész, Teljesítve, Fizetés alatt, Fizetve), amelyet a személyzet lépésenként módosíthat; a fizetés lezárása után az asztal „szabad” státuszba kerül.
K06 | V1.0 | Felhasználói fiókok és jogosultságok kezelése | A rendszerben bejelentkezéshez kötött admin, pincér és konyha/bár felhasználók működnek; az admin hozhat létre új dolgozói fiókot, módosíthatja vagy inaktiválhatja azt. Minden user saját jelszavát módosíthatja.
K07 | V1.0 | Egyszerűen használható, reszponzív kezelőfelület | A felhasználói felület reszponzív, mobilon, tableten és asztali gépen is jól használható; a szerepkör‑specifikus nézetek (vendég, pincér, konyha/bár, admin) áttekinthető, munkafolyamat‑orientált módon jelennek meg.
K08 | V1.0 | Platformfüggetlen, konténerizált működés | A rendszer böngészőalapú frontendet, Laravel alapú backendet és relációs adatbázist használ, Docker konténerekben futtatható módon, hogy különböző operációs rendszereken (Linux, Windows) is egységesen telepíthető legyen.
K09 | V1.0 | Teljesítmény és megbízhatóság | A rendszernek egy közepes forgalmú étteremben (több tucat aktív asztal, párhuzamos rendelés) is folyamatosan, akadásmentesen kell működnie; a tipikus műveletek (étlap betöltés, rendelés leadása, státusz frissítése) néhány másodpercen belül lefutnak.
K10 | V1.0 | Bővíthetőség és riportálás | Az adatmodellnek és az implementációnak támogatnia kell a jövőbeni bővítéseket (pl. törzsvendég‑program, értékelések, online foglalás), illetve alap riportok (napi/ heti forgalom, termék‑statisztikák) előállítását.

## 8. Irányított és szabad szöveges riportok

- Napi forgalmi riport (időszak, asztalonkénti és összesített forgalom, borravaló‑összeg).  
- Termékenkénti értékesítési riport (adott időszakban eladott mennyiség, árbevétel).  
- Asztalhasználati riport (átlagos ülési idő, rendelési körök száma).  

## 9. Fogalomszótár

- **Vendég session:** Egy asztalhoz kötött, időben összefüggő éttermi tartózkodás és a hozzá tartozó rendelések összessége.  
- **Order (Rendelés):** Egy adott időpontban leadott rendelés, amely több tételt (order item) tartalmazhat.  
- **Order item (Rendelési tétel):** Egy konkrét termék adott mennyiségben egy rendelésen belül.  
- **Asztal (Table):** Fizikai éttermi asztal egyedi azonosítóval, amelyhez session és rendelések tartoznak.  
- **Konyhai tétel / Bár tétel:** Terméktípus alapján konyhához vagy bárhoz tartozó rendelési tétel.  
- **Státusz:** A rendelés vagy rendeléstétel aktuális állapota (Megrendelve, Készül, Kész, Teljesítve, Fizetve stb.).
