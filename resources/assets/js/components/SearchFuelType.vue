<template>
	<div class="search-price">
		<label>Car type:</label>
		<div v-for="(carType, i) in carTypes" class=" text-left">
			<input type="checkbox"
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

		methods: {

			onCHange(check, i, carType){ //console.log(carType); console.log(check)
				if(check)
					this.$set(this.checked, i, carType.id)
				else
					this.$set(this.checked, i, false)

				this.sendDataToParent()
			},

			getCarTypes(){
				axios.get('/read-car-types')
					.then(response => {
						this.carTypes = response.data.data
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('car-type-changed', {carTypes: this.checked})
				this.$emit('any-filter-change')
			}, 

			sendDataToParentWithoutNotifingAll(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('car-type-changed', {carTypes: this.checked})
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
					this.checked.push(false)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
<template>
	<div class="search-price">
		<label>Car type:</label>
		<div v-for="(carType, i) in carTypes" class=" text-left">
			<input type="checkbox"
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

		methods: {

			onCHange(check, i, carType){ //console.log(carType); console.log(check)
				if(check)
					this.$set(this.checked, i, carType.id)
				else
					this.$set(this.checked, i, false)

				this.sendDataToParent()
			},

			getCarTypes(){
				axios.get('/read-car-types')
					.then(response => {
						this.carTypes = response.data.data
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('car-type-changed', {carTypes: this.checked})
				this.$emit('any-filter-change')
			}, 

			sendDataToParentWithoutNotifingAll(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('car-type-changed', {carTypes: this.checked})
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
					this.checked.push(false)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
