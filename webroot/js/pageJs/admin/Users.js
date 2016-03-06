var ds_MaleFemale = [
    {
        value : false,
        text : "Female"
    },
    {
        value :true,
        text :"Male"
    }
];

function ed_MaleFemale(container, options) {
    $('<input name="' + options.field + '"/>').appendTo(container).kendoDropDownList({
        autoBind: true,

        dataSource: ds_MaleFemale,
        dataTextField: "text",
        dataValueField: "value"
    });
}





$("#grid").kendoGrid({
    columns: [
        { field: "name" },
        { field: "age"}
    ],
    sortable: true,
    dataSource: {
        data: [
            { name: "Jane Doe", age: 3 },
            { name: "John Doe", age: 40 }
        ]

    }
});