<script setup>
import { set } from '@vueuse/core';
import { ref } from 'vue';
const message = ref('');
const shift = ref(false);
const emit = defineEmits(['message']);

const handelEnter = (e) => {
    if(shift.value && message.value.length > 0) {
        message.value += '\n';
        return
    }
    if(message.value.length > 0) {  
        emit('message', message.value);
        message.value = '';
        handelFinishTyping();
    }
}
let typingTimeOut = null;
const handelTyping = () => {
    clearTimeout(typingTimeOut);
    emit('typing',true);
    typingTimeOut = setTimeout(handelFinishTyping, 2000);
}
const handelFinishTyping = () => {
    clearTimeout(typingTimeOut);
    emit('typing',false);
}
</script>


<template>
    <footer id="page-footer"
        class="fixed bottom-0 end-0 start-0 items-center border-t border-slate-200/75 bg-white lg:start-80">
            <textarea  
                v-model="message" type="text"
                v-on:keydown.enter.prevent="handelEnter"
                v-on:keydown.shift="shift = true"
                v-on:keyup="shift = false"
                v-on:keydown="handelTyping"
                class="-mx-5 block w-full rounded-lg border-0 px-5 py-4 leading-6 focus:border-indigo-500 focus:ring focus:ring-indigo-500/75"
                placeholder="Type a new message and hit enter.." > 
            </textarea>
    </footer>
</template> 