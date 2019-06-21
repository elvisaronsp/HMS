<template>
    <div class="chat-app">
        <div class="row justify-content-center">
            <div class="col-4">
                <div id="doctor-list-wrapper">
                    <ContactsList :contacts="contacts" @selected="startConversationWith"/>
                </div>
            </div>
            
            <div class="col-8">
                <Conversation :contact="selectedContact" :messages="messages" :activeSession="activeSession"/>
            </div>   
        </div> 
    </div>
</template>

<script>
    import Conversation from './Conversation'
    import ContactsList from './ContactsList'

    export default {
        props: {
            user: {
                type: Object,
                required: true
            },
            
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
                activeSession: null
            };
        },
        mounted() {
            console.log(this.user)
            console.log('ChatApp Component mounted.')
            // check authorization guard
            axios.get('/auth').then( userGuard => {
                
                if (window.session == 'user') {
                    console.log('its user session')
                    axios.post('/doctors').then( doctorList => {
                        this.activeSession = 'user'
                        this.contacts = doctorList.data
                    })
                } else {
                    console.log('not user')
                    
                    axios.get(`/doctor/contacts/${this.user.id}`)
                        .then(doctorContacts => {
                            this.activeSession = 'doctor'
                            this.contacts = doctorContacts.data
                        })
                }
                
            })
        },
        methods: {
            startConversationWith(contact) {
                if(this.activeSession == 'user') {
                    axios.get(`/conversation/with/doctor/${contact.id}/${this.user.id}`)
                        .then( response => {
                            console.log('startConversationWith', response.data)
                            this.messages = response.data
                            this.selectedContact = contact
                        })
                } else {
                    axios.get(`/conversation/with/user/${contact.id}/${this.user.id}`)
                        .then( response => {
                            console.log('startConversationWith', response.data)
                            this.messages = response.data
                            this.selectedContact = contact
                        })
                }
            }
        },
        components: { Conversation, ContactsList }
    }
</script>
