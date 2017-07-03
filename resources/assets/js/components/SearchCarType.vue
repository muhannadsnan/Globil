<template>
	<div class="search-car-type">
		<label>Car type:</label>
		<div v-for="(carType, i) in carTypes" class=" text-left">
			<input type="checkbox" :true-value="1" :false-value="0"
				:value="carType.id" @change="onCHange($event.target.checked, i, carType)">
			<span>{{carType.title}}</span> 	
		</div>		
		<hr>
	</div> 
</template>


<script>
	export default {
		data(){
			return {
				carTypes: [],
				checked: [],
			}
		},

		computed: {
			allFalseChecked(){
				var res = true
				this.checked.forEach(c => {
					if(c != 0)
						res = false
				})
				return res
			},
		},
		methods: {

			onCHange(check, i, carType){ //console.log(carType); console.log(check)
				if(check){
					this.$set(this.checked, i, carType.id)
					Vue.set(this.$root.$data.isActiveAll, 4, true)
				}
				else{
					this.$set(this.checked, i, 0)
					if(this.checked.length == 0 || this.allFalseChecked)
						Vue.set(this.$root.$data.isActiveAll, 4, false)
				}

				this.sendDataToParent()
			},

			getCarTypes(){
				axios.get('/readSubData/car_type/undefined')
					.then(response => {
						this.carTypes = response.data.data
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('car-type-changed', {CheckedCarTypes: this.checked})
				this.$emit('any-filter-change', {from: 'car-type'})
			}, 

			sendDataToParentWithoutNotifingAll(e){ // send your data @on-change or @any-filter-change
				if(e.from != 'car-type')
					this.$parent.$emit('car-type-changed', {CheckedCarTypes: this.checked})
			},			
		},

		mounted() {
			// console.log('Search Price Component mounted.')
			this.getCarTypes()
			 // send your data @on-change or @any-filter-change
			 this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll);
		},

		watch:{
			carTypes(val){
				this.carTypes.filter(c => {
					this.checked.push(0)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
