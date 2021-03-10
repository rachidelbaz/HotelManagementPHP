
//====================================package selector========================================
const packageSelector=document.getElementById("packageSelector");
function getPackage(id,url) {
    if (id=="") {
      alert("error: get a valid selection");
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //format data to json
          let data=JSON.parse(this.responseText);
           //clearing target
           packageSelector.innerHTML="";
             //create option for each element 
            data.forEach(element => {
             let option=createOption(element['ID'],element['NAME']);
              //appinding
              packageSelector.appendChild(option);
          });
        }
      };
      xmlhttp.open("GET",url+id,true);
      xmlhttp.send();
    }
  }
//================================accommodation selector=====================================
const accoSelector= document.getElementById("accoSelector");
function getAcco(id,url){
if(id==""){
    alert("non value is selected");
  return;
}else{
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=()=>{
     if(xmlhttp.readyState==4 && xmlhttp.status==200){

        let data =JSON.parse(xmlhttp.responseText);
        console.log(data);
       accoSelector.innerHTML="";
       data.forEach(element=>{
        let option=createOption(element['ID'],element['NAME']);
        accoSelector.appendChild(option);
       });
     }
    };
    xmlhttp.open("GET",url+id,true);
    xmlhttp.send();
}
}
  //=================================create option====================
  function createOption(value,text){
    let option =document.createElement("OPTION");
    option.value=value;
    option.textContent=text;
   return option;
  }

