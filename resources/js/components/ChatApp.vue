<template>
    <div class="chat-app">
        <Conversation :contact="selectedContact" :messages="messages"/>
        <ContactsList :contacts="contacts"/>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            console.log('Component mounted.')
            axios.post('/auth').then( userGuard => {
                
                if (userGuard) {
                    console.log('its user session')
                    axios.post('/doctors').then( doctorList => {
                        this.contacts = doctorList.data
                    })
                } else {
                    console.log('not user')
                }
                
            })
        }
    }
</script>
