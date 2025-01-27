import axios from 'axios';
import { defineStore } from 'pinia';

export const useMessagesStore = defineStore('messages', {
    state: () => {
      return { page: 1, messages: [] }
    },
    // could also be defined as
    // state: () => ({ count: 0 })
    actions: {
      fetchMessages(roomSlug,page=1) {
        // fetch messages from the server
        axios
      }
    },
    getters: {
      allMessages(state) {
        return state.messages;
      }
    }
  });
