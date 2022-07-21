window.onload = function() {
    let inputValue = prompt('DOM Name');
    if (inputValue.length == 0){
        alert("nie moze byc pusty");
    } else {
        let elements = document.querySelectorAll(inputValue);

        elements.forEach(function(element){
           console.log(element.outerText);
        }); 
    }
   };