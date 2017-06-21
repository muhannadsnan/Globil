<template>
    <div class="ads panel panel-warning">
        <div class="panel-heading">
            Advertisements
        </div>

        <div class="panel-body">
            <a v-for="ad in ads" href="#" class="thumbnail">
                <img src="http://www.takepart.com/sites/default/files/styles/tp_gallery_slide/public/slogan-itok=C7mRvp9G.jpg"/>
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                ads: [],
            }
        },

        methods: {
            
            readAds(){
                axios.get('/read-ads')
                    .then(response => {
                        this.ads = response.data.data
                    })
                    .catch(err => {
                        toastr.error(err.message, 'Error occured!')
                    })
            },

            deleteRequest(){
                axios.delete(this.url +'/'+ this.data1 )
                    .then(response => {
                        toastr.success(response.data.message)
                        console.log(response.data.message)
                        //alert(response.data.message)
                        this.hasClicked = true
                    })
                    .catch(err => {
                        toastr.error(err.message, 'Error occured!')
                    })
            }
        },

        mounted() {
            console.log('WishListButton Component mounted.')
            this.readAds();
        }
    }
</script>
