<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.category.titlelist')}}</v-toolbar-title>
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
												<v-select
													v-model="editedItem.parent_id"
													:items="dataParent"
													item-text="name"
													item-value="id"
													label="Parent"
													required
													filled
												></v-select>
											</v-col>
											<v-col cols="12">
												<v-text-field
													:rules="[v => !!v || 'Name is required']"
													v-model="editedItem.name"
													label="Name*"
													filled
												></v-text-field>
											</v-col>
											<v-col cols="12">
												<v-textarea 
                                                    v-model="editedItem.description" 
                                                    label="Description"
                                                    filled
                                                ></v-textarea>
											</v-col>
											<v-col cols="12">
												<v-select
													v-model="branch"
													:items="dataBranch"
													item-text="name"
													return-object
													:rules="[v => !!v || 'Branch is required']"
													label="Branch(es)*"
													required
													multiple
													filled
													chips
												>
													<!-- <template v-slot:selection="{ item, index }">
														<v-chip v-if="index === 0" color="blue" dark>
														<span>{{ item.address }}</span>
														</v-chip>
														<v-chip v-if="index === 1" color="blue" dark>
														<span>{{ item.address }}</span>
														</v-chip>
														<v-chip v-if="index === 2" color="blue" dark>
														<span>{{ item.address }}</span>
														</v-chip>
														<span
														v-if="index === 3"
														class="grey--text caption"
														>(+{{ value.length - 1 }} others)</span>
													</template> -->
	  											</v-select>
											</v-col>
											<v-col cols="12">
												<v-card
													class="mx-auto"
													width="180"
													outlined
													align="center"
													justify="center"
												>
												<v-img
												:src="editedItem.image?editedItem.image:'/images/plus.png'"
												aspect-ratio="1"
												@click="isImage=!isImage"
												>
												</v-img>
												<v-card-subtitle v-if="!editedItem.image">Add image</v-card-subtitle>
												<v-card-text v-else class="my-2">
													<v-btn x-small color="primary" @click="isImage=!isImage">
														Change
													</v-btn>
													<v-btn x-small color="primary" @click="editedItem.image=''">
														Remove
													</v-btn>
												</v-card-text>
												
												</v-card>
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
						<template v-slot:item.description="{ item }">
							{{item.description && item.description.length>70?item.description.slice(0,68)+'...':item.description}}
						</template>
						<template v-slot:item.parent_id="{ item }">
							<p v-if="item.parent_id>0">{{item.parent.name}}</p>
							<p v-else>No Parent</p>
							
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
        dataList: [],
        dataParent:[],
		dataBranch:[],
		branch:[],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Description", value: "description" },
			{ text: "Parent", value: "parent_id" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {
			name: "",
			description: "",
			image:"",
			parent_id: 0,
			status: 1,
			branch:[],
		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		defaultItem: {
			name: "",
			description: "",
			image:"",
			parent_id: 0,
			status: 1,
			branch:[],
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
		async changeStatus(i)
		{
			this.loading = true;
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category/"+i.id+"/edit",
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
			this.loading=true
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataList = data;
			} catch (e) {
			this.loading=false                
            }
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category/0"
				});
				this.dataParent = data;
			} catch (e) {
			this.loading=false                
                
            }
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/branch"
				});
				this.dataBranch = data;
			} catch (e) {
			this.loading=false                
                
            }
			this.loading=false                
		},
		editItem(item) {
			this.branch = []
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
			for(let d of this.editedItem.branch)
			{
				this.branch.push(d.branch)

			}
			this.dialog = true;
		},
		deleteItem(item) {
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
		},
		close() {
			this.branch = [];
			this.dialog = false;
			this.loading = false;
			setTimeout(() => {
				this.editedItem = Object.assign({}, this.defaultItem);
				this.editedIndex = -1;
			}, 300);
		},
		async save() {
			this.loading = true;
			this.editedItem.branch=[...this.branch]
			if (this.editedIndex > -1) {
				try {
					let { data } = await axios({
						method: "put",
						url: "/app/category/" + this.editedItem.id,
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
						url: "/app/category",
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
					url: "/app/category/" + this.dataList[this.dataIndex].id
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