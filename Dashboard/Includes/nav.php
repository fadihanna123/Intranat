<!-- Dashboardnavigeringsmeny -->
<?php 

      if (isset($_SESSION['loginuname']))
      { // Om man är inloggad
        $page = $_SERVER['REQUEST_URI'];
        echo '<nav class="jumbotron navbar navbar-expand-md navbar-light m-4 p-4 dashboardnav d-flex">
          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#dashboardnav">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse text-center" id="dashboardnav">
            <ul class="navbar-nav dashboardul flex-column">
              <li class="nav-item">
                <a class="firstlink nav-link font-weight-bold navlinks" href="index.php">
                  <img src="Images/Ikoner/house.png" class="icon img-fluid" alt="Hemsikonen" />
                  Hem
                </a>
              </li>
                  <li class="nav-item">
                    <a class="nav-link font-weight-bold navlinks" href="news.php">
                      <img src="Images/Ikoner/news.png" class="icon img-fluid" alt="Nyhetersikon" />
                          Nyheter
                    </a>
                  </li>

                  <li class="nav-item">
                        <a class="nav-link font-weight-bold navlinks" href="filarkiv.php">
                          <img src="Images/Ikoner/arkiv.png" class="icon img-fluid" alt="Filarkivsikon" />
                          Filarkiv
                        </a>
                  </li> 
                      
                  <li class="nav-item">
                        <a class="nav-link font-weight-bold navlinks" href="staff.php">
                          <img src="Images/Ikoner/staff.png" class="icon img-fluid" alt="Personalsikon" />
                            Personal
                        </a>
                   </li>
                  
                  
                  <li class="nav-item">
                    <a class="nav-link font-weight-bold navlinks" href="report.php">
                      <img src="Images/Ikoner/register.png" class="icon img-fluid" alt="Anmälan" />
                        Anmälan
                      </a>
                    </li> 

                    <li class="nav-item">
                      <a class="nav-link faqlink font-weight-bold navlinks" href="FAQ.php">
                        <img src="Images/Ikoner/help.png" class="icon img-fluid" alt="Hjälpikonen" />
                        FAQ
                      </a>
                    </li> 

                    <li class="nav-item">
                      <a class="nav-link settingsicon font-weight-bold navlinks" href="accountsettings.php">
                      <img src="Images/Ikoner/settings-1.png" class="icon img-fluid" alt="Kontoinställningarsikonen" />
                            Mitt konto
                      </a>
                    </li>
                <li class="nav-item" style="z-index: 1; position: relative;">
                  <a class="nav-link font-weight-bold navlinks" href="admin.php">
                    <img src="Images/Ikoner/admin.png" class="icon img-fluid" alt="Administratörsikon" />
                      Adminpanel
                  </a>
                </li> 
                </ul>
                </div>  
              </nav>
              <br />';

       
      } // Slut om man är inloggad.
      else
      { // Om man inte är inloggad.
        header("location: ../login.php?msg=true");
      } // Slut om man inte är inloggad.
?>