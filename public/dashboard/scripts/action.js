function getHref(e){
    return e.getAttribute("data-href");
  }
  function bindHref(e,el){
      if(el.hasAttribute("action")){
        el.removeAttribute("action");
      }
      el.setAttribute("action",getHref(e));
      if(e.textContent.trim()=="Edit"){
          let tableContent=e.parentElement.parentElement.parentElement.parentElement.children;
          let colums=tableContent[0].children[0].children;
          let columsTitle=[];
          for(let i=0 ;i<colums.length-1;i++){
            columsTitle.push(colums[i].childNodes[0].textContent);
          }
          let rows=tableContent[1].children[0].children;
          let rowsData=[];
          for(let i=0;i<rows.length-1;i++){
           rowsData.push(rows[i].textContent);
          }
          for(let i=0;i<el.children.length-1;i++){
            el.children[i].lastElementChild.value=rowsData[i];
          }
          
      }
  }
  