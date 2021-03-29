<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
                    <GmapMap
                    :center="center"
                    :zoom="zoom"
                    map-type-id="terrain"
                    style="width: auto; height: 600px"
                    @click="newmark"
                    >
        	      <GmapMarker
					v-for="(marker,index) in markers"
					:key="index"
					:position="marker.position"
					icon="/bike.png"
					@click="orderView(marker.order)"
					>
					<GmapInfoWindow>Order #{{marker.order}}</GmapInfoWindow>
        	      </GmapMarker>
            </GmapMap>
				</v-col>
				<v-col sm="12" md="12" lg="11">
					{{markers.length>0?'':'No active on way order'}}
				</v-col>
			</v-row>
		</v-container>
		<OrderView :trigger="isOrderView" :orderData="currentOrder" @send="finishRide"></OrderView>
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
	</v-content>
</template>

<script>
import NoDataList from "./../common/NoDataList"
import OrderView from "./../order/OrderView"
export default {
	components:{
		NoDataList,
		OrderView

	},
	
	data: () => ({
		isSatStart:false,
		isSatEnd:false,
		isSunStart:false,
		isSunEnd:false,
		isMonStart:false, 
		isMonEnd:false,
		isTueStart:false,
		isTueEnd:false,
		isWedStart:false,
		isWedEnd:false,
		isThuStart:false,
		isThuEnd:false,
		isFriStart:false,
		isFriEnd:false,
		isOrderView:false,
		currentOrder:{},
		zoom:13,
		 center: {
            lat: 25.251059,
            lng: 51.453807
          },
          markers: [ {
            position: {
              lat: 25.251059,
              lng: 51.453807
            }
          }],
		search: "",
		place: null,
		absolute: true,
		loading: false,
		edit: true,
		dialog: false,
		dataList: [],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Address", value: "address" },
			{ text: "Email", value: "email" },
			{ text: "Contact", value: "contact_1" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		emailRules: [
			v => !!v || "E-mail is required",
			v => /.+@.+/.test(v) || "E-mail must be valid"
		],
		editedIndex: -1,
		editedItem: {
			name:"",
			email: "",
			address: "",
			contact_1: "",
            contact_2: "",
			pickup_time:"30",
			radious:15,
			preparetion_time: "30",
			delivery_time: "45",
            invoice_prefix:"2019-",
            sat_start: "08:00",
            sat_end:"22:00",
            sun_start: "08:00",
            sun_end:"22:00",
            mon_start: "08:00",
            mon_end:"22:00",
            tue_start: "08:00",
            tue_end:"22:00",
            wed_start: "08:00",
            wed_end:"22:00",
            thu_start: "08:00",
            thu_end:"22:00",
            fri_start: "08:00",
            fri_end:"22:00",
              lat: 25.251059,
              lng: 51.453807,
			status: 1,
		},
		defaultItem: {
			name:"",
			email: "",
			address: "",
			contact_1: "",
            contact_2: "",
			pickup_time:"30",
			radious:15,
			preparetion_time: "30",
			delivery_time: "45",
            invoice_prefix:"2019-",
            sat_start: "08:00",
            sat_end:"22:00",
            sun_start: "08:00",
            sun_end:"22:00",
            mon_start: "08:00",
            mon_end:"22:00",
            tue_start: "08:00",
            tue_end:"22:00",
            wed_start: "08:00",
            wed_end:"22:00",
            thu_start: "08:00",
            thu_end:"22:00",
            fri_start: "08:00",
            fri_end:"22:00",
              lat: 25.251059,
              lng: 51.453807,
			status: 1,
		},
		dataStatus: [
			{ name: "Active", value: 1 },
			{ name: "Disable", value: 0 }
		]
	}),

	props: {
		source: String
	},
	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		},
		position()
		{
			var position =
			{
				lat: this.editedItem.lat,
				lng: this.editedItem.lng

			}
			return position;

		}
	},
	watch: {},
	created() {
        this.initialize();
		// Initialize Firebase
		if (!firebase.apps.length) {
		firebase.initializeApp(this.$store.state.firebaseConfig);
		firebase.analytics();
		}
		this.mapData();
	},
	methods: {
		async orderView(id)
		{
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/order/"+id
				});
				this.currentOrder = data;
				this.isOrderView=!this.isOrderView
			} catch (e) {
				this.isOrderView=false
				this.snacks("Failed", "red");
			}

		},
		mapitem(i) {
			this.center.lat = i.lat;
			this.center.lng = i.long;
		},
		finishRide(orderId)
		{
			this.locading=true
			try {
				firebase.database().ref('RiderLocations/' + orderId +'/status').set({
					isCompleted: 1
				});
				this.snacks("Successfully done", "green");
			} catch (e) {
				this.snacks("Failed!!", "red");
				this.locading=false
			}
			this.locading=false

		},
		mapData()
		{

			const reference= "RiderLocations"
			let db = firebase.database().ref(reference);
			db.on("value", function(snapshot) {
				this.markers = []
				const order = snapshot.val()
				for(let key of Object.keys(order))
				{
					if(order[key].status.isCompleted==0)
					this.markers.push({
						order: key,
						position: {
							lat: order[key].coords.lat,
							lng: order[key].coords.long
						}
					})                
				}
			}.bind(this))

		},
			newmark(i)
			{
				this.editedItem.lat=i.latLng.lat();
				this.editedItem.lng=i.latLng.lng();
			},
			setPlace(place) {
				this.center.lat=place.geometry.location.lat();
				this.center.lng=place.geometry.location.lng();
				this.editedItem.lat=place.geometry.location.lat();
				this.editedItem.lng=place.geometry.location.lng();
				this.zoom=16
		},
			async initialize() {
				try {
					let { data } = await axios({
						method: "get",
						url: "/app/branch"
					});
					this.dataList = data;
				} catch (e) {}
			},
			editItem(item) {
				this.edit = false;
				this.editedIndex = this.dataList.indexOf(item);
				this.editedItem = Object.assign({}, item);
				this.center.lat=this.editedItem.lat;
				this.center.lng=this.editedItem.lng;
				this.zoom=16;
				this.dialog = true;
			},
			deleteItem(item) {
				const index = this.dataList.indexOf(item);
				confirm("Are you sure you want to delete this item?") &&
					this.dataList.splice(index, 1);
			},
			close() {
				this.dialog = false;
				this.loading = false;
				setTimeout(() => {
					this.editedItem = Object.assign({}, this.defaultItem);
					this.editedIndex = -1;
				}, 300);
			},
			async save() {
				this.loading = true;
				if (this.editedIndex > -1) {
					try {
						let { data } = await axios({
							method: "put",
							url: "/app/branch/" + this.editedItem.id,
							data: this.editedItem
						});
						if (data.status) {
							this.snacks("Successfully Added", "green");
							Object.assign(this.dataList[this.editedIndex], this.editedItem);
							this.close();
						} else {
							this.snacks("Failed", "red");
							this.loading = false;
						}
					} catch (e) {
						this.snacks("Failed", "red");
						this.loading = false;
					}
				} else {
				try { 
					let { data } = await axios({
						method: "post",
						url: "/app/branch",
						data: this.editedItem
					});
					if (data.status) {
						this.dataList.unshift(data.data);
						this.snacks("Successfully Added", "green");
						this.close();
					} else {
						this.snacks("Failed", "red");
						this.loading = false;
					}
				} catch (e) {
					this.snacks("Failed", "red");
					this.loading = false;
				}
			}
		}
	}
};
</script>
<style >
.inputSearch{
	padding: 16px;
	border-bottom: 1px solid grey;
  float: left;
  width: 100%;
  background: #f1f1f1;
}
</style>