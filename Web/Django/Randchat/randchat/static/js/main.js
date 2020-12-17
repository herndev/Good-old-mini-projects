var dict = {};

function commentBox(id) {
    var data = document.getElementById(id).parentNode.parentNode.getElementsByTagName('form');
    
    var state = false;
    for(var i of Object.keys(dict)){
        if(i==id){
            state = true
        }
    }

    if(state){
        console.log(id)
        console.log(dict[id])
        if(dict[id] == 0){
            for(var i of Object.keys(dict)){
                dict[i] = 0;
                document.getElementById(i).parentNode.parentNode.getElementsByTagName('form')[0].style.display = 'none';
            }
            data[0].style.display = 'block';
            dict[id] = 1;
        }else{
            data[0].style.display = 'none';
            dict[id] = 0;
        }
    }else{
        for(var i of Object.keys(dict)){
            dict[i] = 0;
            document.getElementById(i).parentNode.parentNode.getElementsByTagName('form')[0].style.display = 'none';
        }
        data[0].style.display = 'block';
        dict[id] = 1;
    }
}

