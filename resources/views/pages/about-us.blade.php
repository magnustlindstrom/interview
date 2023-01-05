@extends('layouts.front')

@section('content')
    <div class="w-2/3 m-auto flex flex-col items-left py-24 gap-y-8">

        <table class="bg-white rounded">
            <thead>
            <tr>
                <th class="text-left p-4">Denna sida innehåller:</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-left">
                    <a href="#profile">Kort om mig</a><br>
                    <a href="#howitallstarted">Bakgrund - Hur började detta projekt?</a><br>
                    <a href="#spacedrepetition">"Repetition är kunskapens moder" - Tidsfördelad repetition (spaced repetition)</a><br>
                    <a href="#themethod">pluggamatte-metoden - Hur fungerar det?</a><br>
                    <a href="#iwanttojoin">Jag är intresserad av att vara med! - Hur gör jag?</a>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <th class="text-centered p-4">Projektet pluggamatte.se</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-left">
                    Projektet <b>pluggamatte.se</b> startade redan hösten 2020 och målet är att ha en färdig prototyp under våren 2023.
                    Här kan du läsa mer om mig, vad målet med projektet är och få se lite exempel på hur den är tänkt att fungera. 
                    Detta har hittills varit ett enmans-projekt men förhoppningen är att involvera alla matematiklärare på gymnasiet 
                    i Sverige som vill vara med när prototypen är färdig och tillsammans påbörja en resa för att
                    försöka skapa något som kan göra matematiklärares vardag lite lättare och framför allt, göra så att ännu
                    fler gymnasieelever lyckas i matematik.
                </td>
            </tr>
            </tbody>
        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <span id="profile"></span>
                <th class="text-right p-4">Kort om mig</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-right">
                    Jag heter Magnus Lindström och bor och arbetar i min hemstad Uppsala.
                    Efter 21 år som gymnasielärare i matematik och programmering så trivs 
                    jag bättre än någonsin med mitt yrke och jag arbetar sedan 2019 på Celsiusskolan i Uppsala.
                </td>
                <td width="50%" class="p-4">
                    <img width="40%" src="/images/Magnus-profilbild.jpg" alt="profile picture">
                </td>
            </tr>
            </tbody>

        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <span id="howitallstarted"></span>
                <th class="text-centered p-4">Bakgrund - Hur började detta projekt?</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-left">
                    <p>Det var under hösten 2019 och jag satt i lärarrummet när några av mina matematikkollegor och en programrektor 
                    pratade om, som jag minns det, en nyhetsartikel som handlade om elevers 
                    resultat på nationella prov. Vi började prata om hur det går för Sveriges 
                    gymnasieelever i matematik och en kollega sa att 51% av alla 
                    elever som hade läst kursen matematik 2b hade fått F på senaste nationella 
                    provet. Alltså, majoriteten av alla elever som går på något av de studieförberedande 
                    programmen Ekonomi, Estetiska eller Samhällsvetskap och som skrev det nationella 
                    provet i kursen matematik 2b som är obligatorisk för dem, fick F!
                    Detta gjorde någonting med mig. Det är svårt att hitta en bra jämförelse 
                    med andra yrken men tänk dig följande: Om 51% av alla patienter som gick 
                    till tandläkaren för att laga ett hål i en tand kommer att få en inflammation 
                    i tanden och måste dra ut den, vad skulle det pratas om inom tandläkarkåren då 
                    och hur skulle alla människor som måste gå till tandläkaren känna sig innan sitt 
                    besök?</p> 
                    <br>
                    <p>
                    Vad har hänt sedan 2019 då? Bland annat har man skrivit om kursplanerna en del i vissa matematikkurser
                    och så har man ändrat lite i de numera så kallade betygskriterierna och styrdokumenten för betygsättning.
                    <br>
                    <br>
                    Här är en (dyster) artikel i Läraren som berättar om hur det gick på de nationella proven i matematik på vårterminen 2022:
                    <br>
                    <br>
                    <a href="https://www.lararen.se/amneslararen-matte-no/nationella-prov/matteresultaten-stortdyker-pa-nationella-proven" target="_blank">
                    <b>KLICKA HÄR FÖR ATT KOMMA TILL ARTIKELN</b></a>
                    <br>
                    <br>
                    </p>
                    <p>Innan jag började på Celsiusskolan hösten 2019 så arbetade jag under en längre period
                    utomlands på internationella skolor i Spanien och Italien så 
                    jag var inte helt uppdaterad på hur (dåligt) det går för eleverna i matematik. 
                    I alla fall om man ska utgå från att F som är underkänt ses som dåligt. 
                    När jag gick gymnasiet så kunde man få en 1:a eller en 2:a och det sågs mera som ett
                    betyg som alla andra, om än av det sämre slaget, så var det ju ändå ett betyg.
                    En annan skillnad mellan nuvarande betygssystem och 1 till 5-betygen är att för många F kan 
                    leda till att man inte får en studentexamen. "På min tid" så gick man ut gymnasiet med ett medelbetyg,
                    t.ex. 3,5 eller 0,8. Ett F ger NOLL meritpoäng, en 1:a gav 1 poäng. Nå väl. Detta är en annan diskussion och ett annat problem.</p>
                    <br>
                    <p>Jag började studera statistiken på Skolverkets hemsida för att 
                    få en klarare bild av hur det går för Sveriges elever i matematikämnet på gymnasiet. 
                    Störst problem hittade jag i a- och b-spåret och kurserna matematik 1a och 
                    matematik 2b som är de sista obligatoriska kurserna för de flesta gymnasieprogrammen.
                    Även om gymnasiet i teorin är frivilligt så har det på senare år i 
                    princip blivit obligatoriskt i praktiken. Jag tycker att det finns en tendens 
                    att vi fokuserar väldigt mycket på de elever som klarar sig sämst men självklart 
                    vill vi ju alla att alla elever ska utvecklas så mycket som möjligt och nå sin fulla 
                    potential. Men det finns goda skäl till att vi fokuserar så mycket på de elever som 
                    får F för om en elev får ett F i betyg på det nationella provet (vars resultat särskilt ska 
                    beaktas på gruppnivå vid sättandet av slutbetygen) eller slutbetyget så får det 
                    mycket större konsekvenser för den enskilda individen än för en elev som blir 
                    godkänd och får minst betyget E. Oavsett om en elev tycker om matematik när hen 
                    kommer till mitt klassrum så vet jag att följande gäller för alla elever: De tycker 
                    att det är mycket roligare om de lyckas än om de misslyckas. Mitt mål för varje 
                    elev är att stärka elevens självförtroende genom att hjälpa dem att lyckas i 
                    matematik, och att lyckas kan ju betyda många olika saker för olika elever.</p>
                    <br>
                    <p>Frågan blir då: ”Kan vi få eleverna att lyckas ännu bättre i matematik?”.
                    Forskningen radar upp en hel del faktorer som är viktiga men frågan jag ställer mig är: 
                    ”Vilka av dessa faktorer skulle jag själv kunna påverka och framför allt, vilka faktorer 
                    skulle få störst genomslag och medföra en faktisk och mätbar förbättring och en större måluppfyllelse 
                    på gruppnivå?”. <b>"Finns det något som vi inte redan har provat eller redan gör?"</b>.
                    <br>
                    <br>
                    <b>Jag vill verkligen understryka att jag är stolt över det jobb som jag och mina matematikkollegor i Sverige 
                    gör varje dag och jag blir påmind om detta dagligen i mitt arbete och på ämnesstudiedagar mm.</b>
                    Min övertygelse är att huvudpersonen i en elevs lärande är eleven själv. Visst hjälper det om
                    allt annat är på plats också: en skola med bra lokaler och utrustning, en kompetent och entusiastisk lärare,
                    ett bra läromedel mm. Men den i särklass viktigaste faktorn kommer alltid att vara eleven själv och där kan 
                    saker som en bra lärare, ett bra läromedel och en bra studieteknik vara det som får eleven på rätt spår.
                    <br>
                    <br>
                    Det finns många faktorer så som lärares arbetsmiljö, 
                    tillräckligt med planerings- och utvärderingstid av lektioner etc. som är saker som 
                    jag själv inte kommer kunna påverka och förbättra. Finns det något som jag skulle kunna 
                    bidra med och som skulle kunna användas av fler matematikkollegor och faktiskt 
                    göra skillnad? Av egen erfarenhet så är det mest kraftfulla verktyget som jag har stött 
                    på, både som student och lärare, <b>tidsfördelad repetition</b> eller ”spaced repetition” på 
                    engelska, som är ett studiesätt där man repeterar kunskap enligt vissa tidsintervaller för att optimera inlärningen och framför 
                    allt för att behålla kunskapen i långtidsminnet. Grunderna till detta studiesätt upptäcktes redan på <b>1890-talet</b> då <b>Hermann Ebbinghaus</b> 
                    upptäckte ”glömskekurvan” eller ”forgetting curve” som det heter på engelska. <b>Tidsfördelad 
                    repetition</b> (spaced repetition), som är en väldigt erkänd metod, har bevisat stor effekt och det finns mängder 
                    med studier på detta. Jag har själv sedan jag i 20-årsåldern upptäckte detta ”fenomen” 
                    av en slump, använt mig av denna studieteknik när jag studerade på musikskolor och lärde 
                    mig att spela gitarr, på universitetet när jag läste matematik och datavetenskapliga 
                    ämnen och när jag lärde mig spanska, italienska och tyska flytande under mina år 
                    arbetandes som lärare utomlands för att nämna några saker.
                    </p>
                    <br>
                    <p>
                        Tidsfördelad repetition har mig veterligen aldrig testats på ett strukturerat
                        och systematiskt sätt inom matematikområdet på en stor grupp. Det är en väl forskad på och 
                        erkänt effektiv studieteknik. Jag vill ta reda på om det går att applicera denna studieteknik
                        inom matematikområdet och i så fall ta reda på vilka eventuella positiva effekter det
                        skulle kunna få på elevers inlärning.
                    </p>
                </td>
            </tr>
            </tbody>
        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <span id="spacedrepetition"></span>
                <th class="text-centered p-4">"Repetition är kunskapens moder" - Tidsfördelad repetition (spaced repetition)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-left">
                    Den vanligaste studietekniken är nog "sista-minuten-plugga precis innan provet"-metoden. Denna teknik
                    är nog vanligast för att de flesta skjuter upp saker tills det inte går längre och då måste 
                    man plugga mycket och intensivt under en kort period.
                    Tidsfördelad repetition är en studieteknik där du studerar innehållet som du försöker lära dig med ökande tidsintervaller.
                    Om du använder dig av denna metod för att plugga inför ett prov så börjar du långt innan provdagen.
                    Några konsekvenser av detta blir att du kommer memorera det som du försöker lära dig på totalt kortare tid 
                    och du kommer att komma ihåg det längre.
                    Några av svårigheterna med denna studieteknik är att den kräver studiedisciplin och du måste
                    administrera de olika delarna du studerar och hålla reda på när det är dags att studera varje enskild del igen. 
                </td>
            </tr>
            </tbody>
        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <th class="text-right p-4">Glömskekurvan (forgetting curve)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-right">
                    Här är ett exempel på Hermann Ebbinhaus glömskekurva.
                    Vi ser hur andelen information som vi kommer ihåg avtar med tiden efter inlärningstillfället.
                    Vi ser också att kurvan går ner som kraftigast direkt efter inlärningstillfället för att sedan avta i lägre takt.
                    Detta är (tyvärr) en av anledningarna till att "plugga-mycket-precis-innan-provet"-metoden är fortsatt populär.
                    Man kommer ju ihåg det mesta direkt efter att man har studerat det.
                </td>
                <td width="50%" class="p-4">
                    <img width="90%" src="https://www.mindtools.com/media/Diagrams/The_Forgetting_Curve_Cropped_FINAL.jpg" alt="picture-forgetting-curve">
                </td>
            </tr>
            </tbody>

        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <th></th>
                <th class="text-left p-4">Tidsfördelad repetition (spaced repetition)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td width="50%">
                    <img width="80%" src="https://www.mindtools.com/media/Diagrams/Using_Spaced_Learning_to_Combat_the_Forgetting_Curve_Cropped_FINAL.jpg" class="float-right" alt="picture-spaced-repetition">
                </td>
                <td class="p-4 text-left">
                    Tidsfördelad repetition går ut på att studera innehållet igen innan du börjar glömma 
                    bort allt för mycket. Som vi ser i grafen så sker det första repetitionstillfället kort 
                    efter det första inlärningstillfället. En intressant sak med glömskekurvan är att den inte
                    faller lika brant efter det andra tillfället och detta mönster fortsätter efter varje repetitionstillfälle.
                    Eftersom vi glömmer i långsammare takt ju fler gånger vi har repeterat så kan vi öka tidsintervallet
                    mellan varje repetitionstillfälle. Efter ett antal repetitioner så kommer vi ihåg det mesta
                    och vi behöver inte repetera det så ofta fortsättningsvis för att "hålla kunskapen vid liv". Kunskapen har nu satt
                    sig på djupet i långtidsminnet. 
                </td>
            </tr>
            </tbody>
        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <span id="themethod"></span>
                <th class="text-centered p-4">pluggamatte-metoden - Hur fungerar det?</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-left">
                När jag väl hade bestämt mig för att göra detta projekt så listade jag de saker som jag absolut ville ha med i mitt digitala läromedel:
                <br>
                <br>
                    &#x2022;&nbsp;Det ska finnas en databas med många bra uppgifter i varje kurs som är uppdelade i olika typuppgifts-kategorier och som man som lärare kan välja bland för att undvika att lägga en massa tid på att skapa lämpliga uppgifter själv. Typuppgifter som är på samma tema är i sin tur sammankopplade i lärsekvenser som förutom själva uppgifterna innehåller ett teoriavsnitt i både text- och videoform.
                    <br>
                    <br>
                    &#x2022;&nbsp;Eftersom läraren har planerat och valt ut lämpliga uppgifter för klassen så håller pluggamatte.se reda på vilka uppgifter varje elev ska göra härnäst, vilka uppgifter hen har gjort och om hen kunde det eller inte. Detta sänker tröskeln för eleven att komma igång och att hålla sig till metoden eftersom man som elev inte behöver planera, uppdatera vad man har gjort eller hålla reda på vad man ska göra härnäst.
                    <br>
                    <br>
                    &#x2022;&nbsp;pluggamatte.se anpassar uppgifternas svårighetsgrad och bestämmer repetitionsintervallerna på individnivå utifrån elevens mål, nuvarande kunskapsnivå och prestation.
                    <br>
                    <br>
                    &#x2022;&nbsp;Den ska ha ett väldigt minimalistiskt gränssnitt för att minimera den kognitiva belastningen och vara lättanvänt både för lärare och elever.
                    <br>
                    <br>
                    &#x2022;&nbsp;Användardata som genereras när elever löser uppgifter används för att hjälpa läraren att veta hur ungefär hur lång tid som eleverna kommer behöva för att göra de utvalda uppgifterna samt att få lämplig statistik på individnivå för att läraren ska kunna följa varje elevs kunskapsutveckling och ge råd om något behövs ändras (höja eller sänka målbetyget, om man behöver plugga mer utöver lektionstid etc.) beroende på hur det går för eleven över tid.                    
                    <br>
                    <br>
                    Jag har en till lång lista med förslag på ytterligare funktionalitet för framtiden.
                    <br>
                    <br>
                    Vad saknar du? Vad skulle underlätta ditt jobb? Vad tycker du fungerar bra med digitala hjälpmedel i din undervisning?
                    Vad fungerar inte bra med existerande digitala hjälpmedel i undervisningen?
                    <br>Skriv gärna till mig och berätta!
                </td>
            </tr>
            <tr>
                <span id="themethod"></span>
                <th class="text-centered p-4">Läraren</th>
            </tr>
            <tr>
                <td class="p-4 text-left">
                Läraren loggar in och kommer till startsidan där man bland annat kan se alla sina elever och alla sina klasser.
                <br>
                <br>
                <img width="100%" src="images/Teacher-dashboard.png" alt="picture-teacher-dashboard">
                <br>
                <br>
                När man går in i en klass så kan man se allmän info om klassen, kursplanen, elevlista och allt tillgängligt innehåll med teori, uppgifter mm. i kursen.
                <br>
                Precis som i en traditionell mattebok som är indelad i kapitel och delkapitel så är allt innehåll strukturerat på ett liknande sätt så att det ska vara lätt att hitta.
                <br>
                Läraren kan titta igenom innehållet och plocka ut lämpliga uppgifter till sin klass. 
                <br>
                <br>
                Vi öppnar delkapitlet "Tallinjen" och finner där en lärsekvens som heter "Tallinjen, heltal och decimaltal"
                <br>
                <br>
                <img width="100%" src="images/Teacher-table-of-content.png" alt="picture-teacher-table-of-content">
                <br>
                <br>
                
                Här ser vi ett exempel på en lärsekvens.
                En lärsekvens har en teoridel, både i textform med bilder och en video som går igenom samma sak.
                <br>
                Den har även uppföljningsfrågor som är kopplade till teorin. Dessa kan man göra för att kontrollera att man har fått med sig de grundläggande begreppen från teorin innan man börjar räkna uppgifter.
                <br>
                <br>
                <img width="100%" src="images/Teacher-learning-sequence.png" alt="picture-teacher-learning-sequence">
                <br>
                <br>
                Sedan så finns det en massa typuppgifter samlade i olika uppgifts-block.
                <br>
                Här ser vi ett exempel på ett uppgifts-block med 25 olika uppgifter som handlar om att hitta på tallinjen.
                <br>
                De 25 uppgifterna är inte identiska men väldigt snarlika och de behandlar ett väldigt specifikt tema.
                <br>
                Varje uppgift har svar, lösningsförslag och en videogenomgång på hur man löser såna här typer att uppgifter.
                <br>
                Vi kan även se att det är en uppgift som ger 1 E-poäng och vi kan se att alla elever som har målbetyg A,B,C,D eller E kommer att göra det här uppgiftsblocket.
                <br>
                Läraren plockar ut detta uppgifts-block till sin klass genom att markera det med radio-knappen.
                <br>
                <br>
                <img width="100%" src="images/Teacher-Exercise-block.png" alt="picture-teacher-exercise-block">

                </td>
            </tr>
            <tr>
                <th class="text-centered p-4">Eleven</th>
            </tr>
            <tr>
                <td class="p-4 text-left">
                Eleven loggar in och här ser vi hur det ser ut när eleven går in i kursen som läraren ovan äger.
                <br>
                Här ser eleven alla delkapitel som läraren har plockat ut för elevens klass. Men denna elev som har målbetyget D ser bara de delkapitel
                och lärsekvenser som en elev som har målbetyget D ska se. Detta innebär att det är uppgifter som ligger på lämplig nivå för att ha chans att nå betyget D, dvs. uppgifterna
                har oftast E-poäng men en del uppgifter har även C-poäng.
                <br>
                Även antalet uppgifter som eleven ska göra för att anses vara klar med en viss typ en uppgift och därmed förstå ett specifikt moment.
                Som vi kan se på höger sida så har eleven öppnat lärsekvensen "Tallinjen, helttal och decimaltal"
                och när man har målbetyget D så ska man göra 5 uppifter från uppgifts-blocket "Hitta på tallinjen" och 5 uppgifter från uppgifts-blocket "Addition och subtraktion med tallinjen".
                <br>
                <br>
                <img width="100%" src="images/Student-Learn.png" alt="picture-student-learn">
                <br>
                <br>
                Vi öppnar uppgifts-blocket "Hitta på tallinjen".
                <br>
                Här ser vi att vi har målbetyget D, ska klara 5 uppgifter för att klara uppgifts-blocket och att det uppskattningsvis kommer ta ungefär 3 minuter att göra 5 uppgifter.
                <br>
                <br>
                <img width="100%" src="images/Learn-start.png" alt="picture-learn-start">
                <br>
                <br>
                Eleven gör en uppgift i taget, matar in svaret och får då tillgång till rätt svar, lösningsförslag och möjlighet att se en video på hur man löser liknande uppgifter.
                <br>
                Om eleven inte vet hur man löser en sån här uppgift så kan man gå direkt till lösningsförslaget och videon men då räknar det som om man inte kunde just denna uppgift.
                <br>
                <br>
                <img width="100%" src="images/Student-Question.png" alt="picture-student-question">
                <br>
                <br>
                Här ser vi ett exempel på att eleven har påbörjat ett uppgifts-block och har klarat 2 av 5 uppgifter.
                <br>
                <br>
                <img width="100%" src="images/Learn-started.png" alt="learn-started">
                <br>
                Här ser vi ett exempel på att eleven har klarat av ett uppgifts-block eftersom hen har klarat 5 av 5 uppgifter.
                <br>
                När ett uppgifts-block är avklarat så läggs det in i "Repeteraren" (Review manager) som är den del
                som håller reda på när du ska repetera en sån här typ av uppgift igen för att inte glömma bort den.
                <br>
                <br>
                <img width="100%" src="images/Learn-finished.png" alt="learn-finished">
                </td>
            </tr>
            <tr>
                <th class="text-centered p-4">Dags att repetera</th>
            </tr>
            <tr>
                <td class="p-4 text-left">
                pluggamatte.se håller reda på när det är dags för dig som elev att repetera och göra en uppgift från 
                ett specifikt uppgifts-block.
                <br>
                När en liten blå prick visas över menyvalet "Review" så vet eleven att det finns uppgifter som hen bör repetera idag.
                <br>
                Repeteraren eller "Review manager" är en ganska sofistikerad algoritm som tar hänsyn till en del olika faktorer för
                att räkna ut vad eleven bör göra härnäst och när det är dags att repetera något igen osv.
                <br>
                Repetitionsalgoritmen kommer beskrivas här i närmare detalj när prototypen till webbplatsen är färdig.
                <br>
                <br>
                <img width="100%" src="images/Dashboard-time-to-review.png" alt="dashboard-time-to-review">
                </td>
            </tr>
            </tbody>
        </table>

        <table class="bg-white rounded">
            <thead>
            <tr>
                <span id="iwanttojoin"></span>
                <th class="text-centered p-4">Jag är intresserad av att vara med! - Hur gör jag?</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="p-4 text-left">
                    <p>
                    Gå till "Kontakt" och skicka ett meddelande till mig genom formuläret.
                    <br>
                    Berätta lite om dig själv, vad det var som gjorde att du blev intresserad av mitt projekt 
                    och om du skulle vilja testa det i din egen undervisning eller kanske till och med bidra på något sätt.
                    <br>
                    <br>
                    Den enda chansen för detta projekt att lyckas är om du och jag gillar webbplatsen.
                    <br>
                    Om vi inte gillar den och den inte underlättar för oss lärare i vardagen och om våra elever
                    inte gynnas av det så kommer vi inte använda den.
                    <br>
                    <br>
                    Jag ser fram emot att höra vad du tycker (bra och dåligt)! :)
                    <br>
                    <br>
                    Med vänlig hälsning
                    <br>
                    <br>
                    Magnus
                    </p>
                </td>
            </tr>
            </tbody>
        </table>


    </div>
@endsection
