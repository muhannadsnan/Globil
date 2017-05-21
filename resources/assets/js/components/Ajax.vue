<template>
	<div class="__">
		<button v-if=" ! hasClicked" :class="this.css" @click="clk()">
			<span class="fa fa-heart"></span> 
			<slot></slot>
		</button>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				hasClicked: false,
			}
		},

		computed: {
		},

		props: {
			url: {},
			method: { default: 'post'},
			css: {},
			data1: {},
			data2: {}
		},  

		methods: {

			clk(){
				if(this.method == 'post'){
					this.postRequest();
				}
				else if(this.method == 'delete'){
					this.deleteRequest();
				}
			},

			postRequest(){
				axios.post(this.url, {car_id: this.data1 , user_id: this.data2 } )
					.then(response => {
						toastr.success(response.data.message);
						console.log(response.data.message);
						//alert(response.data.message);
						this.hasClicked = true;
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message);
						console.log(err.message);
					})
			},

			deleteRequest(){
				axios.delete(this.url +'/'+ this.data1 )
					.then(response => {
						toastr.success(response.data.message);
						console.log(response.data.message);
						//alert(response.data.message);
						this.hasClicked = true;
					})
					.catch(err => {
						toastr.error('Error was occured!', err.message);
						console.log(err.message);
					})
			}
		},

		mounted() {
			console.log('Ajax Component mounted.')
			//console.log(this.user)
		}
	}
</script>
