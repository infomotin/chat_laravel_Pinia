<script setup>
import Messages from '@/Components/Chat/Messages.vue';
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Nev from '@/Components/Chat/Nev.vue';
import { useMessagesStore } from '@/Store/useMessagesStore';


const props = defineProps({
    room: Object,
    required: true
});
const messageStore = useMessagesStore();
const storeMessage = (payload) => {
    console.log(payload.message);
    messageStore.storeMessage(props.room.slug,payload);
}

const channel = window.Echo.join(`room.${props.room.id}`);
channel.listen('MessageCreated', (e) => {
    console.log(e);
    messageStore.pushMessage(e);
    // messageStore.addMessage(e.message);
});

console.log(Echo.socketId());
messageStore.fetchMessages(props.room.slug);
</script>

<template>

    <head title="Messages"/>
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
            <Messages :room="room"/>
            
            <!-- END Page Content -->

            <!-- Page Footer -->
            <Footer v-on:message="storeMessage({content: $event})"/>   
            <!-- END Page Footer -->
        </div>
        <!-- END Page Container -->
    </div>

</template>
