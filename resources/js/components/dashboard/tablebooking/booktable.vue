<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.tablebooking.titlelist')}}</v-toolbar-title>
						<v-divider class="mx-2" inset vertical></v-divider>
						<v-spacer></v-spacer>
						<v-text-field
                            dense
							v-model="search"
							append-icon="search"
							label="Search"
							hide-details
							outlined
						></v-text-field>
						<v-dialog v-model="dialog" max-width="500px" persistent>
							<v-card>
								<v-card-title>
									<span class="headline">{{ formTitle }}</span>
								</v-card-title>

								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>
											<v-flex xs12 sm12 md12>
												<v-text-field
													:rules="[v => !!v || 'Name is required']"
													v-model="editedItem.name"
													label="Name*"
													filled
												></v-text-field>
											</v-flex>
                                            <v-flex xs12 sm12 md12>
												<v-text-field
													:rules="[v => !!v || 'phone is required']"
													v-model="editedItem.phone_no"
													label="Phone No*"
													filled
												></v-text-field>
											</v-flex>
                                            <v-flex xs12 sm12 md12>
												<v-text-field
													:rules="[v => !!v || 'Person is required']"
													v-model="editedItem.no_of_person"
													label="No Of Persons*"
													filled
												></v-text-field>
											</v-flex>
                                            <v-flex xs12 sm12 md12>
                                                <v-menu
                                                    ref="menu"
                                                    v-model="menu2"
                                                    :close-on-content-click="false"
                                                    :nudge-right="40"
                                                    :return-value.sync="editedItem.time"
                                                    transition="scale-transition"
                                                    offset-y
                                                    max-width="290px"
                                                    min-width="290px"
                                                >
                                                    <template v-slot:activator="{ on }">
                                                    <v-text-field
                                                        v-model="editedItem.time"
                                                        :rules="[v => !!v || 'time is required']"
                                                        label="Select Time"
                                                        prepend-icon="access_time"
                                                        readonly
                                                        v-on="on"
                                                    ></v-text-field>
                                                    </template>
                                                    <v-time-picker
                                                    v-if="menu2"
                                                    v-model="time"
                                                    full-width
                                                    @click:minute="$refs.menu.save(time)"
                                                    ></v-time-picker>
                                                </v-menu>
											</v-flex>
											<v-flex xs12 sm12 md12>
												
                                                  <v-menu
                                                v-model="menu3"
                                                :close-on-content-click="false"
                                                :nudge-right="40"
                                                transition="scale-transition"
                                                offset-y
                                                min-width="290px"
                                            >
                                                <template v-slot:activator="{ on }">
                                                <v-text-field
                                                    v-model="editedItem.date"
                                                    :rules="[v => !!v || 'date is required']"
                                                    label="Select Date"
                                                    prepend-icon="event"
                                                    readonly
                                                    v-on="on"
                                                ></v-text-field>
                                                </template>
                                                <v-date-picker v-model="editedItem.date" @input="menu3 = false"></v-date-picker>
                                            </v-menu>
											</v-flex>
                                            <v-flex>
											<v-select
													v-model="editedItem.branch_id"
													:items="dataBranch"
													item-text="name"  
                                                    item-value="id"
													:rules="[v => !!v || 'Branch is required']"
													label="Branch(es)*"
													required
													filled
													chips
												>
	  											</v-select>
                                            </v-flex>
											<v-flex xs12 sm12 md12>
												<v-select
													v-model="editedItem.status"
													:items="dataStatus"
													item-text="name"
													item-value="value"
													:rules="[v => !!v || 'Status is required']"
													label="Status"
													required
													filled
												></v-select>
											</v-flex>
										</v-layout>
									</v-container>
								</v-card-text>

								<v-card-actions>
									<v-spacer></v-spacer>
									<v-btn color="red darken-1" text @click="close">Cancel</v-btn>
									<v-btn
										color="primary"
										:loading="loading"
										:disabled="loading"
										text
										@click="save"
									>Save</v-btn>
								</v-card-actions>
							</v-card>
						</v-dialog>
					</v-toolbar>
                    <v-row>
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
                                <v-date-picker @change="getTableBooking" v-model="filters.start" @input="date1 = false"></v-date-picker>
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
									clearable
                                ></v-text-field>
                                </template>
                                <v-date-picker @change="getTableBooking" v-model="filters.end" @input="date2 = false"></v-date-picker>
                            </v-menu>
                        </v-col>
                         <v-col cols="3">
                         <v-select
                            v-model="filters.branch_id"
                            :items="dataBranch"
                            item-text="name"
                            item-value="id"
                            label="Branch"
                            required
                            clearable
                            filled
                            @change="getTableBooking"
					></v-select>
                    </v-col>
                    </v-row>
					<v-data-table  :headers="headers" :items="dataList" :search="search" class="elevation-1">
                         <template v-slot:item.branch="{ item }">
                                    {{item.branch.name}}
                                </template>
						<template v-slot:item.status="{ item }">
							<v-chip :color="item.status?'green':'red'" text-color="white" >{{item.status?'Active':'Disable'}}</v-chip>
						</template>
						<template v-slot:item.action="{ item }">
							<v-icon color="blue" small @click="editItem(item)">edit</v-icon>
							<v-icon color="red" small @click="deleteItem(item)">delete</v-icon>
						</template>
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
                     <div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getTableBooking"
                                ></v-pagination>
                            </div>
				</v-col>
			</v-row>
			<DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
			<v-btn bottom color="primary" dark fab fixed right @click="dialog = !dialog">
				<v-icon>add</v-icon>
			</v-btn>
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
import DeleteModal from "./../common/DeleteModal";
import NoDataList from "./../common/NoDataList";
export default {
	components: {
		DeleteModal,
		NoDataList
	},
	data: () => ({
		search: "",
        absolute: true,
        date1:false,
        date2:false,
        time:null,
        menu2: false,
        menu3: false,
        loading: false,
         itemsPerPage:1,
        pageCount:2,
		edit: true,
		dialog: false,
        dataList: [],
        dataBranch:[],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
            { text: "Phone No", value: "phone_no" },
            { text: "Branch" , value: "branch" },
            { text: "No,s persons" , value: "no_of_person" },
            { text: "Time", value: "time" },
            { text: "Date", value: "date" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {
			name: "",
			phone_no: "",
            no_of_person: "",
            time:"",
            date:"",
            branch_id:"",
			status: 1,
        },
         filters:
        {
            branch_id:null,
            start:new Date().toISOString().substr(0, 10),
			end:"",
			page: 1,
			show: 20,

        },
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
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
		}
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {
				async changeStatus(i)
		{
			this.loading = true
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/tablebooking/"+i.id+"/edit",
					params:{
						status: i.status
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
                this.filters.branch_id=""
                this.filters.page=1
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/branch"
				});
				this.dataBranch = data;
			} catch (e) {
                
            }
            this.getTableBooking();
        },
        async getTableBooking()
        {
            try {
				let { data } = await axios({
					method: "get",
                    url: "/app/gettablebooking",
                     params: this.filters
				});
				this.dataList = data.data.data;
                this.itemsPerPage=data.data.per_page;
                this.pageCount=data.data.last_page;
                this.filters.page=data.data.current_page
				this.loading=false;                
			} catch (e) {
                
            }
        },
		editItem(item) {
		
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
            this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},
		deleteItem(item) {
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
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
						url: "/app/tablebooking/" + this.editedItem.id,
						data: this.editedItem
					});
					if (data.status) {
						this.snacks("Successfully Added", "green");
						Object.assign(this.dataList[this.editedIndex], data.data);
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
						url: "/app/tablebooking",
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
		},
		async remove() {
			this.loading=true;
			try {
				let { data } = await axios({
					method: "delete",
					url: "/app/tablebooking/" + this.dataList[this.dataIndex].id
				});
					this.snacks('Successfully Done','green')
					this.dataList.splice(this.dataIndex, 1);
					this.close();	
			} catch (e) {
				this.snacks('Operation Failed','red')
				this.loading = false;
			}
		}
	}
};
</script>