<template>
    <v-dialog v-model="dialog" persistent max-width="900">
         <v-card>
             <v-card-text>
            <v-row>
                <v-col cols="6" v-for="(item, index) in dataShipping" :key="index">
                    <v-card>
                        <v-card-title>
                            Address {{index+1}}
                        </v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" class="pt-0 pb-0">
                                    <v-textarea v-model="item.address1" label="Address line 1" filled ></v-textarea>
                                </v-col>
                                <v-col cols="12" class="pt-0 pb-0">
                                    <v-textarea v-model="item.address2" label="Address line 2" filled ></v-textarea>
                                </v-col>
                                <v-col cols="12" class="pt-0 pb-0">
                                    <v-text-field v-model="item.city" label="City"  filled></v-text-field>
                                </v-col>
                                <v-col cols="6" class="pt-0 pb-0">
                                    <v-text-field v-model="item.lat" label="Lat"  type="number"  filled></v-text-field>
                                </v-col>
                                <v-col cols="6" class="pt-0 pb-0">
                                    <v-text-field v-model="item.lon" label="Lon"  type="number"  filled></v-text-field>
                                </v-col>
                                <!-- <v-col cols="6" class="pt-0 pb-0">
                                    <v-btn color="success" @click="save" :loading="loading" :disabled="loading">Add</v-btn>
                                </v-col> -->
                                
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="6">
                    <v-card>
                        <v-card-title>
                            Add Address
                        </v-card-title>
                        <v-card-text>
                            <v-row>
                                <v-col cols="12" class="pt-0 pb-0">
                                    <v-textarea v-model="formValue.address1" label="Address line 1" filled ></v-textarea>
                                </v-col>
                                <v-col cols="12" class="pt-0 pb-0">
                                    <v-textarea v-model="formValue.address2" label="Address line 2" filled ></v-textarea>
                                </v-col>
                                <v-col cols="12" class="pt-0 pb-0">
                                    <v-text-field v-model="formValue.city" label="City"  filled></v-text-field>
                                </v-col>
                                <v-col cols="6" class="pt-0 pb-0">
                                    <v-text-field v-model="formValue.lat" label="Lat"  type="number"  filled></v-text-field>
                                </v-col>
                                <v-col cols="6" class="pt-0 pb-0">
                                    <v-text-field v-model="formValue.lon" label="Lon"  type="number"  filled></v-text-field>
                                </v-col>
                                <v-col cols="6" class="pt-0 pb-0">
                                    <v-btn color="success" @click="save" :loading="loading" :disabled="loading">Add</v-btn>
                                </v-col>
                                
                            </v-row>
                        </v-card-text>
                    </v-card>
                </v-col>

            </v-row>
             </v-card-text>
             <v-card-actions>
                 <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="dialog = false">Close</v-btn>
             </v-card-actions>
         </v-card>
    </v-dialog>
</template>
<script>
export default {
    data: () => ({
        dialog:false,
        loading:false,
        dataShipping:[],
        defaultItem:{
            user_id:'',
            name:'',
            address1:'',
            address2:'',
            city:'',
            lat:'',
            lon:'',
        },
        formValue:{
            user_id:'',
            name:'',
            address1:'',
            address2:'',
            city:'',
            lat:'',
            lon:'',
        }
    }),
    props:
    {
        trigger: false,
        item: Object,
    },
    methods:
    {
        async initialize() {
            this.start();
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/shipping/"+this.item.id
				});
				this.dataShipping = data;
            this.finish();
			} catch (e) {
            this.fail();

            }
        },
        close() {
			this.loading = false;
			setTimeout(() => {
				this.formValue = Object.assign({}, this.defaultItem);
			}, 300);
		},
        async save() {
            this.loading = true;
            this.formValue.user_id=this.item.id
            this.formValue.name=this.item.name
            this.formValue.contact=this.item.contact
			
				try {
					let { data } = await axios({
						method: "post",
						url: "/app/shipping",
						data: this.formValue
                    });
					if (data.status) {
                        this.dataShipping.push(data.data)
						
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
    created()
    {
        this.initialize();

    },
    watch:{
        trigger() {
            this.dialog=true
            this.initialize();
            }


    }

}
</script>
