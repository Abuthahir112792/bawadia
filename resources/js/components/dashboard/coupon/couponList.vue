<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.leftbar.coupon')}}</v-toolbar-title>
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
							<ImageModule :toggle="isImage" @send="receiveImage" @cancel="cancel"/>
								<v-card-title>
									<span class="headline">{{ formTitle }}</span>
								</v-card-title>

								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>
											<v-col cols="12">
												<v-text-field
													:rules="[v => !!v || 'Name is required']"
													v-model="editedItem.name"
													label="Name*"
													filled
												></v-text-field>
											</v-col>
                                            <v-col cols="12">
												<v-text-field
													:rules="[v => !!v || 'Amount is required']"
													v-model="editedItem.amount"
													label="Amount*"
													type="number"
													filled
												></v-text-field>
											</v-col>
                                            <v-col cols="12">
												<v-text-field
													:rules="[v => !!v || 'Buying Amount is required']"
													v-model="editedItem.buying_point"
													label="Buying Point*"
                                                    type="number"
													filled
												></v-text-field>
											</v-col>
											
											<v-col cols="12">
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
											</v-col>
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
					<v-data-table  :headers="headers" :items="dataList" :search="search" class="elevation-1">
						<template v-slot:item.image="{ item }">
									<v-img
										:src="item.image?item.image:'/no_image.png'"
										lazy-src="no_image.png"
										aspect-ratio="1"
										class="grey lighten-2"
										width="80"
										height="80"
									></v-img>
                                </template>
								<template v-slot:item.body="{ item }">
									{{item.body && item.body.length>75?item.body.slice(0,70)+'...':item.body}}
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
import ImageModule from "./../common/ImageModule"
export default {
	components: {
		DeleteModal,
		NoDataList,
		ImageModule
	},
	data: () => ({
		isImage:false,
		search: "",
		absolute: true,
		loading: false,
		edit: true,
        dialog: false,
        menu1:false,
        menu2:false,
        dataList: [],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Amount", value: "amount" },
			{ text: "Buying Point", value: "buying_point" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {
			name: "",
			buying_point: "",
			amount:"",
			status: 1,
		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		defaultItem: {
			name: "",
			buying_point: "",
			amount:"",
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
			return this.editedIndex === -1 ? "New Group" : "Edit Group";
		}
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {
		cancel()
		{
			this.isImage=!this.isImage;

		},
		receiveImage(item)
		{
			this.isImage=!this.isImage;
			this.editedItem.image=item.src

		},
		async initialize() {
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/coupon"
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
						url: "/app/coupon/" + this.editedItem.id,
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
						url: "/app/coupon",
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
					url: "/app/coupon/" + this.dataList[this.dataIndex].id
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