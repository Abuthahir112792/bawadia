<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.conatctus.list')}}</v-toolbar-title>
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
					</v-toolbar>
					<v-data-table  :headers="headers" :items="dataList" :search="search" class="elevation-1">
						<template v-slot:item.status="{ item }">
									<v-select
										v-model="item.status"
										:items="dataStatus"
										item-text="name"
										item-value="value"
										solo
										dense
										class="mt-3"
										style="max-width: 150px"
										@change="changeStatus(item)"
									></v-select>   
						</template>
                        <template v-slot:item.created_at="{ item }">
                                <span>{{ item.created_at | moment("DD MMM YYYY") }}</span>
                        </template>
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
					 <div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getContact"
                                ></v-pagination>
                            </div>
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
import NoDataList from "./../common/NoDataList"
export default {
	components: {
		NoDataList,
	},
	data: () => ({
		isImage:false,
		search: "",
		absolute: true,
		loading: false,
		edit: true,
        dialog: false,
       
        dataList: [],
		headers: [
			{ text: "name", value: "name" },
			{ text: "Email", value: "email" },
            { text: "body", value: "body" },
            { text: "Status", value: "status" },
            { text: "Date", value: "created_at" },
		],
		editedIndex: -1,
		
		dataIndex: null,
		deleteTitle: "",
		deleteBody: "",
		isDelete:false,
		 itemsPerPage:1,
        pageCount:2,
		dataStatus: [
			{ name: "Seen", value: 1 },
			{ name: "Unseen", value: 2 }
		],
		filters:
        {
			page: 1,
        },
	}),

	props: {
		source: String
	},
	computed: {
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
					url: "/app/contactus/"+i.id+"/edit",
					params:{
						status: i.status
					},

				});
				if (data.status) {
					this.snacks("Successfully Changed", "green");
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
			
				this.filters.page=1
			this.getContact();
		},
		 async getContact()
        {
            this.loading=true;
            try {
				let { data } = await axios({
					method: "get",
                    url: "/app/contactus",
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
	}
};
</script>