<template>
    <div class="conversation">
        <!-- <h1>{{ contact ? contact.name : 'Select contact' }}</h1> -->
        <div id="chat-wrapper">
            <MessagesFeed :contact="contact" :messages="messages" :activeSession="activeSession"/>
        </div>
        <MessageComposer @send="sendMessage"/>
    </div>
</template>

<script>
import MessagesFeed from './MessagesFeed'
import MessageComposer from './MessageComposer'

export default {
    props: {
        contact: {
            type: Object,
            default: null
        },
        messages: {
            type: Array,
            default: []
        },
        activeSession: {
            type: String
        }
    },
    methods: {
        sendMessage(text) {
            console.log('sendMessage method in Conversaion', text)
        }
    },
    components: { MessagesFeed, MessageComposer }
}
</script>