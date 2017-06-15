<template>
	<div class="search-wheel-drive">
		<label>Wheel drive:</label>
		<div v-for="(wheelDrive, i) in wheelDrives" class=" text-left">
			<input type="checkbox"
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

		methods: {

			onCHange(check, i, wheelDrive){ 
				if(check)
					this.$set(this.checked, i, wheelDrive.id)
				else
					this.$set(this.checked, i, false)

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
				this.$parent.$emit('wheel-drive-changed', {wheelDrives: this.wheel_drives})
				this.$emit('any-filter-change')
			}, 

			sendDataToParentWithoutNotifingAll(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('wheel-drive-changed', {wheelDrives: this.wheel_drives})
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
					this.checked.push(false)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
