<template>
	<div class="WishListButton">
		<span class="fa" data-toggle="tooltip" data-placement="top"
				:data-original-title="title" @click="makeRequest">
			<i :class="{'fa fa-heart': act == 'remove',
							'fa fa-heart-o': act == 'add', css}"></i>
		</span>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				url: '/wish-list',
				wish_id: 0,
			}
		},

		computed: {
			title(){
				if(this.act == 'add')
					return 'Add to Wish list';
				else if(this.act == 'remove')
					return 'Remove from wish list';
			}
		},

		props: {
			act: {},
			data1: {},
			data2: {},
			css: {default: 'nocss'}
		},  

		watch: {
			act(val){
 				if(val == 'add')
					this.title = 'Add to Wish list';
				else if(val == 'remove')
					this.title = 'Remove from wish list';
			}
		    // 'this.act' ('remove', 'add') {
		    //     this.title = 'Remove from wish list';
		    // },
		    // 'this.act' ('add', 'remove'){
		    // 	this.title = 'Add to wish list';
		    // }
		},

		methods: {

			makeRequest(){
				if(this.act == 'add'){
					this.postRequest();
				}
				else if (this.act == 'remove'){
					this.deleteRequest();
				}
			},

			postRequest(){
				axios.post(this.url, {car_id: this.data1 , user_id: this.data2 } )
					.then(response => {
						toastr.success(response.data.message);
						this.act = 'remove';
						this.wish_id = response.data.wish_id;
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message);
					})
			},

			deleteRequest(){
				axios.delete(this.url +'/'+ this.wish_id )
					.then(response => {
						toastr.success(response.data.message);
						this.act = 'add';
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message);
					})
			}
		},

		mounted() {
			console.log('WishListButton Component mounted.')
			this.wish_id = this.data3;
			//console.log(this.user)
		}
	}
</script>
