<template>
	<div class="search-price">
		<label>Price:</label>
		<div class="">
			<input type="number" v-model="minPrice" @change="sendDataToParent" step="5000" class="form-control">
			<span>til</span>
			<input type="number" v-model="maxPrice" @change="sendDataToParent" step="5000" class="form-control">
		</div>
		<hr>
	</div> 
</template>


<script>
	export default {
		data(){
			return {
				minPrice: 0,
				maxPrice: 0,
			}
		},

		methods: {

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('price-range-changed', {priceRange: [this.minPrice, this.maxPrice]})
				this.$emit('any-filter-change')
			}, 

			sendDataToParentWithoutNotifingAll(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('price-range-changed', {priceRange: [this.minPrice, this.maxPrice]})
			},			
		},

		mounted() {
			// console.log('Search Price Component mounted.')

			 // send your data @on-change or @any-filter-change
			 this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll);
		},

		watch:{

		}
	}
</script>

<style lang="sass" scoped>
.search-price input
	width: 90%
	margin: auto
</style>
