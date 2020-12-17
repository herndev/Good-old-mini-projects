from django.shortcuts import render
from django.http import HttpResponseRedirect
from django.views.decorators.csrf import csrf_exempt
from Notes.models import *
from django.utils import timezone

# Create your views here.
def homeView(request):
	# for i in Data.objects.all():
	# 	Data.objects.get(id=i.id).delete()
	return render(request, 'pages/index.html')

def deleteRequest(request, nid):
	username = request.session['username']
	Data.objects.get(id=nid).delete()
	return HttpResponseRedirect('/notes/' + username)

@csrf_exempt
def userLink(request):
	if request.method == "POST":
		username = request.POST['username']
		return HttpResponseRedirect('notes/' + username)

@csrf_exempt
def userView(request, username):
	username = username
	if request.method == "POST":
		title = request.POST['new_title']
		note = request.POST['new_note']
		user_id = request.session['user_id']

		#Getting current date
		date_now = timezone.now()
		#Create new note to Data's table
		Data.objects.create(user_id=user_id, title=title, text=note, time=date_now)
		return HttpResponseRedirect('/notes/' + username)

	else:
		users = Username.objects.all()
		for user in users:
			if user.username == username:
				user_data = Username.objects.get(username=username)
				user_notes = []

				for note in Data.objects.all():
					if note.user_id == user_data.id:
						temp = {}
						temp2 = {}
						
						temp = Data.objects.get(user_id=user_data.id, id=note.id)
						temp2['id'] = temp.id
						temp2['title'] = temp.title
						temp2['text'] = temp.text

						user_notes.append(temp)
				
				request.session['user_id'] =user_data.id
				request.session['passkey'] =user_data.password
				request.session['username'] =user_data.username
				return render(request, 'pages/user.html', {'username':username, 'status':'member', 'user_data':user_data, 'user_notes':user_notes})
		
		#Getting current date
		date_now = timezone.now()
		#Create new user to Username's table
		new_user = Username.objects.create(username=username,time=date_now)
		request.session['user_id'] = new_user.id
		request.session['username'] =user_data.username
		return render(request, 'pages/user.html', {'username':username, 'status':'new'})