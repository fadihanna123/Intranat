<?php session_start(); ?>
<?php $title = "Registrera dig"; ?>
<?php require "Includes/header.php"; ?>


<!-- Registreringsformulär -->
<div class="container text-center">
    <h2 class="rubrik">Registrera dig</h2>
    <p>
      Här kan du registrera dig.
    </p>
    <!-- Lösenordsvarning -->
    <div class="alert alert-info">
        Samtliga fält som är markerade med * är obligatoriska. <br />
        Observera att du måste ha minst 6 tecken i det utvalda lösenordet.
    </div>
  <!-- Registreringsmeddelande -->
  <div class="container-fluid">
      <div id="registermain">
    <?php
    if (isset($_SESSION['loginuname'])) {
        // Om användare är inloggad.
        header('location: Dashboard/index.php');
    } // Slut om användare är inloggad.
    $registerfname = strip_tags(
        htmlentities(
            isset($_POST["registerfname"]) ? $_POST["registerfname"] : ""
        )
    );
    $registerlname = strip_tags(
        htmlentities(
            isset($_POST["registerlname"]) ? $_POST["registerlname"] : ""
        )
    );
    $registerepost = strip_tags(
        htmlentities(
            isset($_POST["registerepost"]) ? $_POST["registerepost"] : ""
        )
    );
    $registermobnr = strip_tags(
        htmlentities(
            isset($_POST["registermobnr"]) ? $_POST["registermobnr"] : ""
        )
    );
    $registerpsw = strip_tags(
        htmlentities(isset($_POST["registerpsw"]) ? $_POST["registerpsw"] : "")
    );
    $registerwork = strip_tags(
        htmlentities(
            isset($_POST["registerwork"]) ? $_POST["registerwork"] : ""
        )
    );
    $registerbornday = strip_tags(
        htmlentities(
            isset($_POST["registerbornday"]) ? $_POST["registerbornday"] : ""
        )
    );
    $registerbornmonth = strip_tags(
        htmlentities(
            isset($_POST["registerbornmonth"])
                ? $_POST["registerbornmonth"]
                : ""
        )
    );
    $registerbornyear = strip_tags(
        htmlentities(
            isset($_POST["registerbornyear"]) ? $_POST["registerbornyear"] : ""
        )
    );
    $registersex = strip_tags(
        htmlentities(isset($_POST["registersex"]) ? $_POST["registersex"] : "")
    );
    $registertfnr = strip_tags(
        htmlentities(
            isset($_POST["registertfnr"]) ? $_POST["registertfnr"] : ""
        )
    );
    $filename = isset($_FILES['registerimg']['name'])
        ? $_FILES['registerimg']['name']
        : "";
    $filetype = isset($_FILES['registerimg']['type'])
        ? $_FILES['registerimg']['type']
        : "";
    $tmpname = isset($_FILES['registerimg']['tmp_name'])
        ? $_FILES['registerimg']['tmp_name']
        : "";
    $forgetpsw = strip_tags(
        htmlentities(isset($_POST["forgetpsw"]) ? $_POST["forgetpsw"] : "")
    );
    $confirmpsw = strip_tags(
        htmlentities(isset($_POST["confirmpsw"]) ? $_POST["confirmpsw"] : "")
    );
    
    if (isset($_POST['registerbtn'])) {
        // Om användare klickade på Registrera dig knappen.
        if (
            empty($registerfname) ||
            empty($registerlname) ||
            empty($registerepost) ||
            empty($registermobnr) ||
            empty($registerpsw) ||
            empty($registerwork) ||
            empty($registerbornday) ||
            empty($registerbornmonth) ||
            empty($registerbornyear) ||
            empty($registersex) ||
            empty($registertfnr)
        ) {
            // Om det saknas samtliga data för registrering.
            echo "<div class='alert alert-danger'>
                              Du behöver fylla in de obligatoriska fält.
                  </div>";
        }
        // Slut om det saknas samtliga data för registrering.
        else {
            // Om det finns samtliga data för registrering.
            if (filter_var($registerepost, FILTER_VALIDATE_EMAIL)) {
                // Om e-postadressen var korrekt validerat.
                if (strlen($registerpsw) >= 6) {
                    // Om lösenordets längd var längre eller lika med 6 tecken.
                    if ($functions->checkemail($registerepost)) {
                        // Om e-postadressen saknas i databasen.
                        if (
                            isset($filename) &&
                            ($filetype =
                                "image/jpg" &&
                                ($filetype =
                                    "image/png" &&
                                    ($filetype =
                                        "image/jpeg" &&
                                        ($filetype = "image/gif"))))
                        ) {
                            // Om användare bifogade bildfil och bildtyper var jpg, png, jpeg och gif.
                            if (
                                move_uploaded_file(
                                    $tmpname,
                                    "Images/Users/$filename"
                                )
                            ) {
                                // Om bildfilen laddades upp till mappen Users.
                                $bild = "Images/Users/$filename";
                                copy(
                                    $bild,
                                    "Dashboard/Images/Users/" . $filename
                                );
                            }

                            // Slut om bildfilen laddades upp till mappen Users.
                        }
                        // Slut om användare bifogade bildfilen.
                        $realpsw = $registerpsw;
                        if ($registersex == "Man" && $filename == "") {
                            // Om användaren är en man men saknar en profilbild.
                            $bild = "Images/Users/default_man.png";
                            copy(
                                $bild,
                                "Dashboard/Images/Users/default_man.png"
                            );
                        }
                        // Slut om användaren är en man men saknar en profilbild.
                        if ($registersex == "Kvinna" && $filename == "") {
                            // Om användaren är en kvinna men saknar en profilbild.
                            $bild = "Images/Users/default_woman.gif";
                            copy(
                                $bild,
                                "Dashboard/Images/Users/default_woman.gif"
                            );
                        }
                        // Slut om användaren är en kvinna men saknar en profilbild.
                        $functions->checkuser(
                            $registerfname,
                            $registerlname,
                            $registermobnr,
                            $registertfnr,
                            $registerepost,
                            $registerpsw,
                            $registerwork,
                            isset($registerbornday) ? $registerbornday : "",
                            isset($registerbornmonth) ? $registerbornmonth : "",
                            isset($registerbornyear) ? $registerbornyear : "",
                            $registersex,
                            isset($bild) ? $bild : "Bild saknas",
                            $realpsw
                        );
                    }
                    // Slut om e-postadressen saknas i databasen.
                    else {
                        // Om e-postadressen hittades i databasen.
                        echo "<div class='alert alert-danger'>
                            Den här e-postadressen är redan registrerad.<br /> 
                              Varsågod logga in 
                              <a href='login.php'>här</a>.
                          </div>";
                    }

                    // Slut om e-postadressen hittades i databasen.
                }
                // Slut om lösenordet var längre eller lika med 6 tecken.
                else {
                    // Om lösenordet var mindre eller lika med 6 tecken.
                    echo "<div class='alert alert-danger'>
                                    Du skrev ett lösenord som är mindre än 6 tecken.<br />
                                    Skriv ett lösenord som är minst 6 tecken.
                                  </div>";
                }

                // Slut om lösenordet var mindre eller lika med 6 tecken.
            }
            // Slut om e-postadress var korrekt validerat.
            else {
                // Om e-postadressen var felaktig validerad.
                echo "    <div class='alert alert-danger'>
                            Du skrev felaktig e-postadress. Skriv en korrekt e-postadress.
                        </div>
                      ";
            } // Slut om e-postadressen var felaktig validerad.
        }

        // Slut om det finns samtliga data för registrering.
    }

// Slut om användare klickade på Registrera dig knappen.
?>


      </div>
  </div>
    <!-- Registreringsformulär -->
    <form action="<?= $_SERVER[
        'PHP_SELF'
    ] ?>" class="col-12 needs-validation" novalidate id="registerform" method="post" enctype="multipart/form-data">
      
          <div class="row mb-3 justify-content-center align-items-center">
              <label for="registerfname" class="col-form-label col-sm-4">Förnamn:*</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="registerfname" id="registerfname" required />
              </div>
          </div>

          <div class="row justify-content-center align-items-center">
                <label for="registerlname" class="col-form-label col-sm-4">Efternamn:*</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="registerlname" id="registerlname" required /><br />
                </div>
          </div>

          <div class="row mb-3 justify-content-center align-items-center">
                <label for="registerepost" class="col-form-label col-sm-4">E-postadress:*</label>
                <div class="col-sm-5">
                  <input type="email" class="form-control" name="registerepost" id="registerepost" required /><br />
                </div>
            </div>

            <div class="row mb-3 justify-content-center align-items-center">
                <label for="registermobnr" class="col-form-label col-sm-4">Mobilnummer:*</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="registermobnr" id="registermobnr" required /><br />
                </div>
            </div>

            <div class="row mb-3 justify-content-center align-items-center">
                <label for="registertfnr" class="col-form-label col-sm-4">Telefonnummer:*</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="registertfnr" id="registertfnr" required /><br />
                </div>
              </div>

            <div class="row mb-3 justify-content-center align-items-center">
              <label for="registerpsw" class="col-form-label col-sm-4">Lösenord:*</label>
              <div class="col-sm-5">
                <input autocomplete="on" type="password" class="form-control" name="registerpsw" id="registerpsw" required /><br />
              </div>
            </div>

            <div class="row mb-3 justify-content-center align-items-center">
                <label for="registerwork" class="col-form-label col-sm-4">Yrkestitel:*</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="registerwork" id="registerwork" required /><br />
                </div>
            </div>
          <div class="row mb-3 justify-content-center align-items-center">
                <label id="bornlabel" class="col-form-label col-sm-4">Födelsedatum:*</label>
                <div class="col-sm-2">
                  <select class="form-select mb-1" name="registerbornday" id="registerbornday" required>
                    <option value="">Dag</option>
                    <option value="">---</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                  </select>
                </div>
                <div class="col-sm-2">
                  <select name="registerbornmonth" class="form-select mb-1" id="registerbornmonth" required>
                    <option value="">Månad</option>
                    <option value="">-----</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Mars</option>
                    <option value="04">April</option>
                    <option value="05">Maj</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Augusti</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                 </div>
                 <div class="col-sm-1">
                  <select name="registerbornyear" class="form-select mb-1" id="registerbornyear" required>
                      <option value="">År</option>
                      <option value="">-----</option>
                      <option value="2020">2020</option>
                      <option value="2019">2019</option>
                      <option value="2018">2018</option>
                      <option value="2017">2017</option>
                      <option value="2016">2016</option>
                      <option value="2015">2015</option>
                      <option value="2014">2014</option>
                      <option value="2013">2013</option>
                      <option value="2012">2012</option>
                      <option value="2011">2011</option>
                      <option value="2010">2010</option>
                      <option value="2009">2009</option>
                      <option value="2008">2008</option>
                      <option value="2007">2007</option>
                      <option value="2006">2006</option>
                      <option value="2005">2005</option>
                      <option value="2004">2004</option>
                      <option value="2003">2003</option>
                      <option value="2002">2002</option>
                      <option value="2001">2001</option>
                      <option value="2000">2000</option>
                      <option value="1999">1999</option>
                      <option value="1998">1998</option>
                      <option value="1997">1997</option>
                      <option value="1996">1996</option>
                      <option value="1995">1995</option>
                      <option value="1994">1994</option>
                      <option value="1993">1993</option>
                      <option value="1992">1992</option>
                      <option value="1991">1991</option>
                      <option value="1990">1990</option>
                      <option value="1989">1989</option>
                      <option value="1988">1988</option>
                      <option value="1987">1987</option>
                      <option value="1986">1986</option>
                      <option value="1985">1985</option>
                      <option value="1984">1984</option>
                      <option value="1983">1983</option>
                      <option value="1982">1982</option>
                      <option value="1981">1981</option>
                      <option value="1980">1980</option>
                      <option value="1979">1979</option>
                      <option value="1978">1978</option>
                      <option value="1977">1977</option>
                      <option value="1976">1976</option>
                      <option value="1975">1975</option>
                      <option value="1974">1974</option>
                      <option value="1973">1973</option>
                      <option value="1972">1972</option>
                      <option value="1971">1971</option>
                      <option value="1970">1970</option>
                      <option value="1969">1969</option>
                      <option value="1968">1968</option>
                      <option value="1967">1967</option>
                      <option value="1966">1966</option>
                      <option value="1965">1965</option>
                      <option value="1964">1964</option>
                      <option value="1963">1963</option>
                      <option value="1962">1962</option>
                      <option value="1961">1961</option>
                      <option value="1960">1960</option>
                      <option value="1959">1959</option>
                      <option value="1958">1958</option>
                      <option value="1957">1957</option>
                      <option value="1956">1956</option>
                      <option value="1955">1955</option>
                      <option value="1954">1954</option>
                      <option value="1953">1953</option>
                      <option value="1952">1952</option>
                      <option value="1951">1951</option>
                      <option value="1950">1950</option>
                      <option value="1949">1949</option>
                      <option value="1948">1948</option>
                      <option value="1947">1947</option>
                      <option value="1946">1946</option>
                      <option value="1945">1945</option>
                      <option value="1944">1944</option>
                      <option value="1943">1943</option>
                      <option value="1942">1942</option>
                      <option value="1941">1941</option>
                      <option value="1940">1940</option>
                      <option value="1939">1939</option>
                      <option value="1938">1938</option>
                      <option value="1937">1937</option>
                      <option value="1936">1936</option>
                      <option value="1935">1935</option>
                      <option value="1934">1934</option>
                      <option value="1933">1933</option>
                      <option value="1932">1932</option>
                      <option value="1931">1931</option>
                      <option value="1930">1930</option>
                      <option value="1929">1929</option>
                      <option value="1928">1928</option>
                      <option value="1927">1927</option>
                      <option value="1926">1926</option>
                      <option value="1925">1925</option>
                      <option value="1924">1924</option>
                      <option value="1923">1923</option>
                      <option value="1922">1922</option>
                      <option value="1921">1921</option>
                      <option value="1920">1920</option>
                      <option value="1919">1919</option>
                      <option value="1918">1918</option>
                      <option value="1917">1917</option>
                      <option value="1916">1916</option>
                      <option value="1915">1915</option>
                      <option value="1914">1914</option>
                      <option value="1913">1913</option>
                      <option value="1912">1912</option>
                      <option value="1911">1911</option>
                      <option value="1910">1910</option>
                      <option value="1909">1909</option>
                      <option value="1908">1908</option>
                      <option value="1907">1907</option>
                      <option value="1906">1906</option>
                      <option value="1905">1905</option>
                    </select>
                  </div>
                </div>
        <div class="row mb-3">
          <label class="col-form-label col-sm-7">Kön:*</label>
          <div class="form-check">
              <input class="registersex" type="radio" name="registersex" value="Man" required />
              <label class="form-check-label">Man</label>
          </div>

          <div class="form-check">
              <input class="registersex" type="radio" name="registersex" value="Kvinna" required />
              <label class="form-check-label">Kvinna</label>
          </div>

        </div>

        <div class="row mb-3 justify-content-center align-items-center">
          <label class="col-form-label col-sm-4">Bild:</label>
          <div class="col-sm-5">
              <input type="file" name="registerimg" class="form-control col-sm-3 mx-auto" accept="image/*" id="registerimg" />
          </div>
        </div>  


          <input class="btn btn-primary mb-3 btn-lg" name="registerbtn" id="registerbtn" type="submit" value="Registrera dig" />
    </form>

  
  

  
  <?php require "Includes/footer.php"; ?>
           