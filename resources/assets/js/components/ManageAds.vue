<template>
	<div class="manage-ads panel panel-warning">
		<div class="panel-heading">
			<h2>
				Manage Ads
				<button @click="showModal=true" class="btn btn-primary pull-right">Create new Ad</button>
			</h2>
		</div>

		<div class="table-responsive">
			<table class="table ">
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Type</th>
					<th>Description</th>
					<th>Image</th>
					<th class="manage_btns">Manage</th>
					<th>Created at</th>
					<th>Updated at</th>
				</tr>

				<tr v-for="ad in ads">
					<td>{{ad.id}}</td>
					<td>{{ad.title}}</td>
					<td>{{getTypeByTypeId(ad.type)?getTypeByTypeId(ad.type).title:''}}</td>
					<td>{{ad.desc}}</td>
					<td>{{ad.image}}</td>
					<td>
						<button @click="editAd" class="btn btn-warning">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button>
						<button @click="deleteAd" class="btn btn-danger">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</td>
					<td>{{ad.created_at}}</td>
					<td>{{ad.updated_at}}</td>
				</tr>
			</table>
		</div>

		<form @submit.prevent="storeAd" action="/ads" method="post" enctype="multipart/form-data">
			<modal title="Create Advertisement" v-show="showModal" @clk-close-modal="showModal=false">
				<input type="hidden" name="_token" :value="csrf">

				<div class="form-group">
					<input type="text" v-model="newAd.title" placeholder="Title.. (optional)" class="form-control">
				</div>

				<div class="form-group">
					<textarea v-model="newAd.desc" placeholder="Description.. (optional)" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<select v-model="newAd.type" class="form-control">
						<option v-for="(type, i) in types" :value="type.id">{{type.title}}</option>
					</select>
				</div>

				<div class="form-group">
					<input type="file" @change="newAd.images = $event.target.files" class="form-control" multiple>
				</div>

				<template slot="buttons">
					<input type="submit" value="Create Ad" class="btn btn-primary">
				</template>
			</modal>
		</form>
	</div>
</template>

<script>
	export default {
		data(){
			return {
				ads: [],
				types: [],
				newAd: {title: '', desc: '', type: '', images: []},
				editAd: {title: '', desc: '', type: '', images: []},
				showModal: false,
				csrf: {},
			}
		},
		methods: {
			
			readAds(){
				axios.get('/read-ads')
					.then(response => {
						toastr.success(response.data.message)
						this.ads = response.data.data
						this.showModal=false
						this.readAds
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
			},

			readTypes(){
				axios.get('/read-ads-types')
					.then(response => {
						this.types = response.data.data
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
			},

			storeAd(){
				var formData = new FormData() // Filling formData OBJ
				formData.append('title', this.newAd.title)
				formData.append('desc', this.newAd.desc)
				formData.append('type', this.newAd.type)
				for(var i =0; i<this.newAd.images.length; i++ ) {
					formData.append('images[]', this.newAd.images[i])					
				}

				axios.post('/ads', formData)
					.then(response => {
						toastr.success(response.data.message)
						this.readAds()
						this.newAd = {title: '', desc: '', type: '', images: []}
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})               
			},

			editAd(){

			},

			deleteAd(){
				axios.delete(this.url +'/'+ this.data1 )
					.then(response => {
						toastr.success(response.data.message)
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
			},
			getTypeByTypeId(id){
				return this.types.filter(t => { 
					if(t.id == id) return t.title 
				})[0]
			}
		},

		mounted() {
			// console.log('Manage ads Component mounted.')
			this.readAds()
			this.readTypes()
			this.showModal = false
			this.csrf = window.Laravel.csrfToken
		},

		computed: {
			isValid(){
				// if(this.newAd.title == '')
				//     this.showError['title']
				// if(this.newAd.type == '')
				//     this.showError['type']

				// return this.showError.length > 0
			}
		},

		watch:{
			types(val){
				// if(val.length > 0)
				//     this.newAd.type = this.types[0].title
			}
		}
	}
</script>

<style lang="sass" scoped>
	th
		width: auto
	.manage_btns
		width: 150px !important
	.panel-heading
		padding: 0px
		button
			margin-right: 10px
			margin-top: 5px
	h2
		line-height: 42px
</style>