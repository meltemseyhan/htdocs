
		<div class="main-slide">
			<div id="sync1" class="owl-carousel">
				<?php
				$statementSlider= $db->prepare("SELECT * FROM slider WHERE durum='1' order by sira");
				$statementSlider->execute();
				while ($rowSlider=$statementSlider->fetch(PDO::FETCH_ASSOC)) {?> 
				<div class="item">
					<div class="slide-desc">
						<div class="inner">
							<h1><?php echo $rowSlider["ad"]?></h1>
						</div>
					</div>
					<div class="slide-type-1">
						<a href="<?php echo $rowSlider["link"]?>"><img src="<?php echo $rowSlider["resimyol"]?>" alt="" class="img-responsive"></a>
					</div>
				</div>
				<?php }?>		
			</div>
		</div>