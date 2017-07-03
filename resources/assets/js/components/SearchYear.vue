<template>
	<div class="search-year">
		<label>Year:</label>
		<select class="form-control" MULTIPLE="MULTIPLE" @change="sendDataToParent" v-model="years">
			<option v-for="year in init" :value="year">{{year}}</option>
		</select>
		<hr>
	</div>
</template>


<script>
	export default {
		data(){
			return {
				init: [],
				years: [],
			}
		},

		methods: {

			sendDataToParent(){ // send your data @on-change or @on-others-change
				this.$parent.$emit('year-changed', {CheckedYears: this.years})
				this.$emit('any-filter-change', {from: 'year'})
			}, 

			sendDataToParentWithoutNotifingAll(e){ // send your data @on-change or @any-filter-change
				if(e.from != 'year')
					this.$parent.$emit('year-changed', {CheckedYears: this.years})
			}, 
		},

		mounted() {
			// console.log('Search Year Component mounted.')
			this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll)

			var d = new Date()
			for(var i = 1950 ; i <= d.getFullYear() ; i++)
				this.init.unshift(i)
		},

		watch:{

		}
	}
</script>

<style lang="sass" scoped>

</style>
