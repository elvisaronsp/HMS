<template>
    <div id="chat-wrapper" class="shadow-sm" v-if="contact" >
        <div class="container message-card" v-for="message in messages" :key="message.id" >
            <div v-if="activeSession == 'user'" :class="message.sent_by_doctor == 0 ? 'sent-box' : 'received-box'">
                {{ message.content }}
            </div>

             <div v-else :class="message.sent_by_doctor == 0 ? 'sent-box'  :   'received-box'">
                {{ message.content }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        contact: {
            type: Object,
            required: true
        },
        messages: {
            type: Array,
            required: true
        },
        activeSession: {
            type: String
        }
    },
    
}
</script>

