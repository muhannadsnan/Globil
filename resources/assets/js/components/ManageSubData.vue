<template>
	<div class="manage-subdata panel panel-warning">
		<div class="panel-heading">
			<h2>
				Manage Sub Data
				<div class="row">					
					<div class="form-group col-sm-8 col-sm-offset-1">
						<select v-model="selectedNType" @change="readSubdata" class="form-control">
							<option v-for="(type, i) in subdataTypes" :value="type.ntype">{{type.ntype}}</option>
						</select>
					</div>

					<button @click="showModalCreate=true" class="btn btn-primary col-sm-2">Create new</button>
				</div>
			</h2>
		</div>

		<div class="table-responsive">
			<table class="table ">
				<tr>
					<th>#</th>
					<th>NType</th>
					<th>NType2</th>
					<th>Title</th>
					<th class="manage_btns">Manage</th>
					<th>Created at</th>
					<th>Updated at</th>
				</tr>
				<tr v-if="selectedNType == ''"><td colspan="7" class="empty"><span>Select Subdata type to show data..</span></td></tr>
				<tr v-if="loading"><td colspan="7" class="loading"><span>LOADING DATA..</span></td></tr>
				<tr v-for="sub in subdata" v-if="selectedNType != '' && !loading">
					<td>{{sub.id}}</td><td>{{sub.ntype}}</td><td>{{sub.ntype2}}</td><td>{{sub.title}}</td>
					<td>
						<button @click="preUpdate(sub)" class="btn btn-warning">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button>
						<button @click="deleteSubdata(sub.id)" class="btn btn-danger">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</td>
					<td>{{sub.created_at}}</td><td>{{sub.updated_at}}</td>
				</tr>
			</table>
		</div>


		<form @submit.prevent="storeSubdata" action="" method="post" enctype="multipart/form-data">
			<modal :title="'Create new '+newSub.ntype" v-show="showModalCreate" @clk-close-modal="showModalCreate=false">
				<input type="hidden" name="_token" :value="csrf">

				<div class="form-group">
					<select @change="readBrandsForModel" v-model="newSub.ntype" class="form-control">
						<option v-for="(type, i) in subdataTypes" :value="type.ntype">{{type.ntype}}</option>
					</select>
				</div>

				<div class="form-group" v-if="newSub.ntype == 'model'">
					<select v-model="newSub.ntype2" class="form-control">
						<option v-for="(brand, i) in brands" :value="brand.title">{{brand.title}}</option>
					</select>
				</div>

				<div class="form-group">
					<input type="text" v-model="newSub.title" placeholder="Title.." class="form-control">
				</div>

				<template slot="buttons">
					<input type="submit" value="Create" class="btn btn-primary">
				</template>
			</modal>
		</form>


		<form @submit.prevent="updateSub" action="" method="put" enctype="multipart/form-data">
			<modal title="Update Advertisement" v-show="showModalUpdate" @clk-close-modal="showModalUpdate=false">
				<input type="hidden" name="_token" :value="csrf">

				<div class="form-group">
					<select @change="readBrandsForModel" v-model="updatedSub.ntype" class="form-control">
						<option v-for="(type, i) in subdataTypes" :value="type.ntype">{{type.ntype}}</option>
					</select>
				</div>

				<div class="form-group" v-if="updatedSub.ntype == 'model'">
					<select v-model="updatedSub.ntype2" class="form-control">
						<option v-for="(brand, i) in brands" :value="brand.title">{{brand.title}}</option>
					</select>
				</div>

				<div class="form-group">
					<input type="text" v-model="updatedSub.title" placeholder="Title.." class="form-control">
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
				subdata: [],
				subdataTypes: [],
				selectedNType: '',
				brands: [],
				newSub: {ntype: '', ntype2: '', ntype3: '', title: ''}, 
				updatedSub: {id: '', ntype: '', ntype2: '', ntype3: '', title: ''},
				oldSub: {ntype: '', ntype2: '', ntype3: '', title: ''},
				showUpdateBtn: false,
				showModalCreate: false,
				showModalUpdate: false,
				csrf: {},
				loading: false,
			}
		},
		methods: {
			fillNewSub(type){
				this.newSub = type;
			},

			readBrandsForModel(){
				axios.get('/readSubData/brand/undefined')
					.then(response => {
						this.brands = response.data.data
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
			},
			
			readSubdata(){
				this.loading = true
				axios.get('/readSubData/'+this.selectedNType+'/undefined')
					.then(response => {
						this.subdata = response.data.data
						this.showModalCreate=false
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
					this.loading = false
			},

			readTypes(){
				this.loading = true
				axios.get('/read-subdata-types')
					.then(response => {
						this.subdataTypes = response.data.data.filter( sub => {
							if(sub.ntype != 'ads_type')
								return sub
						})
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
					this.loading = false
			},

			storeSubdata(){
				if(this.newSub.ntype != '' && this.newSub.title != ''){
					axios.post('/subdata', this.newSub)
						.then(response => {
							toastr.success(response.data.message)
							this.readSubdata()
							this.newSub = {ntype: '', ntype2: '', ntype3: '', title: ''}
						})
						.catch(err => {
							toastr.error(err.message, 'Error occured!')
						})               
				}
			},

			preUpdate(sub){ 
				this.updatedSub.id = sub.id
				this.updatedSub.ntype = sub.ntype
				this.updatedSub.ntype2 = sub.ntype2
				this.updatedSub.ntype3 = sub.ntype3
				this.updatedSub.title = sub.title
				this.showModalUpdate = true
				this.oldSub.ntype = sub.ntype
				this.oldSub.ntype2 = sub.ntype2
				this.oldSub.ntype3 = sub.ntype3
				this.oldSub.title = sub.title
				this.readBrandsForModel();
			},

			updateSub(){
				if(this.showUpdateBtn){					
					
					axios.patch('/subdata/' + this.updatedSub.id, this.updatedSub)
						.then(response => {
							var i = 0
							this.subdata.filter(sub => { // update the DOM
								if(sub.id == this.updatedSub.id){
									this.subdata[i].ntype = this.updatedSub.ntype
									this.subdata[i].ntype2 = this.updatedSub.ntype2
									this.subdata[i].ntype3 = this.updatedSub.ntype3
									this.subdata[i].title = this.updatedSub.title
								}
								i += 1
							})
							this.showModalUpdate = false
							this.updatedSub = {id: '', ntype: '', ntype2: '', ntype3: '', title: ''}
							this.oldSub = {ntype: '', ntype2: '', ntype3: '', title: ''}
							toastr.success(response.data.message)
						})
						.catch(err => {
							toastr.error(err.message, 'Error occured!')
						})
				}
			},

			deleteSubdata(id){
				if(confirm("Are you really sure to delete Subdata #"+id)){
					axios.delete('/subdata/' + id)
					.then(response => {
						this.subdata = this.subdata.filter(sub => {
							if(sub.id != id)
								return sub
						})
						toastr.success(response.data.message)
					})
					.catch(err => {
						toastr.error(err.message, 'Error occured!')
					})
				}				
			},
		},

		mounted() {
			// console.log('Manage subdata Component mounted.')
			
			this.readTypes()
			this.csrf = window.Laravel.csrfToken
		},

		watch:{

			updatedSub : { 
				handler(val){
		      	var oldSub = this.oldSub
					if(val.title == oldSub.title && val.desc == oldSub.desc && val.type == oldSub.type)
						this.showUpdateBtn = false
					else
						this.showUpdateBtn = true
		     },
		     deep: true				
			},
		},
	}
</script>

<style lang="sass" scoped>
th
	width: auto
td.empty
	text-align: center
	span
		color: #ccc
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