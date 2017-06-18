
require('./bootstrap');

const app = new Vue({
	el: '#app',

	data: {
		searchResult: ['init'],
		// HOME PAGE SEARCH
		searchKeyword: '',
		searchTyping: false,
		loadingPage: false,

		// CREATE POST
		brand: '',
		models: '',
		loadingModel: false,
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

		searchResultsReady(ResultsFromSearchFilterComponent){
			this.searchResult = ResultsFromSearchFilterComponent;
		},

		searchKeyEnter(){
			if(this.searchKeyword != ''){
				this.loadingPage = true;
				this.searchRequest();
			}
		}, //<<

		convClicked(messages){
			this.$emit('conv-clicked', messages)
		},

		// toSendMessage(e){
		// 	this.$emit('to-send-message', msg)
		// },
	},

	mounted(){

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
	}
});
