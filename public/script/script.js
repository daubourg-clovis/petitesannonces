const toggle = document.querySelector('.toggle');
const cross = document.querySelector('.close');
console.log(toggle);
console.log('coucou');
toggle.addEventListener('click', function(e){
    e.preventDefault(e);
    const sidebar = document.querySelector('.sidebar');
    // sidebar.style['right']=0;
    sidebar.classList.toggle('sidebar-toggle');
    console.log('click');
    
});

cross.addEventListener('click', function(e){
    e.preventDefault();
    console.log('click');
    const sidebar = document.querySelector('.sidebar');
    sidebar.classList.remove('sidebar-toggle');
    
});
