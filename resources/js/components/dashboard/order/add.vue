<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<!-- <v-toolbar color="transparent" flat>
				<v-toolbar-title >{{$t('message.order.add')}}</v-toolbar-title>

				<v-spacer></v-spacer>

				<template >
					<v-btn large icon @click="back">
					    <v-icon large color="error" >cancel</v-icon>
					</v-btn>
					<v-btn large icon v-show="valid && accept" @click="isCustomer=!isCustomer">
					    <v-icon large color="success">check_circle</v-icon>
					</v-btn>
				</template>
			</v-toolbar> -->
            
			<v-row justify="center">
				<v-col cols="12" md="6">
                    <v-card flat style="height: 760px" class="overflow-y-auto">
                        <v-card-title> 
                            <v-icon left color="primary" >
                                assignment
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.order.products')}}</span>
                            <v-spacer></v-spacer>
                            <v-select
                                    v-model="filter.branch_id"
                                    :items="dataBranch"
                                    item-text="name"
                                    item-value="id"
                                    label="Branches"
                                    disable-pagination										
                                    filled
                                    @change="getProducts"
                                    dense
                                >
                            </v-select>
							<v-select
                                    v-model="filter.category_id"
                                    :items="dataCategory"
                                    item-text="name"
                                    item-value="id"
                                    label="Categories"
                                    disable-pagination										
                                    filled
                                    @change="getProducts('category')"
                                    dense
                                >
                            </v-select>
							<v-select
                                    v-model="filter.subcategory_id"
                                    :items="dataSubcategory"
                                    item-text="sub_category_name"
                                    item-value="id"
                                    label="Subcategories"
                                    disable-pagination										
                                    filled
                                    @change="getProducts('subcategory')"
                                    dense
                                >
                            </v-select>
                            <!-- <v-text-field
                                v-model="search"
                                append-icon="search"
                                label="Search"
                                class="mx-3"
                                outlined
                                dense
                            ></v-text-field> -->
                        </v-card-title>
						 <v-card-text  v-show="loading" style="min-height: 600px" class="overflow-y-auto">
							 <v-row flat>
								<v-col cols="4" lg="3" md="3"  v-for="i in 4" :key="i" v-show="dataProducts" >
									<v-skeleton-loader
										type="card"
										max-height="150px"
									></v-skeleton-loader>
								</v-col>
							 </v-row>
						 </v-card-text>
                        <v-card-text v-show="filter.branch_id" style="min-height: 600px" class="overflow-y-auto">
                            <v-row flat>

                                <v-col cols="4" lg="3" md="3" v-for="(item,index) in dataProducts" :key="index">
                                    <v-card @click="addItem(item)" outlined>
                                        <v-img
                                        :src="item.product.image.length>0?item.product.image[0].src:image"
                                        class="white--text align-end"
                                        gradient="to bottom, rgba(0,0,0,.0), rgba(0,0,0,.3)"
                                        max-height="200px"
                                        >
                                        <v-card-title class="subtitle-2">
                                            <span v-if="item.product.size_type=='single'">{{item.price[0].price +' '+setting.currency}}</span>
                                            <span v-else-if="item.product.size_type=='many'"><div v-for="(price,j) in item.price" :key="j">{{price.price}}/</div>{{setting.currency}}</span>

                                        </v-card-title>
                                        </v-img>

                                        <v-card-actions>
                                        {{item.product.info[0].name}}
                                        </v-card-actions>
                                    </v-card>
                                </v-col>
                            </v-row>
                            
                        </v-card-text>
						<v-card-actions>
							
						</v-card-actions>
                    </v-card>
                </v-col>
				<v-col cols="12" md="6" >
                     <v-card flat style="height: 760px" >
                        <v-card-title> 
                            <v-icon  left color="primary" >
                                bookmarks
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.order.selected')}}</span>
                            <v-spacer></v-spacer>

                        </v-card-title>
                        <v-card-text  style="height: 560px" class="overflow-y-auto"> 


                              <v-data-table                              
                                    :headers="headers"
                                    :items="cart"
                                    hide-default-footer
                                    :items-per-page="50"
                                    no-data-text="No Item Added"
									item-key="index"
                                >
                                <template v-slot:item.name="{ item }">
                                    {{item.product.info[0].name}}
                                </template>
                                <template v-slot:item.size="{ item }">
									<span v-if="item.product.size_type=='single'">
										-
									</span>
			
									<v-select
									v-else
                                    v-model="item.size"
									solo
									dense
									
                                    :items="item.price"
                                    item-text="tag"
                                    return-object
                                    label="Size"
									style="width: 70px"
									class="mt-0 pt-0"
									hide-details
                               		 >
									</v-select>
                                </template>
							<template v-slot:item.price="{ item }">
									{{item.size.price}}
                                </template>
								<template v-slot:item.quantity="{ item }">
									<v-text-field
										v-model="item.quantity"
										solo
										dense
										class="mt-0 pt-0"
										hide-details
										type="number"
										style="width: 70px"
										@keyup="cart=cart"										
									></v-text-field>
                                </template>
                                <template v-slot:item.subtotal="{ item }">
									{{item.size.price*item.quantity}}
									<!-- <span v-if="item.product.size_type=='single'">{{item.product.price*item.quantity}}</span>
                                    <span v-else-if="item.product.price_type=='many'">{{item.price*item.quantity}}</span> -->
                                </template>
								<template v-slot:item.action="{ item }">
                                   <v-btn color="error" x-small @click="remove(item)">
									  <v-icon light>remove</v-icon>
								   </v-btn>
                                </template>
                                </v-data-table>
                        </v-card-text>
						<v-card-actions class="pa-0 px-3">
							<v-spacer></v-spacer>
							<v-simple-table>
								<template v-slot:default>
								<tbody>
									<tr>
										<td class="title">Total Items:</td>
										<td class="title">{{totalItems}}</td>
										<td class="title">Total Amount:</td>
										<td class="title">{{totalAmount}}</td>
									</tr>
								</tbody>
								</template>
							</v-simple-table>
							<!-- <v-spacer></v-spacer>
							<p class="title">Total: {{totalAmount}}</p> -->
						</v-card-actions>
						<!-- <v-card-actions class="pa-0 px-3" >
							<v-spacer></v-spacer>
							<p class="title" >Items: {{totalItems}}</p>
						</v-card-actions> -->
                    </v-card>
                 </v-col>

				<v-col cols="12" >
                    <v-card flat style="min-height: 760px" class="overflow-y-auto">
                        <v-card-title> 
                            <v-icon left color="primary" >
                                face
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.order.customer')}}</span>

                        </v-card-title>
                    <v-card-text>
						<v-form ref="form" v-model="valid" >
							<v-row>
						
								<v-col cols="12"  class="pa-0 px-3">
									<v-combobox
										v-model="contact"
										:items="dataCustomer"
										item-value="contact"
										item-text="contact"
										@change="customerSelect"
										label="Contact Number"
										filled
										:rules="nameRules"
										@click:clear="customerRemove"
										clearable
										type="number"
									>
									</v-combobox>
								</v-col>
								<v-col cols="12">
									<v-text-field v-model="formValue.customer_name" label="Customer Name"  filled></v-text-field>
								</v-col>
								<v-col cols="12">
									<v-text-field v-model="formValue.address1" label="Address" :rules="nameRules" filled></v-text-field>
								</v-col>
								<v-col cols="12">
									<v-textarea v-model="formValue.note" label="Note" filled></v-textarea>
								</v-col>
								<v-col cols="6">
									<v-select
										v-model="formValue.status"
										:items="dataStatus"
										item-text="name"
										item-value="id"
										label="Status"
										required
										filled
									></v-select>
								</v-col>
								<v-col cols="6">
									<v-select
										v-model="formValue.type"
										:items="dataType"
										label="Order Type"
										required
										filled
									></v-select>
								</v-col>
								<v-col cols="6">
									<v-menu
										ref="menu"
										v-model="isPickupTime"
										:close-on-content-click="false"
										:nudge-right="40"
										:return-value.sync="formValue.pickup_time"
										transition="scale-transition"
										offset-y
										max-width="290px"
										min-width="290px"
									>
										<template v-slot:activator="{ on }">
										<v-text-field
											v-model="formValue.pickup_time"
											label="Picker in menu"
											prepend-inner-icon="access_time"
											readonly
											v-on="on"
											filled
										></v-text-field>
										</template>
										<v-time-picker
										v-if="isPickupTime"
										v-model="formValue.pickup_time"
										full-width
										@click:minute="$refs.menu.save(formValue.pickup_time)"
										></v-time-picker>
									</v-menu>
								</v-col>
								<v-col cols="6">
									<v-menu
										v-model="isPickupDate"
										:close-on-content-click="false"
										:nudge-right="40"
										transition="scale-transition"
										offset-y
										min-width="290px"
									>
										<template v-slot:activator="{ on }">
										<v-text-field
											v-model="formValue.pickup_date"
											label="Picker without buttons"
											prepend-inner-icon="event"
											readonly
											filled
											v-on="on"
										></v-text-field>
										</template>
										<v-date-picker v-model="formValue.pickup_date" @input="isPickupDate = false"></v-date-picker>
									</v-menu>
								</v-col>
								<v-col cols="6">
									<v-text-field v-model="formValue.car_number" label="Car Number"  filled></v-text-field>
								</v-col>
								<v-col cols="6">
									<v-btn color="success" x-large block :disabled="!accept || loading" @click="save" :loading="loading">Confirm</v-btn>
								</v-col>
							</v-row>
						</v-form>
                    </v-card-text>
                    </v-card>
				</v-col>

               
			</v-row>
				
			<!-- <v-btn v-show="accept" bottom color="green  darken-3" dark fab fixed right @click="isCustomer=!isCustomer">
				<v-icon>check</v-icon>
			</v-btn> -->
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
export default {
	data: () => ({
		isPickupTime:false,
		isPickupDate:false,
		contact:null,
		search:'',
		image:'/no_image.png',
		isCustomer:false,
		cart:[],
		setting:{},
		valid:false,
		absolute:false,
		branch:'',
		dataBranch:[],
		dataCustomer:[],
		dataProducts:[],
		dataCategory:[],
		dataSubcategory:[],
		dataStatus:[],
		dataType:['Delivery', 'Pickup'],
		loading: false,

        headers: [
          { text: 'Name', value: 'name' },
          { text: 'Size', value: 'size' },
          { text: 'Price', value: 'price' },
          { text: 'Quantity', value: 'quantity' },
          { text: 'Sub-Total', value: 'subtotal' },
          { text: 'Action', value: 'action' },
        ],

		formValue: {
			user_id:1,
			customer_id:1,
			customer_name:'',
			invoice_prefix:'',
			branch_id:'',
			shipping_address_id:0,
			address1:'',
			address2:'',
			city:'',
			lat:'',
			lon:'',
			total:0,
			order_status_id:1,
			pickup_time:'',
			pickup_date:'',
			car_number:'',
			ip:'12.45.78',
			note:'',
			status:2,
			type:'Delivery'
		},
		defaultItem: {
			user_id:1,
			customer_id:1,
			customer_name:'',
			invoice_prefix:'ShopOrder',
			branch_id:'',
			shipping_address_id:0,
			address1:'',
			address2:'',
			city:'',
			lat:'',
			lon:'',
			total:0,
			order_status_id:1,
			pickup_time:'',
			pickup_date:'',
			car_number:'',
			ip:'12.45.78',
			note:'',
			status:2,
			type:'Delivery'
		},
        filter:{
            category_id:null,
			subcategory_id:null,
            branch_id:null,

        },
		nameRules: [
			v => !!v || 'This Field is required'
			],

	}),

	props: {
		source: String
	},
	computed: {
		totalAmount()
		{
			var total=0
			for(let d of this.cart)
			{
				total=parseInt(total)+parseInt(d.size.price*d.quantity)
			
			}
			return total;

		},
	totalItems()
		{
			var total=0
			for(let d of this.cart)
			{
				total=parseInt(total)+parseInt(d.quantity)
			
			}
			return total;

		},
	accept()
		{
			if(this.cart.length>0 && this.valid)
			{
				return true
			}
			else
				return false
		},
		
	},
	watch: {},
	created() {
	this.initialize();
	},
	methods: {
		customerSelect(data)
		{
			if(data === data.toString()){
				Object.assign({}, this.formValue);
				this.formValue.contact=data
			}else{
				this.formValue.customer_id=data.id;
				this.formValue.contact=data.contact
				this.formValue.customer_name=data.name;
				this.formValue.address1=data.address;
				
			}
		},
        addItem(item)
        {
			if(item.product.size_type=='single')
			{
				for(let i of this.cart)
				{
					if(i.product_id==item.product_id)
					{
						i.quantity++;
						return
					}
				}
			}
			var data=Object.assign({}, item);
			data.size=Object.assign({}, item.price[0]);
			this.cart.push(data);
        },

		async initialize() {
			this.start();
			this.setting=this.$store.state.setting
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/branch"
				});
				this.dataBranch = data;
			} catch (e) {
			this.fail();                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/orderstatus"
				});
				this.dataStatus = data;
			} catch (e) {
			this.fail();                
                
            }
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/customer"
				});
				this.dataCustomer = data;
			} catch (e) {
			this.fail();                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/category"
				});
				this.dataCategory = data;
			} catch (e) {
			this.fail();                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/subcategory"
				});
				this.dataSubcategory = data;
			} catch (e) {
			this.fail();                
			}
			this.finish();                

		},

		async getProducts(data) {
			if((data!='category') && (data!='subcategory'))
            	this.cart=[];
			this.loading = true;
			this.formValue.branch_id=this.filter.branch_id
			this.formValue.invoice_prefix=this.filter.branch_id
			this.defaultItem.invoice_prefix=this.filter.branch_id
			this.defaultItem.branch_id=this.filter.branch_id
            
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/products",
					params: this.filter
				});
				for(let d of data)
				{
					d.quantity=1;
				}
				this.dataProducts=data
				this.loading = false;
			} catch (e) {
				this.snacks("Somthing Wrong", "red");
				this.loading = false;
			}
			
		},
		back()
		{
			this.$router.push('/dashboard/order/list');
		},
		close() {
			this.$refs.form.reset();
			this.cart = [];
			this.formValue=Object.assign({}, this.defaultItem);
			this.loading = false;
		},
		remove(item)
		{
			var index = this.cart.indexOf(item);
			this.cart.splice(index, 1);

		},
		customerRemove(){
				this.formValue.customer_id=1
				this.formValue.contact=''
				this.formValue.customer_name=''
				this.formValue.address1=''
		},
		async save() {
			this.loading = true;
			this.formValue.total=this.totalAmount
			try {
				const formData = new FormData();
				this.cart.forEach(file => {
					formData.append("cart[]", JSON.stringify(file));
				});
				for ( var key in this.formValue ) {
					formData.append(key, this.formValue[key]);
				}
				let { data } = await axios({
					method: "post",
					url: "/app/order",
					data: formData
				});
				if (data.status) {
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
};
</script>