<template>
	<div class="search-km">
		<label>Kilometer driven:</label>
		<div class="">
			<input type="number" v-model="minKM" @change="sendDataToParent" step="100" class="form-control">
			<span>til</span>
			<input type="number" v-model="maxKM" @change="sendDataToParent" step="100" class="form-control">
		</div>
		<hr>
	</div> 
</template>


<script>
	export default {
		data(){
			return {
				minKM: 0,
				maxKM: 0,
			}
		},

		methods: {

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('km-range-changed', {kmRange: [this.minKM, this.maxKM]})
				this.$emit('any-filter-change')
			}, 

			sendDataToParentWithoutNotifingAll(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('km-range-changed', {kmRange: this.checked})
			},			
		},

		mounted() {
			// console.log('Search km Component mounted.')

			 // send your data @on-change or @any-filter-change
			 this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll);
		},

		watch:{
			minKM(val){
				if(val == '' || val < 0)
					this.minKM = 0
			},
			maxKM(val){
				if(val == '' || val < 0)
					this.maxKM = 0
			},
		}
	}
</script>

<style lang="sass" scoped>
.search-km input
	width: 90%
	margin: auto
</style>
