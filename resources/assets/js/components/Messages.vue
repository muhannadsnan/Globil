<template>
 <div class="msg">
    <h3 v-if="messages.length == 0">Select a conversation to show messages..</h3>
    <div class="header" v-if="afterConvClicked">
        <a href="#" class="col-xs-12X">
            <img src="images/default_user.png" class="col-xs-4 user_img">          
            <span>{{theOtherUser}}</span>          
        </a>
    </div>

<!-- MESAGES -->
   
        <div class="msg row" v-for="msg in messages">
            <div class="col-xs-12 message_text" :class="{'me text-right': msg.user_id == userId}">
                <span class="">{{msg.text}}</span>
            </div>
            <small class="datetime" :class="{'me text-right': msg.user_id == userId}">
                {{msg.created_at}}
            </small>
        </div>

<!-- TEXT AREA WITH BUTTON -->
        <div class="form-group" v-if="afterConvClicked">
            <textarea @keyup.enter="sendMessage" v-model="newMessage" class="form-control"></textarea>
        </div>

        <button @click="sendMessage" :class="{'disabled': disabled}" class="btn btn-primary btn-block" v-if="afterConvClicked">
            Send
        </button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                messages: [],
                theOtherUser: '',
                convId: '0',
                userId: 0,
                newMessage: '',
                afterConvClicked: false,
                loading: true
            }
        },
        computed: {
            disabled(){
                if(this.newMessage.length > 0)
                    return false
                return true
            },
        },

        methods: {

            readMessages(data){
                this.messages = data.messages
                this.convId = data.convId
                this.userId = data.userId
                this.theOtherUser = data.theOtherUser
                this.afterConvClicked = true
            },

            sendMessage(){
                this.loading = true
                var msg = this.newMessage
                var datetime = moment().format('YYYY-MM-DD hh:mm:ss')
                axios.post('/messages', {msg: this.newMessage, convId: this.convId})
                    .then(response => {
                        // this.userId = response.data.user_id
                        this.messages.push(
                            {text: msg, seen: 0, user_id: this.userId, created_at: datetime}
                        )
                    })
                    .catch(err => {
                        toastr.error(err.message, 'Error occured!')
                    })
                // this.loading = false // to disable the send button
                this.newMessage = ''
            },

        },

        mounted() {
            console.log('Messages Component mounted.')
            this.$root.$on('conv-clicked', this.readMessages)
            this.$root.$on('to-send-message', this.sendMessage)
        }
    }
</script>
