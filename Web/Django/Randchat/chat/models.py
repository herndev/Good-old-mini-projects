from django.db import models

# Create your models here.
class User(models.Model):
	username = models.CharField(max_length = 100)
	gender = models.CharField(max_length = 50)
	active = models.BooleanField()
	
class Conversation(models.Model):
	user_id = models.IntegerField()
	gender = models.CharField(max_length = 50, default="male")
	username = models.CharField(max_length = 100, default="test")
	message = models.CharField(max_length = 50)
	time = models.DateTimeField()
	key = models.IntegerField()

class Private(models.Model):
	name = models.CharField(max_length = 100)

class BannedWord(models.Model):
	word = models.CharField(max_length = 50)
	reason = models.TextField()