<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="../../styles/pdf.css" rel="stylesheet">
</head>
<body>
<?php 
//Global
try{
	require_once 'class/class.imageCreator.php';
//656 = Page-Width
$ic=new imageCreator(656);
}catch(EXCEPTION $e){}
?>
	<!-- Frontpage -->
	<div class="exposePage">		
		<div class="header">
			<table class="headerTable">
				<tr>
					<td><span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span></td><td><span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span></td>
				</tr>					
			</table>
		</div>
		<div class="content">
			<div class="frontImageWrapper" style="height:700px;">
			<?php 				
				if(isset($content["images"]["front"][0]["imagePath"])){
					$ic->setImageWrapper(700);
					$image = $ic->newImage("../".$content["images"]["front"][0]["imagePath"], "");
					if($image!=false){
						$image->setImageSize($ic->__get("imageWrapper"));
						echo $image->showImage($ic->__get("imageWrapper"));
					}
				} 
			?>
			</div>
			<div class="frontTitle">
				<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
				<span class="address"><?php echo $content["strasse"]; ?> &bull; </span>
				<span class="address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
				<span class="address"><?php echo $content["bezirk"]; ?></span>
				<span class="address">(<?php echo $content["short"]; ?>)</span>
			</div>
			<div class="frontOverview">
				<table>
					<tr>
						<td>Wohnfläche</td><td>ca. <?php echo $content["wohnflaeche"]; ?> m²</td>
					</tr>
				<?php if(isset($content["zimmer"]) && $content["zimmer"]>0){ ?>
					<tr>
						<td>Zimmer</td><td><?php echo $content["zimmer"]; ?></td>
					</tr>
				<?	}	?> 
					<tr>
						<td>Kaufpreis</td><td><?php echo number_format($content["kaufpreis"],0, ',', '.'); ?> EUR</td>
					</tr>
					<tr><td colspan="2" style="text-align: left;">www.immobilien-expose.org</td></tr>
				</table>
			</div>
		</div>
	</div>
	
	<!-- erste Seite mit Eckdaten und Courtage -->		
	<div class="exposePage">		
		<div class="header">
			<table class="headerTable">
				<tr>
					<td style="padding-bottom: -2px;">
						<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
					</td><td></td>
				</tr><tr>					
					<td style="padding-top: -5px;">
						<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["bezirk"]; ?></span>
					</td><td>
						<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
					</td>
				</tr>					
			</table>		
		</div>
		<div class="content">
			<div class="imageWrapper" style="height:460px;">
				<div>
			<?php 
			$k=0;
			$ic->setImageWrapper(450);
			$image=$ic->newImage("../upload/".$content["objectID"]."/lage.png", "Lageplan");
			if($image==false){
				$image=$ic->newImage("../".$content["images"]["object"][$k]["imagePath"], $content["images"]["object"][$k]["title"]);
				if($image!=false){
					$k++;
				}
			}
			if($image!=false){
				if($image->setImageSize($ic->__get("imageWrapper"))){
					echo $image->showImage($ic->__get("imageWrapper"));
					echo $image->showTitle($ic->__get("imageWrapper"));
				}
			}			
			?>
				</div>	
			</div>	
			<div class="container" style="height:180px;">
				<span class="subTitle">Eckdaten</span>
				<div class="maindata">
					<div class="tableWrapper">
						<table>
							<tr>
								<td>&bull;</td><td>Wohnfläche</td><td>ca <?php echo $content["wohnflaeche"]; ?> m²</td>
							</tr>
						<?php if(isset($content["zimmer"]) && $content["zimmer"]>0){ ?>
							<tr>
								<td>&bull;</td><td>Zimmer</td><td><?php echo $content["zimmer"]; ?></td>
							</tr>
						<?	}	?> 
							<tr>
								<td>&bull;</td><td>Wohngeld</td><td>ca. <?php echo number_format($content["nebenkosten"],2, ',', '.'); ?> EUR</td>
							</tr>
							<tr>
								<td>&bull;</td><td>Kaufpreis</td><td class="nowrap"> <?php echo number_format($content["kaufpreis"],2, ',', '.'); ?> EUR</td>
							</tr>
							<?php if($content["energiewert"]>0){?>
							<tr>
								<td>&bull;</td><td><?php echo ( (isset($content["energieausweisTyp"]) && $content["energieausweisTyp"]=="Bedarfsausweis")?("Endenergiebedarf"):("Energieverbrauchskennwert"))?></td>
								<td><?php echo $content["energiewert"]; ?>kWh/m²</td>
							</tr>
							<?php }?>
							<?php if($content["kaution"]>0){?>
							<tr>
								<td>&bull;</td><td>Kaution</td><td><?php echo $content["kaution"]." ".strtoupper($content["kautionEinheit"]); ?></td>
							</tr>
							<?php }?>
							<?php if(isset($content["denkmalschutz"]) && $content["denkmalschutz"]=="on"){?>							
							<tr>
								<td>&bull;</td><td>Denkmalschutz</td><td>kein Energieausweis nötig</td>
							</tr>
							<?php }?>
						</table>
					</div>
					<div class="tableWrapper">
						<table>
							<tr>
								<td>&bull;</td><td>Baujahr</td><td><?php echo ($content["baujahr"]==0)?("o.A."):($content["baujahr"]); ?></td>
							</tr>
							<?php if($content["stockwerk"]>0){?>
							<tr>
								<td>&bull;</td><td>Geschoss</td><td><?php echo $content["stockwerk"]; ?></td>
							</tr>
							<?php  } ?>
							<tr>								
								<td>&bull;</td><td>Lieferung</td><td><?php if($content["lieferung"]==0){echo "freie Lieferung";}else{echo date("d.m.Y",strtotime($content["lieferung"]));}; ?></td>									
							</tr>
							<?php if($content["heizung"]>0 || $content["heizung"]!=""){?>
							<tr>
								<td>&bull;</td><td>Heizung</td><td><?php echo $content["heizung"]; ?></td>									
							</tr>
							<?php  } ?>
							<?php if($content["stellplatz"]>0){?>
							<tr>
								<td>&bull;</td><td>Stellplätze</td><td><?php echo $content["stellplatz"]; ?></td>							
							</tr>
							<tr>
								<td>&bull;</td><td>Stellplatzkosten</td><td><?php if($content["stellplatzkosten"]==0){echo "inkl.";}else{ echo number_format($content["stellplatzkosten"],2, ',', '.')." EUR"; } ?></td>
							</tr>
							<?php }?>							
								
							
							
						</table>
					</div>
				</div>					
			</div>
			<div class="container">
				<div class="halfBox">
					<span class="subTitle">Courtagepassus</span>
					<p style="margin-right:5px;font-size:10px;word-break: normal;text-align:justify;display: none;">
						Die Courtage in Höhe von <?php echo $content["provision"].strtoupper($content["provisionEinheit"]); ?> inkl. der gesetzlichen Mehrwertsteuer auf den Kaufpreis ist mit dem Zustandekommen des Kaufvertrages 
						(notarieller Vertragsab-schluss) verdient und fällig. Die Vermittelnden und/oder Nachweisenden, EuV Residential Berlin GmbH 
						(Lizenznehmer der Engel & Völkers Residential GmbH) und ggf. deren Beauftragter, erhalten einen unmittelbaren Zahlungsanspruch gegenüber 
						dem Käufer (Vertrag zugunsten Dritter, § 328 BGB). Alle Angaben sind ohne Gewähr und basieren ausschließlich auf Informationen, 
						die uns von unserem Auftraggeber zur Verfügung gestellt wurden. Wir übernehmen keine Gewähr für die Vollständigkeit, Richtigkeit und Aktualität 
						dieser Angaben. Die Grunderwerbsteuer, Notar- und Grundbuchkosten sind vom Käufer zu tragen. Im Übrigen gelten die auf der Rückseite 
						abgedruckten Allgemeinen Geschäftsbedingungen. Irrtum und Zwischenverkauf vorbehalten.
					</p>
				</div>
				<div class="halfBox">
					<span class="subTitle">Hinweise</span>	
					<p style="font-size:10px;word-break: normal;text-align:justify;">
						Alle Angaben sind ohne Gewähr und basieren ausschließlich auf Informationen, die uns von unserem Auftraggeber übermittelt wurden. 
						Wir übernehmen keine Gewähr für die Vollständigkeit, Richtigkeit und Aktualität dieser Angaben. Zwischenvermietung bleibt vorbehalten. 
						Sollte das von uns nachgewiesene Objekt bereits bekannt sein, teilen Sie uns dieses bitte unverzüglich mit. Die Weitergabe dieses Exposees 
						an Dritte ohne unsere Zustimmung löst gegebenenfalls Courtage- bzw. Schadensersatzansprüche aus. Im übrigen gelten die allgemeinen 
						Geschäftsbedingungen für die Rechtsbe-ziehung zwischen Ihnen und EuV Residential Berlin GmbH. Wir stehen Ihnen mit weiteren Informationen 
						zum Objekt und zum Eigentümer sowie für Besichtigungen gern zur Verfügung.
					</p>
				</div>
			</div>
		</div>
		
		<div class="footer">
			<table class="headerTable" style="display: none;">
				<tr>
					<td>
						<span class="address block">Engel & Völkers Berlin</span>
						<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
						<div style="height:5px;"></div>
						<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
						<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
						<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
					</td><td>
						<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
					</td>
				</tr>					
			</table>					
		</div>
	</div>
	
	
	<div class="exposePage">	
	<!--  zweite Seite - Ausstattung und Bad und Küche -->
		<div class="header">
			<table class="headerTable">
				<tr>
					<td style="padding-bottom: -2px;">
						<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
					</td><td></td>
				</tr><tr>					
					<td style="padding-top: -5px;">
						<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["bezirk"]; ?></span>
					</td><td>
						<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
					</td>
				</tr>					
			</table>	
		</div>
		<div class="content">
			<div class="maindata">
				<table class="tableCenter">
			<?php
				$image1=false;
				$image2=false;
				$ic->setImageWrapper(420);
				if(isset($content["images"]["object"][$k])){
					$image1=new image("../".$content["images"]["object"][$k]["imagePath"], $content["images"]["object"][$k]["title"]);
				}
				if(isset($content["images"]["object"][$k+1])){
					$image2=new image("../".$content["images"]["object"][$k+1]["imagePath"], $content["images"]["object"][$k+1]["title"]);
				}
				$gall=$ic->checkGallery(array( $image1,$image2));
				
				if($gall!==false && is_array($gall)){		
					echo "<tr>";
					foreach($gall["images"] as $x=>$imgObj){
						$tdWidth=$gall["cols"][$x];
						echo '<td style="width:'.$tdWidth.'%;">';
						?>									
							<div class="imageWrapperLarge" style="height:430px">
								<div>
								<?php
									echo $imgObj->showImage($ic->__get("imageWrapper"));
									echo $imgObj->showTitle($ic->__get("imageWrapper"));
								?>								
								</div>								
							</div>
						</td>
						<?php
						$k++;
					}
					echo '</tr>';
				}
				
				?>
						
				</table>
				<br>
				<div class="container">
					<span class="subTitle">Ausstattung</span>
					<div class="maindata">
						<p>
							<?php 
								if(isset($content["manualTextAusstattung"])){
									echo $content["manualTextAusstattung"];
								}
							?>
						</p>
						<div class="tableWrapper2">
							<table>
								
								<?php if($content["balkon"]!=null && $content["balkon"]>0 && $content["aussenflaeche_balkon"]>0){?>
								<tr>
									<td>&bull;</td><td>Balkon</td><td><?php echo $content["balkon"]; ?></td>							
									<td>&bull;</td><td>Außenfläche</td><td><?php echo $content["aussenflaeche_balkon"]; ?> m²</td>
								</tr>
								<?php }?>
								<?php if($content["terrasse"]!=null && $content["terrasse"]>0 && $content["aussenflaeche_Terrasse"]>0){?>
								<tr>
									<td>&bull;</td><td>Terrasse</td><td><?php echo $content["terrasse"]; ?></td>							
									<td>&bull;</td><td>Außenfläche</td><td><?php echo $content["aussenflaeche_Terrasse"]; ?> m²</td>
								</tr>
								<?php }?>							
								<tr>		
								<?php 
									if($content["decke"]!=null && $content["decke"]>0){
										$arrAusstattung[] =  array("name"=>"Deckenhöhe","val"=>$content["decke"]." m");
									}
									if($content["schlafzimmer"]!=null && $content["schlafzimmer"]>0){
										$arrAusstattung[] =  array("name"=>"Schlafzimmer","val"=>$content["schlafzimmer"]);
									}
									$innenausstattung = explode(",", $content["innenausstattung"]);
									
									$ausstattung = array_merge($arrAusstattung,$innenausstattung);
									$boden = explode(",", $content["boden"]);
									$counter=0;
									$lastElement=end($boden);
									foreach ($boden as $keyB=>$valB){
										$newArray[$counter]=$valB;
										if($valB!=$lastElement){
											$counter=$counter+2;
										}
									}
									$counter=0;								
									foreach ($ausstattung as $keyA=>$valA){
										WHILE(isset($newArray[$counter])){
											$counter++;
										}
										$newArray[$counter]=$valA;
										$counter++;
										
									}
									ksort($newArray);
									$ausstattungboden = $newArray;		
									foreach($ausstattungboden as $a => $b) {
										if($b == 'Keller' || $b == 'Hauswirtschaftsraum') {
											$item = $ausstattungboden[$a];
											unset($ausstattungboden[$a]);
											array_push($ausstattungboden, $item);
										}
									}					
									$i=1;
									foreach($ausstattungboden as $point){
										if($point==""){continue;}
										if(is_array($point)){
											echo "<td>&bull;</td><td style='text-align:left'>".$point["name"]."</td><td>".$point["val"]."</td>";
										}else{
											echo "<td>&bull;</td><td style='text-align:left'>".$point."</td><td></td>";
										}								
										
										if($i%2==0){
											echo "</tr><tr>";
										}
										
										$i++;
									}
								?>
								</tr>
							</table>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="maindata">	
						<?php  
						if(isset($content["kueche"]) && $content["kueche"]>0 && isset($content["kuecheausstattung"]) && trim($content["kuecheausstattung"]) != ""){?>						
							<span class="subTitle">Küche</span>
							<table>
							<?php					
								echo "<tr><td>&bull;</td><td colspan='2' style='text-align:left;'>".str_replace(",", ", ", $content["kuecheausstattung"])."</td></tr>";			
								if(isset($content["kueche_freitext"]) && trim($content["kueche_freitext"])!=""){
									echo "<tr><td>&bull;</td><td colspan='2' style='text-align:left;'>".str_replace(",", ", ", $content["kueche_freitext"])."</td></tr>";
								}
							?>
							</table>
						<?php }?>							
					</div>
					<br>
					<div class="maindata">
						<?php 
							$baeder = $content["badausstattung"];						
							if(is_array($baeder) && count($baeder)>0 && $baeder[0]!=""){
						?>
						<span class="subTitle"><?php if(count($baeder)>1){echo "Bäder";}else{echo "Bad";}?></span>
						<table>
							<?php 
							foreach($baeder as $key=>$bad){							
								echo "<tr><td>&bull;</td><td colspan='2' style='text-align:left;'>".$bad."</td></tr>";							
							}
							?>
						</table>
					<?php } ?>												
					</div>
				</div>
				
			</div>
			
		</div>
		
		<div class="footer">
			<table class="headerTable" style="display: none;">
				<tr>
					<td>
						<span class="address block">Engel & Völkers Berlin</span>
						<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
						<div style="height:5px;"></div>
						<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
						<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
						<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
					</td><td>
						<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
					</td>
				</tr>					
			</table>					
		</div>
	</div>
	<div class="exposePage">	
	<!--  dritte Seite - Lage -->
		<div class="header">
			<table class="headerTable">
				<tr>
					<td style="padding-bottom: -2px;">
						<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
					</td><td></td>
				</tr><tr>					
					<td style="padding-top: -5px;">
						<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["bezirk"]; ?></span>
					</td><td>
						<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
					</td>
				</tr>					
			</table>	
		</div>
		<div class="content">
		<?php
			$m=0;		
			$a=0;
			$san=false;
			if(isset($content["images"]["sanitaer"][$m]["imagePath"])){
				$a=$m;							
				$object=$content["images"]["sanitaer"];
				$san=true;
			}else if(isset($content["images"]["object"][$k]["imagePath"])){
				$a=$k;				
				$object=$content["images"]["object"];				
			}	
			?>
			<div class="maindata">			
				<table class="tableCenter">
				<?php
				$image1=false;
				$image2=false;
				$ic->setImageWrapper(350);
				if(isset($object[$a])){
					$image1=new Image("../".$object[$a]["imagePath"], $object[$a]["title"]);
				}
				if(isset($object[$a+1])){
					$image2=new Image("../".$object[$a+1]["imagePath"], $object[$a+1]["title"]);
				}
				$gall=$ic->checkGallery(array( $image1,$image2));
				
				if($gall!==false && is_array($gall)){		
					echo "<tr>";
					foreach($gall["images"] as $x=>$imgObj){
						$tdWidth=$gall["cols"][$x];
						echo '<td style="width:'.$tdWidth.'%;">';
						?>									
							<div class="imageWrapper">
								<div>
								<?php
									echo $imgObj->showImage($ic->__get("imageWrapper"));
									echo $imgObj->showTitle($ic->__get("imageWrapper"));
								?>								
								</div>								
							</div>							
						</td>
						<?php
						if($san===true){$m++;}else{$k++;}
					}
					echo '</tr>';
				}				
				?>
				</table>
			
				<div class="container" style="margin-top: 150px;">
					<span class="subTitle">Lagebeschreibung</span>
					<!-- <table class="tableCenter lage">
						<tr>
							<td style="width:50%">
								<ul>
									<li>&bull;<span>Der im Zuge der Fusionierung am 01. Januar 2001 gegründete Bezirk ist mit über 300.000 Einwohnern der vierte Verwaltungsbezirk Berlins.</span></li>
									<li>&nbsp;</li>
									<li>&bull;<span>Zahlreiche Sehenswürdigkeiten wie die Kaiser-Wilhelm Gedächtniskirche, die Deutsche Oper, das Schloss Charlottenburg 
									oder das Olympiastadion locken jährlich zahlreiche Touristen aus aller Welt in die dt. Hauptstadt.</span></li>
								</ul>
							</td>
							<td style="width:50%">
								<ul>
									<li>&bull;<span>Die Altbauwohnung befindet sich in begehrter und zentraler Wohnlage in einer ruhigen Anwohnerstraße in Charlottenburg.</span></li>
									<li>&bull;<span>Der berühmte Kurfürstendamm mit Läden namhafter Designer ist nur wenige Minuten entfernt.</span></li>
									<li>&bull;<span>Teile Londons bilden eine Städtepartnerschaft mit Charlottenburg-Wilmersdorf.</span></li>
								</ul>
							</td>
						</tr>
					</table>
					-->
					<p style="text-align: justify; padding:0 50px 0 0;display: none">
					Charlottenburg – Wilmersdorf:
					Der im Zuge der Fusionierung  am 01. Januar 2001 gegründete Bezirk ist mit über 300.000 Einwohnern der  vierte Verwaltungsbezirk Berlins.
					Zahlreiche Sehenswürdigkeiten wie die Kaiser-Wilhelm Gedächtniskirche,  die Deutsche Oper, 
					das Schloss Charlottenburg oder das Olympiastadion locken jährlich zahlreiche Touristen aus aller Welt in die dt. Hauptstadt. 
					Die Wohnung befindet sich in begehrter und zentraler Wohnlage im beliebten Bezirk Charlottenburg -Wilmersdorf. 
					Teile Londons  bilden eine Städtepartnerschaft mit Charlottenburg-Wilmersdorf und zeichnen dadurch zusätzlich viele Orte dieses Bezirks aus.
										
					</p>
				</div>
			</div>
		</div>
		<div class="footer">
			<table class="headerTable" style="display: none;">
				<tr>
					<td>
						<span class="address block">Engel & Völkers Berlin</span>
						<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
						<div style="height:5px;"></div>
						<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
						<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
						<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
					</td><td>
						<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
					</td>
				</tr>					
			</table>					
		</div>
	</div>
	<?php
		$count=0;
		if(isset($content["images"]["object"])){
			$count= count($content["images"]["object"]);
		}
		WHILE($k<$count){
	?>
	<div class="exposePage">	
	<!-- restliche Bilder -->
		<div class="header">
			<table class="headerTable">
				<tr>
					<td style="padding-bottom: -2px;">
						<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
					</td><td></td>
				</tr><tr>					
					<td style="padding-top: -5px;">
						<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["bezirk"]; ?></span>
					</td><td>
						<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
					</td>
				</tr>					
			</table>	
		</div>
		<div class="content">
		<?php	
			$san=false;
			if(isset($content["images"]["sanitaer"][$m]["imagePath"])){
				$a=$m;							
				$object=$content["images"]["sanitaer"];
				$san=true;
			}else if(isset($content["images"]["object"][$k]["imagePath"])){
				$a=$k;				
				$object=$content["images"]["object"];				
			}else{
				goto Seitenende;
			}
		?>
			<br>
			<div class="maindata">			
				<table class="tableCenter">
				<?php
				$image1=false;
				$image2=false;
				$ic->setImageWrapper(400);
				if(isset($object[$a])){
					$image1=new Image("../".$object[$a]["imagePath"], $object[$a]["title"]);
				}
				if(isset($object[$a+1])){
					$image2=new Image("../".$object[$a+1]["imagePath"], $object[$a+1]["title"]);
				}
				$gall=$ic->checkGallery(array( $image1,$image2));
				if($gall!==false && is_array($gall)){		
					echo "<tr>";
					foreach($gall["images"] as $x=>$imgObj){
						$tdWidth=$gall["cols"][$x];
						echo '<td style="width:'.$tdWidth.'%;">';
						?>									
							<div class="imageWrapperLarge">
								<div>
								<?php
									echo $imgObj->showImage($ic->__get("imageWrapper"));
									echo $imgObj->showTitle($ic->__get("imageWrapper"));
								?>								
								</div>								
							</div>
						</td>
						<?php
						if($san===true){$m++;}else{$k++;}
					}
					echo '</tr>';
				}				
				?>						
				</table>
			</div>
			<?php	
			$san=false;
			if(isset($content["images"]["sanitaer"][$m]["imagePath"])){
				$a=$m;							
				$object=$content["images"]["sanitaer"];
				$san=true;
			}else if(isset($content["images"]["object"][$k]["imagePath"])){
				$a=$k;				
				$object=$content["images"]["object"];				
			}else{
				goto Seitenende;
			}
		?>
			<div class="maindata">			
				<table class="tableCenter">
				<?php
				$image1=false;
				$image2=false;
				$ic->setImageWrapper(400);
				if(isset($object[$a])){
					$image1=new Image("../".$object[$a]["imagePath"], $object[$a]["title"]);
				}
				if(isset($object[$a+1])){
					$image2=new Image("../".$object[$a+1]["imagePath"], $object[$a+1]["title"]);
				}
				$gall=$ic->checkGallery(array( $image1,$image2));
				
				if($gall!==false && is_array($gall)){		
					echo "<tr>";
					foreach($gall["images"] as $x=>$imgObj){
						$tdWidth=$gall["cols"][$x];
						echo '<td style="width:'.$tdWidth.'%;">';
						?>									
							<div class="imageWrapperLarge">
								<div>
								<?php
									echo $imgObj->showImage($ic->__get("imageWrapper"));
									echo $imgObj->showTitle($ic->__get("imageWrapper"));
								?>								
								</div>								
							</div>
						</td>
						<?php
						if($san===true){$m++;}else{$k++;}
					}
					echo '</tr>';
				}				
				?>						
				</table>
			</div>
		<?php Seitenende:?>
		</div>
		<div class="footer">
			<table class="headerTable" style="display: none;">
				<tr>
					<td>
						<span class="address block">Engel & Völkers Berlin</span>
						<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
						<div style="height:5px;"></div>
						<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
						<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
						<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
					</td><td>
						<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
					</td>
				</tr>					
			</table>					
		</div>
	</div>
	<?php } ?>
	<!-- GRUNDRISS -->
	<?php
		$k=0;
		$count=0;
		if(isset($content["images"]["grundriss"])){
			$count= count($content["images"]["grundriss"]);
		}
		WHILE($k<$count){
			
	?>
		<div class="exposePage">
			<div class="header">
				<table class="headerTable">
					<tr>
						<td style="padding-bottom: -2px;">
							<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
						</td><td></td>
					</tr><tr>					
						<td style="padding-top: -5px;">
							<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
							<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
							<span class=" address"><?php echo $content["bezirk"]; ?></span>
						</td><td>
							<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
						</td>
					</tr>					
				</table>	
			</div>
			<div class="content">			
				<?php				
				if(isset($content["images"]["grundriss"][$k])){
					$ic->setImageWrapper(800);
					$image = $ic->newImage("../".$content["images"]["grundriss"][$k]["imagePath"], "");
					if($image!=false){
						$image->setImageSize($ic->__get("imageWrapper"));
				?>
				<span class="subTitleSmall">Grundriss <?php  echo ($content["images"]["grundriss"][$k]["title"]>0?"(".$content["images"]["grundriss"][$k]["title"].")":""); ?></span>	
				
				<div class="imageWrapperXLarge">					
					<?php echo $image->showImage($ic->__get("imageWrapper"));	?>					
					<span class="imgTitleSmall">
						Der Grundriss ist nicht maßstabsgerecht. Diese Unterlagen wurden uns vom Auftraggeber übergeben.<br>
						Für die Richtigkeit der Angaben können wir daher keine Gewähr übernehmen.
					</span>
				</div>							
				
				<? }} ?>	
				
			</div>
			
			<div class="footer">
				<table class="headerTable" style="display: none;">
					<tr>
						<td>
							<span class="address block">Engel & Völkers Berlin</span>
							<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
							<div style="height:5px;"></div>
							<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
							<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
							<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
						</td><td>
							<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
						</td>
					</tr>					
				</table>					
			</div>
		</div>
	<?php $k++;
		}
	if(isset($content["images"]["energie"][0])){
		foreach($content["images"]["energie"] as $pageID=>$energie){?>
		<div class="exposePage">
			<!-- ENERGIEAUSWEIS -->
			<div class="header">
				<table class="headerTable">
					<tr>
						<td style="padding-bottom: -2px;">
							<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
						</td><td></td>
					</tr><tr>					
						<td style="padding-top: -5px;">
							<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
							<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
							<span class=" address"><?php echo $content["bezirk"]; ?></span>
						</td><td>
							<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
						</td>
					</tr>					
				</table>	
			</div>
			<div class="content">
				
				<?php
				if(isset($energie)){
					$ic->setImageWrapper(800);
					$image = $ic->newImage("../".$energie["imagePath"], "");
					if($image!=false){
					$image->setImageSize($ic->__get("imageWrapper"));
				?>
				<span class="subTitleSmall"><?php  echo $energie["title"]; ?></span>
							
				<div class="imageWrapperXLarge">					
						<?php echo $image->showImage($ic->__get("imageWrapper"));	?>					
				</div>							
						
				<? }} ?>			
				
			</div>
			
			<div class="footer">
				<table class="headerTable" style="display: none;">
					<tr>
						<td>
							<span class="address block">Engel & Völkers Berlin</span>
							<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
							<div style="height:5px;"></div>
							<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
							<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
							<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
						</td><td>
							<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
						</td>
					</tr>					
				</table>					
			</div>
		</div>
	<?php 
		}
	}?>
	
	<div class="exposePage">
		<!-- Widerruf -->
		<div class="header">
			<table class="headerTable">
				<tr>
					<td style="padding-bottom: -2px;">
						<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
					</td><td></td>
				</tr><tr>					
					<td style="padding-top: -5px;">
						<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["bezirk"]; ?></span>
					</td><td>
						<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
					</td>
				</tr>					
			</table>	
		</div>
		<div class="content widerruf">			
			<span class="subTitle">Widerrufsbelehrung</span>
			<!-- 
			<span class="subTitleSmall">Widerrufsrecht</span>
			<p>
				Sie haben das Recht, binnen vierzehn Tagen ohne Angabe von Gründen diesen Vertrag zu widerrufen. 
				Die Widerrufsfrist beträgt vierzehn Tage ab dem Tag des Vertragsabschlusses.
			</p>
			<p>
				Um Ihr Widerrufsrecht auszuüben, müssen Sie uns, EuV Residential Berlin GmbH,Bleibtreustr.34/3,10707Berlin,Tel.030-203461500, Fax.030-20346155, E-Mail: BerlinCharlotenburg@engelvoelkers.com 
				mittels einer eindeutigen Erklärung (z.B. ein mit der Post versandter Brief, Telefax oder E-Mail) über Ihren Entschluss, den Vertrag zu widerrufen, informieren.
			</p>
			<p>
				Zur Wahrung der Widerrufsfrist reicht es aus, dass Sie die Mitteilung über die Ausübung des Widerrufsrechts vor Ablauf der Widerrufsfrist absenden.
			</p>
			<span class="subTitleSmall">Folge des Widerrufs</span>
			<p>
				Wenn Sie diesen Vertrag widerrufen, haben wir Ihnen alle Zahlungen, die wir von Ihnen erhalten haben, unverzüglich und spätestens binnen vierzehn Tagen 
				ab dem Tag zurückzuzahlen, an dem die Mitteilung über Ihren Widerruf dieses Vertrags bei uns eingegangen ist. 
				Für diese Rückzahlung verwenden wir dasselbe Zahlungsmittel, das Sie bei der ursprünglichen Transaktion eingesetzt haben, es sei denn, mit Ihnen wurde 
				ausdrücklich etwas anderes vereinbart; in keinem Fall werden Ihnen wegen dieser Rückzahlung Entgelte berechnet.
			</p>
			<p>
				Haben Sie ausdrücklich verlangt, dass die Dienstleistung während der Widerrufsfrist beginnen soll, so haben Sie 
				uns einen angemessenen Betrag zu zahlen, der dem Anteil der bis zu dem Zeitpunkt, zu dem Sie uns von der Ausübung des Widerrufsrechts 
				hinsichtlich dieses Vertrags unterrichten, bereits erbrachten Dienstleistungen im Vergleich zum Gesamtumfang 
				der im Vertrag vorgesehenen Dienstleistungen entspricht.
			</p>
			 -->
			<span class="subTitle">Ende Widerrufsbelehrung</span>			
		</div>
		<div class="footer">
			<table class="headerTable" -->>
				<tr>
					<td>
						<span class="address block">Engel & Völkers Berlin</span>
						<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
						<div style="height:5px;"></div>
						<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
						<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
						<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
					</td><td>
						<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
					</td>
				</tr>					
			</table>					
		</div>
	</div>
	
	<div class="exposePage">
		<!-- AGB -->
		<div class="header">
			<table class="headerTable">
				<tr>
					<td style="padding-bottom: -2px;">
						<span class="exposeTitle"><?php echo $content["exposetitel"]; ?></span>
					</td><td></td>
				</tr><tr>					
					<td style="padding-top: -5px;">
						<span class=" address"><?php echo $content["strasse"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["plz"]; ?> <?php echo $content["ort"]; ?> &bull; </span>
						<span class=" address"><?php echo $content["bezirk"]; ?></span>
					</td><td>
						<span class="go"><img src="../../../../../immoZE/inc/logo.png"></span><span class="go">ID <?php echo $content["go"]; ?></span>
					</td>
				</tr>					
			</table>	
		</div>
		<div class="content agb">			
			<span class="subTitleSmall">Allgemeine Geschäftsbedingungen</span>
			<ol>
			<li>
				Unsere Nachweis- oder Vermittlungstätigkeit erfolgt aufgrund der uns vom Auftraggeber oder anderen
				Auskunftsbefugten erteilten Auskünfte. Eine Haftung für die Richtigkeit und Vollständigkeit können
				wir nicht übernehmen. Irrtum und Zwischenverkauf und -vermietung bleiben vorbehalten.
			</li><li>
				Der Maklervertrag mit uns/oder unserem Beauftragten kommt entweder durch schriftliche
				Vereinbarung oder auch durch die Inanspruchnahme unserer Maklertätigkeit in Kenntnis und auf der
				Basis des Ihnen vorliegenden Objekt-Exposees und seiner Bedingungen oder von uns erteilter
				Auskünfte zustande.
			</li><li>
				Unsere Nachweis-/Vermittlungstätigkeit, Exposee etc. sind ausschließlich für den adressierten
				Empfänger bestimmt und vertraulich zu behandeln. Bei Weitergabe an Dritte ohne unsere
				Zustimmung ist der Empfänger unserer Nachweis-/Vermittlungstätigkeit zur Zahlung der ortsüblichen
				oder vereinbarten Provision verpflichtet, wenn der Dritte das Geschäft, ohne mit uns einen
				Maklervertrag vereinbart zu haben, abschließt; weitere Schadensersatzansprüche unsererseits bleiben
				vorbehalten.
			</li><li>
				Wir sind berechtigt, auch für den anderen Vertragsteil provisionspflichtig tätig zu werden, soweit
				keine Interessenkollision vorliegt.
			</li><li>
				Der Provisionsanspruch wird nicht dadurch berührt, dass statt des ursprünglich beabsichtigten
				Geschäftes ein anderes zustande kommt (z. B. Kauf statt Miete oder umgekehrt), sofern der
				wirtschaftliche Erfolg nicht wesentlich von unserem Angebot abweicht.
			</li><li>
				Die Provision ist verdient und fällig bei Vertragsabschluss in gehöriger Form und ggf. des Eintritts
				eventuell darin vereinbarter aufschiebender Bedingungen oder bei Abschluss eines gleichwertigen
				Geschäftes, das im Zusammenhang mit der maklerseits geleisteten Maklertätigkeit steht. Die Erwerbsbzw.
				Nutzungsbedingungen sind uns von unserem Vertragspartner mitzuteilen.
			</li><li>
				Zurückbehaltungsrechte und Aufrechnungen gegenüber der Courtageforderung sind ausgeschlossen,
				soweit die aufrechenbare Forderung bestritten oder nicht rechtskräftig festgestellt ist.
			</li><li>
				Ist dem Empfänger das von uns nachgewiesene Objekt bereits bekannt, ist uns dies schriftlich
				unverzüglich, d. h. spätestens innerhalb von drei Tagen ab Entgegennahme unseres
				Nachweises/Exposees mitzuteilen. Erfolgt dies nicht, so hat der Kunde uns im Wege des
				Schadensersatzes sämtliche Aufwendungen zu ersetzen, die uns dadurch entstanden sind, dass der
				Kunde uns nicht über die bestehende Vorkenntnis informiert hat.
			</li><li>
				Erfüllungsort und Gerichtsstand ist der Geschäftssitz des Maklers, soweit dies gesetzlich zulässig ist.
			</li><li>
				Sollten eine oder mehrere der vorstehenden Bestimmungen ungültig sein oder werden, so soll die
				Wirksamkeit der übrigen Bestimmungen hiervon nicht berührt werden. Die unwirksame Bestimmung
				soll zwischen den Parteien durch eine Regelung ersetzt werden, die den wirtschaftlichen Interessen der
				Vertragsparteien am nächsten kommt und im Übrigen der vertraglichen Vereinbarung nicht
				zuwiderläuft.
			</ol>
		</div>
		<div class="footer">
			<table class="headerTable" style="display: none;">
				<tr>
					<td>
						<span class="address block">Engel & Völkers Berlin</span>
						<span class="address block">BerlinCharlottenburg@engelvoelkers.com</span>
						<div style="height:5px;"></div>
						<span class="address block">Bleibtreustr. 34/35  10707 Berlin</span>
						<span class="address block">EuV Residential Berlin GmbH  Tel. +49-(0)30-88 00 11 88</span>
						<span class="address block">Lizenzpartner der Engel & Völkers Residential GmbH</span>
					</td><td>
						<span class="logo"><img src="../../../../../immoZE/inc/logo.png"></span>
					</td>
				</tr>					
			</table>					
		</div>
	</div>
</body>
</html>