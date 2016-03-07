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
                { type: "button", text: "Logout", togglable: true,  attributes:{"href":"logout"}}
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



});
