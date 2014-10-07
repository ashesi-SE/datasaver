/* This is the jQuery for the Admin */
$(document).ready(function(){
    //This code checks if the person has lived in an orphanage and pops
    //up a resulting form
    $("#orphanDetails").css("display","none");    
    $("#liveWith").click(function(){
        if ($('select[name=selectHome]').val() == "orphanage" ) {
            $("#orphanDetails").slideDown("fast"); //Slide Down Effect
        } else {
            $("#orphanDetails").slideUp("fast");  //Slide Up Effect
        }
    });
   
    
    //This code does something similair but for applied before
    $("#appYear").css("display","none");
    $("#appliedBefore").click(function(){
        if ($('input[name=applied]:checked').val()=='Yes') {
            $("#appYear").slideDown("fast"); //Slide Down Effect
        } else {
            $("#appYear").slideUp("fast");  //Slide Up Effect
        }
    });
    
    //This code does something similair but for siblings
    $("#hasSibling").css("display","none");
    $("#sibling").click(function(){
        if ($('input[name=siblingQ]:checked').val()=='Yes') {
            $("#hasSibling").slideDown("fast"); //Slide Down Effect
        } else {
            $("#hasSibling").slideUp("fast");  //Slide Up Effect
        }
    });
    
    
    //Code that makes the sibling table editable
    $("table.table tr th").bind("click", headerClick);
    $("table.table tr td").bind("click", dataClick);   

    function headerClick(e) {
        console.log(e);
    }

    function dataClick(e) {
        console.log(e);
        if (e.currentTarget.innerHTML != "") return;
        if(e.currentTarget.contentEditable != null){
            $(e.currentTarget).attr("contentEditable",true);
        }
        else{
            $(e.currentTarget).append("<input type='text'>");
        }    
    }
    function saveButton(){
        $("table.table tr td").each(function(td, index){
            console.log(td);
            console.log(index);
        });
    }
    
   
});