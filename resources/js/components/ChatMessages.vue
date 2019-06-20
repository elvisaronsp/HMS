<template>
    <div id="chat-wrapper" class="shadow-sm" >
        <div class="container message-card" v-for="message in messages" >
            <div class="sent-box">
                {{ message.content }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['messages', 'authUser']
    };
</script>