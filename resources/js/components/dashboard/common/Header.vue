<template>
  <v-app-bar :clipped-left="$vuetify.breakpoint.lgAndUp" app dark color="primary" >
    <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
      <v-app-bar-nav-icon @click="drawerTrigger"></v-app-bar-nav-icon>
      <span class="hidden-sm-and-down">{{dataSetting.name}}</span>
    </v-toolbar-title>
    <v-progress-linear
      :active="showFullLoading"
      :indeterminate="showFullLoading"
      absolute
      bottom
      color="white"
    ></v-progress-linear>
    <!-- <v-text-field
      flat
      solo-inverted
      hide-details
      prepend-inner-icon="search"
      label="Search"
      class="hidden-sm-and-down"
    ></v-text-field> -->
    <div class="flex-grow-1"></div>
    <v-btn :to="handleGoToMenu('/dashboard/order/add')" text>
      <v-icon>add_box</v-icon> Add Order
    </v-btn>
    <v-btn :to="handleGoToMenu('/dashboard/order/pendinglist')"  text>
      <v-badge
        :content="pendingCount"
        :value="pendingCount"
        color="green"
        overlap
      >
      <v-icon>view_list</v-icon> Pending Order
      </v-badge>
    </v-btn>
    <v-btn @click="refresh" text>
      <v-icon>cached</v-icon>
    </v-btn>
    <v-btn icon large>
      <v-avatar size="32px" item>
        <v-img :src="dataUser.image" :alt="dataUser.name"></v-img>
      </v-avatar>
    </v-btn>
    		<v-snackbar
			v-model="snackbar"
			:vertical="snackvertical"
			:timeout="snacktimeout"
			:top="snacktop"
			:right="snackright"
			:color="snackcolor"
		>
			{{ snacktext }}
			<v-btn color="white" text @click="snackbar = false">Close</v-btn>
		</v-snackbar>
    <v-dialog v-model="isNew" max-width="290">
      <v-card>
        <v-card-title class="headline">New order arrived</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="green darken-1" text @click="isNew = false">Close</v-btn>
          <v-btn color="green darken-1" text @click="goPendingList">Go to list</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app-bar>
</template>

<script>
export default {
  props: {
    source: String
  },
  data: () => ({
    isNew: false,
    drawer: false,
    dialog: false,
    dataUser: {},
    dataSetting: {},
    pendingCount: 0,
    	audioFile: new Audio('/alarm_tone.mp3'),

  }),
    watch: {
	  isNew() {
		if (this.isNew) {
      this.audioFile.loop = true;
			this.audioFile.play();
		}
		else {
      this.audioFile.loop = false;
			this.audioFile.pause();
		}
	  }
  },
  created() {
    this.dataUser = this.$store.state.authUser;
    this.dataSetting = this.$store.state.setting;

    // Initialize Firebase
    if (!firebase.apps.length) {
	  	firebase.initializeApp(this.$store.state.firebaseConfig);
      firebase.analytics();
    }
    const messaging = firebase.messaging();
    messaging.onMessage(payload => {
      this.isNew=true
    });

    const channel = new BroadcastChannel('listener');
      channel.addEventListener('message', (event) => {
      this.isNew=true
      });
  },
  methods: {
    drawerTrigger() {
      this.drawer = !this.drawer;
      this.$emit("send", this.drawer);
    },
    handleGoToMenu(d) {
      return d;
    },
    refresh()
    {
      location.reload()
    },
    goPendingList()
    {
      if(this.$router.currentRoute.path=='/dashboard/order/pendinglist')
      {
        this.refresh()
      }
      else
      {
        this.pendingCount=0
        this.$router.push('/dashboard/order/pendinglist');
      }

    }
  },
  mounted() {

  },
};
</script>