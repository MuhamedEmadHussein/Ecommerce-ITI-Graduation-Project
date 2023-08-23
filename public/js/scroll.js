btn = document.getElementById('btn');

onscroll = function(){
    if(this.scrollY >= 400){
        btn.style.display = 'block';
    }else{
        btn.style.display = 'none';

    }
};
btn.onclick = function(){
    // scroll(0,0);
    scroll({
        left:0,
        top:0,
        behavior:"smooth"
    });
}