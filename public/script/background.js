// Script taken on codepen and slightly adapted (size and nober of dots) to create random dots on background
  
    function freshDot(){
      this.obj = document.createElement("div");
      this.obj.classList.add("box");
      this.obj.style.top = (window.innerHeight * Math.random()) + 'px';
      this.obj.style.left = (window.innerWidth * Math.random()) + 'px';
      this.size = Math.floor(60);
      this.obj.style.height =  this.size + 'px';
      this.obj.style.width = this.size + 'px';
      document.body.appendChild(this.obj);
    }
    var dot = [];
    for(var i = 0 ; i < 10 ; i++ ){
      dot.push(new freshDot());
    }

