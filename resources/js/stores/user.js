import { defineStore } from 'pinia'
import axios from 'axios'

export const useUserStore = defineStore({
  id: 'user',
  state: () => ({
    userId:null,
    userRole:null
  }),
  actions: {
    async login({ email, password }) {
        await axios.post('/user/login', { email: email, password: password }).then((res) => {
            //console.log('res',res.data.userId,res.data.userRole)
            this.userId = 1
            this.userRole = res.data.userRole

            console.log(this.userId)

        }).catch((error)=>alert('error'))
    },
  },
  persist: true,
})
