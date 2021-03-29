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
						<v-dialog v-model="dialog" max-width="500px" persistent>
							<v-card>
								<v-card-title>
									<span class="headline">{{ formTitle }}</span>
								</v-card-title>

								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>
                                            <v-flex>
											<v-select
													v-model="editedItem.id"
													:items="dataDay"
													item-text="day"  
                                                    item-value="id"
													:rules="[v => !!v || 'Branch is required']"
													label="Days"
													required
													filled
													chips
												>
	  										</v-select>
                                            </v-flex>
                                            <v-flex>
											<v-combobox
													v-model="editedItem.breakfast"
													:items="dataProduct"
													item-text="meta_title"  
                                                    item-value="id"
													:rules="[v => !!v || 'Branch is required']"
													label="BreakFast*"
													return-object
                                                    multiple
													filled
													chips
												>
											</v-combobox>
                                            </v-flex>
                                             <v-flex>
											<v-combobox
													v-model="editedItem.lunch"
													:items="dataProduct"
													item-text="meta_title"  
                                                    item-value="id"
													:rules="[v => !!v || 'Branch is required']"
													label="Lunch*"
													return-object
                                                    multiple
													filled
													chips
												>
	  											</v-combobox>
                                            </v-flex>
                                             <v-flex>
											<v-combobox
													v-model="editedItem.dinner"
													:items="dataProduct"
													item-text="meta_title"  
                                                    item-value="id"
													:rules="[v => !!v || 'Branch is required']"
													label="Dinner*"
													return-object
                                                    multiple
													filled
													chips
												>
	  											</v-combobox>
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
					<v-data-table  :headers="headers" :items="dataList" class="elevation-1">
                        <template v-slot:item.day="{ item }">
							{{item.day}}
						</template>
                         <template v-slot:item.breakfast="{ item }">
                            <v-chip-group
                                multiple
                                column
                                active-class="primary--text"
                            >
                                <v-chip v-for="tag in item.breakfast" :key="tag.id">
                                {{ tag.product.info[0].name }}
                                </v-chip>
                            </v-chip-group>
						</template>
                        <template v-slot:item.lunch="{ item }">
                            <v-chip-group
                                multiple
                                column
                                active-class="primary--text"
                            >
                                <v-chip v-for="tag in item.lunch" :key="tag.id">
                                {{ tag.product.info[0].name }}
                                </v-chip>
                            </v-chip-group>
						</template>
                        <template v-slot:item.dinner="{ item }">
                            <v-chip-group
                                multiple
                                column
                                active-class="primary--text"
                            >
                                <v-chip v-for="tag in item.dinner" :key="tag.id">
                                {{ tag.product.info[0].name }}
                                </v-chip>
                            </v-chip-group>
						</template>
						<template v-slot:item.action="{ item }">
							<v-icon color="blue" small @click="editItem(item)">edit</v-icon>
							<v-icon color="red" small @click="deleteItem(item)">delete</v-icon>
						</template>
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
                     
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
import NoDataList from "./../common/NoDataList"
export default {
	components: {
		DeleteModal,
		NoDataList
	},
	data: () => ({
        absolute: true,
        loading: false,
		edit: true,
        dialog: false,
        dataDay:[],
        dataList: [],
        dataProduct:[],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Day", value: "day" },
            { text: "BreakFast", value: "breakfast" },
            { text: "Lunch", value: "lunch" },
            { text: "Dinner", value: "dinner" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {
            product_id:"",
            breakfast:[],
            lunch:[],
            dinner:[],
            id:"",
        },
     
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
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
		async initialize() {
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/getproduct"
				});
				this.dataProduct = data;
				} catch (e) {  
            	}
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/getday"
				});
				this.dataDay = data;
				} catch (e) { 
           		}
            this.getMessBooking();
        	},
        async getMessBooking()
        {
            try {
				let { data } = await axios({
					method: "get",
                    url: "/app/messbooking",
				});
				this.dataList = data;          
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
						url: "/app/messbooking/" + this.editedItem.id,
						data: this.editedItem
					});
						this.snacks("Successfully Added", "green");
						Object.assign(this.dataList[this.editedIndex], data.data);
						this.close();
					
					} catch (e) {
					this.snacks("Failed", "red");
					this.loading = false;
					}
			} else {
				try {
					let { data } = await axios({
						method: "post",
						url: "/app/messbooking",
						data: this.editedItem
                    });
						this.dataList.unshift(data.data);
						this.snacks("Successfully Added", "green");
						this.close();
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
					url: "/app/messbooking/" + this.dataList[this.dataIndex].id
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