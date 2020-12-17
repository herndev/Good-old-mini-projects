from django.db import models
from django.utils import timezone

default_time = "2020-05-06 14:42:37.295705+00:00"
default_pass = "test"

# Create your models here.
class Username(models.Model):
	username = models.TextField()
	password = models.TextField(default=default_pass)
	time = models.DateTimeField(default=default_time)

class Data(models.Model):
	user_id = models.IntegerField()
	title = models.TextField()
	text = models.TextField()
	time = models.DateTimeField(default=default_time)