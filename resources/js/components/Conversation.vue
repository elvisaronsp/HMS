<template>
    <div class="conversation">
        <MessagesFeed :contact="contact" :messages="messages" :activeSession="activeSession"/>
        <MessageComposer v-if="contact" @send="sendMessage"/>
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
            let objForAxios = (activeSession) => {
                if (this.activeSession == 'user') {
                    return { 
                        user_id: this.$parent.user.id,
                        doctor_id: this.contact.id,
                        content: text,
                        sent_by_doctor: 0
                    }
                } else {
                    return {
                        user_id: this.contact.id,
                        doctor_id: this.$parent.user.id,
                        content: text,
                        sent_by_doctor: 1
                    }
                }
            }
            axios.post('/conversation/send', objForAxios())
                .then(response => {
                    this.$emit('new', response.data)
                })
        }
    },
    components: { MessagesFeed, MessageComposer }
}
</script>