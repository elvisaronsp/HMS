<template>
    <div id="chat-wrapper" ref="feed"  class="shadow-sm" v-if="contact">
        <div class="container message-card" v-for="message in messages" :key="message.id" >
            <div v-if="activeSession == 'user'" :class="message.sent_by_doctor == 0 ? 'sent-box' : 'received-box'">
                {{ message.content }}
            </div>

             <div v-else :class="message.sent_by_doctor == 0 ? 'received-box'  :   'sent-box'">
                {{ message.content }}
            </div>
        </div>
    </div>

    <div v-else id="chart-wrapper" class="shadow-sm">
    </div>
</template>

<script>
export default {
    props: {
        contact: {
            // type: Object,
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
    methods: {
        scrollToBottom() {
            setTimeout(() => {
                this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight
            }, 50);
        }
    },
    watch: {
        contact(contact) {
            this.scrollToBottom()
        },
        messages(messages) {
            this.scrollToBottom()
        }
    }
    
}
</script>

