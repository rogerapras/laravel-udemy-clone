<template>
    <v-client-table
        name="purchaseTable"
        :data="tableData"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <div slot="child_row" slot-scope="props" v-if="props.row.comment">
            <div class="card card-body d-flex mb-0">
                <div>
                    <b>{{ trans('strings.comment')}}: </b>{{props.row.comment}}
                </div>
                <div>
                    <b>{{ trans('strings.gateway_payout_id')}}: </b>{{ props.row.payout_batch_id }}
                </div>
                <!-- <div class="mt-1" v-if="props.row.payout_batch_status !== 'SUCCESS'">
                    <update-payout-batch-status-button :uuid="props.row.uuid"></update-payout-batch-status-button>
                </div> -->
            </div>
        </div>
        <template slot="action" slot-scope="props">
            <process-payout-button :uuid="props.row.uuid" 
                @payout-processed="refreshTable()"
                v-if="props.row.is_processed == false"></process-payout-button>

            <update-payout-batch-status-button v-if="props.row.payout_batch_status && props.row.payout_batch_status !== 'SUCCESS'" 
                :uuid="props.row.uuid"></update-payout-batch-status-button>
        </template>
    </v-client-table>
</template>

<script>
    
    import Form from 'vform'
    import ProcessPayoutButton from './_process_payout_button'
    import UpdatePayoutBatchStatusButton from './_update_payout_batch_status_button'

    export default {
        name: 'PageUserDashboardPurchases',
        components:{
            ProcessPayoutButton,
            UpdatePayoutBatchStatusButton
        },

        props:['tableData'],

        data() {
            return {
                columns: ['period.start_string', 'user.full_name', 'user.email', 'net_earnings', 'expected_payout_date', 'processed_at', 'is_processed', 'payout_batch_status', 'action'],
                
                options: {
                    perPage: 25,
                    perPageValues:[25,50,100],
                    childRow: true,
                    highlightMatches: true,
                    filterable: ['user.full_name', 'email', 'is_processed'],
                    headings: {
                        'period.start_string': this.trans('strings.period'),
                        'user.full_name': this.trans('strings.user'),
                        'user.email': this.trans('strings.email'),
                        'is_processed': this.trans('strings.status'),
                        'net_earnings': this.trans('strings.amount'),
                        'expected_payout_date': this.trans('strings.payout_date'),
                        'processed_at': this.trans('strings.date_processed'),
                        'payout_batch_status': this.trans('strings.payout_gateway_status'),
                        //'comment': this.trans('strings.comment'),
                        'action': ''
                    },
                    filterByColumn:false,
                    sendEmptyFilters: false,
                    pagination: { 
                        chunk:2, 
                        dropdown: false,
                        edge: false
                    },
                    sortable:['expected_payout_date', 'status'],
                    columnsDropdown: false,
                    texts:{
                        filter: "",
                        limit: ""
                    },
                    templates: {
                        expected_payout_date(h, row) {
                          return moment(row.expected_payout_date).format('DD-MM-YYYY');
                        },
                        net_earnings(h, row) {
                          return '$'+row.net_earnings;
                        },
                        is_processed(h, row){
                            return row.is_processed==1 ? this.trans('strings.processed') : this.trans('strings.pending')
                        }
                    }
                }
            }    
        },
        
        watch:{
            tableData(val){

            }
        }
    }
    
</script>
