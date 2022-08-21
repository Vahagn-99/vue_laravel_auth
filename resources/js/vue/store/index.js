import { createStore } from 'vuex'
import axiosClient from "../axios";
import axios from 'axios'
// Create a new store instance.

const store = createStore({

  state: {
    user: {
      data: sessionStorage.getItem('user'),
      token: sessionStorage.getItem('_TOKEN')
    },
    products: [],
  },

  getters: {
    getProducts: (state) => state.products,
    getAuthUser: (state) => state.user.data,
  },

  actions: {
    fetchProducts({ commit }, products) {
      axios.get('/api/products').then(
        res => res.data.data
      ).then(
        (res) => {
          console.log(res);
          return commit('SET_PRODUCTS', res)
        }
      )
    },

    logout({ commit }, user) {
      axiosClient.post('/logout').then(
        () => {
          commit('FORGET_USER')
          return null;
        }
      ).catch((err) => console.log(err))
    },

    register({ commit }, user) {
      return axiosClient.post('/register', user)
        .then((res) => res.data.data)
        .then((res) => {
          commit("SET_USER", res);
          return res;
        });
    },

    login({ commit }, user) {

      return axiosClient.post('/login', user)
        .then((res) => res.data.data)
        .then((res) => {
          console.log(res);
          commit("SET_USER", res);
          return res;
        });
    }
  },

  mutations: {

    SET_PRODUCTS: (state, products) => {
      state.products = products;
    },

    SET_USER: (state, user) => {
      sessionStorage.setItem('_TOKEN', user.token);
      state.user.token = user.token
      state.user.data = user
    },

    FORGET_USER: (state) => {
      sessionStorage.removeItem('_TOKEN');
      state.user = [];
    }
  },

  modules: {

  }

})

export default store 