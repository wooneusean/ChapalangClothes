function displayprofile(event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);
}

function displayproduct(event, id) {
    console.log(id);
    var image = document.getElementById(id.toString());
    image.src = URL.createObjectURL(event.target.files[0]);
}

function validateForm(){
    var shopname = document.forms["vendorprof"]["shopname"].value;
    var vendadd = document.forms["vendorprof"]["vendadd"].value;
    
    var x=document.vendorprof.vendem.value;  
    var atposition=x.indexOf("@");  
    var dotposition=x.lastIndexOf(".");  

    var firstpassword=document.vendorprof.pass.value;  
    var secondpassword=document.vendorprof.confpass.value;  
    
    if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length){  
        alert("Please make sure your Email has @(At) and .(Period)");  
        return false;  
    }  
   
    if(shopname.length<=3){
        alert("Please make sure your Shopname has more than 3 characters"); 
        return false;
    }        
    
    if(vendadd.length<=20){
        alert("Please make sure your Address has more than 20 characters"); 
        return false;
    }
    
    if(firstpassword==secondpassword){  
        return true;  
    } else{  
        alert("Password does not match!");  
        return false;  
    }
}

function validateProduct(){
    var prodname = document.forms["vendoraddprod"]["prodname"].value;
    var proddesc = document.forms["vendoraddprod"]["proddesc"].value;
    var prodtag = document.forms["vendoraddprod"]["prodtag"].value;

    if(prodname.length<3){
        alert("Please make sure your Product Name has about 3 characters"); 
        return false;
    }  
    
    if(proddesc.length<=30){
        alert("Please provide sufficient details for Product Description (30 characters)"); 
        return false;
    }

    if(prodtag.length<3){
        alert("Please make sure your Product Tag has about 3 characters"); 
        return false;
    }   
}

