function checkNum(item, item2, item3, correct_class, acorrect_class) {
    if (document.getElementById(item).value > 0 ) {
        document.getElementById(item2).innerHTML = 'правильно';
        document.getElementById(item2).className = correct_class;
        document.getElementById(item3).value = 1;
    } else {
        document.getElementById(item2).innerHTML = 'число від 1 до 99';
        document.getElementById(item2).className = acorrect_class;
        document.getElementById(item3).value = 'no';
    }
    checkAllFactors();   
}

function fieldName(item, msg, flag, correct_class, acorrect_class) {
    if (document.getElementById(item).value.length >= 1) {
        document.getElementById(msg).innerHTML = 'правильно';
        document.getElementById(msg).className = correct_class;
        document.getElementById(flag).value = 1;
    } else {          
        document.getElementById(msg).innerHTML = 'поле не повинне бути порожнє';
        document.getElementById(msg).className = acorrect_class;
        document.getElementById(flag).value = 'no';
    }
    checkAllFactors();
}

function radioCheck(item, item2, item3, className){
    var list = document.getElementsByName(item);
    if ( !((list[0].checked == false ) && (list[1].checked == false )) ){
        document.getElementById(item2).innerHTML = 'правильно';
        document.getElementById(item2).className = className;
        document.getElementById(item3).value = 1;
    } else {
        document.getElementById(item3).value = 'no';
    }
    checkAllFactors();
}

function selectBoxCheck(item, msg, flag, correct_class, acorrect_class){
    if (document.getElementById(item).selectedIndex > 0){
        document.getElementById(msg).innerHTML = 'правильно';
        document.getElementById(msg).className = correct_class;
        document.getElementById(flag).value = 1;
    } else {
        document.getElementById(msg).innerHTML = 'оберіть один із варіантів';
        document.getElementById(msg).className = acorrect_class;
        document.getElementById(flag).value = 'no';
    }
    checkAllFactors();
}


function checkAllFactors(){
    list = document.getElementsByTagName("*");
    var flag = 0;
    for (i=0;i<list.length;i++){
        if(list[i].value == 'no'){
            flag = 1;
        }   
    }
    if (flag == 1){
        document.getElementById('submit_id').disabled = true;
        document.getElementById('submit_id').className = 'sub_button';
    } else {
        document.getElementById('submit_id').disabled = false;
        document.getElementById('submit_id').className = 'sub_button_green';
    }
}

function currentPage(){    
    var host = document.location.hostname;
    var reg = 'http://'+host+'/';
    var url = document.URL;
  
    var res = url.replace(reg, '');
    if (!res == ''){
        
        if (res == 'solution.php' || res == 'num_factors.php' || res == 'factors.php' || res == 'res.php'){
            document.getElementById('solution.php').className = "current";
        }
        if (!document.getElementById(res)){
            document.getElementById('solution.php').className = "current";
        } else {
        document.getElementById(res).className = "current";
        }
    }
    else {
        document.getElementById('index.php').className = "current";
    }
}



function HandleBrowseClick(){
    list = document.getElementsByName('wayOfSolutionRadio');
    if (list[1].checked) {       
        var fileinput = document.getElementById("browse");
        fileinput.click();
        var textinput = document.getElementById("filename");
        if (fileinput.value) {
            document.getElementById('ok_img').src = "/img/ok.png";
            document.getElementById('submit_id').disabled = false;
            document.getElementById('submit_id').className = 'sub_button_green';
        } else {
            document.getElementById('ok_img').src = "/img/not_ok.png";
            document.getElementById('submit_id').disabled = true;
            document.getElementById('submit_id').className = 'sub_button';
        }
    }
}

function changeIcon() {
    var list = document.getElementsByName('wayOfSolutionRadio');
    if (list[1].checked) {  
        document.getElementById('fakeBrowse').src = "/img/choose.png";
        document.getElementById('submit_id').disabled = true;
        document.getElementById('submit_id').className = 'sub_button';
    } else {
        document.getElementById('fakeBrowse').src = "/img/choose_grey.png";
        document.getElementById('submit_id').disabled = false;
        document.getElementById('submit_id').className = 'sub_button_green';
        
    }
}


function wayOfSolutionF(radio, form){
    var list = document.getElementsByName(radio);
    if (list[0].checked == true){
        document.getElementById(form).action = 'solution.php';       
    } else {
        document.getElementById(form).action = 'res.php';
    }
}

function radioExtension(){
    var list = document.getElementsByName('extension');
    var ref = document.getElementById('saveButton');
    if (list[0].checked == true){        
        document.getElementById('saveButton').onclick = ref.onclick + 'xls';       
    } else {
        document.getElementById('saveButton').onclick = ref.onclick + 'xlsx'; 
    }
}



