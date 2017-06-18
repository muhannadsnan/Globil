<template>
 <div class="msg">
    <div class="header" v-if="afterConvClicked">
        <a href="#" class="col-xs-12X">
            <img src="images/default_user.png" class="col-xs-4 user_img">          
            <span>{{theOtherUser}}</span>          
        </a>
    </div>

<!-- MESAGES -->
   
        <div class="msg row" v-for="msg in messages">
            <div class="col-xs-12 message_text" :class="{'me text-right': msg.user_id == 1}">
                <span class="">{{msg.text}}</span>
            </div>
            <small class="datetime">{{msg.created_at}}</small>
        </div>

<!-- TEXT AREA WITH BUTTON -->
        <div class="form-group" v-if="afterConvClicked">
            <textarea @keyup.enter="sendMessage" v-model="newMessage" class="form-control"></textarea>
        </div>

        <button @click="sendMessage" class="btn btn-primary btn-block" v-if="afterConvClicked">
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
                newMessage: '',
                afterConvClicked: false
            }
        },

        methods: {

            readMessages(data){
                this.messages = data.messages
                this.theOtherUser = data.theOtherUser
                this.afterConvClicked = true
            },

            sendMessage(){
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
