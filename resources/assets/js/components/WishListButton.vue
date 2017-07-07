<template>
	<div class="WishListButton">
		<span v-if="data2 > 0" class="" data-toggle="tooltip" data-placement="top"
				:data-original-title="title" @click="makeRequest">
			<i :class="{'fa fa-heart': action == 'remove',
							'fa fa-heart-o': action == 'add' ,  css}"></i>
		</span>
		<div v-else class="WishListButton">
			<a href="/login" class="">
				<span class="fa" data-toggle="tooltip" data-placement="top"
						data-original-title="title">
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
				// wish_id: 0,
				wish: {},
				action: '',
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
				if(this.action == 'add' || ! this.carInWishlist())
					return 'Add to Wish list'
				else if(this.action == 'remove' || this.carInWishlist())
					return 'Remove from wish list'
			},
		},

		watch: {
			action(val){
 				if(val == 'add' || ! this.carInWishlist())
					this.title = 'Add to Wish list'
				else if(val == 'remove' || this.carInWishlist())
					this.title = 'Remove from wish list'
			},
		},

		methods: {

			carInWishlist(){
				// var res = false
				this.$root.$data.wishList.forEach(w => {
					if(w.car_id == this.data1)
						this.action = 'remove' // means car exists in wishlist
				})
				// return res
				if(this.action != 'remove')
					this.action = 'add'
			},

			makeRequest(){
				// if(this.action == 'add' || ! this.carInWishlist()){
				if(this.action == 'add'){
					this.postRequest()
				}
				// else if (this.action == 'remove' || this.carInWishlist()){
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
			// this.wish_id = this.data3
			this.action = this.act // set data = prop to avoid mutating
			console.log(this.$root.$data.wishList)
		}
	}
</script>
