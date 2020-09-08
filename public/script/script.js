//Script pour ouvrir et fermer la div de filtre par catégorie

const toggle = document.querySelector('.toggle');
const cross = document.querySelector('.close');
const sidebar = document.querySelector('.sidebar');

// Add class when click on <a> category to open the div
toggle.addEventListener('click', function(e){
    e.preventDefault(e);
    sidebar.classList.add('sidebar-toggle');
    
});

// remover class when click on cross icon of div
cross.addEventListener('click', function(e){
    e.preventDefault();
    console.log('click');
    sidebar.classList.remove('sidebar-toggle');
    
});

// remove class when click outside div or on <a> category still closes when click on <a> inside the sidebar
document.addEventListener('click' ,function(e){
 console.log(e.target);
 element = e.target;
 cat = this.querySelector('.category')
 if(element != cat && element != sidebar){
     sidebar.classList.remove('sidebar-toggle');
 }

})