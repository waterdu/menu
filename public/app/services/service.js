(function () {
    angular
        .module("FoodApp")
        .factory("Service", Service);


    var tables =    [
        {id: "123", customer: "alice",    size: "2",    firstName: "Alice",  lastName: "Wonder"  },
        {id: "234", customer: "bob",      size: "3",      firstName: "Bob",    lastName: "Marley"  },
        {id: "345", customer: "charly",   size: "4",   firstName: "Charly", lastName: "Garcia"  },
        {id: "456", customer: "jannunzi", size: "5", firstName: "Jose",   lastName: "Annunzi" }
    ];

    function Service($http) {
        var api = {
            getAlltable: getAlltable,
            getCustomerByTableId: getCustomerByTableId,
            getOrderbyCustomerId: getOrderbyCustomerId,
            getAllfoodType: getAllfoodType,
            getfoodByTypeId: getfoodByTypeId,
            addCustomerByTableid: addCustomerByTableid
        };
        return api;
        function addCustomerByTableid(table_id){
            var url = "/api/addCustomerByTableid/" + table_id;
            return $http.get(url);
        }
        function getAlltable() {
            //console.log("am I called?");
            var url = "/api/getAllTable/";
            return $http.get(url);
            //return tables;
        }

        function getCustomerByTableId(table_id) {
            var url = "/api/getCustomerByTableId/" + table_id;
            return $http.get(url);
        }

        function getOrderbyCustomerId(customer_id) {
            var url = "api/getOrderbyCustomerId/" + customer_id;
            return $http.get(url);
        }

        function getAllfoodType() {
            var url = "api/getAllfoodType/";
            return $http.get(url);
        }

        function getfoodByTypeId(id) {
            var url = "api/getfoodByTypeId/" + id;
            return $http.get(url);
        }

    }
})();