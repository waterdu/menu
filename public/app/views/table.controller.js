(function () {
    angular
        .module("FoodApp")
        .controller("TableController", TableController);

    function TableController($location,Service) {
        var tables =    [
            {id: "123", customer: "alice",    size: "2",    firstName: "Alice",  lastName: "Wonder"  },
            {id: "234", customer: "bob",      size: "3",      firstName: "Bob",    lastName: "Marley"  },
            {id: "345", customer: "charly",   size: "4",   firstName: "Charly", lastName: "Garcia"  },
            {id: "456", customer: "jannunzi", size: "5", firstName: "Jose",   lastName: "Annunzi" }
        ];


        var vm = this;
        vm.hello="do you see me";

        function init() {
            Service
                .getAlltable()
                .then(function(response) {
                    vm.tables = response.data;
                });
        }
        init();
    }
})();