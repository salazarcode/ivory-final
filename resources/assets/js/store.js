import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


export default new Vuex.Store({
    state: {
      marcaSeleccionada : null
    },
    mutations: {
      setMarcaSeleccionada (state, payload) {
        state.marcaSeleccionada = payload.marca;
      }
    }
})