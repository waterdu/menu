(function () {
    angular
        .module("FoodApp")
        .controller("SingleTableController", SingleTableController);

    function SingleTableController($routeParams,Service,$location) {

        var vm = this;
        vm.hello="do you see me";
        vm.table_id=$routeParams.table_id;
        vm.addCustomerByTableid=addCustomerByTableid;



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

    }
})();