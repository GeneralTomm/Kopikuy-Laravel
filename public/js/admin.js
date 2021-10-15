function page(url,method,token,formData){
    var metode;
    if(method == undefined){
        metode = 'GET';
    }
    else{
        metode = method;
    }
    if(metode !='GET'){
        if(formData == undefined){
            var xml = new XMLHttpRequest();
            xml.open(metode,url,true);
            xml.setRequestHeader('X-CSRF-TOKEN','{{csrf_token()}}');
            xml.onreadystatechange = function(){
                if(xml.readyState == 4 &&xml.status ==200){
                    document.getElementById('data').innerHTML = xml.responseText;
                }
            }
            xml.send();
        }else{
            var xml = new XMLHttpRequest();
             xml.open(metode,url,true);
             xml.setRequestHeader('X-CSRF-TOKEN',token);
             xml.onreadystatechange = function(){
                 if(xml.readyState == 4 &&xml.status ==200){
                     document.getElementById('data').innerHTML = xml.responseText;
                 }
             }
             xml.send(formData);
        }
    }else{
        var xml = new XMLHttpRequest();
        xml.open(metode,url,true);
        xml.onreadystatechange = function(){
            if(xml.readyState == 4 &&xml.status ==200){
                document.getElementById('data').innerHTML = xml.responseText;
            }
        }
        xml.send();
    }
}
function product(){
  page('/ajax/product/index');
}
function edit(halaman,id){
    if(halaman == 'product'){
        page('/ajax/product/edit/'+id);
    }
}
function add(halaman){
    if(halaman == 'product'){
        page('/ajax/product/add');
    }
}