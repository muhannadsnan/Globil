require('./bootstrap');

const app = new Vue({
	el: '#app',

	data: {
		// user_id: '0',
		wishList: [], // for current user
		
		searchResult: ['init'],
		searchFilters: [],
		paginator: {current_page:1, per_page: 2},
		moreResults: 2,
		isActiveAll: [false,false,false,false,false,false,false,false,false,false,false,false,false], // area, city, brand, model, carType, FuelType, gear, minKm, maxKm, minPrice, maxPrice, wheelDrive, year
		// HOME PAGE SEARCH
		searchKeyword: '',
		searchTyping: false,
		loadingPage: false,

		// CREATE POST
		brand: '',
		models: '',
		loadingModel: false,
		showModal: false,
	},

	methods: {

		loadModelsByBrand(selectedBrand){
			this.loadingModel = true;

			axios.get('/readSubData/model/'+ selectedBrand )
              .then(response => {
                  this.models = response.data.data;  //console.log(response.data.data);
              })
              .catch(err => {
                  toastr.error('Error occured!', err.message);
              })
        this.loadingModel = false;
		}, //<<

		loadModelsBySubID(subID){ 
			this.loadingModel = true;

			axios.get('/readSubData/'+ subID )
              .then(response => {
                  this.models = response.data.data;  
              })
              .catch(err => {
                  toastr.error('Error occured!', err.message);
              })
        	this.loadingModel = false;
		}, //<<

		getLatestCars(){ //==================================================
			this.loadingModel = true

			axios.get('/cars/readLatestPosts?page='+this.paginator.current_page+'&per_page='+this.paginator.per_page)
	           .then(response => { console.log(response.data.data)
	           		// this.user_id = response.data.user_id
	           		this.wishList = response.data.wish_list
	               this.searchResult = response.data.data
	               ++this.paginator.current_page
	               this.moreResults = response.data.moreResults
	           })
	           .catch(err => {
	               toastr.error('Error occured!', err.message)
	           })
        	this.loadingModel = false
		}, //======================================================================

		loadMoreResults(){
			this.loadingModel = true

			++this.paginator.current_page
			axios.post('/search/results', {req: this.searchFilters, paginator: this.paginator})
					.then(response => {
						response.data.data.forEach(car => {
			         	this.searchResult.push(car)
			     		})
						this.moreResults = response.data.moreResults
					})
					.catch(err => {
						toastr.error(err.message, 'Error was occured!')
					})
			
			this.loadingModel = false
		},

		searchResultsReady(param){ // Results From Search-Filter Component // means filters changed
			this.searchFilters = param.filters
			this.paginator.current_page = 1
			axios.post('/search/results', {req: this.searchFilters, paginator: this.paginator})
					.then(response => {
						this.searchResult = response.data.data
						this.moreResults = response.data.moreResults
					})
					.catch(err => {
						toastr.error(err.message, 'Error was occured!')
					})
		},

		loadMoreLatestPosts(){
			this.loadingModel = true
			
			axios.get('/cars/readLatestPosts?page='+this.paginator.current_page+'&per_page='+this.paginator.per_page)
	           .then(response => {
	           		response.data.data.forEach(car => {
	               	this.searchResult.push(car)	           			
	           		})
	               ++this.paginator.current_page
	               this.moreResults = response.data.moreResults
	           })
	           .catch(err => {
	               toastr.error('Error occured!', err.message)
	           })
        	this.loadingModel = false
		},

		searchRequest(){
			axios.get('/search/general/'+ this.searchKeyword )
              .then(response => {
                  this.searchResult = response.data.data;  
              })
              .catch(err => {
                  toastr.error(err.message, 'Error occured!');
              })
        	this.loadingPage = false;
         this.searchTyping = false;
		}, //<<

		searchKeyEnter(){
			if(this.searchKeyword != ''){
				this.loadingPage = true
				this.searchRequest()
			}
		}, //<<

		convClicked(messages){
			this.$emit('conv-clicked', messages)
		},
	},

	mounted(){
		this.getLatestCars()
	},

	computed: {
		isActiveSearch(){
			var res = false
			this.isActiveAll.forEach(e => {
				res = res || e
			})
			return res
		},
	},

	watch:{
		searchKeyword(val){
			if(val==''){
				this.searchTyping = false;
			}
			else{
				this.searchTyping = true;
			}
		}, //<<

		isActiveSearch(val){
			if(val == true){
				this.paginator.current_page = 1 				
			}
			else{
				this.paginator.current_page = 1
			}
			// this.paginator.current_page = 1 				
			this.searchResult = []
		},
	}
});