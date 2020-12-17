from django.db import models

# Create your models here.
class User(models.Model):
    code_name = models.CharField(max_length = 50)
    f_name = models.CharField(max_length = 50)
    l_name = models.CharField(max_length = 50)
    pwd = models.CharField(max_length = 50)
    status = models.CharField(max_length = 50)
    rank = models.CharField(max_length = 50)
    state = models.CharField(max_length = 50)
    started_at = models.DateTimeField()
    email = models.EmailField(default="system_default")

class Post(models.Model):
    title = models.CharField(max_length = 100)
    keyword = models.TextField()
    content = models.TextField()
    posted_at = models.DateTimeField()
    state = models.CharField(max_length = 50)
    type_id = models.IntegerField()
    poster_id = models.IntegerField()


class Type(models.Model):
    type = models.CharField(max_length=50)


class Reply(models.Model):
    post_id = models.IntegerField()
    reply_id = models.IntegerField()


class Reaction(models.Model):
    post_id = models.IntegerField()
    reaction = models.CharField(max_length=50)
    reactor_id = models.IntegerField()
    reacted_at = models.DateTimeField()


class Report(models.Model):
    post_id = models.IntegerField()
    reporter_id = models.IntegerField()
    concern = models.TextField()
    reported_at = models.DateTimeField()