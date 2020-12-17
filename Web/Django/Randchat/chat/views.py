from django.shortcuts import render
from django.views.decorators.csrf import csrf_exempt
from django.utils import timezone
from chat.models import *
from django.http import HttpResponseRedirect

# Create your views here.
def indexView(request):
	return render(request, 'pages/index.html')
	
def sampleView(request):
	return render(request, 'pages/sample.html')

def mainView(request):
	messages = Conversation.objects.all()
	return render(request, 'pages/main.html', {'user_id':request.session['user_id'], 'user_gender':request.session['user_gender'], 'username':request.session['username'], 'user_active':request.session['user_active'], 'messages':messages})

@csrf_exempt
def sendRequest(request):
	if request.method == 'POST':
		date_now = timezone.now()
		message = Conversation.objects.create(gender=request.session['user_gender'], username=request.session['username'], user_id=request.session['user_id'], message=request.POST['message'], time=date_now, key=0)
		print(message.time)
		return HttpResponseRedirect('/chat')
	else:
		pass

@csrf_exempt
def proceedRequest(request):
	if request.method == 'POST':
		username = request.POST['username']
		gender = request.POST['gender']
		user = User.objects.create(username=username, gender=gender, active=False)
		request.session['user_id'] = user.id
		request.session['user_gender'] = user.gender
		request.session['username'] = user.username
		request.session['user_active'] = user.active
		return HttpResponseRedirect('/chat')
	else:
		pass

def resetRequest(request):
	for user in User.objects.all():
		User.objects.get(id=user.id).delete()
	for con in Conversation.objects.all():
		Conversation.objects.get(id=con.id).delete()
	return HttpResponseRedirect('/')