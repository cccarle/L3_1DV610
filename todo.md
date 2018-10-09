## TODO 


#1 CodeSmell
* controller
if ($this->view->hasInfo()) {
         $this->view->setSomething($myData);
          $this->view->setMessage("a message");
}


blir : 

* view
public function doFunkyStuff(ModelData $myData) {
if ($this->hasInfo()) {
         $this->setSomething($myData);
          $this->setMessage("a message");
}
}

* controller
$this->view->doFunkyStuff($myData);

#2 Kommunicera bara med användaren genom vyn

Kommunicera bara med användaren genom vyn:
Flytta alla strängar som skall ses av en användare(ex felmeddelanden), alla strängar med HTML, alla anrop av echo, alla setcookie, alla referenser till $_GET, $_POST, $_COOKIES till vyklasser! 

 model kastar undantag av en viss typ, och view fångar olika typer av undantag och avgör felmeddelandet?


#3 Höj abstraktionsnivån i controllers:


Höj abstraktionsnivån i controllers:
Använd inte primitiva datatyper i era controllers. Anropa metoder på hög abstraktionsnivå från era vyer och modeller i controller och passa parametrar och returvärden så att de är objekt av klasser från er model.

Exempelvis:
 `if (isset($_GET["register"])`  blir  `if ($this->navigationView->userWantsToRegister())`


 #4 Undvik strängberoenden som pesten.

Undvik strängberoenden som pesten.

Ett strängberoende har man när man har två platser i koden sammanbundna av en "sträng" ex `$_GET["register"]`  och `<a href='?register'>`.  Detta kommer jag endast tillåta när de två platserna är i samma klass, men även då rekommenderar jag att skapa en `private static $REGISTER_LINK = "register";` i den klassen. Notera att den är private! Sedan kör ni $_GET[self::$REGISTER_LINK] och `<a href='?{self::$REGISTER_LINK]}'>`.
Strängen "register" får nu naturligtvis inte förekomma någon annanstans i era andra klasser.

Behöver man data från ex $_GET[self::$REGISTER_LINK] i någon annan klass får man be om det från den klass som känner till "hemligheten".

Strängberoenden skapar svårförståeliga programkoder där abstraktionerna man gör (metodnamnen, klasserna osv) inte berättar vad som sker inne i metoderna. Vi får lätt sidoeffekter osv....