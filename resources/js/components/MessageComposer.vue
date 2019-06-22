<template>
    <div class="composer">

        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control composer" 
                        id="exampleFormControlTextarea1" 
                        rows="3" 
                        name="message_text"
                        v-model="message"
                        @keydown.enter="send"
                        placeholder="Press Enter to send message">
                    </textarea>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    data() {
        return {
            message: ''
        }
    },
    methods: {
        send(event) {
            event.preventDefault();

            if (this.message == '') {
                return;
            }

            this.$emit('send', this.message)
            this.message = ''
        }
    }
}
</script>

<style scoped>
.composer {
    border-radius: 5px;
}
</style>


