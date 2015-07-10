$(function() {
    // Initialize the Kendo DatePicker by calling the kendoDatePicker jQuery plugin
    $("#datepicker").kendoDatePicker();
    $("#animal").kendoAutoComplete({ dataSource: [ "Ant", "Antilope", "Badger", "Beaver", "Bird" ] });
    $("button").kendoButton();
    $("#grid").kendoGrid({
        height: 200,
        columns:[
            {
                field: "FirstName",
                title: "First Name"
            },
            {
                field: "LastName",
                title: "Last Name"
            }
        ],
        dataSource: {
            data: [
                {
                    FirstName: "John",
                    LastName: "Doe"
                },
                {
                    FirstName: "Jane",
                    LastName: "Doe"
                }
            ]
        }
    });
});