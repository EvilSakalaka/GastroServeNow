# Gastro Serv Now éttermi rendelés rendszer teszt jegyzőkönyv
Tesztelést végezte: 	Csuka Roland 
Operációs rendszer:	WIN11 Home 26200.7171 
Böngésző: 		Google Chrome 142.0.7444.176
Dátum: 		2025.12.02  
Talált hibák száma: 	9  
## Manager felhasználói funkciók tesztelése
### Belépés a rendszerbe
-	Az oldal betöltéskor egyből a bejelentkezési felületre ugrik
-	Helytelen belépési adatokra üzenet jelenik meg: Hibás felhasználónév vagy jelszó.
-	Helyes adminisztrátori belépési adatokra megjelenik az adminisztrátori oldalak közöl a Termékek rögzítése/módosítása oldal.
Elérhető menüpontok: Pincér, Séf, Pultos, Manager, Új felhasználó, Dolgozó kezelése, Termékek rögzítése/módosítása.
-	A manager nevére kattintva legördül egy menü: Profilom, Kijelentkezés

### Termékek rögzítése/módosítása
-   Bejelentkezést követően, egyből a Termékek rögzítése/módosítása oldal fogad. Ahol táblázatos formában látom a felvett teszt bejegyzéseket.
-   Jobb alsó sarokban megjelenik a Hozzáadás gomb lebegő formában.
-   Hozzáadás gombra kattintva: az oldal közepén megjelenik egy beviteli form.

#### Termék hozzáadása
-   Kitöltetlenül a mentés gombra kattintva egy lebegő üzenet jelzi hogy a Név mezőt ki kell tölteni
-   A Kategória mezőt üresen hagyva egy lebegő üzenet jelzi hogy a mezőt ki kell tölteni
-   Az Ár mezőt üresen hagyva egy lebegő üzenet jelzi hogy a mezőt ki kell tölteni
-   A Terület legördülő menüt üresen hagyva a form tetején piros hiba üzenet jelzi hogy: A terület megadása kötelező.
-   **Hiba** A terület címke rossz
-   **Hiba** A legördülő menü angolul jelenik meg.
-   Ha a Név mezőbe több mint 255 karakter gépelek piros hiba üzenet jelzi hogy: A termék neve nem lehet hosszabb, mint 255 karakter.
-   Ha a Kategória mezőbe több mint 255 karakter gépelek piros hiba üzenet jelzi hogy: A kategória nem lehet hosszabb, mint 255 karakter.
-   Ha megadok képhez egy kép url címét, kicsiben látom a táblázatban.
-   Amennyiben nem adok meg kép url-t a táblázatban N/A felirat jelenik meg.
-   **Hiba** Weboldal címet is hozzá tudok adni képként.
-   Ha bepipálom a tételt kiemeltnek akkor kékes háttérrel a lista tetején jelenik meg.
-   **Hiba** Új tétel hozzáadásánál nem mentődnek az allergének az adatbázisba.

#### Termék szerkesztése
-   A termékek melett jobb oldalon minden sorban megjelenik a szerkesztés gomb, amire rákattintva felugrik a termék szerkesztése ablak.
-   A szerkeszthető mezők feltöltődnek a beállított értékekkel.
-   Ha a Név mezőbe több mint 255 karakter gépelek piros hiba üzenet jelzi hogy: A termék neve nem lehet hosszabb, mint 255 karakter.
-   Ha a Kategória mezőbe több mint 255 karakter gépelek piros hiba üzenet jelzi hogy: A kategória nem lehet hosszabb, mint 255 karakter. 
-   **Hiba** A terület címke rossz
-   **Hiba** A legördülő menü angolul jelenik meg.


#### Termék törlése
-   A termékek melett jobb oldalon minden sorban megjelenik a törlés gomb, amire rákattintva felugrik a termék törlése ablak.
-   A törlés gombra kattintva felugrik egy megerősítő ablak.
-   A megerősítő ablakban a törlés gombra kattintva törli a tételt az adatbázisból.

### Dolgozó kezelése
-   A dolgozó kezelése gombra kattintva átirányítódik a dolgozók kezelése oldalra
-   A dolgozók táblázatos formában jelennek meg.
-   Minden dolgozónál van szerkesztés és törlés gomb

#### Dolgozó szerkesztése
-   Szerkesztés gombra kattintva megjelenik a dolgozó adatainak szerkesztése felület.
-   A felület feltöltődik a dolgozó adataival kivéve a jelszó mezőt.
-   **Hiba** A felületen a gombon Hozzáadás címke szerepel
-   A Név mezőt üresre törölve és a Mentés gombra kattintva Felszólít hogy töltsük ki a mezőt.
-   **Hiba** Több mint 255 karakter begépelve mentés után szerver oldali hibát dob.
-   A  Felhasználói Név mezőt üresre törölve és a Mentés gombra kattintva Felszólít hogy töltsük ki a mezőt.
-   **Hiba** Több mint 255 karakter begépelve mentés után szerver oldali hibát dob.
-   Ha nem töltjük ki a jelszó mezőt akkor nem változtat rajta
-   Az státusz változását menti adatbázisba.

#### Dolgozó törlése
-   A dolgozók adatai melett jobb oldalon minden sorban megjelenik a törlés gomb, amire rákattintva felugrik a termék törlése ablak.
-   A törlés gombra kattintva felugrik egy megerősítő ablak.
-   A megerősítő ablakban a törlés gombra kattintva törli a dolgozót az adatbázisból.