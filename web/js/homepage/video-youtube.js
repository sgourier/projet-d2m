

$(".item-video").click( function(){
    var url = $(this).data("videourl");

    $("#player_youtube").attr("src",url);
});