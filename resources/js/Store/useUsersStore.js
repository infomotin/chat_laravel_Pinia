
import { defineStore } from 'pinia';

export const useUsersStore = defineStore('users', {
  state: () => {
    return { users: [] };
  },

  actions: {
    setUsers(users) {
      this.users = users;
      },
    
  },

  getters: {
    allUsers(state) {
      return state.users;
    },
    userCount(state) {
      return state.users.length;
    }
  }
});
