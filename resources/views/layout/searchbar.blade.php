
<!-- #SEARCHBAR -->

<div class="panel panel-info">

	<div class="list-group panel">


		<div class="form-group">
			<input type="search" @keyup.enter="searchKeyEnter()" v-model="searchKeyword" class="form-control" placeholder="Search car brands and models.." >
		</div>

		<div class="panel-info">
			<div class="panel-heading">
				<h3>Filters</h3>			
			</div>

			
			<search-brand-model 
				@new-item-checked="refreshResults"
				@item-un-checked="refreshResults"></search-brand-model>
			
		</div>
		
			

	</div>

</div>