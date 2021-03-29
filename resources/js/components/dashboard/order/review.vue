<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>{{$t('message.order.review')}}</v-toolbar-title>
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
													v-model="editedItem.id"
													label="Order ID"
													filled
													required
                                                    disabled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md12>
												<v-text-field
													v-model="editedItem.name"
													label="Name"
													filled
													required
                                                    disabled
												></v-text-field>
											</v-flex>
                                            <v-flex xs12 sm12 md12>
												<v-textarea
													v-model="editedItem.text"
													label="Feed Back"
													filled
													required
												></v-textarea>
											</v-flex>
                                            <v-flex xs12 sm12 md12>
												<v-select
													v-model="editedItem.status"
													:items="dataStatus"
													item-text="name"
													item-value="value"
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
					<v-data-table  :headers="headers" :items="dataList" :search="search" class="elevation-1">
                        <template v-slot:item.text="{ item }">
                            {{item.text.length>70?item.text.slice(0,68)+'...':item.text}}
                        </template>
                        <template v-slot:item.rating="{ item }">
                            <v-rating
                                v-model="item.rating"
                                color="yellow darken-3"
                                background-color="grey darken-1"
                                readonly
                            ></v-rating>
						</template>
                        <template v-slot:item.status="{ item }">
							<v-chip :color="item.status?'green':'red'" text-color="white" >{{item.status?'Active':'Disable'}}</v-chip>
						</template>
						<template v-slot:item.action="{ item }">
							<v-icon small @click="editItem(item)">edit</v-icon>
						</template>
						<template v-slot:no-data>
							<NoDataList :loading="loading" @initialize="initialize"></NoDataList>
						</template>
					</v-data-table>
				</v-col>
			</v-row>
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
import NoDataList from "./../common/NoDataList"
export default {
	components: {
		NoDataList
	},
	data: () => ({
		search: "",
		absolute: true,
		loading: false,
		edit: true,
		dialog: false,
		dataList: [],
		headers: [
			{ text: "ID",  value: "id" },
			{ text: "Customer", value: "name" },
			{ text: "Feedabck", value: "text" },
			{ text: "Rating", align:'center', value: "rating" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		emailRules: [
			v => !!v || "E-mail is required",
			v => /.+@.+/.test(v) || "E-mail must be valid"
		],

		editedIndex: -1,
		editedItem: {
			description:"",
			title:"",
			status:1,
			
		},
		defaultItem: {
			name:"",
			
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
		async initialize() {
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/review"
				});
				this.dataList = data;
			} catch (e) {}
		},
		editItem(item) {
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.dialog = true;
		},
		close() {
			this.dialog = false;
			this.loading = false;
		},
		async save() {
			this.loading = true;
				try {
					let { data } = await axios({
						method: "put",
						url: "/app/review/" + this.editedItem.id,
						data: this.editedItem
					});
					if (data.status) {
						this.snacks("Successfully Edited", "green");
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
		}
	}
};
</script>