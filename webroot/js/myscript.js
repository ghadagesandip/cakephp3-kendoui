$(function() {
    $(".btn").kendoButton();

        $("#toolbar").kendoToolBar({
            items: [
                { type: "button", text: "Cakephp3-Kendoui" },
                { type: "separator" },
                { type: "button", text: "Users", togglable: true,  attributes:{"href":"users"}},
                { type: "separator" },
                { type: "button", text: "Tags", togglable: true,  attributes:{"href":"tags"}},
                { type: "separator" },
                { type: "button", text: "Bookmarks", togglable: true,  attributes:{"href":"bookmarks"}},
            ]
        });

        $("#dropdown").kendoDropDownList({
            optionLabel: "Paragraph",
            dataTextField: "text",
            dataValueField: "value",
            dataSource: [
                { text: "Heading 1", value: 1 },
                { text: "Heading 2", value: 2 },
                { text: "Heading 3", value: 3 },
                { text: "Title", value: 4 },
                { text: "Subtitle", value: 5 }
            ]
        });


    $("#user-grid").kendoGrid({
        dataSource: {
            type: "odata",
            transport: {
                read: "http://demos.telerik.com/kendo-ui/service/Northwind.svc/Orders"
            },
            schema: {
                model: {
                    fields: {
                        OrderID: { type: "number" },
                        Freight: { type: "number" },
                        ShipName: { type: "string" },
                        OrderDate: { type: "date" },
                        ShipCity: { type: "string" }
                    }
                }
            },
            pageSize: 20,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },
        height: 550,
        filterable: true,
        sortable: true,
        pageable: true,
        columns: [{
            field:"OrderID",
            filterable: false
        },
            "Freight",
            {
                field: "OrderDate",
                title: "Order Date",
                format: "{0:MM/dd/yyyy}"
            }, {
                field: "ShipName",
                title: "Ship Name"
            }, {
                field: "ShipCity",
                title: "Ship City"
            }
        ]
    });
});
