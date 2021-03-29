<template>
    <v-dialog v-model="dialog" persistent max-width="350">
        <v-card>
            <v-card-title>{{branchItem.branch.name}}</v-card-title>
            <v-card-text>
                <v-select
                    v-model="branchItem.status"
                    :items="dataStatus"
                    item-text="name"
                    item-value="value"
                    label="Status"
                    required
                    filled
                ></v-select>
            </v-card-text>
            <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="red darken-1" text @click="dialog = false">Close</v-btn>
            <v-btn color="green darken-1" text @click="deleteData">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    data: () => ({
        dialog:false,
        dataStatus: [
			{ name: "Active", value: 1 },
			{ name: "Disable", value: 0 }
		]
    }),
    props:
    {
        trigger: false,
        branchItem: Object,
    },
    methods:
    {
        deleteData()
        {
            this.$emit('request', this.branchItem)
            this.dialog=false
        }

    },
    watch:{
        trigger() {
            this.dialog=true
            }


    }

}
</script>
