const formDelete=document.getElementById("formDelete");
function getHref(e){
    if(formDelete.hasAttribute("action")){
        formDelete.removeAttribute("action");
    }
    let data_href=e.getAttribute("data-href");
    formDelete.setAttribute("action",data_href);
}

