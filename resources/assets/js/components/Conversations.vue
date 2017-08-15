<template>
    <div class="conv"> 
        <a v-for="(conv, i) in conversations" href="#Spideman" class="col-sm-12 user_conv"
                @click="readMessages(conv.id, users[i])">

            <img src="images/default_user.png" class="col-xs-4 user_img">

            <div class=" col-xs-8 caption">
                <p class="user">{{users[i]}}</p>
                <p class="latest_msg">...</p>
            </div>
        </a>
        <label v-if="!anyConvs" v-cloak>No converstions yet.</label>
        <label v-if="loading">LOADING CONVERSATIONS..</label>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                conversations: [],
                users: [],
                clickedConv: {},
                loading: true,
                anyConvs: 'init',
            }
        },

        methods: {

            readConvs(){
                axios.get('/read-convs-with-user-info')
                    .then(response => {
                        this.conversations = response.data.data
                        this.users = response.data.users
                        this.loading = false
                    })
                    .catch(err => {
                        toastr.error(err.message, 'Error occured!')
                    })
            },

            readMessages(convId, user){
                axios.get('/read-messages-by-conv-id/'+convId)
                    .then(response => {
                        var msgsForClickedConv = response.data.data
                        this.$emit('conv-clicked', {messages: msgsForClickedConv, theOtherUser: user, convId: convId, userId: response.data.user_id})
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
                        console.log(err.message)
                    })
            }
        },

        mounted() {
            console.log('Conversations Component mounted.')
            this.readConvs()
        },

        watch: {
            conversations(val){
                if(val.length > 0)
                    this.anyConvs = true
                else
                    this.anyConvs = false
            }
        }
    }
</script>
