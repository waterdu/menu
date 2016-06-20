(function () {
    angular
        .module("FoodApp")
        .config(Config);

    function Config($routeProvider) {
        $routeProvider
        //views route
            .when("/table", {
                templateUrl: "views/table.html",
                controller: "TableController",
                controllerAs: "model"
            })
            //click a table go to single table page
            .when("/menu", {
                templateUrl: "views/menu.html",
                controller: "MenuController",
                controllerAs: "model"
            })
            .when("/customer-order/:customer_id", {
                templateUrl: "views/customer-order.html",
                controller: "OrderController",
                controllerAs: "model"
            })
            .when("/foodin-order", {
                templateUrl: "views/foodin-order.html",
                controller: "FoodInOrderController",
                controllerAs: "model"
            })
            .when("/table/:table_id", {
                templateUrl: "views/single-table.html",
                controller: "SingleTableController",
                controllerAs: "model"
            })
            .otherwise("/table", {});
    }
})();

