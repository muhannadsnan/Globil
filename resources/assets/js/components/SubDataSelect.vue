<template>
    <div class="SubDataSelect input-group">
        <span class="input-group-addon" v-if="!loading || showanyway">{{ placeholder }}</span>

        <select :class="css" class=" form-control" v-model="selectedOPT" 
                @change="selectedChanged" v-if="!loading || showanyway" :data-old="old"
                :name="name != ''? name : data1" autofocus requiredX> 

            <option selected disabled> --- Select {{ placeholder }} --- </option>
            <option v-for="sub in subData" :value="sub.id" >{{sub.title}}</option> 

        </select>
        <!-- selected id : {{selectedOPT}} -->
        <span class="loading" v-else>{{ loadingmsg }}</span> 
    </div>
</template>

<script>
    export default {
        data(){
            return {
                loading: true,
                subData: [],
                selectedOPT: 0,
                color: '',
            }
        },

        props: {
            placeholder: {},
            css: {default: 'nocss'},
            name: { default: ''}, // the same as data1 mostly but varies for some DB columns
            data1: {},
            data2: {},
            loadedmodels: '',
            loadedcities: '',
            loadingmsg: { default: 'LOADING DATA ...'},
            old: {default: 0},
            showanyway: 0 
        }, 


        methods: {

            selectedChanged(par){ 
                // console.log('selectedChanged '+this.data1)
                var t = this;
                var selectedOBJ = this.subData.filter(function(sub){
                    return sub.id == t.selectedOPT
                })
                var selectedOBJECT ;
                try {
                   selectedOBJECT = selectedOBJ[0].title;
                }
                catch(err) {
                    selectedOBJECT = this.old;
                }
                
                // if(this.loadedmodels == '' && this.loadedcities == ''){ alert('sss')
                    if(this.data1 == 'brand'){ //console.log('brand-changed')
                        this.$emit('brand-changed', selectedOBJECT); //alert('brand-changed')
                    }else if(this.data1 == 'area'){ //console.log('area-changed')
                        this.$emit('area-changed', selectedOBJECT); //alert('area-changed')
                    }
                // }
                
            },

            getRequest(){
                axios.get('/readSubData/'+this.data1+'/'+this.data2  )
                    .then(response => {
                        this.loading = false;
                        this.subData = response.data.data;
                    })
                    .catch(err => {
                        toastr.error('Error was occured!', err.message);
                    })
            },

            modelsLoaded(arr){
                console.log('Models Loaded');
                //console.log(arr);
                this.subData = arr;
            }
        },

        mounted() {
            console.log('SubDataSelect Component mounted: ' + (this.data1? this.data1 : this.name));

            

            if( ! ['model', 'city'].includes(this.data1) /*&& this.old*/){
                this.getRequest()
            }

            if(this.old != 0){
                this.selectedOPT = this.old; // console.log('selectedOPT init: '+this.selectedOPT );
                
                if(this.data1 == 'brand'){ //alert('brand-loaded')
                    this.$emit('brand-loaded', this.old)
                }
                else if(this.data1 == 'area'){ //alert('area-loaded')
                    this.$emit('area-loaded', this.old)
                }
            }

        },

        watch: {
            loadedmodels(){
                this.subData = this.loadedmodels;
                this.loading = false;
                this.selectedOPT = this.old;
            },

            loadedcities(){
                this.subData = this.loadedcities;
                this.loading = false;
                this.selectedOPT = this.old;
            }
        }
    }
</script>

<style lang="sass" scoped>
.input-group-addon
    font-weight: bold
.loading
    color: #aaa
    font-size: 9pt
</style>