
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
// color
import colors from 'vuetify/lib/util/colors'
Vue.use(Vuetify)

export default new Vuetify({ 
    icons: {
        iconfont: 'md' 
      },
      theme: {
        themes: {
          light: {
            primary: '#00269a', // #E53935
            secondary: '#00269a', // #FFCDD2
            accent: '#00269a', // #3F51B5
          },
        }, 
      },
 })
//  Boulvardia
//  primary: '#a00037', 
//  secondary: '#d81b60', 
//  accent: '#d81b60', 