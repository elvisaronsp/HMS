<template>
    <div class="chat-app">
        <div class="row justify-content-center">
            <div class="col-4">
                <div id="doctor-list-wrapper">
                    <ContactsList :contacts="contacts" @selected="startConversationWith"/>
                </div>
            </div>
            
            <div class="col-8">
                <Conversation :contact="selectedContact" :messages="messages" :activeSession="activeSession" @new="saveNewMessage"/>
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
            // listen NewMessage event with Echo
            Echo.channel('messages.' + this.user.id)
                .listen('NewMessage', event => {
                    this.handleIncoming(event.message)
                })

            console.log('logged user',this.user)

            // check authorization guard
            axios.get('/auth').then( userGuard => {   
                if (window.session == 'user') {
                    console.log('user session detected')
                    // fetch doctor list if its user session
                    axios.post('/doctors').then(doctorList => {
                        this.activeSession = 'user'
                        this.contacts = doctorList.data
                    })
                } else {
                    console.log('doctor session detected')
                    // fetch user list if its doctor's session
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
                // fetch messages based on authorised session
                if (this.activeSession == 'user') {
                    // messages for user
                    axios.get(`/conversation/with/doctor/${contact.id}/${this.user.id}`)
                        .then( response => {
                            this.messages = response.data
                            this.selectedContact = contact
                        })
                } else {
                    // messages for doctor
                    axios.get(`/conversation/with/user/${contact.id}/${this.user.id}`)
                        .then( response => {
                            this.messages = response.data
                            this.selectedContact = contact
                        })
                }
            },
            saveNewMessage(text) {
                this.messages.push(text)
            },
            handleIncoming(message) {
                if (window.session == 'user') {
                    if (this.selectedContact && message.doctor_id == this.selectedContact.id) {
                        this.saveNewMessage(message)
                    }
                } else {
                    if (this.selectedContact && message.user_id == this.selectedContact.id) {
                        this.saveNewMessage(message)
                    }
                }
            },
        },
        components: { Conversation, ContactsList }
    }
</script>
