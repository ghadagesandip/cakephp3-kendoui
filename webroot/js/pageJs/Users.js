
var ds_MaleFemale = new kendo.data.DataSource({
    transport: {
        read: {
            url: config.baseUrl+"users.json",
            type: "get",
            dataType: "json",
            async: false,
            data: {
                type: "dropdownList"
            }
        }
    }
})
ds_MaleFemale.read();
function ed_MaleFemale(container, options) {
    $('<input name="' + options.field + '"/>').appendTo(container).kendoDropDownList({
        autoBind: false,
        optionLabel: {
            text:"Please choose",
            value:"0"
        },
        dataSource: ds_MaleFemale,
        dataTextField: "text",
        dataValueField: "value"
    });
}

var userDataSource = new kendo.data.DataSource({
    requestEnd: function(e) {
        var response = e.response;
        var type = e.type;
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
            url : config.baseUrl+"users.json",
            type: "get",
            dataType: "json",
            data: {
            }
        },
        create: {
            url:   config.baseUrl+"users.json",
            type: "post",
            dataType: "json",
            data: {
            }
        },
        update: {
            url: function(data){
                return  config.baseUrl+"users/"+data.models[0].id+".json"
            },
            type: "PUT",
            dataType: "json",
            data: {
            }
        },
        destroy: {
            url: function(data){
                return  config.baseUrl+"users/"+data.models[0].id+".json"
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
        {field: "gender", title: "Gender","values": ds_MaleFemale.data().toJSON(),"editor":ed_MaleFemale },
        {field: "email", title: "Email"},
        {field: "password", title: "Password"},
        {field: "confirm_password", title: "Confirm Password"},
        {command: [
            { name: "edit", text: { edit: "", cancel: "Cancel", update: "Update" } },
            { name: "destroy", text: "" },
        ]
        }

    ]
});