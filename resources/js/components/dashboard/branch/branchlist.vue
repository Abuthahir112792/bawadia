<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-row justify="center">
				<v-col sm="12" md="12" lg="11">
					<v-toolbar flat color="white">
						<v-toolbar-title>Branch List</v-toolbar-title>
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
						<v-dialog v-model="dialog" max-width="700px" persistent>
							<v-card>
								<v-card-title>
									<span class="headline">{{ formTitle }}</span>
								</v-card-title>

								<v-card-text>
									<v-container grid-list-md>
										<v-layout wrap>											
											<v-flex xs12 sm12 md12>
												<v-text-field
													v-model="editedItem.name"
													label="Name"
													filled
													required
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md12>
												<v-textarea 
                                                    v-model="editedItem.address" 
                                                    label="Address"
                                                    filled
                                                ></v-textarea>
											</v-flex>
											<v-flex xs12 sm12 md12>
												<v-text-field
													:rules="emailRules"
													v-model="editedItem.email"
													label="Email"
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.contact_1"
													label="Mobile"
													type="number"
                                                    prefix="974"
                                                    placeholder=" "
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.contact_2"
													label="Landline"
													type="number"
                                                    prefix="974"
                                                    placeholder=" "
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md12>
												<v-card outlined class="px-3"> 
													<span clas="subtitle-2">Saturday</span>
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="sat_start"
																v-model="isSatStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.sat_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.sat_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isSatStart"
																v-model="editedItem.sat_start"
																full-width
																@click:minute="$refs.sat_start.save(editedItem.sat_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="sat_end"
																v-model="isSatEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.sat_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.sat_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isSatEnd"
																v-model="editedItem.sat_end"
																full-width
																@click:minute="$refs.sat_end.save(editedItem.sat_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
														<span clas="subtitle-2">Sunday</span>													
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="sun_start"
																v-model="isSunStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.sun_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.sun_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isSunStart"
																v-model="editedItem.sun_start"
																full-width
																@click:minute="$refs.sun_start.save(editedItem.sun_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="sun_end"
																v-model="isSunEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.sun_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.sun_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isSunEnd"
																v-model="editedItem.sun_end"
																full-width
																@click:minute="$refs.sun_end.save(editedItem.sun_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
														<span clas="subtitle-2">Monday</span>													
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="mon_start"
																v-model="isMonStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.mon_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.mon_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isMonStart"
																v-model="editedItem.mon_start"
																full-width
																@click:minute="$refs.mon_start.save(editedItem.mon_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="mon_end"
																v-model="isMonEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.mon_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.mon_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isMonEnd"
																v-model="editedItem.mon_end"
																full-width
																@click:minute="$refs.mon_end.save(editedItem.mon_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
														<span clas="subtitle-2">Tuesday</span>													
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="tue_start"
																v-model="isTueStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.tue_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.tue_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isTueStart"
																v-model="editedItem.tue_start"
																full-width
																@click:minute="$refs.tue_start.save(editedItem.tue_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="tue_end"
																v-model="isTueEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.tue_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.tue_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isTueEnd"
																v-model="editedItem.tue_end"
																full-width
																@click:minute="$refs.tue_end.save(editedItem.tue_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
														<span clas="subtitle-2">Wednesday</span>													
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="wed_start"
																v-model="isWedStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.wed_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.wed_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isWedStart"
																v-model="editedItem.wed_start"
																full-width
																@click:minute="$refs.wed_start.save(editedItem.wed_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="wed_end"
																v-model="isWedEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.wed_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.wed_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isWedEnd"
																v-model="editedItem.wed_end"
																full-width
																@click:minute="$refs.wed_end.save(editedItem.wed_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
														<span clas="subtitle-2">Thursday</span>													
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="thu_start"
																v-model="isThuStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.thu_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.thu_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isThuStart"
																v-model="editedItem.thu_start"
																full-width
																@click:minute="$refs.thu_start.save(editedItem.thu_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="thu_end"
																v-model="isThuEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.thu_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.thu_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isThuEnd"
																v-model="editedItem.thu_end"
																full-width
																@click:minute="$refs.thu_end.save(editedItem.thu_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
														<span clas="subtitle-2">Friday</span>													
													<v-row>
														<v-col cols="6">
															<v-menu
																ref="fri_start"
																v-model="isFriStart"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.fri_start"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.fri_start"
																	label="Start"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isFriStart"
																v-model="editedItem.fri_start"
																full-width
																@click:minute="$refs.fri_start.save(editedItem.fri_start)"
																></v-time-picker>
															</v-menu>
														</v-col>
														<v-col cols="6">
															<v-menu
																ref="fri_end"
																v-model="isFriEnd"
																:close-on-content-click="false"
																:nudge-right="40"
																:return-value.sync="editedItem.fri_end"
																transition="scale-transition"
																offset-y
																max-width="290px"
																min-width="290px"
															>
																<template v-slot:activator="{ on }">
																<v-text-field
																	v-model="editedItem.fri_end"
																	label="End"
																	prepend-inner-icon="access_time"
																	readonly
																	v-on="on"
																	filled
																></v-text-field>
																</template>
																<v-time-picker
																v-if="isFriEnd"
																v-model="editedItem.fri_end"
																full-width
																@click:minute="$refs.fri_end.save(editedItem.fri_end)"
																></v-time-picker>
															</v-menu>
														</v-col>
													</v-row>
												</v-card>
											</v-flex>
                                            <v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.invoice_prefix"
													label="Invoice Prefix"
                                                    placeholder="2019-"
													type="text"
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.radious"
													label="Delivery Redious range"
													type="number"
                                                    suffix="kilometers"
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.pickup_time"
													label="Pickup Time"
													type="number"
                                                    suffix="minute"
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.preparetion_time"
													label="Preparetion Time"
													type="number"
                                                    suffix="minute"
													filled
												></v-text-field>
											</v-flex>
											<v-flex xs12 sm12 md6>
												<v-text-field
													v-model="editedItem.delivery_time"
													label="Delivery Time"
													type="number"
                                                    suffix="minute"
													filled
												></v-text-field>
											</v-flex>

											<v-flex xs12 sm12 md6>
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
											<v-flex xs12 sm12 md12>
												<gmap-autocomplete
													@place_changed="setPlace"
													:select-first-on-enter="true"
													class="inputSearch"
													placeholder="Search Place for Map"
													>
												</gmap-autocomplete>
											</v-flex>
											<v-flex xs12 sm12 md12>


												<GmapMap
												:center="center"
												:zoom="zoom"
												map-type-id="terrain"
												style="width: auto; height: 300px"
												@click="newmark"
												>
													<GmapMarker
														:position="position"
														:clickable="true"
														:draggable="true"
														@dragend="mapitem"
													/>

												</GmapMap>
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
			<v-btn bottom color="primary" dark fab fixed right @click="addBranch">
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
	components:{
		NoDataList

	},
	
	data: () => ({
		isSatStart:false,
		isSatEnd:false,
		isSunStart:false,
		isSunEnd:false,
		isMonStart:false,
		isMonEnd:false,
		isTueStart:false,
		isTueEnd:false,
		isWedStart:false,
		isWedEnd:false,
		isThuStart:false,
		isThuEnd:false,
		isFriStart:false,
		isFriEnd:false,
		zoom:12,
		 center: {
            lat: 25.2854,
            lng: 51.5310
          },
          markers: [ {
            position: {
              lat: 25.2854,
              lng: 51.5310
            }
          }],
		search: "",
		place: null,
		absolute: true,
		loading: false,
		edit: true,
		dialog: false,
		dataList: [],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Name", value: "name" },
			{ text: "Address", value: "address" },
			{ text: "Email", value: "email" },
			{ text: "Contact", value: "contact_1" },
			{ text: "Status", value: "status" },
			{ text: "Action", value: "action" }
		],
		emailRules: [
			v => !!v || "E-mail is required",
			v => /.+@.+/.test(v) || "E-mail must be valid"
		],
		editedIndex: -1,
		editedItem: {
			name:"",
			email: "",
			address: "",
			contact_1: "",
            contact_2: "",
			pickup_time:"30",
			radious:15,
			preparetion_time: "30",
			delivery_time: "45",
            invoice_prefix:"2019-",
            sat_start: "08:00",
            sat_end:"22:00",
            sun_start: "08:00",
            sun_end:"22:00",
            mon_start: "08:00",
            mon_end:"22:00",
            tue_start: "08:00",
            tue_end:"22:00",
            wed_start: "08:00",
            wed_end:"22:00",
            thu_start: "08:00",
            thu_end:"22:00",
            fri_start: "08:00",
            fri_end:"22:00",
            lat:25.2854,
            lng:51.5310,
			status: 1,
		},
		defaultItem: {
			name:"",
			email: "",
			address: "",
			contact_1: "",
            contact_2: "",
			pickup_time:"30",
			radious:15,
			preparetion_time: "30",
			delivery_time: "45",
            invoice_prefix:"2019-",
            sat_start: "08:00",
            sat_end:"22:00",
            sun_start: "08:00",
            sun_end:"22:00",
            mon_start: "08:00",
            mon_end:"22:00",
            tue_start: "08:00",
            tue_end:"22:00",
            wed_start: "08:00",
            wed_end:"22:00",
            thu_start: "08:00",
            thu_end:"22:00",
            fri_start: "08:00",
            fri_end:"22:00",
            lat:25.2854,
            lng:51.5310,
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
			return this.editedIndex === -1 ? "New Item" : "Edit Item";
		},
		position()
		{
			var position =
			{
				lat: this.editedItem.lat,
				lng: this.editedItem.lng

			}
			return position;

		}
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {
		addBranch()
		{
			this.dialog = !this.dialog;
			this.center.lat=this.defaultItem.lat;
			this.center.lng=this.defaultItem.lng;
			this.zoom=12

		},
		mapitem(i)
		{
			this.center.lat=i.latLng.lat();
			this.center.lng=i.latLng.lng();
			this.editedItem.lat=i.latLng.lat();
			this.editedItem.lng=i.latLng.lng();
		},
		newmark(i)
		{
			this.editedItem.lat=i.latLng.lat();
			this.editedItem.lng=i.latLng.lng();
		},
		setPlace(place) {
			this.center.lat=place.geometry.location.lat();
			this.center.lng=place.geometry.location.lng();
			this.editedItem.lat=place.geometry.location.lat();
			this.editedItem.lng=place.geometry.location.lng();
			this.zoom=16
      },
		async initialize() {
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/branch"
				});
				this.dataList = data;
			} catch (e) {}
		},
		editItem(item) {
			this.edit = false;
			this.editedIndex = this.dataList.indexOf(item);
			this.editedItem = Object.assign({}, item);
			this.center.lat=this.editedItem.lat;
			this.center.lng=this.editedItem.lng;
			this.zoom=16;
			this.dialog = true;
		},
		deleteItem(item) {
			const index = this.dataList.indexOf(item);
			confirm("Are you sure you want to delete this item?") &&
				this.dataList.splice(index, 1);
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
						url: "/app/branch/" + this.editedItem.id,
						data: this.editedItem
					});
					if (data.status) {
						this.snacks("Successfully Added", "green");
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
			} else {
				try { 
					let { data } = await axios({
						method: "post",
						url: "/app/branch",
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
		}
	}
};
</script>
<style >
.inputSearch{
	padding: 16px;
	border-bottom: 1px solid grey;
  float: left;
  width: 100%;
  background: #f1f1f1;
}
</style>