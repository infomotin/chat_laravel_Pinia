<script setup>
import Messages from '@/Components/Chat/Messages.vue';
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Nev from '@/Components/Chat/Nev.vue';
import { useMessagesStore } from '@/Store/useMessagesStore';
import { useUsersStore } from '@/Store/useUsersStore';
import { onUnmounted } from 'vue';


const props = defineProps({
    room: Object,
    required: true
});

onUnmounted(() => {
    window.Echo.leave(`room.${props.room.id}`);
})


const messageStore = useMessagesStore();
const userStore = useUsersStore();
const storeMessage = (payload) => {
    console.log(payload.message);
    messageStore.storeMessage(props.room.slug, payload);
}

const channel = window.Echo.join(`room.${props.room.id}`)
    .here((users) => {
       
    }).joining((user) => {
       
    }).leaving((user) => {
        
    }).listenForWhisper('typing', (e) => {
       
    }).error((error) => {
        
    });
channel.listen('MessageCreated', (e) => {
    messageStore.pushMessage(e);
}).here((users) => {
    userStore.setUsers(users);

}).joining((user) => {
    userStore.addUser(user);
}).leaving((user) => {
    userStore.removeUser(user.id);
}).listenForWhisper('typing', (e) => {
    userStore.setTyping(e);
}).error((error) => {
    console.error(error);
});

console.log(Echo.socketId());
messageStore.fetchMessages(props.room.slug);
</script>

<template>

    <head title="Messages" />
    <div>
        <!-- Page Container -->
        <div id="page-container" class="relative mx-auto h-screen min-w-[320px] bg-white lg:ms-80">
            <!-- Page Sidebar -->
            <Nev />
            <!-- Page Sidebar -->

            <!-- Page Header -->
            <Header />
            <!-- END Page Header -->

            <!-- Page Content -->
            <!-- {{ messageStore.allMessages }} -->
            <Messages :room="room" />

            <!-- END Page Content -->

            <!-- Page Footer -->
            <Footer v-on:message="storeMessage({ content: $event })"
                v-on:typing="channel.whisper('typing', {
                    'user_id': $page.props.auth.user.id,
                    'typing': $event,
                })"
                 />
            <!-- END Page Footer -->
        </div>
        <!-- END Page Container -->
    </div>

</template>
