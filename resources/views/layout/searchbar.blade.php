
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

			<saved-search @search-results-ready="searchResultsReady">
				<search-brand-model></search-brand-model>
			</saved-search>
			
		</div>
		
			

	</div>

</div>