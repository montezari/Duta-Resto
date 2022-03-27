<link link rel="stylesheet" href="css/gear.css">
</head>
<body>
<div class="stage">
	<div class="gearWrap"> <div id="gearContainer" class="gear" data-gear="json/setup.json"></div> </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="http://connect.soundcloud.com/sdk.js"></script>
<script src="js/jquery.gearplayer.libs.min.js"></script>
<script src="js/jquery.gearplayer.min.js"></script>
<script>
$(document).ready(function(){ 
    $('.gearWrap').gearPlayer();
});
</script>