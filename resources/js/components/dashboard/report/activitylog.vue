<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
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
                                <v-date-picker @change="getactivityLog" v-model="filters.start" @input="date1 = false"></v-date-picker>
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
                                <v-date-picker @change="getactivityLog" v-model="filters.end" @input="date2 = false"></v-date-picker>
                            </v-menu>
                        </v-col>
                  <v-col cols="3">
                         <v-select
                            v-model="filters.admin_id"
                            :items="userData"
                            item-text="name"
                            item-value="id"
                            label="Admin"
                            required
                            clearable
                            filled
                            @change="getactivityLog"
					></v-select>
                    </v-col>
                        <v-col cols="3">
                        <v-select
                            v-model="filters.user_id"
                            :items="userData"
                            item-text="name"
                            item-value="id"
                            label="User"
                            required
                            clearable
                            filled
                            @change="getactivityLog"
					></v-select>
                    </v-col>
            </v-row>
            <v-row>
                <v-col>
                     <v-card flat>
                        <v-card-text>
                            <v-data-table  :headers="headers" :items="dataList" 
                                hide-default-footer
                            > 
                                <template v-slot:item.admin="{ item }">
                                    {{item.admin.name}}
                                </template>
                                 <template v-slot:item.user="{ item }">
                                    {{item.user.name}}
                                </template>
                                 <template v-slot:item.created_at="{ item }">
                                    {{item.created_at}}
                                </template>
                                <template v-slot:no-data>
                                    <v-skeleton-loader v-show="loading" type="table-tbody"></v-skeleton-loader>
                                    <v-btn color="primary" @click="initialize" class="ma-3">Reset</v-btn>
                                </template>
                            </v-data-table>
                            <div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getactivityLog"
                                ></v-pagination>
                            </div>
                        </v-card-text>
                    </v-card>
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
			
		</v-snackbar>
	</v-content>
</template>

<script>

export default {
	data: () => ({
        setting:{},
      date1:false,
		date2:false,
        itemsPerPage:1,
        pageCount:2,
		absolute: true,
		loading: false,
	
        dataList: [],
		userData:[],
        filters:
        {
            admin_id:null,
            user_id:null,
            start:new Date().toISOString().substr(0, 10),
			end:new Date().toISOString().substr(0, 10),
			page: 1,
			show: 20,

        },
         fields : ['id','admin_id', 'user_id','flag','ip','created_at'],
		headers: [
			{ text: "ID", align: "left", value: "id" },
			{ text: "Admin", value: "admin" },
			{ text: "User", value: "user" },
			{ text: "Flag", value: "flag" },
            { text: "Ip", value: "ip" },
            { text: "Activity Time", value: "created_at" },
		],
	}),
    computed: {},
	watch: {},
	created() {
        this.initialize();
        this.setting=this.$store.state.setting;
        	},
    methods: {
            async initialize() {
                this.filters.admin_id=""
                this.filters.user_id=""
                this.filters.page=1
                try {
                    let { data } = await axios({
                        method: "get",
                        url: "/app/userlog",
                    });
                    this.userData = data;
                } catch (e) {
                        this.loading=false;                
                }
                this.getactivityLog();
                },
        async getactivityLog()
        {
            this.loading=true;
            try {
				let { data } = await axios({
					method: "get",
                    url: "/app/report/activitylog",
                     params: this.filters
				});
                this.dataList = data.data.data;
                this.itemsPerPage=data.data.per_page;
                this.pageCount=data.data.last_page;
                this.filters.page=data.data.current_page
				this.loading=false;                
			} catch (e) {
				this.loading=false;    
            }
		},
		
	}
};
</script>