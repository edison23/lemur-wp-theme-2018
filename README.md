# Lemur WP Theme 2018

WordPress theme for Lemur (Masaryk university students news portal)

The documentation below is currently available only in Czech (given the purpose of this theme it makes more sense).

![Lemur logo](https://www.lemurmu.cz/wp-content/uploads/2019/03/logo-lemur01-wide-1400x1146.png)

# Dokumentace

Šablona Lemur WP Theme 2018 je postavena na základní šabloně HTML5 Blank Starter WordPress Theme, kterou používá jako boilerplate. Dále pracuje s vestavěnými funkcemi WordPressu.

## Konfigurace šablony

Soubor `config.json` obsahuje několik parametrů, které umožňují chování šablony změnit. Obsahuje následující parametry:

- `exclude_cats`: ID kategorií, jejichž názvy se nemají uživatelům na stránce vypisovat (při výpisu kategorií, do nichž článek patří). Typicky to je kategorie Slider a Dlouhodobě relevantní články. ID kategorií lze zjistit v administraci kategorií ve WP z parametru `tag_ID` v URL při úpravě konkrétní kategorie. Např.: `...wp-admin/term.php?taxonomy=category&tag_ID=1967&post_type=...`.
- `category_slugs`: názvy kategorií pro URL. Tato jména se používají při třídění článků na hlavní stránce (více níže), takže je důležite je v konfiguraci mít správně. Tento parametr obsahuje asociativní pole dvojic ve tvaru proměnná : název v URL, takže pokud byste potřebovali měnit něco v této části, měňte druhý prvek dvojice, ne první. První je řetězec, který se používá v kódu šablony pro referenci těchto dvojic.
- `limits`: konfigurace různých limitů naříč šablonou (většinou se ale týkají hlavní stránky).
    - `mainDBquery`: počet článků v databázi, které zpracovat při třídění článků na hlavní stránce. Čím méně se jich zpracuje, tím větší je šance, že málo používané kategorie nebudou dostatečně naplněny (týká se především dlouhodobě relevantních článků).Čím více se jich zpracovává, tím déle to trvá (ale to by při těchto počtech (do 500) nemělo moc vadit).
    - `excerptLen`: max. délka výňatku (perexu) článku
    - `dlouhodobe`, `kratke`, `prominent`, `studentsky`, `univerzita`: max. počty článků, které se mají vytisknout v příslušných sekcích na hlavní stránce (názvy těchto parametrů jsou shodné s těmi z `category_slugs`, `prominent` jsou ony výraznější články pod hlavním článkem).


## Účel jednotlivých souborů

Všechny soubory šablony se nachází na serveru ve složce `wp-content/themes/wp-theme-lemur-2018`.

### Hlavní stránka

Na rozdíl od běžných šablon pro WordPress, které pro hlavní stránku používají běžný výpis příspěvků v `loop.php`, šablona Lemur 2018 používá separátní skript pro výpis hlavní stránky, a to `mainpage.php`. 

Příspěvky v získává z databáze ve dvou dotazech na SQL přes vestavěnou funkci WordPressu `WP_Query`. Jedno volání slouží k získání posledních 150 příspěvků, které jsou poté roztřídeny podle kategorií. Druhé volání slouží k získání posledních sedmi příspěvků z kategorie dlouhodobě relevantních článků (sekce "Mohlo by vás zajímat"). 

Dotaz do databáze obstarává funkce `get_articles()`, kterou volá `main()` pro získání posledních 150 článků pro roztřídění a vypsání na hlavní stránce a `get_long_term_relevance_posts()` pro získání dlouhodobě relevantních článků.

#### Třídění článků do kategorií

Cílem je roztřídit poslední články tak, aby se zobrazovaly ve správné sekci, tedy hlavní článek (s kategorií "slider") jako nejvíce prominentní nahoře, dále normální články níže rozdělené podle kategorií vyjma krátkých zpráv, které mají vlastní sekci a nemají být žádné jiné sekci. O toto dělení se stará jedna podmínka ve funkci `main()` s následující logikou:

1. Zařadí článek do 2 "prominentních článků", pokud není článek v kategorii Krátké zprávy _a zároveň_ "slider" není prázdný, _nebo_ pokud není v kategorii "slider", _a zároveň_ pokud je počet již zařazených článků ostře menší než 2.
2. Jinak zařadí článek na hlavní pozici (jako tzv. "slider"), pokud je článek v kategorii "slider" _a zároveň_ není v kategorii Krátké zprávy _a zároveň_ není do hlavní sekce (tzv. "slider") zařazen už článek.
3. Jinak zařadí článek do sekce Univerzita, pokud je v kategorii Univerzita _a zároveň_ pokud není v kategorii Krátké zprávy
4. Jinak zařadí článek do sekce Studentský život, pokud je v kategorii Studentský život _a zároveň_ pokud není v kategorii Krátké zprávy
5. Jinak zařadí článek do sekce Krátké zprávy, pokud je v kategorii Krátké zprávy
6. Nehledě na výsledky předchozích podmínek, pokud článek spadá i do kategorie dlouhodobě relevantních článků, je zařazen do této sekce.

Pozn.: Kroky 1--5 jsou navrženy tak, aby žádný článek nebyl na stránce vytištěn dvakrát. Bohužel šestý krok toto porušuje, protože mě nenapadá žádný rozumný způsob, jak testovat, jestli daný článek bude či nebude vytišten na stránce (jelikož limity pro tisk na stránku jsou řešeny jinde a nejde je jednoduše řešit v průběhu tohoto cyklu). 

Po tomto roztřídění funkce `main()` vytiskne články do příslušných elementů na stránce. 

### Header

Soubor `header.php` obsahuje referenci na název a popis portálu, na Google Analytics, na faviconu a definuje záhlaví a oblasti pro nabídky.

### Sidebar

Sidebar (postranní sloupec) obsahuje dvě oblasti pro widgety a referenci na `wp_head()`. Sidebar je implementovaný v `sidebar.php`.

### Footer

Soubor `footer.php` obsahuje pouze informace zobrazené v zápatí stránek portálu a referenci na `wp_footer()`.

### History

Archiv článků je implementován pomocí šablony `history.php`. Jde víceméně o vylepšenou verzi widgetu "archive".

### Archivy

Všeobecně stránky, které vypisují větší množství článků, typicky výpisy kategorií, výsledky hledání či archiv pro zvolené období, využívají šablonu `loop.php`, kterou volají. V ní je definováno, jak se články na těchto archivních stránkách vypisují.
