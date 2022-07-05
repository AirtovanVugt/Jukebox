var warning = document.getElementById("warning");

if(warning != null){
    warning.classList.add("warningShow");

    setTimeout(function(){
        warning.classList.remove("warningShow");
    }, 5000);
}