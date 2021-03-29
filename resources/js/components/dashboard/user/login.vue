<template>
  <v-app>
    <v-content >
      <v-container  >
        <v-row align="center" justify="center">
          <v-col sm="8" md="6" lg="4">
            <v-card class="elevation-12">
              <OverLoading :trigger="isLoading" :message="message"></OverLoading>
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>{{$t('message.main.login')}}</v-toolbar-title>
                <div class="flex-grow-1"></div>
              </v-toolbar>
              <v-card-text>
                <v-text-field
                  v-model="formValue.email"
                  label="Email"
                  :rules="emailRules"
                  prepend-icon="mail"
                  type="text"
                  filled
                ></v-text-field>

                <v-text-field
                  v-model="formValue.password"
                  label="Password"
                  :rules="passwordRules"
                  prepend-icon="lock"
                  type="password"
                  filled
                ></v-text-field>
              </v-card-text>
              <v-card-actions>
                <div class="flex-grow-1"></div>
                <v-btn color="primary" dark @click="login">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
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
    </v-content>
  </v-app>
</template>

<script>
import OverLoading from "./../common/OverLoading";
export default {
  components: {
    OverLoading
  },
  props: {
    source: String
  },
  data: () => ({
	message:' Logging in ',
    isLoading: false,
    formValue: {
      password: "password",
      email: "zubaer.haque@gmail.com",
    },
    emailRules: [
      v => !!v || "E-mail is required",
      v => /.+@.+/.test(v) || "E-mail must be valid"
    ],

    passwordRules: [
      v => (v || "").length >= 8 || `A minimum of 8 characters is allowed`
    ]
  }),
  methods: {
    async login() {
      try {
        this.isLoading = true;
        this.start();
        let { data } = await axios({
          method: "post",
          url: "/app/login",
          data: this.formValue
        });
        if (data.access_token == false) {
          this.snacks(data.message, "red");
          this.isLoading = false;
          return;
        }
        this.authUser("Bearer " +data.access_token);
        this.snacks("Succesfully loggedin", "green");
      } catch (e) {
        this.fail();
        this.isLoading = false;
        this.snacks("Failed, try again", "red");
      }
    },
    async authUser(token) {
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/auth",
          headers: {
            Authorization: token
          }
        });
        data.token = token;
        this.$store.commit("user", data);
        this.isLoading = false;
        this.$router.push("/dashboard");
      } catch (e) {
        this.fail();
        this.snacks("Failed, try again", "red");
        this.isLoading = false;
      }
    },
    
  }
};
</script>