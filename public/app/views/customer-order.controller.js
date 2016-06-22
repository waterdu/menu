(function () {
    angular
        .module("FoodApp")
        .controller("OrderController", OrderController);

    function OrderController($routeParams,Service) {

        var vm = this;

        vm.customer_id=$routeParams.customer_id;
        vm.removeOrderByOrderId=removeOrderByOrderId;
        //vm.orders=[{id:1,bill:'100$'},{id:2,bill:"200$"}]
        vm.getBillByCustomerId = getBillByCustomerId;

        function init() {
            Service
                .getOrderbyCustomerId(vm.customer_id)
                .then(function(response) {
                    vm.orders = response.data
                    //console.log(response.data);
                });

             //vm.tables=tables;
        }
        init();
        function removeOrderByOrderId(order_id){
            Service
                .removeOrderByOrderId(order_id)
                .then(function(response) {
                    location.reload();
                });
        }

        function getBillByCustomerId(customer_id) {
            vm.bill = null;
            Service
                .getBillByCustomerId(customer_id)
                .then(function (response) {
                    //console.log(response.data[0].total);
                    vm.bill = response.data[0].total;
                });
        }
    }
})();