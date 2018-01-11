##Könyvtári Nyilvántartó Rendszer

####Bővebben a programról:
Ezt a programot egy szakdolgozat keretében készítettem. Az indok, amiért ezt a témát választottam, hogy betekintést nyerhessek a web aplikációk készítésébe.

####Miért HMVC?
A HMVC (Hierarchical Model View Controller ) architektúra egy sokkal könnyebb áttekinthetőséget nyújt a CodeIgniter keretrendszer alatt.

A lenti ábra mutatja be ezt legjobban:

![](https://res.cloudinary.com/inviqa-uk/image/upload/v1470132019/mvc-hmvc.png)

Ahogy az a látszik, minden egység külön mappákban tárolódik és ezért könyebben lehet például widgeteket, vagy mások által készített részeket beágyazni. Ezért ezzel az architektúrával könyebb csoportos projektet csinálni, stb...

###Rendszerkövetelmény

<table style="margin-top: 20px;"><thead><tr><th style="text-align:center; height: 50px; padding-left: 20px; padding-right: 20px;">Rendszerkövetelmény</th><th style="text-align:center">Minimum</th><th style="text-align:center">Ajánlott</th></tr></thead><tbody><tr><td style="text-align:center">PHP verzió</td><td style="text-align:center" colspan="2">5.5.12</td></tr><tr><td style="text-align:center">MySQL verzió</td><td style="text-align:center" colspan="2">5.5.46</td></tr><tr><td style="text-align:center">Tárhely</td><td style="text-align:center">20MB</td><td style="text-align:center">1GB</td></tr><tr><td style="text-align:center">Felbontás</td><td style="text-align:center">320x640</td><td style="text-align:center">1280x720</td></tr><tr><td style="text-align:center">Böngésző</td><td style="text-align:center" colspan="2">Google Chrome<br/>Mozilla Firefox<br/>Internet Explorer 11<br/>Microsoft Edge 12</td></tr><tr><td style="text-align:center">Engedély</td><td style="text-align:center" colspan="2">Sütik (Cookie) tárolása<br/>Személyes adat tárolása (felhasználó azonosító)</td></tr></tbody></table>



###Kitűzött célok

A megvalósításnál szerettem volna minél pontosabban visszaadni azt a felületet, amit a valódi könyvtárakban is felhasználnak. Sok könyvtári alkalmazást kipróbáltam és ami közös volt, az az, hogy lehetőleg minden bibliográfiai adatot eltároltak, és hogy többségük képes volt kapcsolódni más könyvtári adatbázisokhoz. A téma kiírásánál meg kikötötték, hogy lehetőleg minden létező dokumentum eltárolható legyen és hogy legyen lehetőség előfoglalásra és hosszabbításra. Kitűzött célom volt, hogy megfeleljek ezeknek az elvárásoknak. 

<h4 style="margin-bottom: 5px;">Készítő:</h4><b>[Major Attila László](mailto:attilamajor1997@gmail.com "Major Attila László")</b>
