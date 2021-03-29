<template>
  <v-content>
    <v-container fluid>
      <v-overlay :value="showFullLoading" :absolute="absolute">
        <v-progress-circular indeterminate size="64"></v-progress-circular>
      </v-overlay>
      <v-row justify="center">
        <v-col sm="12" md="12" lg="11">
          <v-row>
            <v-col cols="5">
              <v-select
                v-model="filters.branch_id"
                :items="dataBranch"
                item-text="name"
                item-value="id"
                label="Branch"
                required
                clearable
                filled
                @change="getOrder"
                :disabled="this.authUser.type==2"
              ></v-select>
            </v-col>
            <v-col cols="7">
              <v-text-field
                v-model="search"
                append-icon="search"
                label="Search"
                hide-details
                outlined
              ></v-text-field>
            </v-col>
          </v-row>
          <v-toolbar flat color="white">
            <v-toolbar-title>{{$t('message.order.list')}}</v-toolbar-title>
            <v-divider class="mx-2" inset vertical></v-divider>
            <v-spacer></v-spacer>
          </v-toolbar>

          <v-card flat>
            <v-card-text>
              <v-data-table
                :headers="headers"
                :items="dataList"
                :search="search"
                :items-per-page="filters.show"
                hide-default-footer
              >
                <template v-slot:item.created_at="{ item }">
                  <v-chip class="green darken-4 text-center" v-if="item.branch.status==2">
                    <span
                      class="white--text"
                      :color="item.branch.status==2?'purple':''"
                    >{{ item.created_at | moment("from") }}</span>
                  </v-chip>
                  <v-chip outlined class="green darken-4 text-center" v-else>
                    <span
                      class="white--black"
                      :color="item.branch.status==2?'purple':''"
                    >{{ item.created_at | moment("from") }}</span>
                  </v-chip>
                </template>
                <template v-slot:item.order_status_id="{ item }">
                  <v-select
                    v-model="item.order_status_id"
                    :items="dataStatus"
                    item-text="name"
                    item-value="id"
                    solo
                    dense
                    class="mt-3"
                    style="max-width: 150px"
                    @change="changeStatus(item)"
                  ></v-select>
                </template>
                <template v-slot:item.total="{ item }">
                  {{parseInt(item.total)-parseInt(item.discount)}}
                </template>
                <template v-slot:item.action="{ item }">
                  <v-icon color="blue" @click="editItem(item)">edit</v-icon>
                  <v-icon color="green" @click="viewItem(item)">remove_red_eye</v-icon>
                  <v-icon  color="grey"  @click="print(item.id)">print</v-icon>
                  <v-btn
                    v-if="item.delivery_agent==0"
                    x-small
                    color="warning"
                    @click="assignItem(item)"
                  >assign</v-btn>
                  <v-btn
                    v-else-if="item.order_status_id==1 || item.order_status_id==2 "
                    x-small
                    color="primary"
                    @click="assignItem(item)"
                  >change</v-btn>
                </template>
                <template v-slot:no-data>
                  <NoDataList :loading="loading" @initialize="initialize"></NoDataList>
                </template>
              </v-data-table>
              <div class="text-center">
                <v-pagination v-model="filters.page" :length="pageCount" @input="getOrder"></v-pagination>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <OrderView :trigger="isView" :orderData="editedItem"></OrderView>
      <v-btn bottom color="primary" dark fab fixed right @click="save">
        <v-icon>add</v-icon>
      </v-btn>
    </v-container>
    <v-dialog v-model="isAssign" max-width="350">
      <v-card>
        <v-card-title class="headline">Assign a Delivery Agent</v-card-title>

        <v-card-text>
          <v-select
            v-model="editedItem.delivery_agent"
            :items="dataDeliveryAgent"
            item-text="name"
            item-value="id"
            :rules="[v => !!v || 'Delivery Agent is required']"
            label="Delivery Agent"
            required
            filled
          ></v-select>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="red" text @click="isAssign = false">Close</v-btn>

          <v-btn
            color="green"
            text
            @click="assignAgent"
            :disabled="loading"
            :loading="loading"
          >Assign</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

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
import OrderView from "./OrderView";
import NoDataList from './../common/NoDataList'

export default {
  components: {
    OrderView,
    NoDataList
  },
  data: () => ({
  wakeLock: null,
	isAssign: false,
	isNew: false,
    setting: {},
    itemsPerPage: 1,
    pageCount: 1,
    search: "",
    sound: "/notification.mp3",
    absolute: true,
    loading: false,
    edit: true,
    dialog: false,
    dataList: [],
    dataCategory: [],
    dataBranch: [],
    dataDeliveryAgent: [],
    branch: [],
    filters: {
      category_id: null,
      branch_id: null,
      page: 1,
      show: 20,
      order_status_ids: [1,2]
    },
    headers: [
      { text: "ID", align: "left", value: "id" },
      { text: "Type", align: "left", value: "type" },
      { text: "Order Time", value: "created_at" },
      { text: "Customer", value: "customer_name" },
      { text: "Address", value: "address1" },
      { text: "Total", value: "total" },
      { text: "Status", value: "order_status_id" },
      { text: "Action", value: "action" }
    ],
    editedIndex: -1,
    editedItem: {},
    dataIndex: null,
    deleteTitle: "",
    deleteBody: "",
	isView: false,
	audioFile: new Audio('/alarm_tone.mp3'),
    defaultItem: {
      name: "",
      description: "",
      parent_id: 0,
      status: 1,
      branch: []
    },
    authUser: {},
    dataStatus: []
  }),

  props: {
    source: String
  },
  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "New Item" : "Edit Item";
	}
	
  },
  // watch: {
	//   isNew() {
	// 	if (this.isNew) {
  //     this.audioFile.loop = true;
	// 		this.audioFile.play();
	// 	}
	// 	else {
  //     this.audioFile.loop = false;
	// 		this.audioFile.pause();
	// 	}
	//   }
  // },
  created() {
      this.loading = true;
    // Initialize Firebase
    if (!firebase.apps.length) {
		  firebase.initializeApp(this.$store.state.firebaseConfig);
      firebase.analytics();
    }
    const messaging = firebase.messaging();
    messaging.onMessage(payload => {
      this.getProduct(payload.data.id);
    });

    this.authUser = this.$store.state.authUser;
    if (this.authUser.type == 2) {
      this.filters.branch_id = this.authUser.branch_id;
      this.initialize();
    } else {
      this.initialize();
    }
    const channel = new BroadcastChannel('listener');
      channel.addEventListener('message', (event) => {
        this.getProduct(event.data);
      });
  },
  methods: {
    	print(id)
    {
      let route = this.$router.resolve({path: '/app/print/'+id});
      // let route = this.$router.resolve('/link/to/page'); // This also works.
      window.open(route.href, '_blank');
    },
    async changeStatus(i) {
      this.loading = true;
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/order/" + i.id + "/edit",
          params: {
            order_status_id: i.order_status_id
          }
        });
        if (data.status) {
          this.snacks("Successfully Changed", "green");
          this.close();
        } else {
          this.snacks("Failed", "red");
          this.loading = false;
        }
      } catch (e) {
        this.snacks("Error, Server issue", "red");
        this.loading = false;
      }
    },
    async getProduct(id) {
      try {
        let { data } = await axios({
          method: "get",
          url: `/app/order/${id}`
		});
		this.isNew=true;
        let p = [];
        p.push(data);
        if (this.authUser.type == 2) {
          for (let d of p) {
            if (d.branch.branch_id == this.authUser.branch_id) {
              d.branch.status = 2;
              this.dataList.unshift(d);
            }
          }
        } else {
          for (let d of p) {
            d.branch.status = 2;
            this.dataList.unshift(d);
          }
        }
      } catch (e) {}
    },
    async initialize() {
      this.loading=true
      this.setting = this.$store.state.setting;
      this.filters.category_id = "";
      this.filters.page = 1;
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/branch"
        });
        this.dataBranch = data;
      } catch (e) {
              this.loading=false
      }
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/orderstatus"
        });
        this.dataStatus = data;
      } catch (e) {
        this.loading=false

      }
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/user",
          params: {
            type: 3
          }
        });
        this.dataDeliveryAgent = data;
      } catch (e) {
          this.loading=false
      }

      this.getOrder();
    },
    async getOrder() {
      this.load = true;
      try {
        let { data } = await axios({
          method: "get",
          url: "/app/order",
          params: this.filters
        });
        this.dataList = data.data;
        this.itemsPerPage = data.per_page;
        this.pageCount = data.last_page;
        this.filters.page = data.current_page;
        this.loading=false

      } catch (e) {
        this.loading=false

      }
    },
    async assignAgent() {
      this.loading = true;
      if (!this.editedItem.delivery_agent) {
        this.snacks("Please add delivery agent", "red");
        this.loading = false;
        return;
      }

      try {
        let { data } = await axios({
          method: "post",
          url: "/app/delivery",
          data: this.editedItem
        });
        if (data.status) {
          this.snacks("Successfully Done", "green");
          this.dataList[
            this.dataIndex
          ].delivery_agent = this.editedItem.delivery_agent;
          this.editedItem.delivery_agent = "";
          this.close();
        } else {
          this.snacks(data.data, "red");
          this.loading = false;
        }
      } catch (e) {
        this.snacks("Operation Failed", "red");
        this.loading = false;
      }
    },
    editItem(item) {
      this.$router.push("/dashboard/order/edit/" + item.id);
    },
    save(item) {
      this.$router.push("/dashboard/order/add");
    },
    deleteItem(item) {
      this.dataIndex = this.dataList.indexOf(item);
      this.deleteTitle = "Are you sure you want to delete this item?";
      this.isDelete = !this.isDelete;
    },
    viewItem(item) {
      this.editedItem = Object.assign({}, item);
      this.isView = !this.isView;
    },
    assignItem(item) {
      this.dataIndex = this.dataList.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.isAssign = !this.isAssign;
    },
    close() {
      this.dialog = false;
      this.isAssign = false;
      this.loading = false;
    },
    async remove() {
      this.loading = true;
      try {
        let { data } = await axios({
          method: "delete",
          url: "/app/order/" + this.dataList[this.dataIndex].id
        });
        if (data.status) {
          this.snacks("Successfully Done", "green");
          this.dataList.splice(this.dataIndex, 1);
          this.close();
        } else {
          this.snacks(data.data, "red");
          this.loading = false;
        }
      } catch (e) {
        this.snacks("Operation Failed", "red");
        this.loading = false;
      }
    },
    playSound() {
      // let audio = new Audio(this.sound);
      // audio.play();
    }
  },

  mounted() {


  }
};
</script>