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
                  <span class="title font-weight-light" dark>{{$t('message.page.termsandcondition')}}</span>
                </v-card-title>
                <v-card-text >
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
                                            <v-text-field v-model="formValue[0].title" label="Title*" filled :rules="nameRules" ></v-text-field>
                                        </v-col>
                                        <v-col  cols="12">
                                            <v-textarea v-model="formValue[0].description" label="Description*"  filled :rules="nameRules" ></v-textarea>
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
                                            <v-text-field v-model="formValue[1].title" label="Title (Arabic)*" filled :rules="nameRules" ></v-text-field>
                                        </v-col>
                                        <v-col  cols="12">
                                            <v-textarea v-model="formValue[1].description" label="Description (Arabic)*"  filled :rules="nameRules" ></v-textarea>
                                        </v-col>
                                    </v-row>
                                </v-card-text>
                            </v-card>
                        </v-tab-item>
                        </v-tabs>

                  <v-row align="center">
                    <div class="ml-5">
                      <v-btn color="primary" :loading="loading" :disabled="loading" @click="update">Update</v-btn>                      
                    </div>
                  </v-row>
                </v-card-text>
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
    setting:{},
    imageFile:null,
    loading: false,
    absolute: false,
    nameRules: [
    v => !!v || 'This Field is required'
    ],
    formValue:[
        {
            title:'',
            description:'',
            language:'en',
        },
        {
            title:'',
            description:'',
            language:'ar',
        }
    ],
    
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
          method: "post",
          url: "/app/page",
          data: this.formValue
        });
        this.snacks("Successfully Done", "green");
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
        this.setting=this.$store.state.setting
        try {
            let { data } = await axios({
            method: "get",
            url: "/app/page/tnc"
            });
            this.formValue = data;
        } catch (e) {
            this.fail();
        }
        this.finish();
    },
    
  },
  
};
</script>

<style>
</style>