<template>
    <div class="WishListButton">
        <span class="fa" data-toggle="tooltip" data-placement="top" title="Add to wish list"><i class="fa fa-heart-o"></i></span>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                
            }
        },

        computed: {
        },

        props: {
            act: {}
        },  

        methods: {

            clk(){
                
            },

            postRequest(){
                axios.post(this.url, {car_id: this.data1 , user_id: this.data2 } )
                    .then(response => {
                        toastr.success(response.data.message)
                        console.log(response.data.message)
                        //alert(response.data.message)
                        this.hasClicked = true
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
            //console.log(this.user)
        }
    }
</script>
