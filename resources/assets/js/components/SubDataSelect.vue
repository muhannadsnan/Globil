<template>
    <div class="SubDataSelect input-group">
        <span class="input-group-addon" v-if="!loading || showanyway">{{ placeholder }}</span>

        <select :class="css" class=" form-control" v-model="selectedOPT" 
                @change="selectedChanged" v-if="!loading || showanyway" :data-old="old"
                :name="name == '' ? data1 : name" autofocus requiredX> 

            <option selected disabled> --- Select {{ placeholder }} --- </option>
            <option v-for="sub in subData" :value="sub.id" >{{sub.title}}</option> 

        </select>
        <!-- selected id : {{selectedOPT}} -->
        <span v-else>{{ loadingmsg }}</span> 
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
            name: { default: ''},
            data1: {},
            data2: {},
            loadedmodels: '',
            loadingmsg: { default: 'LOADING DATA ...'},
            old: {default: 0},
            showanyway: 0 
        }, 


        methods: {

            selectedChanged(par){ 
                var t = this;
                var selectedOBJ = this.subData.filter(function(sub){
                    if(sub.id == t.selectedOPT)
                        return sub
                })
                var selectedOBJECT ;
                try {
                   selectedOBJECT = selectedOBJ[0].title;
                }
                catch(err) {
                    selectedOBJECT = this.old;
                    //console.log('selectedOBJECT was reset!!!!');
                }
                console.log('selectedOBJECT: '+selectedOBJECT);
                this.$emit('brand-changed', selectedOBJECT);
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
                console.log(arr);
                this.subData = arr;
            }
        },

        mounted() {
            console.log('SubDataSelect Component mounted: ' + this.data1);

            if(this.old != 0){
                this.selectedOPT = this.old; //console.log('selectedOPT init: '+this.selectedOPT );
                this.$emit('brand-loaded', this.old);
            }

            if(this.data1)
                this.getRequest();
        },

        watch: {
            loadedmodels(){
                this.subData = this.loadedmodels;
                this.loading = false;
                this.selectedOPT = this.old;
            }
        }
    }
</script>
