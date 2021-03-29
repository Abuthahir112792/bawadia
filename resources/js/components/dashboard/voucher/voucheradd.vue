<template>
  <v-content>
    <v-container fluid>
      <v-row justify="center">
        <v-col sm="12" md="10" lg="8">
          <v-row>
            <v-col lg="12">
              <v-card>
                <v-card-title>
                  <span class="title font-weight-light" dark>{{$t('message.voucher.add')}}</span>
                </v-card-title>
                <v-card-text>
                  <v-row>
                    <v-col sm="12" md="12" lg="6">
                      <v-text-field v-model="dataList.code" label="Voucher Code" required disabled filled></v-text-field>
                    </v-col>
                    <v-col sm="12" md="12" lg="6">
                      <v-text-field v-model="dataList.redeemamount" label="Maximum Redeem Amount" required disabled filled></v-text-field>
                    </v-col>
                    <v-col sm="12" md="12" lg="6">
                      <v-text-field v-model="dataList.value" label="Voucher Value" required disabled filled></v-text-field>
                    </v-col>
                    <v-col sm="12" md="12" lg="6">
                      <v-text-field v-model="dataList.minimumcartvalue" label="Voucher Minimum Cart Value" required disabled filled></v-text-field>
                    </v-col>
                    <v-col sm="12" md="12" lg="6">
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
                                v-model="dataList.start"
                                label="Picker without buttons"
                                readonly
                                prepend-inner-icon="event"
                                v-on="on"
                                filled
                            ></v-text-field>
                            </template>
                            <v-date-picker v-model="dataList.start" @input="date1 = false"></v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col sm="12" md="12" lg="6">
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
                                v-model="dataList.end"
                                label="Picker without buttons"
                                prepend-inner-icon="event"
                                readonly
                                v-on="on"
                                filled
                            ></v-text-field>
                            </template>
                            <v-date-picker v-model="dataList.end" @input="date2 = false"></v-date-picker>
                        </v-menu>
                    </v-col>
                    <v-col sm="12" md="12" lg="6">
                        <header>Type</header>
                        <v-radio-group v-model="dataList.type" row>
                            <v-radio label="Cash" value="radio-1"></v-radio>
                            <v-radio label="Percentage" value="radio-2"></v-radio>
                        </v-radio-group>
                    </v-col>
                  </v-row>
                  <v-row align="center">
                    <div class="ml-5">
                      <v-btn color="primary" :loading="loading" :disabled="loading" @click="editProfile">Add</v-btn>                      
                    </div>
                  </v-row>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
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
    date1:false,
    date2:false,
    imageFile:null,
    loading: false,
    edit: false,
    dialog: false,
    dataUser: [],
    dataList: {
        code:'',
        redeemamount:'',
        value:'',
        minimumcartvalue:'',
        start:'',
        end:'',
        type:'',
    },
    password: {
      oldPassword: "",
      newPassword: "",
      confirmPassword: ""
    },
    passwordRules: [
      v => (v || "").length >= 8 || `Minimum Password charecter is 8`
    ],
    confirmPasswordRules: [
      v => (v || "").length >= 8 || `Minimum Password charecter is 8`,
      v => v == password.newPassword || "Should be same as new password"
    ]
  }),
  watch: {},
  created() {
    this.initialize();
  },
  methods: {
    async editProfile() {
      this.loading = true;
      try {
        let { data } = await axios({
          method: "put",
          url: "/app/user/"+this.dataList.id,
          data: this.dataList
        });
        this.snacks("Successfully Done", "green");
        this.close();
      } catch (e) {
        this.loading = false;
        this.snacks("Operation Failed", "red");
      }
    },
    changePassword() {
      this.dialog = true;
    },
    async save() {
      this.loading = true;
      try {
        let { data } = await axios({
          method: "post",
          url: "/app/changepassword",
          data: this.password
        });

        if (data.status) {
          this.snacks("Successfully Changed", "red");
          
        } else {
          this.snacks(data.message, "red");
          this.loading = false;
        }
        this.close();
      } catch (e) {
        this.loading = false;
        this.snacks("Operation Failed", "red");
      }
    },
    close() {
      this.dialog = false;
      this.loading = false;
    },
    async initialize() {
      this.start();
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/profile"
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
          url: "/app/avatar",
          data: formData
        });
        this.dataList.image = data.data;
        this.snacks("Successfully Uploaded", "green");
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