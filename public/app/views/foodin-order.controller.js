(function () {
    angular
        .module("FoodApp")
        .controller("FoodInOrderController", FoodInOrderController);

    function FoodInOrderController($routeParams,$location,Service) {

        var vm = this;
        vm.hello="do you see me";
        vm.order_id=$routeParams.order_id;

        vm.types=       [
            {id: "123", typename: "appetizer",    size: "2",    firstName: "Alice",  lastName: "Wonder"  },
            {id: "234", typename: "drink",      size: "3",      firstName: "Bob",    lastName: "Marley"  },
            {id: "345", typename: "main views",   size: "4",   firstName: "Charly", lastName: "Garcia"  },
            {id: "456", typename: "Dessert", size: "5", firstName: "Jose",   lastName: "Annunzi" }
        ];
        //vm.foods=
        //    [
        //        {id: "123", foodname: "cake",    cooktime: "20min",    price: "10$",  lastName: "Wonder"  },
        //        {id: "234", foodname: "sweet cake",      cooktime: "30min",      price: "10$",    lastName: "Marley"  },
        //        {id: "345", foodname: "black cake",   cooktime: "4min",   price: "10$", lastName: "Garcia"  },
        //        {id: "456", foodname: "red cake", cooktime: "5min", price: "10$",   lastName: "Annunzi" }
        //    ];

        function init() {
            Service
                .getFoodByOrderId(vm.order_id)
                .then(function(response) {
                    vm.foods = response.data;
                    //console.log(response.data);
                });
        }
        init();

    }
})();