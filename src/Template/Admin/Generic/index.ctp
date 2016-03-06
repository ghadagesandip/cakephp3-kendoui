<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <h2 class="col-lg-3"><?= $cName ?></h2>
            <div  class="col-lg-9" id="messages"></div>
        </div>
        <div id="<?= $cName; ?>-grid"></div>
    </div>
</div>

<?php $this->Html->scriptStart(['block' => 'scriptBottom']); ?>

    var <?= $cName;?>DataSource = new kendo.data.DataSource({
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
                $("#<?= $cName;?>-grid").data("kendoGrid").dataSource.read();
            }
        },
        transport:{
            read :{
                url : "\/api/admin/<?= $cName;?>.json",
                type: "get",
                dataType: "json",
                data: {
                }
            },
            create: {
                url:  "\/api/admin/<?= $cName;?>.json",
                type: "post",
                dataType: "json",
                data: {
                }
            },
            update: {
                url: function(data){
                    return "\/api/admin/<?= $cName;?>/"+data.models[0].id+".json"
                },
                type: "PUT",
                dataType: "json",
                data: {
                }
            },
            destroy: {
                url: function(data){
                    return "\/api/admin/<?= $cName;?>/"+data.models[0].id+".json"
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
            model:<?= $kendoModelArray ?>,
            data : function(response){
                if(response.<?= $cName;?> != null){
                    return response.<?= $cName;?>.children;
                }
            },
            error: function(e) {
                console.log(e.errors); // displays "Invalid query"
            },
            total: function(response) {
                return response.<?= $cName;?>.paging.<?= $cName;?>.count;
            }
        },
        batch: true,
        page:1,
        pageSize:10,
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true
    });



    $("#<?= $cName;?>-grid").kendoGrid({

        dataSource:<?= $cName;?>DataSource,
        height: 550,
        pageable:  {
            refresh: true,
            pageSizes: [5,10,20, 40, 60],
            buttonCount: 10,
            input: true
        },
        filterable: true,
        reorderable: true,
        sortable: true,
        columnMenu: true,
        toolbar: ["create"],
        editable: {
            mode: "popup",
            confirmation: true,
            confirmDelete: "Yes"
        },
        columns: <?php echo $kendoGridCols;?>
    });

<?php $this->Html->scriptEnd(); ?>