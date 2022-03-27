<!doctype html>
<!--[if IE 9]><html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
<!--<![endif]--> 

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>DutaRESTO JukeBox</title>
  <link rel="icon" type="image/png" href="favicon.png?v=0.1" />
  <link rel="stylesheet" href="css/foundation.min.css" />
  <link rel="stylesheet" href="css/gear.css?v=0.1">
  <link rel="stylesheet" href="css/styles.css?v=0.1">
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body>
      <!-- Stage Start -->
      <div class="stage">
          <!-- Wrap Start -->
          <div class="wrap">
          <header>
            <!-- Desktop Navigation Start -->
            <nav class="top-bar row">
             <div class="logo"><span class="hide-for-small">DutaRESTO JukeBox</span><span class="show-for-small">Playlist Manager</span> </div>
             <hr>
            </nav>
            <!-- Desktop Navigation End -->
          </header>
          <!-- Content Start -->
          <div class="content">
                <div class="wrapper">
                <section id="demos">
                    <div class="row">
                      <div class="columns">
                        <h3>Sample Album</h3>
                        <hr>
                      </div>
                    </div>

                    <div class="row">
                      
                      <div class="large-4 medium-4 columns">
                          <div class="cover" data-gearPath="json/audiojungle.json">
                            <img width="600" height="450" src="img/covers/01.jpg">
                            <div class="over"><span class="floater"></span><i class="fi-play-circle"></i></div>
                          </div>

                          <div class="album">
                            <div>Feel the Sound</div> 
                            <span>Audio Jungle</span>
                          </div>
                      </div>

                      <div class="large-4 medium-4 columns">
                          <div class="cover" data-gearPath="json/audiotheque.json">
                            <img width="600" height="450" src="img/covers/hqdefault.jpg">
                            <div class="over"><span class="floater"></span><i class="fi-play-circle"></i></div>
                          </div>

                          <div class="album">
                            <div>Audiotheque</div> 
                            <span>Creative Commons</span>
                          </div>
                      </div>

                      <div class="large-4 medium-4 columns">
                          <div class="cover playing" data-gearPath="json/soundcloud.json">
                            <img width="600" height="450" src="img/covers/03.jpg">
                            <div class="over"><span class="floater"></span><i class="fi-play-circle"></i></div>
                          </div>

                          <div class="album">
                            <div>Lost Sounds</div> 
                            <span>Creative Commons</span>
                          </div>
                      </div>

                    </div>
                </section>

                <footer>
                    <div class="row">
                      <div class="large-12 medium-12 small-12 columns">
                        <p>© 2015 DutaRESTO.</p>
                      </div>
                    </div>
                  </footer>

                </div>
              </div>
          </div>
          <!-- Content End -->

          <div class="overlay"><span></span></div>

      </div>
      <!-- Stage Wrapper End -->


  <!-- Gear Player Start -->
   <div class="gearWrap"> <div id="gearContainer" class="gear" data-gear="json/setup.json"></div> </div>
  <!-- Gear Player End -->


  <script src="js/jquery.min.js"></script>
  <script src="js/foundation.min.js"></script>
  <script src="http://connect.soundcloud.com/sdk.js"></script>
  <script src="js/jquery.gearplayer.libs.min.js"></script>
  <script src="js/jquery.gearplayer.min.js"></script>
  <script src="js/app.js"></script>

</body>
</html>
