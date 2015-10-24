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

    var userDataSource = new kendo.data.DataSource({
        transport:{
            read :{
                url : "\/cakephp3-kendoui/api/users.json",
                dataType: "json",
                type: "GET"
            },
            create: {
                url:  "\/cakephp3-kendoui/api/users.json",
                type: "POST"
            },
            update: {
                url: function(data){
                    return "\/cakephp3-kendoui/api/users/"+data.id+".json"
                },
                type: "PUT"
            },
            destroy: {
                url: function(data){
                    return "\/cakephp3-kendoui/api/users/"+data.id+".json"
                },
                type: "DELETE"
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
                return response.Users.children;
            },
            error: function(e) {
                console.log(e.errors); // displays "Invalid query"
            },
            total: function(response) {
                return response.Users.paging.Users.count;
            }
        },
        batch: true,
        page:1,
        pageSize: 1,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true
    });


    $("#user-grid").kendoGrid({
        dataSource: userDataSource,
        height: 550,
        pageable:  {
            refresh: true,
            pageSizes: 10
        },
        filterable: true,
        sortable: true,

        toolbar: ["create"],
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
                    text:"View"
                }
            ]
            }

        ]
    });

});
