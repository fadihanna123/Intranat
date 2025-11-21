<?php

class Dashboard
{
    protected $db;
    // Tillämpa inställningar för anslutning till databasen.
    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USRNAME, DB_PSW);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Om det finns eventuella fel att ansluta till databasen.
            die("Anslutning misslyckades: " . $e->getMessage());
        } // Slut om det finns eventuella fel att ansluta till databasen.
    }

    // getCompanyName hämtar Företagets namn från databasen.
    public function getCompanyName()
    {
        $sql = "SELECT * FROM admininfo";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        $getdata = $result->fetch();
        if (!$getdata || $getdata['companyname'] == "") {
            // Om företagets namn saknas i databasen.
            return "Gssons El AB";
        }
        // Slut om företagets namn saknas i databasen.
        else {
            // Om företagets namn hittades i databasen.
            return $getdata['companyname'];
        } // Slut om företagets namn hittades i databasen.
    }

    // AcceptStaff godkänner de nya medlemmar i företaget.
    public function AcceptStaff($getid)
    {
        $sql = "SELECT * FROM users WHERE id=$getid AND adminapprove=0;";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getemail = $getdata['email'];
        $num = $result->rowCount();
        
        if ($num == 1) {
            // Om det finns sådan användare i databasen.
            $sql2 = "UPDATE users SET adminapprove=1 WHERE id=$getid;";
            $result2 = $this->db->query($sql2);
            if ($result2) {
                // Om uppdatering lyckades.
                echo "<div class='alert alert-success w-100'>
                    Medlemmen är godkänd nu.
                </div>";

                $to = $getemail;
                $subject = "Administratören godkände din registrering";
                $message = "
                Din administratör godkände din registrering. <br /><br />
                Nu kan du logga in.<br /><br />
                <a href='https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/login.php'>Klicka här för att logga in</a>";
                $headers = "From: admin@gssonselab.com";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .=
                    'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                mail($to, $subject, $message, $headers);
            }
            // Slut om uppdatering lyckades.
            else {
                // Om uppdatering inte lyckades av någon anledning.
                echo $this->db->errorInfo();
            } // Slut om uppdatering inte lyckades av någon anledning.
        }
        // Slut om det finns sådan användare i databasen.
        else {
            // Om det inte finns sådan användare i databasen.
            echo "<div class='alert alert-danger w-100'>
              Det finns inte sådan medlem i databasen eller medlemmen är redan godkänd.
            </div>";
        } // Slut om inte det finns sådan användare i databasen.
    }

    // GetApproveList hämtar de medlemmar som väntar godkännande av administratör.
    public function GetApproveList()
    {
        $sql = "SELECT * FROM users WHERE adminapprove=0;";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        if ($num > 0) {
            // Om det finns användare som inte blev godkänd än.
            echo "
      <div class='row'>
        <div class='card-deck w-100'>";
            while ($getdata = $result->fetch()) {
                $getid = $getdata['id'];
                $getfname = $getdata['fname'];
                $getlname = $getdata['lname'];
                $getepost = $getdata['email'];
                $getmobnr = $getdata['mobnr'];
                $gettfnr = $getdata['tfnr'];
                $getwork = $getdata['work_title'];
                $getbornday = $getdata['bornday'];
                $getbornmonth = $getdata['bornmonth'];
                $getbornyear = $getdata['bornyear'];
                $getsex = $getdata['sex'];
                $getavatar = $getdata['avatar'];
                $getbornday = $getdata['bornday'];
                $getbornmonth = $getdata['bornmonth'];
                $getbornyear = $getdata['bornyear'];
                $getsex = $getdata['sex'];
                $getavatar = $getdata['avatar'];
                echo "
        <div class='col-sm-6 col-md-6 col-lg-6 col-xl-6'>
          <div class='card h-100 w-100'>
            <img src='$getavatar' loading='lazy' class='img-fluid card-img-top cardimage' alt='$getfname profilbild' /><br />
                    <div class='card-body'>
                      <p class='card-text'>
                        <b>Fullständigt namn: </b>
                            $getfname $getlname<br />
                        <b>E-postadress: </b> 
                            <a href='mailto:$getepost'>
                              $getepost 
                              </a>
                        <br />
                        <b>Mobilnummer: </b>
                            <a href='tel:$getmobnr'>
                              $getmobnr
                            </a><br />
                        <b>Telefonnummer: </b>
                            <a href='tel:$gettfnr'>
                              $gettfnr
                            </a><br />
                        <b>Yrkestitel: </b> 
                          $getwork <br />
                        <b>Födelsedatum: </b> 
                          $getbornday-$getbornmonth-$getbornyear<br />
                        <b>Kön: </b> $getsex<br />
                      </p>
                        <form action='admin.php' class='p-2' method='post'>
                          <input type='hidden' name='getid' value='$getid' />
                          <input name='adminapprovebtn' value='Godkänna' class='btn btn-primary w-100 btn-lg ' type='submit' />
                        </form>
                      </div>
                    </div>
                  </div>
              ";
            }
            echo "</div></div></div>";
        }
        // Slut om det finns användare som inte blev godkänd än.
        else {
            // Om det saknas användare som inte blev godkänd än.
            echo "
        <span class='ms-4'>
            Det finns inga nya medlemmar som väntar godkännande.
        </span>";
        } // Slut om det saknas användare som inte blev godkänd än.
    }

    // UpdatePsw ändrar användarens lösenord.
    public function UpdatePsw($newpsw)
    {
        if(!$newpsw) {
          // Om lösenordet saknas.
          echo "<div class='alert alert-danger'>
                    Lösenordet saknas. Var vänlig fylla in det.
                </div>";
          exit(0);
        } // Slut om lösenordet saknas.

        $md5psw = md5(password_hash($newpsw, PASSWORD_DEFAULT));
        $sql = "UPDATE users SET psw='$md5psw' WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        if ($result) {
            // Om uppdateringen av lösenordet lyckades.
            echo "<div class='alert alert-success'>
                  Lösenord har ändrat. <br />
                  Nu kan du logga in med det nya lösenordet.
              </div>";
        }
        // Slut om uppdateringen av lösenordet lyckades.
        else {
            // Om uppdateringen av lösenordet inte lyckades.
            $this->db->errorInfo();
        } // Slut om uppdateringen av lösenordet inte lyckades.
    }

    // SendEmailActiviate skickar e-postverifiering till användaren.
    public function SendEmailActivate($newepost)
    {
        if(!$newepost) {
          // Om e-postadressen saknas.
          echo "<div class='alert alert-danger'>
                    E-postadressen saknas. Var vänlig fylla in det.
                </div>";
          exit(0);
        } // Slut om e-postadressen saknas.
        
        date_default_timezone_set("Europe/Stockholm");
        $token_key = md5(time() . $newepost);
        $expformat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $exp = date("Y-m-d H:i:s", $expformat);
        $sql = "SELECT * FROM users WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        $row = $result->fetch();
        $getuserid = $row['id'];
        $getoldemail = $row['email'];
        $sql2 = "UPDATE users SET email_tokenkey='$token_key', email_expiretime='$exp';";
        $result2 = $this->db->query($sql2);
        if ($result2) {
            // Om e-postaktiveringförfrågan blev lagrad i databasen.
            $to = $newepost;
            $subject = "Verifiera e-postadress";
            $message = "Verifiera e-postadress.<br /><br />
        Du begärde att ändra din e-postadress.<br />
        Klicka på länken nedan för att verifiera.<br />
        <a href='https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/activateemail.php?key=$token_key&uid=$getuserid&epost=$newepost'>https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/activateemail.php?key=$token_key&uid=$getuserid&epost=$newepost</a>
        <br /><br />Observera att denna länk är giltig i bara 24 timmar.
  ";
            $headers = "From: admin@gssonselab.com";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $sendmail = mail($to, $subject, $message, $headers);
            if ($sendmail) {
                // Om e-postaktiveringsmejl har skickat.
                echo "<div class='alert alert-success'>
                      Vi har skickat ett mejl som verifierar den nya e-postadressen.<br />
                      Kontrollera att du har fått mejlet i den nya e-postadressen.
                    </div>";
            }
            // Slut om e-postaktiveringsmejl har skickat.
            else {
                // Om e-postaktiveringsmejl inte har skickat.
                echo "<div class='alert alert-danger'>
                  Det finns ett okänt fel. <br />
                  Kontakta din administratör för mer information.
                </div>";
            } // Slut om e-postaktiveringsmejl inte har skickat.
        }
        // Slut om e-postaktiveringförfrågan blev lagrad i databasen.
        else {
            // Om e-postaktiveringförfrågan inte blev lagrad i databasen.
            echo "<div class='alert alert-danger'>
                    Det finns ett okänt fel. <br />
                    Kontakta din administratör för mer information.
                </div>";
        } // Slut om e-postaktiveringförfrågan inte blev lagrad i databasen.
    }

    // getLogoImg hämtar logotypen från databasen.
    public function getLogoImg()
    {
        $sql = "SELECT * FROM admininfo";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        $getdata = $result->fetch();
        if (!$getdata || $getdata['avatar'] == "") {
            // Om bilden saknas i databasen.
            return "./Images/Admin/admin_header_logo.png";
        }
        // Slut om bilden saknas i databasen.
        else {
            // Om bilden hittades i databasen.
            return "./" . $getdata['avatar'];
        } // Slut om bilden hittades i databasen.
    }

    // getFullNamesfunktionen hämtar det fullständigt namnet från databasen.
    public function getFullName($usrname)
    {
        $sql = "SELECT * FROM users WHERE username='$usrname';";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        return $getfullname = $getdata['fullname'];
    }

    // getNewsfunktionen hämtar alla nyheter från databasen.
    public function getNewsHome()
    {
        $sql = "SELECT * FROM news_db LIMIT 6";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        
        if ($num > 0) {
            // Om det finns nyheter i databasen.
            echo "
        <div class='row'>
          <div class='card-deck ms-1 w-100'>";
            while ($getdata = $result->fetch()) {
                $id =  $getdata['id'];
                $bild = $getdata['img'];
                $title = $getdata['title'];
                $content = $getdata['content'];
                // Nyhetsinnehåll i ett kort.
                echo " 
          <div class='col-sm-6 col-md-4 col-lg-2 col-xl-4 cardparent'>
              <div class='card p-2 h-100 mycard'>
                <img src='$bild' loading='lazy' alt='$title' class='card-img-top img-fluid w-100 h-100 cardimage' />
                  <div class='card-body'>
                      <h4 class='card-title'>$title</h4>";
                $addlink = "...<a href='showpost.php?id=$id' style='font-size: 22px;'>Läs mer > </a>";
                $addlinkwithout = "<br /> <p class='card-text'><a href='showpost.php?id=$id' class='card-link' style='font-size: 22px;'>Läs mer > </a>";

                if (strlen($content) >= 70) {
                    // Om teckenlängd för innehållet är längre än 70 tecken.

                    $cutstring = substr($content, 0, 70);
                    $slutpunkt = strrpos($cutstring, ' ');

                    $content = $slutpunkt
                        ? substr($cutstring, 0, $slutpunkt)
                        : substr($cutstring, 0);
                    echo "  <p class='card-text'>
                      $content<br />
                      $addlink
                    </p>";
                }
                // Slut om teckenlängd för innehållet är längre än 70 tecken.
                else {
                    // Om teckenlängd för innehållet var mindre än 70 tecken.
                    echo "$content$addlinkwithout</p>";
                } // Slut om teckenlängd för innehållet var mindre än 70 tecken.

                echo "</div></div></div>";
            }
        }
        // Slut om det finns nyheter i databasen.
        else {
            // Om det saknas nyheter i databasen.
            echo "<div class='alert alert-danger ms-3'>
                  Det finns inga nyheter just nu.
                </div>";
        } // Slut om det saknas nyheter i databasen.
    }

    // UpdateAdminSettings uppdaterar administratötensinställningar.
    public function UpdateAdminSettings(
        $editcompanyname,
        $bild,
        $editorgnr,
        $editinvoiceinfo,
        $editaddressstreet,
        $editaddressbox,
        $editaddresscity,
        $editvisitaddress,
        $editfirstcolor,
        $editsecondcolor
    ) {
        $sql = "SELECT * FROM admininfo";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getimg = $getdata['avatar'];
        $sql2 = "UPDATE admininfo SET companyname='$editcompanyname', orgnr='$editorgnr', invoiceinfo='$editinvoiceinfo', address_street='$editaddressstreet', address_box='$editaddressbox', address_city='$editaddresscity', visit_address='$editvisitaddress', firstcolor='$editfirstcolor', secondcolor='$editsecondcolor'";
        
        if ($bild == $getimg || $bild == "") {
            // Om bilden som skickades från användaren är lika som nuvarande bild i databasen.
            $endimg = $getimg;
        }
        // Slut om bilden som skickades från användaren är lika som nuvarande bild i databasen.
        else {
            // Om bilden som skickades från användaren är inte lika som nuvarande bild i databasen.
            $endimg = $bild;
        } // Slut om bilden som skickades från användaren är intelika som nuvarande bild i databasen.
        
        $sql2 .= ", avatar='$endimg' WHERE id=1;";
        $result2 = $this->db->query($sql2);
        
        if ($result2) {
            // Om uppdateringen av data lyckades.
            header("Refresh: 3");
            echo "<div class='alert alert-success ms-3'>
                  Dina ändringar har sparats.
              </div>";
        }
        // Slut om uppdateringen av data lyckades.
        else {
            // Om uppdateringen av data misslyckades.
            echo "<div class='alert alert-danger ms-3'>
                  Det uppstod ett okänt fel. Kontakta administratören.
              </div>";
        } // Slut om uppdateringen av data misslyckades.
    }

    // UpdateAccountSettings uppdaterar kontoinställningar.
    public function UpdateAccountSettings(
        $editusername,
        $editfullname,
        $editaddressstreet,
        $editaddressbox,
        $editaddresscity,
        $editmobnr,
        $edittfnr,
        $bild
    ) {
        $sql = "SELECT * FROM users WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getimg = $getdata['avatar'];
        $getadminmange = $getdata['adminmange'];
        $sql2 = "UPDATE users SET username='$editusername', fullname='$editfullname', address_street='$editaddressstreet', address_box='$editaddressbox', address_city='$editaddresscity', mobnr='$editmobnr', tfnr='$edittfnr'";
        
        if ($bild == $getimg || $bild == "") {
            // Om profilbilden är lika som nuvarande bild eller profilbilden som skickades saknar värde.
            $endimg = $getimg;
        }
        // Slut om profilbilden är lika som nuvarande bild eller profilbilden som skickades saknar värde.
        else {
            // Om profilbilden är inte lika som nuvarande bild.
            $endimg = $bild;
        }
        
        $sql2 .= ", avatar='$endimg' WHERE username='$_SESSION[loginuname]';";
        $result2 = $this->db->query($sql2);
        
        if ($result2) {
            // Om uppdateringen av data lyckades.
            echo "<div class='alert alert-success ms-3'>
                  Dina ändringar har sparats.
              </div>";
        }
        // Slut om uppdateringen av data lyckades.
        else {
            // Om uppdateringen av data misslyckades.
            echo "<div class='alert alert-danger ms-3'>
                  Det uppstod ett okänt fel. Kontakta administratören.
              </div>";
        } // Slut om uppdateringen av data misslyckades.
    }

    // GetAdminForm hämtar administratörsinformation till adminssida formulär.
    public function GetAdminForm()
    {
        $sql = "SELECT * FROM admininfo WHERE id=1;";
        $result = $this->db->query($sql);
        
        while ($getdata = $result->fetch()) {
            $getavatar = $getdata['avatar'];
            $getaddress_street = $getdata['address_street'];
            $getaddress_box = $getdata['address_box'];
            $getaddress_city = $getdata['address_city'];
            $getorgnr = $getdata['orgnr'];
            $getvisitaddress = $getdata['visit_address'];
            $getcompanyname = $getdata['companyname'];
            $getinvoiceinfo = $getdata['invoiceinfo'];
            $getfirstcolor = $getdata['firstcolor'];
            $getsecondcolor = $getdata['secondcolor'];

            // Administratörsformulär
            $getinvoiceinfo = $getdata['invoiceinfo'];
            $getfirstcolor = $getdata['firstcolor'];
            $getsecondcolor = $getdata['secondcolor'];

            // Administratörsformulär
            echo "
              <form action='admin.php' class='form-horizontal' method='post' enctype='multipart/form-data'>
            
                <div class='row'>
                      <label class='form-label col-sm-2' for='editcompanyname'>Företagets namn:</label>
                      <div class='col-sm-10'>
                          <input type='text' value='$getcompanyname' class='form-control' name='editcompanyname' id='editcompanyname' />
                      </div>

                </div>

              <div class='row'>
                      <label class='form-label col-sm-2' for='editimglogo'>Logotyp:</label>
                      <div class='col-sm-5'>
                          <input type='file' accept='image/*' class='form-control' name='editimglogo' id='editimglogo' />
                      </div>
              <br /><br /><br />
              <div id='editimg' class='col-sm-2'>Nuvarande logotyp:</div>
                  <div class='col-sm-3'>
                    <img src='$getavatar' loading='lazy' class='img-fluid thumb' alt='Logotypen' /><br /><br />
                  </div>
              </div>
              
              <div class='row'>
                  <label for='editaddressstreet' class='form-label col-sm-2'>Gata:</label>
                  <div class='col-sm-5'>
                      <input type='text' value='$getaddress_street' class='form-control mb-2' name='editaddressstreet' id='editaddressstreet' />
              </div>

              <label for='editaddressbox' class='form-label col-sm-2'>Postnummer:</label>
                  <div class='col-sm-3'>
                        <input type='text' value='$getaddress_box' class='form-control mb-2' name='editaddressbox' id='editaddressbox' />
                  </div>

              </div>

            <div class='row'>
                  <label for='editaddresscity' class='form-label col-sm-2'>Stad:</label>
                  <div class='col-sm-5'>
                        <input type='text' value='$getaddress_city' class='form-control mb-2' name='editaddresscity' id='editaddresscity' />
                  </div>

            <label for='editorgnr' class='form-label col-sm-2'>Orgnr:</label>
                    <div class='col-sm-3'>
                        <input type='text' value='$getorgnr' class='form-control mb-2' name='editorgnr' id='editorgnr' />
                    </div>
              </div>


            <div class='row'>
                <label for='editinvoiceinfo' class='form-label col-sm-2'>Fakturainfo:</label>
                  <div class='col-sm-10'>
                    <textarea class='form-control' name='editinvoiceinfo' id='editinvoiceinfo'>$getinvoiceinfo</textarea>
                  </div>
            </div>
            <div class='row'>
                    <label for='editvisitaddress' class='form-label col-sm-2'>Besöksadress:</label>
                    <div class='col-sm-10'>
                      <input type='text' value='$getvisitaddress' class='form-control mt-1 mb-2' name='editvisitaddress' id='editvisitaddress' />
                    </div>
            </div>
        <div class='row'>
                <label for='editfirstcolor' class='form-label col-sm-2'>Primär färg:</label>
                <div class='col-sm-5'>
                  <input type='color' value='$getfirstcolor' class='form-control mb-2' name='editfirstcolor' id='editfirstcolor' />
                </div>

        <label for='editsecondcolor' class='form-label col-sm-2'>Sekundär färg:</label>
                  <div class='col-sm-3'>
                    <input type='color' value='$getsecondcolor' class='form-control mb-2' name='editsecondcolor' id='editsecondcolor' />
                  </div>
        </div>

                
          <div class='row'>
                  <div class='mx-auto'>
                    <input class='btn btn-primary ms-1 btn-lg mb-3' name='editadmininfobtn' id='editadmininfobtn' type='submit' value='Uppdatera' />
                  </div>
          </div>
              </form>
              </div>";
        }
    }

    // GetEmailSettingsForm hämtar e-postadressinställningarsformulär.
    public function GetEmailSettingsForm()
    {
        $sql = "SELECT * FROM users WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        
        echo "
            
            <img src='Images/Ikoner/mail.png' loading='lazy' class='img-fluid emailicon' alt='Ändra e-postinställningar' />
            <h2 class='rubrik specrubriktxt'>E-postadressinställningar</h2>
              <p class='specrubriktxt'>
                Här kan du ändra din e-postadress.
              </p>
              <form action='accountsettings.php' class='needs-validation' novalidate method='post'>
              ";
        
        while ($getdata = $result->fetch()) {
            $getepost = $getdata['email'];
            // E-postadressändringsformulär.
            echo "<div class='row'>
                    <label for='currentepost' class='form-label col-sm-4 ms-2 mt-3'>Nuvarande e-postadress:</label>
                      <div class='col-sm-5'>
                        <input value='$getepost' id='currentepost' type='text' class='form-control ms-1 mb-1' disabled />
                    </div>
                  </div>
            
                <div class='row'>
                    <label for='editepost' class='form-label col-sm-4 ms-2 mt-3'>Ny e-postadress:*</label>
                      <div class='col-sm-5'>
                        <input type='text' name='editepost' class='editepost ms-1 mt-1 form-control' id='editepost' required />
                      </div>
                </div>
              <br />
              <div class='row'>
                  <label for='editconfirmepost' class='form-label ms-2 col-sm-4 mt-3'>Bekräfta e-postadress:*</label>
                    <div class='col-sm-5'>
                      <input type='text' class='form-control ms-1 mb-2' name='editconfirmepost' id='editconfirmepost' required />
                    </div>
              </div>

              <br />
              <div class='row'>
                <div class='mx-auto col-md-5'>
                  <input class='btn btn-primary ms-4 btn-lg' name='editepostbtn' id='editepostbtn' type='submit' value='Ändra' />
                </div>
              </div>
            ";
        }
        echo "</form>";
    }

    // AddFAQ lägger till frågor och svar i FAQ sidan.
    public function AddFAQ($addquestion, $addanswer)
    {
        if(!$addquestion || !$addanswer) {
          // Om något saknas.
          echo "<div class='alert alert-danger'>
                    Vissa fälten är tomma. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om något saknas.

        $sql = "INSERT INTO FAQ(id, question, answer) VALUES('', '$addquestion', '$addanswer');";
        $result = $this->db->query($sql);
        
        if ($result) {
            // Om frågan lades till i databasen.
            echo "<div class='alert alert-success'>
                  Frågan har skapat.
              </div>";
        }
        // Om frågan lades till i databasen.
        else {
            // Om frågan inte lades till i databasen av någon anledning.
            echo $this->db->errorInfo();
        } // Slut om frågan inte lades till i databasen av någon anledning.
    }

    // GetArkivCategories hämtar arkivkategorier till select list i filarkiv sidan.
    public function GetArkivCategories()
    {
        $sql = "SELECT * FROM arkiv_categories";
        $result = $this->db->query($sql);
        
        while ($getdata = $result->fetch()) {
            $getcat = $getdata['cat_name'];
            echo "<option>$getcat</option>";
        }
    }

    // GetFAQ hämtar alla frågor och svar i FAQ sidan.
    public function GetFAQ()
    {
        $sql = "SELECT * FROM FAQ";
        $result = $this->db->query($sql);
        
        echo '
      <img src="Images/Ikoner/help.png" loading="lazy" class="img-fluid FAQicon" alt="Hjälp ikon" />
        <h1 class="ms-5">FAQ</h1>
          <ul class="list-group">';
        $num = $result->rowCount();
        
        if ($num > 0) {
            // Om det finns frågor i databasen.

            while ($getdata = $result->fetch()) {
                $getquestion = $getdata['question'];
                $getanswer = $getdata['answer'];

                echo "
                    <li class='list-group-item'>
                          <h2>$getquestion</h2>
                    </li>

                    <li class='list-group-item'>
                          $getanswer
                    </li>

                    ";
            }

            echo "
      </ul>
      </div>
      </div>
    </div>";
        }
        // Slut om det finns frågor i databasen.
        else {
            echo "<div class='alert alert-danger'>
                  Det finns inga frågor just nu.
              </div>";
        }
    }
    
    // GetAccountSettingsForm hämtar mitt konto inställningar till Mitt konto formulär.
    public function GetAccountSettingsForm()
    {
        $sql = "SELECT * FROM users WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        echo '
      <img src="Images/Ikoner/settings-1.png" loading="lazy" class="img-fluid accountsettingsicon" alt="Inställningarsikon" />
        <h2 class="rubrik specrubriktxt">Mitt konto</h2>
          <p class="specrubriktxt">
            Här kan du ändra dina kontouppgifter.
          </p>
          ';
        
        while ($getdata = $result->fetch()) {
            $getusername = $getdata['username'];
            $getfullname = $getdata['fullname'];
            $getemail = $getdata['email'];
            $getaddressstreet = $getdata['address_street'];
            $getaddressbox = $getdata['address_box'];
            $getaddresscity = $getdata['address_city'];
            $getmobnr = $getdata['mobnr'];
            $gettfnr = $getdata['tfnr'];
            $getavatar = $getdata['avatar'];
            // Kontoinställningsformulär.
            echo "
              <form action='accountsettings.php' class='form-horizontal needs-validation' novalidate method='post' enctype='multipart/form-data'>
                <div class='row'>
                      <label class='form-label col-sm-2' for='editusername'>Användarnamn:</label>
                      <div class='col-sm-5'>
                          <input type='text' value='$getusername' class='form-control' name='editusername' id='editusername' />
                      </div>

                      <label for='editfullname' class='form-label col-sm-2'>Fullständigt namn:</label>
                        <div class='col-sm-3'>
                          <input type='text' value='$getfullname' class='form-control mb-2' name='editfullname' id='editfullname' />
                        </div>
                </div>
 
 
                    <div class='row'>
                            <label class='form-label col-sm-2' for='editavatar'>Profilbild:</label>
                            <div class='col-sm-5'>
                                <input type='file' accept='image/*' class='form-control' name='editavatar' id='editavatar' />
                            </div>
                      <br /><br /><br />
                        <div class='col-sm-2'>Nuvarande profilbild:</div>
                          <div class='col-sm-3'>
                          <img src='$getavatar' loading='lazy' class='img-fluid thumb' alt='Profilbild' /><br /><br />
                        </div>
                      </div>
               
                    <div class='row'>
                          <label for='editaddressstreet' class='form-label col-sm-2'>Gata:</label>
                          <div class='col-sm-5'>
                              <input type='text' value='$getaddressstreet' class='form-control mb-2' name='editaddressstreet' id='editaddressstreet' />
                          </div>
        
                          <label for='editaddressbox' class='form-label col-sm-2'>Postnummer:</label>
                          <div class='col-sm-3'>
                                <input type='text' value='$getaddressbox' class='form-control mb-2' name='editaddressbox' id='editaddressbox' />
                          </div>
        
                      </div>
      
                    <div class='row'>
                          <label for='editaddresscity' class='form-label col-sm-2'>Stad:</label>
                          <div class='col-sm-10'>
                                <input type='text' value='$getaddresscity' class='form-control mb-2' name='editaddresscity' id='editaddresscity' />
                          </div>
                    </div>
                    <div class='row'>
                          <label for='editmobnr' class='form-label col-sm-2'>Mobilnummer:</label>
                          <div class='col-sm-5'>
                              <input type='text' value='$getmobnr' class='form-control mb-2' name='editmobnr' id='editmobnr' />
                          </div>      
      
                      <label for='edittfnr' class='form-label col-sm-2'>Telefonnummer:</label>
                        <div class='col-sm-3'>
                          <input value='$gettfnr' class='form-control' name='edittfnr' id='edittfnr' />
                        </div>
                  </div> 
                  <br />
                      <div class='row'>
                        <div class='mx-auto col-md-5'>
                          <input class='btn btn-primary ms-1 btn-lg' name='editaccountbtn' id='editaccountbtn' type='submit' value='Uppdatera' />
                        </div>
                      </div>
                    </form>
                  
                    ";
        }
    }

    // SendSickRequest lägger till sjukanmälan i databasen.
    public function SendSickRequest($sickreason, $sickfrom, $sickto)
    {
        if(!$sickreason || !$sickfrom) {
          // Om något saknas.
          echo "<div class='alert alert-danger'>
                    Vissa fälten är inte ifyllda. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om något saknas.
        
        $sql = "SELECT * FROM users WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getfullname = $getdata['fullname'];
        $sql2 = "INSERT INTO sickregister(id, reason, from_date, to_date, fullname) VALUES('', '$sickreason', '$sickfrom', '$sickto', '$getfullname');";
        $result2 = $this->db->query($sql2);
        
        if ($result2) {
            // Om sjukanmälan lades till i databasen.
            echo "<div class='alert alert-success'>
                  Sjukanmälan har registrerat i databasen.<br /> Administratören kommer att kontakta dig snart.
              </div>";
        } // Slut om sjukanmälan lades till i databasen.
    }

    // SendLeaveRequest lägger till ledighetsansökan i databasen.
    public function SendLeaveRequest($leavereason, $leavefrom, $leaveto)
    {
        if(!$leavereason || !$leavefrom) {
          // Om något saknas.
          echo "<div class='alert alert-danger'>
                    Vissa fälten är inte ifyllda. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om något saknas.
        
        $sql = "SELECT * FROM users WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getfullname = $getdata['fullname'];
        $sql2 = "INSERT INTO leaveregister(id, reason, from_date, to_date, fullname) VALUES('', '$leavereason', '$leavefrom', '$leaveto', '$getfullname');";
        $result2 = $this->db->query($sql2);
        
        if ($result2) {
            // Om ledighetsansökan lades till i databasen.
            echo "<div class='alert alert-success'>
                  Ledighetsansökan har registrerat i databasen.<br /> Administratören kommer att kontakta dig snart.
              </div>";
        } // Slut om ledighetsansökan lades till i databasen.
        else {
            // Om nyheten lades inte till i databasen av någon anledning.
            echo mysqli_error($this->db);
        } // Om nyheten lades inte till i databasen av någon anledning.
    }

    // showFullContent hämtar hela nyhetsinlägget beroende på den skickade id.
    public function showFullContent($usrid)
    {
        if ($usrid == "") {
            // Om id är tom.
            header("location: index.php");
        } // Slut om id är tom.
        
        $sql = "SELECT * FROM news_db WHERE id='$usrid'";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        
        if ($num == 1) {
            // Om id hittades i databasen.
            echo "
          <div class='row'>
            <div class='card-deck overflow-hidden w-100'>
                ";
            while ($getdata = $result->fetch()) {
                $id = $getdata['id'];
                $bild = $getdata['img'];
                $title = $getdata['title'];
                $content = $getdata['content'];
                $author = $getdata['author'];
                $insert_date = $getdata['insert_date'];
                $cat = $getdata['category'];
                $cat = $getdata['category'];

                // Nyhetsinnehåll.
                echo " 
                  <div class='col-sm-6 col-md-4 col-lg-2 col-xl-5 cardparent'>
                    <div class='card p-2 h-100 mycard'>
                      <img src='$bild' alt='$title' loading='lazy' class='card-img-top img-fluid w-50 mx-auto' />
                        <div class='card-body'>
                            <h4 class='card-title'>$title</h4>
                            <p class='card-text'>
                                $cat<br />
                              <b>Publicerat</b>: 
                              $insert_date<br />
                                $content<br />
                                $author<br />
                         
                            </div></div>
                    ";
            }
        }
        // Slut om id hittades i databasen.
        else {
            // Om id inte hittades i databasen.
            echo "<div class='alert alert-danger w-50'>
                  Nyhetsinlägget som du söker saknas i databasen.
              </div>";
        } // Slut om id inte hittades i databasen.
        echo "</div></div></div>";
    }

    // checkadminuser kontrollerar om användaren har administratörsbehörigheter.
    public function checkadminuser($usrname)
    {
        $sql = "SELECT * FROM users WHERE username='$usrname';";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        
        if (!$getdata || $getdata['adminmange'] == 1) {
            // Om användaren har administratörsbehörigheter.
            return true;
        } // Slut om användaren har administratörsbehörigheter.
        if ($getdata['adminmange'] == 0) {
            // Om användaren inte har administratörsbehörigheter.
            return false;
        } // Slut om användaren inte har administratörsbehörigheter.
    }

    // AddNews lägger till nyheter beorende på de skickade data.
    public function AddNews($title, $cat, $content, $img, $author)
    {
        if(!$title || !$cat || !$content || !$img || !$author) {
          // Om något saknas.
          echo "<div class='alert alert-danger'>
                    Vissa fälten är tomma. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om något saknas.
        
        $sql = "SELECT * FROM users WHERE username='$author'";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getendauthor = $getdata['fullname'];
        date_default_timezone_set("Europe/Stockholm");
        $now = date("Y-m-d H:i:s", time());
        $sql2 = "INSERT INTO news_db(id, title, content, author, img, insert_date, category) VALUES('', '$title', '$content', '$getendauthor', '$img', '$now', '$cat');";
        $result2 = $this->db->query($sql2);
        
        if ($result2) {
            // Om nyheten lades till i databasen.
            echo "<div class='alert alert-success' style='margin-left: -10px;'>
                Nyhetsinlägget lades till i databasen.
              </div>";
        }
        // Slut om nyheten lades till i databasen.
        else {
            // Om nyheten lades inte till i databasen av någon anledning.
            echo mysqli_error($this->db);
        } // Slut om nyheten lades inte till i databasen av någon anledning.
    }

    // UpdateNews uppdaterar data beroende på de skickade data.
    public function UpdateNews($id, $title, $cat, $content, $img, $author)
    {
        $sql = "SELECT * FROM users WHERE username='$author'";
        $result = $this->db->query($sql);
        $getdata = $result->fetch();
        $getendauthor = $getdata['fullname'];
        $sql2 = "UPDATE news_db SET title = '$title', content='$content', author='$getendauthor', category='$cat'";
        
        if ($img !== "") {
            // Om bilden som skickas inte är tom.
            $sql2 .= ", img='$img'";
        } // Slut om bilden som skickas inte är tom.
        
        $sql2 .= " WHERE id=$id;";
        $result2 = $this->db->query($sql2);
        
        if ($result2) {
            // Om nyheten uppdaterades enligt de skickade data.
            echo "<div class='alert alert-success w-75'>
                        Ändringar har sparat.
              </div>";
        }
        // Slut om nyheten uppdaterades enligt de skickade data.
        else {
            // Om nyheten inte uppdaterades enligt de skickade data.
            echo mysqli_error($this->db);
        } // Slut om nyheten inte uppdaterades enligt de skickade data.
    }

    // DeleteNews raderar data beroende på de skickade id.
    public function DeleteNews($id)
    {
        $sql = "SELECT * FROM news_db WHERE id=$id;";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        $getdata = $result->fetch();
        $sql2 = "DELETE FROM news_db WHERE id=$id;";
        $result2 = $this->db->query($sql2);
        
        if ($result) {
            // Om nyheten togs bort från databasen.
            echo "<div class='alert alert-danger mt-2'>
                  Nyhetsinlägget har tagits bort.
                </div>";
        }
        // Slut om nyheten togs bort från databasen.
        else {
            // Om nyheten inte togs bort från databasen av någon anledning.
            echo $this->db->errorInfo();
        } // Slut om nyheten inte togs bort från databasen av någon anledning.
    }

    // getList hämtar alla nyhetskategorier.
    public function getList()
    {
        $sql = "SELECT * FROM news_categories";
        $result = $this->db->query($sql);
        echo "<option value=''>Kategori</option>
            <option value=''>---</option>";
        
        while ($getdata = $result->fetch()) {
            $catname = $getdata['category_name'];
            echo "
              <option value='$catname'>$catname</option>
          ";
        }
        echo "</select>";
    }

    // UpdateEmail Uppdaterar e-postadress i Mitt konto sidan.
    public function UpdateEmail($email)
    {
        if(!$email) {
          // Om e-postadressen är tom.
          echo "<div class='alert alert-danger'>
                    E-postadressen är tom. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om e-postadressen är tom.

        $sql = "UPDATE users SET email='$email' WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
        
        if ($result) {
            // Om e-postadress ändrades.
            header("location: accountsettings.php?msg=emailsuccess");
        }
        // Slut om e-postadress ändrades.
        else {
            // Om e-postadress inte ändrades av någon anledning.
            echo mysqli_error($this->db);
        } // Slut om e-postadress inte ändrades av någon anledning.
    }

    // GetStaffNames hämtar alla personal info.
    public function GetStaff()
    {
        $sql = "SELECT * FROM users";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        // Personalinnehåll.
        echo "
        <img src='./Images/Ikoner/staff.png' loading='lazy' class='img-fluid stafficon' alt='Personalikon' />
          <h1 class='ms-4'>Personal</h1>
            <div class='row'>
              <div class='card-deck w-75'>";
        if ($num > 0) {
            // Om man hittade personal i databasen.
            while ($getdata = $result->fetch()) {
                $getfullname = $getdata['fullname'];
                $getepost = $getdata['email'];
                $gettfnr = $getdata['tfnr'];
                $getmobnr = $getdata['mobnr'];
                $getavatar = $getdata['avatar'];
                $getwork = $getdata['work_title'];
                echo " 
            <div class='col-sm-6 col-md-4 col-lg-3 col-xl-4'>
              <div class='card p-2 h-100'>
                <img src='.././$getavatar' loading='lazy' alt='$getfullname Profilbild' class='card-img-top img-fluid cardimage' />
                  <div class='card-body'>
                      <h4 class='card-title'>$getfullname</h4>
                      <p class='card-text'>
                          $getwork
                      </p>
                      <p class='card-text'>
                          $getepost
                      </p>
                      <p class='card-text'>
                          $gettfnr
                      </p>
                      <p class='card-text'>
                          $getmobnr
                      </p>
                      </div></div></div>
                ";
            }
        }
        // Slut om man hittade personal i databasen.
        else {
            // Om det saknas personal i databasen.
            echo "
            <div class='alert alert-danger'>
              Det finns inga personal just nu.
            </div> 
          ";
        } // Slut om det saknas personal i databasen.
        echo "</div></div>";
    }

    // GetArkiv hämtar alla arkivfiler.
    public function GetArkiv()
    {
        $sql = "SELECT * FROM arkiv;";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        // Filarkivtabellen.
        echo "<div class='table-responsive'>
          <table class='table w-100'>
            <thead class='bg-primary text-white'>
              <tr>
                <th>Namn:</th>
                <th>Beskrivning:</th>
                <th>Kategori:</th>
                <th>Fil:</th>
                <th>Filstorlek</th>    
                <th>Ladda ner</th>    
              </tr>
            </thead>
              <tbody>";
        if ($num > 0) {
            // Om det finns arkivfiler i databasen.
            while ($getdata = $result->fetch()) {
                $getname = $getdata['file_name'];
                $getsize = $getdata['filesize'];
                $getcat = $getdata['category'];
                $getdes = $getdata['descr'];
                $getfile = $getdata['the_file'];
                echo " 
                  <tr>
                      <td>$getname</td>
                      <td>$getdes</td>
                      <td>$getcat</td>
                      <td>$getfile</td>
                      <td>$getsize byte</td>
                      <td>
                        <a href='download.php?file=$getfile'>
                          <img class='img-fluid downloadicon' loading='lazy' src='Images/Ikoner/download.png' alt='Download' />
                        </a>
                      </td>
                  </tr>
              ";
            }
        }
        // Slut om det finns arkivfiler i databasen.
        else {
            // Om filarkivet är tomt.
            echo "
            <tr>
              <td colspan='2'>Arkivet är tom.</td>
              </tr>

          ";
        } // Slut om filarkivet är tomt.
        echo "
        </tbody></table>";
    }

    // GetAddCategoriesForm skapar ett förmulär för att kunna lägga till kategorier.
    public function GetAddCategoriesForm()
    {
        echo "<form action='admin.php' method='post' class='p-4 needs-validation' novalidate>
            <div class='row'>
              <div class='form-row col-md-2'>
                <label for='catname' class='form-label ms-2 mt-3'>Kategorinamn:*</label>
              </div>
                  <div class='form-row col-md-5'>
                    <input type='text' name='addcatname' class='form-control ms-1 mb-1' id='catname' required />
                  </div>
              </div>

            <div class='row'>
              <div class='form-row col-md-2'>
                <label for='catregister' class='form-label ms-2 mt-3'>Register:*</label>
              </div>
              <div class='form-row col-md-2'>
                  <select class='form-control ms-1' name='addcatdb' id='catregister' required>
                    <option value=''>Välj</option>
                    <option value=''>---</option>
                    <option value='news_categories'>Nyhetkategorier</option>
                    <option value='arkiv_categories'>Filarkivkategorier</option>
                </select>
          <br />
          <div class='row'>
            <div class='mx-auto'>
              <input type='submit' value='Lägg till' name='addcatbtn' class='btn btn-primary btn-lg' />
            </div>
          </div>

            </form>";
    }

    // AddCategory lägger till kategorier i databasen.
    public function AddCategory($addcatname, $addcatdb)
    {
        if(!$addcatname || !$addcatdb) {
          // Om något saknas.
          echo "<div class='alert alert-danger'>
                    Vissa fälten är tomma. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om något saknas.
        
        if ($addcatdb == "news_categories") {
            // Om användaren valde nyheterkategorier.
            $sql = "INSERT INTO news_categories(id, category_name) VALUES('', '$addcatname');";
        } // Slut om användaren valde nyheterkategorier.

        if ($addcatdb == "") {
            // Om användaren valde nyheterkategorier.
            echo "<div class='alert alert-danger'>
              Du måste välja vilket register gäller det.
              </div>";
        } // Slut om användaren valde nyheterkategorier.

        if ($addcatdb == "arkiv_categories") {
            // Om användaren valde arkivkategorier.
            $sql = "INSERT INTO arkiv_categories(id, cat_name) VALUES('', '$addcatname');";
        } // Slut om användaren valde arkivkategorier.
        
        $result = $this->db->query($sql);
        
        if ($result) {
            // Om resultatet lades till i databasen.
            echo "<div class='alert alert-success'>
                  Kategorin har skapat.
                </div>";
        }
        // Slut om resultatet lades till i databasen.
        else {
            // Om resultet inte lyckades av någon anledning.
            echo $this->db->errorInfo();
        } // Slut om resultet inte lyckades av någon anledning.
    }

    // AddFile lägger till nyheter beorende på de skickade data.
    public function AddFile($filename, $des, $cat, $file, $filesize)
    {
        if(!$filename || !$des || !$cat || !$file || !$filesize) {
          // Om något saknas.
          echo "<div class='alert alert-danger'>
                    Vissa fälten är tomma. Var vänlig och fyll in det.
                </div>";
          exit(0);
        } // Slut om något saknas.
        
        date_default_timezone_set("Europe/Stockholm");
        $now = date("Y-m-d H:i:s", time());
        $sql = "INSERT INTO arkiv(id, file_name, descr, category, the_file, filesize, insert_date) VALUES('', '$filename', '$des', '$cat', '$file', '$filesize', '$now');";
        $result = $this->db->query($sql);
        
        if ($result) {
            // Om filen lades till i databasen.
            header("location: filarkiv.php?msg=true");
        }
        // Slut om filen lades till i databasen.
        else {
            // Om filen inte lades till i databasen av någon anledning.
            echo mysqli_error($this->db);
        } // Slut om filen inte lades till i databasen av någon anledning.
    }

    // GetNewsValues hämtar alla data till editnews forumlär.
    public function GetNewsValues($id)
    {
        $sql = "SELECT * FROM news_db WHERE id=$id;";
        $result = $this->db->query($sql);
        $getdata1 = $result->fetch();
        $categoryname = $getdata1['category'];
        $sql2 = "SELECT * FROM news_categories WHERE category_name='$categoryname';";
        $result2 = $this->db->query($sql2);
        $getdata2 = $result2->fetch();
        $getcatid = $getdata2['id'];
        $sql3 = "SELECT * FROM news_categories WHERE NOT id=$getcatid;";
        $result3 = $this->db->query($sql3);
        $getdata3 = $result3->fetch();
        $getsortedcat = $getdata3['category_name'];
        $sql4 = "SELECT * FROM news_db WHERE id=$id;";
        $result4 = $this->db->query($sql4);
        
        while ($getdata4 = $result4->fetch()) {
            $gettitle = $getdata4['title'];
            $getcat = $getdata4['category'];
            $getcontent = $getdata4['content'];
            $getimg = $getdata4['img'];
            echo "

            </div>
          </div>
        <form action='editnews.php?id=$id' class='ms-3 w-75' method='post' enctype='multipart/form-data'>
          
          <div class='row'>
            <div class='form-row col-md-7'>
                <label class='form-label' for='edittitle'>Rubrik:</label>
                <input type='text' value='$gettitle' class='form-control' name='edittitle' id='edittitle' />
            </div>
          </div>

          <div class='row'>
            <div class='form-row col-md-7'>
              <label class='form-label' for='editcat'>Kategori:</label>
                <select class='form-control' name='editcat' id='editcat'>
                  <option value='$getcat'>$getcat</option>
                  <option value='$getsortedcat'>$getsortedcat</option>
                </select>
            </div>
        </div>

            <div class='row'>
                <div class='form-row col-md-7'>
                  <label class='form-label' for='editcontent'>Innehåll:</label>
                    <textarea class='editcontent form-control' id='editcontent' name='editcontent'>$getcontent</textarea>
                </div>
            </div>

          <br />

            <div class='row'>
              <div class='form-row col-md-7'>
              <label class='form-label' for='editcontent'>Bild:</label>  
                <input type='file' name='editimg' class='form-control' accept='image/*' id='editimg' />  
              </div>
          </div>

            <div class='row'>
              <div class='form-row col-md-7'>
                <div>Nuvarande bild:</div>
                  <img src='$getimg' loading='lazy' class='img-fluid thumb' alt='$gettitle' /><br /><br />
              </div>
            </div>

          <div class='row'>
              <div class='form-row ms-auto col-md-10'>
                <input class='btn btn-primary ms-1 btn-lg' name='editbtn' id='editbtn' type='submit' value='Uppdatera' />
              </div>
          </div>

        </form>
        </div>";
        }
    }

    // getNewsfunktionen hämtar alla nyheter från databasen.
    public function getNews($usrname)
    {
        $sql = "SELECT * FROM news_db;";
        $result = $this->db->query($sql);
        $num = $result->rowCount();
        
        // Nyhetsinnehåll.
        echo "
          <div class='row'>
            <div class='card-deck w-100'>
                ";
        
        if ($num > 0) {
            // Om det finns nyheter i databasen.

            while ($getdata = $result->fetch()) {
                $bild = $getdata['img'];
                $title = $getdata['title'];
                $content = $getdata['content'];
                $date = $getdata['insert_date'];
                $author = $getdata['author'];
                $cat = $getdata['category'];
                $id = $getdata['id'];
                echo " 
                  <div class='col-sm-6 col-md-4 col-lg-2 col-xl-4 cardparent'>
                    <div class='card p-2 h-100 mycard'>
                      <img src='$bild' alt='$title' loading='lazy' class='w-100 card-img-top img-fluid' style='height: 200px;' />
                        <div class='card-body'>
                            <h4 class='card-title'>$title</h4>
                            <p class='card-text'>
                                $cat
                            </p>
                            <p class='card-text'>
                              <b>Publicerat</b>: $date
                            </p>
                            <p class='card-text' style='white-space: nowrap;'>
                                $content
                            
                            <p class='card-text'>
                                $author
                            </p>
                         
                         
                     
                    ";
                if ($this->checkadminuser($_SESSION['loginuname']) == 1) {
                    // Om användaren har administratörsbehörigheter.
                    echo "
                              <a class='btn btn-primary card-link w-100 btn-lg mb-1' href='editnews.php?id=$id'>Ändra</a> <br />
                              <a class='btn btn-danger w-25 w-100 card-link btn-lg mb-1' href='././deletenews.php?id=$id'>Radera</a>
                            ";
                } // Om användaren har administratörsbehörigheter.
                echo "</div></div></div>";
            }
        }
        // Slut om det finns nyheter i databasen.
        else {
            // Om det saknas nyheter i databasen.
            echo "<div class='alert alert-danger overflow-hidden' style='width: 95%;'>
                Det finns inga nyheter just nu.
              </div>";
        } // Om det saknas nyheter i databasen.
        echo "</div></div>";
    }
} ?>
 