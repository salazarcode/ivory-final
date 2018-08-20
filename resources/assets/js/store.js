import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)


export default new Vuex.Store({
    state: {
      marcaSeleccionada : null,
      tiposServicios: '',
      tiposCredenciales: '',
    },
    mutations: {
      setMarcaSeleccionada (state, payload) {
        state.marcaSeleccionada = payload.marca;
      },
      setTiposServicios (state, payload) {
        state.tiposServicios = payload.tiposServicios;
      },
      setTiposCredenciales (state, payload) {
        state.tiposCredenciales = payload.tiposCredenciales;
      }
    }
})