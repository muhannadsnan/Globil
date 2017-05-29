<template>
    <div class="EditImagesComponent" >
        <div v-for="(img, index) in images" class=" col-md-3 col-xs-6" v-if="!loading">
            <img :src="path+'/'+img.id+'.'+img.ext" class="thumbnail col-xs-12" :class="css" alt="" />
            <button @click.prevent="deleteRequest(img, index)" class="btn btn-danger button-div" data-toggle="tooltip" data-placement="bottom" title="Remove Image">
                <i class="fa fa-trash font-22pt" aria-hidden="true"></i>
            </button>             
        </div>
        <span v-else>LOADING IMAGE..</span>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                images: [],
                url: '/images-for-car',
                loading: 1
            }
        },

        computed: {
            src(i){ console.log(i);
                return '../storage/images'+i.id + '.' + i.ext;
            }
        },

        props: {
            css: {},
            carid: {},
            path: {}
        },  

        methods: {

            loadImagesForCar(){
                axios.get(this.url+'/'+this.carid)
                    .then(response => {
                        //toastr.success(response.data.message);
                        //console.log(response.data.message);
                        //alert(response.data.message);
                        this.images = response.data.data;
                        this.loading = 0;
                    })
                    .catch(err => {
                        toastr.error('Error was occured!', err.message);
                        //console.log(err.message);
                    })
            },

            deleteRequest(img, i){
                axios.delete(this.url +'/'+ img.id )
                    .then(response => {
                        toastr.success(response.data.message);
                        Vue.delete(this.images, i);
                    })
                    .catch(err => {
                        toastr.error('Error was occured!', err.message);
                        //console.log(err.message);
                    })
            }
        },

        mounted() {
            console.log('EditImages Component mounted.');
            this.loadImagesForCar();
            console.log('Images for the CAR were loaded. ');

        }
    }
</script>
