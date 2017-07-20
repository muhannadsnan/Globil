<template>
	<div class="WishListButton ">		

		<div class="tooltipDiv" v-if="data2 > 0" @click="makeRequest">
			<i :class="{'fa fa-heart': action == 'remove',
							'fa fa-heart-o': action == 'add' ,  css}"></i>
			<span class="tooltiptext">{{title}}</span>
		</div>
		<div v-else class="WishListButton">
			<a href="/login" class="">
				<span class="fa" data-toggle="tooltip" data-placement="top"
						:data-original-title="title">
					<i class="fa fa-heart-o"></i>
				</span>
			</a>
		</div>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				url: '/wish-list',
				wish: {},
				action: '',
				carExists: '',
			}
		},

		props: {
			act: {},
			data1: {}, // car.id
			data2: {}, // user.id
			// data3: {}, // wish.id
			css: {default: 'nocss'}
		},  

		computed: {
			title(){
				if(this.action == 'add' )
					return 'Add to Wish list'
				else if(this.action == 'remove')
					return 'Remove from wish list'
			},
		},

		methods: {

			carInWishlist(){
				this.$root.$data.wishList.forEach(w => {
					if(w.car_id == this.data1){ //alert('found in wishlist ' + this.data1)
						this.action = 'remove' // means car exists in wishlist
						this.carExists = true
					}
				})
				if(this.action != 'remove'){
					this.action = 'add'
					this.carExists = false
				}
			},

			makeRequest(){
				if(this.action == 'add'){
					this.postRequest()
				}
				else if (this.action == 'remove'){
					this.deleteRequest()
				}
				this.carInWishlist()
			},

			postRequest(){
				axios.post(this.url, {car_id: this.data1 , user_id: this.data2 } )
					.then(response => {
						toastr.success(response.data.message)
						this.action = 'remove'
						this.wish = response.data.wish
						// this.wish_id = response.data.wish.id
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!' )
					})
			},

			deleteRequest(){
				axios.delete(this.url +'/'+ this.data1 ) // delete by car_id
					.then(response => {
						toastr.success(response.data.message)
						this.action = 'add'
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!' )
					})
			}
		},

		mounted() {
			// console.log('WishListButton Component mounted.')
			if(this.act)
				this.action = this.act // set data = prop to avoid mutating
			else { //alert(this.data1)
				this.carInWishlist()
			}
			console.log(this.$root.$data.wishList)
		}
	}
</script>
