<template>
  <v-dialog v-model="dialog" persistent max-width="780">
    <v-card>
      <v-card-title>Order #{{orderData.invoice_prefix}}{{orderData.id}}</v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12">
            <GmapMap
              :center="center"
              :zoom="zoom"
              map-type-id="terrain"
              style="width: auto; height: 300px"
            >
               <GmapPolyline :path="path" 
                  ref="polyline">
              </GmapPolyline>
            </GmapMap>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" text @click="dialog = false">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>
<script>
export default {
  data: () => ({
    dialog: false,
    zoom: 15,
    markers: [
      {
        position: {
          lat: 25.2854,
          lng: 51.531
        },
        title: "asdasd",
        ifw: true,
        ifw2text: 'This text is bad please change me :( '
      }
    ]
  }),
  created() {

  },
  props: {
    trigger: false,
    orderData: Object,
    path: Array,
  },
  methods: {
   

  },

  computed: {
    center(){
      if(this.path.length)
        return { lat: this.path[0].lat, lng: this.path[0].lng }
      else
        return { lat: 25.2854, lng: 51.531 }
    }
    // path() {
    //   let path =[]
    //   for(const d of this.orderData.path)
    //   {
    //     path.push(
    //       {
    //         lat:d.lat,
    //         lng:d.lon,
    //       }
    //     )
    //   }
    //   return path
    // }
  },
  watch: {
    trigger() {
      this.dialog = true;
    },

  }
};
</script>
