<script setup>
import Messages from '@/Components/Chat/Messages.vue';
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Nev from '@/Components/Chat/Nev.vue';
import { useMessagesStore } from '@/Store/useMessagesStore';
import { useUsersStore } from '@/Store/useUsersStore';


const props = defineProps({
    room: Object,
    required: true
});
const messageStore = useMessagesStore();
const userStore = useUsersStore();
const storeMessage = (payload) => {
    console.log(payload.message);
    messageStore.storeMessage(props.room.slug, payload);
}

const channel = window.Echo.join(`room.${props.room.id}`);
    // .here((users) => {
    //     console.log(users);
    // }).joining((user) => {
    //     console.log(user);
    // }).leaving((user) => {
    //     console.log(user);
    // }).listenForWhisper('typing', (e) => {
    //     console.log(e);
    // }).error((error) => {
    //     console.error(error);
    // });
channel.listen('MessageCreated', (e) => {
    messageStore.pushMessage(e);
}).here((users) => {
    userStore.setUsers(users);

}).joining((user) => {
    userStore.addUser(user);
}).leaving((user) => {
    userStore.removeUser(user.id);
}).listenForWhisper('typing', (e) => {
    console.log(e);
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
            <Footer v-on:message="storeMessage({ content: $event })" />
            <!-- END Page Footer -->
        </div>
        <!-- END Page Container -->
    </div>

</template>
