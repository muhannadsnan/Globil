<template>
	<div class="manage-ads panel panel-warning">
		<div class="panel-heading">
			<h2>
				Manage Ads
				<button @click="showModalCreate=true" class="btn btn-primary pull-right">Create new Ad</button>
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
						<button @click="preUpdate(ad)" class="btn btn-warning">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button>
						<button @click="deleteAd(ad.id)" class="btn btn-danger">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</td>
					<td>{{ad.created_at}}</td>
					<td>{{ad.updated_at}}</td>
				</tr>
			</table>
		</div>


		<form @submit.prevent="storeAd" action="" method="post" enctype="multipart/form-data">
			<modal title="Create Advertisement" v-show="showModalCreate" @clk-close-modal="showModalCreate=false">
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


		<form @submit.prevent="updateAd" action="" method="put" enctype="multipart/form-data">
			<modal title="Update Advertisement" v-show="showModalUpdate" @clk-close-modal="showModalUpdate=false">
				<input type="hidden" name="_token" :value="csrf">

				<div class="form-group">
					<input type="text" v-model="updatedAd.title" placeholder="Title.." class="form-control">
				</div>

				<div class="form-group">
					<textarea v-model="updatedAd.desc" placeholder="Description.. " class="form-control"></textarea>
				</div>

				<div class="form-group">
					<select v-model="updatedAd.type" class="form-control">
						<option v-for="(type, i) in types" :value="type.id">{{type.title}}</option>
					</select>
				</div>

				<div class="form-group">
					<input type="file" @change="newAd.images=$event.target.files; showUpdateBtn=true" class="form-control" multiple>
				</div>
<!-- asset_path+'/'+pic.id+'.'+pic.ext -->
				<div class="row images">
					<div v-for="(pic, i) in updatedAd.images" class="col-xs-6 col-md-4">
						<a :href="imgSRCs[i]" class="thumbnail" target="_blank">
							<img v-model="imgSRCs[i]"  :alt="'#'+pic.id" />
						</a>
						<button @click="deleteImg(pic)" class="btn btn-danger">X</button>
					</div>
				</div>

				<template slot="buttons">
					<input type="submit" v-show="showUpdateBtn" value="Update" class="btn btn-primary">
					<input type="submit" v-show="!showUpdateBtn" value="Update" class="btn btn-primary" disabled="disabled">
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
				newAd: {title: '', desc: '', type: '', images: []}, // update ad : new images to upload here
				updatedAd: {id: '', title: '', desc: '', type: '', images: []},
				oldAd: {title: '', desc: '', type: '', images: []},
				imgSRCs: [],
				showUpdateBtn: false,
				showModalCreate: false,
				showModalUpdate: false,
				csrf: {},
			}
		},
		methods: {
			
			readAds(){
				axios.get('/read-ads')
					.then(response => {
						this.ads = response.data.data
						this.showModalCreate=false
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
				if(this.newAd.title != '' && this.newAd.desc != '' && this.newAd.type != ''){
					var formData = new FormData() // Filling formData OBJ
					formData.append('title', this.newAd.title)
					formData.append('desc', this.newAd.desc)
					formData.append('type', this.newAd.type)
					for(var i = 0 ; i < this.newAd.images.length ; i++ ) {
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
				}
			},

			preUpdate(ad){ 
				this.updatedAd.id = ad.id
				this.updatedAd.title = ad.title
				this.updatedAd.desc = ad.desc
				this.updatedAd.type = ad.type
				this.updatedAd.images = []
				this.showModalUpdate = true
				this.oldAd.title = ad.title
				this.oldAd.desc = ad.desc
				this.oldAd.type = ad.type
				this.oldAd.images = []
				this.loadImages()
			},

			updateAd(){
				if(this.showUpdateBtn){					
					
					axios.patch('/ads/' + this.updatedAd.id, this.updatedAd)
						.then(response => {
							toastr.success(response.data.message)
							this.updateImages()
							var i = 0
							this.ads.filter(ad => {
								if(ad.id == this.updatedAd.id){
									this.ads[i].title = this.updatedAd.title
									this.ads[i].desc = this.updatedAd.desc
									this.ads[i].type = this.updatedAd.type
									this.updatedAd = {id: '', title: '', desc: '', type: '', images: []}
								}
								i += 1
							})
							this.showModalUpdate = false
							this.updatedAd = {id: '', title: '', desc: '', type: '', images: []}
							this.oldAd = {title: '', desc: '', type: '', images: []}
						})
						.catch(err => {
							toastr.error(err.message, 'Error occured!')
						})
				}
			},

			updateImages(){ 
				var formData = new FormData() // Filling formData OBJ
				for(var i = 0 ; i < this.newAd.images.length ; i++ ) {
					formData.append('images[]', this.newAd.images[i])					
				}

				axios.post('/ads/' + this.updatedAd.id + '/pics', formData, {processData: false, contentType: false})
					.then(response => {

					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
			},

			deleteAd(id){
				if(confirm("Are you really sure to delete Adv #"+id)){
					axios.delete('/ads/' + id)
					.then(response => {
						toastr.success(response.data.message)
						this.ads = this.ads.filter(ad => {
							if(ad.id != id)
								return ad
						})
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
				}				
			},

			getTypeByTypeId(id){
				return this.types.filter(t => { 
					if(t.id == id) return t.title 
				})[0]
			},

			loadImages(){
				axios.get('/ads/' + this.updatedAd.id + '/pics')
					.then(response => {
						this.updatedAd.images = response.data.data
						this.asset_path = response.data.asset_path
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
			},

			deleteImg(pic){
				if(confirm("Are you really sure to delete image #"+pic.id+" for Adv #"+pic.ad_id)){
					axios.delete('/images-for-ad/' + pic.id)
					.then(response => {
						toastr.success(response.data.message)
						this.updatedAd.images = this.updatedAd.images.filter(img => {
							if(img.id != pic.id)
								return img
						})
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
				}	
			}
		},

		mounted() {
			// console.log('Manage ads Component mounted.')
			this.readAds()
			this.readTypes()
			this.csrf = window.Laravel.csrfToken
		},

		computed: {
			isValid(){
			},
		},

		watch:{

			updatedAd : { 
				handler(val){
		      	var oldAd = this.oldAd
					if(val.title == oldAd.title && val.desc == oldAd.desc && val.type == oldAd.type)
						this.showUpdateBtn = false
					else
						this.showUpdateBtn = true

					if(val.images.length > 0){
						val.images.forEach( pic => {
							this.imgSRCs.push(this.asset_path+'/'+pic.id+'.'+pic.ext)
						})
					}	
		     },
		     deep: true				
			},
		},
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
.images
	position: relative
	.thumbnail
		position: relative
		img 
			display: block
			width: 150px
			height: 150px
	.thumbnail
		&:hover
			& + button
				opacity: 0.8
	button
		position: absolute
		right: 15px
		top: 15px
		z-index: 999 !important
		top: 5px
		right: 20px
		opacity: 0
		&:hover
			opacity: 0.6
</style>