const toggle = document.querySelector('.toggle');
const cross = document.querySelector('.close');
const sidebar = document.querySelector('.sidebar');

toggle.addEventListener('click', function(e){
    e.preventDefault(e);
    sidebar.classList.add('sidebar-toggle');
    
});

cross.addEventListener('click', function(e){
    e.preventDefault();
    console.log('click');
    sidebar.classList.remove('sidebar-toggle');
    
});

// window.addEventListener('click', function(event){
//     if(event.target != sidebar){
//         sidebar.classList.remove('sidebar-toggle');
//     }
// })

document.addEventListener('click' ,function(e){
 console.log(e.target);
 element = e.target;
 cat = this.querySelector('.category')
 if(element != cat && element != sidebar){
     sidebar.classList.remove('sidebar-toggle');
 }
// console.log(toggle);
})