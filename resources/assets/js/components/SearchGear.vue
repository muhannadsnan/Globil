<template>
	<div class="search-gear">
		<label>Gear:</label>
		<div v-for="(gear, i) in gears" class=" text-left">
			<input type="checkbox" :true-value="1" :false-value="0"
				:value="gear.id" @change="onCHange($event.target.checked, i, gear)">
			<span>{{gear.title}}</span> 	
		</div>		
		<hr>
	</div> 
</template>


<script>
	export default {
		data(){
			return {
				gears: [],
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
					Vue.set(this.$root.$data.isActiveAll, 6, true)
				}
				else{
					this.$set(this.checked, i, 0)
					if(this.checked.length == 0 || this.allFalseChecked)
						Vue.set(this.$root.$data.isActiveAll, 6, false)
				}

				this.sendDataToParent()
			},

			getGears(){
				axios.get('/readSubData/gear/undefined')
					.then(response => {
						this.gears = response.data.data
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message)
					})
			},

			sendDataToParent(){ // send your data @on-change or @any-filter-change
				this.$parent.$emit('gear-changed', {CheckedGears: this.checked})
				this.$emit('any-filter-change', {from: 'gear'})
			}, 

			sendDataToParentWithoutNotifingAll(e){ // send your data @on-change or @any-filter-change
				if(e.from != 'gear')
					this.$parent.$emit('gear-changed', {CheckedGears: this.checked})
			},			
		},

		mounted() {
			//console.log('Search Wheel Drive Component mounted.')
			this.getGears()
			// send your data @on-change or @any-filter-change
			this.$on('any-filter-change', this.sendDataToParentWithoutNotifingAll)
		},

		watch:{
			gears(val){
				this.gears.filter(c => {
					this.checked.push(0)
				})
			}
		}
	}
</script>

<style lang="sass" scoped>

</style>
