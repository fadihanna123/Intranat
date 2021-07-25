## 1. Självständigt arbete

**Adress:**<br />
https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/index.php

## 1.1 Intränatapplikation

Detta är en intränatapplikation som hjälper personal att kommunicera med sina chefer genom att till exempel anmäla sjukanmälan eller ansöka om ledighet. <br>
**Intränatapplikation har 8 funktioner:** <br>
1 - Se de senaste nyheter. <br>
2 - Administrera nyheter, att kunna lägga till/ändra/radera nyheter(för administratörer). <br>
3 - Ladda upp filer(för administratörer) och kunna se dessa filer i en tabell. <br>
4 - Se personalmedlemmar. <br>
5 - Anmäla sjukanmälan och söka om ledighet. <br>
6 - FAQ(frågor och svar) sidan och kunna lägga till frågor(för administratörer).<br>
7 - Ändra medlemsuppgifter, ändra e-post och lösenordet. <br>
8 - Adminpanel där kan man administrera företagets uppgifter, lägga till kategorier och möjlighet att kunna godkänna medlemmar. <br>
**I utloggadläge kan man:**<br>
1 - Se startsidan <br>
2 - Registrera sig i intränatapplikationen. <br>
3 - Logga in i intränatapplikationen. <br>
4 - Återställa lösenordet. <br>
Webbapplikationen är responsivt.<br>
**Den här webbapplikationen består av dessa länkar:** <br>
1 - Startsida<br>
2 - Logga in <br>
3 - Återställa lösenordet. <br>
4 - Registrera sig. <br>
5 - Hem. <br>
6 - Nyheter. <br>
7 - Filarkiv. <br>
8 - Personal. <br>
9 - Anmälan. <br>
10 - FAQ.<br>
11 - Mitt konto. <br>
12 - Adminpanel. <br>

## 1.2 Mappstruktur <br>

CSS/<br>
CSS/main.css<br>
CSS/main.scss<br>
Images/<br>
Images/Admin/<br>
Images/Admin/admin_header_logo.png<br>
Images/Favicon/<br>
Images/Favicon/android-chrome-192x192.png<br>
Images/Favicon/android-chrome-512x512.png<br>
Images/Favicon/apple-touch-icon.png<br>
Images/Favicon/browserconfig.xml<br>
Images/Favicon/favicon.ico<br>
Images/Favicon/favicon-16x16.png<br>
Images/Favicon/favicon-32x32.png<br>
Images/Favicon/mstile-150x150.png<br>
Images/Favicon/site.webmanifest<br>
Images/Ikoner/login.png<br>
Images/Ikoner/register.png<br>
Images/Users/<br>
Images/Users/default_man.png<br>
Images/Users/default_woman.gif<br>
Includes/<br>
Includes/Classes/<br>
Includes/Classes/Functions.class.php<br>
Includes/config.php<br>
Includes/header.php<br>
Includes/footer.php<br>
Js/<br>
Js/main.js<br>
activate.php<br>
activateemail.php<br>
doforgetpsw.php<br>
forgetpsw.php<br>
index.php<br>
login.php<br>
register.php<br>
intranet_2020.sql<br>

**Dashboard**:<br>
CSS/ <br>
CSS/main.css<br>
CSS/main.scss<br>
ckeditor5/<br />
Images/<br>
Images/Admin/<br>
Images/Admin/admin_header_logo.png<br>
Images/Favicon/<br>
Images/Favicon/android-chrome-192x192.png<br>
Images/Favicon/android-chrome-512x512.png<br>
Images/Favicon/apple-touch-icon.png<br>
Images/Favicon/browserconfig.xml<br>
Images/Favicon/favicon.ico<br>
Images/Favicon/favicon-16x16.png<br>
Images/Favicon/favicon-32x32.png<br>
Images/Favicon/mstile-150x150.png<br>
Images/Favicon/site.webmanifest<br>
Images/Ikoner/<br>
Images/Ikoner/add-1.png<br>
Images/Ikoner/admin.png<br>
Images/Ikoner/arkiv.png<br>
Images/Ikoner/confirm.png<br>
Images/Ikoner/download.png<br>
Images/Ikoner/help.png<br>
Images/Ikoner/house.png<br>
Images/Ikoner/lock.png<br>
Images/Ikoner/mail.png<br>
Images/Ikoner/news.png<br>
Images/Ikoner/register.png<br>
Images/Ikoner/settings.png<br>
Images/Ikoner/settings-1.png<br>
Images/Ikoner/staff.png<br>
Images/Ikoner/upload.png<br>
Images/News/<br>
Images/Users/<br>
Images/Users/default_man.png<br>
Images/Users/default_woman.gif<br>
Includes/<br>
Includes/Classes/<br>
Includes/Classes/Dashboard.class.php<br>
Includes/config.php<br>
Includes/header.php<br>
Includes/footer.php<br>
Includes/nav.php<br>
Js/<br>
Js/main.js<br>
accountsettings.php<br>
activateemail.php<br>
addnews.php<br>
admin.php<br>
deletenews.php<br>
download.php<br>
editnews.php<br>
FAQ.php<br>
filarkiv.php<br>
index.php<br>
logout.php<br>
news.php<br>
report.php<br>
showpost.php<br>
staff.php<br>

## 1.3 Installation <br>

Du kan ladda ner alla dessa filer och installera källkodsfiler i din lokala server eller egen hemsida. <br>
Du behöver ändra SQL uppgifter från din localhost till din egen i dessa filer:<br>
Includes/config.php rad 13, 14, 15 och 16.<br>
Dashboard/Includes/config.php rad 14, 15, 16 och 17.<br>
Du kan använda intranet_2020.sql filen för att kunna skapa tabeller.<br>
Manuellt:
Du behöver skapa dessa tabeller:<br>
users för att visa alla personalmedlemmar.<br>
admininfo för att visa och ändra företagets uppgifter.<br>
arkiv för att visa filarkiv.<br>
news_db för att visa nyheter.<br>
FAQ för att visa frågor och svar.<br>
password_reset för att lagra lösenordsåterställningsförfrågor.<br>
leaveregister för att lagra ledighetsansökningar.<br>
sickregister för att lagra sjukanmälningar.<br>
arkiv_categories för att visa filarkivketegorier.<br>
news_categories för att visa nyheterskategorier.<br>
Du behöver skapa dessa kolumner i dessa tabeller :<br>
**users**:<br>
`id` int(11) NOT NULL,<br>
`fname` text NOT NULL,<br>
`lname` text NOT NULL,<br>
`username` text NOT NULL,<br>
`fullname` text NOT NULL,<br>
`email` text NOT NULL,<br>
`psw` text NOT NULL,<br>
`work_title` text NOT NULL,<br>
`address_street` text NOT NULL,<br>
`address_box` text NOT NULL,<br>
`address_city` text NOT NULL,<br>
`mobnr` text NOT NULL,<br>
`tfnr` text NOT NULL,<br>
`avatar` text NOT NULL,<br>
`active` int(11) NOT NULL,<br>
`bornday` text NOT NULL,<br>
`bornmonth` text NOT NULL,<br>
`bornyear` text NOT NULL,<br>
`sex` text NOT NULL,<br>
`lastlogin` text NOT NULL,<br>
`register_date` text NOT NULL,<br>
`register_tokenkey` text NOT NULL,<br>
`register_tokenexpiretime` text NOT NULL,<br>
`email_tokenkey` text NOT NULL,<br>
`email_expiretime` text NOT NULL,<br>
`adminapprove` int(11) NOT NULL,<br>
`adminmange` int(11) NOT NULL<br>
**admininfo**:<br>
`id` int(11) NOT NULL,<br>
`companyname` text NOT NULL,<br>
`avatar` text NOT NULL,<br>
`orgnr` text NOT NULL,<br>
`invoiceinfo` text NOT NULL,<br>
`address_street` text NOT NULL,<br>
`address_box` text NOT NULL,<br>
`address_city` text NOT NULL,<br>
`visit_address` text NOT NULL,<br>
`firstcolor` text NOT NULL,<br>
`secondcolor` text NOT NULL<br>
**arkiv**:<br>
`id` int(11) NOT NULL,<br>
`file_name` text NOT NULL,<br>
`category` text NOT NULL,<br>
`descr` text NOT NULL,<br>
`the_file` text NOT NULL,<br>
`filesize` int(11) NOT NULL,<br>
`insert_date` text NOT NULL<br>
**arkiv_categories**:<br>
`id` int(11) NOT NULL,<br>
`cat_name` text NOT NULL<br>
**FAQ**:<br>
`id` int(11) NOT NULL,<br>
`question` text NOT NULL,<br>
`answer` text NOT NULL<br>
**leaveregister**:<br>
`id` int(11) NOT NULL,<br>
`reason` text NOT NULL,<br>
`from_date` text NOT NULL,<br>
`to_date` text NOT NULL,<br>
`fullname` text NOT NULL<br>
**news_categories**:<br>
`id` int(11) NOT NULL,<br>
`category_name` text NOT NULL<br>
**news_db**:<br>
`id` int(11) NOT NULL,<br>
`title` text NOT NULL,<br>
`content` text NOT NULL,<br>
`author` text NOT NULL,<br>
`img` text NOT NULL,<br>
`insert_date` text NOT NULL,<br>
`category` text NOT NULL<br>
**password_reset**:<br>
`id` int(11) NOT NULL,<br>
`userid` int(11) NOT NULL,<br>
`token` text NOT NULL,<br>
`tokenexpiretime` text NOT NULL<br>
**sickregister**:<br>
`id` int(11) NOT NULL,<br>
`reason` text NOT NULL,<br>
`from_date` text NOT NULL,<br>
`to_date` text NOT NULL,<br>
`fullname` text NOT NULL<br>

## 1.4 Programmeringsspråk som används i projektet: <br>

HTML, CSS/SASS, Objektorienterad PHP, Typescript och Javascript. <br>

## 1.5 Ramverk: <br>

Bootstrap <br>

## 1.6 Skärmdump av Intränatapplikation <br>

![alt text](https://github.com/fadihanna123/Intranat/blob/master/screenshot.png "Screenshot av hemsidan")
