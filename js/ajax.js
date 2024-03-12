var page = 1;
$(function(){
    getBooks();
});
$('#show').click(function(){
    page++;
    getBook(page);});

function getBooks(page=1){
    $('#show').text("Loading...");
    $.ajax({
        type:"GET",
        url:"./data.php?page="+page,
        dataType:"json",
        success:function(books){
            if(books.length<2){
                $('#show').text("Load more");
            }
        }
    });
}

var total=0;
function viewBooks_1(data){
    $.each(data,function(key,value){
        drawRow(value);//trả về 1 dòng
        total++;
    });
    // nếu <2 quyển thì in foot
    if(data.length<2){
        drawFoot(total);
    }
}

function drawRow(rowData){
    var row=$("<tr />")
    $("#tblBooks").append(row);
    row.append('<th colspan="2">Totals:</th>');
    row.append('<th colspan="3">${total}</th>');


}