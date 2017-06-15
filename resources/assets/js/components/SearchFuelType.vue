<template>
	<div class="search-fuel-drive">
		<label>Fuel type:</label>
		<div v-for="(fuelType, i) in fuelTypes" class=" text-left">
			<input type="checkbox"
				:value="fuelType.id" @change="onCHange($event.target.checked, i, fuelType)">
			<span>{{fuelType.title}}</span> 	
		</div>		
		<hr>
	</div> 
</template>


<script>
	export default {
		data(){
			return {
				fuelTypes: [],
				checked: [],
			}
		},

		methods: {

			onCHange(check, i, fType){ 
				if(check)
					this.$set(this.checked, i, fType.id)
				else
					this.$set(this.checked, i, false)

				this.sendDataToParent()
			},

			getFuelTypes(){
				axios.get('/readSubData/fuel_type/undefined')
					.then(response => {
						this.fuelTypes = response.data.data
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('fuel-type-changed', {CheckedFuelTypes: this.checked})
				this.$emit('any-filter-change')
			}, 

			sendDataToParentWithoutNotifingAll(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('fuel-type-changed', {CheckedFuelTypes: this.checked})
			},			
		},

		mounted() {
			//console.log('Search Wheel Drive Component mounted.')
			this.getFuelTypes()
			// send your data @on-change or @any-filter-change
			this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll)
		},

		watch:{
			fuelTypes(val){
				this.fuelTypes.filter(c => {
					this.checked.push(false)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
