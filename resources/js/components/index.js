import Vue from 'vue'
import { HasError, AlertError, AlertSuccess } from 'vform'

[
  HasError,
  AlertError,
  AlertSuccess
].forEach(Component => {
  Vue.component(Component.name, Component)
})
