content_var = document.getElementById("forum-content")


//////////////////////////////
//      POST VARIABLES      //
//////////////////////////////
question = "What is 1 + 1? asdasdsadadasda http://wwww.google.com sdasdsadadasd	asdasdasdasdasdasdas	retyuio	rtyuiop	tryuio	tryuiotryuio	tryuiotryuiotryui		tyuityuityuio	tyuityuityuioytui	tyuityuityuioytuityui	tyuityuityuioytuityuityui	tyuityuityuioytuityuityuityui	ytu	ityui	tyuityuityuioytuityuityuityuityui	ytu	ityuiiort	yui"
answer = "1 + 1 = 2 easy asdasdsadadasdasdasdasdasdsadadasd	asdasdasdasdasdasdas	retyuio	rtyuiop	tryuio	tryuiotryuio	tryuiotryuiotryui		tyuityuityuio	tyuityuityuioytui	tyuityuityuioytuityui	tyuityuityuioytuityuityui	tyuityuityuioytuityuityuityui	ytu	ityui	tyuityuityuioytuityuityuityuityui	ytu	ityuiiort	yui"
reply = ""
codename = "@Mobile_wizard"
myname = "@Hernie Jabien"

//////////////////////////////
//        POST PARTS        //
//////////////////////////////
l1 = "<div id='sample-box' ><h5 class='user-name'>"
l2 = "</h5><span class='user-statement'>"
l3 = "</span><div id='sample-sub-box' class='card o-hidden border-0 shadow-lg my-5'><h6 class='user-name'>"
l4 = "</h6><span class='user-statement'>"
l5 = "</span></div><span><a href='#'><i class='ion-heart'></i></a></span><span>23</span><span id='thumbs'><a href='#'><i class='ion-thumbsdown'></i></a></span><span>2</span><a href='#'><span id='thumbs' class='user-name'>Comments 4</span></a></div>"





content_var.innerHTML = l1 + myname + l2 + answer + l3 + codename + l4 + question + l5