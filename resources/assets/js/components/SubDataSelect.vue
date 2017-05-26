<template>
    <div class="SubDataSelect input-group">
        <span class="input-group-addon" v-if="!loading">{{ placeholder }}</span>

        <select :class="css" class=" form-control"  v-model="newBrand"
                @change="selectedChanged" v-if="!loading" 
                :name="name == '' ? data1 : name" autofocus requiredX> 

            <option selected disabled> --- Select a {{ placeholder }} ---</option>
            <option v-for="sub in subData" :value="sub.id" >{{sub.title}}</option> 

        </select>
        <!-- selected id : {{newBrand}} -->
        <span v-else>{{ loadingmsg }}</span> 
    </div>
</template>

<script>
    export default {
        data(){
            return {
                loading: true,
                subData: [],
                newBrand: 0,
                color: '',
                autoload: 1
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
            old: {default: 0}
        },  

        methods: {

            selectedChanged(par){
                var t = this;
                var selectedOBJ = this.subData.filter(function(sub){
                    if(sub.id == t.newBrand)
                        return sub
                });
                //console.log(selectedOBJ[0].title);
                this.$emit('brand-changed', selectedOBJ[0].title);
            },

            getRequest(){
                axios.get('/readSubData/'+this.data1+'/'+this.data2  )
                    .then(response => {
                        this.loading = false;
                        //toastr.success(response.data.message);
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
            console.log('SubDataSelect Component mounted.');

            if(this.autoload)
                this.getRequest();

            this.$on('models-loaded', this.modelsLoaded);
        },

        watch: {
            loadedmodels(){
                this.subData = this.loadedmodels;
                this.loading = false;
            }
        }
    }
</script>
