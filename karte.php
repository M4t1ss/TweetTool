<h2 style='margin:auto auto; text-align:center;'>Tweet map</h2>
<br/>
<?php
//Paņem dažādās vietas
$q = mysql_query("SELECT distinct geo, count( * ) skaits FROM `tweets` WHERE geo!='' GROUP BY geo ORDER BY count( * ) DESC");
?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
			function initialize() {
				var latlng = new google.maps.LatLng(56.9465363, 24.1048503);
				var settings = {
					zoom: 2,
					center: latlng,
					mapTypeId: google.maps.MapTypeId.ROADMAP};
				var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
<?php
				$i=0;
				while($r=mysql_fetch_array($q)){
				   $vieta=$r["geo"];
				   $skaits=$r["skaits"];
				   if ($skaits==1) {$tviti=" tweet";} else {$tviti=" tweets";}
					$irvieta = mysql_query("SELECT * FROM vietas where nosaukums='$vieta'");
					if(mysql_num_rows($irvieta)==0){
						//ja nav tādas vietas datu bāzē,
						//dabū vietas koordinātas
						$string = file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".str_replace(" ", "%20",$vieta)."&sensor=true");
						$json=json_decode($string, true);
						$gar = sizeof($json["results"][0]["address_components"]);
						for ($z = 0; $z < $gar; $z++){
							if($json["results"][0]["address_components"][$z]['types'][0] == 'country') $valsts = $json["results"][0]["address_components"][$z]['long_name'];
						}
						$lat = $json["results"][0]["geometry"]["location"]["lat"];
						$lng = $json["results"][0]["geometry"]["location"]["lng"];
						if ($lat!=0 && $lng!=0){
							$ok = mysql_query("INSERT INTO vietas (nosaukums, lng, lat, valsts) VALUES ('$vieta', '$lng', '$lat', '$valsts')");
						}
						}else{
							$arr=mysql_fetch_array($irvieta);
							//ja ir
							$lat = $arr['lat'];
							$lng = $arr['lng'];
						}
					if ($lat & $lng){
					?>
					//Apraksts
					var contentString<?php echo $i;?> = '<a href="/<?php echo $tweettool_path; ?>/vieta/<?php echo $vieta;?>"><?php echo $vieta." - ".$skaits.$tviti;?>';
					var infowindow<?php echo $i;?> = new google.maps.InfoWindow({
						content: contentString<?php echo $i;?>
					});
						
					//Atzīmē vietu kartē
					var parkingPos = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lng;?>);
					var marker<?php echo $i;?> = new google.maps.Marker({
						position: parkingPos,
						map: map,
						title:"<?php echo $vieta;?>"
					});
					google.maps.event.addListener(marker<?php echo $i;?>, 'click', function() {
					  infowindow<?php echo $i;?>.open(map,marker<?php echo $i;?>);
					});
					<?php
					$i=$i+1;
					}
				}
?>
			}
		</script>
		<div id="map_canvas" style="margin:auto auto; width:950px; height:520px"></div>