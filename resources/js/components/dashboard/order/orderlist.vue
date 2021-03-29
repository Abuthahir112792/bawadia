<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="12">
                    <v-row >
						<v-col sm="6" md="3" lg="3">
							<v-menu
								v-model="date1"
								:close-on-content-click="false"
								:nudge-right="40"
								transition="scale-transition"
								offset-y
								min-width="290px"
								
							>
								<template v-slot:activator="{ on }">
								<v-text-field
									v-model="filters.start"
									
									label="Picker without buttons"
									readonly
									prepend-inner-icon="event"
									v-on="on"
									filled
								></v-text-field>
								</template>
								<v-date-picker @change="getOrder" v-model="filters.start" @input="date1 = false"></v-date-picker>
							</v-menu>
						</v-col>
						<v-col sm="6" md="3" lg="3">
							<v-menu
								v-model="date2"
								:close-on-content-click="false"
								:nudge-right="40"
								transition="scale-transition"
								offset-y
								min-width="290px"
							>
								<template v-slot:activator="{ on }">
								<v-text-field
									v-model="filters.end"
									
									label="Picker without buttons"
									prepend-inner-icon="event"
									readonly
									v-on="on"
									filled
								></v-text-field>
								</template>
								<v-date-picker @change="getOrder" v-model="filters.end" @input="date2 = false"></v-date-picker>
							</v-menu>
						</v-col>
                        <v-col cols="6">
                            <v-select
                                v-model="filters.branch_id"
                                :items="dataBranch"
                                item-text="name"
                                item-value="id"
                                label="Branch"
                                required
								clearable
                                filled
								@change="getOrder"
								:disabled="this.authUser.type==2"
                            ></v-select>                            
                        </v-col>
                        <v-col cols="6" offset="6">
                        <v-text-field
                            
							v-model="search"
							append-icon="search"
							label="Search"
							hide-details
							outlined

						></v-text-field>
                        </v-col>
                    </v-row>
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.order.list')}}</v-toolbar-title>
						<v-divider class="mx-2" inset vertical></v-divider>
						<v-spacer></v-spacer>

					</v-toolbar>
                    <v-card flat>
                        <v-card-text>
                            <v-data-table  :headers="headers" :items="dataList" :search="search"
							                :items-per-page="filters.show"

                                hide-default-footer
                            >
                                <template v-slot:item.created_at="{ item }">
                                    <span>{{ item.created_at | moment("from") }}</span>
                                </template>        
                                <template v-slot:item.order_status_id="{ item }">
									<v-select
										v-model="item.order_status_id"
										:items="dataStatus"
										item-text="name"
										item-value="id"
										solo
										dense
										class="mt-3"
										style="max-width: 150px"
										@change="changeStatus(item)"
									></v-select>   
                                </template>   
								<template v-slot:item.total="{ item }">
									{{parseInt(item.total)-parseInt(item.discount)}}
								</template>                 
                                <template v-slot:item.action="{ item }">
                                    <v-icon color="blue"  @click="editItem(item)">edit</v-icon>
                                    <v-icon color="black"  @click="viewItem(item)">remove_red_eye</v-icon>
                                    <v-icon v-if="item.order_status_id==3" color="green"  @click="viewMap(item)">map</v-icon>
                                    <v-icon  color="green" v-if="item.path.length"  @click="viewRiderPath(item)">navigation</v-icon>
									<v-icon  color="grey"  @click="print(item.id)">print</v-icon>
                                    <v-btn v-if="item.delivery_agent==0" x-small color="warning"  @click="assignItem(item)">assign</v-btn>
                                    <v-btn v-else-if="item.order_status_id==1 || item.order_status_id==2 " x-small color="primary"  @click="assignItem(item)">change</v-btn>
                                </template>
                                <template v-slot:no-data>
                                    <v-skeleton-loader v-if="loading" type="table-tbody"></v-skeleton-loader>
										<h3 v-else>No Data Found</h3>
                                    <v-btn color="primary" @click="initialize" class="ma-3">Reset</v-btn>
                                </template>
                            </v-data-table>
                            <div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getOrder"
                                ></v-pagination>
                            </div>
                        </v-card-text>
                    </v-card>
				</v-col>
			</v-row>
			<OrderView :trigger="isView" :orderData="editedItem"></OrderView>
			<MapView :trigger="isMap" :orderData="editedItem"></MapView>
			<RiderPath v-if="path.length" :path="path" :trigger="isRiderPath" :orderData="editedItem"></RiderPath>
			<v-btn bottom color="primary" dark fab fixed right @click="save">
				<v-icon>add</v-icon>
			</v-btn>
		</v-container>
		<v-dialog
			v-model="isAssign"
			max-width="350"
			>
			<v-card>
				<v-card-title class="headline">Assign a Delivery Agent</v-card-title>

				<v-card-text>
					<v-select
						v-model="editedItem.delivery_agent"
						:items="dataDeliveryAgent"
						item-text="name"
						item-value="id"
						:rules="[v => !!v || 'Delivery Agent is required']"
						label="Delivery Agent"
						required
						filled
					></v-select>
				</v-card-text>

				<v-card-actions>
				<v-spacer></v-spacer>

				<v-btn
					color="red"
					text
					@click="isAssign = false"
				>
					Close
				</v-btn>

				<v-btn
					color="green"
					text
					@click="assignAgent"
					:disabled="loading"
					:loading="loading"
				>
					Assign
				</v-btn>
				</v-card-actions>
			</v-card>
			</v-dialog>
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
import OrderView from "./OrderView";
import MapView from "./MapView";
import RiderPath from "./RiderPath";
export default {
	components: {
		OrderView,
		MapView,
		RiderPath
	},
	data: () => ({
		date1:false,
		date2:false,
		isAssign:false,
		isMap:false,
		isRiderPath:false,
		setting:{},
        itemsPerPage:1,
        pageCount:2,
		search: "",
		absolute: true,
		loading: false,
		edit: true,
		dialog: false,
        dataList: [],
        dataCategory:[],
		dataBranch:[],
		dataDeliveryAgent:[],
        branch:[],
        filters:
        {
            category_id:null,
			branch_id:null,
			start:new Date().toISOString().substr(0, 10),
			end:new Date().toISOString().substr(0, 10),
			page: 1,
			show: 20,
        },
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Type", align: "left", value: "type" },
			{ text: "Order Time", value: "created_at" },
			{ text: "Customer", value: "customer_name" },
			{ text: "Address", value: "address1" },
			{ text: "Total", value: "total" },
			{ text: "Status", value: "order_status_id" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {

		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isView:false,
		editedItem: {

		},
		path: [],
		dataStatus: [
			
		]
	}),

	props: {
		source: String
	},
	computed: {
		formTitle() {
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		}
	},
	watch: {},
	created() {
		this.authUser=this.$store.state.authUser
		if(this.authUser.type==2)
		{
			this.filters.branch_id=this.authUser.branch_id
			this.initialize();
		}
		else
		{
			this.initialize();
		}
	},
	methods: {
			print(id)
    {
      let route = this.$router.resolve({path: '/app/print/'+id});
      // let route = this.$router.resolve('/link/to/page'); // This also works.
      window.open(route.href, '_blank');
    },
		async changeStatus(i)
		{
			this.loading = true;
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/order/"+i.id+"/edit",
					params:{
						order_status_id: i.order_status_id
					},

				});
				if (data.status) {
					this.snacks("Successfully Changed", "green");
					this.close();
				} else {
					this.snacks("Failed", "red");
					this.loading = false;
				}
			} catch (e) {
				this.snacks("Error, Server issue", "red");
				this.loading = false;
			}


		},

		async initialize() {
			this.loading=true;
			this.setting=this.$store.state.setting
			this.filters.category_id=''
			this.filters.page=1
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/branch"
				});
				this.dataBranch = data;
			} catch (e) {
                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/orderstatus"
				});
				this.dataStatus = data;
			} catch (e) {
				this.loading=false;
                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/user",
					params:
					{
						type:3
					}
				});
				this.dataDeliveryAgent = data;
			} catch (e) {
				this.loading=false;

			}
			
			this.getOrder();

        },
        async getOrder()
        {
            this.loading=true;
            try {
				let { data } = await axios({
					method: "get",
                    url: "/app/order",
                    params: this.filters
				});
                this.dataList = data.data;
                this.itemsPerPage=data.per_page;
                this.pageCount=data.last_page;
				this.filters.page=data.current_page
			this.loading=false;

			} catch (e) {
				this.loading=false;                
            }
		},
		async assignAgent()
		{
			if(!this.editedItem.delivery_agent)
			{
				this.snacks('Please add delivery agent','red')
				return
			}
			this.loading=true;
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/delivery",
					data:this.editedItem
				});
				if (data.status) {
					this.snacks('Successfully Done','green')
					this.dataList[this.dataIndex].delivery_agent=this.editedItem.delivery_agent
					this.close();				
				}
				else
				{
					this.snacks(data.data,'red')
					this.loading = false;
				}

			} catch (e) {
				this.snacks('Operation Failed','red')
				this.loading = false;
			}

		},
		editItem(item) {
			this.$router.push('/dashboard/order/edit/'+item.id);
		},
		save(item) {
			this.$router.push('/dashboard/order/add');
		},
		deleteItem(item) {
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
		},
		viewItem(item) {
			this.editedItem = Object.assign({}, item);
			this.isView=!this.isView;

		},
		viewMap(item) {
			this.editedItem = Object.assign({}, item);
			this.isMap=!this.isMap;

		},
	viewRiderPath(item) {
			this.editedItem = Object.assign({}, item);
			this.path =[]
			for(let d of this.editedItem.path)
			{
				this.path.push(
					{
						lat:d.lat,
						lng:d.lon,
					}
				)
			}
			this.isRiderPath=!this.isRiderPath;

		},
		
		assignItem(item) {
			this.dataIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);		
			this.isAssign=!this.isAssign;

		},
		close() {
			this.dialog = false;
			this.isAssign = false;
			this.loading = false;
		},
		async remove() {
			this.loading=true;
			try {
				let { data } = await axios({
					method: "delete",
					url: "/app/order/" + this.dataList[this.dataIndex].id
				});
				if (data.status) {
					this.snacks('Successfully Done','green')
					this.dataList.splice(this.dataIndex, 1);
					this.close();				
				}
				else
				{
					this.snacks(data.data,'red')
					this.loading = false;
				}

			} catch (e) {
				this.snacks('Operation Failed','red')
				this.loading = false;
			}
		}
	}
};
</script>