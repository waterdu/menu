(function () {
    angular
        .module("FoodApp")
        .controller("SingleTableController", SingleTableController);

    function SingleTableController($routeParams,Service,$location) {

        var vm = this;
        vm.hello="do you see me";
        vm.table_id=$routeParams.table_id;
        vm.addCustomerByTableid=addCustomerByTableid;
        vm.deleteCustomerByCustomerId=deleteCustomerByCustomerId;
        vm.newOrder=newOrder;
        vm.getBillByTableId = getBillByTableId;


        function init() {
            Service
                .getCustomerByTableId(vm.table_id)
                .then(function(response) {
                    vm.customers = response.data;
                   //  console.log(response.data);
                });
            // vm.tables=tables;
        }
        init();
        function addCustomerByTableid(){
            Service
                .addCustomerByTableid(vm.table_id)
                .then(function(response) {
                    location.reload();
                    //vm.customers = response.data;
                    //console.log(response.data);
                });
        }
        function deleteCustomerByCustomerId(customer_id){
            console.log(customer_id);
            Service
                .deleteCustomerByCustomerId(customer_id)
                .then(function(response) {
                    location.reload();
                });
        }
        function newOrder(customer_id){
            Service
                .newOrder(customer_id)
                .then(function(response) {
                    $location.url("customer-order/"+customer_id);
                    //location.reload();
                });
        }

        function getBillByTableId(table_id) {
            vm.bill = null;
            Service
                .getBillByTableId(table_id)
                .then(function (response) {
                    console.log(response.data[0].total);
                    vm.bill = response.data[0].total;
                });
        }



    }
})();