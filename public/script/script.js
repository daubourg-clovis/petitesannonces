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
// console.log(e.target);
 element = e.target;
 cat = this.querySelector('.category')
 if(element != cat && element != sidebar){
     sidebar.classList.remove('sidebar-toggle');
 }

});

window.addEventListener('scroll', function(){
    sidebar.classList.remove('sidebar-toggle');
})




//Scrit to filter offers from w3School

filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("filterDiv");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    w3RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
  }
}

// Show filtered elements
function w3AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide elements that are not selected
function w3RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}