<template>
	<div class="search-wheel-drive">
		<label>Wheel drive:</label>
		<div v-for="(wheelDrive, i) in wheelDrives" class=" text-left">
			<input type="checkbox" :true-value="1" :false-value="0"
				:value="wheelDrive.id" @change="onCHange($event.target.checked, i, wheelDrive)">
			<span>{{wheelDrive.title}}</span> 	
		</div>		
		<hr>
	</div> 
</template>


<script>
	export default {
		data(){
			return {
				wheelDrives: [],
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

			onCHange(check, i, wheelDrive){ 
				if(check){
					this.$set(this.checked, i, wheelDrive.id)
					Vue.set(this.$root.$data.isActiveAll, 11, true)
				}
				else{
					this.$set(this.checked, i, 0)
					if(this.checked.length == 0 || this.allFalseChecked)
						Vue.set(this.$root.$data.isActiveAll, 11, false)
				}

				this.sendDataToParent()
			},

			getWheelDrives(){
				axios.get('/readSubData/wheel_drive/undefined')
					.then(response => {
						this.wheelDrives = response.data.data
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('wheel-drive-changed', {CheckedWheelDrives: this.checked})
				this.$emit('any-filter-change', {from: 'wheel-drive'})
			}, 

			sendDataToParentWithoutNotifingAll(e){ // send your data @on-change or @any-filter-change
				if(e.from != 'wheel-drive')
					this.$parent.$emit('wheel-drive-changed', {CheckedWheelDrives: this.checked})
			},			
		},

		mounted() {
			//console.log('Search Wheel Drive Component mounted.')
			this.getWheelDrives()
			// send your data @on-change or @any-filter-change
			this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll)
		},

		watch:{
			wheelDrives(val){
				this.wheelDrives.filter(c => {
					this.checked.push(0)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
