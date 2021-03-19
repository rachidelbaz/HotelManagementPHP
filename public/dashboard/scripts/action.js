
  function getHref(e){
    return e.getAttribute("data-href");
  }
  //e=>button/el=>form
  function bindHref(e,el){
      if(el.hasAttribute("action")){
        el.removeAttribute("action");
      }
      el.setAttribute("action",getHref(e));
      //clear the input form fields 
      if(e.textContent.trim()=="Create"){
       showAction("Create");
        for(let i=0;i<el.children.length-1;i++){
          el.children[i].lastElementChild.value="";
        }
      }
      if(e.textContent.trim()=="Edit"){
       showAction("Edit");
        //get current row
          let tr=e.parentElement.parentElement;
          let tdData=[];
          for(let i=0;i<tr.children.length-1;i++){
             tdData.push(tr.children[i].textContent);
          }
    console.log(tdData);
          //send data to the form 
          for(let i=0;i<tr.children.length-1;i++){
            el.children[i].lastElementChild.value=tdData[i];
          }
      }
  }
  function showAction(action){
    const ModalTitle =document.getElementById("ModalTitle");
   if(action=="Create"){
    ModalTitle.children[1].removeAttribute("hidden");
    ModalTitle.children[0].setAttribute("hidden","hidden");
   }
   if(action=="Edit"){
    ModalTitle.children[1].setAttribute("hidden","hidden");
     ModalTitle.children[0].removeAttribute("hidden");
   }
  }
//============================getdata for booking===============================================


//=============================================================================================
