import axios from 'axios';
import { defineStore } from 'pinia';

export const useMessagesStore = defineStore('messages', {
  state: () => {
    return { page: 1, messages: [], isLoaded: false };
  },
  // could also be defined as
  // state: () => ({ count: 0 })
  actions: {
    fetchMessages(roomSlug, page = 1) {
      // fetch messages from the server
      axios.get(`/rooms/${roomSlug}/messages?page=${page}`).then(response => {
        this.messages = [...this.messages, ...response.data.data];
        this.page = response.data.meta.current_page;
        this.isLoaded = true;
      });
    },
    // getters previous data 
    fetchPreviousMessages(roomSlug) {
      this.fetchMessages(roomSlug, this.page + 1);
    },
    storeMessage(roomSlug, payload) {
      // console.log('storeMessage', payload);
      // store message to the server
      axios.post(`/rooms/${roomSlug}/messages`, payload,{
        headers: {
          'X-Socket-ID': window.Echo.socketId(),
        }
      }).then(response => {
        this.messages = [response.data, ...this.messages];
      });
    },
    pushMessage(message) {
      this.messages = [message, ...this.messages];
    },
  },

  getters: {
    allMessages(state) {
      return state.messages;
    },
    getIsLoaded(state) {
      return state.isLoaded;
    }
  }
});
