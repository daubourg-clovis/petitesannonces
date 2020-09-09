var modal = document.getElementById('staticBackdrop');
var deleteBtn = document.getElementById('deleteBtn');

modal.addEventListener('shown.bs.modal', function(event) {
  deleteBtn.focus();

});

deleteBtn.addEventListener('click', function(){
    window.location.href = 'supprimer/';
});