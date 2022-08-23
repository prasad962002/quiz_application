var urll = document.getElementsByClassName('linkin');
for (let i = 0; i < urll.length; i++) {
    const element = urll[i].href.slice(32);
    const e = urll[i];
    console.log(element);
    if(element == window.location.href.slice(32)){        
        console.log("yes", element);
        e.classList.add("active");
    }    
}
s= "http://localhost/project1/admin/";
console.log(s.length);
console.log("Path",window.location.pathname);
console.log("Href",window.location.href);