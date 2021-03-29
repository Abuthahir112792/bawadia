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
              <GmapMarker
                :position="position"
                icon="/bike.png"
              />
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
    center: {
      lat: 25.2854,
      lng: 51.531
    },
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
    // Your web app's Firebase configuration
    // Initialize Firebase
    if (!firebase.apps.length) {
	  	firebase.initializeApp(this.$store.state.firebaseConfig);
      firebase.analytics();
    }

  },
  props: {
    trigger: false,
    orderData: Object
  },
  methods: {
    mapitem(i) {
      this.center.lat = i.lat;
      this.center.lng = i.long;
    },
    mapData()
    {
        const reference= "RiderLocations/"+this.orderData.id+"/coords"
        let db = firebase.database().ref(reference);
        db.on("value", function(snapshot) {
        let loc=snapshot.val();
        if(loc && this.center)
        {
            this.mapitem(loc)
            
        }
        }.bind(this))

    }
  },

  computed: {
    position() {
      var position = {
        lat: this.center.lat,
        lng: this.center.lng
      };
      return position;
    }
  },
  watch: {
    trigger() {
      this.dialog = true;
      this.mapData();
    },

  }
};
</script>
