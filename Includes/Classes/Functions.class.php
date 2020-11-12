<?php

class Functions
{
    protected $db;
    // Tillämpa inställningar för anslutning till databasen.
    public function __construct()
    {
        $this->db = mysqli_connect(DB_HOST, DB_USRNAME, DB_PSW, DB_NAME);
        if ($this->db->connect_error) {
            // Om det finns eventuella fel att ansluta till databasen.
            die("Anslutning misslyckades: " . $this->db->connect_error);
        } // Slut om det finns eventuella fel att ansluta till databasen.
    }

    // getLogoImg hämtar logotypen från databasen.
    public function getLogoImg()
    {
        $sql = "SELECT * FROM admininfo";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        $getdata = mysqli_fetch_array($result);
        if ($getdata['avatar'] == "") {
            // Om logotypen för hemsidan saknas i databasen.
            return "./Images/Admin/admin_header_logo.png";
        }
        // Slut om logotypen för hemsidan saknas i databasen.
        else {
            // Om logotypen för hemsidan hittas i databasen.
            return "./" . $getdata['avatar'];
        } // Slut om logotypen för hemsidan hittas i databasen.
    }

    // getCompanyName hämtar Företagets namn från databasen.
    public function getCompanyName()
    {
        $sql = "SELECT * FROM admininfo";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        $getdata = mysqli_fetch_array($result);
        if ($getdata['companyname'] == "") {
            // Om företagets namn saknas i databasen.
            return "Gssons El AB";
        }
        // Slut om företagets namn saknas i databasen.
        else {
            // Om företagets namn hittades i databasen.
            return $getdata['companyname'];
        } // Slut om företagets namn hittades i databasen.
    }

    // checkusersfunktionen kontrollerar om användare är redan registrerad i databasen inför registrering.
    public function checkuser(
        $registerfname,
        $registerlname,
        $registermobnr,
        $registertfnr,
        $registerepost,
        $registerpsw,
        $registerwork,
        $registerbornday,
        $registerbornmonth,
        $registerbornyear,
        $registersex,
        $bild,
        $realpsw
    ) {
        date_default_timezone_set("Europe/Stockholm");
        $now = date("Y-m-d H:i:s", time());
        $registerpsw = md5($registerpsw);
        $token_key = md5(time() . $registerfname . $registerlname);
        $expformat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $exp = date("Y-m-d H:i:s", $expformat);
        $registeruname = $registerfname . $registerlname;
        $sql = "INSERT INTO users (id, fname, lname, username, fullname, email, psw, work_title, mobnr, tfnr, avatar, active, bornday, bornmonth, bornyear, sex , lastlogin, register_date, register_tokenkey, register_tokenexpiretime, adminapprove, adminmange) VALUES('', '$registerfname', '$registerlname', '$registeruname', '$registerfname $registerlname', '$registerepost', '$registerpsw', '$registerwork', '$registermobnr', '$registertfnr', '$bild', '0', '$registerbornday', '$registerbornmonth', '$registerbornyear', '$registersex', '$now', '$now', '$token_key', '$exp', '0', '0');";
        if ($this->db->query($sql)) {
            // Om registreringen lyckades.
            $sql2 = "SELECT * FROM users WHERE username='$registeruname' AND psw='$registerpsw';";
            $result2 = $this->db->query($sql2);
            $row2 = mysqli_fetch_array($result2);
            $getusername = mysqli_real_escape_string(
                $this->db,
                $row2['username']
            );
            $to = $registerepost;
            $subject = "Verifiera ditt konto";
            $message = "Tack för registrering.<br /><br />
Dina inloggninsuppgifter: <br /><br />
Användarnamn: $getusername  <br /><br />
Lösenord: $realpsw  <br /><br /><br />
Verifiera ditt konto här <br /><br />
<a href='https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/activate.php?key=$token_key&uid=$row2[id]'>https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/activate.php?key=$token_key&uid=$row2[id]</a> <br /><br />
Observera att denna länk är giltig i bara 24 timmar.";
            $headers = "From: admin@gssonselab.com";
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            mail($to, $subject, $message, $headers);
            echo "<div class='alert alert-success'>
                Tack för registrering.<br /> Du behöver aktivera ditt konto innan du kan logga in.<br />
                Kolla din e-postadress för att aktivera ditt konto.
              </div>
              ";
        }
        // Slut om registreringen lyckades.
        else {
            // Om användaren inte blev registrerad av någon anledning.
            echo "<div class='alert alert-danger'>" .
                mysqli_error($this->db) .
                "</div>";
        } // Om användaren inte blev registrerad av någon anledning.
    }

    // checkloginsfunktionen kontrollerar om användare är redan registrerad inför inloggningen.
    public function checklogin($loginuname, $loginpsw)
    {
        $loginpsw = md5($loginpsw);
        $sql = "SELECT * FROM users WHERE username='$loginuname' AND psw='$loginpsw';";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if ($num > 0) {
            // Om användare hittades i databasen beroende på de skickade data.
            $getactive = mysqli_escape_string($this->db, $row['active']);
            $getapprove = mysqli_escape_string($this->db, $row['adminapprove']);
            if ($getactive == "1") {
                // Om användaren är aktiv och verifierad.
                if ($getapprove == "1") {
                    // Om administratören har godkänt registrering.
                    $_SESSION['loginuname'] = mysqli_escape_string(
                        $this->db,
                        $row['username']
                    );
                    $this->UpdateLogindate();
                    echo '<div class="alert alert-success">
                      Du blev inloggad. <br />
                      Du skickas snart till Dashboard.

                     </div>
            <meta http-equiv="refresh" content="2; url=../Dashboard/index.php" />';
                }
                // Slut om administratören har godkänt registrering.
                else {
                    // Om administratören inte har godkänt registrering.
                    echo '<div class="alert alert-info">
                       Dina administratörer bör godkänna din registrering först.<br />
                       Kontakta administratörer för mer information
                     </div>';
                } // Slut om administratören inte har godkänt registrering.
            }
            // Slut om användaren är aktiv och verifierad.
            else {
                // Om användaren inte är verifierad.
                echo "<div class='alert alert-danger'>
                  Du måste aktivera ditt konto först.
                </div>";
            } // Slut om användaren inte är verifierad.
        }
        // Slut om användare hittades i databasen beroende på de skickade data.
        else {
            // Om användare inte hittades i databasen enligt de skickade data.
            echo "<div class='alert alert-danger'>
                  Det finns något fel i användarnamnet/lösenordet. <br />
                  Kontrollera dina inloggningsuppgifter.
              </div>";
        } // Slut om användare inte hittades i databasen beroende på de skickade data.
    }

    // UpdateLoginDate registrerar den senaste inloggning för användare.
    public function UpdateLoginDate()
    {
        date_default_timezone_set("Europe/Stockholm");
        $now = date("Y-m-d H:i:s", time());
        $sql = "UPDATE users SET lastlogin='$now' WHERE username='$_SESSION[loginuname]';";
        $result = $this->db->query($sql);
    }

    // checkkeysfunktion kontrollerar om verifieringsnyckel stämmer överens med databasensnyckel.
    public function checkkey($key, $uid)
    {
        $sql = "SELECT * FROM users WHERE id='$uid';";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        $gettoken = mysqli_real_escape_string(
            $this->db,
            $row['register_tokenkey']
        );
        $getexpiretime = mysqli_real_escape_string(
            $this->db,
            $row['register_tokenexpiretime']
        );
        $getemail = mysqli_real_escape_string($this->db, $row['email']);
        $getusername = mysqli_real_escape_string($this->db, $row['username']);
        $getpsw = mysqli_real_escape_string($this->db, $row['psw']);
        $nowtime = date("Y-m-d H:i:s");
        if ($getexpiretime <= $nowtime) {
            // Om tiden för aktivering har löpt ut.
            echo "<div class='alert alert-danger'>
                Länken är ogiltig.<br /> 
                Du bör kontakta administratören.
              </div>";
            exit(0);
        } // Slut om tiden för aktivering har löpt ut.
        if ($gettoken == $key) {
            // Om aktiveringsnyckel som finns lagrad i databasen stämmer överens med den skickade nyckeln från aktiveringssida.
            $getactive = mysqli_escape_string($this->db, $row['active']);
            if ($getactive == "0") {
                // Om användaren är inte aktiv och inte verifierad.
                $sql2 = "UPDATE users SET active='1' WHERE id='$uid';";
                if ($result2 = $this->db->query($sql2)) {
                    // Om aktiveringen lyckades.
                    echo '<div class="alert alert-success">
                      Kontoverifiering har lyckat.<br />
                      Administratören behöver godkänna din registrering innan du kan logga in.
                  </div>';
                } // Slut om aktiveringen lyckades.
            }
            // Slut om användaren är inte aktiv och inte verifierad.
            else {
                // Om användaren är aktiv och verifierad.
                echo "<div class='alert alert-danger'>
                    Du har redan verifierat ditt konto.
                  </div>";
            } // Slut om användaren är aktiv och verifierad.
        }
        // Slut om aktiveringsnyckel som finns lagrad i databasen stämmer överens med den skickade nyckeln från aktiveringssida.
        else {
            // Om aktiveringsnyckel som finns lagrad i databasen inte stämmer överens med den skickade nyckeln från aktiveringssida.
            echo "  <div class='alert alert-danger'>
                      Det finns något fel i verifieringsnyckel. Du bör kontakta administratören.
                    </div>";
        } // Slut om aktiveringsnyckel som finns lagrad i databasen inte stämmer överens med den skickade nyckeln från aktiveringssida.
    }

    // checkEmailKey kontrollerar om aktiveringsnyckel stämmer överens med databasensnyckel för e-postadressverifiering och om det lyckades då uppdateras e-postadressen.
    public function checkEmailKey($getkey, $getuid, $getepost)
    {
        date_default_timezone_set("Europe/Stockholm");
        $sql = "SELECT * FROM users WHERE id=$getuid;";
        $result = $this->db->query($sql);
        $getdata = mysqli_fetch_array($result);
        $gettoken = mysqli_real_escape_string(
            $this->db,
            $getdata['email_tokenkey']
        );
        $getexpiretime = mysqli_real_escape_string(
            $this->db,
            $getdata['email_expiretime']
        );
        $nowtime = date("Y-m-d H:i:s");
        if ($getexpiretime <= $nowtime) {
            // Om tiden för aktivering har redan löpt ut.
            echo "<div class='alert alert-danger'>
                  Länken är ogiltig. <br />
                  Du bör kontakta administratören.
                </div>";
            exit(0);
        } // Slut om tiden för aktivering har redan löpt ut.
        if ($gettoken == $getkey) {
            // Om aktiveringsnyckel som finns lagrad i databasen stämmer överens med den skickade nyckeln från aktiveringssida.
            $sql2 = "UPDATE users SET email='$getepost' WHERE id=$getuid;";
            if (
                ($result2 = $this->db->query($sql2)) or
                die(mysqli_error($this->db))
            ) {
                // Om uppdatering av e-postadressen lyckades.
                echo '<div class="alert alert-success">
                        E-postverifiering lyckades.<br />
                        Nu kan du logga in med den nya e-postadress.
                    </div>';
            }
            // Slut om uppdatering av e-postadressen lyckades.
            else {
                // Om uppdatering av e-postadressen inte lyckades.
                echo "<div class='alert alert-danger'>
                      Länken är ogiltig. <br />
                      Du bör kontakta administratören.
                    </div>";
            } // Slut om uppdatering av e-postadressen inte lyckades.
        }
        // Slut om aktiveringsnyckel som finns lagrad i databasen stämmer överens med den skickade nyckeln från aktiveringssida.
        else {
            // Om aktiveringsnyckel som finns lagrad i databasen inte stämmer överens med den skickade nyckeln från aktiveringssida.
            echo "  <div class='alert alert-danger'>
                      Det finns något fel i verifieringsnyckel. Du bör kontakta administratören.
                    </div>";
        } // Slut om aktiveringsnyckel som finns lagrad i databasen inte stämmer överens med den skickade nyckeln från aktiveringssida.
    }

    // forgetpswsfunktion lägger till begäran om lösenordsåterställning i databasen.
    public function forgetpsw($forgetepost)
    {
        $sql = "SELECT * FROM users WHERE email='$forgetepost';";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        $userid = mysqli_real_escape_string($this->db, $row['id']);
        $getusername = mysqli_real_escape_string($this->db, $row['username']);
        $token_key = md5(time() . $getusername);
        $expformat = mktime(
            date("H"),
            date("i"),
            date("s"),
            date("m"),
            date("d") + 1,
            date("Y")
        );
        $exp = date("Y-m-d H:i:s", $expformat);
        if ($num == 1) {
            // Om det finns sådan e-postadress i databasen.
            $sql2 = "INSERT INTO password_reset(id, userid, token, tokenexpiretime) VALUES('', '$userid', '$token_key', '$exp')";
            $result2 = $this->db->query($sql2);
            if ($result2) {
                // Om lösenordsåterställning lades till i databasen.
                echo "
                  <div class='alert alert-success'>
                    Vi har skickat ett mejl med instruktioner om hur du går tillväga via e-post till dig. <br />
                    Kontrollera din e-postadress för att kunna återställa ditt lösenord.
                  </div>";

                $to = $forgetepost;
                $subject = "Återställa ditt lösenord";
                $message = "
Du begärde ett nytt lösenord.<br /><br />
Klicka på länken för att kunna återställa ditt lösenord<br /><br />
<a href='https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/doforgetpsw.php?key=$token_key&uid=$userid'>https://intranet.gssonsel.se.185-133-206-116.bb.kringelstan.se/doforgetpsw.php?key=$token_key&uid=$userid</a> <br /><br />
Observera att denna länk är giltig i bara 24 timmar.";
                $headers = "From: admin@gssonselab.com";
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .=
                    'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                mail($to, $subject, $message, $headers);
            } // Slut om lösenordsåterställning lades till i databasen.
        }
        // Slut om det finns sådan e-postadress i databasen.
        else {
            // Om det saknas sådan e-postadress i databasen.
            echo "<div class='alert alert-danger'>
                    Denna e-postadress är inte registrerad.<br />
                    Kontrollera din e-postadress och försök igen.
                </div>";
        } // Slut om det saknas sådan e-postadress i databasen.
    }

    // checkemail kontrollerar om användare e-postadressen är redan registrerad i databasen.
    public function checkemail($registerepost)
    {
        $sql = "SELECT * FROM users WHERE email='$registerepost';";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            // Om det finns sådan e-postadress i databasen.
            return false;
        }
        // Slut om det finns sådan e-postadress i databasen.
        else {
            // Om det saknas sådan e-postadress i databasen.
            return true;
        } // Slut om det saknas sådan e-postadress i databasen.
    }

    // changepsw implementerar lösenordsåterställning.
    public function changepsw($key, $uid, $forgetepswepost, $forgetpsw)
    {
        $sql = "SELECT * FROM password_reset WHERE userid='$uid';";
        $result = $this->db->query($sql);
        $num = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        $gettoken = mysqli_real_escape_string($this->db, $row['token']);
        $getexpiretime = mysqli_real_escape_string(
            $this->db,
            $row['tokenexpiretime']
        );
        $nowtime = date("Y-m-d H:i:s");
        if ($num == 1) {
            // Om användaren begärde lösenordsåterställningförfrågan.
            if ($getexpiretime <= $nowtime) {
                // Om tiden har löpt ut för lösenordsåterställning.
                echo "<div class='alert alert-danger'>
                  Länken är ogiltig.<br /> 
                  Du bör kontakta administratören.
                </div>";
                exit(0);
            } // Slut om tiden har löpt ut för lösenordsåterställning.
            if ($gettoken == $key) {
                // Om lösenordsåterställningsnyckel som finns lagrad i databasen stämmer överens med den skickade nyckeln från lösenordsåterställningssida.
                $forgetpsw = md5($forgetpsw);
                $sql2 = "UPDATE users SET psw='$forgetpsw' WHERE id='$uid';";
                $result2 = $this->db->query($sql2);
                if ($result2) {
                    echo "  <div class='alert alert-success'>
                      Lösenordet har ändrat. <br />
                      Nu kan du logga in med det nya lösenordet.
                    </div>";
                }
            }
            // Slut om lösenordsåterställningsnyckel som finns lagrad i databasen stämmer överens med den skickade nyckeln från lösenordsåterställningssida.
            else {
                // Om lösenordsåterställningsnyckel som finns lagrad i databasen inte stämmer överens med den skickade nyckeln från lösenordsåterställningssida.
                echo "  <div class='alert alert-danger'>
                        Det finns något fel i lösenordsåterställningsnyckeln. <br />
                        Du bör kontakta administratören.
                      </div>";
            } // Slut om lösenordsåterställningsnyckel som finns lagrad i databasen inte stämmer överens med den skickade nyckeln från lösenordsåterställningssida.
        }
        // Slut om användaren begärde lösenordsåterställningförfrågan.
        else {
            // Om användaren inte begärde lösenordsåterställningförfrågan.
            echo "<div class='alert alert-danger'>
                  Du begärde inte en lösenordsåterställningförfråga.<br />
                  Du behöver begära en ny lösenordsåterställningförfråga.
                </div>";
        } // Slut om användaren inte begärde lösenordsåterställningförfrågan.
    }
} ?>
 