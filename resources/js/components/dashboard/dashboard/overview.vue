<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
            <!-- <div v-for="(item, index) in books" :key="index">
				<td>{{item.status.isCompleted}}</td>
            </div> -->
			<v-row justify="center">
				<v-col cols="12" lg="3" md="3">
                    <DashboardCard :icon="'assignment'" :title="$t('message.dashboard.order')" :data="dashboard.ordertoday" :action="'Total :'+dashboard.order" :color="'grey darken-1'" ></DashboardCard>
                </v-col>
				<v-col cols="12" lg="3" md="3">
                    <DashboardCard :icon="'assignment'" :title="$t('message.dashboard.pendingorder')" :data="dashboard.orderpending" :action="'Total :'+dashboard.order"  :color="'grey darken-2'"></DashboardCard>
                </v-col>
				<v-col cols="12" lg="3" md="3">
                    <DashboardCard :icon="'assignment'" :title="$t('message.dashboard.product')" :data="dashboard.product" :action="'New Today :'+dashboard.producttoday"  :color="'grey  darken-3'"></DashboardCard>
                </v-col>
				<v-col cols="12" lg="3" md="3">
                    <DashboardCard :icon="'assignment'" :title="$t('message.dashboard.newcustomer')" :data="dashboard.customertoday" :action="'Total :'+dashboard.customer"  :color="'grey darken-4'"></DashboardCard>
                </v-col>
                <v-col cols="6">
                    <v-card
                        class="mx-auto text-center"
                        color="blue-grey darken-3"
                        dark
                    >
                        <v-card-text>
                        <v-sheet color="rgba(0, 0, 0, .12)">
                            <v-sparkline
                            :value="saleweek"
                            color="rgba(255, 255, 255, .7)"
                            height="100"
                            padding="24"
                            stroke-linecap="round"
                            smooth
                            >
                            <template v-slot:label="item">
                                {{ item.value }} {{setting.currency}}
                            </template>
                            </v-sparkline>
                        </v-sheet>
                        </v-card-text>

                        <v-card-text>
                        <div class="display-1 font-weight-thin">Earning This Week</div>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions class="justify-center">
                        <v-btn :to="handleGoToMenu('/dashboard/report/order')" block text>Go to Report</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-col cols="6">

                    <v-card
                        class="mx-auto text-center"
                        color="blue-grey darken-4"
                        dark
                       
                    >
                        <v-card-text>
                        <v-sheet color="rgba(0, 0, 0, .12)">
                            <v-sparkline
                            :value="orderweek"
                            color="rgba(255, 255, 255, .7)"
                            height="100"
                            padding="24"
                            stroke-linecap="round"
                            smooth
                            >
                            <template v-slot:label="item">
                                {{ item.value }}
                            </template>
                            </v-sparkline>
                        </v-sheet>
                        </v-card-text>

                        <v-card-text>
                        <div class="display-1 font-weight-thin">Order This Week</div>
                        </v-card-text>

                        <v-divider></v-divider>

                        <v-card-actions class="justify-center">
                        <v-btn :to="handleGoToMenu('/dashboard/report/order')" block text>Go to Report</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-col cols="12" lg="6">
					<p class="title">
						Pending Orders
					</p>
                    <v-data-table :items-per-page="itemperpage" :headers="headersOrder" :items="dashboard.orderpendinglist" :search="search" class="elevation-1">
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
                </v-col> 
                <v-col cols="12" lg="6">
					<p class="title">
						New Customers
					</p>
                    <v-data-table :items-per-page="itemperpage" :headers="headers" :items="dashboard.customerlist" :search="search" class="elevation-1">
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
                </v-col> 
			</v-row>
		</v-container>
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
import NoDataList from './../common/NoDataList'
import DashboardCard from './../common/DashboardCard'

export default {
	data: () => ({
		itemperpage:5,
		dashboard:{},
		contact:null,
		search:'',
		image:'/no_image.png',
		isCustomer:false,
		cart:[],
		setting:{},
		valid:false,
		absolute:false,
		branch:'',
		dataBranch:[],
		dataCustomer:[],
		dataProducts:[],
		dataStatus:[],
		loading: false,
		saleweek: [],
		orderweek: [],
		dataUser: [],
		userType: ["Admin", "Staff", "Customer"],
		headers: [
			{ text: "ID", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Email", value: "email" },
			{ text: "Contact", value: "contact" }
		],
		headersOrder: [
			{ text: "ID",value: "id" },
			{ text: "Customer", value: "customer_name" },
			{ text: "Address", value: "address1" },
			{ text: "Total", value: "total" },
			{ text: "Status", value: "order_status_id" }
		],
		nameRules: [
			v => !!v || 'This Field is required'
			],

	}),

	props: {
		source: String
    },
    components:{
		DashboardCard,
		NoDataList
    },
	computed: {

		
	},
	watch: {},
	created() {

		// Initialize Firebase
		if (!firebase.apps.length) {
			firebase.initializeApp(this.$store.state.firebaseConfig);
			firebase.analytics();

		}
		
			const messaging = firebase.messaging();
			messaging.requestPermission()
			.then(function() {
				return messaging.getToken()
			})
			.then(function(token){
				 axios.post('/app/firebase', {
						token: token
					})
					.then(response => (
						console.log("Push Notification")
					))
  			})
			.catch(function(error){
				console.warn('ERROR: ' + error);
			})
		messaging.onMessage((payload) => {
		});
	this.initialize();
	},
	methods: {
		handleGoToMenu(d) {
		return d;
		},
		async initialize() {
			this.start()
			this.loading=true;
            this.setting=this.$store.state.setting
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/dashboard"
				});
				this.dashboard = data;
				for(let d of data.saleweek)
				{
					this.saleweek.push(parseInt(d.count))
				}
				for(let d of data.orderweek)
				{
					this.orderweek.push(parseInt(d.count))
				}
			} catch (e) {
				this.fail();
				this.loading=false;
			}
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/user"
				});
				this.dataUser = data;
			} catch (e) {
				this.loading=false;
				this.fail();
			}
			this.loading=false;
			this.finish();

		},
		back()
		{
			this.$router.push('/dashboard/order/list');
		},
		close() {
			this.$refs.form.reset();
			this.cart = [];
			this.loading = false;
		},
		remove(item)
		{
			var index = this.cart.indexOf(item);
			this.cart.splice(index, 1);
		},
	},
	mounted()
	{

	}
};
</script>