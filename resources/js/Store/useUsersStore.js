
import { defineStore } from 'pinia';

export const useUsersStore = defineStore('users', {
  state: () => {
    return { users: [] };
  },

  actions: {
    setUsers(users) {
      this.users = users;
      },
    addUser(user) {
      if(!this.users.some(u => u.id === user.id)) {
        this.users = [user, ...this.users];
      }
      // this.users = [user, ...this.users];
    },
    removeUser(id) {
      this.users = this.users.filter(user => user.id !== id);
    },
    updateUser(id, user) {
      this.users = this.users.map(u => u.id === id ? { ...u, ...user } : u);
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
