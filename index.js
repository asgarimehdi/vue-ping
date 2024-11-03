//Vue.config.debug = true;
//Vue.config.devtools = true;
// import axios from "axios";
new Vue({
    el: '#app',
    components: {
        VueBootstrapTable: VueBootstrapTable
    },
    data: {
        logging: [],
        online: true,
        showFilter: true,
        showPicker: false,
        showSelect: false,
        paginated: false,
        multiColumnSortable: true,
        ajax: {
            enabled: false,
            url: "http://localhost:9430/data/test",
            method: "POST",
            delegate: true,
        },
        columns: [
            {
                title:"id",
                visible: false,
                editable: false,
            },
            {
                title:"ip",
                name: "ip",
                visible: true,
                editable: false,
            },
            {
                title:"operator",
                name: "operator_name",
                visible: true,
                editable: false,
            },
            {
                title:"pc_name",
                name: "pc_name",
                visible: true,
                editable: false,
            },
            {
                title:"device",
                name: "device_type",
                visible: true,
                editable: false,
            },
            {
                title:"location",
                name: "location",
                visible: true,
                editable: false,
            },
            {
                title:"unit",
                name: "unit",
                visible: true,
                editable: false,
            },
            {
                title:"kasper",
                name: "kasper",
                visible: false,
                editable: false,
            },
            
        ],
        values: [
            {                
            },
            
        ]
    },
    created: function () {
        
        setInterval(this.loadData, 10000);       
        
        
    },
    methods: {
        // addItem: function() {
        //     var self = this;
        //     var item = {
        //         "id" : this.values.length + 1,
        //         "name": "name " + (this.values.length+1),
        //         "country": "Portugal",
        //         "age": 26,
        //     };
        //     this.values.push(item);
        // },
        toggleFilter: function() {
           
            this.showFilter = !this.showFilter;
        },
        togglePicker: function() {
            this.showPicker = !this.showPicker;
        },
        togglePagination: function () {
            this.paginated = !this.paginated;
        },
        toggleSelect: function () {
            this.showSelect = !this.showSelect;
        },
        toggleOnline: function () {
            this.online = !this.online;
            this.loadData();
        },
        loadData() {
            axios.get("api.php?online="+this.online).then(({data}) => (this.values = data)).then(() => {
            }).catch(() => {
                
            });
            
         },
    },
    
    mounted:function(){
        this.loadData();
    },
});
