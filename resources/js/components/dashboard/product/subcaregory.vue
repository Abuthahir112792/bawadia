<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.subcategory.titlelist')}}</v-toolbar-title>
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
													:rules="[v => !!v || 'Sub Category is required']"
													v-model="editedItem.sub_category_name"
													label="Sub Category*"
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
												v-model="category"
												:items="dataCategory"
												item-text="name"
												return-object
												:rules="[v => !!v.length || 'Category is required']"
												required
												label="Categories*"
												multiple
												filled
												chips
												@change="getBranch"
											>
											</v-select>
										</v-col>
										<v-col cols="12">
											<v-select
												v-model="branch"
												:items="dataBranch"
												item-text="name"
												return-object
												:rules="[v => !!v.length || 'Branch is required']"
												required
												label="Branches*"										
												multiple
												filled
												chips
												:loading="loading"
												:disabled="loading"
											>
												<template v-slot:prepend-item>
													<v-list-item
													ripple
													@click="toggle"
													>
													<v-list-item-action>
														<v-icon :color="branch.length > 0 ? 'indigo darken-4' : ''">{{ icon }}</v-icon>
													</v-list-item-action>
													<v-list-item-content>
														<v-list-item-title>Select All</v-list-item-title>
													</v-list-item-content>
													</v-list-item>
													<v-divider class="mt-2"></v-divider>
												</template>
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
		category:[],
        dataCategory:[],
		dataBranch:[],
		branch:[],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "sub_category_name" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {
			sub_category_name: "",
			description: "",
			image:"",
			status: 1,
			category:[],
			branch:[],
		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		defaultItem: {
			sub_category_name: "",
			description: "",
			image:"",
			status: 1,
			category:[],
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
		likesAllBranch () {
        return this.branch.length === this.dataBranch.length
	  },
		likesSomeBranch () {
        return this.branch.length > 0 && this.dataBranch
      },
	  icon () {
        if (this.likesAllBranch) return 'cancel'
        if (this.likesSomeBranch) return 'indeterminate_check_box'
        return 'check_box_outline_blank'
	  },
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
					url: "/app/subcategory/"+i.id+"/edit",
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
		toggle () {
        this.$nextTick(() => {
          if (this.likesAllBranch) {
            this.branch = []
          } else {
            this.branch = this.dataBranch.slice()
          }
        })
      },
		async initialize() {
			this.loading=true
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/subcategory"
				});
				this.dataList = data;
			} catch (e) {
			this.loading=false                
            }
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataCategory = data;
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

		async getBranch() {
			
			var category =[]
			if(!this.category.length)
			{				
				this.dataBranch=[]
				return 
			}
			this.loading = true;
			
			
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/branch_by_category",
					data: this.category
				});
				var branch=[];

				for(let d of data)
				{
					d.branch.price=[
						{
							tag:'',
							price:'',
							description:''
							
						}
					]
					branch.push(d.branch)

				}
				
				this.dataBranch=branch
				let intersection=this.branch.filter((data)=>{
                    
					for(let d of this.dataBranch)
					{
						if(d.id==data.id)
						return d;
					}
                });
				this.branch=intersection;
				this.loading = false;
			} catch (e) {
				this.snacks("Somthing Wrong", "red");
				this.loading = false;
			}
			
		},
		
		editItem(item) {
			console.log(item)
			this.branch = []
			this.category = []
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
			for(let d of this.editedItem.branch)
			{
				this.branch.push(d.branch)

			}

			for(let d of this.editedItem.category)
			{
				this.category.push(d.category)

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
			this.category = []
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
			this.editedItem.category=[...this.category]
			if (this.editedIndex > -1) {
				try {
					let { data } = await axios({
						method: "put",
						url: "/app/subcategory/" + this.editedItem.id,
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
						url: "/app/subcategory",
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
					url: "/app/subcategory/" + this.dataList[this.dataIndex].id
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