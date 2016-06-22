(function () {
    angular
        .module("FoodApp")
        .controller("MenuController", MenuController);

    function MenuController($routeParams, Service) {

        var vm = this;
        vm.hello="do you see me";
        vm.order_id = $routeParams.order_id;

        vm.addFoodToOrder = addFoodToOrder;
        function init() {
            Service
                .getAllfoodType()
                .then(function(response) {
                   vm.types = response.data;
                    console.log(response.data);
                })
                .then(function(){
                     Service
                         .getfoodByTypeId(vm.types[0].type_id)
                         .then(function(response) {
                             //console.log(vm.types);
                             vm.types[0].foods = response.data;
                             //console.log(vm.types[0]);
                         });
                    Service
                        .getfoodByTypeId(vm.types[1].type_id)
                        .then(function(response) {
                            //console.log(vm.types);
                            vm.types[1].foods = response.data;
                           // console.log(vm.types[1]);
                        });
                    Service
                        .getfoodByTypeId(vm.types[2].type_id)
                        .then(function(response) {
                            //console.log(vm.types);
                            vm.types[2].foods = response.data;
                           // console.log(vm.types[2]);
                        });
                    Service
                        .getfoodByTypeId(vm.types[3].type_id)
                        .then(function(response) {
                            //console.log(vm.types);
                            vm.types[3].foods = response.data;
                           // console.log(vm.types[3]);
                        });
                });


        }
        init();
        function addFoodToOrder(dish_id) {
            vm.success = null;
            Service
                .addFoodToOrder(dish_id, vm.order_id)
                .then(function (response) {
                    //location.reload();
                    vm.success = "Order placed";
                    //console.log(response.data);
                });
        }
    }
})();