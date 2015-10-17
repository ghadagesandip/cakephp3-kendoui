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
                { text: "Subtitle", value: 5 },
            ]
        });

    
    $("#user-grid").kendoGrid({
        dataSource: {
            transport:{
                read :{
                    url : "http://localhost/cakephp3-kendoui/api/users.json",
                    dataType: "json"
                }
            },
            schema: {
                model: {
                    id: "id",
                    fields: {
                        id: { type: "number", editable:false },
                        first_name: { type: "string" },
                        last_name: { type: "string" },
                        gender: { type: "string" },
                        email: { type: "string" }
                    }
                },
                data : function(response){
                    return response['Users'];
                }
            },
            pageSize: 1,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
        },
        height: 550,
        filterable: true,
        sortable: true,
        pageable: true,
        editable: {
            mode: "popup"
        },
        columns: [
            {field:"id", title:"ID"},
            {field: "first_name",  title: "First Name"},
            {field: "last_name",  title: "Last Name"},
            {field: "gender", title: "Gender"},
            {field: "email", title: "Email"},
            { command: [
                { name: "edit", text: { edit: "", cancel: "Cancel", update: "Update" } },
                { name: "destroy", text: "" },
                {
                    name: "details",
                    text:"View",
                    click: function(e) {
                        // e.target is the DOM element representing the button
                        var tr = $(e.target).closest("tr"); // get the current table row (tr)
                        // get the data bound to the current table row
                        var data = this.dataItem(tr);
                        console.log("Details for: " + data.name);
                    }
                },

            ]
            }

        ]
    });

});
