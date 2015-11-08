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
        requestEnd: function(e) {
            var response = e.response;
            var type = e.type;
            console.log(response);
            if(type == "create" || type == "update") {
                if(response.success == false) {

                } else {
                    if(response.message == true) {
                        $("#messages").html("<h3 class=\"text-success\">"+response.message+"</h3>");
                    } else {
                        $("#messages").html("<h3 class=\"text-danger\">"+response.message+"</h3>");
                    }
                }
                $("#user-grid").data("kendoGrid").dataSource.read();
            }
        },
        transport:{
            read :{
                url : "\/api/users.json",
                type: "get",
                dataType: "json",
                data: {
                }
            },
            create: {
                url:  "\/api/users.json",
                type: "post",
                dataType: "json",
                data: {
                }
            },
            update: {
                url: function(data){
                    return "\/api/users/"+data.id+".json"
                },
                type: "put",
                dataType: "json",
                data: {
                }
            },
            destroy: {
                url: function(data){
                    return "\/api/users/"+data.id+".json"
                },
                type: "DELETE"
            },
            parameterMap: function(data, operation) {
                if (operation == "read") {
                    return {
                        take: data.take,
                        page: data.page,
                        skip: data.skip,
                        limit: data.pageSize,
                        cOrder: data.sort,
                        cFilter: data.filter
                    }
                }
                if (operation !== "read" && data.models) {
                    return {action: operation, models: kendo.stringify(data.models)};
                }
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
                    email: { type: "string" },
                    password: { type: "string" },
                    confirm_password: { type: "string" }
                }
            },
            data : function(response){
                if(response.Users.children != null){
                    return response.Users.children;
                }
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
        pageSize: 3,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true
    });

    $("#user-grid").kendoGrid({

        dataSource: userDataSource,
        height: 550,
        pageable:  {
            refresh: true,
            pageSizes: [5,10,20,50,100],
            buttonCount: 10
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
            {field: "password", title: "Password"},
            {field: "confirm_password", title: "Confirm Password"},
            {command: [
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
