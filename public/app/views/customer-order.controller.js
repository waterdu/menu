(function () {
    angular
        .module("FoodApp")
        .controller("OrderController", OrderController);

    function OrderController($routeParams,Service) {

        var vm = this;

        vm.customer_id=$routeParams.customer_id;
        vm.hello="do you see me";
        //vm.orders=[{id:1,bill:'100$'},{id:2,bill:"200$"}]

        function init() {
            Service
                .getOrderbyCustomerId(vm.customer_id)
                .then(function(response) {
                    //vm.tables = response.data
                    console.log(response.data);
                });



            // vm.tables=tables;
        }
        init();
    }
})();