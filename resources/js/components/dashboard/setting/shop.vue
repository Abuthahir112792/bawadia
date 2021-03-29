<template>
  <v-content>
    <v-container fluid>
      <v-overlay :value="showFullLoading" :absolute="absolute">
				<v-progress-circular indeterminate size="64"></v-progress-circular>
			</v-overlay>
      <v-row justify="center">
        <v-col sm="12" md="8" lg="8">
              <v-card>
                <v-card-title>
                  <span class="title font-weight-light" dark>Shop Setting</span>
                </v-card-title>
                <v-card-text >
                  <v-row>
                    <v-col cols="12" >
                      <v-text-field v-model="dataList.name" label="Name" required filled></v-text-field>
                    </v-col>
                    <v-col  cols="12">
                      <v-textarea v-model="dataList.description" label="Description" required filled></v-textarea>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field v-model="dataList.currency" label="Currency" required filled></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-select
                            v-model="dataList.language_admin"
                            :items="dataLanguage"
                            item-text="text"
                            item-value="value"
                            filled
                            label="Dashboard Language"
                        ></v-select>
                    </v-col>
                    <v-col cols="6" >
                        <v-select
                            v-model="dataList.language"
                            :items="dataLanguage"
                            item-text="text"
                            item-value="value"
                            filled
                            label="Customer's Default Language"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" >
                        <v-select
                            v-model="dataList.language_status"
                            :items="dataLanguageOption"
                            item-text="text"
                            item-value="value"
                            filled
                            label="Language Options"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" md="6" lg="6">
                        <v-select
                            v-model="dataList.order_status"
                            :items="dataStatus"
                            item-text="name"
                            item-value="value"
                            filled
                            label="Order Live Status"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" md="6" lg="6">
                        <v-select
                            v-model="dataList.branch_status"
                            :items="dataStatus"
                            item-text="name"
                            item-value="value"
                            filled
                            label="Multi Branch"
                        ></v-select>
                    </v-col>
                  </v-row>

                  <v-row align="center">
                    <div class="ml-5">
                      <v-btn color="primary" :loading="loading" :disabled="loading" @click="update">Update</v-btn>                      
                    </div>
                  </v-row>
                </v-card-text>
              </v-card>
        </v-col>

        <v-col sm="12" md="4" lg="4">
          <v-card max-width="344" class="mx-auto">
            <v-img
              :src="dataList.image"
              height="194"
            ></v-img>
             <v-card-title>
              </v-card-title>
            <v-card-actions>
              <v-btn  color="primary" :loading="loading" :disabled="loading" @click="$refs.inputUpload.click()">
                    Image<v-icon right >add_a_photo</v-icon>
                  </v-btn>
                  <input
                    v-show="false"
                    ref="inputUpload"
                    accept="image/*"
                    type="file"
                    @change="profileChange"
                  />
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
      <v-snackbar
        v-model="snackbar"
        :vertical="snackvertical"
        :timeout="snacktimeout"
        :top="snacktop"
        :color="snackcolor"
      >
        {{ snacktext }}
        <v-btn color="white" text @click="snackbar = false">Close</v-btn>
      </v-snackbar>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: () => ({
    absolute:false,
    imageFile:null,
    loading: false,
    dataList: {
        name:'',
        description:'',
        image:'',
        currency:'',
        language:'',
        language_admin:'',
        language_status:'',
    },
    dataStatus: [
			{ name: "Active", value: 1 },
			{ name: "Disable", value: 0 }
		],
    dataLanguage:[
        { text:'English', value:'en' },
        { text:'Arabic', value:'ar' },
    ],
    dataLanguageOption:[
        { text:'Both', value:0 },
        { text:'English', value:1 },
        { text:'Arabic', value:2 },
    ]
    
  }),
  watch: {},
  created() {
    this.initialize();
  },
  methods: {
    async update() {
      this.loading = true;
      try {
        let { data } = await axios({
          method: "put",
          url: "/app/setting/1",
          data: this.dataList
        });
        this.snacks("Successfully Done", "green");
        this.$store.commit("setting", this.dataList);
        this.close();
      } catch (e) {
        this.loading = false;
        this.snacks("Operation Failed", "red");
      }
    },
    close() {
      this.loading = false;
    },
    async initialize() {
      this.start();
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/setting"
        });
        this.dataList = data;
      } catch (e) {
        this.fail();
      }
      this.finish();
    },
    async profileChange(e) {
      this.imageFile = event.target.files[0];
      this.upload();
    },
    async upload() {
      this.loading=true;
      const formData = new FormData();
      formData.append("myFile", this.imageFile, this.imageFile.name);
      try {
        let { data } = await axios({
          method: "post",
          url: "/app/logo",
          data: formData
        });
        if(data.status)
        {
            this.dataList.image = data.data;
            this.snacks("Successfully Uploaded", "green");
        }
        else
        {
            this.snacks(data.data, "red");
        }
        this.loading=false;
      } catch (error) {
        this.snacks("Operation Failed", "red");
        this.loading=false;
      }
    },
  },
  
};
</script>

<style>
</style>