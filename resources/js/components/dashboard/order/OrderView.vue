<template>
    <v-dialog v-model="dialog" persistent max-width="780">
        <v-card>
            <v-card-title>
                Order #{{orderData.id}}
            </v-card-title>
            <v-card-text>
                <v-row>
                    <v-col cols="6">
                        <v-card outlined>
                            <v-card-title>
                                Customer
                            </v-card-title>
                            <v-simple-table>
                                <template v-slot:default>
                                    
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td>{{orderData.customer_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td>{{orderData.address1}}</td>
                                    </tr>
                                    <tr>
                                        <td>Contact:</td>
                                        <td>{{orderData.contact}}</td>
                                    </tr>
                                </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>
                    <v-col cols="6">
                        <v-card outlined>
                            <v-card-title>
                                Branch
                            </v-card-title>
                            <v-simple-table >
                                <template v-slot:default>
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td>{{orderData.branch.name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Address:</td>
                                            <td>{{orderData.branch.address}}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact:</td>
                                            <td>{{orderData.branch.contact_1}}</td>
                                        </tr>
                                    </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>
                    <v-col cols="12">
                       <p class="title">Product List</p>
                        <v-data-table  
                                                    
                            :headers="headers"
                            :items="orderData.product"
                            hide-default-footer
                            :items-per-page="50"
                            no-data-text="No Item Added"
                        >
                        <template v-slot:item.name="{ item }">
                            {{item.product.info[0].name}}
                            <v-chip v-for="(ingredient,index) in item.ingredient" :key="index" class="ma-2" >
                                {{ingredient.title}}
                            </v-chip>
                        </template>
                        <template v-slot:item.size="{ item }">
                            {{item.product_size}}
                        </template>
                        <template v-slot:item.price="{ item }">
                            {{item.product_price}}
                        </template>
                        <template v-slot:item.quantity="{ item }">
                            {{item.quantity}}
                        </template>
                        <template v-slot:item.subtotal="{ item }">
                            {{item.product_price*item.quantity}}
                        </template>
                        </v-data-table>
                    </v-col>
                    <v-col cols="12">
                    <v-card dark>
                        <v-row>
                            <v-col cols="6">
                                <v-simple-table>
                                    <template v-slot:default>
                                    <tbody>
                                        <tr>
                                            <td>Status:</td>
                                            <td><b>{{orderData.order_status.name}}</b></td>
                                        </tr>
                                        <tr v-if="orderData.delivery_agent>0">
                                            <td>Delivery Agent:</td>
                                            <td><b>{{orderData.delivery.name}} - {{orderData.delivery.contact}}</b>  <v-btn x-small  text @click="closeDriver">Stop service</v-btn></td>
                                        </tr>

                                    </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                            <v-col cols="6">
                                <v-simple-table>
                                    <template v-slot:default>
                                    <tbody>
                                        <tr>
                                            <td>Items:</td>
                                            <td><b>{{totalItems}}</b></td>
                                        </tr>
                                       <tr v-if="orderData.discount>0">
                                            <td>Sub-Total:</td>
                                            <td><b>{{totalAmount}}</b></td>
                                        </tr>
                                        <tr v-if="orderData.discount>0">
                                            <td>Discount: {{orderData.coupon_id?'Coupon #'+orderData.coupon_id:''}}</td>
                                            <td><b>{{orderData.discount}}</b></td>
                                        </tr>
                                        <tr>
                                            <td>Total:</td>
                                            <td><b>{{parseInt(orderData.total)-parseInt(orderData.discount)}}</b></td>
                                        </tr>


                                    </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                            <v-col v-if="orderData.type=='Pickup'" cols="6">
                                <v-simple-table>
                                    <template v-slot:default>
                                    <tbody>
                                        <tr>
                                            <td>Pickup Date:</td>
                                            <td><b>{{orderData.pickup_date}}</b></td>
                                        </tr>
                                        <tr >
                                            <td>Pickup Time:</td>
                                            <td><b>{{orderData.pickup_time}}</b></td>
                                        </tr>
                                    </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                            <v-col v-if="orderData.type=='Pickup'" cols="6">
                                <v-simple-table>
                                    <template v-slot:default>
                                    <tbody>
                                        <tr>
                                            <td>Car Name:</td>
                                            <td><b>{{orderData.car_name}}</b></td>
                                        </tr>
                                        <tr >
                                            <td>Car Number:</td>
                                            <td><b>{{orderData.car_number}}</b></td>
                                        </tr>
                                    </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                            <v-col v-if="orderData.note" cols="12">
                                <v-simple-table>
                                    <template v-slot:default>
                                    <tbody>
                                        <tr>
                                            <td>Note:</td>
                                            <td ><b>{{orderData.note}}</b></td>
                                        </tr>
                                    </tbody>
                                    </template>
                                </v-simple-table>
                            </v-col>
                        </v-row>
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
        
        headers: [
          { text: 'ID', value: 'id' },
          { text: 'Name', value: 'name' },
          { text: 'Size', value: 'size' },
          { text: 'Price', value: 'price' },
          { text: 'Quantity', value: 'quantity' },
          { text: 'Sub-Total', value: 'subtotal' },
        ],
    }),
    props:
    {
        trigger: false,
        orderData: Object,

    },
    methods:
    {        
        closeDriver()
            {
                this.$emit('send',this.orderData.id)
            }

    },

    computed:{
        totalAmount()
		{
			var total=0
			for(let d of this.orderData.product)
			{
				total=parseInt(total)+parseInt(d.product_price*d.quantity)
			
			}
			return total;

		},
	    totalItems()
		{
			var total=0
			for(let d of this.orderData.product)
			{
				total=parseInt(total)+parseInt(d.quantity)
			
			}
			return total;

        },


    },
    watch:{
        trigger() {
            this.dialog=true
            }
            


    }

}
</script>
