// src/plugins/vuetify.js

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

Vue.use(Vuetify)

const opts = {
	theme : {
		dark : true,
		themes : {
			light : {

			},
			dark : {
				primary : '#34495E',
				color : '#fff'
			}
		}
	}
}

export default new Vuetify(opts)