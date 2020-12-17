from django.shortcuts import render, redirect
from django.http import HttpResponseRedirect
from django.views.decorators.csrf import csrf_exempt
from django.utils import timezone
from main.models import *

# Create your views here.
# HOME VIEW
def indexView(request):
    username = request.session['username']
    posts = Post.objects.all().order_by('-posted_at')
    states = False
    user = []

    contents = []
    title = []
    keyword = []
    posted_at = []
    state = []
    type_id = []
    poster_id = []
    post_id = []

    for post in Post.objects.all().order_by('-posted_at'):
        title.append(post.title)
        keyword.append(post.keyword)
        posted_at.append(post.posted_at)
        state.append(post.state)
        type_id.append(post.type_id)
        poster_id.append(post.poster_id)
        post_id.append(post.id)

    for i in Post.objects.all().order_by('-posted_at'):
        temp = []
        for x in i.content.splitlines():
            temp.append(x)
        contents.append(temp)

    allpost = zip(contents, title, keyword, posted_at, state, type_id, poster_id, post_id)

    if username:
        for user1 in User.objects.all():
            if username == user1.code_name:
                user = user1
                states = True
    if states:
        return render(request, 'main/index.html', {'menubox':True, 'user':user,'users':User.objects.all(), 'allpost':allpost})
    else:
        return render(request, 'main/index.html', {'menubox':True, 'users':User.objects.all(), 'allpost':allpost})



#REPLY REQUEST
@csrf_exempt
def replyRequest(request, pid, uid):
    if request.method == 'POST':
        
        content = request.POST['get_comment']
        user_id = uid
        post_id = pid

        #Getting current date
        date_now = timezone.now()
        makePost = Post.objects.create(title = 'none',keyword = 'none' ,content = content,posted_at = date_now,state = 'active',type_id = 2, poster_id = user_id)
        makeReply = Reply.objects.create(post_id = post_id, reply_id = makePost.id)

    return HttpResponseRedirect("/forum/readpost/"+str(pid))



#READPOST VIEW
@csrf_exempt
def readpostView(request, pid):
    username = request.session['username']
    states = False
    user = []
    sub = []
    listPostID = [i.post_id for i in Reply.objects.all().order_by('-id')]

    #REPLIES DATA
    contents1 = []
    title1 = []
    keyword1 = []
    posted_at1 = []
    state1 = []
    type_id1 = []
    poster_id1 = []
    post_id1 = []

    for i in Reply.objects.all().order_by('-id'):
        # print(str(i.post_id) + " " + str(i.reply_id))
        if i.post_id == pid:
            reply = Post.objects.get(id=i.reply_id)
            title1.append(reply.title)
            keyword1.append(reply.keyword)
            posted_at1.append(reply.posted_at)
            state1.append(reply.state)
            type_id1.append(reply.type_id)
            poster_id1.append(reply.poster_id)
            post_id1.append(reply.id)
            temp = []
            for x in reply.content.splitlines():
                temp.append(x)
            contents1.append(temp)
            if i.reply_id in listPostID:
                sub.append(i.post_id)
            else:
                sub.append(0)

    allpost = zip(contents1, title1, keyword1, posted_at1, state1, type_id1, poster_id1, post_id1, sub)

    #POST DATA
    contents = []

    post = Post.objects.get(id=pid)
    title = post.title
    keyword = post.keyword
    posted_at = post.posted_at
    state = post.state
    type_id = post.type_id
    poster_id = post.poster_id
    post_id = post.id

    for x in post.content.splitlines():
        contents.append(x)

    if username:
        for user1 in User.objects.all():
            if username == user1.code_name:
                user = user1
                states = True
    if states:
        return render(request, 'main/read_more.html', {'replies1':allpost ,'replies':allpost ,'menubox':False, 'user':user,'users':User.objects.all(), 'contents':contents, 'title':title, 'keyword':keyword, 'posted_at':posted_at, 'state':state, 'type_id':type_id, 'poster_id':poster_id, 'post_id':post_id})
    else:
        return render(request, 'main/read_more.html', {'replies1':allpost ,'replies':allpost ,'menubox':False, 'users':User.objects.all(), 'contents':contents, 'title':title, 'keyword':keyword, 'posted_at':posted_at, 'state':state, 'type_id':type_id, 'poster_id':poster_id, 'post_id':post_id})



#ADMIN VIEW
def adminView(request):
    users = User.objects.all()
    posts = Post.objects.all()
    return render(request, 'main/authorized/admin.html', {'menubox':False,'users':users,'posts':posts})



# ADMIN DELETE USER REQUEST
@csrf_exempt
def delUserRequest(request, uid):
    User.objects.get(id=uid).delete()
    return HttpResponseRedirect("/forum/superuser/")



#LOGOUT REQUEST
def logoutRequest(request):
    request.session['username'] = ''
    return HttpResponseRedirect('/')



# POST REQUEST
@csrf_exempt
def postRequest(request, pid):
    if request.method =="POST":
        form = request.POST

        title = form['post_title']
        poster_id = pid
        content = form['post_content']

        #Getting current date
        date_now = timezone.now()
        Post.objects.create(title = title,keyword = 'none' ,content = content,posted_at = date_now,state = 'active',type_id = 1, poster_id = poster_id)
    return HttpResponseRedirect('/')



# DELETE POST REQUEST
def delPostRequest(request, pid1, pid2):
    Post.objects.get(id=pid2).delete()
    if pid1 == 0:
        return HttpResponseRedirect("/forum/")
    else:
        Reply.objects.get(reply_id = pid2).delete()
        return HttpResponseRedirect("/forum/readpost/"+str(pid1))



# REGISTER VIEW
@csrf_exempt
def registerView(request):
    
    #Storage for errors.
    errormsg = []

    #Check if registration form is submitted
    if request.method == "POST":

        #Storing POST data into variables.
        form = request.POST
        code_name = form['code_name']
        fname = form['f_name']
        lname = form['l_name']
        password = form['password']
        re_password = form['re_password']
        email = form['email']

        #Check if code name already exist.
        for user in User.objects.all():
            if code_name == user.code_name:
                errormsg.append("Code name already exist.")
        
        #Check if email already exist.
        for user in User.objects.all():
            if email == user.email:
                errormsg.append("Email already exist.")

        #Check if password and re-typed password matched.
        if password != re_password:
            errormsg.append("Password didn't match.")
        
        if not errormsg:
            #Getting current date
            date_now = timezone.now()
            User.objects.create(code_name=code_name ,f_name=fname ,l_name=lname ,pwd=password ,status="online" ,rank="novice" ,state="active" ,started_at=date_now, email=email)
            return redirect('login_url')
    return render(request, 'main/account/register.html', {'menubox':False, 'errormsg':errormsg})



# LOGIN VIEW 
@csrf_exempt
def loginView(request):

    #Storage for errors.
    errormsg = []

    #Check if login form is submitted
    if request.method == "POST":

        #Storing POST data into variables.
        form = request.POST
        username = form['username']
        password = form['password']

        #Setup variables to be used
        username_state = False

        #Check if code name or email exist
        for user in User.objects.all():
            if username == user.code_name or username == user.email:
                username_state = True
        
        if username_state:
            for user in User.objects.all():
                if username == user.code_name or username == user.email:
                    if password == user.pwd:
                        request.session['username'] = username
                        return HttpResponseRedirect('/')
                    else:
                        errormsg.append('Password is incorrect.')
        else:
            errormsg.append("User doesn't exist.")
        
        return render(request, 'main/account/login.html', {'menubox':False,'errormsg':errormsg})

    return render(request, 'main/account/login.html', {'menubox':False})