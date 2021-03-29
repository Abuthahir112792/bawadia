<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="12">
                    <v-row >
                        <v-col cols="3">
                            <v-select
                                v-model="filters.category_id"
                                :items="dataCategory"
                                item-text="name"
                                item-value="id"
                                label="Category"
                                required
                                filled
								@change="getProduct"
								clearable
                            ></v-select>                            
                        </v-col>
						<v-col cols="3">
                            <v-select
                                v-model="filters.subcategory_id"
                                :items="dataSubcategory"
                                item-text="sub_category_name"
                                item-value="id"
                                label="Subcategory"
                                required
                                filled
								@change="getProduct"
								clearable
                            ></v-select>                            
                        </v-col>
                        <v-col cols="3">
                            <v-select
                                v-model="filters.branch_id"
                                :items="dataBranch"
                                item-text="name"
                                item-value="id"
                                label="Branch"
                                required
                                filled
								@change="getProduct"
								clearable
                            ></v-select>                            
                        </v-col>
                        <v-col cols="6">
                        <v-text-field
							v-model="filters.search"
							append-icon="search"
							label="Search"
							hide-details
							outlined
							@change="getProduct"

						></v-text-field>
                        </v-col>
                    </v-row>
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.product.list')}}</v-toolbar-title>
						<v-divider class="mx-2" inset vertical></v-divider>
						<v-spacer></v-spacer>

					</v-toolbar>
                    <v-card flat>
                        <v-card-text>
                            <v-data-table  :headers="headers" :items="dataList" :search="search"
                                hide-default-footer :items-per-page="15"
                            >
                                <template v-slot:item.image="{ item }">
									<v-img
										:src="item.image.length>0?item.image[0].src:'/no_image.png'"
										lazy-src="no_image.png"
										aspect-ratio="1"
										class="grey lighten-2"
										width="80"
										height="80"
									></v-img>
                                </template>
								<template v-slot:item.name="{ item }">
                                    {{item.info[0].name && item.info[0].name.length>70?item.info[0].name.slice(0,68)+'...':item.info[0].name}}
                                </template>
                                <template v-slot:item.category="{ item }">
                                   <v-chip-group
										multiple
										column
										active-class="primary--text"
									>
										<v-chip v-for="(category,i) in item.category" :key="i">
										{{ category.category.name }}
										</v-chip>
									</v-chip-group>
                                </template>
								<template v-slot:item.subcategory="{ item }">
                                   <v-chip-group
										multiple
										column
										active-class="primary--text"
									>
										<v-chip v-for="(subcategory,i) in item.subcategory" :key="i">
										{{ subcategory.subcategory.sub_category_name }}
										</v-chip>
									</v-chip-group>
                                </template>
                                <template v-slot:item.description="{ item }">
                                    {{item.info[0].description && item.info[0].description.length>70?item.info[0].description.slice(0,68)+'...':item.info[0].description}}
                                </template>
                                <template v-slot:item.price="{ item }">
									<span v-if="item.size_type=='single'">
										<v-chip  v-for="(branch,i) in item.branches" :key="i" :color="branch.status?'':'red'" @click="statusUpdate(item,branch,i)">{{branch.branch.name}}-{{branch.price[0].price}}</v-chip>
									</span>
									<span v-else-if="item.size_type=='many'">								
										<v-chip-group>
											<v-chip @click="statusUpdate(item,branch,i)" v-for="(branch,i) in item.branches" :key="i"  :color="branch.status?'':'red'">{{branch.branch.name}}-<a v-for="(price,j) in branch.price" :key="j">{{price.price}}/</a></v-chip>
										</v-chip-group>
									</span>
                                </template>
                                <template v-slot:item.status="{ item }">
                                    <v-switch v-model="item.status" @change="changeStatus(item)" color="primary" inset></v-switch>
                                </template>
                                <template v-slot:item.action="{ item }">
                                    <v-icon color="blue" v-show="$store.state.authUser.type==1"  @click="editItem(item)">edit</v-icon>
                                    <v-icon color="red"  v-show="$store.state.authUser.type==1" @click="deleteItem(item)">delete</v-icon>
                                </template>
								<template v-slot:no-data>
									<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
                                </template>
                            </v-data-table>
                            <div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getProduct"
                                ></v-pagination>
                            </div>
                        </v-card-text>
                    </v-card>
				</v-col>
			</v-row>
			<DeleteModal :trigger="isDelete" :title="deleteTitle" :body="deleteBody" @request="remove"></DeleteModal>
			<StatusUpdate :trigger="isStatusUpdate" :branchItem="branchItem" @request="status"></StatusUpdate>
			<v-btn bottom color="primary" dark fab fixed right @click="save">
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
import StatusUpdate from "./StatusUpdate";
import NoDataList from "./../common/NoDataList"
export default {
	components: {
		DeleteModal,
		NoDataList,
		StatusUpdate
	},
	data: () => ({
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
		dataSubcategory:[],
		dataBranch:[],
        branch:[],
        filters:
        {
            category_id:null,
			subcategory_id:null,
            branch_id:null,
			page:1,
			search : ''

        },
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Image", value: "image" },
			{ text: "Name", value: "name" },
			{ text: "Category", value: "category" },
			{ text: "Subcategory", value: "subcategory" },
			{ text: "Description", value: "description" },
			{ text: "Price", value: "price" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		editedIndex: -1,
		editedItem: {
			name: "",
			description: "",
			parent_id: 0,
			status: 1,
			branch:[],
		},
		branchIndex: -1,
		branchItem: {
			branch:{
				name:''
			}
		},
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		isStatusUpdate:false,
		defaultItem: {
			name: "",
			description: "",
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
		async changeStatus(i)
		{
			this.loading = true;
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/product/"+i.id+"/edit",
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
			this.loading=true;
			this.setting=this.$store.state.setting
			this.filters.category_id=''
			this.filters.subcategory_id=''
            this.filters.branch_id=""
			this.filters.page=1
			
			
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataCategory = data;
			} catch (e) {
                
            }
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/subcategory"
				});
				this.dataSubcategory = data;
			} catch (e) {
                
            }
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/branch"
				});
				this.dataBranch = data;
			} catch (e) {
				this.loading=false;
                
			}
			this.getProduct();

        },
        async getProduct()
        {
            this.loading=true;
            try {
				let { data } = await axios({
					method: "get",
                    url: "/app/product",
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
		editItem(item) {
			this.$router.push('/dashboard/product/edit/'+item.id);
		},
		save(item) {
			this.$router.push('/dashboard/product/add');
		},
		deleteItem(item) {
			this.dataIndex = this.dataList.indexOf(item);
			this.deleteTitle = "Are you sure you want to delete this item?";
			this.isDelete = !this.isDelete;
		},
		statusUpdate(item, branch, index) {
			this.editedIndex = this.dataList.indexOf(item);
			this.branchItem = Object.assign({}, branch);
			this.branchIndex = index
			this.isStatusUpdate = !this.isStatusUpdate;
		},
		async status(statusData) {
			this.loading=true;
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/branch_update",
					data: statusData
				});
				if (data.status) {
					this.snacks('Successfully Done','green')
					Object.assign(this.dataList[this.editedIndex].branches[this.branchIndex], this.branchItem);
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
		close() {
			this.dialog = false;
			this.loading = false;
			this.isStatusUpdate = false;
		},
		async remove() {
			this.loading=true;
			try {
				let { data } = await axios({
					method: "delete",
					url: "/app/product/" + this.dataList[this.dataIndex].id
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