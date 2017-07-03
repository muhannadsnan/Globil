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
				this.$emit('any-filter-change', {from: 'price'})
			}, 

			sendDataToParentWithoutNotifingAll(e){ // send your data @on-change or @any-filter-change
				if(e.from != 'price')
					this.$parent.$emit('price-range-changed', {priceRange: [this.minPrice, this.maxPrice]})
			},			
		},

		mounted() {
			 // send your data @on-change or @any-filter-change
			 this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll);
		},

		watch:{
			minPrice(val){
				if(val == '' || val < 0)
					this.minPrice = 0
				if(this.minPrice != 0)
					Vue.set(this.$root.$data.isActiveAll, 9, true)
				else
					if(this.minPrice == 0 && this.maxPrice == 0)
						Vue.set(this.$root.$data.isActiveAll, 9, false)
			},
			maxPrice(val){
				if(val == '' || val < 0)
					this.maxPrice = 0
				if(this.maxPrice != 0)
					Vue.set(this.$root.$data.isActiveAll, 10, true)
				else
					if(this.maxPrice == 0 && this.minPrice == 0)
						Vue.set(this.$root.$data.isActiveAll, 10, false)
			},
		}
	}
</script>

<style lang="sass" scoped>
.search-price input
	width: 90%
	margin: auto
</style>
