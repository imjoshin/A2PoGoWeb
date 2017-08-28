<div class="modal-wrapper">
	<div class="mon-select-modal">
		<div class="mon-select-modal-categories">
			<a class="btn" data-mon="none">None</a>
			<a class="btn" data-mon="all">All</a>
			<a class="btn" data-mon="1,2,3">Uncommon</a>
			<a class="btn" data-mon="4,5,6">Rare</a>
			<a class="btn" data-mon="7,8,9">Epic</a>
		</div>
		<div class="mon-select-modal-images">
			<?php
				for ($i = 1; $i <= 248; $i++)
				{
					$file = 'dist/img/pokemon/' . str_pad($i, 3, '0', STR_PAD_LEFT) . '.png';
					echo "
						<div class='mon-select-modal-images-item'>
							<div class='mon-select-modal-images-item-img' style='background-image: url($file);'></div>
						</div>
					";
				}
			?>
		</div>
	</div>
</div>
