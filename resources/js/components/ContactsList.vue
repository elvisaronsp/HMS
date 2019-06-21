<template>
    <div class="contacts-list">
        <div id="contact-wrapper" 
            v-for="(contact, index) in contacts" 
            :key="contact.id" 
            @click="selectContact(index, contact)"
            :class=" { 'selected': index == selected } ">

            <div class="card contact-card shadow-sm" :id="contact.id">
                <div class="row">
                    <div class="col-4">
                        <img  class="chat-avatar" :src="contact.avatar">
                    </div>

                    <div class="col-8">
                        <p class="contact-name">{{ contact.name }} {{ contact.surname }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selected: 0
        }
    },
    methods: {
        selectContact(index, contact) {
            this.selected = index
            this.$emit('selected', contact)
        }
    },
    props: {
        contacts: { 
            type: Array,
            default: []
        }
    }
}
</script>

