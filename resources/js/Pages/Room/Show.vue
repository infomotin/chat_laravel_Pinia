<script setup>
import Messages from '@/Components/Chat/Messages.vue';
import Footer from '@/Components/Chat/Footer.vue';
import Header from '@/Components/Chat/Header.vue';
import Nev from '@/Components/Chat/Nev.vue';
import { useMessagesStore } from '@/Store/useMessagesStore';

const messageStore = useMessagesStore();
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
            <Messages />
            
            <!-- END Page Content -->

            <!-- Page Footer -->
            <Footer v-on:message="console.log($event)"/>   
            <!-- END Page Footer -->
        </div>
        <!-- END Page Container -->
    </div>

</template>
