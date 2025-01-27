<script setup>
import { useMessagesStore } from '@/Store/useMessagesStore';

const messageStore = useMessagesStore();

</script>

<template>
    <main id="page-content" class="absolute inset-0">

        <div
            class="container mx-auto space-y-6 px-4 py-24 lg:p-8 lg:pb-28 xl:max-w-7xl 
            flex flex-col h-full overflow-y-auto">
            <!-- Messages Received -->

            <div v-for="message in messageStore.allMessages" :key="message.id"
                class="flex w-5/6 flex-col gap-2 lg:w-2/3 xl:w-1/3"
                :class="message.user.id == $page.props.auth.user.id ? 'items-end ms-auto' : ''">
                <p v-if="message.user.id != $page.props.auth.user.id" class="text-sm font-medium text-slate-500">
                    {{ message.user.name }}
                </p>
                <div class="rounded-2xl px-5 py-3  bg-gray-100"
                :class="{
                    'bg-indigo-600 text-white rounded-br-none': message.user.id == $page.props.auth.user.id,
                    'bg-gray-100 rounded-tl-none': message.user.id != $page.props.auth.user.id
                }"
                >
                    <p class="font-semibold"
                    :class="{
                    'text-white': message.user.id == $page.props.auth.user.id,
                    'text-slate-500': message.user.id != $page.props.auth.user.id,
                    
                }">
                        {{ message.content }}
                    </p>
                </div>
                <p class="text-xs font-medium" :class="{
                    // 'text-white': message.user.id == $page.props.auth.user.id,
                    'text-slate-500': message.user.id != $page.props.auth.user.id,
                }">
                    {{ message.created_at }}
                </p>
            </div>
            <!-- END  Messages Received -->

           
        </div>
    </main>
</template>
