// execute all code on loading the entire page
// store code / call function from block below
$(document).ready(function(){
    
    $("#btn").click(function(){
        $("div").toggle();
    });
    console.log("Document Loaded");
    console.error("Document Loaded");
    console.info("Document Loaded");
    console.warn("Document Loaded");
});
