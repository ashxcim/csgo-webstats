M.AutoInit();
$(document).ajaxStart(function () {
    $("#loading").show("slow");
}).ajaxStop(function () {
    $("#loading").hide("slow");
});
var table = new Tabulator("#tab", {
    layout:"fitColumns",
    placeholder:"<span style='color: var(--ipsLight);margin-top: -10px; margin-bottom: 10px;'>Vă rugăm așteptați...</span>",
    pagination:"local",
    paginationSize:10,
    paginationButtonCount:7,
    paginationSizeSelector:[10, 15, 30, 60, 120, 1000],
    paginationAddRow:"page",
    resizableColumns:false,
    columns:[
        {title:"Name", field:"user", sorter:"string", align:"left", widthGrow:1.7},
        {title:"Last Online", field:"seen", sorter:"string", align:"center"},
        {title:"Counter", field:"ct", sorter:"string", align:"center", widthGrow:1.1},
        {title:"Tero", field:"tt", sorter:"string", align:"center", widthGrow:1.1},
        {title:"Spec", field:"spe", sorter:"string", align:"center", widthGrow:1.1},
        {title:"Total", field:"total", sorter:"string", align:"center", formatter:"html", widthGrow:1.1},
        {title:"Steam", field:"steam", align:"center", formatter:"html", widthGrow:0.4, headerSort:false}
    ],
});

$("#search").keyup(_.debounce(function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        type:'post',
        url:'controller.php',
        data:formData,
        success:function(result) {
            table.setData(result);
            $('.tooltipped').tooltip();
        }
    });
}, 500));


setTimeout(function () {
    table.setData("controller.php?action=init");
    $('.tooltipped').tooltip();
}, 1000);