<template>
	<v-content>
		<v-container fluid>
			<v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
			<v-toolbar color="transparent" flat>
				<v-toolbar-title >Add Product</v-toolbar-title>

				<v-spacer></v-spacer>

				<template >
					<v-btn large icon>
					<v-icon large color="error" @click="back">cancel</v-icon>
					</v-btn>
					<v-btn large icon v-show="valid && accept" @click="save">
					<v-icon large color="success" >check_circle</v-icon>
					</v-btn>
				</template>
			</v-toolbar>
			<v-form
				ref="form"
				v-model="valid"
				> 
			<v-row justify="center">    
 
                <v-col cols="12" lg="8">
                    <v-card >
                        <v-card-title> 
                            <v-icon large left color="primary" >
                                assignment
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.product.general')}}</span>
                        </v-card-title>
                        <v-card-text>
                                <v-tabs >
                                    <v-tab v-if="setting.language_status==0 ||setting.language_status==1 ">
                                        {{$t('message.main.english')}}
                                    </v-tab>
                                    <v-tab v-if="setting.language_status==0 ||setting.language_status==2 ">
                                        {{$t('message.main.arabic')}}
                                    </v-tab>
                                    <v-tab-item v-if="setting.language_status==0 ||setting.language_status==1 ">
                                        <v-card flat>
											<v-card-text>
												<v-row >
													<v-col cols="12"  >
														<v-text-field v-model="productInfo[0].name" label="Product Name*" @keyup="setMeta(0)" filled :rules="titleRules" counter="25"></v-text-field>
													</v-col>
													<v-col  cols="12">
														<v-textarea v-model="productInfo[0].description" label="Description*"  filled :rules="descRules" ></v-textarea>
													</v-col>
												</v-row>
											</v-card-text>
                                        </v-card>
                                    </v-tab-item>
                                    <v-tab-item >
                                        <v-card flat v-if="setting.language_status==0 ||setting.language_status==2 ">
											<v-card-text>
												<v-row>
													<v-col cols="12" >
														<v-text-field v-model="productInfo[1].name" label="Product Name (Arabic)*" filled @keyup="setMeta(1)" :rules="nameRules" counter="25"></v-text-field>
													</v-col>
													<v-col  cols="12">
														<v-textarea v-model="productInfo[1].description" label="Description (Arabic)*"  filled :rules="nameRules" ></v-textarea>
													</v-col>
												</v-row>
											</v-card-text>
                                        </v-card>
                                    </v-tab-item>
                                    </v-tabs>
									<v-divider></v-divider>
									<v-row>
										<!-- <v-col cols="12" >
											<v-text-field v-model="formValue.model" label="Model" filled></v-text-field>
										</v-col>
										<v-col cols="6" >
											<v-text-field v-model="formValue.points" label="Point"  type="number"  filled></v-text-field>
										</v-col>
										<v-col cols="6" >
											<v-text-field v-model="formValue.sort" label="Sort"  type="number"  filled></v-text-field>
										</v-col>
										<v-col cols="12" md="6" lg="6">
											<v-select
												v-model="formValue.veg"
												:items="dataStatus"
												item-text="name"
												item-value="value"
												filled
												label="Veg"
											></v-select>
										</v-col> -->
										<v-col cols="12" md="12" lg="12">
											<v-select
												v-model="formValue.status"
												:items="dataStatus"
												item-text="name"
												item-value="value"
												filled
												label="Status"
											></v-select>
										</v-col>
									</v-row>
                            
                        </v-card-text>
                    </v-card>
                </v-col>
                 <v-col cols="12" lg="4">
                     <v-card flat>
                        <v-card-title> 
                            <v-icon large left color="primary" >
                                bookmarks
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.product.link')}}</span>
                        </v-card-title>
                        <v-card-text> 
							<v-row>
								<!-- <v-col cols="12">
									<v-select
										v-model="group"
										:items="dataGroup"
										item-text="name"
										return-object
										:rules="[v => !!v.length || 'Group is required']"
										required
										label="Groups*"
										multiple
										filled
										chips
									>
									</v-select>
								</v-col> -->
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
												@change="getSubcategory"
											>
											</v-select>
										</v-col>
										<v-col cols="12">
											<v-select
												v-model="subcategory"
												:items="dataSubcategory"
												item-text="sub_category_name"
												return-object
												:rules="[v => !!v.length || 'Subcategory is required']"
												required
												label="Subcategory*"
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
									<v-card outlined >
										<v-card-title>
											<v-icon large left color="primary" >
												monetization_on
											</v-icon>
											<span class="title font-weight-light" >{{$t('message.product.pricing')}}</span>
										</v-card-title>
												<v-card-text>
													<v-row>
														<!-- <v-col cols="6">
															<span class="title">Price</span>
															<v-radio-group v-model="formValue.price_type" row>
																<v-radio label="Single" value="single"></v-radio>
																<v-radio label="Many" value="many"></v-radio>
															</v-radio-group>
														</v-col> -->
														<v-col cols="6">
															<span class="title">Size</span>
															<v-radio-group v-model="formValue.size_type" row>
																<v-radio label="Single" value="single"></v-radio>
																<v-radio label="Many" value="many"></v-radio>
															</v-radio-group>
														</v-col>
													</v-row>
													<!-- <v-row v-if="formValue.price_type=='single' && formValue.size_type=='single'">
														<v-col cols="12" >
															<v-text-field v-model="formValue.price" label="Price*"  :suffix="setting.currency" type="number"  :rules="nameRules" filled></v-text-field>
														</v-col>
													</v-row>
													<v-row v-if="formValue.price_type=='single' && formValue.size_type=='many'">
														<v-col cols="12" >
															<v-text-field v-model="formValue.price" label="Price*"  :suffix="setting.currency" type="number"  :rules="nameRules" filled></v-text-field>
														</v-col>
													</v-row> -->
													<v-row v-if="formValue.size_type=='single'" >
														<v-col>
															<v-row v-for="(item,index) in branch" :key="index">
																<v-col cols="8">
																	<v-text-field v-model="branch[index].price[0].price" :label="item.name+'*'" :rules="nameRules" type="number"  :suffix="setting.currency" filled></v-text-field>
																</v-col>
																<v-col cols="4">
																	<v-btn color="primary" small @click="setAll(branch[index].price)">Set to all</v-btn>
																</v-col>
															</v-row>
														</v-col>
													</v-row>
													<v-row v-if="formValue.size_type=='many'" >
														<v-col cols="12" v-for="(item,i) in branch" :key="i">
															<v-toolbar flat transparent dense>
																<v-toolbar-title>{{branch[i].name}}</v-toolbar-title>

																<v-spacer></v-spacer>

																<v-btn color="primary" class="mx-3" small @click="setAll(branch[i].price)">Set to all</v-btn>
																<v-btn color="success"  class="mx-3" small @click="addField(i)">Add Field</v-btn>
															</v-toolbar>
															<!-- <span class="title">{{branch[i].name}}</span> | <v-btn color="primary" small @click="setAll(branch[i].price)">Set to all</v-btn><v-btn color="primary" small @click="addField(i)">Add Field</v-btn> -->
															<v-row v-for="(price,j) in branch[i].price" :key="j">
																<v-col cols="5">
																	<v-text-field v-model="branch[i].price[j].tag" label="Size*" :rules="nameRules"  hint="Tag for size" persistent-hint filled></v-text-field>
																</v-col>
																<v-col cols="5">
																	<v-text-field v-model="branch[i].price[j].price" label="Price*" :rules="nameRules" type="number"  :suffix="setting.currency" filled></v-text-field>
																</v-col>
																<v-col cols="2">
																	<v-btn color="error"  small @click="removePrice(i,j)">X</v-btn>
																</v-col>
															</v-row>
														</v-col>
													</v-row>
												</v-card-text>
									</v-card>
								</v-col>
								<!-- <v-col cols="12">
									<v-select
										v-model="cuisine"
										:items="dataCuisine"
										item-text="title"
										return-object
										label="Cuisine"
										multiple
										filled
										chips
									>
									</v-select>
								</v-col> -->
								<v-col cols="12">
									<v-card outlined >
										<v-card-title>
											<v-icon large left color="primary" >
												leaf
											</v-icon>
											<span class="title font-weight-light" >{{$t('message.product.ingredient')}}</span>
										</v-card-title>
										<v-card-text>
									<v-select
										v-model="ingredient"
										:items="dataIngredient"
										item-text="title"
										return-object
										label="Ingredient"
										multiple
										filled
										chips
									>
									</v-select>
									<v-row v-for="(item,i) in ingredient" :key="i" color="grey lighten-1">
										<v-col cols="12">
											<v-text-field v-model="item.price" :label="item.title" type="number"  :suffix="setting.currency" filled></v-text-field>
										</v-col>																				
													</v-row>
										</v-card-text>
									</v-card>
								</v-col>
								<v-col cols="12">
									<v-select
										v-model="tag"
										:items="dataTag"
										item-text="name"
										return-object
										label="Tag"
										multiple
										filled
										chips
									>
									</v-select>
								</v-col>
							</v-row>
                        </v-card-text>
                    </v-card>
                 </v-col>
                <v-col cols="12" lg="8">
                     <v-card flat>
                        <v-card-title> 
                            <v-icon large left color="primary" >
                                attach_file
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.product.media')}}</span>
                        </v-card-title>
                        <v-card-text> 
							<Media :formValue="formValue" @files="filesValue"></Media>
							<v-text-field v-model="formValue.video_link" label="Youtube Video URL" filled></v-text-field>
                        </v-card-text>
                    </v-card>
                 </v-col>
				<v-col cols="12" lg="4">
                     <v-card flat>
                        <v-card-title> 
                            <v-icon large left color="primary" >
                                web
                            </v-icon>
                            <span class="title font-weight-light" >{{$t('message.product.seo')}}</span>
                        </v-card-title>
                        <v-card-text> 
							<v-row>
								<v-col cols="12" >
									<v-text-field v-model="formValue.meta_title" label="Meta Title*" :rules="nameRules" filled></v-text-field>
								</v-col>
								<v-col cols="12" >
									<v-textarea v-model="formValue.meta_description" label="Meta Description" filled></v-textarea>
								</v-col>
								<v-col cols="12" >
									<v-text-field v-model="formValue.meta_keyword" label="Meta Tags" filled></v-text-field>
								</v-col>
								
							</v-row>
                        </v-card-text>
                    </v-card>
                 </v-col>
			</v-row>
				</v-form>
			<v-btn v-show="valid && accept" bottom color="green  darken-3" dark fab fixed right @click="save">
				<v-icon>check</v-icon>
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
import Media from './Media'
export default {
	components:
	{
		Media
	},
	data: () => ({
		setting:{},
		valid:false,
		absolute:false,
		branch:[],
		cuisine:[],
		tag:[],
		ingredient:[],
		dataGroup:[],
		dataBranch:[],
		dataCategory:[],
		dataSubcategory:[],
		dataCuisine:[],
		dataIngredient:[],
		dataTag:[],
		category:[],
		subcategory:[],
		group:[],
		loading: false,
		media:[],
		temp:{
			
		},
		productInfo:[
			{
				name:'',
				description:'',
				language:'en',
			},
			{
				name:'',
				description:'',
				language:'ar',
			}
		],
		formValue: {
			model:"",
			video_link:'',
			points:"",
			dimensions_l:"",
			dimensions_w:"",
			dimensions_h:"",
			dimensions_class:"",
			weight:"",
			weight_class:"",
			sort:0,
			veg:0,
			status: 1,
            price:"",
            image:[],
			price_type:"single",
			meta_title:"",
			meta_description:"",
			meta_keyword:"",
			slug:""
		},
		nameRules: [
			v => (!!v || v.length > 0) || 'This Field is required',
			],
		titleRules: [
			v => !!v || 'This Field is required',
			v => v.length <= 191 || 'Max 191 characters'
			],
		descRules: [
			v => !!v || 'This Field is required'
			],
		defaultItem: {
			model:"",
			video_link:'',
			points:"",
			dimensions_l:"",
			dimensions_w:"",
			dimensions_h:"",
			dimensions_class:"",
			weight:"",
			weight_class:"",
			sort:0,
			veg:0,
			status: 1,
            price:"",
            image:[],
			price_type:"single",
			meta_title:"",
			meta_description:"",
			meta_keyword:"",
			slug:""
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
		accept()
		{
			if(this.setting.language_status==0)
			{
				if(this.productInfo[0].name && this.productInfo[1].name && this.productInfo[0].description && this.productInfo[1].description )
					return true;
				else
					return false;
			}
			else
				return true
		},
		
	},
	watch: {},
	created() {
		this.initialize();
	},
	methods: {
		removePrice(i,j)
		{
			if(this.branch[i].price.length>1)
			this.branch[i].price.splice(j, 1);
			else
			this.snacks("Minimum 1 field required, cannot remove this last field", "red");


		},
		addField(i)
		{
			this.branch[i].price.push({
							tag:'',
							description:'',
							price:0
							
						});

		},
		setAll(item)
		{
			var _price=item
			
			for(let d of this.branch)
			{
				d.price=JSON.parse(JSON.stringify(item));

			}

		},
		back()
		{
			this.$router.push('/dashboard/product/list');
		},
		setMeta(i)
		{
			if(this.setting.language_status==0)
				this.formValue.meta_title=this.productInfo[0].name
			else
				this.formValue.meta_title=this.productInfo[i].name
		},
		filesValue(item)
		{
			this.media=item;
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
			this.setting=this.$store.state.setting;
			this.start();
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/group"
				});
				this.dataGroup = data;
			} catch (e) {
				this.fail();
                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/cuisine"
				});
				this.dataCuisine = data;
			} catch (e) {
				this.fail();
                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/tag"
				});
				this.dataTag = data;
			} catch (e) {
				this.fail();
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/ingredient"
				});
				this.dataIngredient = data;
			} catch (e) {
				this.fail();
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/product/"+this.$route.params.id
				});
                this.formValue = data;

                for(let d of data.category)
                {
                    this.category.push(d.category)

				}
				for(let d of data.subcategory)
                {
                    this.subcategory.push(d.subcategory)

				}
				for(let d of data.cuisine)
                {
                    this.cuisine.push(d.cuisine)

				}
				for(let d of data.tag)
                {
                    this.tag.push(d.tag)

				}
				for(let d of data.group)
                {
                    this.group.push(d)

				}
				for(let d of data.ingredient)
                {
					d.ingredient.price=d.price
                    this.ingredient.push(d.ingredient)

				}
				
                this.productInfo=data.info
                this.getBranch();
                for(let d of data.branches)
                {
					d.branch.price=d.price;
					this.branch.push(JSON.parse(JSON.stringify(d.branch)))
                }
			} catch (e) {
				this.fail();
                
            }
            try {
				let { data } = await axios({
					method: "get",
					url: "/app/categories"
				});
				this.dataCategory = data;
			} catch (e) {
				this.fail();
                
			}
			try {
				let { data } = await axios({
					method: "get",
					url: "/app/subcategories"
				});
				this.dataSubcategory = data;
			} catch (e) {
				this.fail();
                
			}
			this.finish();
		},

		async getSubcategory() {
			
			var category =[]
			if(!this.category.length)
			{				
				this.Subcategory=[]
				return 
			}
			this.loading = true;
			
			
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/subcategory_by_category",
					data: this.category
				});
				var subcategory=[];

				for(let d of data)
				{
					
					subcategory.push(d.subcategory)

				}
				
				this.dataSubcategory=subcategory
				let intersection=this.subcategory.filter((data)=>{
                    
					for(let d of this.dataSubcategory)
					{
						if(d.id==data.id)
						return d;
					}
                });
				this.subcategory=intersection;
				this.loading = false;
			} catch (e) {
				this.snacks("Somthing Wrong", "red");
				this.loading = false;
			}
			
		},

		async getBranch() {
			
			var subcategory =[]
			if(!this.subcategory.length)
			{				
				this.dataBranch=[]
				return 
			}
			this.loading = true;
			
			
			try {
				let { data } = await axios({
					method: "post",
					url: "/app/branch_by_subcategory",
					data: this.subcategory
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

		close() {
			this.dialog = false;
			this.loading = false;
			this.back();
		},
		async save() {
			this.loading = true;
			
				try {
					const formData = new FormData();
					for ( var key in this.formValue ) {
						formData.append(key,this.formValue[key]);
					}
					this.category.forEach(file => {
						formData.append("categoryEdit[]", JSON.stringify(file));
					});
					this.subcategory.forEach(file => {
						formData.append("subcategoryEdit[]", JSON.stringify(file));
					});
					this.productInfo.forEach(file => {
						formData.append("productEdit[]", JSON.stringify(file));
					});
					this.branch.forEach(file => {
						formData.append("branchEdit[]", JSON.stringify(file));
					});
					this.cuisine.forEach(file => {
						formData.append("cuisineEdit[]", JSON.stringify(file));
					});
					this.ingredient.forEach(file => {
						formData.append("ingredientEdit[]", JSON.stringify(file));
					});
					this.tag.forEach(file => {
						formData.append("tagEdit[]", JSON.stringify(file));
					});
					this.media.forEach(file => {
						formData.append("media[]", file, file.name);
					});
					this.group.forEach(file => {
						formData.append("group[]", JSON.stringify(file));
					});
					this.formValue.image.forEach(file => {
						formData.append("imageEdit[]", JSON.stringify(file));
					});


					formData.append("_method", "put");
					let { data } = await axios({
						method: "post",
						url: "/app/product/"+this.$route.params.id,
                        data: formData,

					});
					if (data.status) {
						this.snacks("Successfully Edited", "green");
						this.close();
					} else {
						this.snacks("Failed", "red");
						this.loading = false;
					}
				} catch (e) {
					this.snacks(data.data, "red");
					this.loading = false;
				}

		}
	}
};
</script>