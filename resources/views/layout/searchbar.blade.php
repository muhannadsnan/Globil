
<!-- #SEARCHBAR -->

<div class="panel panel-info">

	<div class="list-group panel">


		<div class="form-group">
			<input type="search" @keyup.enter="searchKeyEnter()" v-model="searchKeyword" class="form-control" placeholder="Search car brands and models.." >
		</div>

		<div class="panel-info">

			<search-filters @results-ready="searchResultsReady">
				<!-- <search-text></search-text> -->
				<search-brand-model></search-brand-model>
				<search-price></search-price>
				<search-year></search-year>
				<search-car-type></search-car-type>
				<search-wheel-drive></search-wheel-drive>
				<search-km></search-km>
				<search-fuel-type></search-fuel-type>
				<search-gear></search-gear>
				<search-areas></search-areas>

			</search-filters>
			
		</div>			

	</div>

</div>
